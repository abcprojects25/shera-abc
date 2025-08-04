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
						<h2 class="main-content-title tx-24 mg-b-5"> CMS Pages </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">CMS Pages</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
						<!--	<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#exampleModal"> <i class="fe fe-folder-plus mr-2"></i> Add New Categories </a>-->
							<a href="/admin/cms/cms-add" class="btn btn-white btn-icon-text my-2 mr-2"> 
								<i class="fe fe-folder-plus mr-2"></i> Add New Page </a>
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
											<li class="all"><a href="#" class="current" aria-current="page">All <span class="count">({{$count}})</span></a> </li>
											<li class="publish"><a href="#">Active <span class="count">({{$activecount}})</span></a> </li>
											<li class="draft"><a href="#">InActive <span class="count">({{$incativecount}})</span></a> </li>
										</ul>
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
									
										<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered mg-b-0" id="data-table">
											<thead>
											<tr>
												<th style="width:50px">Id</th>
												<th class="sort" style="width:120px"> Created At </th>
												<th class="sort">Categories</th>  
												<th class="sort">Page Title</th>  
												<th> Page Url </th>  
												<th class="text-center sort" style="width:100px"> Status </th>
												<th> Actions </th>
											</tr>
											</thead>
										{{-- <tbody id="changeTableDate"> --}}
											<tbody>
												@foreach ($Cmspages_list as $k=>$item)
													<tr class="tableRow" data-id="{{ $item->id }}"> 
														<td class="text-center">{{$k+1}} </td>
														<td> {{date('Y-m-d',strtotime($item->created_at))}}<br/> <small class="text-muted">{{date('H:i a',strtotime($item->created_at))}}</small> </td>
														@php
															$category = CommonController::FetchOneCategory($item->category_id);
														@endphp
														<td> {{$category}} </td>
														<td style="white-space: normal !important; word-wrap: break-word;"> {{$item->page_title}} </td>
														<td> <a href="{{$item->page_url}}" target="_blank"> {{$item->page_url}} </a> </td> 
														<td class="text-center">
															@if($item->status == 0) 
															<a  href="/admin/cms/status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-danger status_inactive" title="Change Status"><i class='fa fa-times'></i></a> </td>
															@else 
															<a  href="/admin/cms/status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-primary status-active" title="Change Status"><i class='fa fa-check'></i></a> </td>
															@endif
														</td>
														<td class="actions">
															<a href="/admin/cms/cms-edit/{{base64_encode($item->id)}}" class="btn ripple btn-info"> Edit  </a>
															{{-- <a href="/admin/cms/cms-view/{{base64_encode($item->id)}}" class="btn ripple btn-info"> View </a> --}}
															<a onclick="return confirm('Are you sure?')" href="/admin/cms/cms-delete/{{base64_encode($item->id)}}" class="btn ripple btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
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

<script type="text/javascript">
	/*$(function () {

		$("#data-table").DataTable();

		$("#changeTableDate").sortable({
			items: "tr",
			cursor: 'move',
			opacity: 0.6,
			update: function() {
				sendOrderToServer();
			}
		});

		function sendOrderToServer() {
			var order = [];
			console.log(order);
			$('tr.tableRow').each(function(index,element) {
				order.push({
					id: $(this).attr('data-id'),
					position: index+1
				});
			});

			$.ajax({
				type: "POST",
				dataType: "json",
				url: "/admin/cms/cms-sort",
					data: {
					order: order,
					_token: "{{csrf_token()}}"
				},
				success: function(response) {
					if (response.status == "success") {
						console.log(response);
					} else {
						console.log(response);
					}
				}
			});
		}
	});*/
</script>


@endsection
