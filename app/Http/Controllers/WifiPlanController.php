<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WifiPlan; 

class WifiPlanController extends Controller
{
    public function index()
{
    $wifiPlans = WifiPlan::all();
    return view('welcome', ['wifiPlans' => $wifiPlans]);
}

public function show($id)
{
    $wifiPlan = WifiPlan::findOrFail($id);
    return view('plan-details', ['wifiPlan' => $wifiPlan]);
}

public function confirmPlan(Request $request)
{
    // Validate user input (e.g., phone number)
    $request->validate([
        'plan_id' => 'required',
        'phone_number' => 'required|numeric',
    ]);

    // Store plan selection and phone number in session or database
    $request->session()->put('plan_id', $request->input('plan_id'));
    $request->session()->put('phone_number', $request->input('phone_number'));

    return redirect()->route('payment');
}




}
