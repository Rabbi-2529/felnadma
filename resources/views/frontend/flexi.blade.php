@extends('frontend.layout.frontend_master')
<?php use App\Support\Img; ?>
@section('content')

<section class="page-hero">
  @if(!empty($flexi->image))
  <div class="page-hero__bg" aria-hidden="true">
    {!! Img::tag('asset/images/'.$flexi->image, '', ['loading' => 'eager', 'fetchpriority' => 'high']) !!}
  </div>
  @endif
  <div class="container">
    <div class="page-hero__inner">
      <span class="eyebrow eyebrow--light"><i class="fas fa-bolt"></i> Flexi load solutions</span>
      <h1 class="page-hero__title">{{ $flexi->title }}</h1>
      <p class="page-hero__lead">Flexible and scalable solutions tailored to your business needs.</p>
      <div class="page-hero__actions">
        <button type="button" class="btn-f btn-f--primary btn-f--lg" data-toggle="modal" data-target="#getStartedModal">Get started today <i class="fas fa-arrow-right"></i></button>
        <a href="#flexi-content" class="btn-f btn-f--ghost-light btn-f--lg">Learn more <i class="fas fa-arrow-down"></i></a>
      </div>
    </div>
  </div>
</section>

<div class="overlap-stats">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-6 mb-3"><div class="stat-card"><i class="fas fa-clock"></i><h4>24/7</h4><p>Support available</p></div></div>
      <div class="col-md-3 col-6 mb-3"><div class="stat-card"><i class="fas fa-charging-station"></i><h4>99.9%</h4><p>Uptime guarantee</p></div></div>
      <div class="col-md-3 col-6 mb-3"><div class="stat-card"><i class="fas fa-rocket"></i><h4>2x</h4><p>Faster processing</p></div></div>
      <div class="col-md-3 col-6 mb-3"><div class="stat-card"><i class="fas fa-shield-halved"></i><h4>100%</h4><p>Secure &amp; reliable</p></div></div>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><i class="fas fa-mobile-screen"></i> Mobile bill solution</span>
      <h2 class="section-title">Why choose our <span class="hl">flexi load services?</span></h2>
      <p class="section-lead">Flexible and scalable solutions for your business growth.</p>
    </div>
    <div class="row">
      <div class="col-md-4 mb-4" data-reveal><div class="f-card f-card--center"><div class="icon-tile icon-tile--solid"><i class="fas fa-chart-line"></i></div><h3>Scalable solutions</h3><p>Grow your business with solutions that scale with your needs.</p></div></div>
      <div class="col-md-4 mb-4" data-reveal><div class="f-card f-card--center"><div class="icon-tile icon-tile--solid"><i class="fas fa-coins"></i></div><h3>Cost effective</h3><p>Pay only for what you need with flexible pricing options.</p></div></div>
      <div class="col-md-4 mb-4" data-reveal><div class="f-card f-card--center"><div class="icon-tile icon-tile--solid"><i class="fas fa-headset"></i></div><h3>Expert support</h3><p>Dedicated support team available 24/7 for assistance.</p></div></div>
    </div>
  </div>
</section>

<section class="section section--muted" id="flexi-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10">
        <article class="article-card">
          <h2 class="article-card__title">{{ $flexi->title }}</h2>
          <div class="prose">{!! $flexi->description !!}</div>
        </article>
      </div>
    </div>
  </div>
</section>

@include('frontend.partials.article')

<section class="section section--tight">
  <div class="container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><i class="fas fa-sliders"></i> Features</span>
      <h2 class="section-title">Our flexi load features</h2>
    </div>
    <div class="chip-grid">
      <div class="chip-tile"><i class="fas fa-gauge-high"></i><p>High speed</p></div>
      <div class="chip-tile"><i class="fas fa-shield-halved"></i><p>Secure</p></div>
      <div class="chip-tile"><i class="fas fa-rotate"></i><p>Auto sync</p></div>
      <div class="chip-tile"><i class="fas fa-chart-pie"></i><p>Analytics</p></div>
      <div class="chip-tile"><i class="fas fa-mobile-screen"></i><p>Mobile ready</p></div>
      <div class="chip-tile"><i class="fas fa-cloud-arrow-up"></i><p>Cloud based</p></div>
    </div>
  </div>
</section>

<section class="section section--tight pt-0">
  <div class="container">
    <div class="cta-band" data-reveal>
      <div class="cta-band__row">
        <div style="max-width:620px">
          <h2>Get started with flexi load</h2>
          <p>Tell us a little about your business and we'll be in touch shortly.</p>
        </div>
        <div class="cta-band__actions">
          <button type="button" class="btn-f btn-f--light btn-f--lg" data-toggle="modal" data-target="#getStartedModal">Get started today <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('modals')
<div class="modal fade modal-f" id="getStartedModal" tabindex="-1" role="dialog" aria-labelledby="getStartedModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="ico"><i class="fas fa-rocket"></i></div>
        <div>
          <h4 class="modal-title" id="getStartedModalLabel">Get started with flexi load</h4>
          <p class="modal-sub">We'll get in touch with you shortly</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form method="POST" action="{{ route('frontend.flexiRequest') }}" data-bd-phone>
        @csrf
        <div class="modal-body">
          <div class="field">
            <label for="fx_name">Full name <span class="req">*</span></label>
            <div class="input-icon">
              <input type="text" class="form-control" id="fx_name" name="client_name" maxlength="100" autocomplete="name" required placeholder="Your full name">
              <i class="fas fa-user"></i>
            </div>
          </div>
          <div class="field">
            <label for="fx_phone">Phone number <span class="req">*</span></label>
            <div class="input-icon">
              <input type="tel" class="form-control" id="fx_phone" name="client_phone" inputmode="numeric" autocomplete="tel" pattern="01[3-9][0-9]{8}" maxlength="11" required placeholder="01XXXXXXXXX">
              <i class="fas fa-mobile-alt"></i>
            </div>
            <div class="field-error">Enter a valid 11-digit Bangladeshi number (01XXXXXXXXX).</div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="field">
                <label for="fx_company">Company <small class="text-muted-f">(optional)</small></label>
                <div class="input-icon">
                  <input type="text" class="form-control" id="fx_company" name="client_company" maxlength="150" autocomplete="organization" placeholder="Company name">
                  <i class="fas fa-building"></i>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="field mb-sm-0">
                <label for="fx_email">Email <small class="text-muted-f">(optional)</small></label>
                <div class="input-icon">
                  <input type="email" class="form-control" id="fx_email" name="client_email" maxlength="150" autocomplete="email" placeholder="you@company.com">
                  <i class="fas fa-envelope"></i>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="flexi_title" value="{{ $flexi->title }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-f btn-f--outline btn-f--sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn-f btn-f--primary btn-f--sm"><i class="fas fa-paper-plane"></i> Submit request</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endpush
