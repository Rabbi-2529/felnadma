{{-- Card links to the SMS Services sub-pages. Usage: @include('frontend.partials.sms_service_links', ['links' => $links, 'title' => '...', 'muted' => true]) --}}
@if(isset($links) && count($links))
<section class="section {{ !empty($muted) ? 'section--muted' : '' }}" aria-labelledby="sms-services-title">
  <div class="container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><i class="fas fa-comment-sms"></i> SMS services</span>
      <h2 class="section-title" id="sms-services-title">{!! $title ?? 'Our <span class="hl">SMS services</span>' !!}</h2>
      @if(!empty($lead))
      <p class="section-lead">{{ $lead }}</p>
      @endif
    </div>
    <div class="card-grid service-links">
      @foreach($links as $link)
      <a class="f-card service-link" href="{{ $link->url }}" data-reveal>
        @if(!empty($link->icon_image) || !empty($link->icon_class))
        <span class="icon-tile">@include('frontend.partials.sms_service_icon', ['link' => $link, 'size' => 38])</span>
        @endif
        <h3>{{ $link->title }}</h3>
        @if(!empty($link->summary))
        <p>{{ $link->summary }}</p>
        @endif
        <span class="service-link__more">Learn more <i class="fas fa-arrow-right"></i></span>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif
