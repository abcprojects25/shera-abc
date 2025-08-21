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
						<h2 class="main-content-title tx-24 mg-b-5"> All Projects </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Projects</a></li>
							<li class="breadcrumb-item active" aria-current="page">Project Listing</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							<!-- <a href="/admin/project/home-project-listing" class="btn btn-white btn-icon-text my-2 mr-2"> <i class="fe fe-folder-plus mr-2"></i> Home Project Listing </a>  -->
							<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#exampleModal"> <i class="fe fe-folder-plus mr-2"></i> Add New Categories </a>
							<a href="/admin/project/project-add" class="btn btn-white btn-icon-text my-2 mr-2"> <i class="fe fe-folder-plus mr-2"></i> Add New Project </a> 
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
										<ul class="subsubsub mb-0">
											{{-- <li class="all"><a href="#" class="current" aria-current="page">All <span class="count">({{$count}})</span></a> </li>
											<li class="publish"><a href="#">Active <span class="count">({{$activecount}})</span></a> </li>
											<li class="draft"><a href="#">InActive <span class="count">({{$incativecount}})</span></a> </li> --}}
										</ul>
									</div>
									
								</div> 
								
								<a href="#" class="btn ripple btn-info" data-toggle="modal" data-target="#sortingModal"> Sorting </a>

								<div class="table-responsive">
										<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered mg-b-0" id="data-table">
											<thead>
												<tr> 
													<th style="width:30px">Id</th>
													<th> Category </th>
													<th> Title, URL & Created At </th>  
													<th style="width:150px"> Banner </th>    
													<th class="text-center" style="width:60px"> Images </th>
													<th class="text-center" style="width:60px"> Status </th>
													<!-- <th class="text-center" style="width:50px"> Home Status </th>  -->
													<th> Actions </th>
												</tr>
											</thead>
											<tbody>
												@foreach ($data as $k=>$item)
												<tr> 
													<td class="text-center">{{$k + 1}}</td>
													@php
														$category = CommonController::FetchOneCategory($item->category_id);
													@endphp
													<td> {{$category}} </td>
													<td>
														{{$item->title}} <br />
														<a href="/project-view/{{$item->url}}" target="_blank" style="display:block; margin:8px 0;"> {{$item->url}}</a> 
														{{date('Y-m-d',strtotime($item->created_at))}} - <small class="text-muted">{{date('H:i a',strtotime($item->created_at))}}</small>
														
													</td>
													@if (!empty($item->banner_image))
													<td><img src="{{$item->banner_image}}" class="img-fluid" width="80px" /></td>
													@else
													<td><img src="/admin/img/no_img_xl.jpg" class="img-fluid" /></td>
													@endif	
													<!-- Add Images Button -->
														<td class="text-center">
															@php
																$projectImages = \App\Models\admin\ProjectImages::where('project_id', $item->id)->get();
															@endphp
															@if($projectImages->isNotEmpty())
																<ul class="list-unstyled mb-2" style="max-height: 120px; overflow-y: auto;">
																	@foreach($projectImages as $img)
																		<li class="badge badge-info mb-1">
																			{{ basename($img->urls) }}
																		</li>
																	@endforeach
																</ul>
															@else
																<span class="text-muted d-block"></span>
															@endif
															<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addProjectImageModal" data-project="{{ $item->id }}">
																Add Images
															</button>
														</td>	 
													@if($item->status == 0) 
													<td class="text-center"><a  href="project-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-danger status_inactive" title="Change Status"><i class='fa fa-times'></i></a> </td>
													@else 
													<td class="text-center"> <a  href="project-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-primary status-active" title="Change Status"><i class='fa fa-check'></i></a> </td>
													@endif

													
													 
													<td class="actions">
														{{-- <a href="#" class="btn ripple btn-info" data-toggle="modal" data-target="#exampleModal"> Edit Thumbnail </a> --}}
														<a href="/admin/project/project-edit/{{base64_encode($item->id)}}" class="btn ripple btn-info"> Edit </a>
														<a href="/project-view/{{$item->url}}" class="btn ripple btn-warning" target="_blank"> View </a> 
														<a onclick="return confirm('Are you sure?')" href="/admin/project/delete-project/{{base64_encode($item->id)}}" class="btn ripple btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i>  </a>
														<!-- <a href="#" onclick="GetParentId({{$item->id}})" id="AddImage" data-toggle="modal" data-target="#ServerImageModal" class="btn ripple btn-primary"> Add Images </a>  -->
													</td>
												</tr> 
												@endforeach
											</tbody>	
										</table>
  
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


