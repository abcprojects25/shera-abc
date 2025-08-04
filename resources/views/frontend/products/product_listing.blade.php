@include('frontend.layout.header')
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

<div class="inner_sec lidding_films" style="background: #3e4e67 url('{{ $bannerImage }}') center top no-repeat; background-size: cover;">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-6 text-center">
            </div>
        </div>
    </div>
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
						<li class="breadcrumb-item active" aria-current="page"> {{ $category->name }} </li> 
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- ======= ======= -->
	<style>
	h1.main_heading {
    margin-bottom: 25px;
}
	</style>
<section id="pharmaceutical" class="">

    <div class="container"> 
        <div class="row justify-content-md-center"> 
            <div class="col-lg-8 col-md-10 text-center"> 
			@if (!Request::is('products/pharma-packaging-solutions/liquid-dosages'))
                <p>For decades, we have experienced and adapted to the industry’s evolution...</p>
                <br /><br />
				@endif
            </div>				
        </div> 
        <br />
@if (Request::is('products/pharma-packaging-solutions/liquid-dosages'))
    @php
        // Setup like in controller
        $associatedCategories = $category->subCategories ?? collect();
        $selectedAssociatedCategory = null;
        $subcategories = collect();

        if ($associatedCategories->isNotEmpty()) {
            if (!empty($subctg)) {
                $selectedAssociatedCategory = $associatedCategories->firstWhere('seourl', $subctg);
                if (!$selectedAssociatedCategory) {
                    $selectedAssociatedCategory = $associatedCategories->first();
                }
            } else {
                $selectedAssociatedCategory = $associatedCategories->first();
            }

            $subcategories = $selectedAssociatedCategory ? $selectedAssociatedCategory->subCategories : collect();
        }

        // Get current subcategory slug from URL segment (like 'liquid-dosages')
        $activeTabSlug = Request::segment(3); 
    @endphp

    <div class="row justify-content-md-between product_nav" data-aos="fade-up" data-aos-duration="800">
        <div class="col-lg-12 text-center">
		    <div class="row">
          <div class="row justify-content-md-center">
            <div class="col-lg-8 col-md-10 text-center">
                <div class="banner_title text-center" data-aos="fade-up" data-aos-duration="800">
                    <img src="/img/icon/star.svg" class="img-fluid star" />
                    <h1 class="main_heading">{{ $category->name }}</h1>
                </div>
            </div>
        </div>
            <ul class="d-flex justify-content-md-center">
                @foreach ($associatedCategories as $assocCat)
                    <li>
                        <a href="{{ url('/products/' . $category->seourl . '/' . $assocCat->seourl) }}"
                            class="{{ $assocCat->seourl === $activeTabSlug ? 'active' : '' }}">
                            {{ $assocCat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endif

        <div class="row g-4 justify-content-md-between product_list">
            @if ($childCategories->isNotEmpty())
                @foreach ($childCategories as $subcat)
                    <div class="col-lg-6 col-md-6">
                        <div class="relative border">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-6">
                                    <img src="{{ asset(ltrim($subcat->category_img ?? 'img/category.jpg', '/')) }}" class="img-fluid" alt="{{ $subcat->name }}" />
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="procat_nms">
                                        <h4>{{ $subcat->name }}</h4>
                                        <p>{!! Str::limit(strip_tags($subcat->description), 100) !!}</p>
                                        <div class="blue_btn">
                                            {{-- <a href="{{ route('products.listing', $subcat->seourl) }}">
                                                Explore <span><img src="/img/icon/link.svg" class="img-fluid" /></span>
                                            </a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            @elseif ($products->isNotEmpty())
                <div class="row g-4 justify-content-md-between text-center catproduct_list">
                    @foreach ($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="{{ route('products.view', $product->product_url) }}" class="relative d-block w-100 border">
                                <div class="">
                                    <img src="{{ asset(ltrim($product->image, '/')) }}" class="img-fluid" alt="{{ $product->title }}">
                                </div>
                                <h4 class="mt-2">{{ $product->title }}</h4>
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