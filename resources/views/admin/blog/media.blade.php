@extends('admin.layouts.app')
@section('content')
   

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <div class="main-content side-content pt-0" id="imagesModal">
        <div class="container-fluid">
            <div class="inner-body">
                <!-- Page Header -->
                <div class="page-header">
                    <h3>Media Library</h3>

                    <ul class="nav nav-tabs" id="mediaTabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#library">Media Library</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#upload">Upload Files</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            {{-- <a href="#" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#exampleModal"> <i class="fe fe-folder-plus mr-2"></i> Add New Categories </a>  --}}
                        </div>
                    </div>
<button type="button" class="close ml-auto" aria-label="Close" onclick="closeImagesModal()" style="font-size: 1.5rem;">
    <span aria-hidden="true">&times;</span>
</button>


                </div>
                <!-- End Page Header -->


                <!--Row-->
                <!-- Include CSRF Token -->
                <meta name="csrf-token" content="{{ csrf_token() }}">

                <!-- CSS & JS Dependencies -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
                <link href="https://cdn.jsdelivr.net/npm/dropzone@5/dist/min/dropzone.min.css" rel="stylesheet">

                <style>
                    .media-library-container {
                        display: flex;
                        flex-wrap: wrap;
                        gap: 2rem;
                        margin-top: 2rem;
                    }

                    .media-grid {
                        flex: 2;
                        display: grid;
                        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                        gap: 1rem;
                    }

                    .media-thumb {
                        border: 2px solid transparent;
                        padding: 4px;
                        transition: all 0.3s ease;
                        cursor: pointer;
                        width: 100%;
                        height: 150px;
                        object-fit: cover;
                        border-radius: 4px;
                    }

                    .media-thumb.active {
                        border-color: #007bff;
                        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.3);
                    }

                    .media-sidebar {
                        flex: 1;
                        min-width: 280px;
                    }

                    .media-preview-container {
                        border: 1px solid #dee2e6;
                        padding: 10px;
                        text-align: center;
                        position: relative;
                    }

                    .media-preview {
                        max-width: 100%;
                        max-height: 250px;
                        object-fit: contain;
                        margin-bottom: 10px;
                    }

                    .media-type-badge {
                        position: absolute;
                        top: 10px;
                        right: 10px;
                        background: rgba(0, 0, 0, 0.7);
                        color: white;
                        padding: 3px 8px;
                        border-radius: 3px;
                        font-size: 12px;
                    }

                    .url-copy-container {
                        margin-top: 20px;
                    }

                    /* Improved button styles */
                    #saveAltTextBtn {
                        background-color: #007bff;
                        color: white;
                        border: none;
                        padding: 8px 20px;
                        border-radius: 4px;
                        margin-top: 10px;
                        cursor: pointer;
                        transition: background-color 0.3s ease;
                    }

                    #saveAltTextBtn:hover {
                        background-color: #0056b3;
                    }

                    #delete-media {
                        background-color: #dc3545;
                        color: white;
                        border: none;
                        padding: 8px 20px;
                        border-radius: 4px;
                        margin-top: 15px;
                        cursor: pointer;
                        transition: background-color 0.3s ease;
                        width: 100%;
                    }

                    #delete-media:hover {
                        background-color: #c82333;
                    }
                </style>

                <div class="container-fluid mt-4">

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="library">
                            <div class="media-library-container mt-3">
                                <div class="media-grid" id="mediaGrid">
                                    @isset($mediaItems)
                                    @foreach ($mediaItems as $item)
                                        @php
                                            $url = asset('storage/media/' . $item->file_path);
                                            $type = strtoupper(pathinfo($item->file_path, PATHINFO_EXTENSION));
                                        @endphp
                                        <div class="media-item">
                                            <img src="{{ $url }}" class="media-thumb" data-id="{{ $item->id }}"
                                                data-url="{{ $url }}" data-alt="{{ $item->alt_text }}"
                                                data-type="{{ $type }}">
                                        </div>
                                    @endforeach