<!-- Add Category Image Modal -->
<div class="modal fade" id="addProjectImageModal" tabindex="-1" role="dialog" aria-labelledby="addProjectImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="projectImageForm" action="{{ route('admin.project.images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="project_id" id="modal_project_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Project Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div id="image-upload-group">
                        <div class="row mb-3 image-group">
                            <div class="col-md-6">
                                <input type="file" name="images[]" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="alt[]" class="form-control" placeholder="Alt text (optional)">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary" id="addMoreImages">+ Add More</button>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Images</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('#addProjectImageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var projectId = button.data('project');
        $('#modal_project_id').val(projectId);
    });

    // Add more image+alt input fields
    $('#addMoreImages').click(function () {
        $('#image-upload-group').append(`
            <div class="row mb-3 image-group">
                <div class="col-md-6">
                    <input type="file" name="images[]" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="alt[]" class="form-control" placeholder="Alt text (optional)">
                </div>
            </div>
        `);
    });
</script>
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
								<input name="category_name" value=""  class="form-control" data-role="tagsinput" placeholder="Category type and enter..." maxlength="255" type="text" id="category_name" required>							
							</div>
							<div class="form-group">
								<label> Category Description :</label>
								<input name="category_description" value="" class="form-control" placeholder="Category Description..." type="text" id="category_disc">							
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
<!-- Sorting Data -->
<div class="modal fade" id="sortingModal" tabindex="-1" aria-labelledby="sortingModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="sortingModalLabel">Sorting Table Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<ul id="changeTableDate">
					@foreach ($data as $k=>$item)
					<li class="p-2 tableRow" data-id="{{ $item->id }}">
						<p>
							<span> {{$item->project_order}} </span>
							<img src="{{($item->image != null) ? $item->image : '<img src="/admin/img/no_img_xl.jpg" />'}}" width="30px" />
							<small> {{$item->title}} </small> 
						</p>
					</li>
					@endforeach
				</ul>
				<div class="modal-footer">
					<input type='button' class="btn btn-info btn-submit" value='Reload' id='reload' />
				</div>
			</div> 
		</div>
	</div>
</div>


@include('admin.layouts.footer')
 
<script>
function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#blah').attr('src', e.target.result);
			document.getElementById("cober_iamge_data").value =e.target.result;
		};
		reader.readAsDataURL(input.files[0]);
	}
}

$(document).ready(function() {
  var table = $("#data-table").DataTable({
    bSort: true,
    bFilter: true,
	stateSave: true,
    iDisplayStart: 0,
    iDisplayLength: 10,
    sPaginationType: "full_numbers",
    sDom: "Rfrtlip",
	"lengthChange": false
  });

  $('#cmsearch').on('keyup', function() {
    table.search(this.value).draw();
  });
});

</script>
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
<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>
<script type="text/javascript">
	$(document).ready(function () {
		var dropIndex;
		$("#changeTableDate").sortable({
				update: function(event, ui) { 
					dropIndex = ui.item.index();
			}
		});

		$('#reload').click(function (e) {
			var projectIdsArray = [];
			$('.tableRow').each(function (index) {
					var dataid = $(this).attr('data-id');
					projectIdsArray.push(dataid);
			});

			$.ajax({
				type: "POST",
				dataType: "json",
				url: "/admin/project/project-sort",
					data: {
					order: projectIdsArray,
					_token: "{{csrf_token()}}"
				},
				success: function(response) {
					if (response.status == "success") {
						console.log(response.message);
						location.reload();
					} else {
						console.log(response.message);
					}
				}
			});
		});
	});

</script>
@endsection
