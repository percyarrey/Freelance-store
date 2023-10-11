@extends('layout')

@section('content')

<div class="container-fluid container-lg"  style="min-height: 50vh;margin-top:30px;">
    <div class="row">
		<div class="col-xs-12">
		  <div class="d-flex  justify-content-between gap-1">
			<a href="/redirect"><h3 class="text-success text-decoration-underline">Admin Panel </h3></a>
			@if (request()->is('placedorders') && Auth()->user()->usertype==1)
			<select onchange="handleStatus()" class="form-select w-50 mb-md-2" aria-label="status" id="status" name="status" required>
				<option  disabled {{ !request('status') ? 'selected' : '' }}>Sort status</option>
				<option value="All">All</option>
				  <option value="Pending"  {{ ('Pending' == request('status')) ? 'selected' : '' }}>Pending</option>
				  <option value="Processing"  {{ 'Processing' == request('status') ? 'selected' : '' }}>Processing</option>
				  <option value="Delivering"  {{ 'Delivering' == request('status') ? 'selected' : '' }}>Delivering</option>
				  <option value="Delivered"  {{ 'Delivered' == request('status') ? 'selected' : '' }}>Delivered</option>
			</select>
			@endif
			
		  </div>
			<!-- tabs -->
			<div class="tabs-left row">
				<ul class="nav nav-tabs col-12 col-sm-3 col-lg-2">
					<li><a href="/placedorders" class="{{ request()->is('placedorders') ? ' active' : '' }}"><nobr>Placed orders</nobr></a></li>
					<li><a href="/category"  class="{{ request()->is('category') ? ' active' : '' }}">Categories</a></li>
					<li><a href="/statistics"  class="{{ request()->is('statistics') ? ' active' : '' }}">Statistics</a></li>
					
					<li><a href="/addproduct"  class="{{ request()->is('addproduct') ? ' active' : '' }}"><nobr>Add Product</nobr></a></li>

					<li><a href="/editproducts"  class="{{ request()->is('editproducts') ? ' active' : '' }}"><nobr>Customize</nobr></a></li>
				</ul>
				<div class=" col mt-3 mt-md-0">
					@yield('contet')
				</div>
			</div>
			<!-- /tabs -->
		</div>
	</div>
</div>
@endsection