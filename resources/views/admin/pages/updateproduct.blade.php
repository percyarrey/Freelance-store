@extends('admin.layout')

@section('contet')
<div class="d-flex justify-content-center">
    <div class="w-100" style="max-width: 40rem">
        @if(session()->has('message'))
            <div class="alert alert-success d-flex justify-content-between">
                
                {{session()->get('message')}}
                <button type="button" class="close ms-auto btn m-0 p-0" data-dismiss="alert" aria-hidden="true">X
                </button>
            </div>
    @endif
    <form action="/editproducts/{{$product->id}}/edit" class="w-100 shadow-sm bg-light border py-4 rounded-3 px-2 px-sm-3 px-lg-4"  method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="text-center mb-4">
            <h5 class="text-success m-0 p-0">Update Product</h5>
        </div>
        {{-- NAME --}}
        <label class="fw-bold opacity-75" for="name">Product Name</label>
        <input type="text" id="name" name='name' value="{{$product->name}}" class="form-control mb-0 pb-0"/>
            @error('name')
                <small class='text-danger'>{{$message}}</small> <br/>
            @enderror
            <div class="mb-4"></div>

        {{-- IMAGE --}}
        <label class="fw-bold opacity-75" for="imgpath">Thumbnail <small >(less than 1mb)</small></label>
        <input type="file" accept="image/*" id="imgpath" name='imgpath' value="{{$product->imgpath}}" class="form-control mb-0 pb-0"/>
            @error('imgpath')
                <small class='text-danger'>{{str_replace('imgpath','Thumbnail',$message)}}</small> <br/>
            @enderror
            <div class="mb-4"></div>

        {{-- CATEGORY --}}
        <label class="fw-bold  opacity-75" for="name" >Category</label>
        <select class="form-select rounded-start" aria-label="Category" id="category" name="category"  value="{{$product->category}}">
            <option selected disabled >Select category</option>
            @foreach ($category as $cat)
              <option value="{{$cat->id}}">{{$cat->category}}</option>
            @endforeach
        </select>
            @error('category')
                <small class='text-danger'>{{$message}}</small> <br/>
            @enderror
            <div class="mb-2"></div>
        {{-- Quantity --}}
        <label class="fw-bold opacity-75 mt-3" for="quantity">Quantity in stock</label>
        <input type="number" id="quantity" name='quantity' value="{{$product->quantity}}" class="form-control mb-0 pb-0" placeholder="" />
            @error('quantity')
                <small class='text-danger'>{{$message}}</small> <br/>
            @enderror
            <div class="mb-3"></div>
        {{-- PRICE --}}
        <label class="fw-bold opacity-75 mt-1" for="price">Price <small >(frs)</small></label>
        <input type="number" id="price" name='price' value="{{$product->price}}" class="form-control mb-0 pb-0" placeholder="" />
            @error('price')
                <small class='text-danger'>{{$message}}</small> <br/>
            @enderror
            <div class="mb-3"></div>

        {{-- DESCRIPTION --}}
        <label class="fw-bold opacity-75 mt-1" for="description">Description</label>
        <textarea  id="description" name='description' class="form-control mb-0 pb-0" placeholder="" >{{$product->description}}</textarea>
            @error('description')
                <small class='text-danger'>{{$message}}</small> <br/>
            @enderror
            <div class="mb-3"></div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="w-75 btn btn-success">Update Product</button>
        </div>
    </form>
    </div>
</div>
@endsection