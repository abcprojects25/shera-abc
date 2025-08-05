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
						<h2 class="main-content-title tx-24 mg-b-5"> Edit Product </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Products Listing</a></li>
							<li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
									<form method="POST" action="/admin/product/product-update" class="row justify-content-md-center" enctype="multipart/form-data" >
										@csrf
										<input type="hidden" value="{{ $edit_data->id}}" name="edit_id">
										<div class="col-xl-11 col-lg-9 col-md-12">
											<div class="card shade">
												<div class="row">
													<div class="col-lg-9">
														<div class="row">
															{{-- <div class="col-lg-4 form-group">
																<label> Select Category </label>
																<select name="category_id" class="custom-select w-100" required="">
																	<option value="" selected disabled>-- Select Category -- </option>
																	@foreach ($Categories as $item)
																		<option value="{{$item->id}}" {{ $item->id == $edit_data->category_id ? 'selected' : '' }}> {{$item->name}}  </option>
																	@endforeach
																</select>
															</div>  --}}
															<div class="col-lg-4 form-group area_interest">
																<label> Select Category </label>
																@php
																$Categories = \App\Models\Categories::where('type', 1)->get();
															@endphp

															<select name="category_ids[]" class="form-control" multiple required="">
																@if(count($Categories) > 0)
																	@foreach ($Categories as $item)
																		<option value="{{ $item->id }}">{{ $item->name }}</option>
																	@endforeach
																@else
																	<option disabled>No categories found</option>
																@endif
															</select>
															</div> 
															<div class="col-lg-8 form-group">
																<label>Product Title : <span>*</span></label>
																<input name="product_title" value="{{($edit_data->title) ? $edit_data->title : ''}}"  class="form-control" placeholder="Product Title..." maxlength="255" type="text" id="product_title" onkeypress="ArticleNameurl();" onblur="ArticleNameurl();">
															</div>

															<div class="col-lg-4 form-group">
																<label>Application : <span>*</span></label>
																<input name="application" value="{{($edit_data->application) ? $edit_data->application : ''}}" required="" class="form-control" placeholder="Application..." maxlength="255" type="text" id="application">
															</div>
															</div>
															<!-- <div class="col-lg-12 form-group">
																<label>Page URL : <span>*</span></label>
																<div class="input-group mb-2"> 
																	<div class="input-group-prepend"> <div class="input-group-text">https://vivaacp.com/product/</div> </div>
																	<input name="product_url" value="{{($edit_data->product_url) ? $edit_data->product_url : ''}}" required="" class="form-control"  maxlength="255" type="text" id="page_url" >
																</div> 
															</div> -->
															{{-- <div class="col-lg-8 form-group">
																<label>Video Title : </label>
																<input name="video_title" value="{{($edit_data->video_title) ? $edit_data->video_title : ''}}" required="" class="form-control" placeholder="Title..." maxlength="255" type="text" id="video_title">
															</div>
															<div class="col-lg-4 form-group">
																<label>Type : <span>*</span></label> 
																<select name="video_type" id="types" class="custom-select w-100" required="">
																	<option value="">Select Type</option> 
																	<option value="1" {{ $edit_data->video_type == 1 ? 'selected' : '' }}> YouTube </option>       
																	<option value="2" {{ $edit_data->video_type == 2 ? 'selected' : '' }}> Vimeo </option>
																</select>
															</div>
															<div class="col-lg-8 form-group">
																<label>Video URL : <span>*</span></label>
																<input name="video_url" value="{{($edit_data->video_url) ? $edit_data->video_url : ''}}" required="" class="form-control" placeholder="URL..." maxlength="255" type="text" id="url">
															</div> --}}
															<!-- <div class="col-lg-4 form-group">
																<label>SKU : <span>*</span></label>
																<input name="sku" value="{{($edit_data->sku) ? $edit_data->sku : ''}}" required="" class="form-control" placeholder="SKU..." maxlength="255" type="text" id="sku">
															</div> -->
															{{-- <div class="col-lg-4 form-group">
																<label>Panel Sizes : <span>*</span></label>
																<input name="panel_size" value="{{($edit_data->panel_size) ? $edit_data->panel_size : ''}}" required="" class="form-control" placeholder="Panel Size..." maxlength="255" type="text" id="panel_size">
															</div> --}}
															<!-- <div class="col-lg-4 form-group">
																<label>Features :</label>
																<input name="features" value="{{($edit_data->features) ? $edit_data->features : ''}}"  class="form-control" placeholder="Features..." maxlength="255" type="text" id="features">
															</div> -->
															<!-- {{-- <div class="col-lg-4 form-group">
																<label>Properties : <span>*</span></label>
																<input name="properties" value="{{($edit_data->properties) ? $edit_data->properties : ''}}" required="" class="form-control" placeholder="Properties..." maxlength="255" type="text" id="properties">
															</div>
															<div class="col-lg-4 form-group">
																<label>Application : <span>*</span></label>
																<input name="application" value="{{($edit_data->application) ? $edit_data->application : ''}}" required="" class="form-control" placeholder="Application..." maxlength="255" type="text" id="application">
															</div>															
															<div class="col-lg-4 form-group">
																<label>Thickness : <span>*</span></label>
																<input name="thickness" value="{{($edit_data->thickness) ? $edit_data->thickness : ''}}" required="" class="form-control" placeholder="Thickness..." maxlength="255" type="text" id="thickness">
															</div>
															<div class="col-lg-4 form-group">
																<label>Core : <span>*</span></label>
																<input name="core" value="{{($edit_data->core) ? $edit_data->core : ''}}" required="" class="form-control" placeholder="Core..." maxlength="255" type="text" id="core">
															</div>
															<div class="col-lg-4 form-group">
																<label>Coil Thickness : <span>*</span></label>
																<input name="coil_thickness" value="{{($edit_data->coil_thickness) ? $edit_data->coil_thickness : ''}}" required="" class="form-control" placeholder="Coil Thickness..." maxlength="255" type="text" id="coil_thickness">
															</div>
															<div class="col-lg-4 form-group">
																<label>  Select Catalogues Brochure </label>
																<select name="brochure_id" class="custom-select w-100">
																	<option value="" selected disabled>-- Select Catalogues Brochure --</option>
																	@foreach ($Catalogues as $item)
																		<option value="{{$item->id}}" {{ $item->id == $edit_data->brochure_id ? 'selected' : '' }}> {{$item->title}} </option>
																	@endforeach
																</select>
															</div>  --}} -->
															
														</div>
													</div>													
													<div class="col-lg-3">
														<div class="card shade"> 
															<div class="form-group text-center">
																<div class="image-upload"> <br>
																	<label for="description">Add Product Thumbnail</label>
																	<input type="hidden" name="thumnail" class="hidden-image-data" required/>
																	<input type="hidden" name="edit_thumnail" value="{{$edit_data->image}}"/>
																	<center>
																		<label for="upload"> 
																		<img src="{{($edit_data->image) ? $edit_data->image : '/admin/img/choose_file.jpg'}}" id='imgid' class="text-center img-fluid" style="cursor: pointer" title="Click here to update Image" /> </label>
																	</center>
																	<small> Image should be below 1mb.</small>
																	<input type="file" id="upload" name="image" class="text-center" data-target="#myModal121" data-toggle="modal" accept="image/*">
																	<div id="upload-demo-i" style="cursor: pointer" onclick="editImage()"></div>
																</div>
															</div>
														</div>

													</div>
												</div>   
												 
											 <div class="form-group">
													<label> Edit Product Images </label> <br />
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ServerImageModal">
														Edit Product Images
													</button> 
												</div> 
												 
												<div class="form-group">
													<label for="BookDescription"> Product Description </label>
													<textarea name="description" class="form-control content" cols="10" rows="5" id="description" placeholder="Meta Description...">
														{{ strip_tags($edit_data->description) }}

													</textarea> 
												</div>
												
												<!-- <div class="form-group">
													<label> Edit Product Names </label>
													
												</div> -->


												{{-- <div class="form-group">
													<label> Add Project Names </label>
													<select name="project_tags[]" multiple data-role="tagsinput" id="search_projects" Placeholder="Project type and enter.."> 
														@if (isset($edit_data->project_tags))
														@php
															$project_tags = explode(',', $edit_data->project_tags);
														@endphp
														@foreach ($project_tags as $project_tag)
															<option value="{{$project_tag}}">{{$project_tag}}</option>
														@endforeach
														@endif 
													</select>
												</div> --}}
												<!-- <div class="form-group">
													<label> Add Tags </label>
													<select name="tags[]" multiple data-role="tagsinput" id="search_tags" Placeholder="Tag type and enter.."> 
														@if (isset($edit_data->tags))
														@php
															$tags = explode(',', $edit_data->tags);
														@endphp
														@foreach ($tags as $tag)
															<option value="{{$tag}}">{{$tag}}</option>
														@endforeach
														@endif
													</select>
												</div> -->
												{{-- <div class="form-check-inline">
													<label class="form-check-label">
													  <input type="checkbox" name="same_properties" class="form-check-input" value="1">Same Properties For All
													</label>
												  </div> --}}
												<div class="form-group">
													<label>Status </label>
													<select name="is_active" class="custom-select w-100">
														<option value="1">Active</option>
														<option value="0">In Active</option>
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


 <!-- Croper Model  -->
