@extends('frontend.layout.frontend_master')

@section('content')

<section class="page-hero page-hero--compact">
  <div class="container">
    <div class="page-hero__inner">
      <nav class="crumbs" aria-label="Breadcrumb">
        <a href="{{ url('/') }}">Home</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i>
        <a href="{{ url('/bulk-sms-service') }}">SMS Services</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i>
        <span>{{ $page->title }}</span>
      </nav>
      @if(!empty($page->icon_image) || !empty($page->icon_class))
      <div class="icon-tile icon-tile--lg page-hero__icon">
        @include('frontend.partials.sms_service_icon', ['link' => (object) [
          'icon_image' => !empty($page->icon_image) ? $page->iconImagePath() : null,
          'icon_class' => $page->icon_class,
        ], 'size' => 46])
      </div>
      @endif
      <h1 class="page-hero__title">{{ $page->title }}</h1>
      @if(!empty($page->short_description))
      <p class="page-hero__lead">{{ $page->short_description }}</p>
      @endif
      <div class="page-hero__actions">
        <a href="{{ url('/bulk-sms-service') }}" class="btn-f btn-f--primary btn-f--lg">View SMS packages <i class="fas fa-arrow-right"></i></a>
        <button type="button" class="btn-f btn-f--ghost-light btn-f--lg" data-toggle="modal" data-target="#callRequ"><i class="fas fa-headset"></i> Talk to an expert</button>
      </div>
    </div>
  </div>
</section>

@if(!empty(trim(strip_tags($page->description ?? '', '<img><iframe>'))))
<section class="section section--muted">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10">
        <article class="article-card">
          <div class="prose">{!! $page->description !!}</div>
        </article>
      </div>
    </div>
  </div>
</section>
@endif

@include('frontend.partials.sms_service_links', [
  'links' => $serviceLinks,
  'title' => 'More <span class="hl">SMS services</span>',
])

@endsection
