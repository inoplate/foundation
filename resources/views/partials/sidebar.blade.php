@extends('inoplate-adminutes::partials.sidebar')

@section('sidebar-user-panel')
@endsection

@section('sidebar-search-form')
    <form action="#" method="get" class="sidebar-form" id="search-navigation">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..." />
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>
@endsection

@section('sidebar-menu')
     @if(isset($menus['main']))
        {!! $menus['main'] !!}
    @endif
    <li class="header">{{trans('inoplate-foundation::labels.navigation.plugins')}}</li>
    @if(isset($menus['plugin']))
        {!! $menus['plugin'] !!}
    @endif
    <li class="header">{{trans('inoplate-foundation::labels.navigation.utilities')}}</li>
    @if(isset($menus['utility']))
        {!! $menus['utility'] !!}
    @endif
@endsection