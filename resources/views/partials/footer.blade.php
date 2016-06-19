@extends('inoplate-adminutes::partials.footer')

@section('footer-content')
    <div class="pull-right hidden-xs">
        <b>Version</b> 0.0.1-beta
    </div>
    <strong>Copyright &copy; {{ date('Y') }} 
        <a href="http://inologi.co.id">{!! config('inoplate.foundation.site.name') !!}</a>.
    </strong> 
    All rights reserved.
@endsection