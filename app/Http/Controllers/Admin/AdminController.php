<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use Auth;
use Session;
use App\User;
use App\Model\Admin;
use App\Model\Seo;
use App\Model\Content;
use App\Model\Order;
use App\Model\Package;
use App\Model\Flexi;
use App\Model\FacebookMarketing;
use App\Model\Navbar;
use App\Model\Article; 
use App\Model\MetaTag;
use App\Model\Offer;
use App\Model\SmsServicePage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function login(Request $request){

      if (Session::has('adminSession')) {
        return redirect('/admin/dashboard');
      }else {
        if ($request->isMethod('post')) {
          $data = $request->all();
          $countAdmin = Admin::where(['username' => $data['username'], 'password' => md5($data['password'])])->count();
          if ($countAdmin > 0) {
            Session::put('adminSession', $data['username']);
            return redirect('/admin/dashboard');
          }else {
            return redirect('/admin')->with('error_message', 'Invalid Username or Password !!');
          }
        }
        return view('admin.admin_login');
      }
    }

    public function logout(){
      Session::flush();
      return redirect('/admin');
    }


public function dashboard(){
      $totalOrders = Order::count();
      $pendingOrders = Order::where('order_status', 'pending')->count();
      $confirmedOrders = Order::where('order_status', 'confirmed')->count();
      $todayOrders = Order::whereDate('created_at', today())->count();
      $weekOrders = Order::where('created_at', '>=', now()->startOfWeek())->count();
      $monthOrders = Order::where('created_at', '>=', now()->startOfMonth())->count();
      $uniqueCustomers = Order::distinct('client_phone')->count('client_phone');

      $otpTotal = Order::whereNotNull('otp_code')->count();
      $otpVerified = Order::where('otp_status', 'verified')->count();
      $otpSuccessRate = $otpTotal > 0 ? round($otpVerified / $otpTotal * 100) : 0;

      $activePackages = Package::count();
      $servicePages = SmsServicePage::count();

      $recentOrders = Order::orderBy('id', 'desc')->take(6)->get();
      $recentOtp = Order::whereNotNull('otp_code')->orderBy('id', 'desc')->take(6)->get();
      $topPackages = Order::selectRaw('package_name, count(*) as total_orders')
        ->whereNotNull('package_name')
        ->groupBy('package_name')
        ->orderBy('total_orders', 'desc')
        ->take(5)
        ->get();

      // Orders per day for the last 14 days (dashboard chart)
      $dailyCounts = Order::selectRaw('DATE(created_at) as day, count(*) as total')
        ->where('created_at', '>=', today()->subDays(13))
        ->groupBy('day')
        ->pluck('total', 'day');
      $orderTrend = collect(range(13, 0))->map(function ($daysAgo) use ($dailyCounts) {
        $day = today()->subDays($daysAgo);
        return ['label' => $day->format('d M'), 'total' => (int) ($dailyCounts[$day->toDateString()] ?? 0)];
      });

      return view('admin.dashboard', compact(
        'totalOrders', 'pendingOrders', 'confirmedOrders', 'todayOrders', 'weekOrders', 'monthOrders',
        'uniqueCustomers', 'otpSuccessRate', 'activePackages', 'servicePages',
        'recentOrders', 'recentOtp', 'topPackages', 'orderTrend'
      ));
    }

    public function settings(){
      $adminDetails = Admin::where('username', Session::get('adminSession'))->first();
      return view('admin.settings', compact('adminDetails'));
    }

    public function check_pass(Request $request){
      $data = $request->all();
      $countAdmin = Admin::where(['username' => Session::get('adminSession'), 'password' => md5($data['current_pass'])])->count();
      if ($countAdmin == 1) {
        echo "true"; die;
      }else {
        echo "false"; die;
      }
    }

    public function updatePass(Request $request){
      if ($request->isMethod('post')) {
        $data = $request->all();
        $countAdmin = Admin::where(['username' => Session::get('adminSession'), 'password' => md5($data['current_pass'])])->count();
        if ($countAdmin == 1) {
          $password = md5($data['new_pass']);
          Admin::where(['username' => Session::get('adminSession')])->update(['password' => $password]);

          return redirect('/admin/settings')->with('success_message', 'Password Changed Successfully !!');
        }
        else {
          return redirect('/admin/settings')->with('error_message', 'Current Password Is Incorrect !!');
        }
      }
    }


    // Page choices for meta tags: navbar pages plus the SMS Services sub-pages (Rate + admin-managed pages)
    private function metaPages(){
      return Navbar::get()->concat(SmsServicePage::pageOptions());
    }

    public function addMeta(Request $request){
      if ($request->isMethod('post')) {
        $metaTag = new MetaTag;
        $metaTag->nav = $request->nav;
        $metaTag->meta_title = $request->meta_title;
        $metaTag->meta_description = $request->meta_description;
        $metaTag->meta_keywords = $request->meta_keywords;
        $metaTag->meta_link = $request->meta_link;
        if ($request->hasFile('meta_image')) {
          $image = $request->file('meta_image');
          if ($image->isValid()) {
            $file = $image->getClientOriginalName();
            $path = 'asset/images/hidden/'.$file;
            Image::make($image)->save($path);
          }
          $metaTag->meta_image = $file;
        }
        $metaTag->save();
        return redirect('/admin/view_meta_tag')->with('success_message', 'Data Added Successfully !!');
      }
      $navbar = $this->metaPages();
      return view('admin.metatag.add_meta_tag', compact('navbar'));
    }


    public function viewMeta(){
      $metaTags = MetaTag::get();
      return view('admin.metatag.view_meta_tag')->with(compact('metaTags'));
    }


    public function editMeta(Request $request, $id){
      if ($request->isMethod('post')) {
        $metaTag = MetaTag::find($id);
        $metaTag->nav = $request->nav;
        $metaTag->meta_title = $request->meta_title;
        $metaTag->meta_description = $request->meta_description;
        $metaTag->meta_keywords = $request->meta_keywords;
        $metaTag->meta_link = $request->meta_link;
        if ($request->hasFile('meta_image')) {
          if (file_exists('/asset/images/hidden/'.$metaTag->meta_image)) {
              unlink('/asset/images/hidden/'.$metaTag->meta_image);
          }
          $image = $request->file('meta_image');
          if ($image->isValid()) {
            $file = $image->getClientOriginalName();
            $path = 'asset/images/hidden/'.$file;
            Image::make($image)->save($path);
          }
          $metaTag->meta_image = $file;
        }
        $metaTag->save();
        return redirect('/admin/view_meta_tag')->with('success_message', 'Data Updated Successfully !!');
      }
      $navbar = $this->metaPages();
      $metaTag = MetaTag::find($id);
      return view('admin.metatag.edit_meta_tag')->with(compact('metaTag', 'navbar'));
    }


    public function deleteMeta($id){
      $metaTag = MetaTag::find($id);
      if (file_exists('/asset/images/hidden/'.$metaTag->meta_image)) {
          unlink('/asset/images/hidden/'.$metaTag->meta_image);
      }
      $metaTag->delete();
      return redirect('/admin/view_meta_tag')->with('success_message', 'Data Deleted Successfully !!');
    }

    public function addSpecialOffer(Request $request){
    if ($request->isMethod('post')) {
      $offer = new Offer;
      $offer->title = $request->title;
      $offer->description = $request->description;
      if ($request->hasFile('image')) {
        $image = $request->file('image');
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $filename = 'special_offer'. '.' .$extension;
          $path = 'asset/images/offer/'.$filename;
          Image::make($image)->save($path);
        }
        $offer->image = $filename;
      }

      $offer->save();
      return redirect('/admin/view_special_offer')->with('success_message', 'Data Added Successfully !!');
    }
    return view('admin.offer.add_special_offer');
  }


  public function viewSpecialOffer(){
    $offers = Offer::get();
    return view('admin.offer.view_special_offer')->with(compact('offers'));
  }


  public function editSpecialOffer(Request $request, $id){
    if ($request->isMethod('post')) {
      $offer = Offer::find($id);
      $offer->title = $request->title;
      $offer->description = $request->description;
      if ($request->hasFile('image')) {
        if (file_exists('asset/images/offer/'.$offer->image)) {
            unlink('asset/images/offer/'.$offer->image);
        }
        $image = $request->file('image');
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $filename = 'special_offer'. '.' .$extension;
          $path = 'asset/images/offer/'.$filename;
          Image::make($image)->save($path);
        }
        $offer->image = $filename;
      }
      $offer->save();
      return redirect('/admin/view_special_offer')->with('success_message', 'Data Updated Successfully !!');
    }
    $offer = Offer::find($id);
    return view('admin.offer.edit_special_offer')->with(compact('offer'));
  }


  public function deleteSpecialOffer($id){
    $offer = Offer::findOrFail($id);
    if (!empty($offer->image) && file_exists('asset/images/offer/'.$offer->image)) {
        unlink('asset/images/offer/'.$offer->image);
    }
    $offer->delete();
    return redirect('/admin/view_special_offer')->with('success_message', 'Data Deleted Successfully !!');
  }


  public function activeOffer(Request $request, $id){
    if ($request->isMethod('post')) {
      $offer = Offer::find($id);
      $offer->status = 1;

      $offer->save();
      return redirect('/admin/view_special_offer')->with('success_message', 'Status Updated Successfully !!');
    }
  }

  public function deactiveOffer(Request $request, $id){
    if ($request->isMethod('post')) {
      $offer = Offer::find($id);
      $offer->status = 0;

      $offer->save();
        return redirect('/admin/view_special_offer')->with('success_message', 'Status Updated Successfully !!');
    }
  }

    public function addSeoInfo(Request $request){
      if ($request->isMethod('post')) {
        $seoInfo = new Seo;
        $seoInfo->title = $request->title;
        $seoInfo->description = $request->description;
        if ($request->hasFile('image')) {
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename = 'seo'. '.' .$extension;
            $path = 'asset/images/'.$filename;
            Image::make($image)->save($path);
          }
          $seoInfo->image = $filename;
        }

        $seoInfo->save();
        return redirect('/admin/view_seo_info')->with('success_message', 'Data Added Successfully !!');
      }
      return view('admin.add_seo_info');
    }


    public function viewSeoInfo(){
      $seoInfos = Seo::get();
      return view('admin.view_seo_info')->with(compact('seoInfos'));
    }


    public function editSeoInfo(Request $request, $id){
      if ($request->isMethod('post')) {
        $seoInfo = Seo::find($id);
        $seoInfo->title = $request->title;
        $seoInfo->description = $request->description;

        if ($request->hasFile('image')) {
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename =  'seo'. '.' .$extension;
            $path = 'asset/images/'.$filename;
            Image::make($image)->save($path);
          }
          $seoInfo->image = $filename;
        }
        $seoInfo->save();
        return redirect('/admin/view_seo_info')->with('success_message', 'Data Updated Successfully !!');
      }
      $seoInfo = Seo::find($id);
      return view('admin.edit_seo_info')->with(compact('seoInfo'));
    }


    public function deleteSeoInfo($id){
      $seoInfo = Seo::find($id);
      if (file_exists('asset/images/'.$seoInfo->image)) {
          unlink('asset/images/'.$seoInfo->image);
      }
      $seoInfo->delete();
      return redirect('/admin/view_seo_info')->with('success_message', 'Data Deleted Successfully !!');
    }


    public function addFbMarketingInfo(Request $request){
      if ($request->isMethod('post')) {
        $fbMarketingInfo = new FacebookMarketing;
        $fbMarketingInfo->title = $request->title;
        $fbMarketingInfo->description = $request->description;
        if ($request->hasFile('image')) {
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename = 'fb_marketing'. '.' .$extension;
            $path = 'asset/images/'.$filename;
            Image::make($image)->save($path);
          }
          $fbMarketingInfo->image = $filename;
        }

        $fbMarketingInfo->save();
        return redirect('/admin/view_fb_marketing_info')->with('success_message', 'Data Added Successfully !!');
      }
      return view('admin.add_fb_marketing_info');
    }


    public function viewFbMarketingInfo(){
      $fbMarketingInfos = FacebookMarketing::get();
      return view('admin.view_fb_marketing_info')->with(compact('fbMarketingInfos'));
    }


    public function editFbMarketingInfo(Request $request, $id){
      if ($request->isMethod('post')) {
        $fbMarketingInfo = FacebookMarketing::find($id);
        $fbMarketingInfo->title = $request->title;
        $fbMarketingInfo->description = $request->description;

        if ($request->hasFile('image')) {
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename =  'fb_marketing'. '.' .$extension;
            $path = 'asset/images/'.$filename;
            Image::make($image)->save($path);
          }
          $fbMarketingInfo->image = $filename;
        }
        $fbMarketingInfo->save();
        return redirect('/admin/view_fb_marketing_info')->with('success_message', 'Data Updated Successfully !!');
      }
      $fbMarketingInfo = FacebookMarketing::find($id);
      return view('admin.edit_fb_marketing_info')->with(compact('fbMarketingInfo'));
    }


    public function deleteFbMarketingInfo($id){
      $fbMarketingInfo = FacebookMarketing::find($id);
      if (file_exists('asset/images/'.$fbMarketingInfo->image)) {
          unlink('asset/images/'.$fbMarketingInfo->image);
      }
      $fbMarketingInfo->delete();
      return redirect('/admin/view_fb_marketing_info')->with('success_message', 'Data Deleted Successfully !!');
    }


    public function addFlexiInfo(Request $request){
      if ($request->isMethod('post')) {
        $flexiInfo = new Flexi;
        $flexiInfo->title = $request->title;
        $flexiInfo->description = $request->description;
        if ($request->hasFile('image')) {
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename = 'flexi'. '.' .$extension;
            $path = 'asset/images/'.$filename;
            Image::make($image)->save($path);
          }
          $flexiInfo->image = $filename;
        }

        $flexiInfo->save();
        return redirect('/admin/view_flexi_info')->with('success_message', 'Data Added Successfully !!');
      }
      return view('admin.add_flexi_info');
    }


    public function viewFlexiInfo(){
      $flexiInfos = Flexi::get();
      return view('admin.view_flexi_info')->with(compact('flexiInfos'));
    }


    public function editFlexiInfo(Request $request, $id){
      if ($request->isMethod('post')) {
        $flexiInfo = Flexi::find($id);
        $flexiInfo->title = $request->title;
        $flexiInfo->description = $request->description;

        if ($request->hasFile('image')) {
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename =  'flexi'. '.' .$extension;
            $path = 'asset/images/'.$filename;
            Image::make($image)->save($path);
          }
          $flexiInfo->image = $filename;
        }
        $flexiInfo->save();
        return redirect('/admin/view_flexi_info')->with('success_message', 'Data Updated Successfully !!');
      }
      $flexiInfo = Flexi::find($id);
      return view('admin.edit_flexi_info')->with(compact('flexiInfo'));
    }


    public function deleteFlexiInfo($id){
      $flexiInfo = Flexi::find($id);
      if (file_exists('asset/images/'.$flexiInfo->image)) {
          unlink('asset/images/'.$flexiInfo->image);
      }
      $flexiInfo->delete();
      return redirect('/admin/view_flexi_info')->with('success_message', 'Data Deleted Successfully !!');
    }
    
    
     public function addContentInfo(Request $request){
      if ($request->isMethod('post')) {
        $contentInfo = new Content;
        $contentInfo->title = $request->title;
        $contentInfo->description = $request->description;
        if ($request->hasFile('image')) {
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename = 'content'. '.' .$extension;
            $path = 'asset/images/'.$filename;
            Image::make($image)->save($path);
          }
          $contentInfo->image = $filename;
        }

        $contentInfo->save();
        return redirect('/admin/view_content_info')->with('success_message', 'Data Added Successfully !!');
      }
      return view('admin.add_content_info');
    }


    public function viewContentInfo(){
      $contentInfos = Content::get();
      return view('admin.view_content_info')->with(compact('contentInfos'));
    }


    public function editContentInfo(Request $request, $id){
      if ($request->isMethod('post')) {
        $contentInfo = Content::find($id);
        $contentInfo->title = $request->title;
        $contentInfo->description = $request->description;

        if ($request->hasFile('image')) {
          $image = $request->file('image');
          if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $filename =  'content'. '.' .$extension;
            $path = 'asset/images/'.$filename;
            Image::make($image)->save($path);
          }
          $contentInfo->image = $filename;
        }
        $contentInfo->save();
        return redirect('/admin/view_content_info')->with('success_message', 'Data Updated Successfully !!');
      }
      $contentInfo = Content::find($id);
      return view('admin.edit_content_info')->with(compact('contentInfo'));
    }


    public function deleteContentInfo($id){
      $contentInfo = Content::find($id);
      if (file_exists('asset/images/'.$contentInfo->image)) {
          unlink('asset/images/'.$contentInfo->image);
      }
      $contentInfo->delete();
      return redirect('/admin/view_content_info')->with('success_message', 'Data Deleted Successfully !!');
    }
    
    public function addArticle(Request $request){
  if ($request->isMethod('post')) {
    $article = new Article;
    $article->page = $request->page;
    $article->title = $request->title;
    $article->description = $request->description;
 
    $article->save();
    return redirect('/admin/view_article')->with('success_message', 'Article Added Successfully !!');
  }
  $navbars = Navbar::get();
  return view('admin.article.add_article', compact('navbars'));
}

// View All Articles
public function viewArticle(){
  $articles = Article::with('navbar')->get();
  return view('admin.article.view_article', compact('articles'));
}

// Edit Article
public function editArticle(Request $request, $id){
  if ($request->isMethod('post')) {
    $article = Article::find($id);
    $article->page = $request->page;
    $article->title = $request->title;
    $article->description = $request->description;

    $article->save();
    return redirect('/admin/view_article')->with('success_message', 'Article Updated Successfully !!');
  }
  $article = Article::find($id);
  $navbars = Navbar::get();
  return view('admin.article.edit_article', compact('article', 'navbars'));
}

// Delete Article
public function deleteArticle($id){
  $article = Article::find($id);
  $article->delete();
  return redirect('/admin/view_article')->with('success_message', 'Article Deleted Successfully !!');
}
}
