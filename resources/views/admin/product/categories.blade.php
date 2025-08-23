@extends('admin.layouts.app')
@section('content')
<?php use App\Http\Controllers\admin\ProductController; ?>
<!-- ===== ===== --> 

<!-- //sample msg -->
	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5"> Product Categories </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Product Categories</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center"> 
							<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#categoriesaddmodal"> <i class="fe fe-folder-plus mr-2"></i> Add New Categories </a> 
							<a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#subcategoriesaddmodal"> <i class="fe fe-folder-plus mr-2"></i> Add New Sub-Categories </a> 
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
								<a href="#" class="btn ripple btn-info" data-toggle="modal" data-target="#sortingModal"> Sorting </a>
								<br/><br/>
								<div class="table-responsive">
									<table class="table table-bordered mg-b-0">
										<tr> 
											<th style="width:50px">Id</th>
											<th class="sort" style="width:120px"> Created At </th>
											<th class="sort">Categories</th> 
											<th class="sort">Categorie Description</th> 
											<th class="sort">Sub Category</th> 
                                            <th class="sort text-center">Applications</th> 
	                                        <th class="sort text-center">Images</th> 
											<th class="text-center sort" style="width:100px"> Status </th>
											<th> Actions </th>
										</tr> 
										@foreach ($Categories as $k=>$item)
										<tr> 
											<td class="text-center">{{$Categories->firstItem() + $k}} </td>
											<td> {{date('d M Y',strtotime($item->created_at))}}<br> <small class="text-muted">{{date('H:i:A',strtotime($item->created_at))}}</small> </td> 
											<td> {{$item->name}}</td>
                                            <td> {{ \Illuminate\Support\Str::limit($item->description, 50) }}</td>
					<td>
    @php
        $subcategories = ProductController::FetchSubCategories($item->id);
    @endphp

    @if($subcategories->isEmpty())
        <span class="text-muted">No Subcategories</span>
    @else
        <ul class="list-unstyled mb-0" style="max-height: 150px; overflow-y: auto; padding-left: 10px;">
            @foreach($subcategories as $sub)
                <li style="margin-bottom: 6px;" class="btn btn-primary">{{ $sub->name }}</li>
            @endforeach
        </ul>
    @endif
</td>
<!-- Add Applications Button -->
<td class="text-center">
    @php
        $applications = \App\Models\admin\CategoryApplication::where('category_id', $item->id)->get();
    @endphp
    <div>
        @if($applications->isNotEmpty())
            <ul class="list-unstyled mt-2 mb-2" style="max-height: 120px; overflow-y: auto;">
                @foreach($applications as $app)
                    <li class="badge badge-info mb-1">{{ $app->name }}
                         <button type="button" 
                    class="btn btn-sm btn-warning" 
                    data-toggle="modal" 
                    data-target="#editApplicationModal" 
                    onclick="openEditAppModal({{ $app->id }}, '{{ $app->name }}', '{{ $app->alt_text }}')">
                Edit
            </button>
                    </li>
                @endforeach
            </ul>
        @else
            <span class="text-muted d-block mt-2 mb-2">No Applications</span>
        @endif
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addApplicationModal" onclick="openAppModal({{ $item->id }})">
            Add Application
        </button>
    </div>
</td>


<!-- Add Images Button -->
<td class="text-center">
    @php
        $categoryImages = \App\Models\admin\CategoryImage::where('category_id', $item->id)->get();
    @endphp
    @if($categoryImages->isNotEmpty())
        <ul class="list-unstyled mb-2" style="max-height: 120px; overflow-y: auto;">
            @foreach($categoryImages as $img)
                <li class="badge badge-info mb-1">
                    {{ basename($img->image_path) }}
                </li>
            @endforeach
        </ul>
    @else
        <span class="text-muted d-block"></span>
    @endif
    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addCategoryImageModal" data-category="{{ $item->id }}">
        Add Images
    </button>
</td>

											@if($item->status == 0)
												<td class="text-center"><a href="product-categories-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-danger status_inactive" title="Change Status"><i class='fa fa-times'></i></a> </td>
											@else 
												<td class="text-center"><a href="product-categories-status/{{base64_encode($item->status)}}/{{base64_encode($item->id)}}" class="btn btn-primary status-active" title="Change Status"><i class='fa fa-check'></i></a> </td>
											@endif			
											<td class="actions">
												<a href="#" class="btn ripple btn-info" onclick='editDetails("{{$item->id}}","{{$item->name}}","{{$item->status}}","{{$item->description}}","{{asset($item->category_img)}}")' data-toggle="modal" data-target="#categorieseditmodal"> Edit </a>
												<a onclick="return confirm('Are you sure?')" href="product-categories-delete/{{base64_encode($item->id)}}" class="btn ripple btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
											</td>
										</tr>
										@endforeach
									</table>
									{{$Categories->links()}}
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


