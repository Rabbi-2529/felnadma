<?php
  use App\Model\Logo;
  use App\Model\Navbar;
  use App\Model\HeaderContact;
  use App\Model\SmsServicePage;
  use App\Support\Img;
  $logo = Logo::logo();
  $contact = HeaderContact::contact();
  $navbar = Navbar::navbar();
  $smsLinks = SmsServicePage::links();
  $currentPath = '/' . trim(request()->path(), '/');
  $logoFile = !empty($logo->logo) ? $logo->logo : (!empty($logo->logo_text) ? $logo->logo_text : null);
  $phoneHref = !empty($contact->phone) ? preg_replace('/[^0-9+]/', '', $contact->phone) : null;
?>
<div class="topbar">
  <div class="container">
    <div class="topbar__links">
      @if(!empty($contact->phone))
      <a href="tel:{{ $phoneHref }}"><i class="fas fa-phone-alt"></i> {{ $contact->phone }}</a>
      @endif
      @if(!empty($contact->email))
      <a href="mailto:{{ $contact->email }}" class="d-none d-sm-inline-flex"><i class="fas fa-envelope"></i> {{ $contact->email }}</a>
      @endif
    </div>
    <div class="topbar__note d-none d-md-inline-flex"><span class="topbar__dot"></span> Support online 24/7</div>
  </div>
</div>

<header class="site-header" id="siteHeader">
  <div class="container">
    <a class="brand" href="{{ url('/') }}" aria-label="Felna DMA home">
      @if($logoFile)
        {!! Img::tag('asset/images/logo_img/'.$logoFile, 'Felna DMA logo', ['loading' => 'eager', 'fetchpriority' => 'high', 'style' => 'height:auto;max-height:48px;width:auto;']) !!}
      @else
        <span class="brand__text">Felna<span>DMA</span></span>
      @endif
    </a>

    <nav class="nav-main" id="navMain" aria-label="Main navigation">
      <ul>
        <li><a class="{{ $currentPath === '/' ? 'is-active' : '' }}" href="{{ url('/') }}" @if($currentPath === '/') aria-current="page" @endif>Home</a></li>
        @foreach($navbar as $nav)
          @if($nav->nav_route != '/')
            @php $navPath = '/' . trim(strtolower($nav->nav_route), '/'); @endphp
            @if($navPath === '/bulk-sms-service')
            {{-- SMS Services: parent keeps its own URL, sub-pages open from the dropdown --}}
            @php $inSms = $currentPath === $navPath || strpos($currentPath, $navPath.'/') === 0; @endphp
            <li class="has-sub">
              <a class="{{ $inSms ? 'is-active' : '' }}" href="{{ url($navPath) }}" @if($currentPath === $navPath) aria-current="page" @endif>{{ $nav->nav_item }}</a>
              <button type="button" class="sub-toggle" aria-expanded="false" aria-controls="smsSubmenu" aria-label="Show {{ $nav->nav_item }} pages"><i class="fas fa-chevron-down" aria-hidden="true"></i></button>
              <ul class="nav-sub" id="smsSubmenu">
                <li><a class="{{ $currentPath === $navPath ? 'is-active' : '' }}" href="{{ url($navPath) }}"><span class="nav-sub__ico"><i class="fas fa-box-open" aria-hidden="true"></i></span> SMS Packages</a></li>
                @foreach($smsLinks as $link)
                <li><a class="{{ $currentPath === $link->path ? 'is-active' : '' }}" href="{{ $link->url }}" @if($currentPath === $link->path) aria-current="page" @endif>
                  @if(!empty($link->icon_image) || !empty($link->icon_class))
                  <span class="nav-sub__ico">@include('frontend.partials.sms_service_icon', ['link' => $link, 'size' => 18])</span>
                  @endif
                  {{ $link->title }}
                </a></li>
                @endforeach
              </ul>
            </li>
            @else
            <li><a class="{{ $currentPath === $navPath ? 'is-active' : '' }}" href="{{ url(strtolower($nav->nav_route)) }}" @if($currentPath === $navPath) aria-current="page" @endif>{{ $nav->nav_item }}</a></li>
            @endif
          @endif
        @endforeach
      </ul>
      <div class="nav-main__cta">
        <button type="button" class="btn-f btn-f--accent btn-f--block" data-toggle="modal" data-target="#callRequ"><i class="fas fa-headset"></i> Request a Call</button>
        @if($phoneHref)
        <a class="btn-f btn-f--outline btn-f--block" href="tel:{{ $phoneHref }}"><i class="fas fa-phone-alt"></i> {{ $contact->phone }}</a>
        @endif
      </div>
    </nav>

    <div class="header-cta">
      <button type="button" class="btn-f btn-f--accent btn-f--sm" data-toggle="modal" data-target="#callRequ"><i class="fas fa-headset"></i> Request a Call</button>
    </div>

    <button class="nav-toggle" type="button" aria-controls="navMain" aria-expanded="false" aria-label="Open menu">
      <span class="nav-toggle__bars"></span>
    </button>
  </div>
