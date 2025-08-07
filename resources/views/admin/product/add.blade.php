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
						<h2 class="main-content-title tx-24 mg-b-5"> Add Product </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Products Listing</a></li>
							<li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
									<form method="POST" action="/admin/product/product-store" class="row justify-content-md-center" enctype="multipart/form-data" >
										@csrf
										<div class="col-xl-12">
											<div class=" ">
												<div class="row">
													<div class="col-lg-9">
														<div class="row">
															
															<div class="col-lg-6 form-group area_interest">
																<label> Select Category : <span>*</span> </label>

																<select name="category_id" id="mainCategory" class="form-control" required>
																<option value="" selected disabled>-- Select Category --</option>
																@foreach ($Categories as $item)
																	<option value="{{ $item->id }}">{{ $item->name }}</option>
																@endforeach
															</select>
															
															</div>
															<div class="col-lg-6 form-group area_interest">
																<label> Select Sub Category : <span>*</span> </label>
																<select name="subcategory_id" id="subCategory" class="form-control" required>
																<option value="" selected disabled>-- Select Sub Category --</option>
																@foreach ($SubCategories as $item)
																	<option value="{{ $item->id }}" data-parent="{{ $item->category_id }}">{{ $item->name }}</option>
																@endforeach
															</select>

															
															</div>
															<div class="col-lg-12 form-group">
																<label>Product Title : <span>*</span></label>
																<input name="product_title" value=""  class="form-control" placeholder="Product Title..." maxlength="255" type="text" id="product_title" onkeypress="ArticleNameurl();" onblur="ArticleNameurl();">
															</div>
															<div class="col-lg-12 form-group">
															</div>
															<div class="col-lg-12 form-group">
																<label>Page URL : <span>*</span></label>
																<div class="input-group mb-2"> 
																	<div class="input-group-prepend"> <div class="input-group-text">https://shera.com/product/</div> </div>
																	<input name="product_url" value="" required="" class="form-control"  maxlength="255" type="text" id="page_url" >
																</div> 
															</div>

															<div class="col-lg-6 form-group">
																<label>Texture :</label>
																<input name="texture" value=""  class="form-control" placeholder="Texture..." maxlength="255" type="text" id="texture">
															</div>
															<div class="col-lg-6 form-group">
																<label>Profile :</label>
																<input name="profile" value=""  class="form-control" placeholder="Profile..." maxlength="255" type="text" id="profile">
															</div>
															<div class="col-lg-6 form-group">
																<label>Colour : </label>
																<input name="colour" value=""  class="form-control" placeholder="Colour..." maxlength="255" type="text" id="colour">
															</div>
															<div class="col-lg-6 form-group">
																<label>Size : </label>
																<input name="size" value=""  class="form-control" placeholder="Size..." maxlength="255" type="text" id="size">
															</div>
															<div class="col-lg-6 form-group">
																<label>Thickness :</label>
																<input name="thickness" value=""  class="form-control" placeholder="Thickness..." maxlength="255" type="text" id="thickness">
															</div>
															<div class="col-lg-6 form-group">
																<label>Weight : </label>
																<input name="weight" value=""  class="form-control" placeholder="Weight..." maxlength="255" type="text" id="weight">
															</div>
															<div class="col-lg-6 form-group">
																<label>Quantity : </label>
																<input name="quantity" value="" class="form-control" placeholder="Quantity..." maxlength="255" type="text" id="quantity">
															</div>																	
														</div>
													</div>
													
													<div class="col-lg-3">
														<div class="card shade"> 
															<div class="form-group text-center">
																<div class="image-upload"> 
																	<label for="description">Add Product Thumbnail</label>
																	<input type="hidden" name="thumnail" accept="image/*" class="hidden-image-data" required/>
																	<center>
																		<label for="upload"> 
																		<img src="/admin/img/choose_file.jpg" id='imgid' class="text-center img-fluid" style="cursor: pointer" title="Click here to update Image" /> </label>
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
													<label for="BookDescription"> Product Description </label>
													<textarea name="description" class="form-control content" cols="10" rows="5" id="description" placeholder="Meta Description...">
														
													</textarea> 
												</div>
												
												<div class="form-group">
													<label>Status </label>
													<select name="is_active" class="custom-select w-100">
														<option value="1">Active</option>
														<option value="0">Inactive</option>
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
@include('admin.layouts.footer')
<!-- 

<script>
    document.getElementById('openMediaLibrary').onclick = function() {
        window.location.href = '/admin/blog/media';
    };
</script> -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mainCategory = document.getElementById('mainCategory');
        const subCategory = document.getElementById('subCategory');

        const allSubOptions = Array.from(subCategory.options).slice(1); 

        mainCategory.addEventListener('change', function () {
            const selectedMainId = this.value;

            console.log('Selected main category:', selectedMainId);

            subCategory.innerHTML = '<option value="" selected disabled>-- Select Sub Category --</option>';

            allSubOptions.forEach(option => {
                console.log('Option parent:', option.dataset.parent);
                if (option.dataset.parent === selectedMainId) {
                    subCategory.appendChild(option);
                }
            });
        });
    });
</script>



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
