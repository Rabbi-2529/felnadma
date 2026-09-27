<?php

namespace App\Http\Controllers\Frontend;

use App\Model\About;
use App\Model\Package;
use App\Model\Contact;
use App\Model\CustomerSupport;
use App\Model\Facility;
use App\Model\FooterLink;
use App\Model\ParentLink;
use App\Model\Price;
use App\Model\Payment;
use App\Model\Offer;
use App\Model\Seo;
use App\Model\Content;
use App\Model\Flexi;
use App\Model\FacebookMarketing;
use App\Model\Navbar;
use App\Model\PriceHeader;
use App\Model\SmsMarketing;
use App\Model\MarketingImage;
use App\Model\SmsOffer;
use App\Model\Terms;
use App\Model\Order; 
use App\Model\MetaTag;
use App\Model\WhyChooseUs;
use App\Model\Article;  // Add this line
use Illuminate\Support\Facades\Session;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
  public function index(){
    $smsOffer = SmsOffer::first();
    $smsMarketing = SmsMarketing::get();
    $marketingImage = MarketingImage::first();
    $whyChoose = WhyChooseUs::get();

    $metaTag = MetaTag::where('nav', '/')->first();
    $article = Article::where('page', '/')->first();  // Add this line

    $offer = Offer::orderBy('id', 'desc')->first();

    // Lowest SMS rate across all packages (rows like "0.25 BDT"), shown in the homepage hero
    $startingPrice = Price::pluck('price')
        ->map(function ($price) {
            return preg_match('/^\s*(\d+(?:\.\d+)?)/', $price, $m) && stripos($price, 'bdt') !== false ? (float) $m[1] : null;
        })
        ->filter()
        ->min();

    return view('frontend.index', compact('smsOffer', 'smsMarketing', 'marketingImage', 'whyChoose', 'offer', 'metaTag', 'article', 'startingPrice'));
  }

   public function price()
    {
        $priceHeader = PriceHeader::first();
        $packages = Package::orderBy('package_no', 'asc')->get();
        $metaTag = MetaTag::where('nav', '/bulk-sms-service')->first();
        $article = Article::where('page', '/bulk-sms-service')->first();  // Add this line
        return view('frontend.price', compact('packages', 'priceHeader', 'metaTag', 'article'));
    }

    // Step 1: Send OTP to user's phone
  public function sendOtp(Request $request)
{
    $otp = rand(100000, 999999); // 6-digit OTP
    Session::put('order_data', $request->all());
    Session::put('otp_code', $otp);

    $clientPhone = $request->client_phone;

    // Log the phone number to the Laravel log
    \Log::info("Sending OTP to client phone: " . $clientPhone);

    $message = "Your OTP for order confirmation is: " . $otp;

    $api_key = config('services.sms.key');
    $sender_id = "01844532632";
    $sms_type = "1"; // Added sms_type parameter
    
    $client = new Client(['verify' => false]);
    
    // Added sms_type to the API URL
    $api_url = "https://sms.iglweb.com/api/v1/send?api_key=".$api_key.
               "&contacts=".$clientPhone.
               "&senderid=".$sender_id.
               "&type=".$sms_type.
               "&msg=".urlencode($message);

    try {
        $response = $client->request('GET', $api_url);
        $json_response = $response->getBody()->getContents();
        $api_response = json_decode($json_response);

        \Log::info("SMS API Response: " . $json_response); // Log the response

        if ($api_response->code == "445000") {
            return response()->json([
                'status' => 'success', 
                'message' => 'OTP sent to your phone', 
                'phone' => $clientPhone
            ]);
        } else {
            $errorMsg = $api_response->message ?? 'Unknown error';
            \Log::error("SMS API Error: " . $errorMsg);
            
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to send OTP: ' . $errorMsg, 
                'phone' => $clientPhone
            ]);
        }
    } catch (\Exception $e) {
        \Log::error("SMS API Exception: " . $e->getMessage());
        
        return response()->json([
            'status' => 'error', 
            'message' => 'Failed to send OTP: ' . $e->getMessage(), 
            'phone' => $clientPhone
        ]);
    }
}


    // Step 2: Confirm order with OTP
    public function confirmOrder(Request $request)
    {
        $enteredOtp = $request->otp;
        $savedOtp = Session::get('otp_code');
        $orderData = Session::get('order_data');

        if ($enteredOtp == $savedOtp && $orderData) {
            
            // Generate unique order ID
            $orderId = 'SMS' . date('YmdHis') . rand(10, 999);
            
            // SAVE ORDER TO DATABASE
            try {
                $order = Order::create([
                    'order_id' => $orderId,
                    'client_name' => $orderData['client_name'],
                    'client_email' => $orderData['client_email'],
                    'client_phone' => $orderData['client_phone'],
                    'client_district' => $orderData['client_district'],
                    'package_name' => $orderData['package_name'],
                    'otp_code' => $enteredOtp,
                    'otp_status' => 'verified',
                    'order_status' => 'pending',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
                \Log::info("Order saved successfully: " . $orderId);
                
            } catch (\Exception $e) {
                \Log::error("Failed to save order: " . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Failed to save order: ' . $e->getMessage()]);
            }
            
            // Send order notification to admin
            $mobile_number = '01958666951';
            $message = "New Lead Alert!\n";
            $message .= "Order ID: " . $orderId . "\n";
            $message .= "Name: " . $orderData['client_name'] . "\n";
            $message .= "District: " . $orderData['client_district'] . "\n";
            $message .= "Package: " . $orderData['package_name'] . "\n";
            $message .= "Mobile: " . $orderData['client_phone'] . "\n";
            $message .= "Email: " . $orderData['client_email'];
            
            $api_key = config('services.sms.key');
            $sender_id = "01844532632";
            $client = new Client(['verify' => false]);
            $api_url = "https://sms.iglweb.com/api/v1/send?api_key=".$api_key."&contacts=".$mobile_number."&senderid=".$sender_id."&msg=".urlencode($message);

            try {
                $response = $client->request('GET', $api_url);
                $json_response = $response->getBody()->getContents();
                $api_response = json_decode($json_response);

                // Update order with API response
                $order->update([
                    'api_response' => $json_response,
                    'message_response' => $api_response->code ?? null
                ]);

                if ($api_response->code == "445000") {
                    // Update order status
                    $order->update(['order_status' => 'confirmed']);
                    
                    // Clear session
                    Session::forget('otp_code');
                    Session::forget('order_data');
                    
                    return response()->json([
                        'status' => 'success', 
                        'message' => 'Thanks For Your Order! We Will Contact You Soon',
                        'order_id' => $orderId
                    ]);
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Failed to send order notification']);
                }
            } catch (\Exception $e) {
                \Log::error("Admin SMS notification failed: " . $e->getMessage());
                
                // Still return success because order is saved
                Session::forget('otp_code');
                Session::forget('order_data');
                
                return response()->json([
                    'status' => 'success', 
                    'message' => 'Thanks For Your Order! We Will Contact You Soon',
                    'order_id' => $orderId
                ]);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid OTP, please try again']);
        }
    }
    
  public function terms(){
    $terms = Terms::first();
    $article = Article::where('page', '/terms')->first();  // Add this line
    return view('frontend.terms', compact('terms', 'article'));
  }

  public function contact(){
    $contacts = Contact::get();
    $metaTag = MetaTag::where('nav', '/contact')->first();
    $article = Article::where('page', '/contact')->first();  // Add this line
    return view('frontend.contact', compact('contacts', 'metaTag', 'article'));
  }

public function callRequest(Request $request){
    $mobile_number = '01958666951';
    
    // Build comprehensive message with all form fields
    $message = "Name: " . $request->client_name;
    $message .= ". Phone: " . $request->client_phone;
    
    // Add WhatsApp availability status - show "WP" if Yes, nothing if No
    if($request->whatsapp_available == 1){
        $message .= " (WAN)";
    }
    // If No, don't add anything to the message
    
    // Add reason for contact
    $message .= ". Reason: " . $request->request_reason;
    
    // Add additional details if provided
    if(!empty($request->client_details)){
        $message .= ". Details: " . $request->client_details;
    }
    
    $message = urlencode($message);
    $api_key = config('services.sms.key');
    $sender_id = "01844532632";
    $client = new Client(['verify' => false]);
    $api_url = "https://sms.iglweb.com/api/v1/send?api_key=". $api_key ."&contacts=". $mobile_number ."&senderid=". $sender_id ."&msg=".$message;
    $response = $client->request('GET', "$api_url");
    $json_response = $response->getBody()->getContents();
    $api_response = json_decode($json_response);

    if ($api_response->code == "445000") {
        return back()->with('toast_success', 'Your Request Has Successfully Placed! We Will Contact You Soon');
    } else {
        return back()->with('toast_error', 'Something Went Wrong! Please Try Again');
    }
}
 public function orderRequest(Request $request)
    {
        // Validate request
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:20',
            'client_district' => 'required|string',
            'package_name' => 'required|string',
        ]);
        
        // Generate unique order ID
        $orderId = 'SMS' . date('YmdHis') . rand(100, 999);
        
        // Save order to database first
        $order = Order::create([
            'order_id' => $orderId,
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'client_phone' => $request->client_phone,
            'client_district' => $request->client_district,
            'package_name' => $request->package_name,
            'order_status' => 'pending',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        
        // Prepare SMS message
        $mobile_number = '01958666951';
        $message = "New Order Alert!\n";
        $message .= "Order ID: " . $orderId . "\n";
        $message .= "Name: " . $request->client_name . "\n";
        $message .= "District: " . $request->client_district . "\n";
        $message .= "Package: " . $request->package_name . "\n";
        $message .= "Mobile: " . $request->client_phone . "\n";
        $message .= "Email: " . $request->client_email;
        
        $message = urlencode($message);
        $api_key = config('services.sms.key');
        $sender_id = "01844532632";
        
        try {
            $client = new Client(['verify' => false]);
            $api_url = "https://sms.iglweb.com/api/v1/send?api_key=" . $api_key . "&contacts=" . $mobile_number . "&senderid=" . $sender_id . "&msg=" . $message;
            
            $response = $client->request('GET', $api_url);
            $json_response = $response->getBody()->getContents();
            $api_response = json_decode($json_response);
            
            // Update order with API response
            $order->update([
                'api_response' => $json_response,
                'message_response' => $api_response->code ?? null
            ]);
            
            if ($api_response->code == "445000") {
                // Update order status
                $order->update(['order_status' => 'confirmed']);
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Thanks For Your Order! We Will Contact You Soon',
                    'order_id' => $orderId
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Something Went Wrong! Please Try Again'
                ]);
            }
            
        } catch (\Exception $e) {
            // Log error but keep order record
            $order->update([
                'message_response' => 'Error: ' . $e->getMessage()
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Something Went Wrong! Please Try Again'
            ]);
        }
    }
  public function seo(){
    $seo = Seo::first();
    $metaTag = MetaTag::where('nav', '/search-engine-optimize')->first();
    $article = Article::where('page', '/search-engine-optimize')->first();  // Add this line
    return view('frontend.seo', compact('seo', 'metaTag', 'article'));
  }

  public function fbMarketing(){
    $fbMarketing = FacebookMarketing::first();
    $metaTag = MetaTag::where('nav', '/facebook-marketing')->first();
    $article = Article::where('page', '/facebook-marketing')->first();  // Add this line
    return view('frontend.fb_marketing', compact('fbMarketing', 'metaTag', 'article'));
  }

  public function flexiSolution(){
    $flexi = Flexi::first();
    $metaTag = MetaTag::where('nav', '/flexi-load-solution')->first();
    $article = Article::where('page', '/flexi-load-solution')->first();  // Add this line
    return view('frontend.flexi', compact('flexi', 'metaTag', 'article'));
  }
  
  public function flexiRequest(Request $request)
{
    $request->validate([
        'client_name' => 'required|string|max:100',
        'client_phone' => ['required', 'regex:/^01[3-9][0-9]{8}$/'],
        'client_company' => 'nullable|string|max:150',
        'client_email' => 'nullable|email|max:150',
        'flexi_title' => 'nullable|string|max:150',
    ]);

    $mobile_number = '01958666951'; 

    $message = 
               "Name: " . $request->client_name
             . "\nPhone: " . $request->client_phone
             . "\nCompany: " . ($request->client_company ?? 'N/A')
             . "\nEmail: " . ($request->client_email ?? 'N/A')
             . "\nOffer: " . ($request->flexi_title ?? 'Unknown');

    $message = urlencode($message);

    $api_key = config('services.sms.key');
    $sender_id = "01844532632";

    $client = new Client(['verify' => false]);
    $api_url = "https://sms.iglweb.com/api/v1/send?api_key=" . $api_key
             . "&contacts=" . $mobile_number
             . "&senderid=" . $sender_id
             . "&msg=" . $message;

    try {
        $response = $client->request('GET', $api_url);
        $json_response = $response->getBody()->getContents();
        $api_response = json_decode($json_response);

        if (!empty($api_response->code) && $api_response->code == "445000") {
            return back()->with('toast_success', 'Thank you! Your request has been sent successfully.');
        } else {
            return back()->with('toast_error', 'Something went wrong while sending your request.');
        }
    } catch (\Exception $e) {
        return back()->with('toast_error', 'Error: ' . $e->getMessage());
    }
}
  
    public function content(){
    $content = Content::first();
    $metaTag = MetaTag::where('nav', '/content')->first();
    $article = Article::where('page', '/content')->first();  // Add this line
    return view('frontend.content', compact('content', 'metaTag', 'article'));
  }
public function payment()
{
    $metaTag = MetaTag::where('nav', '/payment')->first();
    $article = Article::where('page', '/payment')->first();

    $meta_image = $metaTag->meta_image ?? null;

    $bankPayments = Payment::where('type', 'bank')
        ->where('status', 1)
        ->orderBy('order_by', 'asc')
        ->get();

    $mobilePayments = Payment::where('type', 'mobile')
        ->where('status', 1)
        ->orderBy('order_by', 'asc')
        ->get();
    
    return view('frontend.payment', compact(
        'metaTag',
        'article',
        'bankPayments',
        'mobilePayments',
        'meta_image'
    ));
}
 public function contentCallRequest(Request $request)
{
    $request->validate([
        'client_name' => 'required|string|max:100',
        'client_phone' => ['required', 'regex:/^01[3-9][0-9]{8}$/'],
        'client_text' => 'required|string|max:500',
    ]);

    $mobile_number = '01958666951';
    $message = "My Name is: " . $request->client_name . 
               ". My Message: " . $request->client_text . 
               ". My Mobile number is: " . $request->client_phone;
    
    $message = urlencode($message);
    $api_key = config('services.sms.key');
    $sender_id = "01844532632";
    $client = new Client(['verify' => false]);
    $api_url = "https://sms.iglweb.com/api/v1/send?api_key=". $api_key ."&contacts=". $mobile_number ."&senderid=". $sender_id ."&msg=".$message;
    
    $response = $client->request('GET', "$api_url");
    $json_response = $response->getBody()->getContents();
    $api_response = json_decode($json_response);

    if ($api_response->code == "445000") {
        return back()->with('toast_success', 'Your Request Has Been Successfully Placed! We Will Contact You Soon');
    } else {
        return back()->with('toast_error', 'Something Went Wrong! Please Try Again');
    }
}
}