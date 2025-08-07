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
						<h2 class="main-content-title tx-24 mg-b-5"> All Products </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Products</a></li>
							<li class="breadcrumb-item active" aria-current="page">Product Listing</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							<!-- <a href="/admin/product/all-home-product" class="btn btn-white btn-icon-text my-2 mr-2"> <i class="fe fe-folder-plus mr-2"></i> Home Product Listing </a>  -->
							<!-- <a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#exampleModal"> <i class="fe fe-folder-plus mr-2"></i> Add New Categories </a> -->
							<a href="/admin/product/product-add" class="btn btn-white btn-icon-text my-3 mr-5"> <i class="fe fe-folder-plus mr-2"></i> Add New Product </a> 
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
									<div class="col-md-6 col-sm-6">
										<ul class="subsubsub mb-0">
											<li class="all"><a href="#" class="current" aria-current="page">All <span class="count">({{$count}})</span></a> </li>
											<li class="publish"><a href="#">Active <span class="count">({{$activecount}})</span></a> </li>
											<li class="draft"><a href="#">InActive <span class="count">({{$incativecount}})</span></a> </li>
										</ul>
									</div>
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
								<a href="#" class="btn ripple btn-info" data-toggle="modal" data-target="#sortingModal"> Sorting </a>

								<div class="table-responsive">
										<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered mg-b-0" id="data-table">
											<thead>
											<tr>
												<th style="width:50px">Sr No.</th>
												<th> Category </th>
												<th> Name </th>  
												<th> Description </th>
												<th class="text-center" style="width:60px"> Thumbnail </th>
												 <th class="text-center" style="width:120px"> Created At </th>
												<th class="text-center" style="width:60px"> Status </th>
												<th> Actions </th>
											</tr>
											</thead>
											<tbody>
												@foreach ($Products as $k=>$item)
												<tr> 
													<td class="text-center">{{$k + 1}}</td>
													@php
														$category = CommonController::FetchOneCategory($item->category_id);
													@endphp
													<td> {{$category}} </td>
													<td> {{$item->title}}</td>
													<td> {!! $item->description !!}
 </td>
													@if (!empty($item->image))
													<td style="width:80px"><img src="{{$item->image}}" class="img-fluid" /></td>
													@else
													<td><i>No Image Selected</i></td>
													@endif
													<td class="text-center">
														{{ $item->created_at->format('Y-m-d') }}<br/>
														<small class="text-muted">{{ $item->created_at->format('h:i A') }}</small>
													</td>

  												 @if($item->status == 0) 
												<td class="text-center"><a href="product-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-danger status_inactive" title="Change Status"><i class='fa fa-times'></i></a> </td>
											@else 
												<td class="text-center"> <a href="product-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-primary status-active" title="Change Status"><i class='fa fa-check'></i></a> </td>
											@endif
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('sweetalert::alert')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.status-toggle').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault(); // Stop default navigation
                const url = this.getAttribute('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to change the product status?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change it!',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url; // Redirect after confirm
                    }
                });
            });
        });
    });
</script>

													
													<td class="actions"> 
													
														<a href="/admin/product/product-edit/{{base64_encode($item->id)}}" class="btn ripple btn-info"> Edit </a>
														<a href="/admin/product/product-view/{{base64_encode($item->id)}}" class="btn ripple btn-warning"> View </a> 
										<a onclick="deleteProduct(event, '{{base64_encode($item->id)}}')" href="#" class="btn ripple btn-danger">
    <i class="fa fa-trash" aria-hidden="true"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Delete function
function deleteProduct(event, productId) {
    event.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/admin/product/delete-product/' + productId;
        }
    });
}

// Show toast if there's a success message
document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    @endif
});
</script>
														<!--
														<a href="#" onclick="GetParentId({{$item->id}})" data-toggle="modal" data-target="#ServerImageModal" class="btn ripple btn-primary"> Add Images </a> 
														-->
													</td>
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
		</div>
	</div>	
<!-- End Main Content-->


