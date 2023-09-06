@extends('layout')

@section('content')

<div class="container-fluid container-lg"  style="min-height: 50vh;margin-top:30px;">
    <div class="row">
		<div class="col-xs-12">
		  <h3 class="text-success text-decoration-underline">Admin Panel </h3>
			<!-- tabs -->
			<div class="tabs-left row">
				<ul class="nav nav-tabs col-12 col-sm-3 col-lg-2">
					<li><a href="/redirect" class="{{ request()->is('redirect') ? ' active' : '' }}"><nobr>Placed orders</nobr></a></li>
					<li><a href="/category"  class="{{ request()->is('category') ? ' active' : '' }}">Categories</a></li>
					<li><a href="/addproduct"  class="{{ request()->is('addproduct') ? ' active' : '' }}"><nobr>Add Product</nobr></a></li>

					<li><a href="/editproducts"  class="{{ request()->is('editproducts') ? ' active' : '' }}"><nobr>Edit Products</nobr></a></li>
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