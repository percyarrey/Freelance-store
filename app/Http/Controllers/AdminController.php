<?php

namespace App\Http\Controllers;

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
        
        return redirect()->back()->with('message',$request->category.' Category Added Succesfully');
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
        return redirect()->back()->with('message','Category Deleted  Succesfully');
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
        Product::create($formfield);
        return redirect()->back()->with('message','Product Added  Succesfully');
    }

    public function updateproduct(Request $request, Product $product)
    {
        $formfield = $request->validate([
            'name' => ['required'],
            'imgpath' => ['required', 'file', 'max:1024'],
            'quantity' => ['required'],
            'price' => ['required'],
            'description' => ['required']
        ]);
        Storage::disk('public')->delete($product->imgpath);
        $formfield['imgpath'] = $request->file('imgpath')->store('images','public');
        $product->update($formfield);
        return redirect()->back()->with('message','Product Updated Succesfully');
    }

    public function destroyproduct(Product $product)
    {
        Storage::disk('public')->delete($product->imgpath);
        $product->delete();
        return redirect()->back()->with('message','Product Deleted Succesfully');
    }

}
