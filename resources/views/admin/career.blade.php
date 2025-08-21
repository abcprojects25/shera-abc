@extends('admin.layouts.app')
@section('content')

<!-- ===== ===== --> 

	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5"> Career </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Career</li>
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
							<div class="card-header border-bottom-0">
								<div class="row">			
									<div class="col-sm-6"> <label class="main-content-label mb-2"> Career Inquiry </label> </div>
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
							<hr />
							<div class="card-body pt-0">
								<div class="table-responsive career_table">
									<table class="table table-bordered mg-b-0">
										<tr> 
											<th style="width:40px">Sr no.</th>
											<th> Job Function</th>
											<th> Name </th>  
											<th style="width:150px">Email & Contact </th>  
											<th> Resume </th>  
											<th> Current Role </th>
											<th> Notice Period </th>
											<th style="width:140px"> Actions </th> 
										</tr> 

										@foreach ($careers as $k=>$item)
											<tr> 
												<td>{{$k+1}}</td>
												<td> {{$item->career_function}} </td>
												<td> {{$item->career_name}} </td>  
												<td>
													<a href="mailto:<?=$item->email?>"> {{$item->career_email}} </a> <hr />
													<a href="tel:<?=$item->contact?>">{{$item->career_mobile}} </a>
												</td>  
												<td> {{$item->career_resume}} <hr /> <a href="{{$item->career_resume}}" download> Resume </a> </td>
												<td> {{$item->career_current_role}} </td>
												<td> {{$item->career_notice_period}} </td>
												<td class="actions">
													<a href="#" onclick="viewDetails('{{$item->career_job_cat}}','{{$item->career_function}}', '{{$item->career_name}}','{{$item->career_email}}','{{$item->career_mobile}}','{{ Storage::url($item->career_resume) }}','{{$item->career_work_exp}}','{{$item->career_current_company}}','{{$item->career_current_role}}', '{{$item->career_current_ctc}}','{{$item->career_notice_period}}'
												)" class="btn btn-sm ripple btn-info" data-toggle="modal" data-target="#ViewModal">  View </a>
													<a onclick="return confirm('Are you sure?')" href="#" class="btn ripple btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>  </a>
												</td>
											</tr>
										@endforeach
										{{ $careers->links() }}

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

<!-- ===== ===== --> 

<!-- Career Details -->
<div class="modal fade" id="ViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Career</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered mg-b-0">
					 <tr><th>Job Category</th><td id="viewJobCat"></td></tr>
          <tr><th>Function</th><td id="viewFunc"></td></tr>
          <tr><th>Name</th><td id="viewName"></td></tr>
          <tr><th>Email</th><td id="viewEmail"></td></tr>
          <tr><th>Contact</th><td id="viewContact"></td></tr>
          <tr><th>Work Experience</th><td id="viewWorkExp"></td></tr>
          <tr><th>Current Company</th><td id="viewCurrentCompany"></td></tr>
          <tr><th>Current Role</th><td id="viewCurrentRole"></td></tr>
          <tr><th>Current CTC</th><td id="viewCurrentCtc"></td></tr>
          <tr><th>Notice Period</th><td id="viewNoticePeriod"></td></tr>
          <tr><th>Resume</th><td><a href="#" id="viewResume" download>Resume</a></td></tr>
					
				</table>
			</div> 
		</div>
	</div>
</div>
<script>

function viewDetails(
    career_job_cat,
    career_function,
    career_name,
    career_email,
    career_mobile,
    career_resume,
    career_work_exp,
    career_current_company,
    career_current_role,
    career_current_ctc,
    career_notice_period
) {
    document.getElementById("viewJobCat").innerText = career_job_cat;
    document.getElementById("viewFunc").innerText = career_function;
    document.getElementById("viewName").innerText = career_name;
    document.getElementById("viewEmail").innerText = career_email;
    document.getElementById("viewContact").innerText = career_mobile;
    document.getElementById("viewWorkExp").innerText = career_work_exp;
    document.getElementById("viewCurrentCompany").innerText = career_current_company;
    document.getElementById("viewCurrentRole").innerText = career_current_role;
    document.getElementById("viewCurrentCtc").innerText = career_current_ctc;
    document.getElementById("viewNoticePeriod").innerText = career_notice_period;
    document.getElementById("viewResume").href = career_resume;
}


</script>

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
