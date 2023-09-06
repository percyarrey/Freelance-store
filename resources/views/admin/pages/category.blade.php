@extends('admin.layout')

@section('contet')
<div class="d-flex justify-content-center">
    <div class="position-relative w-100" style="max-width: 40rem">
        @if(session()->has('message'))
            <div class="alert alert-success d-flex justify-content-between">
                
                {{session()->get('message')}}
                <button type="button" class="close ms-auto btn m-0 p-0" data-dismiss="alert" aria-hidden="true">X
                </button>
            </div>
        @endif
        <h5 class=" text-center">Add Category</h5>
        <form action="{{url('/addcategory')}}" method="POST" class="row p-1 m-0">
            @csrf
    
            <input type="text" class="col-10 p-0 m-0 rounded-start" name="category" placeholder="Write category name">
            <button type="submit" class="btn btn-success col-2 rounded-end" style="border-radius: 0%">Add</button>
        </form>
        @error('category')
            <small class="text-danger mt-1">{{$message}}</small>
        @enderror

        <table class="table mt-5">
            <thead>
              <tr class="table-light">
                <th class="text-center" scope="col">Category</th>
                <th class="text-center" scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($category as $cat)
                  <x-admin.CategoryCard :cat="$cat"/>
              @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection