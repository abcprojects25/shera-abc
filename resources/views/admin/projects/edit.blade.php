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
						<h2 class="main-content-title tx-24 mg-b-5"> Edit Project Name </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Project Listing</a></li>
							<li class="breadcrumb-item active" aria-current="page">Edit Project</li>
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
									<form method="POST" action="/admin/project/edit-project" class="row justify-content-md-center" enctype="multipart/form-data" >	
										@csrf
										<input type="hidden" value="{{ $edit_data->id}}" name="edit_id">
										<div class="col-xl-11 col-lg-10 col-md-12">
											<div class=" ">
												<div class="row">
													<div class="col-lg-9">
														<div class="row">															
															<div class="col-lg-4 form-group area_interest">
																<label> Select Category </label>
																<select name="category_ids[]" id="multiple-checkboxes" class="form-control" multiple="multiple">
																	@foreach ($Categories as $item)
																		@php
																			$category = explode(',', $edit_data->category_id);
																		@endphp
																		@foreach ($category as $val)
																			<option value="{{$item->id}}" {{ $item->id == $val ? 'selected' : '' }} > {{$item->name}} </option>
																		@endforeach
																	@endforeach 
																</select>
															</div> 
															<div class="col-lg-8 form-group">
																<label>Project Title : <span>*</span></label>
																<input name="page_title" value="{{($edit_data->title) ? $edit_data->title : ''}}"  class="form-control" placeholder="Project Title..." maxlength="255" type="text" id="page_title" onkeypress="ArticleNameurl();" onblur="ArticleNameurl();">
															</div>
															<div class="col-lg-12 form-group">
																<label>Page URL : <span>*</span></label>
																<div class="input-group mb-2"> 
																	<div class="input-group-prepend"> <div class="input-group-text">https://vivaacp.com/</div> </div>
																	<input name="page_url" value="{{($edit_data->url) ? $edit_data->url : ''}}" class="form-control"  maxlength="255" type="text" id="page_url" >
																</div> 
															</div>
															<div class="col-lg-6 form-group">
																<label>Project Summmery :</label>
																<input name="project_summary" value="{{($edit_data->project_summary) ? $edit_data->project_summary : ''}}"  class="form-control" placeholder="Project summary..." type="text" id="project_summary">
															</div>
															<div class="col-lg-6 form-group">
																<label>State, City Name :</label>
																<input name="city_state_name" value="{{($edit_data->city_state_name) ? $edit_data->city_state_name : ''}}" class="form-control" placeholder="State, City Name.." type="text" id="city_state_name">
															</div>
														</div>
														<hr />
														<div class="row">
															<div class="col-lg-8 form-group">
																<label>Video Title :</label>
																<input name="video_title" value="{{($edit_data->video_title) ? $edit_data->video_title : ''}}" class="form-control" placeholder="Title..." maxlength="255" type="text" id="title">
															</div>
															<div class="col-lg-4 form-group">
																<label>Type : </label> 
																<select name="video_type" id="types" class="custom-select w-100">
																	<option value="">Select Type</option> 
																	<option value="1" {{ $edit_data->video_type == 1 ? 'selected' : '' }}> YouTube </option>       
																	<option value="2" {{ $edit_data->video_type == 2 ? 'selected' : '' }}> Vimeo </option>
																</select>
															</div>
															<div class="col-lg-8 form-group">
																<label>Video URL : </label>
																<input name="video_url" value="{{$edit_data->video_url}}" class="form-control" placeholder="URL..." maxlength="255" type="text" id="url">
															</div>
															<div class="col-lg-4 form-group">
																<label>Direction :</label> 
																<select name="direction" id="direction" class="custom-select w-100">
																	<option selected disabled>Select Direction</option> 
																	<option value="east" {{ $edit_data->direction == 'east' ? 'selected' : '' }}> East</option>
																	<option value="west" {{ $edit_data->direction == 'west' ? 'selected' : '' }}> West</option>
																	<option value="north" {{ $edit_data->direction == 'north' ? 'selected' : '' }}> North</option>
																	<option value="south" {{ $edit_data->direction == 'south' ? 'selected' : '' }}> South</option>
																</select>
															</div>	
															<div class="col-lg-12 form-group">
																<label> Add Products </label>
																<select name="products[]" id="search_products" multiple data-role="tagsinput" Placeholder="Products type and enter.."> 
																	@if (isset($edit_data->products))
																	@php
																		$products = explode(',', $edit_data->products);
																	@endphp
																	@foreach ($products as $product)
																		<option value="{{$product}}">{{$product}}</option>
																	@endforeach
																	@endif
																</select>
															</div>
														</div>
													</div>
													
													<div class="col-lg-3">
														<div class="form-group text-center">
															<div class="card shade"> 
																<div class="image-upload">
																	<label for="description">Add Project Thumbnail</label>
																	<input type="hidden" name="thumnail" class="hidden-image-data" required/>
																	<center>
																		<label for="upload"> 
																		<input type="hidden" name="edit_thumnail" value="{{$edit_data->image}}"/>
	
																		<img src="{{($edit_data->image) ? $edit_data->image : url('/admin/img/choose_file.jpg') }}" id='imgid' class="text-center img-fluid" style="cursor: pointer" title="Click here to update Image" /> </label>
																	</center>
																	<small> Image should be below 1mb.</small>
																	<input type="file" id="upload" name="image" class="text-center" data-target="#myModal121" data-toggle="modal" accept="image/*">
																	<div id="upload-demo-i" style="cursor: pointer" onclick="editImage()"></div>
																</div>
															</div>
														</div>
														<div class="form-group">
															<div class="card shade">  
																<div id="choose-thumbnail">
																	<label> Choose Banner Image  </label> <br />
																	<input type="file" value="" accept="image/*" id="choose-file" name="banner_image" />
																	<label for="choose-file">Choose Banner</label>
																	<div id="img-preview"></div>
																	
																</div>
																<input type="hidden" name="edit_banner_image" value="{{$edit_data->banner_image}}"/>
																{{-- <select name="banner_img_id" class="form-control">
																	<option selected disabled>-- Select Banner Image --</option>
																	@foreach ($BannerImages as $item)
																		<option value="{{$item->id}}"><img src="{{$item->urls}}" style="width:10px; height:10px;" /> {{ $item->title}}</option>
																	@endforeach
																</select>  --}}
															</div>
														</div> 
													</div>
												</div>   
												 
												{{-- <div class="form-group">
													<label> Add Project Images </label> <br />
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ServerImageModal">
														Add Project Images
													</button>
												</div>  --}}
												
												<div class="form-group">
													<label for="BookDescription"> Project Description </label>
													<textarea name="description" class="form-control content" cols="10" rows="5" id="description" placeholder="Description...">
														{{ $edit_data->description }}
													</textarea> 
												</div> 
												
												<div class="form-group">
													<label> Add Tags </label>
													<select name="tags[]" id="search_tags" multiple data-role="tagsinput" Placeholder="Tags type and enter.."> 
														@if (isset($edit_data->tags))
														@php
															$tags = explode(',', $edit_data->tags);
														@endphp
														@foreach ($tags as $tag)
															<option value="{{$tag}}">{{$tag}}</option>
														@endforeach
														@endif
													</select>
												</div>
												
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
				<h4 class="modal-title"> Project Thumbnail </h4>
				<button type="button" style=" "class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body text-center">
				<div id="upload-demo" ></div>
				<button class="btn btn-success upload-result" data-dismiss="modal">Crop</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="/admin/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
        });
    });
</script>
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
<script>
	function ArticleNameurl(){
		// alert(s_data.length);
		s_name = document.getElementById("page_title").value;
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
				return $.map(list, function(tagsname) {
					return { name: tagsname }; });
				}
			}
			});
			Tags.initialize();
			$('#search_tags').tagsinput({
			typeaheadjs: {
				name: 'tagname',
				displayKey: 'name',
				valueKey: 'id',
				source: Tags.ttAdapter()
			}
		});
	
	// Products fatch dynamic
	var Products = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			prefetch: {
				url: '{{url("product-fetch")}}',
				filter: function(list) {
				return $.map(list, function(productsname) {
					return { name: productsname }; });
				}
			}
			});
			Products.initialize();
			$('#search_products').tagsinput({
			typeaheadjs: {
				name: 'tagname',
				displayKey: 'name',
				valueKey: 'id',
				source: Products.ttAdapter()
			}
		});
		
	</script>

 
 

@endsection
