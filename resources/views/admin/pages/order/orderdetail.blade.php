@extends('admin.layout')

@section('contet')

<x-home.ordercard :order='$order' :products="$products" :quantity="$quantity"/>

@endsection