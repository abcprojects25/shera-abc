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

<div id="breadcrumb">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/products/solutions">Solutions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Packaging Solutions</li> 
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section id="pharmaceutical" class="">
    <div class="container"> 
        <div class="row justify-content-md-center"> 
            <div class="col-lg-8 col-md-10 text-center"> 
                <p>For decades, we have experienced and adapted to the industry’s evolution...</p>
                <br /><br />
            </div>				
        </div> 
        <br />
        
    <div class="row justify-content-md-between text-center catproduct_list">
    @forelse($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <a href="{{ url('/products/categoriesname/productname/' . $product->id) }}" class="relative d-block w-100 border">
                <div> 
                    <img src="{{ asset(ltrim($product->image, '/')) }}" class="img-fluid" alt="{{ $product->title }}" />   
                </div>
                <h4>{{ $product->title }}</h4>
                <p>{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 100) }}</p>   
            </a> 
        </div>
    @empty
        <div class="col-12 text-center">
            <p>No products found for this category.</p>
        </div>
    @endforelse
</div>

    </div>  
</section>

@include('frontend.layout.client')
@include('frontend.layout.footer')
