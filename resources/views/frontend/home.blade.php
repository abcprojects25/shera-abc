<style>
	.top_menu {
		display: none;
	}
</style>
@include('frontend.layout.header')

<style>
	.header-absolute {
		background: none;
	}

	#content {
		padding-top: 0px;
	}

	.home_menu {
		display: block;
	}

	@media (max-width: 995px) {
		#content {
			padding-top: 73px;
		}
	}
</style>


<section id="home" class="relative pd-0">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<div class="home_search">
					<h4> Your Unified Solutions Partner </h4>
					<!-- <form method="post" action="/contacts" id="inquiry" enctype="multipart/form-data"> -->
					<div class="form-group position-relative">
						<input type="text" id="product-search" class="form-control" placeholder="Search Products...."
							autocomplete="off">

						<div id="search-suggestions" class="list-group position-absolute w-100"
							style="z-index: 1000; display: none;"></div>

						<!-- Optional: Remove this submit button too -->
						<!-- <div class="submit"><input type="submit" name="submit" class="btn" value=""></div> -->
					</div>
					<!-- </form> -->
				</div>
			</div>
		</div>
		<!--
			<div class="row">
				<div class="col-lg-4 col-md-4">  
					<div class="swiper-container border" id="bannerText"> 
						<div class="swiper-wrapper"> 
							<div class="swiper-slide"> <h5 class="bebas"> Packaging </h5>  </div> 
							<div class="swiper-slide"> <h5 class="bebas"> Raw Material </h5>  </div> 							
							<div class="swiper-slide"> <h5 class="bebas"> Manufacturing </h5>  </div> 
						</div> 
					</div>  
				</div>
			</div>
			-->
	</div>
	<!-- -->
	<div class="swiper-container bannerslider" id="bannerText">
		<div class="swiper-wrapper">
			<div class="swiper-slide slide_1">
				<div class="slide_captions">
					<div class="d-flex">
						<h5 class="bebas"> Packaging </h5>
						<h5 class="bebas"> Raw Material </h5>
						<h5 class="bebas"> Manufacturing </h5>
					</div>
					<h1 class="bebas"> Packaging </h1>
					<p> From design to delivery, we provide seamless and efficient packaging solutions tailored to your
						needs. </p>
					<a href="/products/solutions" class="btn"> View Packaging Products <img src="/img/icon/link.svg"
							class="img-fluid" /></a>
				</div> <!-- -->
				<img src="/img/home_slide/slide_1.jpg" class="img-fluid  image-back" alt="" />
			</div>
			<div class="swiper-slide slide_2">
				<div class="slide_captions">
					<div class="d-flex">
						<h5 class="bebas"> Packaging </h5>
						<h5 class="bebas"> Raw Material </h5>
						<h5 class="bebas"> Manufacturing </h5>
					</div>
					<h1 class="bebas"> Raw Material </h1>
					<p> We offer a wide range of raw materials, working with multiple manufacturers to offer multiple
						grades that suit your requirements. </p>
					<a href="/products/solutions" class="btn"> View Raw Material Products <img src="/img/icon/link.svg"
							class="img-fluid" /></a>
				</div> <!-- -->
				<img src="/img/home_slide/slide_2.jpg" class="img-fluid image-back" alt="" />
			</div>
			<div class="swiper-slide slide_3">
				<div class="slide_captions">
					<div class="d-flex">
						<h5 class="bebas"> Packaging </h5>
						<h5 class="bebas"> Raw Material </h5>
						<h5 class="bebas"> Manufacturing </h5>
					</div>
					<h1 class="bebas"> Manufacturing </h1>
					<p> With our industry expertise, we ensure you get the right machine tailored to your needs. </p>
					<a href="/products/solutions" class="btn"> View Manufacturing Products <img src="/img/icon/link.svg"
							class="img-fluid" /></a>
				</div> <!-- -->
				<img src="/img/home_slide/slide_3.jpg" class="img-fluid image-back" alt="" />
			</div>
		</div>
	</div>
</section>
<div class="swiper-container" id="serviceSlide">
	<div class="swiper-wrapper service-carousel">
		<div class="swiper-slide"> <a href="/products/pharma-packaging-solutions" class="slide_1"> <span> Pharma </span>
				<img src="/img/icon/link_1.svg" class="img-fluid" /> </a> </div>
		<div class="swiper-slide"> <a href="#" class="slide_2"> <span> Nutraceutical </span> <img
					src="/img/icon/link_1.svg" class="img-fluid" /> </a> </div>
		<div class="swiper-slide"> <a href="/products/alcohol-packaging-solutions" class="slide_3"> <span> Alcohol
				</span> <img src="/img/icon/link_1.svg" class="img-fluid" /> </a> </div>
		<div class="swiper-slide"> <a href="#" class="slide_4"> <span> Cosmetics </span> <img src="/img/icon/link_1.svg"
					class="img-fluid" /> </a> </div>
		<div class="swiper-slide"> <a href="#" class="slide_5"> <span> FMCG </span> <img src="/img/icon/link_1.svg"
					class="img-fluid" /> </a> </div>

		<!-- check js file if you need to change app.js the swiper  -->
	</div>
