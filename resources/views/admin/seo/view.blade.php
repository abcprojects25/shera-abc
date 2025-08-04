@extends('admin.layouts.app')
@section('content')
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
							<li class="breadcrumb-item active" aria-current="page">View</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center"> 
							<a href="/admin/seo/edit/" class="btn btn-white btn-icon-text my-2 mr-2"> <i class="fe fe-folder-plus mr-2"></i> Edit This </a>
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
									<div class="col-md-12">
										 <h6> View Page Seo  </h6>
									</div> 
								</div>
								<hr /> 

								<div class="table-responsive"> 
									<table class="table table-bordered mg-b-0">
										<tr>  
											<th> Page Name </th> 
											<th width="10px;"> :</th> 
											<td id="page_name"> Home  </td> 
										</tr>
										<tr>  
											<th> Page URL </th>
											<th> :</th> 
											<td> <a href="/" id="page_url"> https://aaplsolutions.com/</a>  </td>  											
										</tr> 
										<!-- Loop Start -->	
										<tr class="table-info">  
											<th colspan="3"> English </th>  											
										</tr> 
										<tr> 
											<th> Meta Title </th>
											<th> :</th> 
											<td id="meta_title"> Aluminium Composite Panel | ACP Sheets | ACP Panel Supplier In India - VIVA ACP  </td>  
										</tr>
										<tr> 
											<th> Meta Description </th>
											<th> :</th> 
											<td id="meta_desc">Aluminium Composite Panel | ACP Sheets | ACP Panel Supplier In India - VIVA ACP  </td>  
										</tr>
										<tr> 
											<th> Meta Keyword  </th>
											<th> :</th> 
											<td id="meta_keywords"> Aluminium Composite Panel | ACP Sheets | ACP Panel Supplier In India - VIVA ACP </td>  
										</tr>
										<tr class="table-info">  
											<th colspan="3"> Arabic </th>  											
										</tr> 
										<tr> 
											<th> Meta Title </th>
											<th> :</th> 
											<td id="meta_title"> Aluminium Composite Panel | ACP Sheets | ACP Panel Supplier In India - VIVA ACP  </td>  
										</tr>
										<tr> 
											<th> Meta Description </th>
											<th> :</th> 
											<td id="meta_desc">Aluminium Composite Panel | ACP Sheets | ACP Panel Supplier In India - VIVA ACP  </td>  
										</tr>
										<tr> 
											<th> Meta Keyword  </th>
											<th> :</th> 
											<td id="meta_keywords"> Aluminium Composite Panel | ACP Sheets | ACP Panel Supplier In India - VIVA ACP </td>  
										</tr> 
										<!-- Loop End -->										
										<tr class="table-info">  
											<th colspan="3"> Meta Script/tags </th>  											
										</tr> 
										<tr> 
											<th> Script/tags </th>
											<th> :</th> 
											<td class="text-left"> 
												<pre class="text-left"> 
													{
														"@context": "https://schema.org/",
														"@type": "WebSite",
														"name": "Viva ACP",
														"url": "https://aaplsolutions.com/",
														"potentialAction": {
															"@type": "SearchAction",
															"target": "https://aaplsolutions.com/?s={search_term_string}",
															"query-input": "required name=search_term_string"
														}	
													}
												</pre>											
											</td>  
										</tr> 				
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
