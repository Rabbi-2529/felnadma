<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Model\Terms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermsController extends Controller
{
  public function addTerms(Request $request){
    if ($request->isMethod('post')) {
      $terms = new Terms;
      $terms->header_title = $request->header_title;
      $terms->terms = $request->terms;
      if ($request->hasFile('image')) {
        $image = $request->file('image');
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $filename = 'terms'. '.' .$extension;
          $path = 'asset/images/'.$filename;
          Image::make($image)->save($path);
        }
        $terms->image = $filename;
      }

      $terms->save();
      return redirect('/admin/view_terms')->with('success_message', 'Terms & Conditions Added Successfully !!');
    }
    return view('admin.terms.add_terms');
  }


  public function viewTerms(){
    $allTerms = Terms::get();
    return view('admin.terms.view_terms')->with(compact('allTerms'));
  }


  public function editTerms(Request $request, $id){
    if ($request->isMethod('post')) {
      $terms = Terms::find($id);
      $terms->header_title = $request->header_title;
      $terms->terms = $request->terms;

      if ($request->hasFile('image')) {
        $image = $request->file('image');
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $filename = 'terms'. '.' .$extension;
          $path = 'asset/images/'.$filename;
          Image::make($image)->save($path);
        }
        $terms->image = $filename;
      }
      $terms->save();
      return redirect('/admin/view_terms')->with('success_message', 'Terms & Conditions Updated Successfully !!');
    }
    $terms = Terms::find($id);
    return view('admin.terms.edit_terms')->with(compact('terms'));
  }




  public function deleteTerms($id){
    $terms = Terms::find($id);
    if (file_exists('asset/images/'.$terms->image)) {
        unlink('asset/images/'.$terms->image);
    }
    $terms->delete();
    return redirect('/admin/view_terms')->with('success_message', 'Terms & Conditions Deleted Successfully !!');
  }
}
