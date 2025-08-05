	<!-- Server Images -->
	<div class="modal fade" id="ServerImageModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> 
		<div class="modal-dialog modal-xxl modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"> Featured image</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body"> 
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Upload</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Images </button>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="card-body">  
								<div class="form-group">
									<div id="dropzone">
										@php
											$module_name = request()->segment(2);
											$url_name = request()->segment(3);
										@endphp
										<form method="post" action="/admin/{{$module_name}}/store" enctype="multipart/form-data" class="dropzone needsclick" id="demo-upload">
											@csrf
											<input type="hidden" value="0" name="parent_id" id="parent_id">
											<div class="dz-message needsclick">    
												Drop files here or click to upload. <br />
												<span class="btn border"> Select File </span> <br />
												<SPAN class="note needsclick">Maximum file Size 10MB</SPAN>
											</div>
										</form>
									</div>  
								</div>
								<div class="form-group submit">
									<a  href='/admin/{{$module_name}}/{{$url_name}}' id="save_button" class="btn btn-sm btn-primary" disabled="disabled" > {{ __('Upload') }}</a> 
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<div class=" ">
								<div class="row">
									<div class="col-md-9 ServerImgScroll">
										<div class="row d-flex ServerImgList">									
											@php
											
										
												use App\Http\Controllers\CommonController;
												
												if (isset($module_name)) {
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
																<input type="hidden" value="{{$image->alt}}" name="module_alt" class="module_alt">
																<input type="hidden" value="{{$image->urls}}" name="module_url" class="module_url">
																<input type="hidden" value="{{$image->description}}" name="module_disc" class="module_disc">
																	<input type="checkbox" class="image-checkbox" id="checkBox">
																	<img src="{{$image->urls}}"  alt="Uploaded Image" class="img-fluid w-100 h-100" />
																</div>
															</div>
															<!-- {{-- <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 mb-10">
																<div class="card"> <img src="{{$image->urls}}" class="img-fluid" /> </div>
															</div>  --}} -->
														@elseif ($extension == "mp4" || $extension == "webm" || $extension == "ogg" || $extension == "avi" || $extension == "mov")
															<div class="col-md-3">
																<div class="card">
																	<input type="hidden" value="{{$image->id}}" name="module_id" class="module_id">
																	<input type="hidden" value="{{$image->title}}" name="module_title" class="module_title">
																	<input type="hidden" value="{{$image->alet}}" name="module_alt" class="module_alt">
																	<input type="hidden" value="{{$image->urls}}" name="module_url" class="module_url">
																	<input type="hidden" value="{{$image->description}}" name="module_disc" class="module_disc">
																	<input type="checkbox" class="image-checkbox" id="checkBox">
																	<video width="100%" height="auto" autoplay loop muted>
																		<source src="{{$image->urls}}" type="video/mp4"> <!-- Adjust type as necessary -->
																	</video>
																</div>
															</div>
														@endif
														
													@endif
											@endforeach
											
										</div>
									</div>
									<div class="col-md-3 media_content ServerImgScroll">
										<form id="module_form">
											<div class="serverimgdetails">
												<p class="mb-0"> <strong> ATTATCHMENT DETAILS </strong> </p>
												<div class="row">
													<div class="col-md-8">
														<ul class="detailsText">
															<li> Name : <span id="fileName"></span> </li>
															<li> Type : <span id="fileType"></span> </li> 
															<li> Size: <span id="fileSize"></span> </li>
															<li> Resolution : <span id="imageResolution"></span> </li>
														</ul>
													</div>
													<div class="col-md-4">
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
												<input type="hidden" id="module_name" value="{{$module_name}}">

												
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
												<input name="inputAlt" value=""  class="form-control" placeholder="AlT Tag..."  type="text" id="inputAlt">   
											</div> 

											<div class="form-group">
												<label for="inputDescription">Description :</label>
												<textarea class="form-control" id="inputDescription" name="description" placeholder="Description..." rows="4" cols="40"></textarea>
											</div>

											<!-- {{-- <div class="form-group">
												<button type="submit" id="submitModule" class="btn btn-success mx-2 closeModal">Submit</button>
												<button type="button" id="clearForm" class="btn btn-danger closeModal">Clear</button> 
											</div>   --}} -->
											<div class="form-group row d-flex my-0">
												<div>
													<button type="button" id="submitModule" class="btn btn-success mx-2 closeModal"> Submit </button>
												</div>
												<div>
													<button type="button" id="clearForm" class="btn btn-danger closeModal">Clear</button>
												</div>
												<div>
													<img src="/img/loading_2.gif" class="img-fluid" id="loading" width="30px" style="display: none; margin: 0 auto;"/>
												</div>
											</div>
										</form>
									</div> 
								</div> 
							</div> 
						</div> 
					</div>
				</div>  
				
			</div>
		</div>
	</div>

<script>
	function GetParentId(parent_id){
		document.getElementById('parent_id').value = parent_id;
		document.getElementById('pid').innerText = parent_id;
	}
</script>
<!-- Dropzone -->	
<link rel="stylesheet" href="/admin/css/dropzone.min.css">
<script type="text/javascript" src="/admin/js/dropzone.js"></script>
<style>
.card {
/* border: 1px solid;  */
position: relative; margin: 20px 0; border-radius: 0; cursor: pointer !important; }
.image-checkbox { position: absolute; top: -10px; right: -8px; width: 20px; height: 20px; }
.blue-border { padding: 3px; border: 3px solid #0075FF !important; }
</style>

<script type="text/javascript">
var dropzone = new Dropzone('#demo-upload', {
  previewTemplate: document.querySelector('#preview-template').innerHTML,
  maxFilesize: 209715200,
  timeout: 180000,
  parallelUploads: 2,
  thumbnailHeight: 120,
  thumbnailWidth: 120, 
  maxFilesize: 256,
  filesizeBase: 1000,
  thumbnail: function(file, dataUrl) {
    if (file.previewElement) {
      file.previewElement.classList.remove("dz-file-preview");
      var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
      for (var i = 0; i < images.length; i++) {
        var thumbnailElement = images[i];
        thumbnailElement.alt = file.name;
        thumbnailElement.src = dataUrl;
      }
      setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
    }
  }

});

// Now fake the file upload, since GitHub does not handle file uploads
// and returns a 404
var minSteps = 6,
    maxSteps = 60,
    timeBetweenSteps = 100,
    bytesPerStep = 100000;

dropzone.uploadFiles = function(files) {
  var self = this;

  for (var i = 0; i < files.length; i++) {

    var file = files[i];
    totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

    for (var step = 0; step < totalSteps; step++) {
      var duration = timeBetweenSteps * (step + 1);
      setTimeout(function(file, totalSteps, step) {
        return function() {
          file.upload = {
            progress: 100 * (step + 1) / totalSteps,
            total: file.size,
            bytesSent: (step + 1) * file.size / totalSteps
          };

          self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
          if (file.upload.progress == 100) {
            file.status = Dropzone.SUCCESS;
            self.emit("success", file, 'success', null);
            self.emit("complete", file);
            self.processQueue();
            document.getElementsByClassName("dz-success-mark").style.opacity = "1";
          }
        };
      }(file, totalSteps, step), duration);
    }
  }
}

</script>