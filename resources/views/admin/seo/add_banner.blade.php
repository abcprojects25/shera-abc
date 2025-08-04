@extends('admin.layouts.app')
@section('content')
    <?php use App\Http\Controllers\Admin\SeoController;
    $urls_list = SeoController::UrlsList();
    
    ?>

    <!-- ===== ===== -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .btn-color-btn {
            background: #6259ca;
        }

        a.nav-sub-link {
            text-decoration: none;
        }
    </style>
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5"> Add Banner </h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Search Engine Listing</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Baner</li>
                        </ol>
                    </div>
                    {{-- <div class="d-flex">
						<div class="justify-content-center">
							<a href="/admin/seo/add-url" class="btn btn-white btn-icon-text my-2 mr-2"> <i class="fe fe-folder-plus mr-2"></i> Add New SEO URL </a> 
						</div>
					</div> --}}
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
                                <!-- Trigger Button -->
                                <button type="button" class="btn btn-primary btn-color-btn" data-bs-toggle="modal"
                                    data-bs-target="#createBannerModal">
                                    Add New Banner URL
                                </button>

                                <div class="">
                                    {{-- <form method="POST" class="row justify-content-md-center" action="/admin/seo/store" 
									enctype="multipart/form-data" >	
										<div class="col-xl-9 col-lg-9 col-md-9">
										@csrf									
											<div class="card shade">
												<div class="row">
													<div class="col-lg-12 col-md-12 form-group">
													
														<label>Page Urls List : <span>*</span></label>
														<select name="url_id" class="form-control w-100" id="urls_list" onchange="getPageName(this)" required>
															@foreach ($urls_list as $item)

																<option value="{{$item->id}}" data-id="{{$item->urls}}">{{$item->page_name}}  ( {{ $item->urls }} )</option>
															@endforeach
														</select> 
													</div><br/>
												</div>
												<div class="row">
													<div class="col-lg-5 col-md-5 form-group">
														<label> Page Name </label>
														<input name="page_name" value=""  class="form-control" placeholder="Page Name..." type="text" id="page_name" readonly>
													</div> 
													<div class="col-lg-7 col-md-7 form-group">
														<label>Page URL : <span>*</span></label>
														<div class="input-group mb-2"> 
															<div class="input-group-prepend"> <div class="input-group-text">https://aaplsolutions.com/</div> </div>
															<input name="page_url" value="" required="" class="form-control"  maxlength="255" type="text" id="page_url" readonly>
														</div>
													</div>
												</div> 
												<div class="row">
													<div class="col-lg-12 col-md-5 form-group">
														<label>Page Title / Meta : <span>*</span></label>
														<input name="page_title" value=""  class="form-control" placeholder="Page Title..." maxlength="255" type="text" id="title">
													</div>  
												</div>
												<div class="form-group">
													<label>Meta Keywords : <span>*</span></label>
													<input name="meta_keywords" value=""  class="form-control" placeholder="Meta Keywords..." maxlength="255" type="text" id="meta_keywords">
													<small> 100 to 255 Keywords used </small>
												</div> 
												<div class="form-group">
													<label for="meta_description">Meta Description </label>
													<textarea name="meta_description" class="form-control" cols="10" rows="2" id="meta_description" placeholder="Meta Description..."> </textarea>
													<small> 155 to 160 Keywords used </small>
												</div> 

												<div class="form-group meta_tag_script">
													<label for="meta_tag_script">Meta tags (HTML) </label>
													<textarea name="meta_tag_script" class="form-control" cols="10" rows="10" id="meta_tag_script" placeholder="Meta tags script..."> </textarea>
													<small> Paste Your Tags here only html Tags </small> 
												</div>

												<div class="form-group meta_tag_script">
													<label for="meta_tag_script_header">Meta Script (JS Script) </label>
													<textarea name="meta_tag_script_header" class="form-control" cols="10" rows="10" id="meta_tag_script_header" placeholder="Meta tags script..."> </textarea>
													<small> Paste Your Tags With < script > Tags </small> 
												</div>
												
											<!--	<div class="form-group">
													<label for="language" class="mr-3"><b>Language:</b> </label>
													<label class="form-check-label ml-4">
														<input type="checkbox" name="language[]" class="form-check-input" value="en" checked required>English
													</label>
													<label class="form-check-label ml-4">
														<input type="checkbox" name="language[]" class="form-check-input" value="es">Spanish
													</label>
													  <label class="form-check-label ml-4">
														<input type="checkbox" name="language[]" class="form-check-input" value="ar">Arabic
													</label>
													<label class="form-check-label ml-4">
														<input type="checkbox" name="language[]" class="form-check-input" value="sw">Swahili
													</label>
													  <label class="form-check-label ml-4">
														<input type="checkbox" name="language[]" class="form-check-input" value="fr">French
													</label>
												</div> 
											-->

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
									</form>  --}}

                                    <form method="POST" action="/admin/seo/banner/url/store" enctype="multipart/form-data"
                                        class="row justify-content-md-center">
                                        @csrf
                                        <div class="col-xl-9">
                                            <div class="card p-4">

                                                <div class="mb-3">
                                                    <label for="banner_url_id" class="form-label">Select Page URL <span
                                                            class="text-danger">*</span></label>
                                                    <select name="banner_url_id" class="form-select" required>
                                                        <option value="">-- Select --</option>
                                                        @foreach ($urls as $url)
                                                            <option value="{{ $url->id }}">{{ $url->page_name }}
                                                                ({{ $url->page_url }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Upload Banner Image <span
                                                            class="text-danger">*</span></label>
                                                    <input type="file" name="image" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary w-100 btn-color-btn">Upload
                                                    Banner</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="container mt-4">


                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Page Name</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($banners as $banner)
                                            <tr>
                                                <td>{{ $banner->bannerUrl->page_name ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($banner->image)
                                                        <img src="{{ asset('banners/' . $banner->image) }}" width="100">
                                                    @else
                                                        No image
                                                    @endif
                                                </td>
                                                <td>{{ $banner->status ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                    <form action="{{ url('/admin/seo/banner/delete/' . $banner->id) }}"
                                                        method="POST" onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm ">Delete</button>
                                                    </form>

                                                    <!-- Edit Button -->
                                                    <button class="btn btn-primary btn-sm mt-1 btn-color-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editBannerModal{{ $banner->id }}">
                                                        Edit
                                                    </button>


                                                    <div class="modal fade" id="editBannerModal{{ $banner->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="editBannerModalLabel{{ $banner->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-md modal-dialog-centered">
                                                            <div class="">
                                                                <form method="POST"
                                                                    action="{{ url('/admin/seo/banner/update/' . $banner->id) }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('POST')

                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Edit Banner</h5>
                                                                            <button type="button"
                                                                                class="btn-close btn-color-btn"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>

                                                                         <div class="modal-body">
                                                                            {{-- Page Name --}}
                                                                            <div class="mb-3">
                                                                                <label>Edit Page Name</label>
                                                                                <input type="text" name="page_name"
                                                                                    class="form-control"
                                                                                    value="{{ $banner->bannerUrl->page_name ?? '' }}"
                                                                                    required>
                                                                            </div>

                                                                            {{-- Page URL --}}
                                                                            <div class="mb-3">
                                                                                <label>Edit Page URL</label>
                                                                                <input type="text" name="page_url"
                                                                                    class="form-control"
                                                                                    value="{{ $banner->bannerUrl->page_url ?? '' }}"
                                                                                    required>
                                                                            </div>

                                                                            {{-- Current Image --}}
                                                                            <div class="mb-3">
                                                                                <label>Current Image:</label><br>
                                                                                @if ($banner->image)
                                                                                    <img src="{{ asset('banners/' . $banner->image) }}"
                                                                                        width="100" class="mb-2">
                                                                                @endif
                                                                                <input type="file" name="image"
                                                                                    class="form-control">
                                                                                <small>Leave blank to keep existing
                                                                                    image</small>
                                                                            </div>

                                                                            {{-- Status --}}
                                                                            <div class="mb-3">
                                                                                <label>Status</label>
                                                                                <select name="status"
                                                                                    class="form-select">
                                                                                    <option value="1"
                                                                                        {{ $banner->status == 1 ? 'selected' : '' }}>
                                                                                        Active</option>
                                                                                    <option value="0"
                                                                                        {{ $banner->status == 0 ? 'selected' : '' }}>
                                                                                        Inactive</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-success btn-color-btn">Update</button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- JS to auto-fill editable URL input --}}
                                                    <script>
                                                        function updatePageUrlInput{{ $banner->id }}(select) {
                                                            const selectedOption = select.options[select.selectedIndex];
                                                            const pageUrl = selectedOption.getAttribute('data-url');
                                                            document.getElementById('pageUrlInput{{ $banner->id }}').value = pageUrl;
                                                        }
                                                    </script>
                                                </td>


                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No banners found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- <!-- Edit Modal -->
                            <div class="modal fade" id="editBannerModal{{ $banner->id }}" tabindex="-1"
                                aria-labelledby="editBannerModalLabel{{ $banner->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ url('/admin/seo/banner/update/' . $banner->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Banner</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Select Page URL</label>
                                                    <select name="banner_url_id" class="form-select" required>
                                                        @foreach ($urls as $url)
                                                            <option value="{{ $url->id }}"
                                                                {{ $banner->banner_url_id == $url->id ? 'selected' : '' }}>
                                                                {{ $url->page_name }} ({{ $url->page_url }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Current Image:</label><br>
                                                    @if ($banner->image)
                                                        <img src="{{ asset('banners/' . $banner->image) }}" width="100"
                                                            class="mb-2">
                                                    @endif
                                                    <input type="file" name="image" class="form-control">
                                                    <small>Leave blank to keep existing image</small>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="1"
                                                            {{ $banner->status == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0"
                                                            {{ $banner->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Update</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}





                            <!-- Modal -->
                            <div class="modal fade" id="createBannerModal" tabindex="-1"
                                aria-labelledby="createBannerModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered">
                                    <div class="modal-content">
                                        <form method="POST" action="/admin/seo/banner/store">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createBannerModalLabel">Create Banner URL</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label for="page_name" class="form-label">Page Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="page_name"
                                                        name="page_name" placeholder="Enter Page Name" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="page_url" class="form-label">Page URL <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">https://aaplsolutions.com/</span>
                                                        <input type="text" class="form-control" id="page_url"
                                                            name="page_url" placeholder="page-url" required>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-select" id="status" name="status">
                                                        <option value="1" selected>Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Save</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                            </div>

                                        </form>
                                    </div>
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
    <!--
                            <link href="/admin/css/select2.min.css" rel="stylesheet" />
                            <script src="/admin/js/select2.min.js"></script>
                            -->
    <script>
        $(document).ready(function() {
            $('#urls_list').select2();
        });

        function getPageName(sel) {
            var page_name = sel.options[sel.selectedIndex].text
            var page_url = $('#urls_list').find(':selected').attr('data-id')
            $('#page_name').val(page_name);
            $('#page_url').val(page_url);
        }
    </script>

    @include('admin.layouts.footer')
@endsection
