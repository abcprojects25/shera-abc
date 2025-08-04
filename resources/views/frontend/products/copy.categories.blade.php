@include('frontend.layout.header')
<div class="inner_sec packaging_solutions">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-6 text-center">
				<h1> {{ $category->name }} </h1>
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
						<li class="breadcrumb-item"><a href="/products/solutions">Solutions</a></li>
						<li class="breadcrumb-item active" aria-current="page"> {{ $category->name }} </li> 
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- ======= ======= -->
	
@php use Illuminate\Support\Str; @endphp

<section id="pharmaceutical" class="">
    <div class="container">
        <!-- Main category title -->
        <div class="row justify-content-md-center">
            <div class="col-lg-8 col-md-10 text-center">
                <div class="banner_title text-center" data-aos="fade-up" data-aos-duration="800">
                    <img src="/img/icon/star.svg" class="img-fluid star" />
                    <h1 class="main_heading">{{ $category->name }}</h1>
                </div>
            </div>
        </div>

        <br />

        <!-- Associated categories as tabs -->
        <div class="row justify-content-md-between product_nav" data-aos="fade-up" data-aos-duration="800">
            <div class="col-lg-12 text-center">
                <ul class="d-flex justify-content-md-center">
                    @foreach ($associatedCategories as $assocCat)
                        <li>
                            <a href="{{ url('/products/category/' . $category->id . '/' . $assocCat->id) }}"
                               class="{{ $selectedAssociatedCategory && $selectedAssociatedCategory->id === $assocCat->id ? 'active' : '' }}">
                                {{ $assocCat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <br />

        <!-- Subcategories OR Product List -->
        <div class="row justify-content-md-between product_list">
            @if ($subcategories->isNotEmpty())
                @foreach ($subcategories as $subcat)
                    <div class="col-lg-6 col-md-6">
                        <div class="relative border">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-6">
                                    <img src="{{ asset(ltrim($subcat->category_img ?? 'img/category.jpg', '/')) }}" class="img-fluid" />
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="procat_nms">
                                        <h4>{{ $subcat->name }}</h4>
                                        <p>{!! Str::limit(strip_tags($subcat->description), 100) !!}</p>
                                        <div class="blue_btn">
                                            <a href="{{ route('products.listing', $subcat->seourl) }}">
                                                Explore <span><img src="/img/icon/link.svg" class="img-fluid" /></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif ($products->isNotEmpty())
                <div class="row justify-content-md-between text-center catproduct_list">
                    @foreach ($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="{{ route('products.view', $product->product_url) }}" class="relative d-block w-100 border">
                                <div>
                                    <img src="{{ asset(ltrim($product->image, '/')) }}" class="img-fluid" alt="{{ $product->title }}">
                                </div>
                                <h4>{{ $product->title }}</h4>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-12 text-center">
                    <p>No categories or products found under this category.</p>
                </div>
            @endif
        </div>
    </div>
</section>



 


@include('frontend.layout.client')
@include('frontend.layout.footer')