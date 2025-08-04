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
						<h2 class="main-content-title tx-24 mg-b-5"> Projects </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Projects</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#exampleModal"> <i class="fe fe-folder-plus mr-2"></i> Add New Categories </a>
							<a href="/admin/project/project-add" class="btn btn-white btn-icon-text my-2 mr-2"> <i class="fe fe-folder-plus mr-2"></i> Add New Page </a> 
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
								<div class="row">
									<div class="col-md-6 col-sm-6">
										 
									</div>
									{{-- <div class="col-md-6 col-sm-6">
										<nav aria-label="Page navigation example">
										  <ul class="pagination justify-content-end mt-0 mb-0">
											<li class="page-item">
											  <a class="page-link" href="#" aria-label="Previous">
												<span aria-hidden="true">&laquo;</span>
												<span class="sr-only">Previous</span>
											  </a>
											</li>
											<li class="page-item active"><a class="page-link" href="#">1</a></li>
											<li class="page-item"><a class="page-link" href="#">2</a></li>
											<li class="page-item"><a class="page-link" href="#">3</a></li>
											<li class="page-item"> <a class="page-link" href="#" aria-label="Next">
												<span aria-hidden="true">&raquo;</span>
												<span class="sr-only">Next</span>
											  </a>
											</li>
										  </ul>
										</nav>
									</div> --}}
								</div>
								<hr /> 

								<div class="table-responsive">
									<table class="table table-bordered mg-b-0">
										<tr> 
											<th style="width:50px">Id</th>
											<th> Category </th>
											<th> Title </th>  
											<th style="width:150px"> Photo </th>   
											<th> Url </th>
											<th> Description </th>
											<th class="text-center" style="width:60px"> Status </th>
											<th class="sort" style="width:120px"> Created At </th> 
											<th> Actions </th>
										</tr> 

										@foreach ($data as $k=>$item)
										<tr> 
											<td class="text-center">{{$k + 1}}</td>
											@php
												$result = CommonController::FetchOneCategory($item->category_id);
											@endphp
											<td> {{$result->name}} </td>
											<td> {{$item->title}} </td>
											@if (!empty($item->image))
											<td><img src="{{$item->image}}" class="img-fluid" /></td>
											@else
											<td><img src="/admin/img/no_img_xl.jpg" class="img-fluid" /></td>
											@endif										
											<td><a href="/project-view/{{$item->url}}"> {{$item->url}}</a>  </td>
											<td> {{$item->description}}  </td>
											@if($item->status == 0) 
											<td><a  href="project-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-danger status_inactive" title="Change Status"><i class='fa fa-times'></i></a> </td>
											@else 
											<td> <a  href="project-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-primary status-active" title="Change Status"><i class='fa fa-check'></i></a> </td>
											@endif
											
											<td> {{date('d M Y',strtotime($item->created_at))}}<br> <small class="text-muted">{{date('H:i:A',strtotime($item->created_at))}}</small> </td> 
											<td class="actions">
												<a href="#" class="btn ripple btn-info" data-toggle="modal" data-target="#exampleModal"> Edit Thumbnail </a>
												<a href="/admin/project/project-edit/{{base64_encode($item->id)}}" class="btn ripple btn-info"> Edit </a>
												<a href="/admin/project/project-view" class="btn ripple btn-warning"> View </a> 
												<a onclick="return confirm('Are you sure?')" href="/admin/project/delete-project/{{base64_encode($item->id)}}" class="btn ripple btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i>  </a>
												<a href="#" data-id="{{$item->id}}" id="AddImage" data-toggle="modal" data-target="#ServerImageModal" class="btn ripple btn-primary"> Add Images </a> 
												
											</td>
										</tr> 
										@endforeach
										{{ $data->links() }}
										
									</table>
								</div>
								{{-- <div class="">
									<nav aria-label="Page navigation example">
									  <ul class="pagination justify-content-end mb-0">
										<li class="page-item">
										  <a class="page-link" href="#" aria-label="Previous">
											<span aria-hidden="true">&laquo;</span>
											<span class="sr-only">Previous</span>
										  </a>
										</li>
										<li class="page-item active"><a class="page-link" href="#">1</a></li>
										<li class="page-item"><a class="page-link" href="#">2</a></li>
										<li class="page-item"><a class="page-link" href="#">3</a></li>
										<li class="page-item">
										  <a class="page-link" href="#" aria-label="Next">
											<span aria-hidden="true">&raquo;</span>
											<span class="sr-only">Next</span>
										  </a>
										</li>
									  </ul>
									</nav>
								</div> --}}
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


<!-- Add Data -->
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
				<form method="POST" class="row justify-content-md-center" action="/admin/project/category-add" enctype="multipart/form-data" >	
					<div class="col-xl-12 col-lg-12 col-md-12">
					@csrf									
						<div class="card shade">
							<div class="form-group">
								<label> Category Name : <span>*</span></label>
								<input name="type" value="2" type="hidden"/>
								<input name="category_name" value=""  class="form-control" data-role="tagsinput" placeholder="Category Name..." maxlength="255" type="text" id="category_name">							
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


@include('admin.layouts.footer')
<script>
$(document).ready(function(){
	$("#AddImage").on('click', function() {
        //  $(this).data('data-id');
		// var AddImage = $(this).attr("data-id");
		console.log('AddImage');
    });
});

</script>

<link href="/admin/css/tagsinput.css" rel="stylesheet" type="text/css">
<script src="/admin/js/typeahead.bundle.min.js"></script> 
<script src="/admin/js/tagsinput.js"></script>
 

<script>
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

		$('#category_name').tagsinput({
		typeaheadjs: {
			name: 'categoryname',
			displayKey: 'name',
			valueKey: 'name',
			source: Categories.ttAdapter()
		}
	});

// ------------------------------
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


@endsection
