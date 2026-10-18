<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    // ==========================================================
    // Add Payment
    // ==========================================================
    public function addPayment(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'account_name'   => 'required|string|max:255',
                'account_number' => 'required|string|max:255',
                'type'           => 'required|in:bank,mobile',
                'logo'           => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            ]);

            $payment = new Payment();

            $payment->account_name   = $request->account_name;
            $payment->account_number = $request->account_number;
            $payment->bank_name      = $request->bank_name;
            $payment->routing_number = $request->routing_number;
            $payment->branch_name    = $request->branch_name;
            $payment->type           = $request->type;
            $payment->mobile_company = $request->mobile_company;
            $payment->order_by       = $request->order_by ?? 0;
            $payment->status         = $request->status ?? 1;

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $payment->logo = $this->uploadLogo($request->file('logo'), $request);
            }

            $payment->save();

            return redirect('/admin/view_payments')
                ->with('success_message', 'Payment Method Added Successfully !!');
        }

        return view('admin.payments.add_payment');
    }

    // ==========================================================
    // View All Payments
    // ==========================================================
    public function viewPayment()
    {
        $payments = Payment::orderBy('order_by', 'asc')->get();

        return view('admin.payments.view_payments')
            ->with(compact('payments'));
    }

    // ==========================================================
    // Edit Payment
    // ==========================================================
    public function editPayment(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        if ($request->isMethod('post')) {

            $request->validate([
                'account_name'   => 'required|string|max:255',
                'account_number' => 'required|string|max:255',
                'type'           => 'required|in:bank,mobile',
                'logo'           => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            ]);

            $payment->account_name   = $request->account_name;
            $payment->account_number = $request->account_number;
            $payment->bank_name      = $request->bank_name;
            $payment->routing_number = $request->routing_number;
            $payment->branch_name    = $request->branch_name;
            $payment->type           = $request->type;
            $payment->mobile_company = $request->mobile_company;
            $payment->order_by       = $request->order_by ?? 0;
            $payment->status         = $request->status ?? 1;

            // Handle new logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo file
                if ($payment->logo && file_exists(base_path('asset/images/' . $payment->logo))) {
                    @unlink(base_path('asset/images/' . $payment->logo));
                }

                $payment->logo = $this->uploadLogo($request->file('logo'), $request);
            }

            // Handle logo removal
            if ($request->has('remove_logo') && $request->remove_logo == 1) {
                if ($payment->logo && file_exists(base_path('asset/images/' . $payment->logo))) {
                    @unlink(base_path('asset/images/' . $payment->logo));
                }
                $payment->logo = null;
            }

            $payment->save();

            return redirect('/admin/view_payments')
                ->with('success_message', 'Payment Method Updated Successfully !!');
        }

        return view('admin.payments.edit_payment')
            ->with(compact('payment'));
    }

    // ==========================================================
    // Delete Payment
    // ==========================================================
    public function deletePayment($id)
    {
        $payment = Payment::findOrFail($id);

        // Delete logo file
        if ($payment->logo && file_exists(base_path('asset/images/' . $payment->logo))) {
            @unlink(base_path('asset/images/' . $payment->logo));
        }

        $payment->delete();

        return redirect('/admin/view_payments')
            ->with('success_message', 'Payment Method Deleted Successfully !!');
    }

    // ==========================================================
    // Helper: Upload logo to asset/images/
    // ==========================================================
    private function uploadLogo($file, Request $request)
    {
        // Ensure directory exists
        $dir = base_path('asset/images');
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $base = $request->bank_name ?: $request->mobile_company ?: 'payment';
        $base = Str::slug($base);
        if (empty($base)) {
            $base = 'payment';
        }

        $filename = time() . '_' . $base . '.' . strtolower($file->getClientOriginalExtension());

        $file->move($dir, $filename);

        return $filename;
    }
}