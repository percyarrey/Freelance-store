@props(['products','order','quantity','prices'])

<div class=" container-fluid container mt-5">
    <div class="card">
      <div class="card-header">
        <h5 class="text-success" >Order {{ !(request()->is('orderdetail/'.$order->id) && Auth()->user()->usertype==1)?'Summary':'Detail'}}</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
            <h6>Order ID: <span class="text-primary">{{$order->order_id}}</span></h6>
            <p>Date: {{$order->created_at}}</p>
            <p>Customer: {{$order->name}}</p>
          </div>
          <div class="col-lg-4 text-lg-center">
            <h6>Shipping Address:</h6>
            <p>{{$order->address}}</p>
          </div>
          <div class="col-lg-4 text-lg-right d-lg-flex justify-content-center">
            <div>
                <span>Status:</span>
                <span class="btn pt-0 pb-0 btn-success">{{$order->status}}</span>

                @if (request()->is('orderdetail/'.$order->id) && Auth()->user()->usertype==1)
                  <hr>
                  <form class="input-group" method="POST" action="/orderdetail/{{$order->id}}">
                    @csrf
                    @method('PUT')
                    <select class="form-select rounded-0 rounded-start " aria-label="status" id="status" name="status" required>
                      <option selected disabled >Select status</option>
                        <option value="Pending">Pending</option>
                        <option value="Processing">Processing</option>
                        <option value="Shipped">Shipped</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                    <button type="submit" class="btn btn-success">Update Status</button>
                  </form>
                @endif
            </div>
          </div>
        </div>
        <hr>
        <table class="table">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
              <tr>
                <td>{{$product->name}}</td>
                <td>{{$quantity[$loop->index]}}</td>
                <td>{{$prices[$loop->index] }}frs</td>
                <td class="fw-bold" style="opacity: 0.78;">{{$prices[$loop->index] * $quantity[$loop->index]}}frs</td>
              </tr>
            @endforeach
            <tr>
              <td colspan="3" class="text-right"><strong>Total:</strong></td>
              <td class="fw-bold">{{$order->amount}}frs</td>
            </tr>
          </tbody>
        </table>
     </div>
   </div>
   
  <div class=' py-4 d-flex' style={{request()->is('orderdetail/'.$order->id) && Auth()->user()->usertype==1 ? "justify-content:space-between;" : "justify-content:center;" }}>
  @if (request()->is('orderdetail/'.$order->id) && Auth()->user()->usertype==1)
  <form  action="/orderdetail/{{$order->id}}" method="POST">
    @csrf
    @method('DELETE')
    {{-- DELETE --}}
    <div class="btn btn-danger" onclick="showConfirmation({{'p'.$product->id}})">Delete Order</div>
    <div class="modal fade" id="{{'p'.$product->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
            <div type="button" class="close btn" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">X</span>
            </div>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to <b class="text-danger">Delete</b> this order?<br/>
            <b class="text-warning">Bewarnded</b> It cannot be <b class="text-danger">undone</b>
          </div>
          <div class="modal-footer">
            <div type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</div>

            <button type="submit" class="btn btn-success">Confirm</button>
          </div>
        </div>
      </div>
    </div>
  </form>
   @endif
  <form action="/pdf/{{$order->id}}" method="POST">
    @method('POST')
    @csrf
    <button type="submit"  class="btn btn-success ">Download PDF</button>
  </form>
  </div>
    
</div>