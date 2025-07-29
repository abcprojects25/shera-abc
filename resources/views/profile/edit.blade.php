@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="name" class="block font-semibold">Name</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Profile</button>
    </form>

    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
        @csrf
        @method('DELETE')

        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Delete Account</button>
    </form>
</div>
@endsection
