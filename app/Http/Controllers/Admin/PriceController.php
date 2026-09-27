<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Model\Price;
use App\Model\Package;
use App\Model\PriceHeader;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PriceController extends Controller
{
  public function addPackage(Request $request){
    if ($request->isMethod('post')) {
      $countPackage = Package::where('package_no', $request->package_no)->count();
      if ($countPackage > 0) {
        return back()->with('error_message', 'This Serial Is Already Exists !!');
      }else {
        $package = new Package;
        $package->package_no = $request->package_no;
        $package->package_name = $request->package_name;
        $package->save();
        return redirect('/admin/view_package')->with('success_message', 'Data Added Successfully !!');
      }
    }
    return view('admin.package.add_package');
  }


  public function viewPackage(){
    $packages = Package::orderBy('package_no', 'asc')->get();
    return view('admin.package.view_package')->with(compact('packages'));
  }


  public function editPackage(Request $request, $id){
    if ($request->isMethod('post')) {
      $countPackage = Package::where('package_no',$request->package_no)->where('id', '!=', $id)->count();
      if ($countPackage > 0) {
        return back()->with('error_message', 'This Serial Is Already Exists !!');
      }else {
        $package = Package::find($id);
        $package->package_no = $request->package_no;
        $package->package_name = $request->package_name;
        $package->save();
        return redirect('/admin/view_package')->with('success_message', 'Data Updated Successfully !!');
      }
    }
    $package = Package::find($id);
    return view('admin.package.edit_package')->with(compact('package'));
  }




  public function deletePackage($id){
    $package = Package::find($id);
    $package->delete();
    return redirect('/admin/view_package')->with('success_message', 'Data Deleted Successfully !!');
  }


  public function addPriceHeaderInfo(Request $request){
    if ($request->isMethod('post')) {
      $priceHeader = new PriceHeader;
      $priceHeader->header_title = $request->header_title;
      $priceHeader->description = $request->description;
      if ($request->hasFile('image')) {
        $image = $request->file('image');
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $filename = 'price'. '.' .$extension;
          $path = 'asset/images/'.$filename;
          Image::make($image)->save($path);
        }
        $priceHeader->image = $filename;
      }

      $priceHeader->save();
      return redirect('/admin/view_price_header_info')->with('success_message', 'Data Added Successfully !!');
    }
    return view('admin.package.add_price_header_info');
  }


  public function viewPriceHeaderInfo(){
    $priceHeaders = PriceHeader::get();
    return view('admin.package.view_price_header_info')->with(compact('priceHeaders'));
  }


  public function editPriceHeaderInfo(Request $request, $id){
    if ($request->isMethod('post')) {
      $priceHeader = PriceHeader::find($id);
      $priceHeader->header_title = $request->header_title;
      $priceHeader->description = $request->description;

      if ($request->hasFile('image')) {
        $image = $request->file('image');
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $filename = 'price'. '.' .$extension;
          $path = 'asset/images/'.$filename;
          Image::make($image)->save($path);
        }
        $priceHeader->image = $filename;
      }
      $priceHeader->save();
      return redirect('/admin/view_price_header_info')->with('success_message', 'Data Updated Successfully !!');
    }
    $priceHeader = PriceHeader::find($id);
    return view('admin.package.edit_price_header_info')->with(compact('priceHeader'));
  }




  public function deletePriceHeaderInfo($id){
    $priceHeader = PriceHeader::find($id);
    if (file_exists('asset/images/'.$priceHeader->image)) {
        unlink('asset/images/'.$priceHeader->image);
    }
    $priceHeader->delete();
    return redirect('/admin/view_price_header_info')->with('success_message', 'Data Deleted Successfully !!');
  }


  public function addPriceInfo(Request $request){
    if ($request->isMethod('post')) {
      $data = $request->all();

      $priceCount = Price::where(['package_id' => $data['package_id']])->count();
      if ($priceCount > 0) {
        Price::where(['package_id' => $data['package_id']])->delete();
      }

      for ($i=1; $i <=10 ; $i++) {
        $price = new Price;
        $price->package_id = $data['package_id'];
        $price->sms_type = $data['sms_type'.$i];
        $price->price = $data['price'.$i];
        $price->save();
      }
      return redirect('/admin/view_price_info')->with('success_message', 'Data Added Successfully !!');
    }
    $packages = Package::get();
    return view('admin.package.add_price_info', compact('packages'));
  }


  public function viewPriceInfo(){
    $prices = Price::get();
    $packages = Package::orderBy('package_no', 'asc')->get();
    return view('admin.package.view_price_info')->with(compact('prices', 'packages'));
  }

  public function viewSinglePriceInfo($id){
    $prices = Price::where('package_id', $id)->get();
    $package = Package::find($id);
    return view('admin.package.view_single_price_info')->with(compact('prices', 'package'));
  }

  public function editPriceInfo($id){
    $prices = Price::where('package_id', $id)->get();
    $packages = Package::get();
    return view('admin.package.edit_price_info')->with(compact('prices', 'packages'));
  }

  public function updatePriceInfo(Request $request, $id){
    if ($request->isMethod('post')) {
      $priceCount = Price::where('package_id', $id)->count();
      if ($priceCount > 0) {
        Price::where('package_id', $id)->delete();
      }
      $data = $request->all();
      // echo "<pre>"; print_r($data); die;
      for ($i=1; $i <=10 ; $i++) {
        $price = new Price;
        $price->package_id = $data['package_id'];
        $price->sms_type = $data['sms_type'.$i];
        $price->price = $data['price'.$i];
        $price->save();
      }
      return redirect('/admin/view_price_info')->with('success_message', 'Data Updated Successfully !!');
    }
  }


  public function deletePriceInfo($id){
    $price = Price::where('package_id', $id);
    $price->delete();
    return redirect('/admin/view_price_info')->with('success_message', 'Data Deleted Successfully !!');
  }

}
