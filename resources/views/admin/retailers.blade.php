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
                <h2 class="main-content-title tx-24 mg-b-5"> Retailers </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Retailers</li>
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
                    <th>Source</th>
                    <th>Firm Name</th>
                    <th>Location</th>
                    <th>State</th>
                    <th>Owner Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($retailers as $retailer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $retailer->source }}</td>
                    <td>{{ $retailer->firm_name }}</td>
                    <td>{{ $retailer->location }}</td>
                    <td>{{ $retailer->state }}</td>
                    <td>{{ $retailer->owner_name }}</td>
                    <td class="d-flex gap-2">
                        <!-- View Button -->
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#retailerModal{{ $retailer->id }}">
                            View
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.dealers.delete', $retailer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this retailer?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="retailerModal{{ $retailer->id }}" tabindex="-1" aria-labelledby="retailerModalLabel{{ $retailer->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="retailerModalLabel{{ $retailer->id }}">Retailer Details: {{ $retailer->firm_name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Source:</strong> {{ $retailer->source }}</p>
                                <p><strong>Firm name:</strong> {{ $retailer->firm_name }}</p>
                                <p><strong>Location:</strong> {{ $retailer->location }}</p>
                                <p><strong>State:</strong> {{ $retailer->state }}</p>
                                <p><strong>Owner name:</strong> {{ $retailer->owner_name }}</p>
                                <p><strong>Email:</strong> {{ $retailer->email }}</p>
                                <p><strong>Phone Number:</strong> {{ $retailer->phone_number }}</p>
                                <p><strong>Business Start:</strong> {{ $retailer->business_start }}</p>
                                <p><strong>Products:</strong> {{ $retailer->products }}</p>
                                <p><strong>Status:</strong> {{ $retailer->status ? 'Active' : 'Inactive' }}</p>
                                <p><strong>URL:</strong> {{ $retailer->url }}</p>
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
