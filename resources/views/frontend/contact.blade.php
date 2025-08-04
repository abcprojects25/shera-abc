@include('frontend.layout.header')
<div class="inner_sec contact_us">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-12">
				<h1> Contact Us </h1>
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
						<li class="breadcrumb-item active" aria-current="page">Contact Us</li> 
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- ======= ======= -->
	
	
	<section id="contactdtls" class="">
		<img src="/img/shape_4.png" class="img-fluid shape_4" />
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-md-6 text-center">
					<div class="banner_title" data-aos="fade-up" data-aos-duration="800">
						<img src="/img/icon/star.svg" class="img-fluid star" /> 
						<h1 class="bebas main_heading"> We’re here to help </h1>  
					</div> 
					<p> <strong> Have questions or need assistance? </strong> <br /> Simply drop us a message, and one of our dedicated regional account managers will reach out within 24 hours to discuss your needs and provide tailored solutions.</p>
				</div>   
			</div> 
		</div>
	</section>

	<section id="contactpage">  
		<div class="container">
			<div class="row">
				<div class="col-lg-12"> 
					<main class="contact_content">
						<div class="row  align-items-center">
							<div class="col-xl-7 col-lg-7 col-md-12" data-aos="fade-right" data-aos-duration="800">
								<div class="contact_form">
									@include('frontend.layout.inquiry')
								</div>
							</div> 
							<div class="col-xl-5 col-lg-5 col-md-12">
								<img src="/img/contact.png" class="img-fluid" /> 
							</div> 
						</div>
					</main>
				</div>  
			</div>  
		</div> 
	</section>


@include('frontend.layout.client')

@include('frontend.layout.footer')