</div>


<section id="homeAbout" class="relative">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="800">
				<div>
					<img src="/img/icon/star.svg" class="img-fluid star" />
					<h1 class="bebas main_heading"> Custom Packaging </h1>
					<p> We go the extra mile to find the perfect solution for your needs, offering design and
						customization services to create products that align with your brand's vision and requirements.
					</p>
					<br />
					<a href="/products/solutions" class="know_more blue_btn"> Know More <span> <img
								src="/img/icon/link_1.svg" class="img-fluid" /> </span> </a>
				</div>
				<br /> <br />
				<div class="swiper-container" id="packagingSlide">
					<div class="swiper-wrapper">
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_1.png" class="img-fluid"
								alt="" /> </div>
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_2.png" class="img-fluid"
								alt="" /> </div>
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_3.png" class="img-fluid"
								alt="" /> </div>
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_4.png" class="img-fluid"
								alt="" /> </div>
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_5.png" class="img-fluid"
								alt="" /> </div>
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_6.png" class="img-fluid"
								alt="" /> </div>
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_7.png" class="img-fluid"
								alt="" /> </div>
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_1.png" class="img-fluid"
								alt="" /> </div>
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_2.png" class="img-fluid"
								alt="" /> </div>
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_3.png" class="img-fluid"
								alt="" /> </div>
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_4.png" class="img-fluid"
								alt="" /> </div>
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_5.png" class="img-fluid"
								alt="" /> </div>
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_6.png" class="img-fluid"
								alt="" /> </div>
						<div class="swiper-slide"> <img src="/img/home_slide/packaging_7.png" class="img-fluid"
								alt="" /> </div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 relative">
				<div class="frame">
					<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
						type="module"></script>
					<dotlottie-player src="https://lottie.host/771c6725-643e-4499-b935-dc4ccc557910/9oZlGXtz04.json"
						background="transparent" speed="1" style="width:800; height:800" direction="1" playMode="normal"
						loop autoplay></dotlottie-player>
				</div>
				<div data-aos="zoom-in" data-aos-duration="800">
					<img src="/img/pack.png" class="img-fluid  " />
				</div>
				<!-- 
					<div  data-aos="zoom-in" data-aos-duration="800">
						<img src="/img/frame.gif" class="img-fluid frame" />
						<img src="/img/pack.png" class="img-fluid  " />
					</div>  
					-->
			</div>
		</div>
	</div>
</section>

