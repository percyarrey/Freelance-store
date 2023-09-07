@extends('layout')

@php
    if (!isset($orders) || $cartcount == 'undefined') {
        $orders = null;
    }
@endphp

@section('content')

<section style="min-height: 50vh;margin-top:49px;">
    <form action="/trackorder" method="POST" class="d-flex justify-content-center">
        @csrf
        <div class="w-100 d-flex px-3" style="height: 48px;max-width:777px;">
            <input class="m-0 p-0" type="text" placeholder="Enter Order ID" name="order_id" required />
            <button type="submit" class="btn btn-primary rounded-0 px-4">Track</button>
        </div>
    </form>
</section>
@if($orders)

<section>
    {{dd($orders)}}
</section>

@endif
@endsection