@extends('admin.layout')

@section('contet')

<div class="d-flex justify-content-center">
    <div class="w-100" style="max-width: 40rem">
    <form action="/createproduct" class="w-100 shadow-sm bg-light border py-4 rounded-3 px-2 px-sm-3 px-lg-4"  method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="text-center mb-4">
            <h5 class="text-success m-0 p-0">Create a Product</h5>
        </div>
        {{-- NAME --}}
        <label class="fw-bold opacity-75" for="name">Product Name</label>
        <input type="text" id="name" name='name' value="{{old('name')}}" class="form-control mb-0 pb-0"/>
            @error('name')
                <small class='text-danger'>{{$message}}</small> <br/>
            @enderror
            <div class="mb-4"></div>

        {{-- IMAGE --}}
        <label class="fw-bold opacity-75" for="imgpath">Thumbnail <small >(less than 1mb)</small></label>
        <input type="file" accept="image/*" id="imgpath" name='imgpath' value="{{old('imgpath')}}" class="form-control mb-0 pb-0"/>
            @error('imgpath')
                <small class='text-danger'>{{str_replace('imgpath','Thumbnail',$message)}}</small> <br/>
            @enderror
            <div class="mb-4"></div>

        {{-- CATEGORY --}}
        <label class="fw-bold  opacity-75" for="name" >Category</label>
        <select class="form-select rounded-start" aria-label="Category" id="category" name="category"  value="{{old('category')}}" >
            <option selected disabled >Select category</option>
            @foreach ($category as $cat)
              <option value="{{$cat->category}}">{{$cat->category}}</option>
            @endforeach
        </select>
            @error('category')
                <small class='text-danger'>{{$message}}</small> <br/>
            @enderror
            <div class="mb-2"></div>
        {{-- Quantity --}}
        <label class="fw-bold opacity-75 mt-3" for="quantity">Quantity in stock</label>
        <input type="number" id="quantity" name='quantity' value="{{old('quantity')}}" class="form-control mb-0 pb-0" placeholder="" />
            @error('quantity')
                <small class='text-danger'>{{$message}}</small> <br/>
            @enderror
            <div class="mb-3"></div>
        {{-- PRICE --}}
        <label class="fw-bold opacity-75 mt-1" for="price">Price <small >(frs)</small></label>
        <input type="number" id="price" name='price' value="{{old('price')}}" class="form-control mb-0 pb-0" placeholder="" />
            @error('price')
                <small class='text-danger'>{{$message}}</small> <br/>
            @enderror
            <div class="mb-3"></div>

        {{-- DESCRIPTION --}}
        <label class="fw-bold opacity-75 mt-1" for="description">Description</label>
        <textarea  id="description" name='description' class="form-control mb-0 pb-0" placeholder="" >{{old('description')}}</textarea>
            @error('description')
                <small class='text-danger'>{{$message}}</small> <br/>
            @enderror
            <div class="mb-3"></div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="w-75 btn btn-success">Add Product</button>
        </div>
    </form>
    </div>
</div>
@endsection