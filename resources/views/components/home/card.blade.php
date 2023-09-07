@props(['product'])
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
                {{$product->price}}frs
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
        <button type="submit" class="option2">
          Add Cart
        </button>
        <a href="/buynow/{{$product->id}}" class="option3">
          Buy Now
        </a>
      </form>
    @endif
    

    </div>
  </div>