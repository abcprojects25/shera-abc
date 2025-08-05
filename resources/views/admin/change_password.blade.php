@extends('admin.layouts.app')
@section('content')

<!-- ===== ===== --> 



	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5"> Change Password </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Change Password</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							 
						</div>
					</div>
				</div>
				<!-- End Page Header -->
				
				
				<!--Row-->
				<div class="row row-sm">
					<div class="col-sm-12">
						<div class="card custom-card overflow-hidden">
							
							<hr />
							<div class="card-body pt-0">
									<form name="contactform1"  class="row w-100" method="post" action="{{route('adminchangePassword')}}" id="changepassword">
										@csrf
										<div class="col-lg-12 parameter_setting">
											<div class=""> 
												<div class="form-card"> 
													<div class="row modify_password">
														<div class="col-lg-12 col-md-12 form-group">
															<label> Old Password: <span>*</span></label>
															<input name="old_password" value="" required="" class="form-control" placeholder="Old Password..." maxlength="255" type="password" id="old_password">
														</div>
														<div class="col-lg-12 col-md-12 form-group">
															<label> New Password: <span>*</span></label>
															<input name="new_password" value="" required="" class="form-control" placeholder="New Password..." maxlength="255" type="password" id="new_password">
														</div>
														<div class="col-lg-12 col-md-12 form-group">
															<label> Confirm Password: <span>*</span></label>
															<input name="confirm_password" value="" required="" class="form-control" placeholder="Confirm Password..." maxlength="255" type="password" id="confirm_password">
														</div>
														
														<div class="col-lg-12 submit">
															<input type="submit" name="submit_pass" class="btn btn-primary w-100" value="Change Password">
														</div>
													</div>
												</div> 
											</div>				 
									</form>
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

<!-- ===== ===== --> 

<!-- Add Country -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Inquiry</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered mg-b-0">
					<tr>  
						<th> Name </th> 
						<td> Sanaullah Khan </td> 
					</tr>
					<tr>  
						<th> Email </th>
						<td> khan@abcdesigns.in </td>  
					</tr>
					<tr> 
						<th> Contact </th>
						<td> +91 80804955689 </td>  
					</tr>
					<tr>  
						<th> Message </th>  
						<td> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </td> 
					</tr>
				</table>
			</div> 
		</div>
	</div>
</div>


@include('admin.layouts.footer')
 
<script>
$(".text-box p").text(function(index, currentText) {
  var maxLength = $(this).parent().attr('data-maxlength');
  if(currentText.length >= maxLength) {
    return currentText.substr(0, maxLength) + "...";
  } else {
    return currentText
  } 
});
</script>


@endsection
