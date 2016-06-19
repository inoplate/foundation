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
    @css()
@overwrite

@section('footer-scripts')
    @js()
@overwrite