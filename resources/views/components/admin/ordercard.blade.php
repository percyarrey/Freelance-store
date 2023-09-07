@props(['order'])
<div class="card mb-3">
    <div class="card-header d-flex justify-content-between">
      <h5 class="card-title">Order #{{$order->order_id}}</h5>
      @if ($order->new == 0)
        <div class="text-white px-1 rounded-3 d-flex align-items-center" style="background-color: #DC3545;transform:rotateZ(-2deg);">New</div>
      @endif
    </div>
    <div class="card-body">
      <p class="card-text">Customer: {{$order->name}}</p>
      <p class="card-text">Date: {{$order->created_at}}</p>
      <p class="card-text">Status: <b>{{$order->status}}</b></p>
      <a href="/orderdetail/{{$order->id}}" class="btn btn-success">View Details</a>
    </div>
</div>