</header>

@push('modals')
<!-- Call Request Modal -->
<div class="modal fade modal-f" id="callRequ" tabindex="-1" role="dialog" aria-labelledby="callRequTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="ico"><i class="fas fa-phone-alt"></i></div>
        <div>
          <h4 class="modal-title" id="callRequTitle">Request a Call</h4>
          <p class="modal-sub">We'll call you back within 24 hours</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form method="post" action="{{ url('/call_request') }}" id="callRequestForm" novalidate>
        @csrf
        <div class="modal-body">
          <div class="field" data-field="phone">
            <label for="cr_phone">Phone number <span class="req">*</span></label>
            <div class="input-icon">
              <input type="tel" class="form-control" name="client_phone" id="cr_phone" inputmode="numeric" autocomplete="tel"
                     placeholder="01XXXXXXXXX" pattern="01[3-9][0-9]{8}" maxlength="11" required>
              <i class="fas fa-mobile-alt"></i>
            </div>
            <div class="field-error">Enter a valid 11-digit Bangladeshi number (01XXXXXXXXX).</div>
          </div>

          <label class="switch-row" for="cr_whatsapp">
            <span class="switch-row__label">
              <span class="wa"><i class="fab fa-whatsapp"></i></span>
              <span><strong>WhatsApp available</strong><small>This number is on WhatsApp</small></span>
            </span>
            <span class="switch">
              <input type="hidden" name="whatsapp_available" value="0">
              <input type="checkbox" name="whatsapp_available" id="cr_whatsapp" value="1">
              <span></span>
            </span>
          </label>

          <div class="field" data-field="name">
            <label for="cr_name">Full name <span class="req">*</span></label>
            <div class="input-icon">
              <input type="text" class="form-control" name="client_name" id="cr_name" autocomplete="name"
                     placeholder="Your full name" maxlength="30" required>
              <i class="fas fa-user"></i>
            </div>
            <div class="field-error">Please enter your name (at least 3 characters).</div>
          </div>

          <div class="field" data-field="reason">
            <label for="cr_reason">Reason for contact <span class="req">*</span></label>
            <select class="form-control" name="request_reason" id="cr_reason" required>
              <option value="">Select a reason</option>
              @foreach($navbar as $nav)
                @if(!empty($nav->nav_item) && strtolower($nav->nav_item) != 'home' && strtolower($nav->nav_item) != 'contact')
                  <option value="{{ strtolower($nav->nav_item) }}">{{ $nav->nav_item }}</option>
                @endif
              @endforeach
              <option value="general_inquiry">General Inquiry</option>
              <option value="technical_support">Technical Support</option>
              <option value="billing">Billing / Payment</option>
            </select>
            <div class="field-error">Please choose a reason.</div>
          </div>

          <div class="field mb-0">
            <div class="d-flex justify-content-between align-items-center">
              <label for="cr_details" class="field-label mb-1">Additional details</label>
              <span class="counter-pill" id="cr_counter">0 / 70</span>
            </div>
            <textarea class="form-control" name="client_details" id="cr_details" rows="3" maxlength="70"
                      placeholder="Anything we should know? (English only, max 70 characters)"></textarea>
            <span class="field-hint" id="cr_details_hint"><i class="fas fa-info-circle"></i> English letters, numbers and basic punctuation only.</span>
          </div>

          <div class="trust-inline">
            <span><i class="fas fa-lock"></i>Secure &amp; confidential</span>
            <span><i class="fas fa-clock"></i>Reply within 24h</span>
            <span><i class="fas fa-headset"></i>24/7 support</span>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-f btn-f--outline btn-f--sm" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-f btn-f--accent btn-f--sm"><i class="fas fa-paper-plane"></i> Send Request</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endpush
