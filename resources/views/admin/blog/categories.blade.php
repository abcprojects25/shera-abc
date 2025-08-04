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
						<h2 class="main-content-title tx-24 mg-b-5"> Blog Categories </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Blog Categories</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center"> 
							<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#categoriesaddmodal"> <i class="fe fe-folder-plus mr-2"></i> Add New Categories </a> 
							<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#subcategoriesaddmodal"> <i class="fe fe-folder-plus mr-2"></i> Add New Sub-Categories </a> 
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
								<a href="#" class="btn ripple btn-info" data-toggle="modal" data-target="#sortingModal"> Sorting </a>
								<br/><br/>
								<div class="table-responsive">
									<table class="table table-bordered mg-b-0">
										<tr> 
											<th style="width:50px">Id</th>
											<th class="sort" style="width:120px"> Created At </th>
											<th class="sort">Categories / Sub-categories</th> 
											<th class="text-center sort" style="width:100px"> Status </th>
											<th> Actions </th>
										</tr> 
										@foreach ($Categories as $k=>$item)
										<tr> 
											<td class="text-center">{{$Categories->firstItem() + $k}} </td>
											<td> {{date('d M Y',strtotime($item->created_at))}}<br> <small class="text-muted">{{date('H:i:A',strtotime($item->created_at))}}</small> </td> 
											<td> {{$item->name}}</td>
											
											@if($item->status == 0)
												<td class="text-center"><a href="blog-categories-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-danger status_inactive" title="Change Status"><i class='fa fa-times'></i></a> </td>
											@else 
												<td class="text-center"><a href="blog-categories-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-primary status-active" title="Change Status"><i class='fa fa-check'></i></a> </td>
											@endif			
											<td class="actions">
												<a href="#" class="btn ripple btn-info"  onclick="editDetails('{{$item->id}}','{{$item->name}}','{{$item->status}}')" data-toggle="modal" data-target="#subcategorieseditmodal"> Edit  </a> 
												<a onclick="return confirm('Are you sure?')" href="blog-categories-delete/{{base64_encode($item->id)}}" class="btn ripple btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
											</td>
										</tr>
										@endforeach
									</table>
									{{$Categories->links()}}
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
<div class="modal fade" id="categoriesaddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Add New Categories </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" class="row justify-content-md-center" action="/admin/blog/category-add" enctype="multipart/form-data" >	
					<div class="col-xl-12 col-lg-12 col-md-12">
					@csrf									
						<div class="card shade">
							<div class="form-group">
								<label> Category Name : <span>*</span></label>
								<input name="edit_id" value="0" type="hidden"/>
								<input name="type" value="3" type="hidden"/>
								<input name="category_name" value=""  class="form-control" placeholder="Category type and enter..." data-role="tagsinput" maxlength="255" type="text" id="category_name">
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
				<h5 class="modal-title" id="exampleModalLabel"> Edit New Categories </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" class="row justify-content-md-center" action="/admin/blog/category-edit" enctype="multipart/form-data" >	
					<div class="col-xl-12 col-lg-12 col-md-12">
					@csrf			
						<div class="card shade">
							<div class="form-group area_interest">
								<label> Categories </label>
								<select name="category_id[]" id="multiple-checkboxes"  class="custom-select w-100" multiple="multiple">
									@foreach ($Category_list as $item)
										<option value="{{$item->id}}"> {{$item->name}} </option>
									@endforeach 
								</select>
							</div>
							<div class="form-group">
								<label> Category Name : <span>*</span></label>
								<input name="edit_id" id="edit_id" value="0" type="hidden"/>
								<input name="type" value="3" type="hidden"/>
								<input name="edit_category_name" value=""  class="form-control" placeholder="Category type and enter..." maxlength="255" type="text" id="edit_category_name">
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
<!-- Add Sub Categories -->
<div class="modal fade" id="subcategoriesaddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Add New Sub-Categories </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" class="row justify-content-md-center" action="/admin/blog/subcategory-add" enctype="multipart/form-data" >	
					<div class="col-xl-12 col-lg-12 col-md-12">
					@csrf									
						<div class="card shade">
							<div class="form-group area_interest">
								<label> Categories <span>*</span></label>
								<select name="category_id[]" id="multiple-checkboxes"  class="custom-select w-100" multiple="multiple" required="">
									@foreach ($Category_list as $item)
										<option value="{{$item->id}}"> {{$item->name}} </option>
									@endforeach 
								</select>
							</div>
							<div class="form-group">
								<label> Sub-category Name : <span>*</span></label>
								<input name="type" value="3" type="hidden"/>
								<input name="subcategory_name" value=""  class="form-control" placeholder="Category type and enter..." data-role="tagsinput" maxlength="255" type="text" id="category_name">
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
				<h5 class="modal-title" id="sortingModalLabel">Sorting Categories Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<ul id="changeTableDate">
					@foreach ($Category_list as $k=>$item)
					<li class="p-2 tableRow" width="20px" data-id="{{ $item->id }}"><span class="mr-2">{{$item->category_order}} </span> {{$item->name}}</li>
					@endforeach
				</ul>
				<br/>
				<div class="modal-footer">
					<input type='button' class="btn btn-info btn-submit" value='Reload' id='reload' />
				</div>
			</div> 
		</div>
	</div>
</div>
@include('admin.layouts.footer')
<link href="/admin/css/tagsinput.css" rel="stylesheet" type="text/css">
<script src="/admin/js/typeahead.bundle.min.js"></script> 
<script src="/admin/js/tagsinput.js"></script>
<script type="text/javascript" src="/admin/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
		  enableFiltering: true,
		  enableCaseInsensitiveFiltering: true,
		  maxHeight: 250
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


	function editDetails(id,name,status){
		document.getElementById('edit_id').value = id;
		document.getElementById('edit_category_name').value = name;
		document.getElementById('is_active_edit').value = status;
	}
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
			var categoryIdsArray = [];
			$('.tableRow').each(function (index) {
					var dataid = $(this).attr('data-id');
					categoryIdsArray.push(dataid);
			});
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "/admin/blog/blog-category-sort",
					data: {
					order: categoryIdsArray,
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
