<?php

namespace App\Http\Controllers\Admin;

use App\Model\MetaTag;
use App\Model\SmsServicePage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SmsServicePageController extends Controller
{
  const ICON_DIR = 'asset/images/sms_service';

  public function addSmsServicePage(Request $request){
    if ($request->isMethod('post')) {
      $page = new SmsServicePage;
      $this->fillPage($request, $page);
      $page->save();
      return redirect('/admin/view_sms_service_page')->with('success_message', 'Data Added Successfully !!');
    }
    return view('admin.sms_service_page.add_sms_service_page');
  }


  public function viewSmsServicePage(){
    $pages = SmsServicePage::orderBy('sort_order')->orderBy('id')->get();
    return view('admin.sms_service_page.view_sms_service_page')->with(compact('pages'));
  }


  public function editSmsServicePage(Request $request, $id){
    $page = SmsServicePage::findOrFail($id);
    if ($request->isMethod('post')) {
      $this->fillPage($request, $page);
      $page->save();
      return redirect('/admin/view_sms_service_page')->with('success_message', 'Data Updated Successfully !!');
    }
    return view('admin.sms_service_page.edit_sms_service_page')->with(compact('page'));
  }


  public function deleteSmsServicePage($id){
    $page = SmsServicePage::findOrFail($id);
    $this->removeIcon($page);
    $page->delete();
    return redirect('/admin/view_sms_service_page')->with('success_message', 'Data Deleted Successfully !!');
  }


  private function fillPage(Request $request, SmsServicePage $page){
    // Slug defaults to the title; "rate" is taken by the static Rate page
    $request->merge(['slug' => Str::slug($request->slug ?: $request->title)]);

    $request->validate([
      'title' => 'required|string|max:255',
      'slug' => [
        'required', 'max:255', Rule::notIn(SmsServicePage::RESERVED_SLUGS),
        Rule::unique('sms_service_pages', 'slug')->ignore($page->id),
      ],
      'icon_class' => ['nullable', 'max:100', 'regex:/^[a-z0-9 \-]+$/i'],
      'icon_image' => 'nullable|file|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
      'sort_order' => 'nullable|integer',
    ], [
      'slug.not_in' => 'This URL slug is reserved, please choose another one.',
      'icon_class.regex' => 'Icon class may only contain letters, numbers, spaces and dashes (e.g. fas fa-key).',
    ]);

    // Keep Meta Tag entries attached when the URL changes
    if ($page->exists && $page->slug !== $request->slug) {
      MetaTag::where('nav', '/bulk-sms-service/'.$page->slug)->update(['nav' => '/bulk-sms-service/'.$request->slug]);
    }

    $page->title = $request->title;
    $page->slug = $request->slug;
    $page->icon_class = $request->icon_class;
    $page->short_description = $request->short_description;
    $page->description = $request->description;
    $page->meta_title = $request->meta_title;
    $page->meta_description = $request->meta_description;
    $page->meta_keywords = $request->meta_keywords;
    $page->sort_order = (int) $request->sort_order;
    $page->status = $request->status ? 1 : 0;

    if ($request->remove_icon_image) {
      $this->removeIcon($page);
      $page->icon_image = null;
    }

    if ($request->hasFile('icon_image') && $request->file('icon_image')->isValid()) {
      $this->removeIcon($page);
      $image = $request->file('icon_image');
      $filename = time().rand(111,999).'.'.strtolower($image->getClientOriginalExtension());
      $image->move(base_path(self::ICON_DIR), $filename);
      $page->icon_image = $filename;
    }
  }


  private function removeIcon(SmsServicePage $page){
    if (!empty($page->icon_image)) {
      $path = base_path(self::ICON_DIR.'/'.$page->icon_image);
      foreach ([$path, $path.'.webp'] as $file) {
        if (is_file($file)) {
          unlink($file);
        }
      }
    }
  }
}
