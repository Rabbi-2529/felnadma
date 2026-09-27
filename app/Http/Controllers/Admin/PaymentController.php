<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Add Payment
    public function addPayment(Request $request)
    {
        if ($request->isMethod('post')) {

            $payment = new Payment();

            $payment->account_name   = $request->account_name;
            $payment->account_number = $request->account_number;
            $payment->bank_name      = $request->bank_name;
            $payment->routing_number = $request->routing_number;
            $payment->branch_name    = $request->branch_name;
            $payment->type           = $request->type;
            $payment->mobile_company = $request->mobile_company;
            $payment->order_by       = $request->order_by;
            $payment->status         = $request->status ?? 1;

            $payment->save();

            return redirect('/admin/view_payments')
                ->with('success_message', 'Payment Method Added Successfully !!');
        }

        return view('admin.payments.add_payment');
    }

    // View All Payments
    public function viewPayment()
    {
        $payments = Payment::orderBy('order_by', 'asc')->get();

        return view('admin.payments.view_payments')
            ->with(compact('payments'));
    }

    // Edit Payment
    public function editPayment(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        if ($request->isMethod('post')) {

            $payment->account_name   = $request->account_name;
            $payment->account_number = $request->account_number;
            $payment->bank_name      = $request->bank_name;
            $payment->routing_number = $request->routing_number;
            $payment->branch_name    = $request->branch_name;
            $payment->type           = $request->type;
            $payment->mobile_company = $request->mobile_company;
            $payment->order_by       = $request->order_by;
            $payment->status         = $request->status ?? 1;

            $payment->save();

            return redirect('/admin/view_payments')
                ->with('success_message', 'Payment Method Updated Successfully !!');
        }

        return view('admin.payments.edit_payment')
            ->with(compact('payment'));
    }

    // Delete Payment
    public function deletePayment($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->delete();

        return redirect('/admin/view_payments')
            ->with('success_message', 'Payment Method Deleted Successfully !!');
    }
}