<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Hash;
use App\Models\User;
use App\Models\Kitchen;
use App\Models\Order;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function create()
    {
        return view('admin.auth.login'); // Admin login view
    }

    public function store(Request $request)
    {

        if (
            Auth::guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])
        ) {
            // dd(Auth::guard('admin')->user());

            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    public function destroy()
    {

        Auth::guard('admin')->logout();
        session()->invalidate();

        session()->regenerateToken();

        return view('admin.auth.login');

    }

    public function dashboard()
    {
        $totalCustomers = User::count();
        $totalKitchens = Kitchen::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('order_total_amount');
        $activeKitchens = Kitchen::where('kitchen_status', 'opened')->count();
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $resolvedQuestions = Question::whereNotNull('resolved_by')->count();
        $newCustomers = User::where('created_at', '>', now()->subMonth())->count();
        $newKitchens = Kitchen::where('created_at', '>', now()->subMonth())->count();
        $averageKitchenRating = Kitchen::avg('kitchen_rating');
        $topKitchens = Kitchen::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->limit(5)
            ->get();

        // Get the top performing kitchen (with the most orders)
        $topPerformingKitchen = $topKitchens->first();

        // Return the dashboard view with the statistics data
        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalKitchens',
            'totalOrders',
            'totalRevenue',
            'activeKitchens',
            'pendingOrders',
            'resolvedQuestions',
            'newCustomers',
            'newKitchens',
            'averageKitchenRating',
            'topPerformingKitchen',
            'topKitchens',
        ));
    }

    public function index()
    {
        $admins = Admin::all(); // Fetch all admins
        return view('admin.admins.index', compact('admins'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed',
            'admin_role' => 'required|in:super_admin,admin',
        ]);

        Admin::create([
            'admin_name' => $request->admin_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin_role' => $request->admin_role,
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin added successfully.');
    }

    public function showaddpage()
    {
        return view('admin.admins.create');
    }

    public function editadmin($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admins.edit', compact('admin'));
    }

    public function updateadmin(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255', // Validate 'name' instead of 'admin_name'
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'role' => 'required|in:super_admin,admin', // Validate 'role' instead of 'admin_role'
        ]);

        $admin->update([
            'admin_name' => $request->name, // Update 'admin_name' using 'name' input
            'email' => $request->email,
            'admin_role' => $request->role, // Update 'admin_role' using 'role' input
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
    }


    public function destroyadmin($id)
    {
        $admin = Admin::findOrFail($id);

        if ($admin->admin_role === 'super_admin' && Admin::where('admin_role', 'super_admin')->count() <= 1) {
            return redirect()->route('admin.admins.index')->with('error', 'Cannot delete the only super admin.');
        }

        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully.');
    }


}
