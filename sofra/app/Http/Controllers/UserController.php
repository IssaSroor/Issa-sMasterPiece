<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
{
    return redirect()->route('user.account-info');
}

public function accountInfo()
{
    return view('user.account-info');
}

public function updateAccount(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ]);

    auth()->user()->update($request->only('name', 'email'));

    return back()->with('success', 'Account updated successfully.');
}

public function orders()
{
    $orders = auth()->user()->orders; // Assuming a relationship exists
    return view('user.orders', compact('orders'));
}

}
