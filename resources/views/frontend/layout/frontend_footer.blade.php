<?php
  use App\Model\ParentLink;
  use App\Model\Logo;
  use App\Model\HeaderContact;
  use App\Support\Img;
  $parent_links = ParentLink::parent_links();
  $footerLogo = Logo::logo();
  $footerContact = HeaderContact::contact();
  $footerLogoFile = !empty($footerLogo->logo) ? $footerLogo->logo : (!empty($footerLogo->logo_text) ? $footerLogo->logo_text : null);
?>
<footer class="site-footer">
  <div class="footer-main">
    <div class="container">
      <div class="footer-grid" style="--cols: {{ max(1, count($parent_links)) }}">
        <div class="footer-brand">
          <a class="brand" href="{{ url('/') }}" aria-label="Felna DMA home">
            @if($footerLogoFile)
              {!! Img::tag('asset/images/logo_img/'.$footerLogoFile, 'Felna DMA logo', ['style' => 'height:46px;width:auto;']) !!}
            @else
              <span class="brand__text">Felna<span>DMA</span></span>
            @endif
          </a>
          <p>Bulk SMS, OTP, masking &amp; non-masking SMS and digital marketing services for businesses across Bangladesh.</p>
          <div class="footer-contact">
            @if(!empty($footerContact->phone))
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $footerContact->phone) }}"><i class="fas fa-phone-alt"></i> {{ $footerContact->phone }}</a>
            @endif
            @if(!empty($footerContact->email))
            <a href="mailto:{{ $footerContact->email }}"><i class="fas fa-envelope"></i> {{ $footerContact->email }}</a>
            @endif
          </div>
        </div>

        @foreach($parent_links as $parent)
        <div class="footer-col">
          <h3>{{ $parent->title }}</h3>
          <ul>
            @foreach($parent->footerLinks as $link)
            <li><a target="_blank" rel="noopener" href="{{ $link->url }}">{{ $link->title }}</a></li>
            @endforeach
          </ul>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container">
      <p class="mb-0">&copy; {{ date('Y') }} All rights reserved by <a href="https://iglgroup.org" target="_blank" rel="noopener">IGL Group</a></p>
      <p class="mb-0 footer-credits">
        <span>Domain registration by <a href="https://iglweb.com/web/domains-services.php" target="_blank" rel="noopener">IGL Web Ltd.</a></span>
        <span>Web hosting by <a href="https://iglweb.com/web/hosting-regular-shared.php" target="_blank" rel="noopener">IGL Web Ltd.</a></span>
        <span>Design &amp; development by <a href="https://iglweb.com/web/web-development.php" target="_blank" rel="noopener">IGL Web Ltd.</a></span>
      </p>
    </div>
  </div>
</footer>

{{-- Tawk.to live chat — loaded after the page is ready so it never slows the first paint --}}
<script>
  window.addEventListener('load', function () {
    setTimeout(function () {
      window.Tawk_API = window.Tawk_API || {}; window.Tawk_LoadStart = new Date();
      var s1 = document.createElement('script'), s0 = document.getElementsByTagName('script')[0];
      s1.async = true;
      s1.src = 'https://embed.tawk.to/58ac8e5ada22730aacd02d82/1gkus7v64';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    }, 2500);
  });
</script>