<section id="product" class="">
	<div class="container">
		<div class="row align-items-end">
			<div class="col-md-8">
				<div class="banner_title" data-aos="fade-up" data-aos-duration="800">
					<img src="/img/icon/star.svg" class="img-fluid star" />
					<h1 class="bebas main_heading"> Industries Served </h1>
				</div>
			</div>
			<div class="col-md-4">
				<div class="banner_title" data-aos="fade-up" data-aos-duration="800">
					<p> We factor in desired quality, optimum quantities, competitive pricing, efficient conversions and
						on time deliveries all over the world. </p>
				</div>
			</div>
		</div>
		<br />
		<div class="row justify-content-md-between home_product_list">
			<div class="col-lg-12">
				<div class="group">
					<div class="item" style="background-image: url(img/industries_01.jpg)">
						<div class="box">
							<h4> Nutraceuticals </h4>
							<p> Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Faucibus mi
								vestibulum nulla metus aliquam urna blandit malesuada. </p>
						</div>
					</div>
					<div class="item" style="background-image: url(img/industries_02.jpg)">
						<div class="box">
							<h4> Liquor </h4>
							<p> Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Faucibus mi
								vestibulum nulla metus aliquam urna blandit malesuada. </p>
						</div>
					</div>
					<div class="item active" style="background-image: url(img/industries_03.jpg)">
						<div class="box">
							<h4> Pharmaceutical </h4>
							<p> Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Faucibus mi
								vestibulum nulla metus aliquam urna blandit malesuada. </p>
						</div>
					</div>
					<div class="item" style="background-image: url(img/industries_04.jpg)">
						<div class="box">
							<h4> Cosmetics </h4>
							<p> Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Faucibus mi
								vestibulum nulla metus aliquam urna blandit malesuada. </p>
						</div>
					</div>
					<div class="item" style="background-image: url(img/industries_05.jpg)">
						<div class="box">
							<h4> FMCG </h4>
							<p> Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Faucibus mi
								vestibulum nulla metus aliquam urna blandit malesuada. </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="services" class="">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="banner_title text-center" data-aos="fade-up" data-aos-duration="800">
					<img src="/img/icon/star.svg" class="img-fluid star" />
					<!-- <h4 class="">  Subtitle goes here </h4>  -->
					<h1 class="bebas main_heading"> Our Verticals </h1>
				</div>
			</div>
		</div>
		<br />
		<div class="row justify-content-md-between home_product_list">
			@foreach ($mainCategories as $main)
				@if ($main->subCategories->isNotEmpty())
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="relative">
							<img src="/img/shape_1.png" class="img-fluid shape" />
							<div class="img-cover">
								@if ($loop->iteration == 2)
									<img src="/img/rawmaterial_solutions.jpg" class="img-fluid" />
								@else
									<img src="/img/packaging_solutions.jpg" class="img-fluid" />
								@endif
							</div>

							<div class="box">
								<h4>{{ $main->name }}</h4>
								<p>{{ $main->description }}</p>

								<div class="hover_cont">
									<!-- <ul>
																							@foreach ($main->subCategories as $sub)
																								<li>
																									<a href="{{ url('products/' . $sub->seourl) }}">
																										<i class="fa-solid fa-arrow-right prev_arw"></i>
																										{{ $sub->name }}
																										<i class="fa-solid fa-arrow-right nxt_arw"></i>
																									</a>
																								</li>
																							@endforeach
																						</ul> -->
									@if($main->id == 32)
										<ul>
											<li>
												<a
													href="https://aaplsolutions.com/products/pharma-packaging-solutions">
													<i class="fa-solid fa-arrow-right prev_arw"></i>
													Pharma Packaging Solutions
													<i class="fa-solid fa-arrow-right nxt_arw"></i>
												</a>
											</li>
											<li>
												<a
													href="https://aaplsolutions.com/products/alcohol-packaging-solutions">
													<i class="fa-solid fa-arrow-right prev_arw"></i>
													Alcohol Packaging Solutions
													<i class="fa-solid fa-arrow-right nxt_arw"></i>
												</a>
											</li>
											<li>
												<a
													href="https://aaplsolutions.com/products/f-b-packaging-solutions">
													<i class="fa-solid fa-arrow-right prev_arw"></i>
													F&amp;B Packaging Solutions
													<i class="fa-solid fa-arrow-right nxt_arw"></i>
												</a>
											</li>
										</ul>
									@endif

									@if($main->id == 58)
										<ul>
											<li>
												<a
													href="https://aaplsolutions.com/products/pharma-raw-material-solutions">
													<i class="fa-solid fa-arrow-right prev_arw"></i>
													Pharma Solutions
													<i class="fa-solid fa-arrow-right nxt_arw"></i>
												</a>
											</li>
											<li>
												<a
													href="https://aaplsolutions.com/products/alcohol-raw-material-solutions">
													<i class="fa-solid fa-arrow-right prev_arw"></i>
													Alcohol Solutions
													<i class="fa-solid fa-arrow-right nxt_arw"></i>
												</a>
											</li>

										</ul>
									@endif
								</div>

							</div>
						</div>
					</div>
				@endif
			@endforeach




			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="relative">
					<img src="/img/shape_3.png" class="img-fluid shape" />
					<div class="img-cover"> <img src="/img/manufacturing_solutions.jpg" class="img-fluid" /> </div>
					<div class="box">
						<h4> Manufacturing <br /> Solutions </h4>
						<p> With extensive industry knowledge, we provide expert support in setting up or upgrading your
							manufacturing facilities to stay ahead with new technologies. </p>

						<div class="hover_cont">
							<a href="/products/solutions" class="vewprdt"> View Products <svg width="11" height="10"
									viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M3.7309 1H9.95313M9.95313 1V7.22222M9.95313 1L1.95312 9" stroke="#fff"
										stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
								</svg> </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="suntainability" class="">
	<img src="/img/shape_4.png" class="img-fluid shape_4" />
	<div class="container">
		<div class="row  align-items-end">
			<div class="col-md-6 suntainability_img">
				<div data-aos="fade-right" data-aos-duration="800">
					<img src="/img/SUSTAINABILITY.png" class="img-fluid" />
				</div>
			</div>
			<div class="col-md-6">
				<div class="banner_title" data-aos="fade-up" data-aos-duration="800">
					<img src="/img/icon/star.svg" class="img-fluid star" />
					<h1 class="bebas main_heading"> Sustainability </h1>

					<p> Whether at our own facilities or our trusted partners’, we actively promote sustainable
						practices across all three pillars: Environmental, Social, and Economic, ensuring long-term
						benefits for our people and our planet. </p>
				</div>

				<div class="row justify-content-md-between">
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="box ripple">
							<img src="/img/icon/environmental.svg" class="img-fluid" />
							<p> Environmental </p>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="box ripple">
							<img src="/img/icon/social.svg" class="img-fluid" />
							<p> Social </p>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="box ripple">
							<img src="/img/icon/economic.svg" class="img-fluid" />
							<p> Economic </p>
						</div>
					</div>
				</div> <!-- -->

				<a href="/sustainability" class="know_more blue_btn"> Choose Sustainability <span> <img
							src="/img/icon/link_1.svg" class="img-fluid" /> </span> </a>

			</div>
		</div>
	</div>