<!-- Add Categories -->
<div class="modal fade" id="categoriesaddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Add New Categories </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form method="POST" class="row justify-content-md-center" action="/admin/product/category-add" enctype="multipart/form-data">	
    <div class="col-xl-12 col-lg-12 col-md-12">
        @csrf									
        <div class="card shade">
            <div class="form-group">
                <label>Category Name : <span>*</span></label>
                <input name="edit_id" value="0" type="hidden"/>
                <input name="type" value="1" type="hidden"/>
                <input 
                    name="category_name" 
                    value=""  
                    class="form-control" 
                    placeholder="Category Name..." 
                    data-role="tagsinput" 
                    maxlength="255" 
                    type="text" 
                    id="category_name"
                >
            </div>
            
            <input type="hidden" value="" name="seourl" id="seourl">

            <div class="form-group">
                <label>Category Description :</label>
                <input name="category_description" value="" class="form-control" placeholder="Category Description..." type="text" id="category_disc">							
            </div>

            <div class="form-group">
                <label>Add Image:</label>
                <input type="file" name="category_img" class="form-control-file" id="edit_category_img" accept="image/*">
                <small class="form-text text-muted">Leave blank to keep current image</small>
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
        </div> 
    </div>  
</form>

<script>
// Simple slugify function to create SEO-friendly URLs
function slugify(text) {
    return text.toString().toLowerCase()
        .trim()
        .replace(/[\s\W-]+/g, '-') // Replace spaces and non-word chars with hyphen
        .replace(/^-+|-+$/g, '');  // Remove leading and trailing hyphens
}

// Listen for input changes on category_name field
document.getElementById('category_name').addEventListener('input', function() {
    let inputVal = this.value;

    // If multiple categories are entered separated by commas, just take the first for seourl
    let firstCategory = inputVal.split(',')[0].trim();

    // Generate slug and set it to hidden seourl input
    document.getElementById('seourl').value = slugify(firstCategory);
});
</script>

				
			</div> 
		</div>
	</div>
</div>

<!-- Edit Categories -->
<div class="modal fade" id="categorieseditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Edit Categories </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="row justify-content-md-center" action="/admin/product/category-edit" enctype="multipart/form-data" id="categoryEditForm">    
                    <div class="col-xl-12 col-lg-12 col-md-12">
                    @csrf            
                        <div class="card shade">
                            <div class="form-group area_interest">
                                <label> Categories </label>
                                <select name="category_id[]" id="multiple-checkboxes" class="custom-select w-100" multiple="multiple">
                                    @foreach ($Category_list as $item)
                                        <option value="{{$item->id}}"> {{$item->name}} </option>
                                    @endforeach 
                                </select>
                            </div>

                            <div class="form-group">
                                <label> Category Name : <span>*</span></label>
                                <input name="edit_id" id="edit_id" value="0" type="hidden"/>
                                <input name="type" value="1" type="hidden"/>
                                <input name="edit_category_name" value="" class="form-control" placeholder="Category Name..." maxlength="255" type="text" id="edit_category_name">
                            </div>
                            <div class="form-group">
                                <label> Category Description :</label>
                                <input name="category_description" value="" class="form-control" placeholder="Category Description..." type="text" id="edit_category_disc">                            
                            </div>
                            
                            <!-- Image display and upload section -->
                            <div class="form-group">
                                <label>Current Image:</label>
                                <div class="mb-2">
                                    <img id="current_category_img" src="" alt="Category Image" style="max-width: 200px; max-height: 200px; display: none;">
                                    <input type="hidden" id="existing_image" name="existing_image" value="">
                                </div>
                                <label>Change Image:</label>
                                <input type="file" name="category_img" class="form-control-file" id="edit_category_img" accept="image/*">
                                <small class="form-text text-muted">Leave blank to keep current image</small>
                            </div>
                            
                            <div class="form-group">
                                <label>Status </label>
                                <select name="is_active_edit" id="is_active_edit" class="custom-select w-100">
                                    <option value="1">Active</option>
                                    <option value="0">In Active</option>
                                </select>
                            </div>
                            <div class="submit">
                                <input class="btn btn-primary w-100" type="submit" value="Edit Now">  
                            </div> 
                        </div> <!-- --> 
                    </div> <!-- -->  
                </form>
            </div> 
        </div>
    </div>
