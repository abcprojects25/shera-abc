@include('frontend.layout.header')

<style>
    
.cartactions_btn .cart-btn-new{
        border-radius: 30px;
    padding: 10px 30px;
    background: #647aa2;
    color: #fff;
    border: 1px solid #647aa2
}
.form-group textarea{
    height: 45px !important;
}
</style>
<div class="inner_sec why_aapl">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-12">
				<h1> Cart </h1>
			</div>
		</div>
	</div>
</div>
<div id="breadcrumb">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page"> Cart </li> 
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<section id="cart" class="">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="banner_title" data-aos="fade-up" data-aos-duration="800">
                    <img src="/img/icon/star.svg" class="img-fluid star" />
                    <h1 class="bebas main_heading"> Cart </h1>
                </div>
            </div>
        </div>
        <br />

      <form method="POST" action="{{ route('cart.submit') }}">
    @csrf

    <div class="row justify-content-md-center cart_table">
        <div class="col-md-12">

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" width="70">Sr No.</th>
                            <th>Product Pic</th>
                            <th>Product Name</th>
                            <th class="text-center">Quantity</th>
                            <th>Requirement</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>

                            <td>
                                {{-- Assuming product_image is relative path, use asset() --}}
                             <img src="{{ asset($item['product_image']) }}" class="img-fluid border" width="80px" />

                                <input type="hidden" name="product_image[]" value="{{ $item['product_image'] }}">
                                <input type="hidden" name="product_id[]" value="{{ $item['product_id'] }}">
                                <input type="hidden" name="product_name[]" value="{{ $item['product_name'] }}">
                            </td>

                            <td>
                                <p class="mb-0 proname">{{ $item['product_name'] }}</p>
                            </td>

                            <td class="text-center">
                                <input type="number" name="quantity[]" class="form-control" value="{{ $item['quantity'] ?? 1 }}" min="1" required>
                            </td>

                            <td>
                                {{-- Made requirement optional (remove required if nullable) --}}
                                <textarea name="requirement[]" class="form-control" placeholder="Add Requirements..." rows="3">{{ $item['requirement'] ?? '' }}</textarea>
                            </td>

                            <td class="text-center">
                                <a href="#" class="remove" data-id="{{ $item['product_id'] }}">
                                    <img src="/img/icon/close_bold.svg" class="img-fluid" />
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr>

            <!-- Client Details -->
            <div class="container">
                <div class="client-details row mb-4">
                    <div class="col">
                        <div class="form-group">
                            <label for="client_name">Client Name:</label>
                            <input type="text" name="client_name" id="client_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email ID:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="contact_no">Contact No.:</label>
                            <input type="text" name="contact_no" id="contact_no" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="office_address">Message:</label>
                            <textarea name="office_address" id="office_address" class="form-control" rows="2" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="cartactions_btn d-flex justify-content-md-between">
                <div>
                    <a href="/" class="know_more blue_btn">
                        <span><img src="/img/icon/arrow-left.png" class="img-fluid"></span>
                        Back To Products
                    </a>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary cart-btn-new">
                        Submit
                        <span><img src="/img/icon/link.svg" class="img-fluid"></span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</form>

{{-- Optional: Add this script if you want to handle remove item click with ajax or JS --}}
<script>
    document.querySelectorAll('.remove').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-id');
            
            // Example: Send AJAX request to remove item
            fetch(`/cart-item/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    // Reload page or remove row from DOM
                    location.reload();
                } else {
                    alert('Failed to remove item.');
                }
            })
            .catch(() => alert('Error occurred.'));
        });
    });
</script>





    </div>
</section>

	
	 
	
<!-- ======= ======= -->

 
@include('frontend.layout.client')
@include('frontend.layout.footer')
  