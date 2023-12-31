@props(['product','cartcount'])
@php
    if (!isset($cartcount) || $cartcount == 'undefined') {
        $cartcount = -1;
    }
@endphp
<div id="{{$product->id}}" class="{{request()->is('editproducts') && Auth()->user()->usertype==1 ? 'col-md-6 col-lg-4' : 'col-sm-6 col-md-4 '}}">
    <div class="box1">
      <div class="box" onclick="window.location.href = '/products/{{$product->id}}'">
        <div class="option_container">
          <div class="options">
              <a  href="/products/{{$product->id}}" class="option1">
                View Detail
              </a>
          </div>
        </div>
        <div class="img-box">
          <img  src="{{asset('storage/'.$product->imgpath)}}" alt="">
        </div>
      </div>

    {{-- DETAILS --}}
    <div class="box">
      <div class="detail-box">
        <h5>
          {{ Illuminate\Support\Str::limit($product->name, 25, '...') }}
        </h5>
            <h6>
              @if($product->discount)
                <span id="priceCut" style="text-decoration:line-through;" class="text-danger">{{$product->price}}</span><span id="priceCut" class="ms-2">{{$product->discount}} frs</span>
              @else 
               <span id="priceCut" class="ms-2">{{$product->price}}frs</span>
              @endif
                
            </h6>
      </div>
    </div>
    @if (request()->is('editproducts') && Auth()->user()->usertype==1)
        <form onclick=""  action="/editproducts/{{$product->id}}" class="justify-content-between d-flex" method="POST">
          <a href="/editproducts/{{$product->id}}/edit" class="btn btn-success">
            Edit
          </a>
          @csrf
          @method('DELETE')
          {{-- DELETE --}}
          <div class="btn btn-danger" onclick="showConfirmation({{'p'.$product->id}})">Delete</div>
          <div class="modal fade" id="{{'p'.$product->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                  <div type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                  </div>
                </div>
                <div class="modal-body">
                  Are you sure you want to proceed?
                </div>
                <div class="modal-footer">
                  <div type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</div>

                  <button type="submit" class="btn btn-success">Confirm</button>
                </div>
              </div>
            </div>
          </div>
        </form>
    @else
      <form action="/cart/{{$product->id}}" method="POST" class="justify-content-between d-flex ">
        @csrf
        @method('POST')
        @if(is_object($cartcount))
            @php
              $hasProduct = false;
              foreach ($cartcount as $cart) {
                  if ($cart->product_id == $product->id) {
                      $hasProduct = true;
                      break;
                  }
              }
            @endphp
          @if ($hasProduct)
            <div type="button" class="btn" style="opacity: 0.35;border:1px solid black;cursor:default;">
              Added
            </div>
          @else
            <button type="submit" class="option2">
              Add Cart
            </button>
          @endif
        @else
          <button type="submit" class="option2">
            Add Cart
          </button>
        @endif
        
        <a href="/buynow/{{$product->id}}" class="option3">
          Buy Now
        </a>
      </form>
    @endif
    

    </div>
  </div>