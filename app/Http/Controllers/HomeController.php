<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\User;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if($usertype == '1'){
            return view('admin.pages.placedorder');
        }
        else{
            return redirect('/');
        }
    }

    public function index()
    {
        $products = Product::latest()->take(6)->get();
        return view('home.index',compact('products'));
      
    }

    public function products()
    {
        $products = Product::latest()->filter(request(['category','search']))->paginate(6);
        $category = category::all();
        
        return view('home.products.index',compact('products','category'));
      
    }

    public function show(product $product)
    {
        $category = category::find($product->category);
        $products = Product::where('category', $category->id)->take(6)->get();
        return view('home.products.show',compact('product','category','products'));
      
    }

    

}