<!-- Add Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Add New Categories </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" class="row justify-content-md-center" action="/admin/product/category-add" enctype="multipart/form-data" >	
					<div class="col-xl-12 col-lg-12 col-md-12">
					@csrf									
						<div class="card shade">
							<div class="form-group">
								<label> Category Name : <span>*</span></label>
								<input name="type" value="1" type="hidden"/>
								<input name="category_name" value=""  class="form-control" data-role="tagsinput" placeholder="Category type and enter..." maxlength="255" type="text" id="category_name">							
							</div>
							<div class="form-group">
								<label> Category Description :</label>
								<input name="category_description" value="" class="form-control" placeholder="Category Description..." type="text" id="category_disc">							
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

<!-- Sorting Data -->
<div class="modal fade" id="sortingModal" tabindex="-1" aria-labelledby="sortingModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="sortingModalLabel">Sorting Table Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<ul id="changeTableDate">
					@foreach ($Products as $k=>$item)
					<li class="p-2 tableRow" width="20px" data-id="{{ $item->id }}"><span>{{$item->product_order}} </span><img src="{{($item->image != null) ? $item->image : '<img src="/admin/img/no_img_xl.jpg" />'}}" width="30px" /> {{$item->title}}</li>
					@endforeach
				</ul>
				<br/>
				<div class="modal-footer">
					<input type='button' class="btn btn-info btn-submit" value='Reload' id='reload' />
				</div>
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

$(document).ready(function() {
  var table = $("#data-table").DataTable({
    bSort: true,
    bFilter: true,
	stateSave: true,
    iDisplayStart: 0,
    iDisplayLength: 10,
    sPaginationType: "full_numbers",
    sDom: "Rfrtlip",
	"lengthChange": false
  });

  $('#cmsearch').on('keyup', function() {
    table.search(this.value).draw();
  });
});

</script>
<script>
	// Categories fatch dynamic
	var Categories = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: {
			url: '{{url("category-fetch")}}',
			filter: function(list) {
			return $.map(list, function(categoriesname) {
				return { name: categoriesname }; });
			}
		}
		});
		Categories.initialize();

		$('#category_name').tagsinput({
		typeaheadjs: {
			name: 'categoryname',
			displayKey: 'name',
			valueKey: 'name',
			source: Categories.ttAdapter()
		}
	});

// ------------------------------
const chooseFile = document.getElementById("choose-file");
const imgPreview = document.getElementById("img-preview");

chooseFile.addEventListener("change", function () {
  getImgData();
});

function getImgData() {
  const files = chooseFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      imgPreview.style.display = "block";
      imgPreview.innerHTML = '<img src="' + this.result + '" />';
    });    
  }
}
</script>

<script>
const input = document.getElementById('file-input');
const video = document.getElementById('video');
const videoSource = document.createElement('source');

input.addEventListener('change', function() {
  const files = this.files || [];

  if (!files.length) return;
  
  const reader = new FileReader();

  reader.onload = function (e) {
    videoSource.setAttribute('src', e.target.result);
    video.appendChild(videoSource);
	$('#video').addClass('hklhk');
    video.load();
    video.play();
  };
  
  reader.onprogress = function (e) {
    console.log('progress: ', Math.round((e.loaded * 100) / e.total));
  };
  
  reader.readAsDataURL(files[0]);
});

</script>
<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>
<script type="text/javascript">
	$(document).ready(function () {
		var dropIndex;
		$("#changeTableDate").sortable({
				update: function(event, ui) { 
					dropIndex = ui.item.index();
			}
		});

		$('#reload').click(function (e) {
			var productIdsArray = [];
			$('.tableRow').each(function (index) {
					var dataid = $(this).attr('data-id');
					productIdsArray.push(dataid);
			});

			$.ajax({
				type: "POST",
				dataType: "json",
				url: "/admin/product/product-sort",
					data: {
					order: productIdsArray,
					_token: "{{csrf_token()}}"
				},
				success: function(response) {
					if (response.status == "success") {
						console.log(response.message);
						location.reload();
					} else {
						console.log(response.message);
					}
				}
			});
		});
	});

</script>

@endsection
