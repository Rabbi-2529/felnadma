<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Admin Routes
Route::group(['middleware' => 'adminlogin'], function(){
  Route::get('/admin/dashboard', 'Admin\AdminController@dashboard');
  Route::get('/logout', 'Admin\AdminController@logout');
  Route::match(['get', 'post'], '/admin/settings', 'Admin\AdminController@settings');
  Route::get('/admin/check_pass', 'Admin\AdminController@check_pass');
  Route::match(['get', 'post'], '/admin/update_pass', 'Admin\AdminController@updatePass');
  //Meta tag Routes
  Route::match(['get', 'post'], '/admin/add_meta_tag', 'Admin\AdminController@addMeta');
  Route::get('/admin/view_meta_tag', 'Admin\AdminController@viewMeta');
  Route::match(['get', 'post'], '/admin/edit_meta_tag/{id}', 'Admin\AdminController@editMeta');
  Route::get('/admin/delete_meta_tag/{id}', 'Admin\AdminController@deleteMeta');
  
  // Article Routes
Route::match(['get', 'post'], '/admin/add_article', 'Admin\AdminController@addArticle');
Route::get('/admin/view_article', 'Admin\AdminController@viewArticle');
Route::match(['get', 'post'], '/admin/edit_article/{id}', 'Admin\AdminController@editArticle');
Route::get('/admin/delete_article/{id}', 'Admin\AdminController@deleteArticle');
  Route::get('/admin/view_order', 'Admin\OrderController@viewOrder');
  Route::get('/admin/order_details/{id}', 'Admin\OrderController@viewOrderDetails');
  Route::match(['get', 'post'], '/admin/update_order_status/{id}', 'Admin\OrderController@updateOrderStatus');
  Route::get('/admin/delete_order/{id}', 'Admin\OrderController@deleteOrder');
  Route::get('/admin/filter_orders', 'Admin\OrderController@filterOrders');
  Route::get('/admin/export_orders', 'Admin\OrderController@exportOrders');


  //Logo Routes
  Route::match(['get', 'post'], '/admin/add_logo', 'Admin\HeaderController@addLogo');
  Route::get('/admin/view_logo', 'Admin\HeaderController@viewLogo');
  Route::match(['get', 'post'], '/admin/edit_logo/{id}', 'Admin\HeaderController@editLogo');
  Route::get('/admin/delete_logo/{id}', 'Admin\HeaderController@deleteLogo');
  //Header Contact Info Routes
  Route::match(['get', 'post'], '/admin/add_header_contact_info', 'Admin\HeaderController@addHeaderContact');
  Route::get('/admin/view_header_contact_info', 'Admin\HeaderController@viewHeaderContact');
  Route::match(['get', 'post'], '/admin/edit_header_contact_info/{id}', 'Admin\HeaderController@editHeaderContact');
  Route::get('/admin/delete_header_contact_info/{id}', 'Admin\HeaderController@deleteHeaderContact');
  //Navbar Routes
  Route::match(['get', 'post'], '/admin/add_nav', 'Admin\HeaderController@addNav');
  Route::get('/admin/view_nav', 'Admin\HeaderController@viewNav');
  Route::match(['get', 'post'], '/admin/edit_nav/{id}', 'Admin\HeaderController@editNav');
  Route::get('/admin/delete_nav/{id}', 'Admin\HeaderController@deleteNav');
  //Slider Routes
  Route::match(['get', 'post'], '/admin/add_slider', 'Admin\HomepageController@addSlider');
  Route::get('/admin/view_slider', 'Admin\HomepageController@viewSlider');
  Route::match(['get', 'post'], '/admin/edit_slider/{id}', 'Admin\HomepageController@editSlider');
  Route::get('/admin/delete_slider/{id}', 'Admin\HomepageController@deleteSlider');
  //SMS Offer Routes
  Route::match(['get', 'post'], '/admin/add_sms_offer', 'Admin\HomepageController@addSmsOffer');
  Route::get('/admin/view_sms_offer', 'Admin\HomepageController@viewSmsOffer');
  Route::match(['get', 'post'], '/admin/edit_sms_offer/{id}', 'Admin\HomepageController@editSmsOffer');
  Route::get('/admin/delete_sms_offer/{id}', 'Admin\HomepageController@deleteSmsOffer');
  //Why Choose Us Routes
  Route::match(['get', 'post'], '/admin/add_why_choose_us', 'Admin\HomepageController@addWhyChooseUs');
  Route::get('/admin/view_why_choose_us', 'Admin\HomepageController@viewWhyChooseUs');
  Route::match(['get', 'post'], '/admin/edit_why_choose_us/{id}', 'Admin\HomepageController@editWhyChooseUs');
  Route::get('/admin/delete_why_choose_us/{id}', 'Admin\HomepageController@deleteWhyChooseUs');
  //Sms Marketing Benefits Routes
  Route::match(['get', 'post'], '/admin/add_marketing_image', 'Admin\HomepageController@addMarketingImage');
  Route::get('/admin/view_marketing_image', 'Admin\HomepageController@viewMarketingImage');
  Route::match(['get', 'post'], '/admin/edit_marketing_image/{id}', 'Admin\HomepageController@editMarketingImage');
  Route::get('/admin/delete_marketing_image/{id}', 'Admin\HomepageController@deleteMarketingImage');

  Route::match(['get', 'post'], '/admin/add_sms_marketing_benefits', 'Admin\HomepageController@addSmsMarketingBenefits');
  Route::get('/admin/view_sms_marketing_benefits', 'Admin\HomepageController@viewSmsMarketingBenefits');
  Route::match(['get', 'post'], '/admin/edit_sms_marketing_benefits/{id}', 'Admin\HomepageController@editSmsMarketingBenefits');
  Route::get('/admin/delete_sms_marketing_benefits/{id}', 'Admin\HomepageController@deleteSmsMarketingBenefits');

  //Facility Routes
  Route::match(['get', 'post'], '/admin/add_facilities', 'Admin\FacilityController@addFacility');
  Route::get('/admin/view_facilities', 'Admin\FacilityController@viewFacility');
  Route::match(['get', 'post'], '/admin/edit_facilities/{id}', 'Admin\FacilityController@editFacility');
  Route::get('/admin/delete_facilities/{id}', 'Admin\FacilityController@deleteFacility');
  
  
  Route::match(['get', 'post'], '/admin/add_payment', 'Admin\PaymentController@addPayment');
Route::get('/admin/view_payments', 'Admin\PaymentController@viewPayment');
Route::match(['get', 'post'], '/admin/edit_payment/{id}', 'Admin\PaymentController@editPayment');
Route::get('/admin/delete_payment/{id}', 'Admin\PaymentController@deletePayment');

  //Customer Support Info Routes
  Route::match(['get', 'post'], '/admin/add_customer_support_info', 'Admin\SupportController@addCustomerSupportInfo');
  Route::get('/admin/view_customer_support_info', 'Admin\SupportController@viewCustomerSupportInfo');
  Route::match(['get', 'post'], '/admin/edit_customer_support_info/{id}', 'Admin\SupportController@editCustomerSupportInfo');
  Route::get('/admin/delete_customer_support_info/{id}', 'Admin\SupportController@deleteCustomerSupportInfo');

  //Price Routes
  //Package Header
  Route::match(['get', 'post'], '/admin/add_package', 'Admin\PriceController@addPackage');
  Route::get('/admin/view_package', 'Admin\PriceController@viewPackage');
  Route::match(['get', 'post'], '/admin/edit_package/{id}', 'Admin\PriceController@editPackage');
  Route::get('/admin/delete_package/{id}', 'Admin\PriceController@deletePackage');
  //Price Header
  Route::match(['get', 'post'], '/admin/add_price_header_info', 'Admin\PriceController@addPriceHeaderInfo');
  Route::get('/admin/view_price_header_info', 'Admin\PriceController@viewPriceHeaderInfo');
  Route::match(['get', 'post'], '/admin/edit_price_header_info/{id}', 'Admin\PriceController@editPriceHeaderInfo');
  Route::get('/admin/delete_price_header_info/{id}', 'Admin\PriceController@deletePriceHeaderInfo');
  //Price
  //Price
  Route::match(['get', 'post'], '/admin/add_price_info', 'Admin\PriceController@addPriceInfo');
  Route::get('/admin/view_price_info', 'Admin\PriceController@viewPriceInfo');
  Route::get('/admin/view_single_price_info/{id}', 'Admin\PriceController@viewSinglePriceInfo');
  Route::match(['get', 'post'], '/admin/edit_price_info/{id}', 'Admin\PriceController@editPriceInfo');
  Route::match(['get', 'post'], '/admin/update_price_info/{id}', 'Admin\PriceController@updatePriceInfo');
  Route::get('/admin/delete_price_info/{id}', 'Admin\PriceController@deletePriceInfo');

  //SMS Service Page Routes (submenu pages under SMS Services)
  Route::match(['get', 'post'], '/admin/add_sms_service_page', 'Admin\SmsServicePageController@addSmsServicePage');
  Route::get('/admin/view_sms_service_page', 'Admin\SmsServicePageController@viewSmsServicePage');
  Route::match(['get', 'post'], '/admin/edit_sms_service_page/{id}', 'Admin\SmsServicePageController@editSmsServicePage');
  Route::get('/admin/delete_sms_service_page/{id}', 'Admin\SmsServicePageController@deleteSmsServicePage');

  //Terms Routes
  Route::match(['get', 'post'], '/admin/add_terms', 'Admin\TermsController@addTerms');
  Route::get('/admin/view_terms', 'Admin\TermsController@viewTerms');
  Route::match(['get', 'post'], '/admin/edit_terms/{id}', 'Admin\TermsController@editTerms');
  Route::get('/admin/delete_terms/{id}', 'Admin\TermsController@deleteTerms');


  //Special Offer Routes
  Route::match(['get', 'post'], '/admin/add_special_offer', 'Admin\AdminController@addSpecialOffer');
  Route::get('/admin/view_special_offer', 'Admin\AdminController@viewSpecialOffer');
  Route::match(['get', 'post'], '/admin/edit_special_offer/{id}', 'Admin\AdminController@editSpecialOffer');
  Route::get('/admin/delete_special_offer/{id}', 'Admin\AdminController@deleteSpecialOffer');
  Route::match(['get', 'post'], '/admin/active_offer/{id}', 'Admin\AdminController@activeOffer');
  Route::match(['get', 'post'], '/admin/deactive_offer/{id}', 'Admin\AdminController@deactiveOffer');

  //SEO Info Routes
  Route::match(['get', 'post'], '/admin/add_seo_info', 'Admin\AdminController@addSeoInfo');
  Route::get('/admin/view_seo_info', 'Admin\AdminController@viewSeoInfo');
  Route::match(['get', 'post'], '/admin/edit_seo_info/{id}', 'Admin\AdminController@editSeoInfo');
  Route::get('/admin/delete_seo_info/{id}', 'Admin\AdminController@deleteSeoInfo');
  
  
  
    //Content Info Routes
  Route::match(['get', 'post'], '/admin/add_content_info', 'Admin\AdminController@addContentInfo');
  Route::get('/admin/view_content_info', 'Admin\AdminController@viewContentInfo');
  Route::match(['get', 'post'], '/admin/edit_content_info/{id}', 'Admin\AdminController@editContentInfo');
  Route::get('/admin/delete_content_info/{id}', 'Admin\AdminController@deleteContentInfo');

  //FB Marketing Info Routes
  Route::match(['get', 'post'], '/admin/add_fb_marketing_info', 'Admin\AdminController@addFbMarketingInfo');
  Route::get('/admin/view_fb_marketing_info', 'Admin\AdminController@viewFbMarketingInfo');
  Route::match(['get', 'post'], '/admin/edit_fb_marketing_info/{id}', 'Admin\AdminController@editFbMarketingInfo');
  Route::get('/admin/delete_fb_marketing_info/{id}', 'Admin\AdminController@deleteFbMarketingInfo');

  //Flexi Info Routes
  Route::match(['get', 'post'], '/admin/add_flexi_info', 'Admin\AdminController@addFlexiInfo');
  Route::get('/admin/view_flexi_info', 'Admin\AdminController@viewFlexiInfo');
  Route::match(['get', 'post'], '/admin/edit_flexi_info/{id}', 'Admin\AdminController@editFlexiInfo');
  Route::get('/admin/delete_flexi_info/{id}', 'Admin\AdminController@deleteFlexiInfo');

  //Contact Info Routes
  Route::match(['get', 'post'], '/admin/add_contact_info', 'Admin\ContactController@addContactInfo');
  Route::get('/admin/view_contact_info', 'Admin\ContactController@viewContactInfo');
  Route::match(['get', 'post'], '/admin/edit_contact_info/{id}', 'Admin\ContactController@editContactInfo');
  Route::get('/admin/delete_contact_info/{id}', 'Admin\ContactController@deleteContactInfo');

  //Footer Link Routes
  //Parent Link
  Route::match(['get', 'post'], '/admin/add_parent_link', 'Admin\FooterController@addParentLink');
  Route::get('/admin/view_parent_link', 'Admin\FooterController@viewParentLink');
  Route::match(['get', 'post'], '/admin/edit_parent_link/{id}', 'Admin\FooterController@editParentLink');
  Route::get('/admin/delete_parent_link/{id}', 'Admin\FooterController@deleteParentLink');

  //Footer Link
  Route::match(['get', 'post'], '/admin/add_footer_link', 'Admin\FooterController@addFooterLink');
  Route::get('/admin/view_footer_link', 'Admin\FooterController@viewFooterLink');
  Route::match(['get', 'post'], '/admin/edit_footer_link/{id}', 'Admin\FooterController@editFooterLink');
  Route::get('/admin/delete_footer_link/{id}', 'Admin\FooterController@deleteFooterLink');
});
Route::match(['get', 'post'], '/admin', 'Admin\AdminController@login');



              //PUBLIC ROUTES

              //Admin Routes
