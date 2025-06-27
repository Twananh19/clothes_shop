<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

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

    public function view_order()
    {
        $orders = Order::with('product', 'user')->get();
        return view('admin.order', compact('orders'));
    }

    public function update_order_status(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|string|in:pending,processing,completed,canceled',
            ]);

            $order = Order::find($id);
            if (!$order) {
                return redirect()->back()->with('error', 'Order not found');
            }

            $order->status = $request->status;
            $order->save();

            return redirect()->back()->with('message', 'Order status updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function delete_order($id)
    {
        try {
            $order = Order::find($id);
            if ($order) {
                $order->delete();
                return redirect()->back()->with('message', 'Order deleted successfully');
            }
            return redirect()->back()->with('error', 'Order not found');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting order: ' . $e->getMessage());
        }
    }

    public function view_orders(Request $request)
    {
        $query = Order::query();

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('payment_status', $request->status);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search by customer name or email
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', '%' . $search . '%')
                  ->orWhere('customer_email', 'like', '%' . $search . '%');
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders', compact('orders'));
    }

    public function order_details($id)
    {
        $order = Order::findOrFail($id);
        
        $html = '<div class="order-detail-content">';
        $html .= '<h6>Order #' . $order->id . '</h6>';
        $html .= '<p><strong>Customer:</strong> ' . $order->customer_name . '</p>';
        $html .= '<p><strong>Email:</strong> ' . $order->customer_email . '</p>';
        $html .= '<p><strong>Phone:</strong> ' . $order->customer_phone . '</p>';
        $html .= '<p><strong>Address:</strong> ' . $order->customer_address . '</p>';
        $html .= '<p><strong>Total Amount:</strong> $' . number_format($order->total_amount, 2) . '</p>';
        $html .= '<p><strong>Payment Status:</strong> ' . ucfirst($order->payment_status) . '</p>';
        $html .= '<p><strong>Order Date:</strong> ' . $order->created_at->format('M d, Y H:i:s') . '</p>';
        
        $html .= '<h6 style="margin-top: 20px;">Order Items:</h6>';
        $html .= '<table class="table table-bordered" style="color: white;">';
        $html .= '<thead><tr><th>Product</th><th>Price</th><th>Quantity</th><th>Discount</th><th>Total</th></tr></thead>';
        $html .= '<tbody>';
        
        if (is_array($order->order_items)) {
            foreach ($order->order_items as $item) {
                $itemPrice = $item['price'] ?? 0;
                $itemQuantity = $item['quantity'] ?? 0;
                $itemDiscount = $item['discount'] ?? 0;
                
                $finalPrice = $itemDiscount > 0 ? $itemPrice * (1 - $itemDiscount / 100) : $itemPrice;
                $itemTotal = $finalPrice * $itemQuantity;
                
                $html .= '<tr>';
                $html .= '<td>' . ($item['title'] ?? 'Unknown Product') . '</td>';
                $html .= '<td>$' . number_format($itemPrice, 2) . '</td>';
                $html .= '<td>' . $itemQuantity . '</td>';
                $html .= '<td>' . ($itemDiscount > 0 ? $itemDiscount . '%' : 'None') . '</td>';
                $html .= '<td>$' . number_format($itemTotal, 2) . '</td>';
                $html .= '</tr>';
            }
        }
        
        $html .= '</tbody></table>';
        $html .= '</div>';
        
        return response($html);
    }

    public function ajax_update_order_status(Request $request)
    {
        try {
            $order = Order::findOrFail($request->order_id);
            $order->payment_status = $request->status;
            $order->save();

            return response()->json(['success' => true, 'message' => 'Order status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update order status']);
        }
    }

    public function ajax_delete_order(Request $request)
    {
        try {
            $order = Order::findOrFail($request->order_id);
            $order->delete();

            return response()->json(['success' => true, 'message' => 'Order deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete order']);
        }
    }

    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $completedOrders = Order::where('payment_status', 'completed')->count();
        $pendingOrders = Order::where('payment_status', 'pending')->count();
        $totalRevenue = Order::where('payment_status', 'completed')->sum('total_amount');
        $recentOrders = Order::orderBy('created_at', 'desc')->limit(5)->get();
        $lowStockProducts = Product::where('quantity', '<=', 10)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders', 
            'completedOrders',
            'pendingOrders',
            'totalRevenue',
            'recentOrders',
            'lowStockProducts'
        ));
    }
}