<?php

namespace App\Http\Controllers;
use App\Models\Kitchen;
use App\Models\Order;
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
}
