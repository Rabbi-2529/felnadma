@extends('frontend.layout.frontend_master')
<?php
  use App\Model\Slider;
  use App\Support\Img;
  $sliders = Slider::get();
?>

@if($sliders->count())
@push('preload')
<link rel="preload" as="image" href="{{ Img::url('asset/images/slider/'.$sliders->first()->slider_image) }}" fetchpriority="high">
@endpush
@endif

@section('content')

{{-- ========== Hero ========== --}}
<section class="hero" aria-labelledby="hero-title">
  <div class="container">
    <div class="hero__copy">
      <span class="eyebrow"><i class="fas fa-bolt"></i> OTP · Masking · Non-masking · Promotional</span>
      <h1 class="hero__title" id="hero-title">Bulk SMS in Bangladesh that <span class="hl">reaches customers in seconds</span></h1>
      <p class="hero__lead">Fast delivery, a secure platform and real-time reports for businesses, startups, e-commerce and corporate teams — plus an API to plug SMS into your own software.</p>
      <div class="hero__actions">
        <a href="{{ url('/bulk-sms-service') }}" class="btn-f btn-f--primary btn-f--lg">View SMS pricing <i class="fas fa-arrow-right"></i></a>
        <button type="button" class="btn-f btn-f--outline btn-f--lg" data-toggle="modal" data-target="#callRequ"><i class="fas fa-headset"></i> Talk to an expert</button>
      </div>
      <ul class="hero__trust">
        <li><i class="fas fa-circle-check"></i> Delivery in seconds</li>
        <li><i class="fas fa-circle-check"></i> Masking set up within a day</li>
        <li><i class="fas fa-circle-check"></i> API integration</li>
        <li><i class="fas fa-circle-check"></i> 24/7 support</li>
      </ul>
    </div>

    @if($sliders->count())
    <div class="hero__stage">
      <div class="hero-floating hero-floating--a">
        <span class="ico"><i class="fas fa-paper-plane"></i></span>
        <span><strong>OTP delivered</strong><small>in about 2 seconds</small></span>
      </div>
      @if(!empty($startingPrice))
      <div class="hero-floating hero-floating--b">
        <span class="ico"><i class="fas fa-tag"></i></span>
        <span><strong>From ৳{{ rtrim(rtrim(number_format($startingPrice, 2), '0'), '.') }} / SMS</strong><small>Lowest rate in our packages</small></span>
      </div>
      @endif

      <div class="hero-frame">
        <div class="hero-frame__bar" aria-hidden="true"><span></span><span></span><span></span></div>
        <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000" aria-label="Featured offers">
          @if($sliders->count() > 1)
          <ol class="carousel-indicators">
            @foreach($sliders as $slider)
            <li data-target="#heroCarousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-label="Slide {{ $loop->iteration }}"></li>
            @endforeach
          </ol>
          @endif
          <div class="carousel-inner">
            @foreach($sliders as $slider)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
              {!! Img::tag('asset/images/slider/'.$slider->slider_image, 'Felna DMA bulk SMS offer '.$loop->iteration, $loop->first
                  ? ['loading' => 'eager', 'fetchpriority' => 'high', 'decoding' => 'sync']
                  : []) !!}
            </div>
            @endforeach
          </div>
          @if($sliders->count() > 1)
          <button class="carousel-ctrl carousel-ctrl--prev" type="button" data-target="#heroCarousel" data-slide="prev" aria-label="Previous slide"><i class="fas fa-chevron-left"></i></button>
          <button class="carousel-ctrl carousel-ctrl--next" type="button" data-target="#heroCarousel" data-slide="next" aria-label="Next slide"><i class="fas fa-chevron-right"></i></button>
          @endif
        </div>
      </div>
    </div>
    @endif

    <div class="stats-strip">
      <div class="stats-grid">
        <div><strong>64</strong><span>Districts covered</span></div>
        <div><strong>24/7</strong><span>Customer support</span></div>
        <div><strong>1 day</strong><span>Masking setup</span></div>
        <div><strong>API</strong><span>For your software</span></div>
      </div>
    </div>
  </div>
</section>

