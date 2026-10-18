<?php
  // Sidebar menu. 'match' is a regex on the current path that marks a section active/open.
  $faPath = request()->path();
  $faMenu = [
    'Overview' => [
      ['label' => 'Dashboard', 'icon' => 'fa-gauge-high', 'url' => '/admin/dashboard', 'match' => '/dashboard/'],
      ['label' => 'Orders', 'icon' => 'fa-cart-shopping', 'url' => '/admin/view_order', 'match' => '/_order|order_details|filter_orders/', 'badge' => $faPendingOrders ?? 0],
    ],
    'Bulk SMS' => [
      ['label' => 'Packages & Prices', 'icon' => 'fa-tags', 'match' => '/_price_header_info|_package|_price_info/', 'links' => [
        ['Price Header Info', '/admin/view_price_header_info'], ['Add Price Header', '/admin/add_price_header_info'],
        ['Packages', '/admin/view_package'], ['Add Package', '/admin/add_package'],
        ['Price Info', '/admin/view_price_info'], ['Add Price Info', '/admin/add_price_info'],
      ]],
      ['label' => 'SMS Service Pages', 'icon' => 'fa-comment-sms', 'match' => '/_sms_service_page/', 'links' => [
        ['All Pages', '/admin/view_sms_service_page'], ['Add Page', '/admin/add_sms_service_page'],
      ]],
      ['label' => 'Special Offer', 'icon' => 'fa-gift', 'match' => '/_special_offer|active_offer/', 'links' => [
        ['All Offers', '/admin/view_special_offer'], ['Add Offer', '/admin/add_special_offer'],
      ]],
      ['label' => 'Home Page', 'icon' => 'fa-house', 'match' => '/_slider|_sms_offer|_marketing_image|_sms_marketing_benefits|_why_choose_us/', 'links' => [
        ['Slider Images', '/admin/view_slider'], ['Add Slider Image', '/admin/add_slider'],
        ['Bulk SMS Offer', '/admin/view_sms_offer'], ['Add SMS Offer', '/admin/add_sms_offer'],
        ['Marketing Title/Image', '/admin/view_marketing_image'], ['Add Marketing Image', '/admin/add_marketing_image'],
        ['Marketing Benefits', '/admin/view_sms_marketing_benefits'], ['Add Marketing Benefit', '/admin/add_sms_marketing_benefits'],
        ['Why Choose Us', '/admin/view_why_choose_us'], ['Add Why Choose Us', '/admin/add_why_choose_us'],
      ]],
    ],
    'Service Pages' => [
      ['label' => 'SEO Page', 'icon' => 'fa-magnifying-glass-chart', 'match' => '/_seo_info/', 'links' => [
        ['SEO Info', '/admin/view_seo_info'], ['Add SEO Info', '/admin/add_seo_info'],
      ]],
      ['label' => 'FB Marketing Page', 'icon' => 'fa-bullhorn', 'match' => '/_fb_marketing_info/', 'links' => [
        ['FB Marketing Info', '/admin/view_fb_marketing_info'], ['Add FB Marketing Info', '/admin/add_fb_marketing_info'],
      ]],
      ['label' => 'Flexi Load Page', 'icon' => 'fa-mobile-screen-button', 'match' => '/_flexi_info/', 'links' => [
        ['Flexi Load Info', '/admin/view_flexi_info'], ['Add Flexi Load Info', '/admin/add_flexi_info'],
      ]],
      ['label' => 'Content Page', 'icon' => 'fa-pen-nib', 'match' => '/_content_info/', 'links' => [
        ['Content Info', '/admin/view_content_info'], ['Add Content Info', '/admin/add_content_info'],
      ]],
      ['label' => 'Terms & Condition', 'icon' => 'fa-file-contract', 'match' => '/_terms/', 'links' => [
        ['Terms & Condition', '/admin/view_terms'], ['Add Terms', '/admin/add_terms'],
      ]],
      ['label' => 'Contact Page', 'icon' => 'fa-address-book', 'match' => '/_contact_info/', 'links' => [
        ['Contact Info', '/admin/view_contact_info'], ['Add Contact Info', '/admin/add_contact_info'],
      ]],
    ],
    'SEO & Content' => [
      ['label' => 'Meta Tags', 'icon' => 'fa-hashtag', 'match' => '/_meta_tag/', 'links' => [
        ['All Meta Tags', '/admin/view_meta_tag'], ['Add Meta Tag', '/admin/add_meta_tag'],
      ]],
      ['label' => 'Articles', 'icon' => 'fa-newspaper', 'match' => '/_article/', 'links' => [
        ['All Articles', '/admin/view_article'], ['Add Article', '/admin/add_article'],
      ]],
    ],
    'Website Settings' => [
      ['label' => 'Logo', 'icon' => 'fa-image', 'match' => '/_logo/', 'links' => [
        ['Logo', '/admin/view_logo'], ['Add Logo', '/admin/add_logo'],
      ]],
      ['label' => 'Navbar', 'icon' => 'fa-bars-staggered', 'match' => '/_nav\b/', 'links' => [
        ['Nav Items', '/admin/view_nav'], ['Add Nav Item', '/admin/add_nav'],
      ]],
      ['label' => 'Header Contact', 'icon' => 'fa-phone', 'match' => '/_header_contact_info/', 'links' => [
        ['Header Contact', '/admin/view_header_contact_info'], ['Add Header Contact', '/admin/add_header_contact_info'],
      ]],
      ['label' => 'Footer Links', 'icon' => 'fa-link', 'match' => '/_parent_link|_footer_link/', 'links' => [
        ['Parent Links', '/admin/view_parent_link'], ['Add Parent Link', '/admin/add_parent_link'],
        ['Footer Links', '/admin/view_footer_link'], ['Add Footer Link', '/admin/add_footer_link'],
      ]],
      ['label' => 'Facilities', 'icon' => 'fa-layer-group', 'match' => '/_facilities/', 'links' => [
        ['Facilities', '/admin/view_facilities'], ['Add Facility', '/admin/add_facilities'],
      ]],
      ['label' => 'Customer Support', 'icon' => 'fa-headset', 'match' => '/_customer_support_info/', 'links' => [
        ['Support Info', '/admin/view_customer_support_info'], ['Add Support Info', '/admin/add_customer_support_info'],
      ]],
      ['label' => 'Payments', 'icon' => 'fa-building-columns', 'match' => '/_payment/', 'links' => [
        ['Payment Methods', '/admin/view_payments'], ['Add Payment', '/admin/add_payment'],
      ]],
      ['label' => 'Settings', 'icon' => 'fa-gear', 'url' => '/admin/settings', 'match' => '/admin\/settings/'],
    ],
  ];
