@extends('admin.layout')

@section('contet')
   
    @foreach ($orders as $order)
        <x-admin.ordercard :order='$order'/>
    @endforeach
    <div class="mt-4 py-2 d-flex justify-content-center">
        {{$orders->links()}} 
        @if(!($orders->total()))
            <h3 class="text-center">No order has been Placed</h3>
        @endif
     </div>
@endsection