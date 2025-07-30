@extends('admin.layouts.admin')
@section('content')

    <main id="main_content">
        <div class="breadcrumb_container">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="/"><i class="fas fa-home"></i> Dashboard </a></li>
                    <span class="pl-2"> / </span>
                    <li><a href=""><i class="fas fa-tasks-alt"></i> Product</a></li>
                </ul>
            </div>
        </div>

        <div class="container main_container">
            <h1 class="product-heading">ADD New Product</h1>
            <div class="product_container">
                <form id="product-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label>Category*:</label>
                            <input type="text" name="category" class="form-control" required maxlength="50">
                            <small class="text-danger error-message"></small>
                        </div>

                        <div class="col-md-3">
                            <label>Name*:</label>
                            <input type="text" name="name" class="form-control" required maxlength="100">
                            <small class="text-danger error-message"></small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Applications*:</label>
                            <input type="text" name="applications" id="applications-input" class="form-control" required
                                maxlength="100">
                            <small class="text-danger error-message"></small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Description:</label>
                            <textarea name="description" rows="4" class="form-control" maxlength="500"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-black font-medium px-6 py-2 rounded">
                                Add Product
                            </button>
                        </div>
                    </div>

                    <div class="row img_container">
                        <div class="col-md-6">
                            <label>Upload Images:</label>
                            <input type="file" name="images[]" multiple accept="image/*" id="image-input"
                                class="form-control">
                            <ul id="file-list" class="mt-2 text-sm text-gray-600 list-disc list-inside"></ul>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </main>

    {{-- Tagify CSS & JS --}}
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script>
        document.getElementById('product-form').addEventListener('submit', function (e) {
            const form = e.target;
            let isValid = true;

            form.querySelectorAll('.error-message').forEach(el => el.innerText = '');

            form.querySelectorAll('input[required], textarea[required]').forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.nextElementSibling.innerText = 'This field is required.';
                } else if (input.hasAttribute('maxlength') && input.value.length > input.maxLength) {
                    isValid = false;
                    input.nextElementSibling.innerText = `Maximum length is ${input.maxLength} characters.`;
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>

    <script>
        // Tagify init
        const input = document.querySelector('#applications-input');
        new Tagify(input);

        // Show selected image file names
        const fileInput = document.getElementById('image-input');
        const fileList = document.getElementById('file-list');

        fileInput.addEventListener('change', function () {
            fileList.innerHTML = '';
            Array.from(fileInput.files).forEach(file => {
                const li = document.createElement('li');
                li.textContent = file.name;
                fileList.appendChild(li);
            });
        });
    </script>

@endsection