?>
<!--sidebar-menu-->
<aside class="fa-sidebar" id="faSidebar" aria-label="Admin navigation">
  <a class="fa-brand" href="{{ url('/admin/dashboard') }}">
    <span class="fa-brand__mark"><i class="fa-solid fa-comment-sms"></i></span>
    <span class="fa-brand__text"><strong>Felna SMS</strong><small>Admin panel</small></span>
  </a>

  <nav class="fa-nav">
    @foreach($faMenu as $faGroup => $faItems)
      <div class="fa-nav__label">{{ $faGroup }}</div>
      <ul>
        @foreach($faItems as $faItem)
          @php $faActive = preg_match($faItem['match'], $faPath); @endphp
          <li class="fa-nav__item {{ $faActive ? 'is-active' : '' }} {{ $faActive && !empty($faItem['links']) ? 'is-open' : '' }}">
            @if(!empty($faItem['links']))
              <button type="button" class="fa-nav__toggle" aria-expanded="{{ $faActive ? 'true' : 'false' }}">
                <i class="fa-solid {{ $faItem['icon'] }} fa-nav__ico"></i>
                <span class="fa-nav__text">{{ $faItem['label'] }}</span>
                <i class="fa-solid fa-chevron-right fa-nav__chev"></i>
              </button>
              <ul class="fa-nav__sub">
                @foreach($faItem['links'] as [$faLabel, $faUrl])
                <li><a href="{{ url($faUrl) }}" class="{{ '/'.$faPath === $faUrl ? 'is-current' : '' }}">{{ $faLabel }}</a></li>
                @endforeach
              </ul>
            @else
              <a class="fa-nav__link" href="{{ url($faItem['url']) }}">
                <i class="fa-solid {{ $faItem['icon'] }} fa-nav__ico"></i>
                <span class="fa-nav__text">{{ $faItem['label'] }}</span>
                @if(!empty($faItem['badge']))
                <span class="fa-pill">{{ $faItem['badge'] > 99 ? '99+' : $faItem['badge'] }}</span>
                @endif
              </a>
            @endif
          </li>
        @endforeach
      </ul>
    @endforeach
  </nav>

  <div class="fa-side-foot">
    <a class="fa-side-card" href="{{ url('/bulk-sms-service') }}" target="_blank" rel="noopener">
      <i class="fa-solid fa-paper-plane"></i>
      <span><strong>Live pricing page</strong>See what customers see</span>
    </a>
  </div>
</aside>
<!--sidebar-menu-->
