@extends('admin.layouts.app')
@section('content')

<!-- ===== ===== --> 


	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Administration Group</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Group List</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							<button type="button" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#addgroup">
								<i class="fe fe-folder-plus mr-2"></i> Add New Group 
							</button>
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
									<form class="form-inline search-form">
										<div class="form-group">
											<label>Title </label>
											<input name="name" class="form-control" placeholder="Name..." maxlength="255" type="text" id="ArticleName" />
										</div>
										<div class="form-group">
											<label>Is Active </label>
											<select name="status" class="custom-select w-100">
												<option value="">-- Select Status --</option>
												<option value="0">In Active</option>
												<option value="1">Active</option>
											</select>
										</div>
										<input class="btn btn-primary inline_submit" type="submit" value="Search" />
									</form>
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
												<th class="sort" style="width:150px"> Date & Time </th>
												<th> Title </th>
												<th class="text-center sort"> Status </th>
												<th> Actions </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><input type="checkbox"/></td>
												<td>1</td>
												<td>  <small class="text-muted">01:41 AM</small> <br> 16 Feb 2021  </td>
												<td> Super Admin  </td>
												<td class="text-center">
													<a href="#" class="btn btn-success" title="Click to De-Active"> <i class="fa fa-check"></i> </a>
												</td>
												<td class="actions">
													<a href="#" class="btn ripple btn-info"> Edit </a>
													<a href="#" class="btn ripple btn-danger"> <i class="fa fa-trash-o"></i> Delete </a>
												</td>
											</tr>
											<tr>
												<td><input type="checkbox"/></td>
												<td>1</td>
												<td> <small class="text-muted">01:41 AM</small> <br> 16 Feb 2021  </td>
												<td> Managers  </td>
												<td class="text-center">
													<a href="#" class="btn btn-success" title="Click to De-Active"> <i class="fa fa-check"></i> </a>
												</td>
												<td class="actions">
													<a href="#" class="btn ripple btn-info"> Edit </a>
													<a href="#" class="btn ripple btn-danger"> <i class="fa fa-trash-o"></i> Delete </a>
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

@include('admin.layouts.footer')


	<div class="modal fade" id="addgroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalCenterTitle"> Add New Group </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/admin/img/close_1.png" class="img-fluid" />
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="{{route('press.store')}}">
                        <div class=" form-group">
							<label>Group Name: <span class="required">*</span></label>
                            <input name="name" class="form-control" placeholder="Group Name..." maxlength="255" type="text"  id="" required />
                        </div>
                        <div class="form-group">
                            <select name="status" class="custom-select w-100">
                                <option value="">-- Select Status --</option>
                                <option value="0">In Active</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                        <div class="submit">
                            <input class="btn btn-primary w-100" type="submit" value="Continue" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 
@endsection

 
