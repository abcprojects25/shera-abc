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
						<h2 class="main-content-title tx-24 mg-b-5"> Blog </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Blog Pages</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							{{-- <a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#categoriesmodal"> <i class="fe fe-folder-plus mr-2"></i> Add New Categories </a>
							<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#TagsModal"> <i class="fe fe-folder-plus mr-2"></i> Add New Tags </a> --}}
							<a href="/admin/blog/blog-add" class="btn btn-white btn-icon-text my-2 mr-2"> 
								<i class="fe fe-folder-plus mr-2"></i> Add New Blog </a>
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
											<th class="sort" style="width:120px"> Created At </th>
											<th class="sort">Categories</th>  
											<th class="sort">Blog Title</th>  
											<th> Blog Url </th>  
											<th class="text-center sort" style="width:100px"> Status </th>
											<th> Actions </th>
										</tr> 
										@foreach ($Blogs as $k=>$item)
										<tr> 
											<td class="text-center">{{$Blogs->firstItem() + $k}} </td>
											<td> {{date('Y M d',strtotime($item->created_at))}} <br>  <small class="text-muted">{{date('H:i a',strtotime($item->created_at))}}</small>  </td>
											<td> {{$item->category_name}} </td>
											<td> {{$item->blog_title}} </td>
											<td> <a href="/blog/view/{{$item->blog_url}}" target="_blank"> {{$item->blog_url}} </a> </td> 
											{{-- <td class="text-center"> 
												<a href="#" class="btn btn-primary status-active" title="Change Status"><i class="fa fa-check"></i></a>
											</td>  --}}
											<td class="text-center">
												@if($item->status == 0) 
												<a  href="/admin/blog/status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-danger status_inactive" title="Change Status"><i class='fa fa-times'></i></a> </td>
												@else 
												<a  href="/admin/blog/status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-primary status-active" title="Change Status"><i class='fa fa-check'></i></a> </td>
												@endif
											</td>						
											<td class="actions">
												<div class="btn-group">
													<a href="/admin/blog/blog-edit/{{base64_encode($item->id)}}" class="btn ripple btn-info"> Edit  </a>
													<div class="dropdown">
														<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"> <i class="fa fa-chevron-down" aria-hidden="true"></i>  </button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenu2"> 
															<a href="#"> View </a>
															<a href="/admin/blog/blog-delete/{{base64_encode($item->id)}}" onclick="return confirm('Are you sure?')"> Delete </a> 
														</div>
													</div>
												</div> 
											</td>
										</tr>
										@endforeach
										{{ $Blogs->links() }}
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



<!-- Add Categories -->
<div class="modal fade" id="categoriesmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
								<input name="type" value="3" type="hidden"/>
								<input name="category_name" value=""  class="form-control" placeholder="Category Name..." maxlength="255" type="text" id="category_name">
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


<!-- Add Tags -->
<div class="modal fade" id="TagsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Add New Tags </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" class="row justify-content-md-center" action="/admin/blog/tags-add" enctype="multipart/form-data" >	
					<div class="col-xl-12 col-lg-12 col-md-12">
					@csrf									
						<div class="card shade">
							<div class="form-group">
								<label> Tags Name : <span>*</span></label>
								<input name="tags_name" value=""  class="form-control" placeholder="Tags Name..." maxlength="255" type="text" id="tags_name">
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
</script>


@endsection
