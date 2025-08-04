@include('frontend.layout.header')


@php
	$pdfUrl = "";
@endphp



@if($product->category_id == 50)
	@php $pdfUrl = '/pdf/blisters_flexibles.pdf'; @endphp
@elseif($product->category_id == 46)
	@php $pdfUrl = '/pdf/beverages_packaging.pdf'; @endphp
@elseif($product->category_id == 11)
	@php $pdfUrl = '/pdf/pharma_raw_material.pdf'; @endphp
@else
	@php $pdfUrl = '/pdf/brochures/default-brochure.pdf'; @endphp
@endif



@php
    use Illuminate\Support\Facades\Request;
    use App\Models\admin\Banner;
    $currentPath = ltrim(Request::path(), '/');
    $banner = Banner::where('status', 1)
        ->whereHas('bannerUrl', function ($q) use ($currentPath) {
            $q->where('page_url', $currentPath);
        })
        ->with('bannerUrl')
        ->latest()
        ->first();
    $bannerImage = ($banner && $banner->image)
        ? asset('banners/' . $banner->image)
        : asset('default-banner.jpg');
@endphp
<div class="inner_sec alu_foils" style="background: #3E4E67 url('{{ $bannerImage }}') center top no-repeat; background-size: cover; background-position:center;">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-6 text-center">
               
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
						<li class="breadcrumb-item"><a href="/">Solutions</a></li>
						{{-- <li class="breadcrumb-item"><a href="/products/solutions">Packaging Solutions</a></li> --}}
						{{-- <li class="breadcrumb-item"><a href="/products/solutions">Pharmaceutical</a></li> --}}
						{{-- <li class="breadcrumb-item"><a href="/products/solutions">Lidding Films</a></li> --}}
						<li class="breadcrumb-item active" aria-current="page">{{  $product->title }} </li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- ======= ======= -->

<section id="product_view" class="">
	<div class="container">
		<div class="row justify-content-md-between">
			<div class="col-lg-5 col-md-6 col-sm-6">
				<div> <img src="{{ $product->image }}" class="img-fluid" /> </div>
			</div> <!-- -->
			<div class="col-lg-7 col-md-6 col-sm-6 product_descp">
				<img src="/img/icon/star.svg" class="img-fluid star" />
				<h3> {{  $product->title }}</h3>
				<div class="description">
					{{-- <p>{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 100) }}</p> --}}
				</div>
				<div class="editor">
					<h5> Specifications </h5>
					<ul>
						{!!$product->description !!}
					</ul>
				</div>

				<div class="actions_btn d-flex justify-content-md-center">
					<div class="blue_btn">
						<a href="{{ route('cart.add', $product->id) }}">Add To Quote
							<span><img src="/img/icon/link.svg" class="img-fluid"></span>
						</a>

					</div>



					@if($pdfUrl)
						<div>
							<a href="{{ asset($pdfUrl) }}" class="know_more blue_btn" target="_blank">
								Download Brochure
								<span><img src="/img/icon/link_1.svg" class="img-fluid" /></span>
							</a>
						</div>
					@endif
				</div>

			</div>
		</div>
	</div>
</section>
<section id="product_view" class="pt-0">
	<div class="container">
		<div class="row justify-content-md-between text-center">
			<div class="col-lg-12">
				<h3> Explore More in Packaging Solutions </h3>
			</div> <!-- -->
		</div>
		<br />
		<div class="row justify-content-md-between more_solutions">
			<div class="col-lg-12">
				<div class="swiper-container" id="more_solutions">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<div class="box">
								<a href="/products/pharma-packaging-solutions"> Pharma Packaging Solutions <span> <img
											src="/img/icon/link_2.svg" class="img-fluid" /> </span></a>
							</div> <!-- -->
						</div>
						<div class="swiper-slide">
							<div class="box">
								<a href="/products/alcohol-packaging-solutions"> Alcohol Packaging Solutions <span> <img
											src="/img/icon/link_2.svg" class="img-fluid" />
									</span></a>
							</div> <!-- -->
						</div>
						<div class="swiper-slide">
							<div class="box">
								<a href="/products/f-b-packaging-solutions"> F&B Packaging Solutions <span> <img
											src="/img/icon/link_2.svg" class="img-fluid" /> </span></a>
							</div> <!-- -->
						</div>
					</div>
				</div>
			</div> <!-- -->
		</div>
	</div>
</section>



@include('frontend.layout.client')
@include('frontend.layout.footer')