<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function view_category()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function add_category(Request $request)
    {
        $data = new Category;
        $data->category_name = $request->category;
        $data->save();

        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return redirect()->back()->with('message', 'Category Deleted Successfully');
        }
        return redirect()->back()->with('error', 'Category not found');
    }

    public function view_product()
    {
        $categories = Category::all();
        return view('admin.product', compact('categories'));
    }

    public function add_product(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'quantity' => 'required|integer',
                'category' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'discount' => 'nullable|numeric'
            ]);

            $product = new Product();
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->category = $request->category;
            $product->discount = $request->discount ?? 0;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('product_images'), $imageName);
                $product->image = $imageName;
            }

            $saved = $product->save();
            
            if ($saved) {
                return redirect()->back()->with('message', 'Product Added Successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to save product');
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function test_add_product()
    {
        try {
            $product = new Product();
            $product->title = 'Test Product';
            $product->description = 'This is a test product';
            $product->price = 99.99;
            $product->quantity = 10;
            $product->category = 'Test Category';
            $product->discount = 0;
            
            $saved = $product->save();
            
            if ($saved) {
                return response()->json(['success' => true, 'message' => 'Test product created successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to save test product']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function show_product()
    {
        $products = Product::all();
        return view('admin.show_product', compact('products'));
    }

    public function delete_product($id)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                // Delete image file if exists
                if ($product->image && file_exists(public_path('product_images/' . $product->image))) {
                    unlink(public_path('product_images/' . $product->image));
                }
                
                $product->delete();
                return redirect()->back()->with('message', 'Product Deleted Successfully');
            }
            return redirect()->back()->with('error', 'Product not found');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }

    public function update_product($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect('show_product')->with('error', 'Product not found');
        }
        
        $categories = Category::all();
        return view('admin.update_product', compact('product', 'categories'));
    }

    public function edit_product(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'quantity' => 'required|integer',
                'category' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'discount' => 'nullable|numeric'
            ]);

            $product = Product::find($id);
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found');
            }

            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->category = $request->category;
            $product->discount = $request->discount ?? 0;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($product->image && file_exists(public_path('product_images/' . $product->image))) {
                    unlink(public_path('product_images/' . $product->image));
                }
                
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('product_images'), $imageName);
                $product->image = $imageName;
            }

            $saved = $product->save();
            
            if ($saved) {
                return redirect('show_product')->with('message', 'Product Updated Successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update product');
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}