@endisset
                                </div>

                                <div class="media-sidebar border-left pl-3">
                                    <div id="emptyState" class="text-center py-5">
                                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                        <h5>No media selected</h5>
                                        <p class="text-muted">Click a media item to see details.</p>
                                    </div>

                                    <div id="mediaDetails" style="display: none;">
                                        <h5>Attachment Details</h5>
                                        <div class="media-preview-container position-relative">
                                            <img id="previewImg" class="media-preview" src="">
                                            <span id="mediaTypeBadge" class="media-type-badge"></span>
                                        </div>
                                        <form id="mediaDetailsForm" onsubmit="return false;">
                                            <div class="form-group">
                                                <label for="mediaAltInput">Alt Text</label>
                                                <input type="text" class="form-control" id="mediaAltInput"
                                                    autocomplete="off">
                                            </div>

                                            <button type="button" id="saveAltTextBtn">Save Alt Text</button>

                                            <div class="url-copy-container">
                                                <label for="mediaUrlInput">Media URL</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="mediaUrlInput" readonly>
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            id="copyUrlBtn">Copy</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <button id="delete-media" type="button">Delete Image</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="upload">
                            <form action="/admin/blog/store/media" method="POST" class="dropzone mt-3" id="mediaDropzone"
                                enctype="multipart/form-data">
                                @csrf
                                
                                <div class="dz-message">Drop files here or click to upload.</div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Scripts -->
                <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/dropzone@5/dist/min/dropzone.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <script>
                    const deleteMediaUrlTemplate = "{{ route('blog.destroy', ['media' => ':id']) }}";


                    $(document).ready(function() {
                        let selectedMediaId = null;

                        // Handle selecting a media thumbnail
                        $('.media-thumb').on('click', function() {
                            $('.media-thumb').removeClass('active');
                            $(this).addClass('active');

                            selectedMediaId = $(this).data('id');
                            const imageUrl = $(this).data('url');
                            const altText = $(this).data('alt') || '';
                            const fileType = $(this).data('type');

                            $('#previewImg').attr('src', imageUrl);
                            $('#mediaTypeBadge').text(fileType);
                            $('#mediaAltInput').val(altText);
                            $('#mediaUrlInput').val(imageUrl);

                            $('#emptyState').hide();
                            $('#mediaDetails').show();
                        });

                        // Copy media URL button
                        $('#copyUrlBtn').on('click', function() {
                            const urlInput = document.getElementById('mediaUrlInput');
                            urlInput.select();
                            document.execCommand('copy');
                            Swal.fire('Copied!', 'The media URL has been copied.', 'success');
                        });

                        // Save alt text AJAX
                        $('#saveAltTextBtn').on('click', function() {
                            if (!selectedMediaId) {
                                Swal.fire('Oops!', 'Please select a media item first.', 'warning');
                                return;
                            }
                            const altText = $('#mediaAltInput').val();

                            $.ajax({
                                url: `/admin/blog/edit/${selectedMediaId}/`,
                                method: 'POST',
                                data: {
                                    alt_text: altText,
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    _method: 'PUT' // Assuming Laravel expects PUT for update
                                },
                                success: function(response) {
                                    Swal.fire('Saved!', response.message || 'Alt text updated.', 'success');
                                    // Update data-alt attribute so it stays current without reload
                                    $('.media-thumb[data-id="' + selectedMediaId + '"]').data('alt',
                                        altText);
                                },
                                error: function(xhr) {
                                    let errorMsg = 'Failed to update alt text.';
                                    if (xhr.responseJSON && xhr.responseJSON.message) errorMsg = xhr
                                        .responseJSON.message;
                                    Swal.fire('Error!', errorMsg, 'error');
                                }
                            });
                        });

                        // Delete media AJAX
                        $('#delete-media').on('click', function() {
                            if (!selectedMediaId) {
                                Swal.fire('Oops!', 'Please select a media item to delete.', 'warning');
                                return;
                            }
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "This will permanently delete the image.",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#dc3545',
                                cancelButtonColor: '#6c757d',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: deleteMediaUrlTemplate.replace(':id', selectedMediaId),
                                        method: 'POST',
                                        data: {
                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                            _method: 'DELETE'
                                        },
                                        success: function(response) {
                                            Swal.fire('Deleted!', response.message ||
                                                'Image deleted.', 'success');

                                            // Remove the deleted image from grid
                                            const thumb = $('.media-thumb[data-id="' +
                                                selectedMediaId + '"]');
                                            thumb.closest('.media-item').remove();

                                            // Reset sidebar
                                            selectedMediaId = null;
                                            $('#mediaDetails').hide();
                                            $('#emptyState').show();
                                        },
                                        error: function(xhr) {
                                            let errorMsg = 'Failed to delete image.';
                                            if (xhr.responseJSON && xhr.responseJSON.message)
                                                errorMsg = xhr.responseJSON.message;
                                            Swal.fire('Error!', errorMsg, 'error');
                                        }
                                    });
                                }
                            });
                        });

                        // Initialize Dropzone
                        Dropzone.autoDiscover = false;
                        const dropzone = new Dropzone("#mediaDropzone", {
                            paramName: "file",
                            maxFilesize: 10, // MB
                            acceptedFiles: "image/*,video/*",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(file, response) {
                                Swal.fire('Uploaded!', 'File has been uploaded successfully.', 'success');
                                // Optionally reload or append newly uploaded item dynamically
                                setTimeout(() => location.reload(), 1000);
                            },
                            error: function(file, response) {
                                let message = typeof response === "string" ? response : (response.message ||
                                    "Upload failed.");
                                Swal.fire('Error!', message, 'error');
                            }
                        });
                    });
                </script>

                <!-- Row end -->
            </div>
        </div>
    </div>
    <!-- End Main Content-->

    <!-- ===== ===== -->

    <link href="/admin/css/tagsinput.css" rel="stylesheet" type="text/css">
    <script src="/admin/js/typeahead.bundle.min.js"></script>
    <script src="/admin/js/tagsinput.js"></script>

    <!-- Croper Model  -->
    <div id="myModal121" class="modal fade " role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Blog Thumbnail </h4>
                    <button type="button" style=" "class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <div id="upload-demo"></div>
                    <button class="btn btn-success upload-result" data-dismiss="modal">Crop</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Import Trumbowyg -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"></script>
    <script>
        $('#new-editor').trumbowyg();
    </script>


    <script>
        const chooseFile = document.getElementById("choose-file");
        const imgPreview = document.getElementById("img-preview");

        chooseFile.addEventListener("change", function() {
            getImgData();
        });

        function getImgData() {
            const files = chooseFile.files[0];
            if (files) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(files);
                fileReader.addEventListener("load", function() {
                    imgPreview.style.display = "block";
                    imgPreview.innerHTML = '<img src="' + this.result + '" />';
                });
            }
        }

        function openMediaModal() {
    document.getElementById('imagesModal').style.display = 'block';

    // Push state so that "back" works
    history.pushState({ modalOpen: true }, '', '?media=true');
}


