@extends('admin.layouts.app')
@section('content')

<!-- ===== ===== --> 

	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5"> Newsletter Subscribers  </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Newsletter Subscribers</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							<a href="#" class="btn btn-white btn-icon-text my-2 mr-2"><i class="fe fe-file-text mr-2"></i> Export Data </a> 
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
									<div class="col-sm-6"> <label class="main-content-label mb-2"> Newsletter Subscribers </label> </div>
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
								<div class="table-responsive">
									<table class="table table-bordered mg-b-0">
										<tr> 
											<th style="width:40px">Id</th>
											<th class="sort" style="width:120px">Date &amp; Time </th>  
											<th> Email </th>    
											<th> Term & Condition </th> 
											<th> Actions </th>
										</tr>
										@foreach ($Subscribes as $k=>$item)
										<tr> 
											<td>{{$k+1}}</td>
											<td> {{date('d M Y',strtotime($item->created_at))}}<br> <small class="text-muted">{{date('H:i:A',strtotime($item->created_at))}}</small> </td> 											
											<td>
												<a href="mailto:<?=$item->email?>"> {{$item->email}} </a>
											</td>  
											<td>
												@if ($item->activity == 1)
													<span>Agree</span>
												@else
													<span>Not Agree</span>
												@endif
											
											</td>  
											<td class="actions"> 
												<a onclick="return confirm('Are you sure?')" href="/admin/subscription-delete/{{base64_encode($item->id)}}" class="btn ripple btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
											</td>
										</tr>
										@endforeach
										{{ $Subscribes->links() }}
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
						<th> Location </th>
						<td> Andheri </td>  
					</tr>
					<tr> 
						<th> Resume  </th>
						<td> <a href="#" download> Resume </a>  </td>  
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
