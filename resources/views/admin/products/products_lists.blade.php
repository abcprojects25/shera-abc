@extends('admin.layouts.admin')

@section('content')
    <!-- Required CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/admin/master.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="/admin/style.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!-- Tagify CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        #edit-sortable-images li {
            cursor: grab;
        }

        .ui-state-highlight {
            height: 60px;
            background: #f0f0f0;
            border: 1px dashed #ccc;
        }
    </style>

    <div class="container mt-5">
        <h2>All Products</h2>
        <form method="GET" action="{{ route('admin.products.products_lists') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="Search products...">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Applications</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            @foreach(explode(',', $product->applications ?? '') as $tag)
                                <span class="badge bg-primary">{{ $tag }}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach($product->images as $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}" width="80" height="80">
                            @endforeach
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary edit-btn" data-id="{{ $product->id }}">Edit</a>
                            <a href="#" class="btn btn-danger delete-btn" data-id="{{ $product->id }}">delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No products found.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        <!-- Modal for Edit -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" id="editForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="product_id">

                            <div class="mb-3">
                                <label>Category</label>
                                <input type="text" name="category" id="category" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Applications</label>
                                <input type="text" name="applications" id="applications" class="form-control"
                                    placeholder="Type and press enter">
                            </div>
                            <div class="mb-3">
                                <label>Upload New Images</label>
                                <input type="file" name="new_images[]" class="form-control" multiple>
                            </div>
                            <div class="mb-3">
                                <label>Reorder Images</label>
                                <ul id="edit-sortable-images" class="list-group"></ul>
                                <input type="hidden" name="image_order" id="image_order">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

            });

            // jQuery UI sortable for images
            $('#edit-sortable-images').sortable({
                placeholder: "ui-state-highlight",
                handle: ".handle"
            });

            // Before form submit, capture image order
            $('#editForm').submit(function () {
                let order = [];
                $('#edit-sortable-images li').each(function () {
                    order.push($(this).data('id'));
                });
                $('#image_order').val(order.join(','));



            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.delete-btn').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const productId = this.dataset.id;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This will delete the product and its images!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/admin/products/${productId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Accept': 'application/json',
                                },
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        Swal.fire('Deleted!', data.message, 'success').then(() => {
                                            location.reload(); // Reload to remove the row
                                        });
                                    } else {
                                        Swal.fire('Error!', 'Something went wrong.', 'error');
                                    }
                                });
                        }
                    });
                });
            });
        });
    </script>

@endsection