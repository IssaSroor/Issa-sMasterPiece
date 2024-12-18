<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food_item;
use App\Models\Kitchen;
use App\Models\Kitchen_food_item;
use App\Models\Message;
use App\Models\Order;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KitchenController extends Controller
{

    public function allKitchens(Request $request)
    {
        $category = $request->input('category'); // Capture the category filter
        $filter = $request->input('filter');     // Capture the additional filters

        $kitchens = Kitchen::with([
            'categories', // Relation for categories
            'foodItems' => function ($query) {
                $query->select('food_items.id as food_item_id', 'food_items.kitchen_id', 'food_items.item_discount');
            }
        ])->where('kitchen_state', '=', 'approved')
            ->when($category, function ($query, $category) {
                $query->whereHas('categories', function ($query) use ($category) {
                    $query->where('category_name', $category);
                });
            })
            ->when($filter === 'free-delivery', function ($query) {
                $query->where('free_delivery', true);
            })
            ->when($filter === 'time', function ($query) {
                $query->orderBy('time_for_delivery');
            })
            ->when($filter === 'rating', function ($query) {
                $query->orderBy('kitchen_rating', 'desc');
            })
            ->paginate(10); // Paginate results for lazy loading

        foreach ($kitchens as $kitchen) {
            $kitchen->discount = $kitchen->foodItems->max('item_discount') ?? 0; // Max discount for items
        }

        return view('kitchen.index', compact('kitchens'));
    }



    public function index()
    {
        $newKitchens = Kitchen::orderBy('id', 'desc')->where('kitchen_state', '=', 'approved')
            ->limit(4)
            ->get();

        $popularKitchens = Kitchen::withCount('orders')
            ->where('kitchen_state', '=', 'approved')
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
        $kitchen = Kitchen::with('reviews.user', 'foodItems')->findOrFail($id);

        $averageRating = DB::table('kitchen_reviews')
            ->where('kitchen_id', $id)
            ->where('review_status', '=', 'approved')
            ->avg('review_rating');

        $bestSellers = DB::table('order_items')
            ->join('food_items', 'order_items.item_id', '=', 'food_items.id')
            ->join('kitchen_food_items', 'kitchen_food_items.item_id', '=', 'food_items.id')
            ->select(
                'food_items.id',
                'food_items.item_name',
                'food_items.item_description',
                'food_items.kitchen_id',
                'food_items.item_image',
                'food_items.item_price',
                'food_items.item_discount',
                DB::raw('SUM(order_items.quantity) as total_sales')
            )
            ->where('kitchen_food_items.kitchen_id', $id)
            ->groupBy('food_items.id', 'food_items.item_name', 'food_items.item_image', 'food_items.item_price')
            ->orderByDesc('total_sales')
            ->take(4)
            ->get();

        $reviews = $kitchen->reviews->where('review_status', '=', 'approved'); // Get the first 3 reviews

        return view('kitchen.show', compact('kitchen', 'bestSellers', 'reviews', 'averageRating'));
    }


    public function showRegistrationForm()
    {
        return view('kitchen.register');
    }

    // Handle the registration form submission
    public function registerKitchen(Request $request)
    {
        // Validate input data
        $request->validate([
            'kitchen_name' => 'required|string|max:255',
            'kitchen_short_desc' => 'required|string|max:255',
            'kitchen_description' => 'required|string',
            'kitchen_phone' => 'required|string|max:15',
            'kitchen_address' => 'required|string|max:255',
            'kitchen_image' => 'required|image|mimes:jpg,png,jpeg|min:1900',
            'time_for_delivery' => 'required|integer|min:1',
        ]);

        // Handle file upload
        $imagePath = $request->file('kitchen_image')->store('kitchens', 'public');

        // Save kitchen data
        Kitchen::create([
            'owner_id' => auth()->guard('owner')->user()->getAuthIdentifier(),
            'kitchen_name' => $request->kitchen_name,
            'kitchen_short_desc' => $request->kitchen_short_desc,
            'kitchen_description' => $request->kitchen_description,
            'kitchen_phone' => $request->kitchen_phone,
            'kitchen_address' => $request->kitchen_address,
            'kitchen_image' => basename($imagePath),
            'time_for_delivery' => $request->time_for_delivery,
        ]);

        return redirect()->route('owner.dashboard')->with('success', 'Kitchen registered successfully! Await approval.');
    }

    public function profile($id)
    {
        $kitchen = Kitchen::findOrFail($id);
        return view('kitchen.profile', compact('kitchen'));
    }
    public function orders(Request $request, $kitchenId)
    {
        $filter = $request->query('filter', 'confirmed'); // Default filter is 'confirmed'

        $orders = Order::where('kitchen_id', $kitchenId)
            ->where('order_status', $filter)
            ->orderBy('created_at', 'desc')
            ->get();

        $kitchen = Kitchen::findOrFail($kitchenId);

        return view('kitchen.orders.index', compact('orders', 'kitchen', 'filter'));
    }

    // KitchenController.php
    public function Messages($kitchenId)
    {
        $messages = Message::with('customer')
            ->where('kitchen_id', $kitchenId)
            ->get();

        $kitchen = Kitchen::findOrFail($kitchenId);

        return view('kitchen.messages.index', compact('messages', 'kitchen'));
    }

    public function items($id)
    {
        $kitchen = Kitchen::findOrFail($id);
        $items = Food_item::where('kitchen_id', $id)->get();
        return view('kitchen.items.index', compact('kitchen', 'items'));
    }
    public function showItem($kitchen_id, $item_id)
    {
        $kitchen = Kitchen::find($kitchen_id);
        $item = Food_item::find($item_id);
        return view('kitchen.items.show', compact('item', 'kitchen'));
    }

    public function editItem($kitchen_id, $item_id)
    {
        $kitchen = Kitchen::find($kitchen_id);
        $item = Food_item::find($item_id);
        return view('kitchen.items.edit', compact('item', 'kitchen'));
    }

    public function updateItem(Request $request, $kitchen_id, $item_id)
    {
        $kitchen = Kitchen::find($kitchen_id);
        $item = Food_item::find($item_id);
        $item->update($request->all());
        return redirect()->route('kitchen.items', $kitchen->id)->with('success', 'Item updated successfully');
    }

    public function destroy($kitchen_id, $item_id)
    {
        $kitchen = Kitchen::find($kitchen_id);
        $item = Food_item::find($item_id);
        $item->delete();
        return redirect()->route('kitchen.items.index', compact('kitchen'))->with('success', 'Item deleted successfully');
    }
    public function updateStatus(Request $request)
    {
        // dd($request);
        $validStatuses = ['opened', 'closed', 'busy'];
        if (in_array($request->status, $validStatuses)) {
            $kitchen = Kitchen::find($request->kitchen_id);
            $kitchen->kitchen_status = $request->status;
            $kitchen->save();
            return redirect()->route('kitchen.profile', $request->kitchen_id)->with('success', 'Kitchen status updated successfully!');
        }

        return redirect()->route('kitchen.profile', $request->kitchen_id)->with('error', 'Invalid status value.');
    }

    public function edit($id)
    {
        $kitchen = Kitchen::findOrFail($id);
        return view('kitchen.edit', compact('kitchen'));
    }

    public function addItem($id)
    {
        $kitchen = Kitchen::findOrFail($id);

        // Ensure the owner is authorized to access this kitchen
        if (auth()->id() !== $kitchen->owner_id) {
            abort(403, 'Unauthorized action.');
        }

        // Fetch all categories
        $categories = Category::all();

        return view('kitchen.items.add-item', compact('kitchen', 'categories'));
    }
    public function storeItem(Request $request, $id)
    {
        $kitchen = Kitchen::findOrFail($id);

        if (auth()->id() !== $kitchen->owner_id) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'item_description' => 'required|string|max:255',
            'item_price' => 'required|numeric|min:0',
            'item_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('item_image')) {
            $imagePath = $request->file('item_image')->store('items', 'public');
            $validatedData['item_image'] = $imagePath;
        }

        $validatedData['kitchen_id'] = $kitchen->id;

        // Create the item
        $foodItem = Food_item::create($validatedData);

        // Store the item_id and kitchen_id in kitchen_food_items table
        DB::table('kitchen_food_items')->insert([
            'item_id' => $foodItem->id,
            'kitchen_id' => $kitchen->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Check if the category exists in kitchen_categories for the kitchen
        $categoryExists = DB::table('kitchen_categories')
            ->where('kitchen_id', $kitchen->id)
            ->where('category_id', $validatedData['category_id'])
            ->exists();

        if (!$categoryExists) {
            // Insert into kitchen_categories table
            DB::table('kitchen_categories')->insert([
                'kitchen_id' => $kitchen->id,
                'category_id' => $validatedData['category_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('kitchen.items', $kitchen->id)
            ->with('success', 'Item added successfully!');
    }



    public function update(Request $request, $id)
    {
        $kitchen = Kitchen::findOrFail($id);

        // Validation
        $request->validate([
            'kitchen_name' => 'required|string|max:255',
            'kitchen_short_desc' => 'required|string|max:255',
            'kitchen_description' => 'required|string',
            'kitchen_phone' => 'required|string|max:15',
            'kitchen_address' => 'required|string|max:255',
            'free_delivery' => 'required|boolean',
            'time_for_delivery' => 'required|integer|min:1',
            'kitchen_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle Image Upload
        if ($request->hasFile('kitchen_image')) {
            $path = $request->file('kitchen_image')->store('kitchen_images', 'public');
            $kitchen->kitchen_image = $path;
        }

        // Update Kitchen Data
        $kitchen->update($request->except('kitchen_image'));

        return redirect()->route('kitchen.profile', $id)
            ->with('success', 'Kitchen updated successfully!');
    }

    public function showMenu(Request $request, $kitchenId)
    {
        // Fetch all categories
        $categories = Category::all();

        // Start query to fetch items for the given kitchen
        $menuItemsQuery = Food_item::where('kitchen_id', $kitchenId);

        // Apply search filter if search query is provided
        if ($request->has('search') && !empty($request->input('search'))) {
            $searchQuery = $request->input('search');
            $menuItemsQuery->where(function ($queryBuilder) use ($searchQuery) {
                $queryBuilder->where('item_name', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('item_description', 'LIKE', '%' . $searchQuery . '%');
            });
        }

        // Filter by category if provided
        if ($request->has('category') && $request->category != 'all') {
            $menuItemsQuery->where('category_id', $request->category);
        }

        // Filter by discounted items
        if ($request->has('discount')) {
            $menuItemsQuery->where('item_discount', '>', '0');
        }

        // Execute the query to get the items
        $menuItems = $menuItemsQuery->paginate(10);

        // Return the view with categories, items, and kitchenId
        return view('kitchen.menu', compact('menuItems', 'categories', 'kitchenId'));
    }

    public function storeMessage(Request $request)
    {
        // dd($request);
        // Validate the incoming data
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'kitchen_id' => 'required|exists:kitchens,id',
            'message_subject' => 'required|string|max:255',
            'message_text' => 'required|string',
        ]);

        // Create the message in the database
        Message::create($validated);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Message sent successfully!');
    }

}


