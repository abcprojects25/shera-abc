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
						<h2 class="main-content-title tx-24 mg-b-5"> Blog Tags</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Blog Tags</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center"> 
							<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" onclick="addDetails()" data-toggle="modal" data-target="#TagsModal"> <i class="fe fe-folder-plus mr-2"></i> Add New Tags </a> 
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
								<div class="table-responsive">
									<table class="table table-bordered mg-b-0">
										<tr> 
											<th style="width:50px">Id</th>
											<th class="sort" style="width:120px"> Created At </th>
											<th class="sort">Tags</th> 
											<th class="text-center sort" style="width:100px"> Status </th>
											<th> Actions </th>
										</tr> 
										@foreach ($Tags as $k=>$item)
										<tr> 
											<td class="text-center">{{$Tags->firstItem() + $k}} </td>
											<td> {{date('d M Y',strtotime($item->created_at))}}<br> <small class="text-muted">{{date('H:i:A',strtotime($item->created_at))}}</small> </td> 
											<td> {{$item->name}}</td>
											
											@if($item->status == 0)
												<td class="text-center"><a href="blog-tag-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-danger status_inactive" title="Change Status"><i class='fa fa-times'></i></a> </td>
											@else 
												<td class="text-center"><a href="blog-tag-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-primary status-active" title="Change Status"><i class='fa fa-check'></i></a> </td>
											@endif			
											<td class="actions">
												<a href="#" class="btn ripple btn-info" onclick="editDetails('{{$item->id}}','{{$item->name}}','{{$item->status}}')" data-toggle="modal" data-target="#TagsModalEdit"> Edit  </a> 
												<a onclick="return confirm('Are you sure?')" href="blog-tag-delete/{{base64_encode($item->id)}}" class="btn ripple btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
											</td>
										</tr>
										@endforeach
									</table>
									{{$Tags->links()}}
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



<!-- Add Tags -->
<div class="modal fade" id="TagsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title ModalLabel"> Add New Tags </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" id="formAddEdit" class="row justify-content-md-center" action="/admin/blog/tags-add" enctype="multipart/form-data" >	
					<div class="col-xl-12 col-lg-12 col-md-12">
					@csrf		
					<input name="tag_id" type="hidden" id="tag_id" value="0">
						<div class="card shade">
							<div class="form-group">
								<label> Tags Name : <span>*</span></label>
								{{-- <select name="tags[]" id="search_tags" multiple data-role="tagsinput" placeholder="Tags Name..."> 

								</select> --}}
								<input id="search_tags" name="tags" data-role="tagsinput" class="form-control input-sm tagsInput typeahead" type="text" placeholder="Tags type and enter..." value="" required>

							</div>
							<div class="form-group">
								<label>Status </label>
								<select name="is_active" id="is_active" class="custom-select w-100">
									<option value="1">Active</option>
									<option value="0">In Active</option>
								</select>
							</div>
							<div class="submit">
								<input class="btn btn-primary w-100" id="submit" type="submit" value="Add Now">  
							</div> 
						</div> <!-- --> 
					</div> <!-- -->  
				</form>
			</div> 
		</div>
	</div>
</div>

{{-- Edit Tags --}}
<div class="modal fade" id="TagsModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title ModalLabel"> Edit Tags </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" id="formAddEdit" class="row justify-content-md-center" action="/admin/blog/tags-edit" enctype="multipart/form-data" >	
					<div class="col-xl-12 col-lg-12 col-md-12">
					@csrf		
					<input name="tag_id" type="hidden" id="tag_edit_id" value="0">
						<div class="card shade">
							<div class="form-group">
								<label> Tags Name : <span>*</span></label>
								<select name="tags[]" id="search_edit_tags" multiple data-role="tagsinput" placeholder="Tags Name..."> 

								</select>
							</div>
							<div class="form-group">
								<label>Status </label>
								<select name="is_active" id="is_active_edit" class="custom-select w-100">
									<option value="1">Active</option>
									<option value="0">In Active</option>
								</select>
							</div>
							<div class="submit">
								<input class="btn btn-primary w-100" id="submit" type="submit" value="Add Now">  
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
	
	function addDetails(){		
		document.getElementById('tag_id').value = 0;
		document.getElementById('search_tags').value = '';
		document.getElementById('is_active').value = 1;
		document.getElementById('submit').value = 'Add Now';
	}
	function editDetails(id,name,status){

		var select = document.getElementById('search_edit_tags').value = name;

		document.getElementById('tag_edit_id').value = id;
		document.getElementById('is_active_edit').value = status;
		document.getElementById('submit').value = 'Edit Now';
	}

// Tags fatch dynamic
var Tags = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: {
			url: '{{url("tag-fetch")}}',
			filter: function(list) {
			return $.map(list, function(tags) {
				return { name: tags }; });
			}
		}
		});
		Tags.initialize();
		$('#search_tags').tagsinput({
		typeaheadjs: {
			name: 'tags',
			displayKey: 'name',
			valueKey: 'id',
			source: Tags.ttAdapter()
		}
	});

</script>
@endsection
