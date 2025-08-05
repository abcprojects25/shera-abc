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
											<th style="width:40px">Id</th>
											<th style="width:110px">Date &amp; Time </th> 
											<th> Name </th>  
											<th style="width:150px">Email & Contact </th> 
											<th> Location </th> 
											<th> Resume </th>  
											<th> Message  </th>  
											<th style="width:140px"> Actions </th> 
										</tr> 

										@foreach ($careers as $k=>$item)
											<tr> 
												<td>{{$k+1}}</td>
												<td> {{date('d M Y',strtotime($item->created_at))}}<br> <small class="text-muted">{{date('H:i:A',strtotime($item->created_at))}}</small> </td> 											
												<td> {{$item->name}} </td>  
												<td>
													<a href="mailto:<?=$item->email?>"> {{$item->email}} </a> <hr />
													<a href="tel:<?=$item->contact?>">{{$item->contact}} </a>
												</td> 
												<td> {{$item->location}} </td> 
												<td> {{$item->resume}} <hr /> <a href="{{$item->resume_url}}" download> Resume </a> </td>
												<td> <div class="text-box" data-maxlength="150"> <p>{{$item->message}} </p></div></td> 
												<td class="actions">
													<a href="#" onclick="viewDetails('{{$item->name}}','{{$item->email}}','{{$item->contact}}','{{$item->location}}','{{$item->resume_url}}')" class="btn btn-sm ripple btn-info" data-toggle="modal" data-target="#ViewModal">  View </a>
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
					<tr>  
						<th> Name </th> 
						<td id="viewName"> </td> 
					</tr>
					<tr>  
						<th> Email </th>
						<td id="viewEmail"> </td>  
					</tr>
					<tr> 
						<th> Contact </th>
						<td id="viewContact"> </td>  
					</tr>
					<tr> 
						<th> Location </th>
						<td id="viewLocation"> </td>  
					</tr>
					<tr> 
						<th> Resume  </th>
						<td> <a href="#" id="viewResumeUrl" download> Resume </a>  </td>  
					</tr>
					{{-- <tr>  
						<th> Message </th>  
						<td id="viewMessage"> </td> 
					</tr> --}}
				</table>
			</div> 
		</div>
	</div>
</div>
<script>

function viewDetails(name,email,contact,location,resume_url){
	document.getElementById("viewName").innerText = name;
	document.getElementById("viewEmail").innerText = email;
	document.getElementById("viewContact").innerText = contact;
	document.getElementById("viewLocation").innerText = location;
	document.getElementById("viewResumeUrl").href = resume_url;
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
