@include('frontend.layout.header')
<div class="inner_sec sustaiability">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <h1> Our Blog </h1>
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
                        <li class="breadcrumb-item active" aria-current="page"> <a href="/blog"> Blog</a> </li>
                        <li class="breadcrumb-item active" aria-current="page"> {{ $blog->blog_title }} </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="blog-main-content">
        <div class="blog-details-container">
            <div class="blog-details-content">
                <div class="box">
                    <div class="blog-info">
                        <p><i class="fas fa-user"></i> {{ $blog->author ?? 'Admin' }}</p>
                        <p><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($blog->publish_date)->format('d M, Y') }}</p>
                    </div>
                    <h5>{{ $blog->blog_title }}</h5>
                    <p class="blog-details-desc short-desc">
                        {{ \Illuminate\Support\Str::limit(strip_tags($blog->blog_content), 200) }}
                    </p>
                </div>
                <div class="blog-img">
                    <img src="{{ asset($blog->thumb_image ?? '/img/blog/blog_1.jpg') }}" alt="blog1" class="img-fluid" />
                </div>
                <div class="box">
                    <p class="blog-details-desc">
                        {!! $blog->blog_content !!}
                    </p>
                </div>
            </div>
        </div>

      <div class="related-blog">
    <h1>Related Blog</h1>
    <div class="blog-main">
        @foreach($relatedBlogs as $related)
            <div class="relative blog_main_section">
                <a href="{{ url('/blog/' . $related->blog_url) }}
">
                    <div class="img-cover">
                        <img src="{{ asset($related->thumb_image ?? '/img/blog/blog_2.jpg') }}" alt="blog2" class="img-fluid" />
                    </div>
                    <div class="box">
                        <p class="date mb-0">{{ \Carbon\Carbon::parse($related->publish_date)->format('d M, Y') }}</p>
                        <h5>{{ $related->blog_title }}</h5>
                        <p class="truncate">
                            {{ \Illuminate\Support\Str::limit(strip_tags($related->blog_content), 100) }}
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

    </div>
</div>








@include('frontend.layout.client')
@include('frontend.layout.footer')