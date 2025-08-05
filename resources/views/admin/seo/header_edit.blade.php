@extends('admin.layouts.app')
@section('content')
<?php 
use App\Http\Controllers\Admin\SeoController; 
$urls_list = SeoController::FetchHeaderTag();

?>

<!-- ===== ===== --> 

	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5"> Edit Page </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Search Engine Listing</a></li>
							<li class="breadcrumb-item active" aria-current="page">Edit Page</li>
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
								<div class="">
									<form method="POST" class="row justify-content-md-center" action="/admin/seo/header-update" 
									enctype="multipart/form-data" >	
										<div class="col-xl-9 col-lg-9 col-md-9">
										@csrf			
										<input type="hidden" value="{{$editdata->id}}" name="edit_id">			
											<div class="card shade">
												<div class="row"> 
													<!-- <div class="col-lg-5 col-md-5 form-group area_interest">
														<label for="areastate"> Page Name</label> <br />
														<select id="multiple-checkboxes" name="page_name[]" class="form-control"> 
															<option value="" selected disabled>-- Select Page -- </option>
															<option value="1" {{ $editdata->page_id == 1 ? 'selected' : '' }}> Home </option> 
															<option value="2" {{ $editdata->page_id == 2 ? 'selected' : '' }}> About </option> 
															<option value="3" {{ $editdata->page_id == 3 ? 'selected' : '' }}> Work </option> 
															<option value="4" {{ $editdata->page_id == 4 ? 'selected' : '' }}> Services </option> 
															<option value="5" {{ $editdata->page_id == 5 ? 'selected' : '' }}> Career </option> 
															<option value="6" {{ $editdata->page_id == 6 ? 'selected' : '' }}> Contact </option> 
														</select>
													</div>				--->									
													<div class="col-lg-7 col-md-7 form-group">
														<label>Tag Title : <span>*</span></label>
														<input name="tag_title" value="{{$editdata->tag_title}}"  class="form-control" placeholder="Tag Title..." maxlength="255" type="text" id="title"> 
													</div>
												</div>  
												<div class="form-group">
													<label for=""> Tags Code </label>
													<textarea name="tag_description" class="form-control" cols="10" rows="10" id="tags_description" placeholder="Tags Code..."> {{$editdata->tag_description}}</textarea> 
												</div> 
												 
												<div class="form-group">
													<label>Status </label>
													<select name="is_active" class="custom-select w-100">
														<option value="1" @if($editdata->status == 1) Selected @endif>Active</option>
														<option value="0" @if($editdata->status == 0) Selected @endif>In Active</option>
													</select>
												</div>
												<div class="submit">
													<input class="btn btn-primary w-100" type="submit" value="Edit Now">  
												</div> 
											</div> <!-- --> 
										</div> <!-- -->  
									</form> 
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
<!--
<script type="text/javascript" src="/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="/css/bootstrap-multiselect.css" type="text/css" />
<script type="text/javascript">
    $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
        });
    });
</script>
-->
@endsection
