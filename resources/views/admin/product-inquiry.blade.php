@extends('admin.layouts.app')
@section('content')
    <!-- ===== ===== -->



    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5"> Contact Us </h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                        </ol>
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            <a href="#" class="btn btn-white btn-icon-text my-2 mr-2"><i
                                    class="fe fe-file-text mr-2"></i> Export Data </a>
                        </div>
                    </div>
                </div>
                <!-- End Page Header -->


                <!--Row-->
                <div class="row row-sm">
                    <div class="col-sm-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-header border-bottom-0">
                                <div class="row">
                                    <div class="col-sm-6"> <label class="main-content-label mb-2"> Contact Listing </label>
                                    </div>
                                    <div class="col-sm-6">
                                        @if ($message = Session::get('error'))
                                            <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @endif

                                        @if ($message = Session::get('success'))
                                            <div class="alert alert-success alert-block">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered mg-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date & Time</th>
                                                <th>Client Info</th>
                                                <th>Products Enquired</th>
                                                {{-- <th>Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $grouped = collect($data)->groupBy('enquiry_id');
                                                $i = 1;
                                            @endphp

                                            @forelse ($grouped as $enquiry_id => $rows)
                                                @php $first = $rows->first(); @endphp
                                                <tr>
                                                    <!-- ID -->
                                                    <td>{{ $i++ }}</td>

                                                    <!-- Date & Time -->
                                                    <td>
                                                        <span
                                                            class="d-block">{{ date('d M Y', strtotime($first->created_at)) }}</span>
                                                        <small
                                                            class="text-muted">{{ date('h:i A', strtotime($first->created_at)) }}</small>
                                                    </td>

                                                    <!-- Client Information -->
                                                    <td>
                                                        <strong>{{ $first->client_name }}</strong><br>
                                                        <a href="mailto:{{ $first->email }}">{{ $first->email }}</a><br>
                                                        <span class="d-block">{{ $first->contact_no }}</span>
                                                        <small
                                                            class="text-muted d-block mt-1">{{ $first->office_address }}</small>
                                                    </td>

                                                    <!-- Product List -->
                                                    <td>
                                                        <div class="border rounded p-2 bg-light">
                                                            @foreach ($rows as $item)
                                                                <div class="mb-2">
                                                                    <strong
                                                                        class="d-block text-primary">{{ $item->product_name }}</strong>
                                                                    <span class="d-block">Quantity:
                                                                        {{ $item->quantity }}</span>

                                                                    @if ($item->requirement)
                                                                        <small class="d-block text-muted">Note:
                                                                            {{ $item->requirement }}</small>
                                                                    @endif

                                                                    @if ($item->product_image)
                                                                        <img src="{{ asset($item->product_image) }}"
                                                                            alt="{{ $item->product_name }}"
                                                                            class="img-thumbnail mt-1"
                                                                            style="max-width: 80px;">
                                                                    @endif

                                                                    @if (!$loop->last)
                                                                        <hr class="my-2">
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>

                                                    <!-- Actions -->
                                                    {{-- <td class="text-center">
                                                        <a href="/admin/product-enquiry-delete/{{ base64_encode($enquiry_id) }}"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this enquiry?')">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </a>
                                                    </td> --}}
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center text-muted">No product enquiries
                                                        found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>

                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- col end -->
                </div>
                <!-- Row end -->
            </div>
        </div>
    </div>
    <!-- End Main Content-->

    <!-- ===== ===== -->

    <!-- Add Country -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inquiry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered mg-b-0">
                        <tr>
                            <th> Name </th>
                            <td> Sanaullah Khan </td>
                        </tr>
                        <tr>
                            <th> Email </th>
                            <td> khan@abcdesigns.in </td>
                        </tr>
                        <tr>
                            <th> Contact </th>
                            <td> +91 80804955689 </td>
                        </tr>
                        <tr>
                            <th> Message </th>
                            <td> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                                been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                                galley of type and scrambled it to make a type specimen book. It has survived not only five
                                centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @include('admin.layouts.footer')

    <script>
        $(".text-box p").text(function(index, currentText) {
            var maxLength = $(this).parent().attr('data-maxlength');
            if (currentText.length >= maxLength) {
                return currentText.substr(0, maxLength) + "...";
            } else {
                return currentText
            }
        });
    </script>
@endsection
