<?php
  use App\Model\Facility;
  use App\Model\Logo;
  use App\Model\CustomerSupport;
  use App\Model\HeaderContact;
  use App\Support\Img;
  $facilities = Facility::facility();
  $support = CustomerSupport::support();
  $siteContact = HeaderContact::contact();
  $logo = Logo::logo();
  $faviconFile = !empty($logo->logo) ? $logo->logo : (!empty($logo->logo_text) ? $logo->logo_text : 'logo.png');
?>
<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $seoTitle ?? ($metaTag->meta_title ?? config('app.name')) }}</title>

{{-- Connect early to the CDNs used below --}}
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link rel="icon" type="image/png" href="{{ asset('asset/images/logo_img/' . $faviconFile) }}">
<link rel="apple-touch-icon" href="{{ asset('asset/images/logo_img/' . $faviconFile) }}">
<link rel="canonical" href="{{ url()->current() }}">
<meta name="theme-color" content="#047857">
<meta property="og:image" content="{{ !empty($metaTag->meta_image) ? asset('asset/images/hidden/'.$metaTag->meta_image) : asset('asset/images/logo_img/logo.png') }}"/>
<meta property="og:image:secure_url" content="{{ !empty($metaTag->meta_image) ? asset('asset/images/hidden/'.$metaTag->meta_image) : asset('asset/images/logo_img/logo.png') }}"/>
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="Felna Digital Marketing Agency" />
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="{{ $ogImageUrl ?? asset('asset/images/logo_img/logo.png') }}"/>
<meta property="og:image:alt" content="{{ $siteTitle ?? config('app.name') }}"/>
<meta name="robots" content="ALL"/>
@if(!empty($googleSiteVerification))
<meta name="google-site-verification" content="{{ $googleSiteVerification }}" />
@endif
@if(!empty($pinterestVerification))
<meta name="p:domain_verify" content="{{ $pinterestVerification }}"/>
@endif
<meta name="author" content="IGL Web Ltd, IGL Group — www.iglweb.com" />
@if(!empty($metaTag->meta_keywords))
<meta name="keywords" content="{{ $metaTag->meta_keywords }}" />
@endif
<meta property="og:title" content="{{ $metaTag->meta_title ?? ($seoTitle ?? config('app.name')) }}"/>
<meta itemprop="image" content="{{ $ogImageUrl ?? asset('asset/images/logo_img/logo.png') }}"/>
@if(!empty($metaTag->meta_description))
<meta name="description" content="{{ $metaTag->meta_description }}" />
@endif
<meta property="og:description" content="{{ $metaTag->meta_description ?? '' }}" />
@if(!empty($metaTag->meta_tags))
<meta name="tag" content="{{ $metaTag->meta_tags }}" />
@endif

{{-- Page-specific preloads (e.g. the hero image) --}}
@stack('preload')

{{-- Render-critical CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('asset/css/public/felna.css') }}?v={{ @filemtime(base_path('asset/css/public/felna.css')) }}">

{{-- Fonts & icons load without blocking the first paint --}}
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" media="print" onload="this.media='all'">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" media="print" onload="this.media='all'">
<noscript>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</noscript>

@stack('styles')
</head>

<body>
    <a class="skip-link" href="#main">Skip to content</a>

    @include('frontend.layout.frontend_header')

    <main id="main">
        @yield('content')

        {{-- Facilities --}}
        @if(count($facilities))
        <section class="section section--muted" aria-labelledby="facilities-title">
            <div class="container">
                <div class="section-head" data-reveal>
                    <span class="eyebrow"><i class="fas fa-layer-group"></i> Facilities</span>
                    <h2 class="section-title" id="facilities-title">Everything you need to <span class="hl">reach customers</span></h2>
                    <p class="section-lead">Built-in tools and services that come with every Felna DMA account.</p>
                </div>
                <div class="card-grid card-grid--2">
                    @foreach($facilities as $facility)
                    <div class="f-card feature-row" data-reveal>
                        <div class="icon-tile icon-tile--lg">
                            {!! Img::tag('asset/images/facilities/'.$facility->image, '', ['width' => 46, 'height' => 46]) !!}
                        </div>
                        <div>
                            <h3>{{ $facility->title }}</h3>
                            <p>{{ $facility->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- Dedicated support --}}
        @if($support)
        <section class="section section--tight" aria-labelledby="support-title">
            <div class="container">
                <div class="cta-band" data-reveal>
                    @if(!empty($support->image))
                    <div class="cta-band__bg" aria-hidden="true">
                        {!! Img::tag('asset/images/support/'.$support->image, '') !!}
                    </div>
                    @endif
                    <div class="cta-band__row">
                        <div style="max-width: 620px;">
                            <span class="eyebrow eyebrow--light"><i class="fas fa-headset"></i> We're here to help</span>
                            <h2 id="support-title">{{ $support->title }}</h2>
                            <p>{{ $support->description }}</p>
                        </div>
                        <div class="cta-band__actions">
                            <a class="phone-big" href="tel:{{ preg_replace('/[^0-9+]/', '', $support->phone) }}">
                                <i class="fas fa-phone-alt"></i> {{ $support->phone }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </main>

    @include('frontend.layout.frontend_footer')

    @stack('modals')

    @if(!empty($siteContact->phone))
    <a class="fab-call" href="tel:{{ preg_replace('/[^0-9+]/', '', $siteContact->phone) }}" aria-label="Call us now"><i class="fas fa-phone-alt"></i></a>
    @endif

    {{-- Scripts: loaded once, at the end, so content paints first --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('asset/js/public/felna.js') }}?v={{ @filemtime(base_path('asset/js/public/felna.js')) }}"></script>
    @stack('scripts')

    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11"])
</body>

</html>
