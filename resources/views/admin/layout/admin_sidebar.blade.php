<!--sidebar-menu-->
<?php $url = url()->current(); ?>
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if (preg_match("/dashboard/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Home Page</span><span class="label label-important">10</span></a>
      <ul <?php if (preg_match("/_slider|_sms_offer|_marketing_image|_sms_marketing_benefits|_why_choose_us/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_slider/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_slider')}}">Add Slider Image</a></li>
        <li <?php if (preg_match("/view_slider/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_slider')}}">View Slider Image</a></li>
        <hr>
        <li <?php if (preg_match("/add_sms_offer/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_sms_offer')}}">Add Bulk SMS Offer</a></li>
        <li <?php if (preg_match("/view_sms_offer/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_sms_offer')}}">View Bulk SMS Offer</a></li>
        <hr>
        <li <?php if (preg_match("/add_marketing_image/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_marketing_image')}}">Add Marketing Title/Image</a></li>
        <li <?php if (preg_match("/view_marketing_image/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_marketing_image')}}">View Marketing Title/Image</a></li>
        <li <?php if (preg_match("/add_sms_marketing_benefits/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_sms_marketing_benefits')}}">Add SMS Marketing Benefits</a></li>
        <li <?php if (preg_match("/view_sms_marketing_benefits/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_sms_marketing_benefits')}}">View SMS Marketing Benefits</a></li>
        <hr>
        <li <?php if (preg_match("/add_why_choose_us/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_why_choose_us')}}">Add Why Choose Us</a></li>
        <li <?php if (preg_match("/view_why_choose_us/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_why_choose_us')}}">View Why Choose Us</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Price Page</span><span class="label label-important">6</span></a>
      <ul <?php if (preg_match("/_price_header_info|_package|_price_info/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_price_header_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_price_header_info')}}">Add Price Header Info</a></li>
        <li <?php if (preg_match("/view_price_header_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_price_header_info')}}">View Price Header Info</a></li>
        <hr>
        <li <?php if (preg_match("/add_package/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_package')}}">Add Package</a></li>
        <li <?php if (preg_match("/view_package/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_package')}}">View Package</a></li>
        <hr>
        <li <?php if (preg_match("/add_price_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_price_info')}}">Add Price Info</a></li>
        <li <?php if (preg_match("/view_price_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_price_info')}}">View Price Info</a></li>
      </ul>
    </li>
<li class="submenu"> 
    <a href="#"><i class="icon icon-shopping-cart"></i> <span>Orders</span><span class="label label-important">2</span></a>
    <ul <?php if (preg_match("/_order/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/view_order/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_order')}}">View Orders</a></li>
    </ul>
</li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Terms & Condition Page</span><span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/_terms/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_terms/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_terms')}}">Add Terms & Condition</a></li>
        <li <?php if (preg_match("/view_terms/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_terms')}}">View Terms & Condition</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>SEO Page</span><span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/_seo_info/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_seo_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_seo_info')}}">Add SEO Info</a></li>
        <li <?php if (preg_match("/view_seo_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_seo_info')}}">View SEO Info</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Article</span><span class="label label-important">2</span></a>
  <ul <?php if (preg_match("/_article/i", $url)) {?> style="display:block;"<?php } ?>>
    <li <?php if (preg_match("/add_article/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_article')}}">Add Article</a></li>
    <li <?php if (preg_match("/view_article/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_article')}}">View Article</a></li>
  </ul>
</li>
    
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Content Page</span><span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/_content_info/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_content_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_content_info')}}">Add Content Info</a></li>
        <li <?php if (preg_match("/view_content_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_content_info')}}">View Content Info</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>FB Marketing Page</span><span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/_fb_marketing_info/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_fb_marketing_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_fb_marketing_info')}}">Add FB Marketing Info</a></li>
        <li <?php if (preg_match("/view_fb_marketing_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_fb_marketing_info')}}">View FB Marketing Info</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Flexi Load Page</span><span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/_flexi_info/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_flexi_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_flexi_info')}}">Add Flexi Load Info</a></li>
        <li <?php if (preg_match("/view_flexi_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_flexi_info')}}">View Flexi Load Info</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Contact Page</span><span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/_contact_info/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_contact_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_contact_info')}}">Add Contact Info</a></li>
        <li <?php if (preg_match("/view_contact_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_contact_info')}}">View Contact Info</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Facilities</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/_facilities/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_facilities/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_facilities')}}">Add Facilitie</a></li>
        <li <?php if (preg_match("/view_facilities/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_facilities')}}">View Facilities</a></li>
      </ul>
    </li>
<li class="submenu"> 
    <a href="#"><i class="icon icon-money"></i> <span>Payments</span> <span class="label label-important">2</span></a>
    <ul <?php if (preg_match("/_payment/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_payment/i", $url)) {?> class="active"<?php } ?>>
            <a href="{{url('/admin/add_payment')}}">Add Payment</a>
        </li>
        <li <?php if (preg_match("/view_payments/i", $url)) {?> class="active"<?php } ?>>
            <a href="{{url('/admin/view_payments')}}">View Payments</a>
        </li>
    </ul>
</li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Customer Support</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/_customer_support_info/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_customer_support_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_customer_support_info')}}">Add Customer Support Info</a></li>
        <li <?php if (preg_match("/view_customer_support_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_customer_support_info')}}">View Customer Support Info</a></li>
      </ul>
    </li>

    <hr><hr>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Special Offer</span><span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/_special_offer/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_special_offer/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_special_offer')}}">Add Special Offer</a></li>
        <li <?php if (preg_match("/view_special_offer/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_special_offer')}}">View Special Offer</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Footer Links</span><span class="label label-important">4</span></a>
      <ul <?php if (preg_match("/_parent_link|_footer_link/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_parent_link/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_parent_link')}}">Add Parent Link</a></li>
        <li <?php if (preg_match("/view_parent_link/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_parent_link')}}">View Parent Link</a></li>
        <hr>
        <li <?php if (preg_match("/add_footer_link/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_footer_link')}}">Add Footer Link</a></li>
        <li <?php if (preg_match("/view_footer_link/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_footer_link')}}">View Footer Link</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Navbar</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/_nav/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_nav/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_nav')}}">Add Nav Item</a></li>
        <li <?php if (preg_match("/view_nav/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_nav')}}">View Nav Item</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Header Contact Info</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/_header_contact_info/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_header_contact_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_header_contact_info')}}">Add Contact Info</a></li>
        <li <?php if (preg_match("/view_header_contact_info/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_header_contact_info')}}">View Contact Info</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Meta Tags</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/_meta_tag/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_meta_tag/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_meta_tag')}}">Add Meta Tag</a></li>
        <li <?php if (preg_match("/view_meta_tag/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_meta_tag')}}">View Meta Tag</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Logo</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/_logo/i", $url)) {?> style="display:block;"<?php } ?>>
        <li <?php if (preg_match("/add_logo/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/add_logo')}}">Add Logo</a></li>
        <li <?php if (preg_match("/view_logo/i", $url)) {?> class="active"<?php } ?>><a href="{{url('/admin/view_logo')}}">View Logo</a></li>
      </ul>
    </li>
</div>
<!--sidebar-menu-->
