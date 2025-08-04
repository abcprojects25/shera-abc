@extends('admin.layouts.app')
@section('content')
<?php use App\Http\Controllers\Admin\SeoController; 
$url = url('/');
?>
<!-- ===== ===== --> 


	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5"> Seo Pages </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Seo</li>
							<li class="breadcrumb-item active" aria-current="page">Seo URL</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							<!--
								<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#exampleModal"> <i class="fe fe-folder-plus mr-2"></i> Add New Categories </a>
							-->
							<a href="/admin/seo/add" class="btn btn-white btn-icon-text my-2 mr-2"> <i class="fe fe-folder-plus mr-2"></i> On page SEO Tags </a>
							<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#AddModal"> <i class="fe fe-folder-plus mr-2"></i> Add SEO URL Lising  </a>
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
											<th style="width:110px"> Created At </th> 
											<th>Page Name</th>    
											<th> URL </th>     
											<th class="text-center" style="width:60px"> Status </th>
											<th style="width:190px"> Actions </th>
										</tr> 
									
										@foreach ($data as $k=>$item)
										<tr> 
											<td class="text-center">{{$k+1}} </td>
											<td> {{ ($item->created_at) ? date('Y-m-d',strtotime($item->created_at)) : '' }}<br>  <small class="text-muted">{{ ($item->created_at) ? date('H:i:A',strtotime($item->created_at)) : '' }}</small>  </td> 
											<td> {{$item->page_name}}</td> 
											<td> 
												@if ($item->urls == '/')
												<a href="/" target="_blank">{{$url}}</a>
												@else
												<a href="/{{$item->urls}}" target="_blank">{{$url}}/{{$item->urls}}</a>
												@endif
											</td>  
											{{-- <td> {{$item->title}} </td> --}}
											@if($item->status == 0) 
												<td><a href="/admin/seo/url/status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-danger status_inactive" title="Change Status"><i class='fa fa-times'></i></a> </td>
											@else 
												<td> <a href="/admin/seo/url/status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-primary status-active" title="Change Status"><i class='fa fa-check'></i></a> </td>
											@endif
											<td class="actions">
												<a href="/admin/seo/url/edit/{{base64_encode($item->id)}}" class="btn ripple btn-info"> Edit  </a> 
												<a onclick="return confirm('Are you sure?')" href="/admin/seo/url/delete/{{base64_encode($item->id)}}" class="btn ripple btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i>  </a>
											</td>
										</tr> 
										@endforeach 
										
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


<!-- Edit FAQ -->
<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="EditModalLabel"> SEO URL </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" class="row justify-content-md-center" action="/admin/seo/url/store" enctype="multipart/form-data" >	
					<div class="col-xl-12 col-lg-12 col-md-12">
					@csrf						 
						<div class="form-group">
							<label> Page Name </label>
							<input name="page_name" value=""  class="form-control" placeholder="Page Name..." type="text" id="page_name">
						</div> 
						<div class="form-group">
							<label>Page URL : <span>*</span></label>
							<div class="input-group mb-2"> 
								<div class="input-group-prepend"> <div class="input-group-text">https://aaplsolutions.com/</div> </div>
								<input name="page_url" value="" required="" class="form-control"  maxlength="255" type="text" id="page_url">
							</div>
						</div>	
						<div class="form-group">
							<label>Status </label>
							<select name="is_active" id="is_active" class="custom-select w-100">
								<option value="1">Active</option>
								<option value="0">In Active</option>
							</select>
						</div>
						<div class="submit">
							<input class="btn btn-primary w-100" type="submit" value="ADD NOW">  
						</div>   
					</div> <!-- -->  
				</form>
			</div> 
		</div>
	</div>
</div>


@include('admin.layouts.footer')

@endsection
