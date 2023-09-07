<div style="font-family: Helvetica Neue, Arial, sans-serif;min-height: 80vh; display:flex; flex-direction:column; justify-content:space-between;">
    <div style="border: 1px solid rgba(128, 128, 128, 0.522);shadow:4px 4px 4px 4px black; border-radius:2%;background-color:rgba(128, 128, 128, 0);">
      <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.522);padding:0rem 0rem 0rem 1rem;">
        <p  style="font-weight: 700;font-size:20px;color:#198754;" >Order Summary</p>
      </div>
      <div style="padding:0rem 1rem 0rem 1rem;">
        <div >
          <div class="col-md-4">
            <h4>Order ID: <span style="color: #0D6EFD">{{$order->order_id}}</span></h4>
            <p>Date: {{$order->created_at}}</p>
            <p>Customer: {{$order->name}}</p>
          </div>
          <div>
            <nobr><p ><span style="font-weight: bold; font-size:16px;">Shipping Address: </span>{{$order->address}}</p></nobr>
          </div>
          <div>
            <nobr><p ><span style="font-size:18px;">Status: </span><span style="background-color: #198754;color:white; padding:3px 6px 3px 6px;border-radius:10%;box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">{{$order->status}}</span></p></nobr>
          </div>
        </div>
        <hr>
        <table style="width: 100%;">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody style="width: 100%;">
            @foreach ($products as $product)
              <tr>
                <td style="text-align: center">{{$product->name}}</td>
                <td style="text-align: center">{{$quantity[$loop->index]}}</td>
                <td style="text-align: center">{{$product->price}}frs</td>
                <td style="text-align: center;font-weight:600;opacity:0.75;">{{$product->price * $quantity[$loop->index]}}frs</td>
              </tr>
            @endforeach
            <tr >
              <td colspan="3" style="padding:2rem 0rem 3rem 3rem;"><strong>Total:</strong></td>
              <td style="text-align: center;font-weight:600;font-size:20px;">{{$order->amount}}frs</td>
            </tr>
          </tbody>
        </table>
     </div>
   </div>
   <div style="text-align: center;margin-top:30px;">
        <span style="color: #198754"> Copyright &copy; 2023, Freelance store.</span> All rights reserved.
   </div>
</div>