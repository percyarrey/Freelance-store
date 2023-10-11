@extends('layout')

@section('content')

<div class="container-fluid container-lg" style="margin-top: 40px;min-height:50vh;">
    <h4>Your Orders</h4>
    <div class="row fw-bold">
        <div class="col-4">
            Order ID
        </div>
        <div class="col-4">
            Date
        </div>
        <div class="col-4">
            Action
        </div>
    </div>
    <hr class="mt-0"/>
    @foreach ($orders as $order)
        <div class="row mb-3" style="border-bottom: 1px solid rgba(128, 128, 128, 0.116);">
            <div class="col-4">
                {{$order->order_id}}
            </div>
            <div class="col-4">
                {{$order->created_at}}
            </div>
            <div class="col-4">
                <form class="h-100" action="/recentorder/{{$order->id}}" method="GET">
                    @csrf
                    @method('GET')
                    <button type="submit" class="btn btn-primary h-100">Track Order</button>
                </form>
            </div>
        </div>
    @endforeach
    @if($orders)
        
    @else

    @endif
</div>

@endsection