<div id="myModal121" class="modal fade " role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Product Thumbnail </h4>
				<button type="button" style=" "class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body text-center">
				<div id="upload-demo" ></div>
				<button class="btn btn-success upload-result" data-dismiss="modal">Crop</button>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('/admin/js/croppie.js') }}"></script>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$uploadCrop = $('#upload-demo').croppie({
		enableExif: true,
		viewport: {
			width: 480,
			height: 600,
			type: 'box'
		},
		boundary: {
			width: 500,
			height: 620
		}
	});

	$('#upload').on('change', function() {
		var reader = new FileReader();
		reader.onload = function(e) {
			$uploadCrop.croppie('bind', {
				url: e.target.result
			}).then(function() {
				console.log('jQuery bind complete');
			});
		}
		reader.readAsDataURL(this.files[0]);
	});

	$('.upload-result').on('click', function(ev) {
		$uploadCrop.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function(resp) {
			$('.hidden-image-data').val(resp);
			$("#imgid").show();
			// $("#imgid1").show();
			document.getElementById("imgid").src = resp;
			document.getElementById("save_button").disabled = false;
			// $("#save_button").show();
		});
	});

	function editImage() {
		$("#upload").click();
	}

</script> 
<!-- Tags Input -->
<link href="/admin/css/tagsinput.css" rel="stylesheet" type="text/css">
<script src="/admin/js/typeahead.bundle.min.js"></script> 
<script src="/admin/js/tagsinput.js"></script>
<script type="text/javascript" src="/admin/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
        });
    });
