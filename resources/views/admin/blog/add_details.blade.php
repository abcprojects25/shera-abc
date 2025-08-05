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
						<h2 class="main-content-title tx-24 mg-b-5"> Add Project </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Project Listing</a></li>
							<li class="breadcrumb-item active" aria-current="page">Add Project</li>
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
									<form method="POST" class="row justify-content-md-center" action="/admin/cms/add" 
									enctype="multipart/form-data" >	
										<div class="col-xl-9 col-lg-9 col-md-9">
										@csrf									
											<div class="card shade">
												<div class="row"> 
													<div class="col-lg-6 col-md-7 form-group">
														<label>Project Title : <span>*</span></label>
														<input name="page_title" value="Project Title"  class="form-control" placeholder="Project Title..." maxlength="255" type="text" id="title">
													</div>
													<div class="col-lg-3 col-md-3 form-group">
														<label>Client Name:</label>
														<input name="client" value=""  class="form-control" placeholder="Client..." maxlength="255" type="text" id="client">
													</div>
													<div class="col-lg-3 col-md-3 form-group">
														<label>Project's Year:</label>
														<input name="Year" value=""  class="form-control" placeholder="Project's Year..." maxlength="255" type="number" id="Year">
													</div>
												</div>
												<div class="form-group" id="parallax-banner">
													<label> Parallax Banner </label> <br />
													<input type="file" accept="image/*" id="choose-file" name="choose-file" />
													<label for="choose-file">Choose Banner</label>
													<div id="img-preview"></div>
												</div> 
												<div class="form-group">
													<label>1st Heading</label>
													<input name="heading" value="" class="form-control" placeholder="1st Heading..." maxlength="255" type="text" id="heading"> 
												</div> 
												<div class="form-group">
													<label for="BookDescription"> 1st Section Description </label>
													<textarea name="description" class="form-control content" cols="10" rows="2" id="description" placeholder="Description..."> </textarea> 
												</div> 
												<div class="form-group"> 
													<label> Development Category</label>
													<input type="text" data-role="tagsinput" value="Brand Development, UX/UI Design, Front-End Development,  UX/UI Design, Front-End Development, SVG Animations, Laravel Development">
												</div> 
												<div class="form-group">
													<label>Development Technology</label>
													<select multiple data-role="tagsinput" >
														<option value="Adobe XD">Adobe XD</option>
														<option value="Adobe Illustrator">Adobe Illustrator</option>
														<option value="HTML5">HTML5</option>
														<option value="CSS">CSS</option>
														<option value="Bootstrap">Bootstrap</option>
														<option value="jQuery">jQuery</option>
														<option value="Laravel">Laravel</option>
														<option value="Ajax">Ajax</option>
														<option value="SVG">SVG</option>
														<option value="AWS">AWS</option>
													</select>
												</div> 
												<div class="form-group" id="choose-vdothumbnail">
													<label> Choose - Video </label> <br />
													<div class="relative">
														<input id="file-input" type="file" accept="video/*" name="choose-video" />
														<label for="choose-video">Choose Video </label>
													</div>
													<video id="video" mute></video>
												</div> 
												<div class="form-group">
													<label>2nd Heading</label>
													<input name="heading" value="" class="form-control" placeholder="1st Heading..." maxlength="255" type="text" id="heading"> 
												</div> 
												<div class="form-group">
													<label for="BookDescription"> 2nd Section Description </label>
													<textarea name="description" class="form-control content1" cols="10" rows="2" id="description" placeholder="Description..."> </textarea> 
												</div> 
												 
												<div class="form-group">
													<label for="BookDescription"> Horizontal image Gallery </label>
													<div>
														<label for="files">Select multiple files: </label>
														<input type="file" id="files" class="form-control d-block" name="files[]" multiple /> 
													</div> 
												</div> 
												 
												<div class="form-group">
													<label for="BookDescription"> Vertical image Gallery </label> <br />
													<div>
														<label for="verfiles">Select multiple files: </label>
														<input id="verfiles" class="form-control d-block" type="file" multiple/>        
													</div>
													<div>   <div id="sortableImgThumbnailPreview">  </div>  </div>
												</div> 
												 
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
 
@include('admin.layouts.footer')


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

<script>
const input = document.getElementById('file-input');
const video = document.getElementById('video');
const videoSource = document.createElement('source');

input.addEventListener('change', function() {
  const files = this.files || [];

  if (!files.length) return;
  
  const reader = new FileReader();

  reader.onload = function (e) {
    videoSource.setAttribute('src', e.target.result);
    video.appendChild(videoSource);
	$('#video').addClass('hklhk');
    video.load();
    video.play();
  };
  
  reader.onprogress = function (e) {
    console.log('progress: ', Math.round((e.loaded * 100) / e.total));
  };
  
  reader.readAsDataURL(files[0]);
});
</script>


<link href="/admin/css/richtext.min.css" rel="stylesheet">
<script src="/admin/js/jquery.richtext.js"></script>
<script>
	$(document).ready(function() {
		$('.content').richText();
		$('.content1').richText();
		$('form textarea').attr('required', '');
	});
</script>

<!-- Multiple Photo  -->
<script>
	$(document).ready(function() {
	  if (window.File && window.FileList && window.FileReader) {
		$("#files").on("change", function(e) {
		  var files = e.target.files,
			filesLength = files.length;
		  for (var i = 0; i < filesLength; i++) {
			var f = files[i]
			var fileReader = new FileReader();
			fileReader.onload = (function(e) {
			  var file = e.target;
			  $("<span class=\"pip\">" +
				"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
				"<br/><span class=\"remove\">Remove</span>" +
				"</span>").insertAfter("#files");
			  $(".remove").click(function(){
				$(this).parent(".pip").remove();
			  }); 
			  
			});
			fileReader.readAsDataURL(f);
		  }
		  console.log(files);
		});
	  } else {
		alert("Your browser doesn't support to File API")
	  }
	});
</script>

<script>

document.getElementById('verfiles').addEventListener('change', handleFileSelect, false);

  function handleFileSelect(evt) {
    
    var files = evt.target.files; 
    var output = document.getElementById("sortableImgThumbnailPreview");
    
    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
           var imgThumbnailElem = "<div class='RearangeBox imgThumbContainer'><div class='IMGthumbnail' ><img  src='" + e.target.result + "'" + "title='"+ theFile.name + "'/></div><i class='material-icons imgRemoveBtn' onclick='removeThumbnailIMG(this)'>Remove</i></div>";
           output.innerHTML = output.innerHTML + imgThumbnailElem;          
        };
      })(f);
      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  function removeThumbnailIMG(elm){
    elm.parentNode.outerHTML='';
  }
</script>
 


@endsection
