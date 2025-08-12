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
						<h2 class="main-content-title tx-24 mg-b-5"> Edit Blog </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Blog Pages</a></li>
							<li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
						</ol>
					</div>
					
					{{-- <div class="d-flex">
						<div class="justify-content-center">
							<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#exampleModal"> <i class="fe fe-folder-plus mr-2"></i> Add New Categories </a> 
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
									<form method="POST" class="row justify-content-md-center" action="/admin/blog/blog-update" enctype="multipart/form-data" >	
										<div class="col-xl-9 col-lg-9 col-md-9">
										@csrf	
										<input type="hidden" name="edit_id" value="{{$blog->id}}"/>			 
											<div class="row">
												<div class="col-lg-9 col-md-9 form-group">
													<label>Blog Title : <span>*</span></label>
													<input name="blog_name" value="{{($blog->blog_title) ? $blog->blog_title : 'NA'}}" required="" class="form-control" placeholder="Blog Title..." maxlength="255" type="text">
												</div>
												<div class="col-lg-3 col-md-3 form-group">
													<label>Select Categories </label>
													<select name="category_id" class="custom-select w-100" required="">
														<option value="">-- Select Categories -- </option>
														@foreach ($Categories as $item)
															<option value="{{$item->id}}" {{ $item->id == $blog->category_id ? 'selected' : '' }}> {{$item->name}}  </option>
														@endforeach
													</select>
												</div>
												<div class="col-lg-12 form-group"> 
													<label>Blog URL : <span>*</span></label>
													<div class="input-group mb-2"> 
														<div class="input-group-prepend"> <div class="input-group-text">https://shera.com/blog/</div> </div>
														<input name="blog_url" value="{{($blog->blog_url) ? $blog->blog_url : 'NA'}}" required="" class="form-control"  maxlength="255" type="text" id="blog_url">
													</div>
												</div> 												
											</div> 
											<div class="form-group lg-editor">
												<label for="description">Blog Content </label>
												<textarea name="blog_content" class="form-control content" cols="10" rows="2" id="" placeholder="Description...">{!! ($blog->blog_content) ? $blog->blog_content : 'NA' !!} </textarea> 
											</div>
											<div class="form-group">
												<label> Add Tags </label>
												<select name="tags[]" id="search_tags" multiple data-role="tagsinput" Placeholder="Tag type and enter..">
													@if (isset($blog->tags))
														@php
															$tags = explode(',', $blog->tags);
														@endphp
														@foreach ($tags as $tag)
															<option value="{{$tag}}">{{$tag}}</option>
														@endforeach
													@endif
												</select>
											</div>
											 <!-- -->
										</div> <!-- -->
										<div class="col-xl-3 col-lg-3 col-md-3">
											
											<div class="form-group">
												<div class="card shade">  
													<div class="image-upload"> 
														<label for="description">Add Blog Thumbnail</label>
														<input type="hidden" name="thumnail" id="thumnail" class="hidden-image-data" required/>
														<center>
															<label for="upload"> 
															{{-- <img src="{{isset($blog->thumb_image) ? $blog->thumb_image : url('/admin/img/no_img_xl.jpg')}}" id='imgid' class="text-center img-fluid" style="cursor: pointer" title="Click here to update Image" /> </label> --}}
															<img src="{{isset($blog->thumb_image) ? $blog->thumb_image : url('/admin/img/no_img_xl.jpg')}}" id='imgid' class="text-center img-fluid" style="cursor: pointer" title="Click here to update Image" /> </label>
														</center>
														<small> Image should be below 1mb.</small>
														<input type="file" id="upload" name="thumb_image" class="text-center" data-target="#myModal121" data-toggle="modal" accept="image/*">
														<div id="upload-demo-i" style="cursor: pointer" onclick="editImage()"></div>
													</div>
												</div>
											</div> 
											

											<div class="form-group">
												<div class="card shade">  
													<label> Publish Date : {{$blog->publish_date}}</label>
													<input name="publish_date" value="" class="form-control" type="date" id="publish_date">
												</div>
											</div> 
												
											<div class="form-group">
												<div class="card shade">  
													<label>Author :</label>
													<input name="author" value="{{ $blog->author }}" class="form-control" type="text" id="author">
												</div>
											</div>

											<input type="hidden" name="edit_banner_image" value="{{$blog->banner_image}}"/>
											<input type="hidden" name="edit_thumb_image" value="{{$blog->thumb_image}}"/>
											<input type="hidden" name="prv_publish_date" value="{{$blog->publish_date}}"/>
											
											<div class="card shade">
												<div class="form-group">
													<label>Published? </label>
													<select name="is_published" class="custom-select w-100">
														<option value="1" {{ $blog->is_published == 1 ? 'selected' : '' }}>Published</option>
														<option value="0" {{ $blog->is_published == 0 ? 'selected' : '' }}>Not Published</option>
													</select>
												</div> 
											</div> <!-- --> 
										</div> <!-- --> 
										<div class="col-lg-12">
											<br />
											<div class="submit">
												<input class="btn btn-primary w-100" type="submit" value="Edit Now">  
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


<!-- Add Country -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Add New Categories </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"> 
				<div class="form-group">
					<label> Add Categories </label>
					<input type="text" class="form-control" id="search_categories" value="" placeholder="Type Here..." data-role="tagsinput">
				</div>
			</div>
			
		</div>
	</div>
</div>

<!-- Tags Input -->
<script src="/admin/js/common.js"></script>

<script>
	$(document).ready(function(){
		$("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#myTable tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
			
		});
	});	
</script>

@endsection
