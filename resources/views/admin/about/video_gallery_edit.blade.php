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
						<h2 class="main-content-title tx-24 mg-b-5"> Edit Video Gallery</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Video Gallery Pages</a></li>
							<li class="breadcrumb-item active" aria-current="page">Edit Video Gallery</li>
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
									<form method="POST" class="row justify-content-md-center" action="/admin/about/video-gallery-update" enctype="multipart/form-data" >	
										<div class="col-xl-9 col-lg-9 col-md-9">
										@csrf				 
										<input type="hidden" value="{{$EditData->id}}" name="edit_id"/>
										<div class="row">
											<div class="col-lg-12 col-md-9 form-group">
												<label> Project Name : <span>*</span></label>
												<input name="project_name" value="{{$EditData->project_name}}" required="" class="form-control" placeholder="Project Name.." maxlength="255" type="text">
											</div>
											<div class="col-lg-12 col-md-9 form-group">
												<label> Project BY : <span>*</span></label>
												<input name="project_by" value="{{$EditData->project_by}}" required="" class="form-control" placeholder="Project By.." maxlength="255" type="text">
											</div>
											<div class="col-lg-12 col-md-9 form-group">
												<label> Vimeo Url :</label>
												<input name="vurl" value="{{$EditData->vurl}}" onkeyup="urlfilter(this.value)" class="form-control" placeholder="Vimeo Url.." type="text">
												<input name="vthumb" value="{{$EditData->vthumb}}" id="vthumb" type="hidden">
												<br/>
												<video class="thumbnial" width="320" height="240" controls autoplay muted>
													<source src="{{$EditData->vurl}}" type="video/mp4">
												</video>
											</div>
										</div> 
										</div> <!-- -->
										<div class="col-xl-3 col-lg-3 col-md-3">
									
											{{-- <div class="form-group text-center">
												<div class="image-upload"> <br>
													<label for="description">Add Catalogue Thumbnail</label>
													<input type="hidden" name="thumnail" value="" class="hidden-image-data" required/>
													<center>
														<label for="upload"> 
														<img src="{{($EditData->thumnail) ? $EditData->thumnail : 'http://dev.vivaacp.com/admin/img/choose_file.jpg'}} " id='imgid' class="text-center img-fluid" style="cursor: pointer" title="Click here to update Image" /> </label>
													</center>
													<small> Image should be below 1mb.</small>
													<input type="file" id="upload" name="image" class="text-center" data-target="#myModal121" data-toggle="modal" accept="image/*">
													<div id="upload-demo-i" style="cursor: pointer" onclick="editImage()"></div>
												</div>
											</div> --}}
																					
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
<script>
	function urlfilter(url){
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
		var match = url.match(regExp);
		var youtubeid = (match&&match[7].length==11)? match[7] : false;
		document.getElementById('vthumb').value=youtubeid;
	}
</script>
@include('admin.layouts.footer')

 <!-- Croper Model  -->
 <div id="myModal121" class="modal fade " role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Catalogue Thumbnail </h4>
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
