@extends('admin.layouts.app')
@section('content')

<!-- ===== ===== --> 
<?php
use App\Http\Controllers\Admin\DashboardController;

$data = DashboardController::user_data();

  ?>

	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Administration</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">User List</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
                      <!--   <a href="/admin/user-add" class="btn btn-white btn-icon-text my-2 mr-2"> <i class="fe fe-folder-plus mr-2"></i> Add User </a>  -->
						</div>
					</div>
				</div>
				<!-- End Page Header -->

				<!--Row-->
				<div class="row row-sm">
					<div class="col-sm-12">	
						<div class="card custom-card overflow-hidden">
							<div class="card-header border-bottom-0">
								<div> 
									@include('admin.layouts.notification')
								</div>
							</div>
							<hr />
							<div class="card-body pt-0">
								<div class="table-responsive">
									<table class="table text-nowrap text-md-nowrap table-bordered mg-b-0">
										<thead>
											<tr>
												<th style="width:20px"> </th>
												<th style="width:50px">Id</th>
												
												<th> Name </th>
												<th> Email ID </th>
												
												<th> Actions </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><input type="checkbox"/></td>
												<td>1</td>
												
												<td> {{ $data->username }}  </td>
												<td> <a href="mailto:<?=$data->email_address?>"> {{$data->email_address}} </a></td>
												<td class="actions">
													<a href="#" class="btn ripple btn-info" data-toggle="modal"
													data-target="#changepassword"> Change Password </a>
													<!--<a href="#" class="btn ripple btn-danger"> <i class="fa fa-trash-o"></i> Delete </a> -->
												</td>
											</tr>
											
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

<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true" data-keyboard="false" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
	<div class="modal-content">
		<div class="modal-header text-center">
			<h5 class="modal-title" id="exampleModalCenterTitle"> Change Password </h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<img src="/admin/img/close_1.png" class="img-fluid" />
			</button>
		</div>
		<div class="modal-body">
			<div class="table-responsive" id="changepsw">
				<form class="form search-form" action="save-password" method="post">
					@csrf
					<div class="form-group">
						<label>Email ID </label>
						<input name="email" class="form-control" placeholder="Name..." maxlength="255" value="{{ $data->email_address }}" type="email" id="email" readonly/>
					</div>

					<div class="form-group">
						<label>Password </label>
						<input name="password" class="form-control" placeholder="Password" maxlength="255" type="password" id="password" />
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="form-group">
						<label>Confirm Password </label>
						<input  class="form-control" placeholder="Confirm Password" maxlength="255" type="password" name="password_confirmation" id="password-confirm" />
						
					</div>

					
					<input class="btn btn-primary inline_submit" type="submit" value="Save" />
				</form>
			</div>
		</div>
	</div>
</div>
</div>

@include('admin.layouts.footer')
 
 
@endsection

 