Route::get('/', 'Frontend\FrontendController@index')->name('home');
Route::get('/bulk-sms-service', 'Frontend\FrontendController@price');
// SMS Services submenu: static Rate page first, then admin-managed pages by slug
Route::get('/bulk-sms-service/rate', 'Frontend\FrontendController@smsRate');
Route::get('/bulk-sms-service/{slug}', 'Frontend\FrontendController@smsServicePage')->where('slug', '[a-z0-9\-]+');
Route::post('/content-call-request', 'Frontend\FrontendController@contentCallRequest')->name('frontend.contentCallRequest');
Route::get('/order_request/send_otp', 'Frontend\FrontendController@sendOtp')->name('order.sendOtp');
Route::POST('/order_request/confirm', 'Frontend\FrontendController@confirmOrder')->name('order.confirm');
Route::post('/flexi-request', 'Frontend\FrontendController@flexiRequest')->name('frontend.flexiRequest');





Route::get('/terms', 'Frontend\FrontendController@terms');
Route::get('/payment', 'Frontend\FrontendController@payment');
Route::get('/search-engine-optimize', 'Frontend\FrontendController@seo');
Route::get('/content', 'Frontend\FrontendController@content');
Route::get('/facebook-marketing', 'Frontend\FrontendController@fbMarketing');
Route::get('/flexi-load-solution', 'Frontend\FrontendController@flexiSolution');
Route::get('/contact', 'Frontend\FrontendController@contact');
Route::match(['get', 'post'], '/call_request', 'Frontend\FrontendController@callRequest');
Route::match(['get', 'post'], '/order_request', 'Frontend\FrontendController@orderRequest');
