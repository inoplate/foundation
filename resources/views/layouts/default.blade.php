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
    @stack('header-meta-stack')
@overwrite

@section('header-styles')
    <link href="/vendor/inoplate-adminutes/vendor/pace/themes/red/pace-theme-minimal.css" type="text/css" rel="stylesheet" />
    @parent
    @stack('header-styles-stack')
@overwrite

@section('footer-scripts')
    <script data-pace-options='{"ajax":{"ignoreURLs":["/ping"]}}' src="/vendor/inoplate-adminutes/vendor/pace/pace.min.js" type="text/javascript"></script>
    @parent
    <script src="/vendor/inoplate-foundation/js/inoplate.js" type="text/javascript"></script>
    @stack('footer-scripts-stack')
@overwrite