{{-- Package price cards (same design on /bulk-sms-service and /bulk-sms-service/rate). Pair with frontend.partials.price_order for the Buy now modals. --}}
<div class="price-grid">
  @foreach($packages as $package)
  @php
    // Rows hold either a rate ("0.25 BDT") or a feature value ("Yes", "No", "Lifetime")
    $rates = $package->prices->map(function ($p) {
        return preg_match('/^\s*(\d+(?:\.\d+)?)/', $p->price, $m) && stripos($p->price, 'bdt') !== false ? (float) $m[1] : null;
    })->filter();
  @endphp
  <div class="price-card {{ $loop->first ? 'price-card--featured' : '' }}" data-reveal>
    @if($loop->first)
    <span class="price-card__badge"><i class="fas fa-star"></i> Most popular</span>
    @endif
    <h3 class="price-card__name">{{ $package->package_name }}</h3>
    @if($rates->count())
    <span class="price-card__from">Starting from</span>
    <div class="price-card__amount">
      <span class="cur">৳</span>
      <span class="num">{{ rtrim(rtrim(number_format($rates->min(), 2), '0'), '.') }}</span>
      <span class="per">/ SMS</span>
    </div>
    @endif
    <ul class="price-card__list">
      @foreach($package->prices as $price)
      @php $val = strtolower(trim($price->price)); @endphp
      <li class="{{ $val === 'no' ? 'is-off' : '' }}">
        <span><i class="fas {{ $val === 'no' ? 'fa-xmark' : 'fa-check' }}"></i> {{ $price->sms_type }}</span>
        @if($val === 'yes')
          <strong class="text-brand"><i class="fas fa-circle-check"></i><span class="visually-hidden">Yes</span></strong>
        @elseif($val === 'no')
          <strong class="text-muted-f">—<span class="visually-hidden">No</span></strong>
        @else
          <strong>{{ $price->price }}</strong>
        @endif
      </li>
      @endforeach
    </ul>
    <button type="button" class="btn-f {{ $loop->first ? 'btn-f--primary' : 'btn-f--dark' }} btn-f--block" data-toggle="modal" data-target="#buyPack{{ $package->id }}">
      Buy now <i class="fas fa-arrow-right"></i>
    </button>
  </div>
  @endforeach
</div>

<div class="price-note">
  <span><i class="fas fa-shield-halved"></i>Phone-verified ordering</span>
  <span><i class="fas fa-bolt"></i>Fast account activation</span>
  <span><i class="fas fa-code"></i>API included</span>
  <span><i class="fas fa-headset"></i>24/7 support</span>
</div>
