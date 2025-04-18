<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\payment;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {
        $amount = 1; // ₹1
        $amountInPaise = $amount * 100;

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $order = $api->order->create([
            'receipt' => 'order_rcptid_11',
            'amount' => $amountInPaise,
            'currency' => 'INR'
        ]);

        Session::put('payment_amount', $amount);

        return view('payment', [
            'orderId' => $order['id'],  // Ensure this is passed
            'amount' => $amountInPaise,
            'showAmount' => $amount,
            'razorpayKey' => config('services.razorpay.key'),
        ]);
    }
    public function payment(Request $request)
    {
        $amount = 1; // ₹500, ya user input ke through aane wala amount
        $amountInPaise = $amount * 100; // Razorpay needs amount in paisa

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $order = $api->order->create([
            'receipt' => '123',
            'amount' => $amountInPaise,
            'currency' => 'INR'
        ]);
        return view('payment', [
            'orderId' => $order['id'],
            'amount' => $amountInPaise, // for Razorpay form
            'showAmount' => $amount     // for display
        ]);
    }
    public function verify(Request $request)
    {
        $data = $request->all();
        $signature = $data['razorpay_signature'];
        $order_id = $data['razorpay_order_id'];
        $payment_id = $data['razorpay_payment_id'];
        $amount = Session::get('payment_amount');

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $order_id,
                'razorpay_payment_id' => $payment_id,
                'razorpay_signature' => $signature
            ]);

            Payment::create([
                'order_id' => $order_id,
                'payment_id' => $payment_id,
                'signature' => $signature,
                'amount' => $amount,
                'status' => "success"
            ]);

            return " Payment Successful. Payment ID: $payment_id";
        } catch (\Exception $e) {
            return " Payment Verification Failed: " . $e->getMessage();
        }
    }
}
