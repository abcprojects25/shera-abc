@extends('admin.layouts.admin')
@section('content')

<h2 class="text-2xl font-bold mb-6">Categories</h2>

<form method="POST" action="{{ route('admin.products.product_categories.store') }}" class="mb-6 flex items-center gap-4">
    @csrf
    <input type="text" name="name" placeholder="New category name" required
           class="border rounded px-3 py-2 w-1/3 focus:outline-none focus:ring focus:border-blue-300">
    <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700 transition">
        Add Category
    </button>
</form>

<table class="w-full table-auto border-collapse shadow-md rounded overflow-hidden">
    <thead class="bg-gray-100">
        <tr>
            <th class="border px-4 py-2 text-left">Id</th>
            <th class="border px-4 py-2 text-left">Name</th>
            <th class="border px-4 py-2 text-left">Created At</th>
            <th class="border px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $i => $category)
        <tr class="border-b hover:bg-gray-50">
            <td class="border px-4 py-2">{{ $i + 1 }}</td>
            <td class="border px-4 py-2">
                <form action="{{ route('admin.products.product_categories.update', $category->id) }}" method="POST" class="flex gap-2 items-center">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" value="{{ $category->name }}" required
                           class="border rounded px-2 py-1 w-full focus:outline-none focus:ring focus:border-blue-300">
                    <button type="submit"
                            class="bg-green-500 text-black px-3 py-1 rounded hover:bg-green-600 transition">
                        Update
                    </button>
                </form>
            </td>
            <td class="border px-4 py-2">{{ $category->created_at ? $category->created_at->format('Y-m-d H:i') : '-' }}</td>
            <td class="border px-4 py-2">
                <form id="delete-form-{{ $category->id }}"
                      action="{{ route('admin.products.product_categories.destroy', $category) }}"
                      method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete({{ $category->id }})"
                            class="bg-red-500 text-black px-3 py-1 rounded hover:bg-red-600 transition">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- SweetAlert script --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This category will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

@endsection
