@extends('admin.layout')

@section('contet')

<x-home.ordercard :prices='$prices' :order='$order' :products="$products" :quantity="$quantity"/>

@endsection