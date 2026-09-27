<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use Session;
use App\Model\Facility;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
  public function addFacility(Request $request){
    if ($request->isMethod('post')) {
      $facility = new Facility;
      $facility->title = $request->title;
      $facility->description = $request->description;
      if ($request->hasFile('image')) {
        $image = $request->file('image');
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $filename = rand(111,999). '.' .$extension;
          $path = 'asset/images/facilities/'.$filename;
          Image::make($image)->save($path);
        }
        $facility->image = $filename;
      }

      $facility->save();
      return redirect('/admin/view_facilities')->with('success_message', 'Data Added Successfully !!');
    }
    return view('admin.facilities.add_facilities');
  }


  public function viewFacility(){
    $facilities = Facility::get();
    return view('admin.facilities.view_facilities')->with(compact('facilities'));
  }


  public function editFacility(Request $request, $id){
    if ($request->isMethod('post')) {
      $facility = Facility::find($id);
      $facility->title = $request->title;
      $facility->description = $request->description;
      if ($request->hasFile('image')) {
        if (file_exists('asset/images/facilities/'.$facility->image)) {
            unlink('asset/images/facilities/'.$facility->image);
        }
        $image = $request->file('image');
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $filename = rand(111,999). '.' .$extension;
          $path = 'asset/images/facilities/'.$filename;
          Image::make($image)->save($path);
        }
        $facility->image = $filename;
      }
      $facility->save();
      return redirect('/admin/view_facilities')->with('success_message', 'Data Updated Successfully !!');
    }
    $facility = Facility::find($id);
    return view('admin.facilities.edit_facilities')->with(compact('facility'));
  }




  public function deleteFacility($id){
    $facility = Facility::find($id);
    if (file_exists('asset/images/facilities/'.$facility->image)) {
        unlink('asset/images/facilities/'.$facility->image);
    }
    $facility->delete();
    return redirect('/admin/view_facilities')->with('success_message', 'Data Deleted Successfully !!');
  }
}
