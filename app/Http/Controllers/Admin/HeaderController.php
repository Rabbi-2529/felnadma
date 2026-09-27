<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use Session;
use App\Model\Logo;
use App\Model\Navbar;
use App\Model\HeaderContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HeaderController extends Controller
{
    public function addLogo(Request $request){
      if ($request->isMethod('post')) {
        $logo = new Logo;
        if ($request->hasFile('logo')) {
          $image = $request->file('logo');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename = 'logo'. '.' .$extension;
            $path = 'asset/images/logo_img/'.$filename;
            Image::make($image)->save($path);
          }
          $logo->logo = $filename;
        }

        if ($request->hasFile('logo_text')) {
          $logo_text = $request->file('logo_text');
          if ($logo_text->isValid()) {
            $logo_text_extension = $logo_text->getClientOriginalExtension();
            $logo_text_filename = 'logo_text'. '.' .$logo_text_extension;
            $logo_text_path = 'asset/images/logo_img/'.$logo_text_filename;
            Image::make($logo_text)->save($logo_text_path);
          }
          $logo->logo_text = $logo_text_filename;
        }
        $logo->save();
        return redirect('/admin/view_logo')->with('success_message', 'Logo Added Successfully !!');
      }
      return view('admin.logo.add_logo');
    }


    public function viewLogo(){
      $logos = Logo::get();
      return view('admin.logo.view_logo')->with(compact('logos'));
    }


    public function editLogo(Request $request, $id){
      if ($request->isMethod('post')) {
        $logo = Logo::find($id);
        if ($request->hasFile('logo')) {
          $image = $request->file('logo');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename = 'logo'. '.' .$extension;
            $path = 'asset/images/logo_img/'.$filename;
            Image::make($image)->save($path);
          }
          $logo->logo = $filename;
        }

        if ($request->hasFile('logo_text')) {
          $logo_text = $request->file('logo_text');
          if ($logo_text->isValid()) {
            $logo_text_extension = $logo_text->getClientOriginalExtension();
            $logo_text_filename = 'logo_text'. '.' .$logo_text_extension;
            $logo_text_path = 'asset/images/logo_img/'.$logo_text_filename;
            Image::make($logo_text)->save($logo_text_path);
          }
          $logo->logo_text = $logo_text_filename;
        }
        $logo->save();
        return redirect('/admin/view_logo')->with('success_message', 'Logo Updated Successfully !!');
      }
      $logo = Logo::find($id);
      return view('admin.logo.edit_logo')->with(compact('logo'));
    }

    public function deleteLogo($id){
      $logo = Logo::find($id);
      if (file_exists('/asset/images/logo_img/'.$logo->logo)) {
          unlink('/asset/images/logo_img/'.$logo->logo);
      }
      if (file_exists('/asset/images/logo_img/'.$logo->logo_text)) {
          unlink('/asset/images/logo_img/'.$logo->logo_text);
      }
      $logo->delete();
      return redirect('/admin/view_logo')->with('success_message', 'Logo Deleted Successfully !!');
    }

    public function viewHeaderContact(){
      $contacts = HeaderContact::get();
      return view('admin.contact.view_header_contact')->with(compact('contacts'));
    }

    public function addHeaderContact(Request $request){
      if ($request->isMethod('post')) {
        $contact = new HeaderContact;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->save();
        return redirect('/admin/view_header_contact_info')->with('success_message', 'Contact Info Added Successfully !!');
      }
      return view('admin.contact.add_header_contact');
    }

    public function editHeaderContact(Request $request, $id){
      if ($request->isMethod('post')) {
        $contact = HeaderContact::find($id);
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->save();
        return redirect('/admin/view_header_contact_info')->with('success_message', 'Contact Info Updated Successfully !!');
      }
      $contact = HeaderContact::find($id);
      return view('admin.contact.edit_header_contact', compact('contact'));
    }

    public function deleteHeaderContact($id){
      $contact = HeaderContact::find($id);
      $contact->delete();
      return redirect('/admin/view_header_contact_info')->with('success_message', 'Contact Info Deleted Successfully !!');
    }

    public function viewNav(){
      $navbar = Navbar::get();
      return view('admin.navbar.view_nav')->with(compact('navbar'));
    }

    public function addNav(Request $request){
      if ($request->isMethod('post')) {
        $nav = new Navbar;
        $nav->nav_item = $request->nav_item;
        $nav->nav_route = $request->nav_route;
        $nav->save();
        return redirect('/admin/view_nav')->with('success_message', 'New Nav Item Added Successfully !!');
      }
      return view('admin.navbar.add_nav');
    }

    public function editNav(Request $request, $id){
      if ($request->isMethod('post')) {
        $nav = Navbar::find($id);
        $nav->nav_item = $request->nav_item;
        $nav->nav_route = $request->nav_route;
        $nav->save();
        return redirect('/admin/view_nav')->with('success_message', 'New Nav Item Updated Successfully !!');
      }
      $nav = Navbar::find($id);
      return view('admin.navbar.edit_nav', compact('nav'));
    }

    public function deleteNav($id){
      $nav = Navbar::find($id);
      $nav->delete();
      return redirect('/admin/view_nav')->with('success_message', 'Nav Item Deleted Successfully !!');
    }
}
