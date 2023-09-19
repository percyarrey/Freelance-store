<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Cart;
use App\Models\User;

use App\Models\Order;
use App\Models\Product;
use App\Models\category;

use App\Mail\WelcomeEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /* PRODUCTS */
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if($usertype == '1'){
            

            Mail::to('tanyitikuarrey@gmail.com')->send(new WelcomeEmail());
            $orders = Order::latest()->filter(request(['status']))->paginate(5);;
            return view('admin.pages.placedorder',compact('orders'))->with('message', 'Welcome Email Send');;
        }
        else{
            Mail::to('tanyitikuarrey@gmail.com')->send(new WelcomeEmail());
            return redirect('/')->with('message', 'Welcome Email Send');
        }
    }

    public function index()
    {   
        if(Auth::user()){
            $cartcount = Cart::where('user_id', Auth()->user()->id)
            ->get();  
        }else{
            $cartcount=0;
        }
        $products = Product::latest()->take(6)->get();
        return view('home.index',compact('products','cartcount'));
      
    }

    public function products()
    {
        if(Auth::user()){
            $cartcount = Cart::where('user_id', Auth()->user()->id)
            ->get();  
        }else{
            $cartcount=0;
        }
        $products = Product::latest()->filter(request(['category','search']))->paginate(6);
        $category = category::all();
        
        return view('home.products.index',compact('products','category','cartcount'));
      
    }

    public function show(product $product)
    {
        if(Auth::user()){
            $cartcount = Cart::where('user_id', Auth()->user()->id)
            ->get();  
        }else{
            $cartcount=0;
        }
        $category = category::find($product->category);
        $products = Product::where('category', $category->id)->take(6)->get();
        return view('home.products.show',compact('product','category','products','cartcount'));
      
    }

    /* CARTS */
    public function cart(){
        $products=[];
        $carts = Cart::where('user_id', Auth()->user()->id)
            ->get();

        if(Auth::user()){
            $cartcount = Cart::where('user_id', Auth()->user()->id)
            ->get();  
        }else{
            $cartcount=0;
        }
        foreach ($carts as $cart){
            $product = $cart->product;
            $products[] = $product;
        }
        $products = collect($products);
        return view('home.cart.cart',compact('carts','products','cartcount'));      
    }

    public function crudcart(Request $request,product $product){
        $cart = new Cart;
        $result = Cart::where('user_id', Auth()->user()->id)
            ->where('product_id', $product->id)
            ->first();
        if(!$result){
            $cart->user_id = Auth()->user()->id;
            $cart->product_id = $product->id;
            if($request->quantity){
                if($request->quantity<1 || $request->quantity>$product->quantity){
                    $cart->quantity = 1;
                }else{
                    $cart->quantity = $request->quantity;
                }
            }
            $cart->save();
            return redirect()->back()->with('message', 'Product Added to Cart')->setTargetUrl(url()->previous() . '#'.$product->id);
        }else{
            if($request->quantity){
                if($request->quantity !=$result->quantity){
                    if($request->quantity<1 || $request->quantity>$product->quantity){
                        $result->update([
                            'quantity'=>1,
                        ]);
                    }else{
                        $result->update([
                            'quantity'=>$request->quantity,
                        ]);
                    }
                    return redirect()->back()->with('message','Quantity Updated Succesfully')->setTargetUrl(url()->previous() . '#quantity');
                }
                return redirect()->back()->with('warning','Product Already Exist')->setTargetUrl(url()->previous() . '#quantity');
            }
            return redirect()->back()->with('warning','Product Already Exist')->setTargetUrl(url()->previous() . '#'.$product->id);
        }
        
    }

    public function destroycart(Cart $cart)
    {
        $cart->delete();
        return redirect()->back()->with('warning','Cart Deleted Succesfully');
    }

    /* BUY NOW */
    public function buynow(Product $product){
        if(Auth()->user()){
            $cart = new Cart;
            $result = Cart::where('user_id', Auth()->user()->id)
                ->where('product_id', $product->id)
                ->first();
            if(!$result){
                $cart->user_id = Auth()->user()->id;
                $cart->product_id = $product->id;
                $cart->save();
            }
            return redirect('/cart');
        }else{
            return redirect('/register');
        }
    }

    /* ORDERS */
    public function createorder(Request $request){
        $formfield = $request->validate([
            'name' => ['required'],
            'email' => ['required','email'],
            'phone' => ['required'],
            'address' => ['required'],
        ]);
        $formfield['order_id'] = Str::random(9);
        $formfield['user_id'] = Auth()->user()->id;

        /* GETTTING PRODUCT ID's */
        $product_ids=[];
        $prices=[];
        $amount = [];
        $carts = Cart::where('user_id', Auth()->user()->id)
            ->get();
        foreach ($carts as $cart){
            $product = $cart->product;
            $product_ids[] = $product->id;
            $prices[] = $product->discount ? $product->discount :$product->price;
            $amount[] = $product->discount ? $product->discount * $cart->quantity :$product->price * $cart->quantity ;
        }
        $formfield['product_id']=serialize($product_ids);


        /* GETTTING QUANTITIES */
        $quantities=[];
        foreach ($carts as $cart){
            $quantities[]= $cart->quantity;
        }
        $formfield['quantity']=serialize($quantities);
        /* AMOUNT */
        $formfield['amount'] = array_sum($amount);
        $formfield['price']=serialize($prices);

        Order::create($formfield);  
        $order = Order::where('order_id',$formfield['order_id'])->get();
     
        return redirect('/checkout'.'/'.$order[0]->id);

    }

    /* CHECKOUT */
    public function checkout(Order $order)
    {   
        if($order->user_id == Auth()->user()->id){
            $products = Product::find(unserialize($order->product_id));
            $quantity = unserialize($order->quantity);
            $prices = unserialize($order->price);
            return view('home.checkout.checkout',compact('order','products','quantity','prices'));
        }
        return redirect('/login');
        
    }

    public function generatePdf(Order $order)
    {
        if($order->user_id == Auth()->user()->id || Auth()->user()->usertype==1){
            $products = Product::find(unserialize($order->product_id));
            $quantity = unserialize($order->quantity);
            $prices = unserialize($order->price);
            $data = [
                'products'=>$products,
                'quantity'=>$quantity,
                'order'=>$order,
                'prices'=>$prices,
            ]; // Replace this with your actual data retrieval logic
            
            $pdf = new Dompdf();
            $pdf->loadHtml(View::make('home.checkout.pdf', $data)->render());
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();

            return $pdf->stream('order_summary.pdf');
        }else{
            return redirect('/products');
        }
    }

    /* TRACK ORDER */
    public function trackorder(Request $request)
    {   
        $request->validate([
            'order_id'=>'required'
        ]);
        $order = Order::where('order_id',$request->order_id)->first();
        if($order){
            if($order->user_id == Auth()->user()->id){
                $products = Product::find(unserialize($order->product_id));
                $quantity = unserialize($order->quantity);
                $prices = unserialize($order->price);
                return view('home.checkout.checkout',compact('order','products','quantity','prices'));
            }
        }
        return redirect()->back()->with('warning', 'Order thus not exist in our Records');
        
    }

    /* RECENT ORDER */
    public function recentorder()
    {   
        $orders = Order::where('user_id',Auth()->user()->id)->get();
        return view('home.recentorder',compact('orders'));
        
    }
    public function recenttrack(Order $order)
    {   
        if($order){
            if($order->user_id == Auth()->user()->id){
                $products = Product::find(unserialize($order->product_id));
                $quantity = unserialize($order->quantity);
                $prices = unserialize($order->price);
                return view('home.checkout.checkout',compact('order','products','quantity','prices'));
            }
        }
        return redirect()->back()->with('warning', 'Order ID is not Valid');
        
    }
}