</script>
<script>
	function ArticleNameurl(){
		// alert(s_data.length);
		s_name = document.getElementById("product_title").value;
		// $('#ArticleName').val();
		dlenth = s_name.length;
		//alert(s_name);
		var seourl = s_name.toString()               // Convert to string
		seourl = seourl.normalize('NFD')               // Change diacritics
		seourl = seourl.replace(/[\u0300-\u036f]/g,'') // Remove illegal characters
		seourl = seourl.replace(/\s+/g,'-')            // Change whitespace to dashes
		seourl = seourl.toLowerCase()                  // Change to lowercase
		seourl = seourl.replace(/&/g,'-and-')          // Replace ampersand
		seourl = seourl.replace(/[^a-z0-9\-]/g,'')     // Remove anything that is not a letter, number or dash
		seourl = seourl.replace(/-+/g,'-')             // Remove duplicate dashes
		seourl = seourl.replace(/^-*/,'')              // Remove starting dashes
		seourl = seourl.replace(/-*$/,''); 
		//alert(seourl);

		document.getElementById("page_url").value = seourl;	
	}
	// Tags fatch dynamic
var Tags = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: {
			url: '{{url("tag-fetch")}}',
			filter: function(list) {
			return $.map(list, function(tags) {
				return { name: tags }; });
			}
		}
		});
		Tags.initialize();
		$('#search_tags').tagsinput({
		typeaheadjs: {
			name: 'tags',
			displayKey: 'name',
			valueKey: 'id',
			source: Tags.ttAdapter()
		}
	});


	// project fatch dynamic
var Tags = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: {
			url: '{{url("project-fetch")}}',
			filter: function(list) {
			return $.map(list, function(project_tags) {
				return { name: project_tags }; });
			}
		}
		});
		Tags.initialize();
		$('#search_projects').tagsinput({
		typeaheadjs: {
			name: 'project_tags',
			displayKey: 'name',
			valueKey: 'id',
			source: Tags.ttAdapter()
		}
	});
</script>
 

@endsection
