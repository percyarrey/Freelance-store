@extends('admin.layout')

@section('contet')

<div class="container-fluid mt-0" style="min-height: 35vh;">
    <div class="row fw-bold">
        <div class="col-2  col-sm-3">

        </div>
        <div class="col">
            Name
        </div>
        <div class="col text-center">
            Quantity ordered
        </div>
    </div>
    <hr class="mt-0"/>
    @foreach ($products as $index => $product)
        @php
            $currentIndex = $loop->index;
            $quan =$quantity[$currentIndex];
        @endphp
        @if($product)
            <x-admin.statcard :product="$product" :quantity="$quan" />
        @endif
    @endforeach
    @if(count($products)<=0)
        <div>
            <p class="text-center">No Order Found</p>
        </div>
    @endif

    <form class='d-flex my-3 justify-content-center' action="/excel" method="POST">
    @method('POST')
    @csrf
    <button type="submit"  class="btn btn-success ">Download EXCEL</button>
  </form>
        
</div>
@endsection