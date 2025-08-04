@extends('admin.layouts.app')
@section('content')
<style>
   #save_button1{display:none;}
</style>

<div class="main-content side-content pt-0">
	<div class="container-fluid">
		<div class="inner-body media_page">
			<!-- Page Header -->
			<div class="page-header">
				<div>
					<h2 class="main-content-title tx-24 mg-b-5"> All Media </h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">All Media</li>
					</ol>
				</div>
				<div class="d-flex">
					<div class="justify-content-center">
						{{-- <a href="/admin/media" class="btn btn-white btn-icon-text my-2 mr-2"> <i class="fe fe-arrow-left mr-2"></i> Photos Listing </a> --}}
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
								<div class="col-sm-6"> <label class="main-content-label mb-2"> Add Media Listing </label> </div>
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
						<hr />
						<div class="card-body pt-0">
							<p style="margin-bottom:10px;"> Upload Photos Here <strong> (Max file Size 1MB) </strong> </p> 
							<!--
							<div class="form-group">
								<form method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
									@csrf
									<input type="hidden" name="proj_id" value="#">   
								</form> 
								<small class="d-block"> *Upload 20 images at a time.</small>
							</div>	
							-->							
							<div class="form-group">
								<div id="dropzone">
									<form method="post" action="media/store" enctype="multipart/form-data" class="dropzone needsclick" id="demo-upload">
										@csrf
										<div class="dz-message needsclick">    
											Drop files here or click to upload.<br />
											<SPAN class="note needsclick">(This is just a demo dropzone. Selected files are <STRONG>not</STRONG> actually uploaded.)</SPAN>
										</div>
									</form>
								</div>  
							</div>
							<div class="form-group submit">
								<a  href='/admin/media' type="button"  id="save_button" class="btn w-100 submit-btn btn-primary" disabled="disabled" > {{ __('Upload') }}</a> 
							</div>   
						</div>
						<div class="row" style="padding:0 20px;">
							<div class="col-md-9 ServerImgScroll">
								<div class="row d-flex ServerImgList">
									@php
										use App\Http\Controllers\CommonController;
										if ($module_name = 'media') {
											$Images = CommonController::ImagesFetch($module_name);
										}
										@endphp
									@foreach ($Images as $image)
											@php
												$extension = pathinfo($image->urls, PATHINFO_EXTENSION);
											@endphp
											@if ($image->urls !== '.' && $image->urls !== '..')
												
												@if($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif" || $extension == "bmp" || $extension == "jfif")
													<div class="col-md-2">
														<div class="card">
														<input type="hidden" value="{{$image->id}}" name="module_id" class="module_id">
														<input type="hidden" value="{{$image->title}}" name="module_title" class="module_title">
														<input type="hidden" value="{{$image->seourl}}" name="module_seourl" class="module_seourl">
														<input type="hidden" value="{{$image->urls}}" name="module_url" class="module_url">
														<input type="hidden" value="{{$image->description}}" name="module_disc" class="module_disc">
															<input type="checkbox" class="image-checkbox" id="checkBox">
															<img src="{{url('img/'.$image->urls)}}"  alt="Uploaded Image" class="img-fluid w-100 h-100" />
														</div>
													</div>
													{{-- <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 mb-10">
														<div class="card"> <img src="{{$image->urls}}" class="img-fluid" /> </div>
													</div>  --}}
												@elseif ($extension == "mp4" || $extension == "webm" || $extension == "ogg" || $extension == "avi" || $extension == "mov")
													<div class="col-md-3">
														<div class="card">
															<input type="hidden" value="{{$image->id}}" name="module_id" class="module_id">
															<input type="hidden" value="{{$image->title}}" name="module_title" class="module_title">
															<input type="hidden" value="{{$image->seourl}}" name="module_seourl" class="module_seourl">
															<input type="hidden" value="{{$image->urls}}" name="module_url" class="module_url">
															<input type="hidden" value="{{$image->description}}" name="module_disc" class="module_disc">
															<input type="checkbox" class="image-checkbox" id="checkBox">
															<video width="100%" height="auto" autoplay loop muted>
																<source src="{{url('img/'.$image->urls)}}" type="video/mp4"> <!-- Adjust type as necessary -->
															</video>
														</div>
													</div>
												@endif
												
											@endif
									@endforeach
									{{-- <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 mb-10">
										<div class="card"> <img src="/admin/img/no_img.jpg" class="img-fluid" /> </div>
									</div>  --}}
								</div>
							</div>
							<div class="col-md-3 media_content ServerImgScroll">
								<form id="module_form">
									<div class="serverimgdetails">
										<p class="mb-0"> <strong> ATTATCHMENT DETAILS </strong> </p>
										<div class="row">
											<div class="col-md-7">
												<ul class="detailsText">
													<li> Name : <span id="fileName"></span> </li>
													<li> Type : <span id="fileType"></span> </li> 
													<li> Size: <span id="fileSize"></span> </li>
													<li> Resolution : <span id="imageResolution"></span> </li>
												</ul>
											</div>
											<div class="col-md-5">
												<div id="selectedImage"> <img src="/admin/img/no_img.jpg" class="img-fluid" /> </div>
											</div>
											<div class="col-md-12">
												<ul class="detailsText"> 
													<li> Uploaded Date : <span id="uploadDate"></span> </li> 
												</ul>
											</div>
										</div> 
										<a href="#" class="delete_perman"> <b class="text-danger" id="deletePermanent">Delete Permanently</b> </a>
									</div>
									<hr>
									<div class="form-group">
										<label for="inputTitle">Title :</label> 
										<input type="hidden" id="dataid" value="">
										<input type="hidden" id="_token" value="{{ csrf_token() }}">
										<input name="page_title" value=""  class="form-control" placeholder="Title..."  type="text" id="inputTitle"> 
									</div>
									<!--
									<div class="form-group">
										<label for="inputUrl">Seo Url :</label> 
										<input name="page_title" value=""  class="form-control" placeholder="SEO URL..."  type="text" id="inputSeoUrl">  
									</div>
									-->
									<div class="form-group">
										<label for="inputUrl">Url :</label> 
										<input name="page_title" value=""  class="form-control" placeholder="IMG URL..."  type="text" id="inputUrl">  
									</div>
									 
									<div class="form-group">
										<label for="inputAlt">Alt :</label>
										<input name="page_title" value=""  class="form-control" placeholder="AlT Tag..."  type="text" id="inputAlt">   
									</div>  

									<div class="form-group">
										<label for="inputDescription">Description :</label>
										<textarea class="form-control" id="inputDescription" name="description" placeholder="Description..." rows="4" cols="40"></textarea>
									</div>

									{{-- <div class="form-group">
										<button type="submit" id="submitModule" class="btn btn-success mx-2 closeModal">Submit</button>
										<button type="button" id="clearForm" class="btn btn-danger closeModal">Clear</button> 
									</div>   --}}
									<div class="form-group row d-flex my-0"> 
										<button type="button" id="submitModule" class="btn btn-success mx-2 closeModal"> Submit </button> 
										<button type="button" id="clearForm" class="btn btn-danger closeModal">Clear</button> 
										<div>
											<img src="/img/loading_2.gif" class="img-fluid" id="loading" width="30px" style="display: none; margin: 0 auto;"/>
										</div>
									</div>
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

@include('admin.layouts.footer')
	
<style>
.dropzone { background:white; border-radius:5px; border:2px dashed rgb(0, 135, 247) !important; border-image:none;  }	
.card { /* border: 1px solid;  */ position: relative; margin-bottom: 20px; border-radius: 0; cursor: pointer !important; }
.image-checkbox { position: absolute; top: -10px; right: -8px; width: 20px; height: 20px; }
.blue-border { padding: 3px; border: 3px solid #0075FF !important; }
</style>
 
@endsection
