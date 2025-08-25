@extends('admin.layouts.app')

@section('content')
<div class="main-content side-content pt-0">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Certificate Enquiries</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Certificate</li>
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
                        @forelse($certificates as $certificate)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $certificate->name }}</td>
                                <td>{{ $certificate->company_name }}</td>
                                <td>{{ $certificate->designation }}</td>
                                <td>{{ $certificate->contact_number }}</td>
                                <td>{{ $certificate->email }}</td>
                                <td>{{ $certificate->message ?? '-' }}</td>
                              
                                <td style="max-width:200px;">{{ $certificate->pdf_name }}</td>
                                <td>
                                    @if($certificate->is_download)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-danger">No</span>
                                    @endif
                                </td>
                                <td>{{ $certificate->created_at->format('d M Y, h:i A') }}</td>
                                 <td>
                                    <form action="{{ route('admin.certificates.destroy', $certificate->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this enquiry?');">
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
