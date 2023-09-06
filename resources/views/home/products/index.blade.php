@extends('layout')

@section('content')
{{-- PRODUCTS SEARCH BAR --}}
<div  style="margin-top: 40px"></div>
 
<x-home.searchbar :category="$category"/>

{{--  PRODUCTS --}}
<section class="product_section">
    <div class="container-lg">
       <div class="row">
        @foreach ($products as $product)
            <x-home.card :product="$product" />
        @endforeach
       </div>
    </div>
 </section>
 <div class="mt-4 p-4">
    {{$products->links()}}
 </div>
 @endsection