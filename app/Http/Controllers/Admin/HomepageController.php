<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use Session;
use App\Model\Slider;
use App\Model\SmsOffer;
use App\Model\WhyChooseUs;
use App\Model\SmsMarketing;
use App\Model\MarketingImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function addSlider(Request $request){
      if ($request->isMethod('post')) {
        $slider = new Slider;
        if ($request->hasFile('slider_image')) {
          $image = $request->file('slider_image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename = rand(111,999). '.' .$extension;
            $path = 'asset/images/slider/'.$filename;
            Image::make($image)->save($path);
          }
          $slider->slider_image = $filename;
        }

        $slider->save();
        return redirect('/admin/view_slider')->with('success_message', 'Slider Added Successfully !!');
      }
      return view('admin.slider.add_slider');
    }


    public function viewSlider(){
      $sliders = Slider::get();
      return view('admin.slider.view_slider')->with(compact('sliders'));
    }


    public function editSlider(Request $request, $id){
      if ($request->isMethod('post')) {
        $slider = Slider::find($id);
        if ($request->hasFile('slider_image')) {
          if (file_exists('asset/images/slider/'.$slider->slider_image)) {
              unlink('asset/images/slider/'.$slider->slider_image);
          }
          $image = $request->file('slider_image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename =  rand(111,999). '.' .$extension;
            $path = 'asset/images/slider/'.$filename;
            Image::make($image)->save($path);
          }
          $slider->slider_image = $filename;
        }

        $slider->save();
        return redirect('/admin/view_slider')->with('success_message', 'Slider Updated Successfully !!');
      }
      $slider = Slider::find($id);
      return view('admin.slider.edit_slider')->with(compact('slider'));
    }




    public function deleteSlider($id){
      $slider = Slider::find($id);
      if (file_exists('asset/images/slider/'.$slider->slider_image)) {
          unlink('asset/images/slider/'.$slider->slider_image);
      }
      $slider->delete();
      return redirect('/admin/view_slider')->with('success_message', 'Slider Deleted Successfully !!');
    }


    public function addSmsOffer(Request $request){
      if ($request->isMethod('post')) {
        $smsOffer = new SmsOffer;
        $smsOffer->title = $request->title;
        $smsOffer->description = $request->description;
        if ($request->hasFile('image')) {
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename = 'offer'. '.' .$extension;
            $path = 'asset/images/offer/'.$filename;
            Image::make($image)->save($path);
          }
          $smsOffer->image = $filename;
        }

        $smsOffer->save();
        return redirect('/admin/view_sms_offer')->with('success_message', 'Data Added Successfully !!');
      }
      return view('admin.homepage.add_sms_offer');
    }


    public function viewSmsOffer(){
      $smsOffers = SmsOffer::get();
      return view('admin.homepage.view_sms_offer')->with(compact('smsOffers'));
    }


    public function editSmsOffer(Request $request, $id){
      if ($request->isMethod('post')) {
        $smsOffer = SmsOffer::find($id);
        $smsOffer->title = $request->title;
        $smsOffer->description = $request->description;

        if ($request->hasFile('image')) {
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename =  'offer'. '.' .$extension;
            $path = 'asset/images/offer/'.$filename;
            Image::make($image)->save($path);
          }
          $smsOffer->image = $filename;
        }
        $smsOffer->save();
        return redirect('/admin/view_sms_offer')->with('success_message', 'Data Updated Successfully !!');
      }
      $smsOffer = SmsOffer::find($id);
      return view('admin.homepage.edit_sms_offer')->with(compact('smsOffer'));
    }




    public function deleteSmsOffer($id){
      $smsOffer = SmsOffer::find($id);
      if (file_exists('asset/images/offer/'.$smsOffer->image)) {
          unlink('asset/images/offer/'.$smsOffer->image);
      }
      $smsOffer->delete();
      return redirect('/admin/view_sms_offer')->with('success_message', 'Data Deleted Successfully !!');
    }

    public function addMarketingImage(Request $request){
      if ($request->isMethod('post')) {
        $marketing = new MarketingImage;
        $marketing->title = $request->title;
        if ($request->hasFile('image')) {
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename = 'sms_marketing'. '.' .$extension;
            $path = 'asset/images/marketing/'.$filename;
            Image::make($image)->save($path);
          }
          $marketing->image = $filename;
        }

        $marketing->save();
        return redirect('/admin/view_marketing_image')->with('success_message', 'Data Added Successfully !!');
      }
      return view('admin.homepage.add_marketing_image');
    }


    public function viewMarketingImage(){
      $marketings = MarketingImage::get();
      return view('admin.homepage.view_marketing_image')->with(compact('marketings'));
    }


    public function editMarketingImage(Request $request, $id){
      if ($request->isMethod('post')) {
        $marketing = MarketingImage::find($id);
        $marketing->title = $request->title;
        if ($request->hasFile('image')) {
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename = 'sms_marketing'. '.' .$extension;
            $path = 'asset/images/marketing/'.$filename;
            Image::make($image)->save($path);
          }
          $marketing->image = $filename;
        }
        $marketing->save();
        return redirect('/admin/view_marketing_image')->with('success_message', 'Data Updated Successfully !!');
      }
      $marketing = MarketingImage::find($id);
      return view('admin.homepage.edit_marketing_image')->with(compact('marketing'));
    }




    public function deleteMarketingImage($id){
      $marketing = MarketingImage::find($id);
      if (file_exists('asset/images/marketing/'.$marketing->image)) {
          unlink('asset/images/marketing/'.$marketing->image);
      }
      $marketing->delete();
      return redirect('/admin/view_marketing_image')->with('success_message', 'Data Deleted Successfully !!');
    }

    public function addSmsMarketingBenefits(Request $request){
      if ($request->isMethod('post')) {
        $benefit = new SmsMarketing;
        $benefit->title = $request->title;
        $benefit->description = $request->description;
        $benefit->save();
        return redirect('/admin/view_sms_marketing_benefits')->with('success_message', 'Data Added Successfully !!');
      }
      return view('admin.homepage.add_sms_marketing_benefits');
    }


    public function viewSmsMarketingBenefits(){
      $benefits = SmsMarketing::get();
      return view('admin.homepage.view_sms_marketing_benefits')->with(compact('benefits'));
    }


    public function editSmsMarketingBenefits(Request $request, $id){
      if ($request->isMethod('post')) {
        $benefit = SmsMarketing::find($id);
        $benefit->title = $request->title;
        $benefit->description = $request->description;
        $benefit->save();
        return redirect('/admin/view_sms_marketing_benefits')->with('success_message', 'Data Updated Successfully !!');
      }
      $benefit = SmsMarketing::find($id);
      return view('admin.homepage.edit_sms_marketing_benefits')->with(compact('benefit'));
    }




    public function deleteSmsMarketingBenefits($id){
      $benefit = SmsMarketing::find($id);
      $benefit->delete();
      return redirect('/admin/view_sms_marketing_benefits')->with('success_message', 'Data Deleted Successfully !!');
    }

    public function addWhychooseUs(Request $request){
      if ($request->isMethod('post')) {
        $chooseUs = new WhychooseUs;
        $chooseUs->title = $request->title;
        $chooseUs->description = $request->description;
        if ($request->hasFile('image')) {
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename = rand(111,999). '.' .$extension;
            $path = 'asset/images/'.$filename;
            Image::make($image)->save($path);
          }
          $chooseUs->image = $filename;
        }

        $chooseUs->save();
        return redirect('/admin/view_why_choose_us')->with('success_message', 'Data Added Successfully !!');
      }
      return view('admin.homepage.add_why_choose_us');
    }


    public function viewWhychooseUs(){
      $chooseUs = WhyChooseUs::get();
      return view('admin.homepage.view_why_choose_us')->with(compact('chooseUs'));
    }


    public function editWhychooseUs(Request $request, $id){
      if ($request->isMethod('post')) {
        $chooseUs = WhyChooseUs::find($id);
        $chooseUs->title = $request->title;
        $chooseUs->description = $request->description;
        if ($request->hasFile('image')) {
          if (file_exists('asset/images/'.$chooseUs->image)) {
              unlink('asset/images/'.$chooseUs->image);
          }
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename = rand(111,999). '.' .$extension;
            $path = 'asset/images/'.$filename;
            Image::make($image)->save($path);
          }
          $chooseUs->image = $filename;
        }
        $chooseUs->save();
        return redirect('/admin/view_why_choose_us')->with('success_message', 'Data Updated Successfully !!');
      }
      $choose = WhyChooseUs::find($id);
      return view('admin.homepage.edit_why_choose_us')->with(compact('choose'));
    }




    public function deleteWhychooseUs($id){
      $chooseUs = WhyChooseUs::find($id);
      if (file_exists('asset/images/'.$chooseUs->image)) {
          unlink('asset/images/'.$chooseUs->image);
      }
      $chooseUs->delete();
      return redirect('/admin/view_why_choose_us')->with('success_message', 'Data Deleted Successfully !!');
    }

}
