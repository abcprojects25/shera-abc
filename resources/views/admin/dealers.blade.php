@extends('admin.layouts.app')

@section('content')

<!-- Bootstrap 5 CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<div class="main-content side-content pt-0">
<div class="container-fluid">
    <!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5"> Dealers </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Dealers</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							 
						</div>
					</div>
				</div>
				<!-- End Page Header --> 

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Firm Name</th>
                <th>Location</th>
                <th>State</th>
                <th>Owner Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dealers as $dealer)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dealer->firm_name }}</td>
                <td>{{ $dealer->location }}</td>
                <td>{{ $dealer->state }}</td>
                <td>{{ $dealer->owner_name }}</td>
                <td class="d-flex gap-2">
                    <!-- View Button -->
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#dealerModal{{ $dealer->id }}">
                        View
                    </button>

                    <!-- Delete Button -->
                    <form action="{{ route('admin.dealers.delete', $dealer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this dealer?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="dealerModal{{ $dealer->id }}" tabindex="-1" aria-labelledby="dealerModalLabel{{ $dealer->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dealerModalLabel{{ $dealer->id }}">Dealer Details: {{ $dealer->firm_name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Firm name:</strong> {{ $dealer->firm_name }}
                            <p><strong>Location:</strong> {{ $dealer->location }}
                            <p><strong>State:</strong> {{ $dealer->state }}
                            <p><strong>Owner name:</strong> {{ $dealer->owner_name }}
                            <p><strong>Email:</strong> {{ $dealer->email }}</p>
                            <p><strong>Phone Number:</strong> {{ $dealer->phone_number }}</p>
                            <p><strong>Business Start:</strong> {{ $dealer->business_start }}</p>
                            <p><strong>Products:</strong> {{ $dealer->products }}</p>
                            <p><strong>Status:</strong> {{ $dealer->status ? 'Active' : 'Inactive' }}</p>
                            <p><strong>URL:</strong> {{ $dealer->url }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
