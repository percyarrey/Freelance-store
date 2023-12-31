@extends('layout')

@section('content')

<div class=' d-flex flex-column align-items-center' style="margin-top: 30px;">
    <div class="card p-4 border-0">
        <div class="d-flex align-items-center mb-1">
        </div>
        @php
             $modifiedString = Str::replace('/', '', request()->path());
             $modifiedString = Str::substr($modifiedString, 0, 11);
        @endphp
        @if(!(request()->is('trackorder') || $modifiedString=='recentorder'))
          <div class="d-flex">
            <span class="fw-bold text-success fs-4 ">Order Placed, Thank You</span>
            <i class="fa fa-check-circle ms-3 text-success" style="font-size: 24px;"></i>
          </div>
          <p class="mb-1">Confirmation will be sent to your email</p>
        @else
          <h5 class="fw-bold text-success text-center">Your Order is been Processed.<br/> Thank You for your patience</h5>
          <p class="mb-1"><a href="/contact">Contact us</a> in case you have any question</p>
        @endif
        <a class="btn text-success text-decoration-underline" href="/products">See More Products</a>
      </div>

  <x-home.ordercard :prices='$prices' :order='$order' :products="$products" :quantity="$quantity"/>
</div>
@endsection


