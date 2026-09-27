<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Model\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
  public function addAboutInfo(Request $request){
    if ($request->isMethod('post')) {
      $about = new About;
      $about->header_title = $request->header_title;
      $about->description = $request->description;
      if ($request->hasFile('image')) {
        $image = $request->file('image');
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $filename = 'about'. '.' .$extension;
          $path = 'asset/images/'.$filename;
          Image::make($image)->save($path);
        }
        $about->image = $filename;
      }

      if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        if ($logo->isValid()) {
          $logo_extension = $logo->getClientOriginalExtension();
          $logo_filename = 'logo'. '.' .$logo_extension;
          $logo_path = 'asset/images/'.$logo_filename;
          Image::make($logo)->save($logo_path);
        }
        $about->logo = $logo_filename;
      }
      $about->save();
      return redirect('/admin/view_about_info')->with('success_message', 'About Added Successfully !!');
    }
    return view('admin.about.add_about_info');
  }


  public function viewAboutInfo(){
    $abouts = About::get();
    return view('admin.about.view_about_info')->with(compact('abouts'));
  }


  public function editAboutInfo(Request $request, $id){
    if ($request->isMethod('post')) {
      $about = About::find($id);
      if ($request->hasFile('image')) {
        $image = $request->file('image');
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $filename = 'about'. '.' .$extension;
          $path = 'asset/images/'.$filename;
          Image::make($image)->save($path);
        }
        $about->image = $filename;
      }

      if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        if ($logo->isValid()) {
          $logo_extension = $logo->getClientOriginalExtension();
          $logo_filename = 'logo'. '.' .$logo_extension;
          $logo_path = 'asset/images/'.$logo_filename;
          Image::make($logo)->save($logo_path);
        }
        $about->logo = $logo_filename;
      }
      $about->save();
      return redirect('/admin/view_about_info')->with('success_message', 'About Updated Successfully !!');
    }
    $about = About::find($id);
    return view('admin.about.edit_about_info')->with(compact('about'));
  }

  public function deleteAboutInfo($id){
    $about = About::find($id);
    if (file_exists('asset/images/'.$about->image)) {
        unlink('asset/images/'.$about->image);
    }
    if (file_exists('asset/images/'.$about->logo)) {
        unlink('asset/images/'.$about->logo);
    }
    $about->delete();
    return redirect('/admin/view_about_info')->with('success_message', 'About Deleted Successfully !!');
  }
}
