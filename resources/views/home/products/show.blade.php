@extends('layout')

@section('content')
    <section  style="margin-top: 43px;">
        <div class="container-fluid w-100 d-flex justify-content-center container-lg">
            <div class="row py-3 w-100 shadow-sm rounded-3" style="background-color:#19875403 ;min-height: 412px;">
              <div class="col-md-6 d-flex justify-content-center">
                <img src="{{asset('storage/'.$product->imgpath)}}" alt="{{$product->name}}" class="img-fluid">
              </div>
              <div class="col-md-6">
                <h2 class="mt-2">{{$product->name}}</h2>
                <p class="text-muted">{{$category->category}}</p>
                <h4>Price: {{$product->price}}</h4>
                <p>{{$product->description}}</p>

                <form>
                    <div class="form-group">
                        <label for="quantity">Quantity ({{$product->quantity}}):</label>
                        <input min="1" max="{{$product->quantity}}" type="number" id="quantity" class="form-control mt-2" min="1" max="10" value="1">
                      </div>
                      <div class="d-flex gap-4 mt-3">
                          <button class="btn btn-outline-dark mr-2">Add to Cart</button>
                          <button class="btn btn-success">Buy Now</button>
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
            @foreach ($products as $product)
                <x-home.card :product="$product" />
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