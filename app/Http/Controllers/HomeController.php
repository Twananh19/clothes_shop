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
        return view('home.product_details');
    }
}
