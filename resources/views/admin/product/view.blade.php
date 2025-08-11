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

						
<div class="col-lg-12 card shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
       <h3> {{ \App\Http\Controllers\CommonController::FetchOneCategory($view_data->category_id) }}  <span>-></span> 	  
	{{ $view_data->title }}</h3>
        
    </div>

    <div class="card-body">
    <div class="row">
        <!-- Left Side: Product Details -->
        <div class="col-md-8">
            <p><strong>Product ID:</strong> {{ $view_data->id }}</p>
            <p><strong>URL:</strong> 
                <a href="https://shera.com/product/{{ $view_data->product_url }}" target="_blank">
                    {{ $view_data->product_url }}
                </a>
            </p>
            <p><strong>Texture:</strong> {{ $view_data->texture }}</p>
            <p><strong>Profile:</strong> {{ $view_data->profile }}</p>
            <p><strong>Colour:</strong> {{ $view_data->colour }}</p>
            <p><strong>Size:</strong> {{ $view_data->size }}</p>
            <p><strong>Thickness:</strong> {{ $view_data->thickness }}</p>
            <p><strong>Weight:</strong> {{ $view_data->weight }}</p>
            <p><strong>Quantity:</strong> {{ $view_data->quantity }}</p>
            <p><strong>Description:</strong> {!! $view_data->description !!}</p>
            <p><strong>Created At:</strong> {{ $view_data->created_at->format('d M, Y h:i A') }}</p>
            <p><strong>Status:</strong>
                <span class="badge {{ $view_data->status == 1 ? 'bg-success' : 'bg-danger' }} text-white">
                    {{ $view_data->status == 1 ? 'Active' : 'Inactive' }}
                </span>
            </p>

            <!-- Applications -->
            @if($view_data->applications->isNotEmpty())
                <p><strong>Applications:</strong></p>
                <ul>
                    @foreach($view_data->applications as $app)
                        <li>{{ $app->application_name ?? $app->name }}</li>
                    @endforeach
                </ul>
            @endif

            <!-- Product Images -->
            @if($view_data->productImages->isNotEmpty())
                <p><strong>Additional Images:</strong></p>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($view_data->productImages as $img)
                        <div class="text-center me-2 mb-2">
                            <img src="{{ asset($img->image_path) }}" 
                                 alt="{{ $img->alt }}" 
                                 class="img-thumbnail" 
                                 style="width: 120px; height: auto;">
                            @if($img->alt)
                                <small class="d-block mt-1 text-muted">{{ $img->alt }}</small>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Right Side: Main Product Image -->
        <div class="col-md-4 text-center">
            <img src="{{ asset($view_data->image) }}" 
                 alt="{{ $view_data->title }}" 
                 class="img-fluid rounded shadow-sm h-90">
        </div>
    </div>
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
