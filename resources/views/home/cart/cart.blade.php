@extends('layout')


@section('content')
    <section class="container-lg px-md-4" style="margin-top:40px;min-height: calc(92vh - calc(40px + 3.5rem));">
        <h2 class="text-black mb-0">Cart List</h2>
        <div class="container-fluid mt-0" style="min-height: 35vh;">
            <div class="row fw-bold">
                <div class="col-2 col-sm-3">

                </div>
                <div class="col-2 col-sm-3">
                    Name
                </div>
                <div class="col">
                    Quantity
                </div>
                <div class="col-4 ps-md-4 col-sm-3">
                    Price
                </div>
            </div>
            <hr class="mt-0"/>
            @foreach ($products as $index => $product)
                @php
                    $currentIndex = $loop->index;
                    $cart =$carts[$currentIndex];
                @endphp
                @if($product)
                    <x-home.cartcard :product="$product" :cart="$cart" />
                @endif
            @endforeach
            @if(count($cartcount)<=0)
                <div>
                    <p class="text-center">No Product Found in Cart</p>
                </div>
            @endif
        </div>


        <div class="d-flex justify-content-end">
            <div class="w-100 rounded-2" style="max-width: 20rem;">
                <div class="p-3 rounded-2 shadow-sm" style="background-color:#19875409;border:1px solid #1987542a;">
                    <div class="d-flex justify-content-between">
                        <h6  class="m-0">Total quantity:</h6> 
                        <p>
                            @php
                            $Tquantity = 0
                            @endphp
                            @foreach ($carts as $index => $cart)
                                @php
                                    if($cart){
                                        $Tquantity +=$cart->quantity;
                                    }
                                @endphp
                            @endforeach
                            {{$Tquantity}}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h5 class="m-0">Total Price:</h5> 
                        <p class="fw-bold">
                            @php
                                $Tprice = 0
                            @endphp
                            @foreach ($products as $index => $product)
                                @php
                                    if($product){
                                        $Tprice += $product->price * $carts[$loop->index]->quantity;
                                    }
                                @endphp
                            @endforeach
                            {{$Tprice}}frs
                        </p>
                    </div>

                    <a href="{{count($cartcount)>0 ? '#checkout':'/products'}}" class="btn btn-warning w-100 shadow-sm">Placed Order</a>
                </div>
            </div>
        </div>
    </section>

    @if (count($cartcount)>0)
    <div id="checkout" style="height: 4rem;"></div>
    {{-- CHECKOUT --}}
    <section  class="bg-light shadow-sm mb-3" style="border-top:1px solid rgba(128, 128, 128, 0.542);">
        <div class="d-flex justify-content-center container-lg px-md-4">
            <div class="w-100">
            <form action="/order" class="w-100  py-4 px-2 px-sm-3 px-lg-4"  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <h2 class="text-black mb-0">Enter an Address</h2>
                </div>
                {{-- NAME --}}
                <label for="name" style="font-weight: 500;">Full Name:</label>
                <input type="text" id="name" name='name' value="{{Auth()->user()->name}}" class="form-control"/>
                    @error('name')
                        <small class='text-danger'>{{$message}}</small> <br/>
                    @enderror
                <div class="mb-4"></div>
                {{-- EMAIL--}}
                <label for="email" style="font-weight: 500;">Email:</label>
                <input type="email" id="email" name='email' value="{{Auth()->user()->email}}" class="form-control"/>
                    @error('email')
                        <small class='text-danger'>{{$message}}</small> <br/>
                    @enderror
                <div class="mb-4"></div>
                {{-- PHONE NUMBER --}}
                <label for="phone" style="font-weight: 500;">Phone Number:</label>
                <input type="number" id="phone" name='phone' value="{{Auth()->user()->phone}}" class="form-control"/>
                    @error('phone')
                        <small class='text-danger'>{{$message}}</small> <br/>
                    @enderror
                <div class="mb-4"></div>
                {{-- ADDRESS --}}
                <label for="address" style="font-weight: 500;">Address:</label>
                <input type="text" placeholder="Town,quarter,street,building" id="address" name='address' value="{{Auth()->user()->address}}" class="form-control"/>
                    @error('address')
                        <small class='text-danger'>{{$message}}</small> <br/>
                    @enderror
                <div class="mb-4"></div>
                <div class="px-2 d-flex justify-content-center">
                    <button  type="submit" class="btn btn-warning w-100 shadow-sm" style="max-width: 35rem;">Proceed to checkout</button>
                </div>
            </form>
            </div>
        </div>
    </section>
    @else
        
    @endif
@endsection