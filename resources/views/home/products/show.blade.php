@extends('layout')

@section('content')
    <section  style="margin-top: 43px;">
        <div class="container-fluid w-100 d-flex justify-content-center container-lg">
            <div class="row py-3 w-100 shadow-sm rounded-3" style="background-color:#19875403 ;min-height: 412px;">
              <div class="col-md-6 d-flex justify-content-center">
                <img src="{{asset('storage/'.$product->imgpath)}}" alt="{{$product->name}}" class="img-fluid">
              </div>
              <div class="col-md-6" id="quantity">
                <h2 class="mt-2">{{$product->name}}</h2>
                <p class="text-muted">{{$category->category}}</p>
                <h4>Price: 
                  @if($product->discount)
                  <span style="text-decoration:line-through;" class="text-danger">{{$product->price}}</span><span class="ms-2">{{$product->discount}} frs</span>
                  @else 
                  <span  class="ms-2">{{$product->price}}frs</span>
                  @endif
                </h4>
                <p>{{$product->description}}</p>

                <form method="POST" action="/cart/{{$product->id}}">
                  @csrf
                    <div class="form-group">
                      @php
                        $hasProduct = false;
                        $quantity = 1;
                        if(is_object($cartcount)){
                          foreach ($cartcount as $cart) {
                            if ($cart->product_id == $product->id) {
                                $hasProduct = true;
                                $quantity=$cart->quantity;
                                break;
                            }
                          }
                        }
                      @endphp
                        <label for="quantity">Quantity ({{$product->quantity}}):</label>
                        <input min="1" max="{{$product->quantity}}" type="number"  name="quantity" class="form-control mt-2" value="{{$quantity}}">
                      </div>
                      <div class="d-flex gap-4 mt-3">
                        @if ($hasProduct)
                          <button type="submit" class="btn btn-outline-dark mr-2">Update Quantity</button>
                          @else
                            <button type="submit" class="btn btn-outline-dark mr-2">Add to Cart</button>
                          @endif


                        <a href="/buynow/{{$product->id}}" class="btn btn-success">
                          Buy Now
                        </a>
                      </div>
                </form>
              </div>
            </div>
          </div>
    </section>
    <section class="product_section mb-3">
        <div class="container-lg mt-4">
        <h2 class="m-0 p-0">Related Products</h2>
           <div class="row">
            @php
              $products = $products->filter(function ($cart) use($product){
                return $cart->id != $product->id;
              })
            @endphp
            @foreach ($products as $product)
                <x-home.card :product="$product" :cartcount="$cartcount"/>
            @endforeach
           </div>
           <div class="btn-box">
            <a href="/products">
               View All products
            </a>
         </div>
        </div>
    </section>
@endsection