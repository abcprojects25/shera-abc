@extends('admin.layouts.app')

@section('content')
<div class="container main-content side-content pt-5" style="margin-left: 20em;">
    <h2> Subscribers</h2>
    @if(session('success'))
    <div class="alert alert-success w-50">
        {{ session('success') }}
    </div>
@endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Subscribed At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subscribers as $subscriber)
                        <tr>
                            <td>{{ $subscriber->id }}</td>
                            <td>{{ $subscriber->email }}</td>
                            <td>{{ $subscriber->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <form action="{{ route('admin.subscribers.destroy', $subscriber->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subscriber?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No subscribers yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
