<?php

namespace App\Http\Controllers\Admin;

use App\Model\ParentLink;
use App\Model\FooterLink;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterController extends Controller
{
  public function addParentLink(Request $request){
    if ($request->isMethod('post')) {
      $parent = new ParentLink;
      $parent->title = $request->title;
      $parent->save();
      return redirect('/admin/view_parent_link')->with('success_message', 'Parent Link Added Successfully !!');
    }
    return view('admin.footer.add_parent_link');
  }


  public function viewParentLink(){
    $parents = ParentLink::get();
    return view('admin.footer.view_parent_link')->with(compact('parents'));
  }


  public function editParentLink(Request $request, $id){
    if ($request->isMethod('post')) {
      $parent = ParentLink::find($id);
      $parent->title = $request->title;
      $parent->save();
      return redirect('/admin/view_parent_link')->with('success_message', 'Parent Link Updated Successfully !!');
    }
    $parent = ParentLink::find($id);
    return view('admin.footer.edit_parent_link')->with(compact('parent'));
  }


  public function deleteParentLink($id){
    $parent = ParentLink::find($id);
    $countFooterLink = FooterLink::where('parent_id', $id)->count();
    if ($countFooterLink > 0) {
      FooterLink::where('parent_id', $id)->delete();
    }
    $parent->delete();
    return redirect('/admin/view_parent_link')->with('success_message', 'Parent Link Deleted Successfully !!');
  }

  public function addFooterLink(Request $request){
    if ($request->isMethod('post')) {
      $footer = new FooterLink;
      $footer->parent_id = $request->parent_id;
      $footer->title = $request->title;
      $footer->url = $request->url;
      $footer->save();
      return redirect('/admin/view_footer_link')->with('success_message', 'Footer Link Added Successfully !!');
    }
    $parentLinks = ParentLink::get();
    return view('admin.footer.add_footer_link', compact('parentLinks'));
  }


  public function viewFooterLink(){
    $footers = FooterLink::get();
    return view('admin.footer.view_footer_link')->with(compact('footers'));
  }


  public function editFooterLink(Request $request, $id){
    if ($request->isMethod('post')) {
      $footer = FooterLink::find($id);
      $footer->parent_id = $request->parent_id;
      $footer->title = $request->title;
      $footer->url = $request->url;
      $footer->save();
      return redirect('/admin/view_footer_link')->with('success_message', 'Footer Link Updated Successfully !!');
    }
    $parentLinks = ParentLink::get();
    $footer = FooterLink::find($id);
    return view('admin.footer.edit_footer_link')->with(compact('parentLinks', 'footer'));
  }


  public function deleteFooterLink($id){
    $footer = FooterLink::find($id);
    $footer->delete();
    return redirect('/admin/view_footer_link')->with('success_message', 'Footer Link Deleted Successfully !!');
  }
}
