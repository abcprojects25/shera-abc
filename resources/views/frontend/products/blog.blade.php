@include('frontend.layout.header')
<div class="inner_sec sustaiability">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <h1> Our Blogs </h1>
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
                        <li class="breadcrumb-item active" aria-current="page"> Blog </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="container">
  <div class="row blog_container">
@foreach($blogs as $blog)
    <div class="col-md-6 col-12 mb-4 blog_content">
        <div class="relative blog_main_section">
            <a href="{{ url('/blog/' . $blog->blog_url) }}">
                <div class="img-cover">
                    <img src="{{ asset($blog->thumb_image ?? '/img/placeholder.jpg') }}" alt="blog" class="img-fluid" />
                </div>
                <div class="box">
                    <p class="date mb-0">{{ \Carbon\Carbon::parse($blog->publish_date)->format('d M, Y') }}</p>
                    <h5>{{ $blog->blog_title }}</h5>
                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->blog_content), 200) }}</p>
                </div>
            </a>
        </div>
    </div>
@endforeach

</div>

</div>






@include('frontend.layout.client')
@include('frontend.layout.footer')