@extends('admin.layouts.app')
@section('content')
<?php use App\Http\Controllers\Admin\SeoController; 
$urls_list = SeoController::UrlsList();

?>

<!-- ===== ===== --> 

	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5"> Add Page </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Search Engine Listing</a></li>
							<li class="breadcrumb-item active" aria-current="page">Add Page</li>
						</ol>
					</div>
					{{-- <div class="d-flex">
						<div class="justify-content-center">
							<a href="/admin/seo/add-url" class="btn btn-white btn-icon-text my-2 mr-2"> <i class="fe fe-folder-plus mr-2"></i> Add New SEO URL </a> 
						</div>
					</div> --}}
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
									<form method="POST" class="row justify-content-md-center" action="/admin/seo/store" 
									enctype="multipart/form-data" >	
										<div class="col-xl-9 col-lg-9 col-md-9">
										@csrf									
											<div class="card shade">
												<div class="row">
													<div class="col-lg-12 col-md-12 form-group">
													
														<label>Page Urls List : <span>*</span></label>
														<select name="url_id" class="form-control w-100" id="urls_list" onchange="getPageName(this)" required>
															@foreach ($urls_list as $item)

																<option value="{{$item->id}}" data-id="{{$item->urls}}">{{$item->page_name}}  ( {{ $item->urls }} )</option>
															@endforeach
														</select> 
													</div><br/>
												</div>
												<div class="row">
													<div class="col-lg-5 col-md-5 form-group">
														<label> Page Name </label>
														<input name="page_name" value=""  class="form-control" placeholder="Page Name..." type="text" id="page_name" readonly>
													</div> 
													<div class="col-lg-7 col-md-7 form-group">
														<label>Page URL : <span>*</span></label>
														<div class="input-group mb-2"> 
															<div class="input-group-prepend"> <div class="input-group-text">https://aaplsolutions.com/</div> </div>
															<input name="page_url" value="" required="" class="form-control"  maxlength="255" type="text" id="page_url" readonly>
														</div>
													</div>
												</div> 
												<div class="row">
													<div class="col-lg-12 col-md-5 form-group">
														<label>Page Title / Meta : <span>*</span></label>
														<input name="page_title" value=""  class="form-control" placeholder="Page Title..." maxlength="255" type="text" id="title">
													</div>  
												</div>
												<div class="form-group">
													<label>Meta Keywords : <span>*</span></label>
													<input name="meta_keywords" value=""  class="form-control" placeholder="Meta Keywords..." maxlength="255" type="text" id="meta_keywords">
													<small> 100 to 255 Keywords used </small>
												</div> 
												<div class="form-group">
													<label for="meta_description">Meta Description </label>
													<textarea name="meta_description" class="form-control" cols="10" rows="2" id="meta_description" placeholder="Meta Description..."> </textarea>
													<small> 155 to 160 Keywords used </small>
												</div> 

												<div class="form-group meta_tag_script">
													<label for="meta_tag_script">Meta tags (HTML) </label>
													<textarea name="meta_tag_script" class="form-control" cols="10" rows="10" id="meta_tag_script" placeholder="Meta tags script..."> </textarea>
													<small> Paste Your Tags here only html Tags </small> 
												</div>

												<div class="form-group meta_tag_script">
													<label for="meta_tag_script_header">Meta Script (JS Script) </label>
													<textarea name="meta_tag_script_header" class="form-control" cols="10" rows="10" id="meta_tag_script_header" placeholder="Meta tags script..."> </textarea>
													<small> Paste Your Tags With < script > Tags </small> 
												</div>
												
											<!--	<div class="form-group">
													<label for="language" class="mr-3"><b>Language:</b> </label>
													<label class="form-check-label ml-4">
														<input type="checkbox" name="language[]" class="form-check-input" value="en" checked required>English
													</label>
													<label class="form-check-label ml-4">
														<input type="checkbox" name="language[]" class="form-check-input" value="es">Spanish
													</label>
													  <label class="form-check-label ml-4">
														<input type="checkbox" name="language[]" class="form-check-input" value="ar">Arabic
													</label>
													<label class="form-check-label ml-4">
														<input type="checkbox" name="language[]" class="form-check-input" value="sw">Swahili
													</label>
													  <label class="form-check-label ml-4">
														<input type="checkbox" name="language[]" class="form-check-input" value="fr">French
													</label>
												</div> 
											-->

												<div class="form-group">
													<label>Status </label>
													<select name="is_active" class="custom-select w-100">
														<option value="1">Active</option>
														<option value="0">In Active</option>
													</select>
												</div>
												<div class="submit">
													<input class="btn btn-primary w-100" type="submit" value="Add Now">  
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
<!--
<link href="/admin/css/select2.min.css" rel="stylesheet" />
<script src="/admin/js/select2.min.js"></script>
-->
<script>
    $(document).ready(function() {
		$('#urls_list').select2();
	});
	
	function getPageName(sel) {
		var page_name = sel.options[sel.selectedIndex].text
		var page_url = $('#urls_list').find(':selected').attr('data-id')
		$('#page_name').val(page_name);
		$('#page_url').val(page_url);
	}
</script>

@include('admin.layouts.footer')

@endsection
