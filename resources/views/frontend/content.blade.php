@extends('frontend.layout.frontend_master')
<?php use App\Support\Img; ?>
@section('content')

<section class="hero pb-5" aria-labelledby="content-title">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-left">
        <span class="eyebrow"><i class="fas fa-pen-nib"></i> Content creation</span>
        <h1 class="hero__title" id="content-title" style="font-size:clamp(2rem,1.3rem + 2.6vw,3.2rem)">{{ $content->title }}</h1>
        <p class="hero__lead ml-lg-0">Creative content that tells your story and drives results.</p>
        <div class="hero__actions justify-content-lg-start mb-0">
          <button type="button" class="btn-f btn-f--primary btn-f--lg" data-toggle="modal" data-target="#contactModal">Get in touch <i class="fas fa-arrow-right"></i></button>
          <a href="#main-content" class="btn-f btn-f--outline btn-f--lg">Explore <i class="fas fa-arrow-down"></i></a>
        </div>
      </div>
      <div class="col-lg-6">
        @if(!empty($content->image))
        <div class="media-frame media-frame--offset">
          {!! Img::tag('asset/images/'.$content->image, $content->title, ['loading' => 'eager', 'fetchpriority' => 'high']) !!}
        </div>
        @endif
      </div>
    </div>
  </div>
</section>

<section class="section section--muted" id="main-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10">
        <article class="article-card">
          <h2 class="article-card__title mb-2 pb-0 border-0">{{ $content->title }}</h2>
          <p class="text-muted-f mb-4 pb-3" style="border-bottom:1px solid var(--line-soft)">
            <i class="far fa-calendar"></i>
            Updated {{ $content->updated_at ? $content->updated_at->format('F d, Y') : date('F d, Y') }}
          </p>
          <div class="prose">{!! $content->description !!}</div>
        </article>
      </div>
    </div>
  </div>
</section>

@include('frontend.partials.article')

<section class="section section--tight">
  <div class="container">
    <div class="cta-band" data-reveal>
      <div class="cta-band__row">
        <div style="max-width:620px">
          <h2>Ready to elevate your content strategy?</h2>
          <p>Let's create content that tells your story and engages your audience.</p>
        </div>
        <div class="cta-band__actions">
          <button type="button" class="btn-f btn-f--light btn-f--lg" data-toggle="modal" data-target="#contactModal">Get in touch <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('modals')
@include('frontend.partials.lead_modal', [
  'id' => 'contactModal',
  'title' => 'Contact us',
  'subtitle' => "We'll get back to you within 24 hours",
  'icon' => 'fas fa-envelope',
  'textLabel' => 'Your message',
  'textPlaceholder' => 'Tell us about your content needs...',
  'textIcon' => 'fas fa-comment',
  'multiline' => true,
  'submitLabel' => 'Send message',
])
@endpush
