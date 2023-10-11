@extends('layout')

@section('content')

<section class="container-lg ps-3 ps-lg-0">
  <h1 class=" text-center mb-4 pt-6 mt-5 fw-bold">Dashboard</h1>
<div class="row gy-3 d-flex">
  <!-- RECENT ORDERS -->
  <a href="/placedorders" class="col-12  col-sm-6   col-lg-3 d-flex justify-content-center">
    <div class="d-flex align-items-center justify-content-center position-relative shadow-sm w-100 rounded-3" style="background-color: #E5E7EB;max-width:19rem;height:4rem;">
      <span class="d-flex align-items-center justify-content-center text-white rounded-circle" style="background-color: #FFB300;width:2.5rem;height:2.5rem;">
        <i class="fas fa-shopping-basket fa-lg"></i>

        @if($Order != 0)
          <span class="position-absolute me-2 mt-2" style="top: 0; right:0;width:1.6rem">
            <div style="background-color: #C81E1E;" class="d-flex align-items-center justify-content-center rounded-circle shadow-sm" style="background-color: ">{{ $Order }}</div>
          </span>
        @endif
      </span>
      <div class="d-flex text-dark justify-content-center align-items-start px-4" style="flex-direction: column;opacity:90%;">
        <span class="fw-bold">Recent Orders</span>
        <small class="text-sm" style="opacity:70%;">View your recent orders</small>
      </div>
    </div>
  </a>

  <!-- MANAGE BRAND -->
  <a href="/category" class="col-12  col-sm-6   col-lg-3 d-flex justify-content-center">
    <div class="d-flex align-items-center justify-content-center position-relative shadow-sm w-100 rounded-3" style="background-color: #E5E7EB;max-width:19rem;height:4rem;">
      <span  class="d-flex bg-success align-items-center justify-content-center text-white rounded-circle" style="width:2.5rem;height:2.5rem;">
        <i class="fas fa-trademark fa-lg"></i>
      </span>
      <div class="d-flex text-dark justify-content-center align-items-start px-4" style="flex-direction: column;opacity:90%;">
        <span class="fw-bold">Manage Category</span>
        <small class="text-sm" style="opacity:70%;">Update your Categories</small>
      </div>
    </div>
  </a>

  <!-- STATISTICS -->
  <a href="/statistics" class="col-12  col-sm-6   col-lg-3 d-flex justify-content-center">
    <div class="d-flex align-items-center justify-content-center position-relative shadow-sm w-100 rounded-3" style="background-color: #E5E7EB;max-width:19rem;height:4rem;">
      <span  class="d-flex bg-success align-items-center justify-content-center text-white rounded-circle" style="width:2.5rem;height:2.5rem;">
        <i class="fas fa-chart-area"></i>
      </span>
      <div   class="d-flex text-dark justify-content-center align-items-start ps-4" style="flex-direction: column;opacity:90%;">
        <span class="fw-bold">Statistics</span>
        <small  class="text-sm" style="opacity:70%;">Know product's statistics</small>
      </div>
    </div>
  </a>

  <!-- ADD PRODUCT -->
  <a href="/addproduct" class="col-12  col-sm-6   col-lg-3 d-flex justify-content-center">
    <div class="d-flex align-items-center justify-content-center position-relative shadow-sm w-100 rounded-3" style="background-color: #E5E7EB;max-width:19rem;height:4rem;">
      <span  class="d-flex bg-success align-items-center justify-content-center text-white rounded-circle" style="width:2.5rem;height:2.5rem;">
        <i class="fas fa-plus fa-lg"></i>
      </span>
      <div  class="d-flex text-dark justify-content-center align-items-start px-4" style="flex-direction: column;opacity:90%;">
        <span class="fw-bold">Add Product</span>
        <small  class="text-sm" style="opacity:70%;">Create a new product</small>
      </div>
    </div>
  </a>
</div>

  <!-- CUSTOMIZE PRODUCT -->
  <div class="col-12 d-flex justify-content-center py-3">
    <a href="/editproducts" class="d-flex align-items-center justify-content-center position-relative shadow-sm w-100 rounded-3" style="background-color: #E5E7EB;max-width:19rem;height:4rem;">
      <span  class="d-flex bg-success align-items-center justify-content-center text-white rounded-circle" style="width:2.5rem;height:2.5rem;">
        <i class="fas fa-edit fa-lg"></i>
      </span>
      <div   class="d-flex text-dark justify-content-center align-items-start ps-3" style="flex-direction: column;opacity:90%;">
        <span class="fw-bold">Customize your products</span>
        <small  class="text-sm" style="opacity:70%;">Edit and Delete Products here</small>
      </div>
  </a>
  </div>
  
</div>
</section>

@endsection