@include('frontend.layout.header')
<div class="inner_sec sustaiability">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-12">
				<h1> Sustainability </h1>
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
						<li class="breadcrumb-item active" aria-current="page"> Sustainability </li> 
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

	<section id="sustaiability" class="">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-md-6">
					<div class="banner_title" data-aos="fade-up" data-aos-duration="800">
						<img src="/img/icon/star.svg" class="img-fluid star" /> 
						<h1 class="bebas main_heading"> Our Purpose </h1> 
					</div> 
					<p> At AAPL Solutions, sustainability is integral to everything we do. With adopting energy-efficient and waste-reducing manufacturing processes, responsibly sourced materials, and working with like-minded partners, we aim to drive positive change for both the planet and our communities. We are committed to reducing our environmental footprint, fostering a diverse and inclusive work environment, and supporting local communities through ethical practices and fair labor standards. We believe that true sustainability is a shared responsibility, and together with our employees, customers, suppliers, and communities, we aim to make a positive impact on the world. </p>
				</div> 
				<div class="col-md-6">
					<img src="/img/our_purpose.jpg" class="img-fluid" />
				</div> 
			</div> 
		</div>
	</section>
	
	<section id="our_focus" class="">
		<div class="container relative">
			<div class="row justify-content-md-center">
				<div class="col-md-3">
					<div class="banner_title text-center" data-aos="fade-up" data-aos-duration="800">
						<img src="/img/icon/star.svg" class="img-fluid star" /> 
						<h1 class="bebas main_heading"> Our Focus </h1> 
					</div>  
				</div> 
			</div> 
			
			<div class="row justify-content-md-center body_text">
				<div class="col-md-10">
					<div class="" data-aos="fade-up" data-aos-duration="800">
						<div class="swiper-container" id="core_ethicsSlide"> 
							<div class="swiper-wrapper">
								<div class="swiper-slide">
									<div class="bg_img">
										<img src="/img/icon/environmental_sustainability.svg" class="img-fluid" />
										<h4> Environmental Sustainability </h4>
										<p> <b> Carbon Footprint Reduction: </b> We contribute to increase green cover by planting trees and creating green spaces, to enhance biodiversity and improve environmental quality in the areas surrounding our operations. </p>
										
										<p> <b> Supplier Sustainability Audits: </b> We conduct regular assessments and audits of our suppliers to ensure that they improve and increase sustainable initiatives, promoting responsible practices throughout our supply chain. </p>
									</div>  
								</div> <!-- --> 
								<div class="swiper-slide">
									<div class="bg_img">
										<img src="/img/icon/social_sustainability.svg" class="img-fluid" />
										<h4> Social <br /> Sustainability </h4>
										<p> <b> Diversity & Inclusion: </b> We actively build a diverse and inclusive workplace, ensuring equal opportunities for all employees regardless of gender, race, or background. </p>
										
										<p> <b> Fair Trade Practices: </b> We work with suppliers who follow ethical sourcing and fair trade practices, ensuring that everyone is treated with dignity and respect throughout the supply chain. </p>
									</div> 
								</div> <!-- --> 
								<div class="swiper-slide">
									<div class="bg_img">
										<img src="/img/icon/economic_sustainability.svg" class="img-fluid" />
										<h4> Economic <br /> Sustainability </h4>
										<p> <b> Long-term Value Creation: </b> We focus on building sustainable business models, prioritizing long-term profitability over short-term gains and ensuring financial health for our stakeholders, employees, and communities. </p>
										
										<p> <b> Partnerships for Sustainable Growth: </b> We foster strategic partnerships with NGOs and industry leaders to promote and share knowledge to drive systemic change in the packaging sector. </p>
									</div> 
								</div> <!-- -->    
							</div> <!-- Swiper Container --> 
							<!-- Navigation buttons --> 
						</div> 
					</div> 
				</div> 
			</div> 
		</div>
	</section>
	<!--
	<section id="our_impact" class="">
		<div class="container text-center">
			<div class="row justify-content-md-center">
				<div class="col-md-8 col-sm-9">
					<div class="banner_title" data-aos="fade-up" data-aos-duration="800">
						<img src="/img/icon/star.svg" class="img-fluid star" /> 
						<h1 class="bebas main_heading text-white"> Our Impact </h1> 
					</div>
					<p class="text-white"> Lorem ipsum dolor sit amet consectetur mattis bibendum in aliquam massa. Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur mattis bibendum in aliquam massa. Lorem ipsum dolor sit amet consectetur.  Lorem ipsum dolor sit amet consectetur mattis bibendum in aliquam massa. Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur mattis bibendum in aliquam massa. Lorem ipsum dolor sit amet consectetur. </p>
					
					<p class="text-white"> Lorem ipsum dolor sit amet consectetur mattis bibendum in aliquam massa. Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. </p>	
					
					<br />
					
					<a href="#" class="know_more white_btn">
					Sustainability Report 2023-24 <span> <svg width="11" height="10" viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.7309 1H9.95313M9.95313 1V7.22222M9.95313 1L1.95312 9" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
					</a>
					
				</div> 
			</div>  
		</div>
	</section>
	-->
 
<!-- ======= ======= -->

 
@include('frontend.layout.client')
@include('frontend.layout.footer')


<script>
	const coreswiper = new Swiper('#core_ethicsSlide', { 
		loop: true, 
        paginationClickable: true,
		grabCursor: true,
        spaceBetween: 0,
		slidesPerView: 3, 
		// effect: "fade",
		fadeEffect: {
		  crossFade: true,
		},   		
		speed: 1500, 
        autoplay: {
			delay: 2950
        }, 
        breakpoints: {
			1920: { slidesPerView: 3 },
			1028: { slidesPerView: 3 },
			480: { slidesPerView: 1 },
			320: { slidesPerView: 1 }
        }
	})
</script>
 