<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SmsServicePage extends Model
{
  // Slugs taken by fixed routes under /bulk-sms-service
  const RESERVED_SLUGS = ['rate'];

  protected $casts = ['status' => 'boolean'];

  private static $menuCache;

  // Active admin-managed pages, in menu order
  public static function menu(){
    if (self::$menuCache === null) {
      self::$menuCache = SmsServicePage::where('status', 1)->orderBy('sort_order')->orderBy('id')->get();
    }
    return self::$menuCache;
  }

  /**
   * Every SMS Services sub-page (static Rate page first, then active dynamic pages)
   * as plain links for the header submenu and the homepage services section.
   */
  public static function links($exceptPath = null){
    $links = collect([(object) [
      'title' => 'Rate',
      'path' => '/bulk-sms-service/rate',
      'url' => url('/bulk-sms-service/rate'),
      'summary' => 'Masking and non-masking SMS rates for every package, side by side.',
      'icon_class' => 'fas fa-tags',
      'icon_image' => null,
    ]]);

    foreach (self::menu() as $page) {
      $links->push((object) [
        'title' => $page->title,
        'path' => '/bulk-sms-service/'.$page->slug,
        'url' => $page->url(),
        'summary' => $page->short_description,
        'icon_class' => $page->icon_class,
        'icon_image' => !empty($page->icon_image) ? $page->iconImagePath() : null,
      ]);
    }

    return $exceptPath ? $links->where('path', '!=', $exceptPath)->values() : $links;
  }

  /**
   * Extra entries for the admin "Page" dropdowns (Meta Tag), shaped like Navbar rows.
   * Includes hidden pages so their meta can be prepared before they go live.
   */
  public static function pageOptions(){
    $options = collect([(object) ['nav_route' => '/bulk-sms-service/rate', 'nav_item' => 'SMS Services → Rate']]);
    foreach (SmsServicePage::orderBy('sort_order')->orderBy('id')->get() as $page) {
      $options->push((object) [
        'nav_route' => '/bulk-sms-service/'.$page->slug,
        'nav_item' => 'SMS Services → '.$page->title.($page->status ? '' : ' (hidden)'),
      ]);
    }
    return $options;
  }

  /**
   * Meta for a page under /bulk-sms-service: the Meta Tag admin entry for $path wins,
   * any field left empty there falls back to $fallback.
   */
  public static function metaFor($path, array $fallback){
    $metaTag = MetaTag::where('nav', $path)->first();
    $meta = (object) $fallback;
    if ($metaTag) {
      foreach (['meta_title', 'meta_description', 'meta_keywords', 'meta_image', 'meta_link'] as $field) {
        if (!empty($metaTag->$field)) {
          $meta->$field = $metaTag->$field;
        }
      }
    }
    return $meta;
  }

  public function url(){
    return url('/bulk-sms-service/'.$this->slug);
  }

  public function iconImagePath(){
    return 'asset/images/sms_service/'.$this->icon_image;
  }
}
