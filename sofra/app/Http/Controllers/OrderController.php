<?php

namespace App\Http\Controllers;
use App\Models\Kitchen;
use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Get all kitchens and their orders
        $kitchens = Kitchen::with('orders.customer')->get();
        return view('admin.orders.index', compact('kitchens'));
    }

    public function show($id)
    {
        // Get orders for a specific kitchen
        $kitchen = Kitchen::with('orders')->findOrFail($id);
        return view('admin.orders.show', compact('kitchen'));
    }

    public function edit($id, $orderId)
    {
        // Fetch the kitchen and the order
        $kitchen = Kitchen::findOrFail($id);
        $order = Order::findOrFail($orderId);

        return view('kitchen.orders.edit', compact('kitchen', 'order'));
    }

    public function view($id, $orderId)
    {
        // Fetch the kitchen and the order
        $kitchen = Kitchen::findOrFail($id);
        $order = Order::findOrFail($orderId);
        $orderItems = Order_item::findOrFail($orderId);

        return view('kitchen.orders.view', compact('kitchen', 'order', 'orderItems'));
    }
    public function update(Request $request, $id, $order_id)
    {
        // Validate incoming data
        $request->validate([
            'order_status' => 'required|in:confirmed,prepared,on delivery',
        ]);

        // Find the order by its ID and ensure it's in the correct kitchen
        $order = Order::where('id', $order_id)->where('kitchen_id', $id)->first();

        if (!$order) {
            return redirect()->route('kitchen.orders', ['id' => $id])
                ->with('error', 'Order not found.');
        }

        // Update the order status
        $order->order_status = $request->input('order_status');

        // If the status is 'on delivery', update the order_payment_status to 'paid'
        if ($request->input('order_status') === 'on delivery') {
            $order->order_payment_status = 'paid';
        }

        // Save the order
        $order->save();

        // Redirect with success message
        return redirect()->route('kitchen.orders', ['id' => $id])
            ->with('success', 'Order status updated successfully.');
    }



}
