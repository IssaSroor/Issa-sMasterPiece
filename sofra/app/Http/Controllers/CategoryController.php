<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'category_name' => 'required|unique:categories|max:255',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('category_image')->store('categories', 'public');


        Category::create([
            'category_name' => $request->category_name,
            'category_image' => $imagePath,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully!');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|max:255|unique:categories,category_name,' . $category->id,
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload if a new image is provided
        if ($request->hasFile('category_image')) {
            // Delete old image
            if ($category->category_image) {
                Storage::disk('public')->delete($category->category_image);
            }

            $imagePath = $request->file('category_image')->store('categories', 'public');
            $category->category_image = $imagePath;
        }

        $category->category_name = $request->category_name;
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete the image file
        if ($category->category_image) {
            Storage::disk('public')->delete($category->category_image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}
