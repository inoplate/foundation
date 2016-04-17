@extends('inoplate-adminutes::layouts.default')

@section('page-title')
    {{ $title or '' }} | {{ strip_tags(config('inoplate.foundation.site.name')) }}
@overwrite

@section('navbar')
    @include('inoplate-foundation::partials.navbar')
@overwrite

@section('sidebar')
    @include('inoplate-foundation::partials.sidebar')
@overwrite

@section('footer')
    @include('inoplate-foundation::partials.footer')
@overwrite

@section('control-sidebar')
    @include('inoplate-foundation::partials.control-sidebar')
@overwrite

@section('header-meta')
    @parent
    <meta name="ping-interval" content="{{ config('inoplate.foundation.ping') }}">
@overwrite

@section('footer-scripts')
    @parent
    <script src="/vendor/inoplate-foundation/js/inoplate.js" type="text/javascript"></script>
@overwrite