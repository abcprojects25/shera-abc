@extends('admin.layouts.app')
@section('content')

<!-- ===== ===== --> 


	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Welcome To Dashboard</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Project Dashboard</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							<button type="button" class="btn btn-white btn-icon-text my-2 mr-2"> <i class="fe fe-download mr-2"></i> Import </button>
							<button type="button" class="btn btn-white btn-icon-text my-2 mr-2"> <i class="fe fe-filter mr-2"></i> Filter </button>
							<button type="button" class="btn btn-primary my-2 btn-icon-text"> <i class="fe fe-download-cloud mr-2"></i> Download Report </button>
						</div>
					</div>
				</div>
				<!-- End Page Header -->
				
				
				<!--Row-->
				<div class="row row-sm">
					<div class="col-sm-12">
						<div class="card custom-card overflow-hidden">
							<div class="card-header border-bottom-0">
								<div>
									<label class="main-content-label mb-2">Project Budget</label> <span class="d-block tx-12 mb-0 text-muted">The Project Budget is a tool used by project managers to estimate the total cost of a project</span>
								</div>
							</div>
							<hr />
							<div class="card-body pl-0">
								<div class="">
									<div class="container">
										 
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

<!-- ===== ===== --> 

@include('admin.layouts.footer')
 
@endsection
