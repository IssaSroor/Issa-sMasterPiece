<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kitchen;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KitchenController extends Controller
{

    public function allKitchens()
{
    $kitchens = Kitchen::with(['foodItems' => function ($query) {
        $query->select('id', 'kitchen_id', 'item_discount'); // Fetch discounts if applicable
    }])->get();

    foreach ($kitchens as $kitchen) {
        $kitchen->discount = $kitchen->foodItems->max('discount') ?? 0; // Max discount for items
    }

    return view('kitchen.index', compact('kitchens'));
}

    public function index()
    {
        $newKitchens = Kitchen::orderBy('created_at', 'desc')
                              ->limit(4)
                              ->get();

        $popularKitchens = Kitchen::withCount('orders')
                                  ->orderBy('orders_count', 'desc')
                                  ->limit(4)
                                  ->get();

        return view('home', compact('newKitchens', 'popularKitchens'));
    }


    // Display all kitchens with filtering
    public function admin_index()
    {
        $pendingKitchens = Kitchen::where('kitchen_state', 'pending')->with('owner')->get(); 

        return view('admin.kitchens.index', compact('pendingKitchens'));
    }

    // Approve a kitchen
    public function approve($id)
    {
        $kitchen = Kitchen::findOrFail($id);
        $kitchen->update([
            'kitchen_state' => 'approved',
            'accepted_by' => Auth::id() // Record the admin who approved
        ]);

        return redirect()->route('admin.kitchens.admin_index')->with('success', 'Kitchen approved successfully.');
    }

    // Reject a kitchen
    public function reject($id)
    {
        $kitchen = Kitchen::findOrFail($id);
        $kitchen->update([
            'kitchen_state' => 'rejected',
            'accepted_by' => Auth::id() // Record the admin who rejected
        ]);

        return redirect()->route('admin.kitchens.admin_index')->with('error', 'Kitchen rejected successfully.');
    }
    public function admin_show($id)
{
    $kitchen = Kitchen::with('owner')->findOrFail($id); // Assuming `owner` relationship exists
    return view('admin.kitchens.show', compact('kitchen'));
}
public function show($id)
{
    $kitchen = Kitchen::with( 'reviews')->findOrFail($id);
    $bestSellers = DB::table('order_items')
    ->join('food_items', 'order_items.item_id', '=', 'food_items.id')
    ->join('kitchen_food_items', 'kitchen_food_items.item_id', '=', 'food_items.id')
    ->select(
        'food_items.item_name',
        'food_items.item_image',
        'food_items.item_price',
        DB::raw('SUM(order_items.quantity) as total_sales')
    )
    ->where('kitchen_food_items.kitchen_id', $id)
    ->groupBy('food_items.id', 'food_items.item_name', 'food_items.item_image', 'food_items.item_price')
    ->orderByDesc('total_sales')
    ->take(4)
    ->get();   
     $reviews = $kitchen->reviews()->with('user')->get();

    return view('kitchen.show', compact('kitchen', 'bestSellers', 'reviews'));
}
}