</section>

<section id="our_reach" class="relative">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-4 col-md-5 text-center" data-aos="fade-up" data-aos-duration="800">
				<div class="banner_title">
					<img src="/img/icon/star.svg" class="img-fluid star" />
					<h1 class="bebas main_heading"> Our Reach </h1>
					<br />
				</div>
			</div>
		</div>
		<br />
		<div class="row justify-content-md-center">
			<div class="col-lg-8 col-md-8 relative">
				<img src="/img/globe.png" class="img-fluid" />
			</div>
		</div>
		<br />
		<div class="row justify-content-md-center">
			<div class="col-md-10">
				<div class="row" id="counter">
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						<div class="box">
							<h1> <span class="count percent" data-count="60"> 60+</span><span>+</span></h1>
							<p> Countries </p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						<div class="box">
							<h1> <span class="count percent" data-count="4500"> 4500+</span><span>+</span></h1>
							<p> Products </p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="box">
							<h1> <span class="count percent" data-count="300"> 300+</span><span>+</span></h1>
							<p> Employees </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="blogs" class="">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="banner_title text-center" data-aos="fade-up" data-aos-duration="800">
					<img src="/img/icon/star.svg" class="img-fluid star" />
					<h1 class="bebas main_heading"> Blog </h1>
				</div>
			</div>
		</div>
		<br />
		<div class="row justify-content-md-between homeBlog_list">
			@php
				use Illuminate\Support\Facades\DB;

				$blogs = DB::table('blogs')
					->where('is_published', 1)
					->where('is_deleted', 0)
					->orderBy('publish_date', 'desc')
					->limit(6)
					->get();
			@endphp

			@foreach($blogs as $blog)
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="{{ url('/blog/' . $blog->blog_url) }}" class="text-decoration-none text-dark">
						<div class="relative">
							<div class="img-cover">
								<img src="{{ asset($blog->thumb_image ?? '/img/placeholder.jpg') }}" class="img-fluid" />
							</div>
							<div class="box">
								<p class="date mb-0">{{ \Carbon\Carbon::parse($blog->publish_date)->format('d M, Y') }}</p>
								<h5>{{ $blog->blog_title }}</h5>
							</div>
						</div>
					</a>
				</div>
			@endforeach
		</div>


		<br />



		<br />
		<div class="row text-center">
			<div class="col-lg-12">
				<a href="/blog" class="know_more blue_btn"> Read All <span> <img src="/img/icon/link_1.svg"
							class="img-fluid" /> </span> </a>
			</div>
		</div>
	</div>
</section>

@include('frontend.layout.client')
@include('frontend.layout.footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function () {
		$('#product-search').on('keyup', function () {
			let query = $(this).val();
			if (query.length >= 2) {
				$.ajax({
					url: "{{ route('product.autocomplete') }}",
					type: "GET",
					data: { query: query },
					success: function (data) {
						let suggestionBox = $('#search-suggestions');
						suggestionBox.empty().show();
						if (data.length > 0) {
							data.forEach(item => {
								suggestionBox.append(
									`<a href="/product/${item.product_url}" class="list-group-item list-group-item-action">${item.title}</a>`
								);
							});
						} else {
							suggestionBox.append(`<div class="list-group-item">No results found</div>`);
						}
					}
				});
			} else {
				$('#search-suggestions').hide();
			}
		});
		// Hide suggestions when clicked outside
		$(document).click(function (e) {
			if (!$(e.target).closest('#product-search, #search-suggestions').length) {
				$('#search-suggestions').hide();
			}
		});
	});
</script>