@extends('admin.layouts.admin')
@section('content')

<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-semibold mb-6">Add New Product</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block font-medium mb-1">Category:</label>
            <input type="text" name="category" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Name:</label>
            <input type="text" name="name" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Description:</label>
            <textarea name="description" rows="4" class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Applications:</label>
            <input name="applications" id="applications-input" placeholder="Enter applications..." required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Upload Images:</label>
            <input type="file" name="images[]" multiple accept="image/*" id="image-input" class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
            <ul id="file-list" class="mt-2 text-sm text-gray-600 list-disc list-inside"></ul>
        </div>

        <div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-black font-medium px-6 py-2 rounded">
                Add Product
            </button>
        </div>  
    </form>
</div>

{{-- Tagify CSS & JS --}}
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

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
