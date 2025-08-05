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
						<h2 class="main-content-title tx-24 mg-b-5"> Blog Sub Categories </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Blog Sub Categories</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center"> 
							<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#subcategoriesaddmodal"> <i class="fe fe-folder-plus mr-2"></i> Add New Sub Categories </a> 
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
											<th class="sort">Categories</th> 
											<th class="text-center sort" style="width:100px"> Status </th>
											<th> Actions </th>
										</tr> 
										@foreach ($Subcategories as $k=>$item)
										<tr> 
											<td class="text-center">{{$k +1}} </td>
											<td> {{date('d M Y',strtotime($item->created_at))}}<br> <small class="text-muted">{{date('H:i:A',strtotime($item->created_at))}}</small> </td> 
											<td> {{$item->name}}</td>
											
											@if($item->status == 0)
												<td class="text-center"><a href="blog-subcategories-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-danger status_inactive" title="Change Status"><i class='fa fa-times'></i></a> </td>
											@else 
												<td class="text-center"><a href="blog-subcategories-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-primary status-active" title="Change Status"><i class='fa fa-check'></i></a> </td>
											@endif			
											<td class="actions">
												<a href="#" class="btn ripple btn-info"  onclick="editDetails('{{$item->id}}','{{$item->name}}','{{$item->status}}','{{$item->category_id}}')" data-toggle="modal" data-target="#subcategorieseditmodal"> Edit  </a> 
												<a onclick="return confirm('Are you sure?')" href="blog-subcategories-delete/{{base64_encode($item->id)}}" class="btn ripple btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
											</td>
										</tr>
										@endforeach
										{{ $Subcategories->links() }}
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
<div class="modal fade" id="subcategoriesaddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Add New Sub Categories </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" class="row justify-content-md-center" action="/admin/blog/subcategory-add" enctype="multipart/form-data" >	
					<div class="col-xl-12 col-lg-12 col-md-12">
					@csrf									
					<input name="edit_id" value="0" type="hidden"/>
						<div class="card shade">
							<div class="form-group">
								<label> Categories <span>*</span></label>
								<select name="category_id" class="custom-select w-100" required>
									<option selected disabled> --Select Category-- </option>
									@foreach ($Categories as $item)
										<option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label> Sub Category Name <span>*</span></label>
								<input name="subcategory_name" value=""  class="form-control" placeholder="Sub Category Name..." data-role="tagsinput" maxlength="255" type="text" id="subcategory_name">
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
<div class="modal fade" id="subcategorieseditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Edit Sub Categories </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" class="row justify-content-md-center" action="/admin/blog/subcategory-edit" enctype="multipart/form-data" >	
					<div class="col-xl-12 col-lg-12 col-md-12">
					@csrf			
					<input name="edit_id" id="edit_id" value="0" type="hidden"/>
						<div class="card shade">
							<div class="form-group">
								<label> Categories <span>*</span></label>
								<select name="category_id" id="checkcategory_id" class="custom-select w-100" required>
									<option selected disabled> --Select Category-- </option>
									@foreach ($Categories as $item)
										<option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label> Category Name <span>*</span></label>
								<input name="edit_subcategory_name" value=""  class="form-control" placeholder="Category Name..." maxlength="255" type="text" id="edit_subcategory_name">
							</div>
							<div class="form-group">
								<label>Status </label>
								<select name="is_active_edit" class="custom-select w-100">
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

@include('admin.layouts.footer')
<script>
	// Categories fatch dynamic
	var Subcategories = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: {
			url: '{{url("subcategory-fetch")}}',
			filter: function(list) {
			return $.map(list, function(subcategoriesname) {
				return { name: subcategoriesname }; });
			}
		}
		});
		Subcategories.initialize();

		$('#subcategory_name').tagsinput({
		typeaheadjs: {
			name: 'subcategoryname',
			displayKey: 'name',
			valueKey: 'name',
			source: Subcategories.ttAdapter()
		}
	});


	function editDetails(id,name,status,category_id){
		document.getElementById('edit_id').value = id;
		document.getElementById('checkcategory_id').value = category_id;
		document.getElementById('edit_subcategory_name').value = name;
		document.getElementById('is_active_edit').value = status;
	}
</script>
@endsection
