@extends('frontend.layout.frontend_master')
<?php use App\Support\Img; ?>
@section('content')

<section class="page-hero page-hero--compact">
  <div class="page-hero__bg" aria-hidden="true">
    {!! Img::tag('asset/images/contact.png', '', ['loading' => 'eager', 'fetchpriority' => 'high']) !!}
  </div>
  <div class="container">
    <div class="page-hero__inner">
      <span class="eyebrow eyebrow--light"><i class="fas fa-location-dot"></i> Get in touch</span>
      <h1 class="page-hero__title">Contact us</h1>
      <p class="page-hero__lead">We'd love to hear from you. Call, email or visit — our team is available 24/7.</p>
      <div class="page-hero__actions">
        <button type="button" class="btn-f btn-f--primary btn-f--lg" data-toggle="modal" data-target="#callRequ"><i class="fas fa-headset"></i> Request a call</button>
      </div>
    </div>
  </div>
</section>

<section class="section section--muted" aria-labelledby="offices-title">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow"><i class="fas fa-building"></i> Offices</span>
      <h2 class="section-title" id="offices-title">Visit or reach <span class="hl">our team</span></h2>
    </div>

    <div class="row">
      @foreach($contacts as $contact)
      <div class="col-lg-6 mb-4">
        <div class="office-card">
          <div class="office-card__head">
            <div class="icon-tile icon-tile--solid mb-0"><i class="fas fa-building"></i></div>
            <h3>{{ $contact->office_name }}</h3>
          </div>
          <div class="office-card__body">
            <ul class="info-list">
              @if(!empty($contact->address))
              <li><span class="ico"><i class="fas fa-location-dot"></i></span><div><small>Address</small><span>{!! nl2br(e($contact->address)) !!}</span></div></li>
              @endif
              @if(!empty($contact->mobile))
              <li><span class="ico"><i class="fas fa-mobile-screen"></i></span><div><small>Mobile</small><span>{!! nl2br(e($contact->mobile)) !!}</span></div></li>
              @endif
              @if(!empty($contact->hotline))
              <li><span class="ico"><i class="fas fa-headset"></i></span><div><small>Hotline</small><span>{!! nl2br(e($contact->hotline)) !!}</span></div></li>
              @endif
              @if(!empty($contact->phone))
              <li><span class="ico"><i class="fas fa-phone"></i></span><div><small>Phone</small><span>{!! nl2br(e($contact->phone)) !!}</span></div></li>
              @endif
              @if(!empty($contact->email))
              <li><span class="ico"><i class="fas fa-envelope"></i></span><div><small>Email</small><span>{!! nl2br(e($contact->email)) !!}</span></div></li>
              @endif
              @if(!empty($contact->skype))
              <li><span class="ico"><i class="fab fa-skype"></i></span><div><small>Skype</small><span>{!! nl2br(e($contact->skype)) !!}</span></div></li>
              @endif
            </ul>
          </div>
          @if(!empty($contact->map_url))
          <div class="map-embed">
            <iframe src="{{ $contact->map_url }}" title="{{ $contact->office_name }} location" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@include('frontend.partials.article')

@endsection
