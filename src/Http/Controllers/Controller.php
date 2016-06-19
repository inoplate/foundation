<?php

namespace Inoplate\Foundation\Http\Controllers;

use Inoplate\Foundation\Services\Bus\ExecuteCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ExecuteCommand;

    /**
     * Generate response for form error
     * 
     * @param  integer $status
     * @param  array   $data
     * @return response
     */
    protected function formError($status = 500, array $data = [])
    {
        if(request()->ajax()) {
            return response()->json($data, $status);
        }else {
            return back()->withError($data)->withInput();
        }
    }

    /**
     * Generate response for form success
     * 
     * @param  string $url
     * @param  array  $data
     * @return response
     */
    protected function formSuccess($url, array $data = [])
    {
        if(request()->ajax()) {
            return response()->json($data, 200);
        }else {
            return redirect($url)->with($data);
        }
    }

    /**
     * Generate response for get
     * 
     * @param  string $view
     * @param  array  $data
     * @return response
     */
    protected function getResponse($view, array $data = [])
    {
        if(request()->ajax()) {
            return $data;
        }else {
            return view($view, $data);
        }
    }
}
