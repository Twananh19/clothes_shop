<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;

class HomeController extends Controller
{

    public function index()
    {
        $product = Product::limit(6)->get(); // Chỉ hiển thị 6 sản phẩm đầu tiên trên trang chủ
        return view('home.userpage', compact('product'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if($usertype == '1'){
            return view('admin.home');
        } 
        else {
            $product = Product::limit(6)->get(); // Chỉ hiển thị 6 sản phẩm đầu tiên
            return view('home.userpage', compact('product'));
        }
    }

    public function all_products()
    {
        $product = Product::all();
        return view('home.all_products', compact('product'));
    }

    public function product_details($id)
    {
        $product = Product::findOrFail($id);
        return view('home.product_details', compact('product'));
    }

    public function add_to_cart(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        
        $product = Product::findOrFail($product_id);
        
        // Lấy cart từ session
        $cart = session()->get('cart', []);
        
        // Nếu sản phẩm đã có trong cart, cập nhật số lượng
        if(isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $quantity;
        } else {
            // Thêm sản phẩm mới vào cart
            $cart[$product_id] = [
                "id" => $product->id,
                "title" => $product->title,
                "price" => $product->price,
                "discount" => $product->discount,
                "quantity" => $quantity,
                "image" => $product->image,
                "category" => $product->category
            ];
        }
        
        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cart_count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('home.cart', compact('cart'));
    }

    public function remove_from_cart(Request $request)
    {
        $product_id = $request->product_id;
        
        $cart = session()->get('cart', []);
        
        if(isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart!',
            'cart_count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    public function update_cart(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        
        $cart = session()->get('cart', []);
        
        if(isset($cart[$product_id])) {
            if($quantity > 0) {
                $cart[$product_id]['quantity'] = $quantity;
            } else {
                unset($cart[$product_id]);
            }
            session()->put('cart', $cart);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully!',
            'cart_count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    public function get_cart_count()
    {
        $cart = session()->get('cart', []);
        return response()->json([
            'cart_count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }
}
