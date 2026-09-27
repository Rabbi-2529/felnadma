@extends('frontend.layout.frontend_master')
<?php use App\Support\Img; ?>
@section('content')

<section class="page-hero page-hero--compact">
  @if(!empty($terms->image))
  <div class="page-hero__bg" aria-hidden="true">
    {!! Img::tag('asset/images/'.$terms->image, '', ['loading' => 'eager', 'fetchpriority' => 'high']) !!}
  </div>
  @endif
  <div class="container">
    <div class="page-hero__inner">
      <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ url('/') }}">Home</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> <span>Terms</span></nav>
      <h1 class="page-hero__title">{{ $terms->header_title ?? 'Terms & Conditions' }}</h1>
    </div>
  </div>
</section>

<section class="section section--muted">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-9">
        <article class="article-card">
          <div class="prose">@parsedown($terms->terms)</div>
        </article>
      </div>
    </div>
  </div>
</section>

@include('frontend.partials.article')

@endsection