</div>


<!-- Add Application Modal -->
<div class="modal fade" id="addApplicationModal" tabindex="-1" role="dialog" aria-labelledby="addApplicationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('store.application') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="category_id" id="application_category_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div id="application-fields-wrapper">
                    <!-- Initial Application Block -->
                    <div class="application-block border rounded p-2 mb-3">
                        <div class="form-group">
                            <label>Application Name</label>
                            <input type="text" name="name[]" class="form-control" required>
                        </div>
                      
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image[]" class="form-control-file">
                        </div>

                        <div class="form-group">
                            <label>Icon</label>
                            <input type="file" name="icon[]" class="form-control-file">
                        </div>
                          <div class="form-group">
                            <label>Alt Text</label>
                            <input type="text" name="alt_text[]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
    							<textarea name="desc" class="form-control" id="desc" placeholder="Description..."></textarea>
                        </div>       
                        <button type="button" class="btn btn-danger btn-sm remove-block d-none">Remove</button>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary btn-sm" onclick="addApplicationBlock()">Add More</button>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Applications</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Edit Application Modal -->
<div class="modal fade" id="editApplicationModal" tabindex="-1" role="dialog" aria-labelledby="editApplicationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('update.application') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="application_id" id="edit_application_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Application Name</label>
                    <input type="text" name="name" id="edit_application_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Image (Leave empty if not changing)</label>
                    <input type="file" name="image" class="form-control-file">
                </div>

                <div class="form-group">
                    <label>Icon (Leave empty if not changing)</label>
                    <input type="file" name="icon" class="form-control-file">
                </div>

                <div class="form-group">
                    <label>Alt Text</label>
                    <input type="text" name="alt_text" id="edit_application_alt_text" class="form-control">
                </div>
                <div class="form-group">
                   <label>Description</label>
    				<textarea name="desc" class="form-control" id="edit_application_desc" placeholder="Description..."></textarea>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Application</button>
            </div>
        </div>
    </form>
  </div>
</div>
<script>
function openEditAppModal(id, name, alt_text, desc) {
    document.getElementById('edit_application_id').value = id;
    document.getElementById('edit_application_name').value = name;
    document.getElementById('edit_application_alt_text').value = alt_text;
    document.getElementById('edit_application_desc').value = desc;
}
</script>



<!-- Add Category Image Modal -->
<div class="modal fade" id="addCategoryImageModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="categoryImageForm" action="{{ route('admin.category_images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category_id" id="categoryImageCategoryId">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div id="image-upload-group">
                        <div class="row mb-3 image-group">
                            <div class="col-md-6">
                                <input type="file" name="images[]" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="alt[]" class="form-control" placeholder="Alt text (optional)">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary" id="addMoreImages">+ Add More</button>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Images</button>
                </div>
            </div>
        </form>
    </div>
</div>

   <script>
    function openAppModal(categoryId) {
        document.getElementById('application_category_id').value = categoryId;
    }

    function addApplicationBlock() {
        let wrapper = document.getElementById('application-fields-wrapper');
        let block = wrapper.querySelector('.application-block');
        let newBlock = block.cloneNode(true);
        // Clear input values
        newBlock.querySelectorAll('input').forEach(input => input.value = '');
        newBlock.querySelector('.remove-block').classList.remove('d-none');
        wrapper.appendChild(newBlock);
    }

    // Event delegation to handle remove
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-block')) {
            e.target.closest('.application-block').remove();
        }
    });
</script>
<script>
    $('#addCategoryImageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var categoryId = button.data('category');
        $('#categoryImageCategoryId').val(categoryId);
    });

    // Add more image+alt input fields
    $('#addMoreImages').click(function () {
        $('#image-upload-group').append(`
            <div class="row mb-3 image-group">
                <div class="col-md-6">
                    <input type="file" name="images[]" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="alt[]" class="form-control" placeholder="Alt text (optional)">
                </div>
            </div>
        `);
    });
</script>

<script>
function editDetails(id, name, status, description, imageUrl) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_category_name').value = name;
    document.getElementById('edit_category_disc').value = description;
    document.getElementById('is_active_edit').value = status;
    document.getElementById('existing_image').value = imageUrl;
    
    // Handle the image display
    const imgElement = document.getElementById('current_category_img');
    if (imageUrl) {
        imgElement.src = imageUrl;
        imgElement.style.display = 'block';
    } else {
        imgElement.style.display = 'none';
    }
}

