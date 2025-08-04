@extends('admin.layouts.app')
@section('content')
<?php use App\Http\Controllers\CommonController; ?>
<!-- ===== ===== --> 


	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5"> Project View </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Project Listing</a></li>
							<li class="breadcrumb-item active" aria-current="page">Project View</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							 
						</div>
					</div>
				</div>
				<!-- End Page Header -->
				
				
				<!--Row-->
				<div class="row row-sm">
					<div class="col-sm-12">
						<div class="card custom-card overflow-hidden">
							<div class="card-header border-bottom-0">
								<div class="row">
									<div class="col-sm-6">
										@if ($message = Session::get('error'))
											<div class="alert alert-danger">
												<button type="button" class="close" data-dismiss="alert">×</button>
												<strong>{{ $message }}</strong>
											</div>
										@endif

										@if ($message = Session::get('success'))
											<div class="alert alert-success alert-block">
												<button type="button" class="close" data-dismiss="alert">×</button>
												<strong>{{ $message }}</strong>
											</div>
										@endif
									</div>
								</div> 
							</div> 
							<div class="card-body pt-0">
								<div class="row"> 

						
<div class="card">
    <div class="card-header">
        <h4>{{ $product->title }}</h4>
    </div>
    <div class="card-body">
        <p><strong>SKU:</strong> {{ $product->sku }}</p>
        <p><strong>Features:</strong> {{ $product->features }}</p>
        <p><strong>Status:</strong> {{ $product->is_active ? 'Active' : 'Inactive' }}</p>
        <p><strong>Tags:</strong> {{ $product->tags }}</p>
        <p><strong>Description:</strong></p>
        <div>{!! $product->description !!}</div>

        <p><strong>Image:</strong></p>
        <img src="{{ asset($product->image) }}" width="300" />

        <p><strong>URL:</strong> 
            <a href="https://vivaacp.com/product/{{ $product->product_url }}" target="_blank">
                {{ $product->product_url }}
            </a>
        </p>
    </div>
</div>

								</div> 
							</div>
						</div>
					</div>
					<!-- col end -->
				</div>
				<!-- Row end -->
			</div>
		</div>
	</div>	
<!-- End Main Content-->



@include('admin.layouts.footer')
 

@endsection
