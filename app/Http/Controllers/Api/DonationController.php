<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Exception;

class DonationController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function createPaymentIntent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // Convert to cents
                'currency' => 'usd',
                'description' => 'Donation to Many Hands Resource Centre',
                'metadata' => [
                    'donor_name' => $request->first_name . ' ' . $request->last_name,
                    'donor_email' => $request->email,
                ],
            ]);

            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Payment failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'amount' => 'required|numeric|min:1',
            'message' => 'nullable|string',
            'is_anonymous' => 'boolean',
            'payment_intent_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Verify the payment intent with Stripe
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);
            
            if ($paymentIntent->status !== 'succeeded') {
                return response()->json([
                    'error' => 'Payment was not successful'
                ], 400);
            }

            $donation = Donation::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'amount' => $request->amount,
                'message' => $request->message,
                'is_anonymous' => $request->is_anonymous ?? false,
                'payment_method' => 'stripe',
                'payment_status' => 'completed',
                'transaction_id' => $paymentIntent->id,
            ]);

            return response()->json([
                'message' => 'Thank you for your donation!',
                'donation' => $donation
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to process donation: ' . $e->getMessage()
            ], 500);
        }
    }
}
