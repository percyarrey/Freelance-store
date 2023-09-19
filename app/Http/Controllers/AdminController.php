<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /*MANAGE CATEGORY */
    public function category()
    {
        $usertype = Auth::user()->usertype;
        
        if($usertype =='1'){
            $category = category::latest()->get();
            return view('admin.pages.category',compact('category'));
        }
        else{
            return redirect('/');
        }
    }
    public function addcategory(Request $request)
    {   $request->validate([
            'category' => ['required',Rule::unique('categories','category')]
        ]);
        $data = new category;
        $data->category=$request->category;
        $data->save();
        
        return redirect()->back()->with('message','Category Added Succesfully');
    }

    public function destroycategory(category $category)
    {
        $products = Product::all();
        foreach($products as $product){
            if($category->id == $product->category){
                Storage::disk('public')->delete($product->imgpath);
            }
        }
        $category->delete();
        return redirect()->back()->with('warning','Category Deleted  Succesfully');
    }

    /*MANAGE PRODUCTS */
    public function addproduct()
    {
        $usertype = Auth::user()->usertype;
        
        if($usertype =='1'){
            $category = category::all();
            return view('admin.pages.addproduct',compact('category'));
        }
        else{
            return redirect('/');
        }
    }

    public function editproducts()
    {
        $usertype = Auth::user()->usertype;
        
        if($usertype =='1'){
            $products = Product::latest()->filter(request(['category','search']))->paginate(6);
            $category = category::all();
            return view('admin.pages.editproducts',compact('category','products'));
        }
        else{
            return redirect('/');
        }
    }
    public function editproduct(Product $product)
    {
        $usertype = Auth::user()->usertype;
        
        if($usertype =='1'){
            $category = category::all();
            return view('admin.pages.updateproduct',compact('category','product'));
        }
        else{
            return redirect('/');
        }
    }

    public function createproduct(Request $request)
    {
        $formfield = $request->validate([
            'name' => ['required', Rule::unique('products','name')],
            'imgpath' => ['required', 'file', 'max:1024'],
            'quantity' => ['required'],
            'price' => ['required'],
            'description' => ['required']
        ]);
        $formfield['imgpath'] = $request->file('imgpath')->store('images','public');
        
        if($request->discount){
            $formfield['discount'] = $request->discount;
        }
        Product::create($formfield);
        return redirect()->back()->with('message','Product Added  Succesfully');
    }

    public function updateproduct(Request $request, Product $product)
    {
        $formfield = $request->validate([
            'name' => ['required'],
            'imgpath' => ['file', 'max:1024'],
            'quantity' => ['required'],
            'price' => ['required'],
            'description' => ['required']
        ]);
        if($request->file('imgpath')){
            Storage::disk('public')->delete($product->imgpath);
            $formfield['imgpath'] = $request->file('imgpath')->store('images','public');
        }else{
            $formfield['imgpath'] = $product->imgpath;
        }

        if($request->discount){
            $formfield['discount'] = $request->discount;
        }else{
            $formfield['discount'] = null;
        }
        
        $product->update($formfield);
        return redirect('/editproducts')->with('message','Product Updated Succesfully');
    }

    public function destroyproduct(Product $product)
    {
        Storage::disk('public')->delete($product->imgpath);
        $product->delete();
        return redirect()->back()->with('warning','Product Deleted Succesfully');
    }

    /* MANAGE ORDERS*/
    public function orderdetail(Order $order)
    {   
        $usertype = Auth::user()->usertype;
        if($usertype==1){
            $order->new=1;
            $order->save();
            $products = Product::find(unserialize($order->product_id));
            $quantity = unserialize($order->quantity);
            $prices = unserialize($order->price);
            return view('admin.pages.order.orderdetail',compact('order','products','quantity','prices'));
        }
        return redirect('/');
        
    }
    public function orderstatus(Request $request, Order $order)
    {   
        $usertype = Auth::user()->usertype;
        if($usertype==1){
            if($request->status){
                $order->status=$request->status;
                $order->save();
                return redirect()->back()->with('message','Status Updated Succesfully');
            }
            return redirect()->back()->with('warning','Please Select a Status');
        }
        return redirect('/');
        
    }

    public function destroyorder(Order $order)
    {
        $order->delete();
        return redirect('/redirect')->with('warning','Order Deleted Succesfully');
    }

}
