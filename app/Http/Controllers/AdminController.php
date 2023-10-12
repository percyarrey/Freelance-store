<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Order;
use App\Models\Product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    /* STATISTICS */
    public function statistics()
    {
        $products=[];
        $quantity=[];
        $usertype = Auth::user()->usertype;
        
        if($usertype =='1'){
            $orders = Order::all();
            foreach($orders as $order){
                if($order->status=='Pending'){
                    $array_products = unserialize($order->product_id);
                    $array_quantity = unserialize($order->quantity);
                    foreach($array_products as $index => $value){
                        if(!(in_array($value,$products))){
                            $products[]=$value;
                            $quantity[]=$array_quantity[$index];
                        }else{
                            $index1 = array_search($value,$products);
                            if($index1 !==false){
                                $quantity[$index1] = $quantity[$index1] + $array_quantity[$index];
                            }
                        }
                    }
                }
            }
            $products = Product::find($products);
            return view('admin.pages.statistics.statistics',compact('quantity','products'));
        }
        else{
            return redirect('/');
        }
    }

    public function downloadpdf()
    {
        $products=[];
        $quantity=[];
        $usertype = Auth::user()->usertype;
        
        if($usertype =='1'){
            $orders = Order::all();
            foreach($orders as $order){
                if($order->status=='Pending'){
                    $array_products = unserialize($order->product_id);
                    $array_quantity = unserialize($order->quantity);
                    foreach($array_products as $index => $value){
                        if(!(in_array($value,$products))){
                            $products[]=$value;
                            $quantity[]=$array_quantity[$index];
                        }else{
                            $index1 = array_search($value,$products);
                            if($index1 !==false){
                                $quantity[$index1] = $quantity[$index1] + $array_quantity[$index];
                            }
                        }
                    }
                }
            }
            $products = Product::find($products);
            $category = category::all();
            $data = [
                'products'=>$products,
                'quantity'=>$quantity,
                'category'=>$category,
            ];
            $pdf = new Dompdf();
            $pdf->loadHtml(View::make('admin.pages.statistics.pdf', $data)->render());
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();
            return $pdf->stream('statistics.pdf');
        }
        else{
            return redirect('/');
        }
        
    }

    public function generateExcel()
    {
        $products=[];
        $quantity=[];
        $usertype = Auth::user()->usertype;
        
        if($usertype =='1'){
            $orders = Order::all();
            foreach($orders as $order){
                if($order->status=='Pending'){
                    $array_products = unserialize($order->product_id);
                    $array_quantity = unserialize($order->quantity);
                    foreach($array_products as $index => $value){
                        if(!(in_array($value,$products))){
                            $products[]=$value;
                            $quantity[]=$array_quantity[$index];
                        }else{
                            $index1 = array_search($value,$products);
                            if($index1 !==false){
                                $quantity[$index1] = $quantity[$index1] + $array_quantity[$index];
                            }
                        }
                    }
                }
            }
            $products = Product::find($products);
            $category = category::all();

            $data = [
                ['Name', 'Category','Quantity Ordered'],
            ];
            foreach ($products as $loop => $product) {
                $dataItem=[];
                $dataItem[]=$product->name;
                $foundCategory = 'Deleted';
                    foreach ($category as $item) {
                        if ($item->id === $product->category) {
                            $foundCategory = $item->category;
                            break;
                        }
                    }
                $dataItem[] = $foundCategory;
                $dataItem[] = $quantity[$loop];
                $data[] = $dataItem;
            }
    
            $csvFileName = 'statistics.csv';
    
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
            ];
    
            $callback = function () use ($data) {
                $file = fopen('php://output', 'w');
                foreach ($data as $row) {
                    fputcsv($file, $row);
                }
                fclose($file);
            };
    
            return Response::stream($callback, 200, $headers);
        }
        else{
            return redirect('/');
        }
        
    }

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
            'category' =>['required'],
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
            'category' =>['required'],
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
