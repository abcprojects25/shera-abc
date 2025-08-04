@include('frontend.layout.header')
<div class="inner_sec why_aapl">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-12">
				<h1> Why AAPL </h1>
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
						<li class="breadcrumb-item active" aria-current="page"> Why AAPL </li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<section id="why_aapl" class="">
	<div class="container">
		<div class="row justify-content-md-center text-center">
			<div class="col-md-8">
				<div class="banner_title text-center" data-aos="fade-up" data-aos-duration="800">
					<img src="/img/icon/star.svg" class="img-fluid star" />
					<!-- <h4 class="">  Subtitle goes here </h4>  -->
					<h1 class="bebas main_heading"> Since </h1>
					<h1 class="lg-text lg_year"> 1983 </h1>
				</div>

				<p> For over 40 years, we’ve been at the forefront of industry innovation, evolving alongside the
					changing landscape. Our deep experience has empowered us to deliver the solutions you need, when you
					need them. We’re not just problem-solvers — we’re creators, equipped to bring new ideas to life. Our
					customers trust us for our adaptability, our commitment to quality, and our ability to source from a
					broad, worldwide network to meet every challenge. </p>
			</div>
		</div>
	</div>
</section>

<section id="mission" class="pb-0">
	<img src="/img/shape_4.png" class="img-fluid shape_4" />
	<div class="container">
		<div class="row justify-content-md-center text-center">
			<div class="col-md-8">
				<div class=" " data-aos="fade-up" data-aos-duration="800">
					<img src="/img/why_aapl.jpg" class="img-fluid" />
				</div>
			</div>
		</div>
		<img src="/img/line_1.png" class="img-fluid" />
		<div class="row justify-content-md-center mission">
			<div class="col-md-3">
				<div class="banner_title" data-aos="fade-up" data-aos-duration="800">
					<img src="/img/icon/star.svg" class="img-fluid star" />
					<h1 class="bebas main_heading"> Mission </h1>
				</div>
			</div>
			<div class="col-md-7">
				<div class="text-justify" data-aos="fade-up" data-aos-duration="800">
					<p> Our mission is to help businesses unlock profits by boosting sales, reducing costs, and
						enhancing productivity. We strive to be a trusted partner, offering dependable, high-quality
						solutions that meet the unique needs of our clients—anywhere, anytime. By pushing boundaries and
						creating opportunities, we empower businesses to thrive in an ever-changing world, delivering
						exceptional value and fostering lasting partnerships that drive mutual success. </p>
				</div>
			</div>
		</div>
		<div class="text-end"> <img src="/img/line_2.png" class="img-fluid" /> </div>
	</div>
</section>

<section id="core_ethics" class="">
	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<div class="col-md-4">
				<div class="banner_title" data-aos="fade-up" data-aos-duration="800">
					<img src="/img/icon/star.svg" class="img-fluid star" />
					<h1 class="bebas main_heading"> Core Ethics </h1>
					<!-- <p> Lorem ipsum dolor sit amet consectetur mattis bibendum in aliquam massa. Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur mattis bibendum in aliquam massa. Lorem ipsum dolor sit amet consectetur. </p> -->
				</div>
			</div>
			<div class="col-md-8">
				<div class="" data-aos="fade-up" data-aos-duration="800">
					<div class="swiper-container" id="core_ethicsSlide">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div>
									<img src="/img/icon/integrity.svg" class="img-fluid" alt="" />
									<h4> Integrity and Transparency </h4>
									<p> We operate with honesty and transparency in all our actions, ensuring our
										actions align with our service. Through ethical conduct and consistent
										reliability, we build trust and foster lasting relationships. </p>
								</div>
							</div> <!-- -->
							<div class="swiper-slide">
								<div>
									<img src="/img/icon/accountability.svg" class="img-fluid" alt="" />
									<h4> Accountability & Responsibility </h4>
									<p> We take responsibility for our actions, upholding the highest ethical standards.
										We’re dedicated to making decisions that benefit our clients, communities, and
										the environment. </p>
								</div>
							</div> <!-- -->
							<div class="swiper-slide">
								<div>
									<img src="/img/icon/safety_sec.svg" class="img-fluid" alt="" />
									<h4> Safety & <br /> Security </h4>
									<p> We prioritize the safety, privacy, and security of our employees, customers, and
										partners, maintaining the highest standards of data protection and physical
										security. </p>
								</div>
							</div> <!-- -->
							<div class="swiper-slide">
								<div>
									<img src="/img/icon/quality_excellence.svg" class="img-fluid" alt="" />
									<h4> Quality & <br /> Excellence </h4>
									<p> We deliver solutions with a keen focus on detail and a commitment to excellence.
										We go the extra mile to provide exceptional service, ensuring every client
										interaction exceeds expectations and fosters lasting satisfaction. </p>
								</div>
							</div> <!-- -->
						</div> <!-- Swiper Container -->

						<!-- Navigation buttons -->

						<br /> <br />
						<div class="swipe_nv">
							<div class="slider__next"> <img src="/img/icon/arrow-left.svg" alt="" class="img-fluid" />
							</div>
							<div class="slider__prev"> <img src="/img/icon/arrow-right.svg" alt="" class="img-fluid" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<!-- ======= ======= -->


@include('frontend.layout.client')
@include('frontend.layout.footer')

<script>
	const coreswiper = new Swiper('#core_ethicsSlide', {
		loop: true,
		paginationClickable: true,
		grabCursor: true,
		spaceBetween: 0,
		slidesPerView: 2.5,
		// effect: "fade",
		fadeEffect: {
			crossFade: true,
		},
		speed: 1500,
		autoplay: {
			delay: 2950
		},
		navigation: {
			nextEl: ".slider__next",
			prevEl: ".slider__prev"
		},
		breakpoints: {
			1920: {
				slidesPerView: 2.5,
			},
			1028: {
				slidesPerView: 2.5,
			},
			480: {
				slidesPerView: 1.2,
			},
			320: {
				slidesPerView: 1.2,
			}
		}
	})
</script>