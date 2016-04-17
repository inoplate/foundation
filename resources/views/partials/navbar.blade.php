@extends('inoplate-adminutes::partials.navbar')

{{--*/ $userDisplayName =  Auth::user()->name /*--}}
{{--*/ $userDisplayType = isset(Auth::user()->displayType) ? Auth::user()->displayType : trans('inoplate-foundation::labels.users.type.generic') /*--}}
{{--*/ $userSignoutUrl =  '/logout' /*--}}
{{--*/ $userProfileUrl =  '/admin/profile' /*--}}

@section('site-title')
    <b>{!! config('inoplate.foundation.site.name') !!}</b>
@endsection

@section('site-title-mini')
    <b>{!! config('inoplate.foundation.site.short_name') !!}</b>
@endsection