<div style="font-family: Helvetica Neue, Arial, sans-serif;min-height: 80vh; display:flex; flex-direction:column; justify-content:space-between;">
    <div style="border: 1px solid rgba(128, 128, 128, 0.522);shadow:4px 4px 4px 4px black;background-color:rgba(128, 128, 128, 0);">
      <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.522);padding:0rem 0rem 0rem 1rem;">
        <p  style="font-weight: 700;font-size:20px;color:#198754;" >Statistics</p>
      </div>
      <div style="padding:0rem 1rem 0rem 1rem;">
        <table style="width: 100%;">
          <thead>
            <tr>
              
              <th>Name</th>
              <th>Category</th>
              <th>Quantity Ordered</th>
            </tr>
          </thead>
          <tbody style="width: 100%;">
            @foreach ($products as $product)
              <tr>
                <td style="text-align: center">{{$product->name}}</td>
                <td style="text-align: center">
                  @php
                    $foundCategory = 'Deleted';
                    foreach ($category as $item) {
                        if ($item->id === $product->category) {
                            $foundCategory = $item->category;
                            break;
                        }
                    }
                  @endphp
                  {{$foundCategory}}
                </td>
                <td style="text-align: center">{{$quantity[$loop->index]}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
     </div>
   </div>
   <div style="text-align: center;margin-top:30px;">
        <span style="color: #198754"> Copyright &copy; 2023, Freelance store.</span> All rights reserved.
   </div>
</div>