window.addEventListener('popstate', function (event) {
    // If modal is open, hide it
    if (document.getElementById('imagesModal').style.display === 'block') {
        document.getElementById('imagesModal').style.display = 'none';
    }
});

    </script>

    <script src="{{ asset('/admin/js/croppie.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $uploadCrop = $('#upload-demo').croppie({
            enableExif: true,
            viewport: {
                width: 526,
                height: 275,
                type: 'box'
            },
            boundary: {
                width: 546,
                height: 295
            }
        });

        $('#upload').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('.upload-result').on('click', function(ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {
                $('.hidden-image-data').val(resp);
                $("#imgid").show();
                // $("#imgid1").show();
                document.getElementById("imgid").src = resp;
                document.getElementById("save_button").disabled = false;
                // $("#save_button").show();
            });
        });

        function editImage() {
            $("#upload").click();
        }
        // -----------------------------------
    </script>


    <script src="/admin/js/bloodhound.min.js"></script>



    <script>
        function ArticleNameurl() {
            // alert(s_data.length);
            s_name = document.getElementById("blog_name").value;
            // $('#ArticleName').val();
            dlenth = s_name.length;
            //alert(s_name);
            var seourl = s_name.toString() // Convert to string
            seourl = seourl.normalize('NFD') // Change diacritics
            seourl = seourl.replace(/[\u0300-\u036f]/g, '') // Remove illegal characters
            seourl = seourl.replace(/\s+/g, '-') // Change whitespace to dashes
            seourl = seourl.toLowerCase() // Change to lowercase
            seourl = seourl.replace(/&/g, '-and-') // Replace ampersand
            seourl = seourl.replace(/[^a-z0-9\-]/g, '') // Remove anything that is not a letter, number or dash
            seourl = seourl.replace(/-+/g, '-') // Remove duplicate dashes
            seourl = seourl.replace(/^-*/, '') // Remove starting dashes
            seourl = seourl.replace(/-*$/, '');
            //alert(seourl);

            document.getElementById("blog_url").value = seourl;
        }

        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });

            });
        });

        // Categories fatch dynamic
        var Categories = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: '{{ url('category-fetch') }}',
                filter: function(list) {
                    return $.map(list, function(categoriesname) {
                        return {
                            name: categoriesname
                        };
                    });
                }
            }
        });
        Categories.initialize();

        $('#search_categories').tagsinput({
            typeaheadjs: {
                name: 'categoryname',
                displayKey: 'name',
                valueKey: 'name',
                source: Categories.ttAdapter()
            }
        });

        // Tags fetch dynamic
        var Tags = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: '{{ url('tag-fetch') }}',
                filter: function(list) {
                    return $.map(list, function(tagsname) {
                        return {
                            name: tagsname
                        };
                    });
                }
            }
        });
        Tags.initialize();

        $('#search_tags').tagsinput({
            typeaheadjs: {
                name: 'tagname',
                displayKey: 'name',
                valueKey: 'id',
                source: Tags.ttAdapter()
            }
        });

        
    function closeImagesModal() {
history.back();    }


    </script>
@endsection
