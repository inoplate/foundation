<section class="content-header">
  <h1>
    {{ $title }}
    <small>{{ $subtitle or '' }}</small>
  </h1>
  @section('breadcrumbs')
  	{!! $breadcrumbs !!}
  @show
</section>