<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use Session;
use App\Model\CustomerSupport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportController extends Controller
{
  public function addCustomerSupportInfo(Request $request){
    if ($request->isMethod('post')) {
      $support = new CustomerSupport;
      $support->title = $request->title;
      $support->description = $request->description;
      $support->phone = $request->phone;
      if ($request->hasFile('image')) {
        $image = $request->file('image');
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $filename = 'support'. '.' .$extension;
          $path = 'asset/images/support/'.$filename;
          Image::make($image)->save($path);
        }
        $support->image = $filename;
      }

      $support->save();
      return redirect('/admin/view_customer_support_info')->with('success_message', 'Data Added Successfully !!');
    }
    return view('admin.support.add_customer_support_info');
  }


  public function viewCustomerSupportInfo(){
    $supports = CustomerSupport::get();
    return view('admin.support.view_customer_support_info')->with(compact('supports'));
  }


  public function editCustomerSupportInfo(Request $request, $id){
    if ($request->isMethod('post')) {
      $support = CustomerSupport::find($id);
      $support->title = $request->title;
      $support->description = $request->description;
      $support->phone = $request->phone;
      if ($request->hasFile('image')) {
        if (file_exists('asset/images/support/'.$support->image)) {
            unlink('asset/images/support/'.$support->image);
        }
        $image = $request->file('image');
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $filename = 'support'. '.' .$extension;
          $path = 'asset/images/support/'.$filename;
          Image::make($image)->save($path);
        }
        $support->image = $filename;
      }
      $support->save();
      return redirect('/admin/view_customer_support_info')->with('success_message', 'Data Updated Successfully !!');
    }
    $support = CustomerSupport::find($id);
    return view('admin.support.edit_customer_support_info')->with(compact('support'));
  }


  public function deleteCustomerSupportInfo($id){
    $support = CustomerSupport::find($id);
    if (file_exists('asset/images/support/'.$support->image)) {
        unlink('asset/images/support/'.$support->image);
    }
    $support->delete();
    return redirect('/admin/view_customer_support_info')->with('success_message', 'Data Deleted Successfully !!');
  }
}
