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
						<h2 class="main-content-title tx-24 mg-b-5"> Our MileStone </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Our MileStone Pages</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							<a href="/admin/about/our-milestone-add" class="btn btn-white btn-icon-text my-2 mr-2"><i class="fe fe-folder-plus mr-2"></i> Add New MileStone </a>
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
													<th class="sort">Title</th>  
													<th class="sort">Sub Title</th>  
													<th class="sort">Timeline Year</th>  
													<th class="sort">Timeline Title</th>
													<th class="sort">Timeline Text</th>
													<th class="sort">Background Img</th>
													<th class="text-center sort" style="width:100px"> Status </th>
													<th> Actions </th>
												</tr> 
											</thead>
												<tbody>
												@foreach ($OurMilestones as $k=>$item)
												<tr class="tableRow" data-id="{{ $item->id }}">
													<td class="text-center">{{$k+1}} </td>
													<td> {{date('Y-M-d',strtotime($item->created_at))}}<br/> <small class="text-muted">{{date('H:i a',strtotime($item->created_at))}}</small></td>
													<td style="white-space: normal !important; word-wrap: break-word;"> {{$item->title}} </td>	
													<td style="white-space: normal !important; word-wrap: break-word;"> {{$item->sub_title}} </td>	
													<td style="white-space: normal !important; word-wrap: break-word;"> {{$item->timeline_year}} </td>	
													<td style="white-space: normal !important; word-wrap: break-word;"> {{$item->timeline_title}} </td>	
													<td style="white-space: normal !important; word-wrap: break-word;"> {{$item->timeline_text}} </td>
													@if (!empty($item->image_url))
													<td><img src="{{$item->image_url}}" width="100px" height="80px" class="img-fluid" /></td>
													@else
													<td><img src="/admin/img/no_img_xl.jpg" class="img-fluid" /></td>
													@endif

													<td class="text-center">
														@if($item->status == 0) 
														<a  href="/admin/about/our-milestone-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-danger status_inactive" title="Change Status"><i class='fa fa-times'></i></a> </td>
														@else 
														<a  href="/admin/about/our-milestone-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-primary status-active" title="Change Status"><i class='fa fa-check'></i></a> </td>
														@endif
													</td>
													<td class="actions">
														<a href="/admin/about/our-milestone-edit/{{base64_encode($item->id)}}" class="btn ripple btn-info"> Edit </a>
														<a onclick="return confirm('Are you sure?')" href="/admin/about/our-milestone-delete/{{base64_encode($item->id)}}" class="btn ripple btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i>  </a>
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
