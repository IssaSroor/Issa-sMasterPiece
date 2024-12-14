<?php

namespace App\Http\Controllers;

use App\Models\Kitchen;
use App\Models\Owner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class OwnerController extends Controller
{

    public function showRegisterForm(){

        return view('owner.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|unique:owners,email',
            'password' => 'required|confirmed|min:6',
            'owner_address' => 'required|string|max:255',
        ]);
    
        $owner = Owner::create([
            'owner_name' => $validatedData['owner_name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'owner_address' => $validatedData['owner_address'],
        ]);
    
        // Debug: Check if owner was created
        if (!$owner) {
            return redirect()->back()->withErrors(['message' => 'Failed to register owner.']);
        }
    
        return redirect()->route('owner.login')->with('success', 'Registration successful! You can now log in.');
    }

    public function showLoginForm(){

        return view('owner.login');
    }

    public function login(Request $request)
    {
        // dd($request);
        // Attempt login
        if (Auth::guard('owner')->attempt([
            'email' => $request['email'],
            'password' => $request['password'],
        ])) {
            $owner = auth()->guard('owner')->user();
    
            // Check if the owner has a kitchen
            if($owner->kitchen){
                $kitchen = $owner->kitchen;
                return redirect()->route('owner.profile' , ['id' => $kitchen->id]);

            }

            return view('kitchen.register');
           
        }
    
        return redirect()->back()->withErrors(['message' => 'Invalid email or password.']);
    }
    


    
    public function logout(){
        
        Auth::guard('owner')->logout();
        return redirect()->route('owner.login');
    }


    public function dashboard()
    {
        $owner = auth()->guard('owner')->user();
    
        // Check if the owner has a kitchen
        // if($owner->kitchen){
            $kitchen = $owner->kitchen;
        // }
       
    
        return view('owner.dashboard', compact('kitchen'));
    }

    public function updateProfile(Request $request)
{
    $owner = auth()->guard('owner')->user();

    // Validate the request
    $request->validate([
        'owner_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $owner->id,
        'owner_address' => 'required|string|max:150',
    ]);

    // Update owner details
    $owner->update($request->only('owner_name', 'email','owner_address'));
    $kitchen = $owner->kitchen; // Adjust this line based on your relationship


    // Redirect with success message
    return redirect()->route('owner.profile', ['id' => $kitchen->id])
    ->with('success', 'Profile updated successfully!');}
public function profile($id)
{
    $kitchen = Kitchen::findOrFail($id);
    $owner = auth()->guard('owner')->user();
    return view('owner.profile', compact('owner','kitchen'));
}

}
