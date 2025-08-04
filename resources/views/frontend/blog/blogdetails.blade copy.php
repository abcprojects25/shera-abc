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
                        <li class="breadcrumb-item active" aria-current="page"> Blog </li>
                        <li class="breadcrumb-item active" aria-current="page"> blog-details </li>
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
                        <p><i class="fas fa-user"></i>Author</p>
                        <p><i class="fas fa-calendar-alt"></i> 17 Jul, 2024</p>
                    </div>
                    <h5>Lorem ipsum dolor sit amet consectetur.</h5>
                    <p class="blog-details-desc short-desc">Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor
                        sit amet
                        consectetur. Lorem ipsum
                        dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.</p>
                </div>
                <div class="blog-img">
                    <img src="/img/blog/blog_1.jpg" alt="blog1" class="img-fluid" />
                </div>
                <div class="box">
                    <p class="blog-details-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus harum
                        beatae ipsa animi ea non officiis odio iure. Eligendi quibusdam fuga temporibus deleniti neque
                        illum vitae blanditiis distinctio voluptatibus voluptas possimus repudiandae atque ipsa tempore
                        aliquam nam nulla, totam dicta laboriosam nesciunt! Ipsa nam laborum doloribus inventore earum
                        dicta explicabo.</p>
                </div>
            </div>
        </div>

        <div class="related-blog">
            <h1>Related Blog</h1>
            <div class="blog-main">
                <div class="relative blog_main_section">
                    <a href="/blog/blog-details">
                        <div class="img-cover">
                            <img src="/img/blog/blog_2.jpg" alt="blog2" class="img-fluid" />
                        </div>
                        <div class="box">
                            <p class="date mb-0">17 Jul, 2024</p>
                            <h5>Lorem ipsum dolor sit amet consectetur.</h5>
                            <p class="truncate">Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet...
                            </p>
                        </div>
                    </a>
                </div>
                <div class="relative blog_main_section">
                    <a href="/blog/blog-details">
                        <div class="img-cover">
                            <img src="/img/blog/blog_2.jpg" alt="blog2" class="img-fluid" />
                        </div>
                        <div class="box">
                            <p class="date mb-0">17 Jul, 2024</p>
                            <h5>Lorem ipsum dolor sit amet consectetur.</h5>
                            <p class="truncate">Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet...
                            </p>
                        </div>
                    </a>
                </div>
                <div class="relative blog_main_section">
                    <a href="/blog/blog-details">
                        <div class="img-cover">
                            <img src="/img/blog/blog_2.jpg" alt="blog2" class="img-fluid" />
                        </div>
                        <div class="box">
                            <p class="date mb-0">17 Jul, 2024</p>
                            <h5>Lorem ipsum dolor sit amet consectetur.</h5>
                            <p class="truncate">Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet...
                            </p>
                        </div>
                    </a>
                </div>
                <div class="relative blog_main_section">
                    <a href="/blog/blog-details">
                        <div class="img-cover">
                            <img src="/img/blog/blog_2.jpg" alt="blog2" class="img-fluid" />
                        </div>
                        <div class="box">
                            <p class="date mb-0">17 Jul, 2024</p>
                            <h5>Lorem ipsum dolor sit amet consectetur.</h5>
                            <p class="truncate">Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet...
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>






@include('frontend.layout.client')
@include('frontend.layout.footer')