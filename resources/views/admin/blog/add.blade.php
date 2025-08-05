@extends('admin.layouts.app')
@section('content')
<?php use App\Http\Controllers\CommonController; ?>

<!-- ===== ===== --> 
<style>
#imgid { height:auto !important; }
</style>
	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5"> Add Blog </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Blog Pages</a></li>
							<li class="breadcrumb-item active" aria-current="page">Add Blog</li>
						</ol>
					</div>
					
					<div class="d-flex">
						<div class="justify-content-center">
							{{-- <a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#exampleModal"> <i class="fe fe-folder-plus mr-2"></i> Add New Categories </a>  --}}
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
									<form method="POST" class="row justify-content-md-center" action="/admin/blog/blog-store" enctype="multipart/form-data" >	
										<div class="col-xl-9 col-lg-9 col-md-9">
											@csrf				 
											<div class="row">
												<div class="col-lg-9 col-md-9 form-group">
													<label>Blog Title : <span>*</span></label>
													<input name="blog_name" id="blog_name" value="" required="" class="form-control" placeholder="Blog Title..." onkeypress="ArticleNameurl();" onblur="ArticleNameurl();" type="text">
												</div>
												<div class="col-lg-6 col-md-6 form-group">
    <label>Author (Optional)</label>
    <input name="author" value="" class="form-control" placeholder="Author name..." type="text">
</div>

												<div class="col-lg-3 col-md-3 form-group">
													<label>Select Categories </label>
													<select name="category_id" class="custom-select w-100" required="">
														<option value="">-- Select Categories -- </option>
														@foreach ($Categories as $item)
															<option value="{{$item->id}}"> {{$item->name}}  </option>
														@endforeach
													</select>
												</div>
												<div class="col-lg-12 form-group"> 
													<label>Blog URL : <span>*</span></label>
													<div class="input-group mb-2"> 
														<div class="input-group-prepend"> <div class="input-group-text">https://vivaacp.com/blog/</div> </div>
														<input name="blog_url" value="" required="" class="form-control"  maxlength="255" type="text" id="blog_url">
													</div>
												</div> 												
											</div> 
											<div class="form-group lg-editor">
												<label for="description">Blog Content </label>
												<textarea name="blog_content" class="form-control content" cols="10" rows="2" id="" placeholder="Description...">
												</textarea> 
											</div>
											<div class="form-group">
												<label> Add Tags </label>
												<select name="tags[]" id="search_tags" multiple data-role="tagsinput" Placeholder="Tag type and enter.."> 
													
												</select>
											</div> 
											
											<div class="card shade">
												<h5> SEO </h5>
												<div class="row">
													<div class="col-md-6 form-group">
														<div class="form-group">
															<label>Page Title : <span>*</span></label>
															<input name="page_title" value=""  class="form-control" placeholder="Page Title..." maxlength="70" type="text" id="title" required>
															<small> 0 of 70 characters used </small>
														</div>
														<div class="form-group">
															<label>Meta Keywords :</label>
															<input name="meta_keywords" value=""  class="form-control" placeholder="Meta Keywords..." minlength="100" maxlength="255" type="text" id="meta_keywords">
															<small> 100 to 255 Keywords used </small>
														</div> 
													</div>
													<div class="col-md-6 form-group"> 
														<label for="BookDescription">Meta Description </label>
														<textarea name="meta_description" class="form-control" cols="5" rows="5" id="meta_description" maxlength="320" placeholder="Meta Description..."> </textarea>
														<small> 0 of 320 characters used </small>
													</div>
												</div> 
											</div> <!-- --> 								
										</div> <!-- -->
										<div class="col-xl-3 col-lg-3 col-md-3"> 
											<div class="form-group">
												<div class="card shade">  
													<label class="text-left"> Upload Image For Blog Content </label> 
													<a href="#" id="AddImage" data-toggle="modal" data-target="#ServerImageModal" class="btn ripple btn-primary">Upload For Blog Content </a>  
												</div>
											</div>
											<div class="form-group">
												<div class="card shade">  
													<div class="image-upload"> 
														<label for="description">Add Blog Thumbnail</label>
														<input type="hidden" name="thumnail" class="hidden-image-data" required/>
														<center>
															<label for="upload"> 
															<img src="{{ url('/admin/img/no_img_xl.jpg') }}" id='imgid' class="text-center img-fluid" style="cursor: pointer" title="Click here to update Image" /> </label>
														</center>
														<small> Image should be below 1mb.</small>
														<input type="file" id="upload" name="thumb_image" class="text-center" data-target="#myModal121" data-toggle="modal" accept="image/*">
														<div id="upload-demo-i" style="cursor: pointer" onclick="editImage()"></div>
													</div>
												</div>
											</div> 
											<div class="form-group">
												<div class="card shade">  
													<div id="choose-thumbnail" class="text-center">
														<label class="text-left"> Choose Banner Image  </label>  
														<div id="img-preview"></div>
														<input type="file" accept="image/*" id="choose-file" value="" name="banner_image" />
														<label for="choose-file" class="w-100">Choose Banner</label>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="card shade">  
													<label> Publish Date</label>
													<input name="publish_date" value="" class="form-control" type="date" id="publish_date">
												</div>
											</div> 
											<div class="form-group">
												<div class="card shade"> 
													<label>Published? </label>
													<select name="is_published" class="custom-select w-100">
														<option value="1">Published</option>
														<option value="0">Not Published</option>
													</select>
												</div>
											</div>
										</div> <!-- --> 
										<div class="col-lg-12">
											<br />
											<div class="submit">
												 <input class="btn btn-primary w-100" type="submit" value="Add Now">  
											</div> 
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
				<h4 class="modal-title">Blog Thumbnail </h4>
				<button type="button" style=" "class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body text-center">
				<div id="upload-demo" ></div>
				<button class="btn btn-success upload-result" data-dismiss="modal">Crop</button>
			</div>
		</div>
	</div>
</div>

<script>
const chooseFile = document.getElementById("choose-file");
const imgPreview = document.getElementById("img-preview");

chooseFile.addEventListener("change", function () {
  getImgData();
});

function getImgData() {
  const files = chooseFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      imgPreview.style.display = "block";
      imgPreview.innerHTML = '<img src="' + this.result + '" />';
    });    
  }
}
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
			width: 526,
			height: 275,
			type: 'box'
		},
		boundary: {
			width: 546,
			height: 295
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
	// -----------------------------------
</script>

<script>
function ArticleNameurl(){
	  // alert(s_data.length);
	  s_name = document.getElementById("blog_name").value;
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

		document.getElementById("blog_url").value = seourl;	
	}

	$(document).ready(function(){
		$("#myInput").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#myTable tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});

	});
	});	

	// Categories fatch dynamic
	var Categories = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: {
			url: '{{url("category-fetch")}}',
			filter: function(list) {
			return $.map(list, function(categoriesname) {
				return { name: categoriesname }; });
			}
		}
		});
		Categories.initialize();

		$('#search_categories').tagsinput({
		typeaheadjs: {
			name: 'categoryname',
			displayKey: 'name',
			valueKey: 'name',
			source: Categories.ttAdapter()
		}
	});

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
</script>

@endsection
