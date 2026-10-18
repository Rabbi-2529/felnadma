@extends('frontend.layout.frontend_master')
<?php use App\Support\Img; ?>

@section('content')

{{-- ========== Hero ========== --}}
<section class="page-hero page-hero--compact">
  @if(!empty($priceHeader->image))
  <div class="page-hero__bg" aria-hidden="true">
    {!! Img::tag('asset/images/'.$priceHeader->image, '', ['loading' => 'eager', 'fetchpriority' => 'high']) !!}
  </div>
  @endif
  <div class="container">
    <div class="page-hero__inner">
      <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ url('/') }}">Home</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> <span>SMS Pricing</span></nav>
      <h1 class="page-hero__title">{{ $priceHeader->header_title ?? 'Bulk SMS Pricing' }}</h1>
      @if(!empty($priceHeader->description))
      <p class="page-hero__lead">{{ $priceHeader->description }}</p>
      @endif
    </div>
  </div>
</section>

{{-- ========== Packages ========== --}}
<section class="section section--muted" aria-labelledby="packages-title">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow"><i class="fas fa-tags"></i> Packages</span>
      <h2 class="section-title" id="packages-title">Simple, <span class="hl">transparent</span> SMS rates</h2>
      <p class="section-lead">Pick a package, verify your number and our team will call you to activate your account.</p>
    </div>

    @include('frontend.partials.price_cards')
  </div>
</section>

@include('frontend.partials.article')

@endsection

@include('frontend.partials.price_order')
