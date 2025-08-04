@extends('admin.layouts.app')
@section('content')

<!-- ===== ===== --> 


	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Email Templates</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Email Templates</a></li>
							<li class="breadcrumb-item active" aria-current="page">  Email Templates</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							<button type="button" class="btn btn-white btn-icon-text my-2 mr-2"> <i class="fe fe-arrow-left mr-2"></i> Templates Listing </button> 
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
									<label class="main-content-label mb-2">Add Templates</label> 
								</div>
							</div>
							<hr />
							<div class="card-body pl-0 pt-0">
								<div class="">
									<div class="container">	
										<div class="row justify-content-md-center">
											<div class="col-xl-8 col-lg-10 col-md-12">
												
												<div class="card shade" id="all-step-form">															
													<form enctype="multipart/form-data" id="add-artist" method="POST" action="{{route('store-artist')}}" data-parsley-validate="">
														@csrf
														<div class="row">
															<div class="col-md-6 form-group">
																<label>First Name : <span class="required">*</span></label>
																<input name="name" value="{{(isset($data->name)?$data->name:'')}}" required class="form-control" placeholder="First Name..." maxlength="255" type="text" id="" />
															</div>
															<div class="col-md-6 form-group">
																<label>Last Name : <span class="required">*</span></label>
																<input name="name" value="{{(isset($data->name)?$data->name:'')}}" required class="form-control" placeholder="Last Name..." maxlength="255" type="text" id="" />
															</div>
															<div class="col-md-12 form-group">
																<label>Email Address: <span class="required">*</span></label>
																<input name="name" value="{{(isset($data->name)?$data->name:'')}}" required class="form-control" placeholder="Email Address..." maxlength="255" type="text" id="" />
															</div>
															<div class="col-md-6 form-group">
																<label>Username: <span class="required">*</span></label>
																<input name="name" value="{{(isset($data->name)?$data->name:'')}}" required class="form-control" placeholder="Username..." maxlength="255" type="text" id="" />
															</div>
															<div class="col-md-6 form-group">
																<label>Password: <span class="required">*</span></label>
																<input name="name" value="{{(isset($data->name)?$data->name:'')}}" required class="form-control" placeholder="Password..." maxlength="255" type="text" id="" />
															</div> 
															<div class="col-md-6 form-group">
																<label> Group </label>
																<select name="status" class="custom-select w-100">
																	<option value="">-- Select Group --</option>
																	<option value="0">Super Admin</option>
																	<option value="1">Managers</option>
																</select>
															</div>
															<div class="col-md-6 form-group">
																<label>Is Active </label>
																<select name="status" class="custom-select w-100">
																	<option value="">-- Select Status --</option>
																	<option value="0">In Active</option>
																	<option value="1">Active</option>
																</select>
															</div>
														</div> 
														<div class="submit">
															<input class="btn btn-primary w-100" type="submit" value="Submit" />
														</div>
													</form>
												</div> 
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> 
			</div>
		</div>
	</div>	
<!-- End Main Content-->

<!-- ===== ===== --> 

@include('admin.layouts.footer')
@include('admin.artists.ajax.add-artistjs')
 

@endsection

