<?php

namespace App\Http\Controllers;

use App\Models\WifiPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\OrangeOMService;
use Illuminate\Support\Str; // Import the Str class

class PaymentController extends Controller
{
    protected $orangeService;

    public function __construct(OrangeOMService $orangeService)
    {
        $this->orangeService = $orangeService;
    }

    public function showPaymentPage(Request $request)
    {
        $planId = $request->query('planId');
        $phoneNumber = $request->input('phoneNumber');
        
        return view('payment', compact('planId', 'phoneNumber'));
    }
    
    public function handlePayment(Request $request)
    {
        // Validate the request
        $request->validate([
            'planId' => 'required|numeric', // Assuming planId is numeric
            'phoneNumber' => 'required|string', // Assuming phoneNumber is string
        ]);

        // Retrieve data from request
        $planId = $request->input('planId');
        $userPhoneNumber = $request->input('phoneNumber');

        // Retrieve plan details from the database 
        $plan = WifiPlan::findOrFail($planId);

        // Generate a unique username
        $username = 'user_' . uniqid();

        // Generate a random password
        $password = Str::random(10); // Adjust the password length as needed

        // Prepare data for the MTN MoMo API request
        $data = [
            'amount' => $plan->amount, 
            'currency' => 'EUR', // Currency (adjust as needed)
            'external_id' => uniqid(), 
            'payer' => [
                'partyIdType' => 'MSISDN',
                'partyId' => $userPhoneNumber, 
            ],
            'payerMessage' => 'Payment for Wi-Fi plan', // Message to the payer
            'payeeNote' => 'Wi-Fi plan purchase', // Note for the payee
        ];

        // Make payment request to MTN Mobile Money API sandbox
        $response = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => env('MTN_SANDBOX_SUBSCRIPTION_KEY'), // Sandbox subscription key
            'Content-Type' => 'application/json',
        ])->post('https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay', $data);

        // Handle API response
        if ($response->successful()) {
            // Payment successful, send request to management app for user account creation
            $managementAppUrl = 'http://managementapp.example.com/api/create-user-account';
            $managementAppData = [
                'username' => $username,
                'password' => $password,
                'profile' => 'default', // User profile (adjust as needed)
            ];

            // Send request to management app API
            $managementAppResponse = Http::post($managementAppUrl, $managementAppData);

            // Check if the request was successful
            if ($managementAppResponse->successful()) {
                // User account created successfully
                // Redirect to the thank you page
                return redirect()->route('thankyou');
            } else {
                // Error in creating user account on management app
                // Log error or handle accordingly
                return back()->withError('Error creating user account on management app');
            }
        } else {
            // Payment failed, handle error
            $errorMessage = $response->json()['message'];
            // Log error or display error message to the user
            return back()->withError($errorMessage);
        }
    }

    public function initiatePayment(Request $request)
    {
        $result = $this->orangeService->initiatePayment($request->amount, $request->phoneNumber);
        return response()->json($result);
    }

    public function paymentCallback(Request $request)
    {
        // Handle Orange OM payment callback
    }

    public function thankYou()
    {
        // Generate login details, fetch plan details, etc.
        // Example data:
        $username = 'generated_username';
        $password = 'generated_password';

        // Pass data to the thank you page view
        return view('thankyou', compact('username', 'password'));
    }
}
