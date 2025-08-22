@extends('admin.layouts.app')
@section('content')

<!-- ===== ===== --> 


		<div class="main-content side-content pt-0">
			<div class="container-fluid">
				<div class="inner-body">
					<!-- Page Header -->
					<div class="page-header">
						<div>

						@if(session('login_debug_email') && session('login_debug_password'))
    <div class="alert alert-info">
        <strong>Debug Credentials:</strong><br>
        Email: {{ session('login_debug_email') }}<br>
        Password: {{ session('login_debug_password') }}
    </div>
@endif

							<h2 class="main-content-title tx-24 mg-b-5">Welcome To Dashboard</h2>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</div>
						<div class="d-flex">
							{{-- <div class="justify-content-center">
								<button type="button" class="btn btn-primary my-2 btn-icon-text"> <i class="fe fe-download-cloud mr-2"></i> Download Report </button>
							</div> --}}
						</div>
					</div>
					<!-- End Page Header -->
					<!--Row-->
					<div class="row row-sm">
						<div class="col-sm-12 col-lg-12 col-xl-8">
							<!--Row-->
							<div class="row row-sm  mt-lg-4">
								<div class="col-sm-12 col-lg-12 col-xl-12">
									<div class="card bg-primary custom-card card-box">
										<div class="card-body p-4">
											<div class="row align-items-center">
												<div class="offset-xl-4 offset-sm-6 col-xl-8 col-sm-6 col-12 img-bg ">
													<h4 class="d-flex mb-3"> <span class="font-weight-bold text-white"> Hi, Admin Name Should be here!</span> </h4>
													<p class="tx-white-7 mb-1">You have <b class="text-warning">{{$TodayEnquiries}}</b> New Inquiries Today. </p>
												</div> <img src="/admin/img/pngs/work3.png" alt="user-img">
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--Row -->
							<!--Row-->
							<!--row-->
							<div class="row row-sm">
								<!-- col end -->
								<div class="col-lg-12">
									<div class="card custom-card mg-b-10">
										<div class="card-body">
											<div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
												<div>
													<label class="main-content-label mb-2">Top Careers</label> 
												</div>
											</div>
											<div class="table-responsive tasks">
												<table class="table card-table table-vcenter border">
													<thead>
														<tr>
															<th class="wd-lg-15p">ID</th>
															<th class="wd-lg-15p">Name</th>
															<th class="">Resume</th>
															<th> Sent at </th>
														</tr>
													</thead>
													<tbody>
														@foreach ($Careers as $item)
														
														<tr>
															<td class=" "> {{$loop->iteration}} </td>
															<td class=" "> {{$item->career_name}} </td>
															<td class=" "><a href="{{ Storage::url($item->career_resume) }}" target="_blank" download>
																Resume Link
															</a> </td>
															<td>{{ $item->created_at->format('d/m/Y') }}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<!-- col end -->
							</div>
							<!-- Row end -->
							<div class="row row-sm">
								<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
									<div class="card custom-card">
										<div class="card-body">
											<div class="card-item">
												<div class="card-item-icon card-icon">
													<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
														<path d="M0 0h24v24H0V0z" fill="none"></path>
														<path d="M12 4c-4.41 0-8 3.59-8 8 0 1.82.62 3.49 1.64 4.83 1.43-1.74 4.9-2.33 6.36-2.33s4.93.59 6.36 2.33C19.38 15.49 20 13.82 20 12c0-4.41-3.59-8-8-8zm0 9c-1.94 0-3.5-1.56-3.5-3.5S10.06 6 12 6s3.5 1.56 3.5 3.5S13.94 13 12 13z" opacity=".3"></path>
														<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z"></path>
													</svg>
												</div>
												<div class="card-item-title mb-2">
													<label class="main-content-label tx-13 font-weight-bold mb-1">Total Enquiries</label>
												</div>
												<div class="card-item-body">
													<div class="card-item-stat">
														<h4 class="font-weight-bold">{{$EnquiriesCount}}</h4>
														<small><b class="text-success"><a href="/admin/contact-us"> Include All </a></b> </small>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
									<div class="card custom-card">
										<div class="card-body">
											<div class="card-item">
												<div class="card-item-icon card-icon">
													<svg class="text-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
														<path d="M0 0h24v24H0V0z" fill="none"></path>
														<path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1.23 13.33V19H10.9v-1.69c-1.5-.31-2.77-1.28-2.86-2.97h1.71c.09.92.72 1.64 2.32 1.64 1.71 0 2.1-.86 2.1-1.39 0-.73-.39-1.41-2.34-1.87-2.17-.53-3.66-1.42-3.66-3.21 0-1.51 1.22-2.48 2.72-2.81V5h2.34v1.71c1.63.39 2.44 1.63 2.49 2.97h-1.71c-.04-.97-.56-1.64-1.94-1.64-1.31 0-2.1.59-2.1 1.43 0 .73.57 1.22 2.34 1.67 1.77.46 3.66 1.22 3.66 3.42-.01 1.6-1.21 2.48-2.74 2.77z" opacity=".3"></path>
														<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"></path>
													</svg>
												</div>
												<div class="card-item-title  mb-2">
													<label class="main-content-label tx-13 font-weight-bold mb-1">Total Products</label></div>
												<div class="card-item-body">
													<div class="card-item-stat">
														<h4 class="font-weight-bold">{{$ProductsCount}}</h4> <small><b class="text-danger"> <a href="/admin/product/all-product"> Include All </a></b></small> </div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
									<div class="card custom-card">
										<div class="card-body">
											<div class="card-item">
												<div class="card-item-icon card-icon">
													<svg class="text-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
														<path d="M0 0h24v24H0V0z" fill="none"></path>
														<path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1.23 13.33V19H10.9v-1.69c-1.5-.31-2.77-1.28-2.86-2.97h1.71c.09.92.72 1.64 2.32 1.64 1.71 0 2.1-.86 2.1-1.39 0-.73-.39-1.41-2.34-1.87-2.17-.53-3.66-1.42-3.66-3.21 0-1.51 1.22-2.48 2.72-2.81V5h2.34v1.71c1.63.39 2.44 1.63 2.49 2.97h-1.71c-.04-.97-.56-1.64-1.94-1.64-1.31 0-2.1.59-2.1 1.43 0 .73.57 1.22 2.34 1.67 1.77.46 3.66 1.22 3.66 3.42-.01 1.6-1.21 2.48-2.74 2.77z" opacity=".3"></path>
														<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"></path>
													</svg>
												</div>
												<div class="card-item-title  mb-2">
													<label class="main-content-label tx-13 font-weight-bold mb-1">Total Projects</label></div>
												<div class="card-item-body">
													<div class="card-item-stat">
														<h4 class="font-weight-bold">{{$ProjectsCount}}</h4> <small><b class="text-danger"> <a href="/admin/project/all-project"> Include All </a></b></small> </div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
									<div class="card custom-card">
										<div class="card-body">
											<div class="card-item">
												<div class="card-item-icon card-icon">
													<svg class="text-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
														<path d="M0 0h24v24H0V0z" fill="none"></path>
														<path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1.23 13.33V19H10.9v-1.69c-1.5-.31-2.77-1.28-2.86-2.97h1.71c.09.92.72 1.64 2.32 1.64 1.71 0 2.1-.86 2.1-1.39 0-.73-.39-1.41-2.34-1.87-2.17-.53-3.66-1.42-3.66-3.21 0-1.51 1.22-2.48 2.72-2.81V5h2.34v1.71c1.63.39 2.44 1.63 2.49 2.97h-1.71c-.04-.97-.56-1.64-1.94-1.64-1.31 0-2.1.59-2.1 1.43 0 .73.57 1.22 2.34 1.67 1.77.46 3.66 1.22 3.66 3.42-.01 1.6-1.21 2.48-2.74 2.77z" opacity=".3"></path>
														<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"></path>
													</svg>
												</div>
												<div class="card-item-title  mb-2">
													<label class="main-content-label tx-13 font-weight-bold mb-1">Total Blogs</label></div>
												<div class="card-item-body">
													<div class="card-item-stat">
														<h4 class="font-weight-bold">{{$BlogsCount}}</h4> <small><b class="text-danger"> <a href="/admin/blog/all-post"> Include All </a></b></small> </div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
									<div class="card custom-card">
										<div class="card-body">
											<div class="card-item">
												<div class="card-item-icon card-icon">
													<svg class="text-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
														<path d="M0 0h24v24H0V0z" fill="none"></path>
														<path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1.23 13.33V19H10.9v-1.69c-1.5-.31-2.77-1.28-2.86-2.97h1.71c.09.92.72 1.64 2.32 1.64 1.71 0 2.1-.86 2.1-1.39 0-.73-.39-1.41-2.34-1.87-2.17-.53-3.66-1.42-3.66-3.21 0-1.51 1.22-2.48 2.72-2.81V5h2.34v1.71c1.63.39 2.44 1.63 2.49 2.97h-1.71c-.04-.97-.56-1.64-1.94-1.64-1.31 0-2.1.59-2.1 1.43 0 .73.57 1.22 2.34 1.67 1.77.46 3.66 1.22 3.66 3.42-.01 1.6-1.21 2.48-2.74 2.77z" opacity=".3"></path>
														<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"></path>
													</svg>
												</div>
												<div class="card-item-title  mb-2">
													<label class="main-content-label tx-13 font-weight-bold mb-1">Total Subscribers</label></div>
												<div class="card-item-body">
													<div class="card-item-stat">
														<h4 class="font-weight-bold">{{$SubscribesCount}}</h4> <small><b class="text-danger"> <a href="subscribers"> Include All </a></b></small> </div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--End row-->
							<!--row-->
							<div class="row row-sm">
								<!-- col end -->
								<div class="col-lg-12">
									<div class="card custom-card mg-b-20">
										<div class="card-body">
											<div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
												<div>
													<label class="main-content-label mb-2">Top Inquiries</label> 
												</div>
											</div>
											<div class="table-responsive tasks">
												<table class="table card-table table-vcenter mb-0  border">
													<thead>
														<tr>
															<th class="wd-lg-15p">ID</th>
															<th class="wd-lg-15p">Name</th>
															<th class="wd-lg-15p">Contact</th>
															<th class="">Email</th>
															<th class="">Message</th>
														</tr>
													</thead>
													<tbody>
														@foreach ($Contacts as $item)
														
														<tr>
															<td class=" "> {{$loop->iteration}} </td>
															<td class=" "> {{$item->first_name}} </td>
															<td class=" "> {{$item->contact}} </td>
															<td class="">  {{$item->email}} </td>
															<td class=" "> {{$item->message}} </td>
															{{-- <td>{{$item->message}}</td> --}}
														</tr>
														@endforeach
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
						<!-- col end -->
						<div class="col-sm-12 col-lg-12 col-xl-4 mt-xl-4">
							<div class="card custom-card">
								<div class="card-body">
									<div class="row row-sm">
										<div class="col-6">
											<div class="card-item-title">
												<br />
												<label class="main-content-label tx-13 font-weight-bold mb-2">Total Subscriber</label>
												<span class="d-block tx-12 mb-0 text-muted"> </span>
											</div>
											<p class="tx-24 mt-2"><b class="text-primary">{{$SubscribesCount}} </b></p>
										</div>
										<div class="col-6"> <img src="/admin/img/pngs/work.png" alt="image" class="best-emp"> </div>
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

@include('admin.layouts.footer')

<!--
<script type="text/javascript" src="/admin/plugins/chart.js/Chart.bundle.min.js"></script>
<script type="text/javascript" src="/admin/plugins/peity/jquery.peity.min.js"></script>
<script type="text/javascript" src="/admin/plugins/raphael/raphael.min.js"></script>
<script type="text/javascript" src="/admin/plugins/morris.js/morris.min.js"></script>
<script type="text/javascript" src="/admin/js/circle-progress.min.js"></script>
<script type="text/javascript" src="/admin/js/chart-circle.js"></script>
--> 
@endsection