{{-- ========== SMS offer ========== --}}
@if($smsOffer)
<section class="section" aria-labelledby="offer-title">
  <div class="container">
    <div class="offer-card" data-reveal>
      @if(!empty($smsOffer->image))
      <div class="offer-card__media">
        {!! Img::tag('asset/images/offer/'.$smsOffer->image, 'Bulk SMS offer') !!}
      </div>
      @endif
      <div class="offer-card__body">
        <span class="eyebrow"><i class="fas fa-gift"></i> Current offer</span>
        <h2 id="offer-title">{{ $smsOffer->title }}</h2>
        <p>{{ $smsOffer->description }}</p>
        <div class="d-flex flex-wrap gap-2 mt-3">
          <a href="{{ url('/bulk-sms-service') }}" class="btn-f btn-f--primary">See packages <i class="fas fa-arrow-right"></i></a>
          <button type="button" class="btn-f btn-f--outline" data-toggle="modal" data-target="#callRequ">Request a call</button>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

{{-- ========== Our SMS services (links to the SMS Services sub-pages) ========== --}}
@include('frontend.partials.sms_service_links', [
  'links' => $serviceLinks ?? collect(),
  'lead' => 'Explore our SMS rates and services — pick what fits your business.',
])

{{-- ========== SMS marketing benefits ========== --}}
@if($marketingImage || count($smsMarketing))
<section class="section section--muted" aria-labelledby="benefits-title">
  <div class="container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><i class="fas fa-chart-line"></i> Why SMS marketing</span>
      <h2 class="section-title" id="benefits-title">{{ $marketingImage->title ?? 'Grow faster with bulk SMS' }}</h2>
    </div>
    <div class="row align-items-center">
      @if(!empty($marketingImage->image))
      <div class="col-lg-6 mb-4 mb-lg-0" data-reveal>
        <div class="media-frame media-frame--offset">
          {!! Img::tag('asset/images/marketing/'.$marketingImage->image, $marketingImage->title ?? 'SMS marketing') !!}
        </div>
      </div>
      @endif
      <div class="{{ !empty($marketingImage->image) ? 'col-lg-6' : 'col-lg-8 mx-auto' }}" data-reveal>
        <div class="accordion-f">
          @foreach($smsMarketing as $marketing)
          <details {{ $loop->first ? 'open' : '' }}>
            <summary>{{ $marketing->title }}</summary>
            <div class="acc-body"><p>{{ $marketing->description }}</p></div>
          </details>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endif

{{-- ========== Why choose us ========== --}}
@if(count($whyChoose))
<section class="section" aria-labelledby="why-title">
  <div class="container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><i class="fas fa-award"></i> Why choose us</span>
      <h2 class="section-title" id="why-title">A bulk SMS partner you can <span class="hl">rely on</span></h2>
      <p class="section-lead">Low rates, quick setup and people who pick up the phone.</p>
    </div>
    <div class="card-grid">
      @foreach($whyChoose as $choose)
      <div class="f-card" data-reveal>
        <div class="icon-tile">
          {!! Img::tag('asset/images/'.$choose->image, '', ['width' => 38, 'height' => 38]) !!}
        </div>
        <h3>{{ $choose->title }}</h3>
        <p>{{ $choose->description }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

@include('frontend.partials.article', ['muted' => true])

@endsection

{{-- ========== Special offer popup ========== --}}
@if(isset($offer) && $offer && $offer->status == 1)
@push('modals')
<div class="modal fade offer-modal" id="offer" tabindex="-1" role="dialog" aria-labelledby="offerTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
        @if(!empty($offer->image))
        <div class="offer-modal__img">{!! Img::tag('asset/images/offer/'.$offer->image, $offer->title) !!}</div>
        @endif
        <div class="offer-modal__text">
          <h3 id="offerTitle">{{ $offer->title }}</h3>
          @if(!empty($offer->description))
          <p class="text-muted-f">{{ $offer->description }}</p>
          @endif
          <a href="{{ url('/bulk-sms-service') }}" class="btn-f btn-f--primary mt-2">Claim this offer <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endpush

@push('scripts')
<script>
  // Show the offer once per visit, shortly after the page is usable
  (function () {
    var key = 'felna_offer_{{ $offer->id }}_seen';
    try { if (sessionStorage.getItem(key)) return; } catch (e) {}
    window.addEventListener('load', function () {
      setTimeout(function () {
        if (document.querySelector('.modal.show')) return;
        $('#offer').modal('show');
        try { sessionStorage.setItem(key, '1'); } catch (e) {}
      }, 1500);
    });
  })();
</script>
@endpush
@endif
