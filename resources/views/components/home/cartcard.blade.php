@props(['product','cart'])
<div class="row mb-1 myCard " style="border-bottom: 1px solid rgba(128, 128, 128, 0.134);height: 4rem;">

    <a  href="/products/{{$product->id}}" class="col-2 col-sm-3 position-relative d-flex justify-content-center" style="height: 4rem" >
        <img src="{{'storage/'.$product->imgpath}}" style="height: 100%;"/>
    </a>
    <a  href="/products/{{$product->id}}" class="col-2 col-sm-3 text-dark overflow-hidden">
        <nobr>{{$product->name}}</nobr>
    </a>
    <div class="col">
        <div class="w-100 d-flex justify-content-around">
            
            <div class="text-center" style="flex: 1 1 0%;">
                <b>{{$cart->quantity}}</b>
            </div>
            <div>
                <small>Max: {{$product->quantity}}</small>
            </div>
        </div>
        <form style="height: 2rem;" class="input-group" action="/cart/{{$product->id}}" method="POST">
            @csrf
            <input name="quantity" style="height: 2rem; appearance: textfield; -moz-appearance: textfield; -webkit-appearance: textfield;" class="form-control" type="number" min="1" value="{{$cart->quantity}}" max="{{$product->quantity}}">
            <button class="btn btn-success h-100 m-0"><i class="fa fa-arrow-up"></i></button>
        </form>
    </div>
    <div class="col-4 col-sm-3 d-flex  justify-content-between ps-md-4 overflow-hidden pe-md-5 fw-bold">
        <div>
            {{$product->price * $cart->quantity}}frs
        </div>
        <form  class="pb-1"  action="/cart/{{$cart->id}}" class="justify-content-between d-flex" method="POST">
            @csrf
            @method('DELETE')
            {{-- DELETE --}}
            <div class="btn btn-outline-danger d-flex align-items-center" onclick="showConfirmation({{'p'.$cart->id}})">X</div>
            <div class="modal fade" id="{{'p'.$cart->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                    <div type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </div>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to <b class="text-danger">Delete</b>?
                  </div>
                  <div class="modal-footer">
                    <div type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</div>
  
                    <button type="submit" class="btn btn-success">Confirm</button>
                  </div>
                </div>
              </div>
            </div>
        </form>

    </div>
</div>