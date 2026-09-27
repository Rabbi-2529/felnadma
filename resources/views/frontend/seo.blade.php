@extends('frontend.layout.frontend_master')
<?php use App\Support\Img; ?>
@section('content')

<section class="page-hero">
  @if(!empty($seo->image))
  <div class="page-hero__bg" aria-hidden="true">
    {!! Img::tag('asset/images/'.$seo->image, '', ['loading' => 'eager', 'fetchpriority' => 'high']) !!}
  </div>
  @endif
  <div class="container">
    <div class="page-hero__inner">
      <span class="eyebrow eyebrow--light"><i class="fas fa-chart-line"></i> #1 SEO service provider</span>
      <h1 class="page-hero__title">{{ $seo->title }}</h1>
      <p class="page-hero__lead">Boost your website ranking with our expert SEO solutions.</p>
      <div class="page-hero__actions">
        <button type="button" class="btn-f btn-f--primary btn-f--lg" data-toggle="modal" data-target="#seoContactModal">Get free consultation <i class="fas fa-arrow-right"></i></button>
        <a href="#seo-content" class="btn-f btn-f--ghost-light btn-f--lg">Learn more <i class="fas fa-arrow-down"></i></a>
      </div>
    </div>
  </div>
</section>

<div class="overlap-stats">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-6 mb-3"><div class="stat-card"><i class="fas fa-gauge-high"></i><h4>200+</h4><p>Projects done</p></div></div>
      <div class="col-md-3 col-6 mb-3"><div class="stat-card"><i class="fas fa-face-smile"></i><h4>150+</h4><p>Happy clients</p></div></div>
      <div class="col-md-3 col-6 mb-3"><div class="stat-card"><i class="fas fa-star"></i><h4>98%</h4><p>Satisfaction</p></div></div>
      <div class="col-md-3 col-6 mb-3"><div class="stat-card"><i class="fas fa-trophy"></i><h4>25+</h4><p>Awards won</p></div></div>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><i class="fas fa-magnifying-glass"></i> Our approach</span>
      <h2 class="section-title">Why choose our <span class="hl">SEO services?</span></h2>
      <p class="section-lead">We provide comprehensive SEO solutions to grow your business.</p>
    </div>
    <div class="row">
      <div class="col-md-4 mb-4" data-reveal><div class="f-card f-card--center"><div class="icon-tile icon-tile--solid"><i class="fas fa-magnifying-glass"></i></div><h3>Keyword research</h3><p>Targeted keyword research to attract quality traffic.</p></div></div>
      <div class="col-md-4 mb-4" data-reveal><div class="f-card f-card--center"><div class="icon-tile icon-tile--solid"><i class="fas fa-link"></i></div><h3>Link building</h3><p>High-quality backlinks from authoritative domains.</p></div></div>
      <div class="col-md-4 mb-4" data-reveal><div class="f-card f-card--center"><div class="icon-tile icon-tile--solid"><i class="fas fa-chart-column"></i></div><h3>Analytics &amp; reporting</h3><p>Regular performance reports and insights.</p></div></div>
    </div>
  </div>
</section>

<section class="section section--muted" id="seo-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10">
        <article class="article-card">
          <h2 class="article-card__title">{{ $seo->title }}</h2>
          <div class="prose">{!! $seo->description !!}</div>
        </article>
      </div>
    </div>
  </div>
</section>

@include('frontend.partials.article')

<section class="section section--tight">
  <div class="container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><i class="fas fa-toolbox"></i> Toolkit</span>
      <h2 class="section-title">Our SEO tools &amp; technologies</h2>
    </div>
    <div class="chip-grid">
      <div class="chip-tile"><i class="fab fa-google"></i><p>Google</p></div>
      <div class="chip-tile"><i class="fas fa-chart-simple"></i><p>SEMrush</p></div>
      <div class="chip-tile"><i class="fas fa-chart-line"></i><p>Ahrefs</p></div>
      <div class="chip-tile"><i class="fab fa-wordpress"></i><p>WP Rocket</p></div>
      <div class="chip-tile"><i class="fas fa-magnifying-glass-chart"></i><p>Moz</p></div>
      <div class="chip-tile"><i class="fas fa-chart-pie"></i><p>Analytics</p></div>
    </div>
  </div>
</section>

<section class="section section--tight pt-0">
  <div class="container">
    <div class="cta-band" data-reveal>
      <div class="cta-band__row">
        <div style="max-width:620px">
          <h2>Ready to climb the rankings?</h2>
          <p>Share your website and our SEO expert will get back to you within 24 hours.</p>
        </div>
        <div class="cta-band__actions">
          <button type="button" class="btn-f btn-f--light btn-f--lg" data-toggle="modal" data-target="#seoContactModal">Get free consultation <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('modals')
@include('frontend.partials.lead_modal', [
  'id' => 'seoContactModal',
  'title' => 'Free SEO consultation',
  'subtitle' => 'Our SEO expert will contact you within 24 hours',
  'icon' => 'fas fa-magnifying-glass-chart',
  'textLabel' => 'Your website URL',
  'textPlaceholder' => 'https://yourwebsite.com',
  'textIcon' => 'fas fa-globe',
  'submitLabel' => 'Request consultation',
])
@endpush
