@extends('frontend.layout.frontend_master')
<?php
  // Lowest masking / non-masking rate across packages for the hero (rows like "0.25 BDT"; sms_type spacing varies)
  $lowestOf = function ($type) use ($packages) {
      return $packages->flatMap->prices
          ->filter(function ($p) use ($type) { return strtolower(preg_replace('/\s+/', ' ', trim($p->sms_type))) === $type; })
          ->map(function ($p) { return preg_match('/^\s*(\d+(?:\.\d+)?)\s*bdt/i', $p->price, $m) ? (float) $m[1] : null; })
          ->filter()->min();
  };
  $lowestNonMasking = $lowestOf('non masking');
  $lowestMasking = $lowestOf('masking');
  $fmt = function ($v) { return '৳'.rtrim(rtrim(number_format($v, 2), '0'), '.'); };
?>
@section('content')

{{-- ========== Hero ========== --}}
<section class="page-hero page-hero--compact">
  <div class="container">
    <div class="page-hero__inner">
      <nav class="crumbs" aria-label="Breadcrumb">
        <a href="{{ url('/') }}">Home</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i>
        <a href="{{ url('/bulk-sms-service') }}">SMS Services</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i>
        <span>Rate</span>
      </nav>
      <div class="icon-tile icon-tile--lg page-hero__icon"><i class="fas fa-tags" aria-hidden="true"></i></div>
      <h1 class="page-hero__title">Bulk SMS Rate</h1>
      <p class="page-hero__lead">Clear per-SMS prices for masking and non-masking SMS. The bigger the package, the lower the rate — with no hidden cost.</p>
      @if($lowestNonMasking || $lowestMasking)
      <div class="rate-highlights">
        @if($lowestNonMasking)
        <span><small>Non-masking from</small><strong>{{ $fmt($lowestNonMasking) }}</strong><small>/ SMS</small></span>
        @endif
        @if($lowestMasking)
        <span><small>Masking from</small><strong>{{ $fmt($lowestMasking) }}</strong><small>/ SMS</small></span>
        @endif
      </div>
      @endif
    </div>
  </div>
</section>

{{-- ========== Packages (same cards as /bulk-sms-service) ========== --}}
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
{{-- ========== Masking vs non-masking ========== --}}
<section class="section" aria-labelledby="sms-types-title">
  <div class="container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><i class="fas fa-circle-question"></i> Which rate applies?</span>
      <h2 class="section-title" id="sms-types-title">Masking vs <span class="hl">non-masking</span> SMS</h2>
    </div>
    <div class="card-grid card-grid--2">
      <div class="f-card feature-row" data-reveal>
        <div class="icon-tile"><i class="fas fa-mobile-screen" aria-hidden="true"></i></div>
        <div>
          <h3>Non-masking SMS</h3>
          <p>Sent from a regular mobile number. The lowest rate — ideal for OTP, alerts, notifications and high-volume promotions on a tight budget.</p>
        </div>
      </div>
      <div class="f-card feature-row" data-reveal>
        <div class="icon-tile"><i class="fas fa-signature" aria-hidden="true"></i></div>
        <div>
          <h3>Masking SMS</h3>
          <p>Sent with your brand name as the sender ID, so customers instantly know it's you. Best for brand campaigns and building trust.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ========== CTA ========== --}}
<section class="section section--tight">
  <div class="container">
    <div class="cta-band" data-reveal>
      <div class="cta-band__row">
        <div style="max-width:620px">
          <h2>Need a custom rate?</h2>
          <p>Sending a large volume every month? Talk to us and we'll suggest the best package for your business.</p>
        </div>
        <div class="cta-band__actions">
          <a href="{{ url('/bulk-sms-service') }}" class="btn-f btn-f--light btn-f--lg">See packages <i class="fas fa-arrow-right"></i></a>
          <button type="button" class="btn-f btn-f--ghost-light btn-f--lg" data-toggle="modal" data-target="#callRequ"><i class="fas fa-headset"></i> Request a call</button>
        </div>
      </div>
    </div>
  </div>
</section>

@include('frontend.partials.article', ['muted' => true])

@include('frontend.partials.sms_service_links', [
  'links' => $serviceLinks,
  'title' => 'More <span class="hl">SMS services</span>',
])

@endsection

@include('frontend.partials.price_order')
