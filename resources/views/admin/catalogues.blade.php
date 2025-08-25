@extends('admin.layouts.app')

@section('content')
<div class="main-content side-content pt-0">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Catalogues Enquiries</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Catalogues</li>
                </ol>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Sr. no</th>
                            <th>Name</th>
                            <th>Company Name</th>
                            <th>Designation</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Message</th>
                            
                            <th>PDF Name</th>
                            <th>Is Download</th>
                            <th>Submitted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($catalogues as $catalogue)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $catalogue->name }}</td>
                                <td>{{ $catalogue->company_name }}</td>
                                <td>{{ $catalogue->designation }}</td>
                                <td>{{ $catalogue->contact_number }}</td>
                                <td>{{ $catalogue->email }}</td>
                                <td>{{ $catalogue->message ?? '-' }}</td>
                              
                                <td>{{ $catalogue->pdf_name }}</td>
                                <td>
                                    @if($catalogue->is_download)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-danger">No</span>
                                    @endif
                                </td>
                                <td>{{ $catalogue->created_at->format('d M Y, h:i A') }}</td>
                                 <td>
                                    <form action="{{ route('admin.catalogues.destroy', $catalogue->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this enquiry?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No enquiries found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
