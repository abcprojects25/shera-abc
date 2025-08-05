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
						<h2 class="main-content-title tx-24 mg-b-5"> Events Gallery </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Events Gallery Pages</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							
							<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#eventModel"> <i class="fe fe-folder-plus mr-2"></i> Add Event </a>
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
								<hr /> 

								<div class="table-responsive">
										<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered mg-b-0" id="data-table">
											<thead>
												<tr> 
													<th style="width:50px">Id</th>
													<th class="sort" style="width:120px"> Created At </th> 
													<th class="sort">Event Name</th>  
													<th class="text-center sort" style="width:100px"> Status </th>
													<th> Actions </th>
												</tr> 
											</thead>
											<tbody>
												@foreach ($Events as $k=>$item)
												<tr class="tableRow" data-id="{{ $item->id }}">
													<td class="text-center">{{$k+1}} </td>
													<td> {{date('Y-M-d',strtotime($item->created_at))}}<br/> <small class="text-muted">{{date('H:i a',strtotime($item->created_at))}}</small></td>
													<td style="white-space: normal !important; word-wrap: break-word;"> {{$item->name}} </td>													
													<td class="text-center">
														@if($item->status == 0) 
														<a  href="/admin/about/event-gallery-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-danger status_inactive" title="Change Status"><i class='fa fa-times'></i></a> </td>
														@else 
														<a  href="/admin/about/event-gallery-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-primary status-active" title="Change Status"><i class='fa fa-check'></i></a> </td>
														@endif
													</td>
													<td class="actions">
														{{-- <a href="#" class="btn ripple btn-info" data-toggle="modal" data-target="#exampleModal"> Edit Thumbnail </a> --}}
														<a href="#" onclick="edit_event('{{$item->id}}', '{{$item->name}}', '{{$item->status}}')" data-toggle="modal" data-target="#EditEventModel" class="btn ripple btn-info"> Edit </a>
														<a onclick="return confirm('Are you sure?')" href="/admin/about/event-gallery-delete/{{base64_encode($item->id)}}" class="btn ripple btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i>  </a>
														<!-- <a href="#" onclick="GetEventParentId({{$item->id}})" data-toggle="modal" data-target="#EventImageModal" class="btn ripple btn-primary"> Add Images </a>  -->
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

<!-- Add Categories -->
<div class="modal fade" id="eventModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Add Event </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" class="row justify-content-md-center" action="/admin/about/event-gallery-store" enctype="multipart/form-data" >	
					<div class="col-xl-12 col-lg-12 col-md-12">
					@csrf									
						<div class="card shade">
							<div class="form-group">
								<label> Event Name : <span>*</span></label>
								<input name="event_name" value=""  class="form-control" placeholder="Event Name..." maxlength="255" type="text" id="event_name">
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

<!-- Edit Categories -->
<div class="modal fade" id="EditEventModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Edit Event </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" class="row justify-content-md-center" action="/admin/about/event-gallery-update">	
					<div class="col-xl-12 col-lg-12 col-md-12">
					@csrf									
						<div class="card shade">
							<div class="form-group">
								<label> Event Name : <span>*</span></label>
								<input name="edit_id" id="edit_id" value="0" type="hidden"/>
								<input name="event_name" value=""  class="form-control" placeholder="Event Name..." maxlength="255" type="text" id="edit_event_name">
							</div>
							<div class="form-group">
								<label>Status </label>
								<select name="is_active" id="is_active_edit" class="custom-select w-100">
									<option value="1">Active</option>
									<option value="0">In Active</option>
								</select>
							</div>
							<div class="submit">
								<input class="btn btn-primary w-100" type="submit" value="Edit Now">  
							</div> 
						</div> <!-- --> 
					</div> <!-- -->  
				</form>
			</div> 
		</div>
	</div>
</div>

<script>
function edit_event(id, name, status){
	document.getElementById("edit_id").value = id;
	document.getElementById("edit_event_name").value = name;
	document.getElementById("is_active_edit").value = status;

 }
</script>

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

@endsection
