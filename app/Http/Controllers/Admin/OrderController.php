<?php

namespace App\Http\Controllers\Admin;

use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // View all orders
    public function viewOrder()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.order.view_order', compact('orders'));
    }
    
    // View order details
    public function viewOrderDetails($id)
    {
        $order = Order::find($id);
        return view('admin.order.order_details', compact('order'));
    }
    
    // Update order status
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order->order_status = $request->order_status;
        $order->save();
        
        return redirect()->back()->with('success_message', 'Order Status Updated Successfully !!');
    }
    
    // Delete order
    public function deleteOrder($id)
    {
        $order = Order::find($id);
        $order->delete();
        
        return redirect('/admin/view_order')->with('success_message', 'Order Deleted Successfully !!');
    }
    
    // Filter orders by status
    public function filterOrders(Request $request)
    {
        $status = $request->status;
        if ($status == 'all') {
            $orders = Order::orderBy('id', 'desc')->get();
        } else {
            $orders = Order::where('order_status', $status)->orderBy('id', 'desc')->get();
        }
        
        return response()->json(['orders' => $orders]);
    }
    
    // Export orders to CSV
    public function exportOrders()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        
        $filename = "orders_" . date('Y-m-d') . ".csv";
        $handle = fopen($filename, 'w+');
        
        // Add headers
        fputcsv($handle, [
            'Order ID', 
            'Customer Name', 
            'Email', 
            'Phone', 
            'District', 
            'Package', 
            'Order Status', 
            'OTP Status', 
            'Created At'
        ]);
        
        // Add data
        foreach ($orders as $order) {
            fputcsv($handle, [
                $order->order_id,
                $order->client_name,
                $order->client_email,
                $order->client_phone,
                $order->client_district,
                $order->package_name,
                $order->order_status,
                $order->otp_status,
                $order->created_at
            ]);
        }
        
        fclose($handle);
        
        $headers = [
            'Content-Type' => 'text/csv',
        ];
        
        return response()->download($filename, $filename, $headers)->deleteFileAfterSend(true);
    }
}