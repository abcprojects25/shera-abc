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
						<h2 class="main-content-title tx-24 mg-b-5"> Edit MileStone </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">MileStone Pages</a></li>
							<li class="breadcrumb-item active" aria-current="page">Edit MileStone</li>
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
										<form method="POST" class="row justify-content-md-center" action="/admin/about/our-milestone-update" enctype="multipart/form-data" autocomplete="off" >	
											<div class="col-xl-12 col-lg-9 col-md-9">
											@csrf		
											<input type="hidden" value="{{$EditData->id}}" name="edit_id"/>		 
											<div class="row">
												<div class="col-lg-6 col-md-9 form-group">
													<label> Title : <span>*</span></label>
													<input name="title" value="{{$EditData->title}}" required="" class="form-control" placeholder="Title.." maxlength="255" type="text">
												</div>
												<div class="col-lg-6 col-md-9 form-group">
													<label> Sub-Title : <span>*</span></label>
													<input name="sub_title" value="{{$EditData->sub_title}}" required="" class="form-control" placeholder="Sub-Title.." maxlength="255" type="text">
												</div>
												<div class="col-lg-6 col-md-9 form-group">
													<label> Timeline Year: <span>*</span></label>
													<input name="timeline_year" value="{{$EditData->timeline_year}}" required="" class="form-control" placeholder="Timeline Year.." maxlength="255" type="text">
												</div>	
												<div class="col-lg-6 col-md-9 form-group">
													<label> Timeline Title: <span>*</span></label>
													<input name="timeline_title" value="{{$EditData->timeline_title}}" required="" class="form-control" placeholder="Timeline Title.." maxlength="255" type="text">
												</div>
												<div class="col-lg-6 col-md-9 form-group">
													<label> Timeline Text: <span>*</span></label>
													<input name="timeline_text" value="{{$EditData->timeline_text}}" required="" class="form-control" placeholder="Timeline Text.." maxlength="255" type="text">
												</div>	
												<div class="col-lg-6 col-md-9 form-group">
													<div id="choose-thumbnail">
														<label> Choose Background Image  </label> <br />
														<input type="file" accept="image/*" id="choose-file" value="" name="background_image" />
														<label for="choose-file">Choose Image</label>
													</div>	
												</div>	
												<div class="col-lg-6 col-md-9 form-group">
													<div id="choose-thumbnail">
														<label> Previous Background Image  </label> <br />
														<img src="{{$EditData->image_url}}" width="200px" height="100px"/>
													</div>	
												</div>	

												<input type="hidden" name="edit_background_image" value="{{$EditData->image_url}}"/>
											</div> 
										
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
	function youtube_parser(url){
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
		var match = url.match(regExp);
		var youtubeid = (match&&match[7].length==11)? match[7] : false;
		document.getElementById('video_thumb').value=youtubeid;
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
			height: 480,
			type: 'box'
		},
		boundary: {
			width: 500,
			height: 500
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
