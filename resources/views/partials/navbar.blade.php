@extends('inoplate-adminutes::partials.navbar')

{{--*/ $userDisplayName =  Auth::user()->name /*--}}
{{--*/ $userDisplayType = isset(Auth::user()->displayType) ? Auth::user()->displayType : trans('inoplate-foundation::labels.users.type.generic') /*--}}
{{--*/ $userSignoutUrl =  '/logout' /*--}}
{{--*/ $userProfileUrl =  '/admin/profile' /*--}}
{{--*/ $cardAvatar =  Auth::user()->avatar ?: '/vendor/inoplate-adminutes/img/user-64x64.png'  /*--}}
{{--*/ $userAvatar =  Auth::user()->avatar ?: '/vendor/inoplate-adminutes/img/user-64x64.png'  /*--}}

@section('site-title')
    <b>{!! config('inoplate.foundation.site.name') !!}</b>
@endsection

@section('site-title-mini')
    <b>{!! config('inoplate.foundation.site.short_name') !!}</b>
@endsection

@section('navbar-custom-menu')
    @include('inoplate-notification::notifications.navbar')
@endsection