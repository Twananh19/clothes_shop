<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\PaymentIntent;

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

    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if(empty($cart)) {
            return redirect('/cart')->with('error', 'Your cart is empty!');
        }

        // Tính tổng tiền
        $grandTotal = 0;
        foreach($cart as $details) {
            $price = $details['discount'] && $details['discount'] > 0 
                   ? $details['price'] * (1 - $details['discount'] / 100)
                   : $details['price'];
            $grandTotal += $price * $details['quantity'];
        }

        return view('home.checkout', compact('cart', 'grandTotal'));
    }

    public function process_payment(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
            'card_number' => 'required|string',
            'expiry' => 'required|string',
            'cvc' => 'required|string',
            'cardholder_name' => 'required|string'
        ]);

        $cart = session()->get('cart', []);
        
        if(empty($cart)) {
            return redirect('/cart')->with('error', 'Your cart is empty!');
        }

        // Tính tổng tiền
        $grandTotal = 0;
        foreach($cart as $details) {
            $price = $details['discount'] && $details['discount'] > 0 
                   ? $details['price'] * (1 - $details['discount'] / 100)
                   : $details['price'];
            $grandTotal += $price * $details['quantity'];
        }

        // Simulate payment processing with test card numbers
        $cardNumber = str_replace(' ', '', $request->card_number);
        
        try {
            // Demo payment logic
            if ($cardNumber === '4242424242424242') {
                // Success case
                $paymentStatus = 'completed';
                $paymentIntentId = 'demo_pi_' . time() . '_success';
            } elseif ($cardNumber === '4000000000000002') {
                // Decline case
                throw new \Exception('Your card was declined.');
            } elseif ($cardNumber === '4000000000000069') {
                // Expired card
                throw new \Exception('Your card has expired.');
            } else {
                // Invalid card
                throw new \Exception('Invalid card number. Please use test card: 4242 4242 4242 4242');
            }

            // Lưu order vào database
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'total_amount' => $grandTotal,
                'stripe_payment_intent_id' => $paymentIntentId,
                'payment_status' => $paymentStatus,
                'order_items' => $cart
            ]);

            // Xóa cart khỏi session sau khi thanh toán thành công
            session()->forget('cart');

            return redirect('/payment_success')->with('success', 'Payment successful! Order ID: ' . $order->id);

        } catch (\Exception $e) {
            return redirect('/payment_failed')->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function payment_success()
    {
        return view('home.payment_success');
    }

    public function payment_failed()
    {
        return view('home.payment_failed');
    }
}