// Preview new image when selected
document.getElementById('edit_category_img').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const imgElement = document.getElementById('current_category_img');
            imgElement.src = event.target.result;
            imgElement.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

// Reset form when modal is closed
$('#categorieseditmodal').on('hidden.bs.modal', function () {
    document.getElementById('categoryEditForm').reset();
    const imgElement = document.getElementById('current_category_img');
    imgElement.style.display = 'none';
    imgElement.src = '';
});
</script>

<!-- Add Sub Categories -->
<div class="modal fade" id="subcategoriesaddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Add New Sub-Categories </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" class="row justify-content-md-center" action="/admin/product/subcategory-add" enctype="multipart/form-data">	
    <div class="col-xl-12 col-lg-12 col-md-12">
        @csrf									
        <div class="card shade">
            <div class="form-group">
    <label> Categories <span>*</span></label>
    <select name="category_id" id="categoryDropdown" class="custom-select w-100" required>
        <option selected disabled> --Select Category-- </option>
        @foreach ($Categories as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>


            <div class="form-group">
                <label>Subcategory Name : <span>*</span></label>
                <input name="type" value="1" type="hidden"/>
                <input 
                    name="subcategory_name" 
                    value=""  
                    class="form-control" 
                    placeholder="Subcategory Name..." 
                    data-role="tagsinput" 
                    maxlength="255" 
                    type="text" 
                    id="subcategory_name"
                >
            </div>

            <input type="hidden" name="seourl" id="seourl_subcategory" value="">

            <div class="form-group">
                
                <label>Upload Image:</label>
                <input type="file" name="category_img" class="form-control-file" id="category_img" accept="image/*">
                <!-- <small class="form-text text-muted">Leave blank to keep current image</small> -->
            </div>

            <div class="form-group">
                <label>Subcategory Description :</label>
                <input name="subcategory_description" value="" class="form-control" placeholder="Subcategory Description..." type="text" id="subcategory_disc">							
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
        </div> 
    </div>  
</form>

<script>
function slugify(text) {
    return text.toString().toLowerCase()
        .trim()
        .replace(/[\s\W-]+/g, '-') // replace spaces and non-word characters with hyphen
        .replace(/^-+|-+$/g, '');  // trim hyphens from start and end
}

document.getElementById('subcategory_name').addEventListener('input', function() {
    let inputVal = this.value;
    let firstSubcat = inputVal.split(',')[0].trim();
    document.getElementById('seourl_subcategory').value = slugify(firstSubcat);
});
</script>

			</div> 
		</div>
	</div>
</div>

<!-- Sorting Data -->
<div class="modal fade" id="sortingModal" tabindex="-1" aria-labelledby="sortingModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="sortingModalLabel">Sorting Categories Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<ul id="changeTableDate">
					@foreach ($Category_list as $k=>$item)
					<li class="p-2 tableRow" width="20px" data-id="{{ $item->id }}"><span class="mr-2">{{$item->category_order}} </span> {{$item->name}}</li>
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
<link href="/admin/css/tagsinput.css" rel="stylesheet" type="text/css">
<script src="/admin/js/typeahead.bundle.min.js"></script> 
<script src="/admin/js/tagsinput.js"></script>
<script type="text/javascript" src="/admin/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
		  enableFiltering: true,
		  enableCaseInsensitiveFiltering: true,
		  maxHeight: 250
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

		// $('#edit_category_name').tagsinput({
		// 	typeaheadjs: {
		// 		name: 'categoryname',
		// 		displayKey: 'name',
		// 		valueKey: 'name',
		// 		source: Categories.ttAdapter()
		// 	}
		// });

	// 
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

		$('#subcategory_name').tagsinput({
		typeaheadjs: {
			name: 'categoryname',
			displayKey: 'name',
			valueKey: 'name',
			source: Categories.ttAdapter()
		}
	});

function editDetails(id, name, status, description, imageUrl) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_category_name').value = name;
    document.getElementById('edit_category_disc').value = description;
    document.getElementById('is_active_edit').value = status;
    
    // Handle the image display
    const imgElement = document.getElementById('current_category_img');
    if (imageUrl) {
        imgElement.src = imageUrl;
        imgElement.style.display = 'block';
    } else {
        imgElement.style.display = 'none';
    }
}
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
			var categoryIdsArray = [];
			$('.tableRow').each(function (index) {
					var dataid = $(this).attr('data-id');
					categoryIdsArray.push(dataid);
			});
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "/admin/product/product-category-sort",
					data: {
					order: categoryIdsArray,
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
