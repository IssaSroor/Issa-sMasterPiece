<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        try {
            // Validate the input
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
                'customer_address' => 'required|string|max:255',
                'customer_phone' => 'required|numeric|digits:10',
            ]);


            // Update the user
            auth()->user()->update($request->only('name', 'email', 'customer_address', 'customer_phone'));

            // Pass success message to the session
            return back()->with('success', 'Account updated successfully.');
        } catch (\Exception $e) {
            // Pass error message to the session
            return back()->with('error', 'An error occurred while updating the account. Please try again.');
        }
    }

    public function orders()
    {
        // Fetch user orders and eager load related food items
        $orders = auth()->user()->orders()
            ->with('items') // Load related food items
            ->orderBy('created_at', 'desc')
            ->get();

        // Add a has_review attribute based on the is_reviewed column
        $orders->each(function ($order) {
            $order->has_review = $order->is_reviewed == 1;
        });

        return view('user.orders', compact('orders'));
    }



    public function showOrder($id)
    {
        $order = Order::with('items')->findOrFail($id);

        return response()->json([
            'id' => $order->id,
            'created_at' => $order->created_at,
            'order_total_amount' => $order->order_total_amount,
            'order_status' => $order->order_status,
            'food_items' => $order->items->map(function ($item) {
                return [
                    'name' => $item->foodItem->item_name,
                    'quantity' => $item->quantity,
                    'price' => $item->foodItem->item_price,
                ];
            }),
        ]);
    }


}
