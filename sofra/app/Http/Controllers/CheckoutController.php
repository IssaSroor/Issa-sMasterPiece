<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
{
    // Check if user is authenticated
    if (auth()->check()) {
        $userData = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->customer_phone,
            'address' => auth()->user()->customer_address,
        ];

        // Retrieve cart items from cookies
        $cartCookie = isset($_COOKIE['cart']) ? $_COOKIE['cart'] : null;

        $cartItems = $cartCookie ? json_decode($cartCookie, true) : [];
        $subtotal = array_reduce($cartItems, function ($total, $item) {
            return $total + ($item['productPrice'] * $item['quantity']);
        }, 0);

        return view('checkout', compact('userData', 'cartItems', 'subtotal'));
    } else {
        return redirect()->route('register')->with('error', 'You need to log in to proceed to checkout.');
    }
}


public function placeOrder(Request $request)
{
    // Access the cart from $_COOKIE
    $cart = [];
    if (isset($_COOKIE['cart'])) {
        $cart = json_decode($_COOKIE['cart'], true);
    }

    // Check if the cart is empty
    if (empty($cart)) {
        return back()->with('error', 'Cart is empty.');
    }

    // Calculate the total amount
    $subtotal = array_reduce($cart, function ($carry, $item) {
        return $carry + ($item['productPrice'] * $item['quantity']);
    }, 0);
    $deliveryFee = 2; // Static delivery fee
    $totalAmount = $subtotal + $deliveryFee;

    // Get user details
    $user = Auth::user();

    // Create the order
    $order = Order::create([
        'customer_id' => $user->id,
        'kitchen_id' => $cart[0]['kitchenId'], // Assuming all items belong to the same kitchen
        'order_total_amount' => $totalAmount,
        'order_address' => $user->customer_address ?? 'Default Address', // Adjust based on your setup
        'order_status' => 'Confirmed', // Default order status
        'order_payment_status' => 'Unpaid', // Default payment status
        'managed_by' => 0, // Add if an admin manages orders
    ]);

    // Create order items
    foreach ($cart as $item) {
        Order_item::create([
            'order_id' => $order->id,
            'item_id' => $item['productId'], // Assuming 'productId' refers to the item's ID
            'quantity' => $item['quantity'],
            'price' => $item['productPrice'],
        ]);
    }

    // Clear the cart cookie
    cookie()->queue(cookie()->forget('cart'));

    // Redirect with SweetAlert and success message
    return redirect()->route('thankyou.page')->with('success', 'Order placed successfully!');
}

}
