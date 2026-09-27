@extends('frontend.layout.frontend_master')
<?php use App\Support\Img; ?>
@section('content')

<section class="page-hero">
  @if(!empty($fbMarketing->image))
  <div class="page-hero__bg" aria-hidden="true">
    {!! Img::tag('asset/images/'.$fbMarketing->image, '', ['loading' => 'eager', 'fetchpriority' => 'high']) !!}
  </div>
  @endif
  <div class="container">
    <div class="page-hero__inner">
      <span class="eyebrow eyebrow--light"><i class="fab fa-facebook-f"></i> Facebook marketing experts</span>
      <h1 class="page-hero__title">{{ $fbMarketing->title }}</h1>
      <p class="page-hero__lead">Grow your business with targeted Facebook advertising and engagement strategies.</p>
      <div class="page-hero__actions">
        <button type="button" class="btn-f btn-f--primary btn-f--lg" data-toggle="modal" data-target="#fbContactModal">Get free consultation <i class="fas fa-arrow-right"></i></button>
        <a href="#fb-content" class="btn-f btn-f--ghost-light btn-f--lg">Learn more <i class="fas fa-arrow-down"></i></a>
      </div>
    </div>
  </div>
</section>

<div class="overlap-stats">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-6 mb-3"><div class="stat-card"><i class="fab fa-facebook-f"></i><h4>500+</h4><p>Campaigns run</p></div></div>
      <div class="col-md-3 col-6 mb-3"><div class="stat-card"><i class="fas fa-users"></i><h4>10M+</h4><p>Reach generated</p></div></div>
      <div class="col-md-3 col-6 mb-3"><div class="stat-card"><i class="fas fa-chart-line"></i><h4>300%</h4><p>Avg. ROI</p></div></div>
      <div class="col-md-3 col-6 mb-3"><div class="stat-card"><i class="fas fa-face-smile"></i><h4>98%</h4><p>Client satisfaction</p></div></div>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><i class="fas fa-bullhorn"></i> What we do</span>
      <h2 class="section-title">Why choose our <span class="hl">Facebook marketing?</span></h2>
      <p class="section-lead">Comprehensive Facebook marketing solutions to grow your business.</p>
    </div>
    <div class="row">
      <div class="col-md-4 mb-4" data-reveal><div class="f-card f-card--center"><div class="icon-tile icon-tile--solid"><i class="fas fa-bullseye"></i></div><h3>Targeted advertising</h3><p>Reach your ideal customers with precise targeting options.</p></div></div>
      <div class="col-md-4 mb-4" data-reveal><div class="f-card f-card--center"><div class="icon-tile icon-tile--solid"><i class="fas fa-chart-line"></i></div><h3>Performance tracking</h3><p>Real-time analytics and detailed campaign reports.</p></div></div>
      <div class="col-md-4 mb-4" data-reveal><div class="f-card f-card--center"><div class="icon-tile icon-tile--solid"><i class="fas fa-comments"></i></div><h3>Engagement strategy</h3><p>Build community and increase brand loyalty.</p></div></div>
    </div>
  </div>
</section>

<section class="section section--muted" id="fb-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10">
        <article class="article-card">
          <h2 class="article-card__title">{{ $fbMarketing->title }}</h2>
          <div class="prose">{!! $fbMarketing->description !!}</div>
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
      <h2 class="section-title">Facebook marketing tools we use</h2>
    </div>
    <div class="chip-grid">
      <div class="chip-tile"><i class="fab fa-facebook-f"></i><p>Ads Manager</p></div>
      <div class="chip-tile"><i class="fas fa-chart-pie"></i><p>Facebook Pixel</p></div>
      <div class="chip-tile"><i class="fas fa-chart-line"></i><p>Analytics</p></div>
      <div class="chip-tile"><i class="fas fa-palette"></i><p>Creative Studio</p></div>
      <div class="chip-tile"><i class="fas fa-briefcase"></i><p>Business Suite</p></div>
      <div class="chip-tile"><i class="fas fa-robot"></i><p>Chatbots</p></div>
    </div>
  </div>
</section>

<section class="section section--tight pt-0">
  <div class="container">
    <div class="cta-band" data-reveal>
      <div class="cta-band__row">
        <div style="max-width:620px">
          <h2>Let's grow your page together</h2>
          <p>Send us your Facebook page and our expert will contact you within 24 hours.</p>
        </div>
        <div class="cta-band__actions">
          <button type="button" class="btn-f btn-f--light btn-f--lg" data-toggle="modal" data-target="#fbContactModal">Get free consultation <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('modals')
@include('frontend.partials.lead_modal', [
  'id' => 'fbContactModal',
  'title' => 'Free Facebook marketing consultation',
  'subtitle' => 'Our expert will contact you within 24 hours',
  'icon' => 'fab fa-facebook-f',
  'textLabel' => 'Facebook page URL',
  'textPlaceholder' => 'https://facebook.com/yourpage',
  'textIcon' => 'fab fa-facebook-f',
  'submitLabel' => 'Request consultation',
])
@endpush
