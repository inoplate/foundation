<?php

namespace Inoplate\Foundation\Http\ViewComposers;

use Inoplate\Navigation\Navigation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NavigationViewComposer
{
    /**
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $active;

    /**
     * @var string
     */
    protected $breadcrumbs = '';

    /**
     * Create new NavigationViewComposer instance
     * 
     * @param Request $request
     * @param Navigation $navigation
     */
    public function __construct(Request $request, Navigation $navigation)
    {
        $this->request = $request;
        $this->navigation = $navigation;
    }

    /**
     * Composer navigation view composer
     * @param  View   $view
     * @return response
     */
    public function compose(View $view)
    {
        $sections = $this->navigation->all();
        $served = [];

        foreach ($sections as $section => $menus) {
            $html = '';
            $this->active = [];
            foreach ($menus as $menu) {
                $html .= $this->serveMenus($menu);
            }
            $served[$section] = $html;
        }

        $this->breadcrumbs = '<ol class="breadcrumb"><i class="fa fa-map-marker"></i> '. $this->breadcrumbs .'</ol>';

        $view->with('menus', $served)
             ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Serving menu
     * @param  array $menu
     * @param  string $html
     * @return string
     */
    protected function serveMenus($menu, $html = '', $level = 0)
    {
        $url = $menu['url'];
        $label = $menu['label'];
        $icon = isset($menu['attributes']['icon']) ? $menu['attributes']['icon'] :'';

        if(strlen($url) > 0) {
            $active = strpos($url, $this->request->url()) !== false ? true : false;
        }else {
            $active = false;
        }

        if($level != 0) {
            $this->active[$level-1] = (isset($this->active[$level-1])&&($this->active[$level-1])) ? true : $active;
        }else {
            $this->active[$level] = $active;
        }

        $childMenu = '';

        if($this->hasChildMenu($menu)) {
            foreach ($menu['childs'] as $child) {
                $childMenu .= $this->serveMenus($child, '', ($level + 1));
            }            
        }

        if($childMenu) {
            if($this->active[$level]) {
                $this->prependBreadcrumbs($menu);
            }

            $html .= '<li class="treeview '.($this->active[$level] ? 'active' : '').'">';
            $html .= '<a href="'. $url .'"><i class="'. $icon .'"></i><span>'. $label .'</span><i class="fa fa-angle-left pull-right"></i></a>';
            $html .= '<ul class="treeview-menu '.($this->active[$level] ? 'menu-open' : '').'">';
            $html .= $childMenu;
            $html .= '</ul>';
            $html .= '</li>';

            $this->active[$level] = false;      
        }else {
            if($active) {
                $this->prependBreadcrumbs($menu, false);
            }

            if($menu['url']) {
                // Menu has no child but at least has url
                $html .=  '<li class="'.($active ? 'active' : '').'"><a href="'. $url .'"><i class="'. $icon .'"></i><span>'. $label .'</span></a></li>';
            }
        }

        return $html;
    }

    protected function prependBreadcrumbs($menu, $isParent = true)
    {
        if(!$isParent) {
            $this->breadcrumbs = '<li class="active">'. $menu['label'] .'</li>'. $this->breadcrumbs;
        }else {
            $url = $menu['url'] ?: $this->request->url().'#';

            $this->breadcrumbs = '<li><a href="'. $url .'">'. $menu['label'] .'</a></li>'. $this->breadcrumbs;
        }
    }

    /**
     * Determine if menu has child
     * @param  array  $menu
     * @return boolean
     */
    protected function hasChildMenu($menu)
    {
        return ((isset($menu['childs']))&&(count($menu['childs'])));
    }
}