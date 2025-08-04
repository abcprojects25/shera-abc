@include('frontend.layout.header')
<div class="inner_sec alu_foils">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-6 text-center">
				<h1> ALU Foils </h1>
				<p> Lorem ipsum dolor sit amet consectetur mattis bibendum in aliquam massa. Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in.  </p>
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
						<li class="breadcrumb-item"><a href="/products/solutions">Packaging Solutions</a></li>
						<li class="breadcrumb-item"><a href="/products/solutions">Pharmaceutical</a></li>
						<li class="breadcrumb-item"><a href="/products/solutions">Lidding Films</a></li>
						<li class="breadcrumb-item active" aria-current="page"> ALU Foils </li>  
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- ======= ======= -->
	
	<section id="product_view" class="">
		<div class="container">  
			<div class="row justify-content-md-between">
				<div class="col-lg-5 col-md-6 col-sm-6">
					<div> <img src="/img/product_2.jpg" class="img-fluid" />   </div>
				</div> <!-- -->
				<div class="col-lg-7 col-md-6 col-sm-6 product_descp">
					<img src="/img/icon/star.svg" class="img-fluid star" />
					<h3> ALU Foils </h3>
					<div class="description">
						<p> Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. </p> 
					</div>
					<div class="editor">
						<h5> Specifications </h5>
						<ul>
							<li> Alu / HSL </li>
							<li> Alu Thickness - 20 , 25 , 30 microns </li>
							<li> Sealing to PVC/PVDC </li>
							<li> Printed or Holographic </li>
							<li> With or Without Primer </li>
						</ul>
					</div>
					
					<div class="actions_btn d-flex justify-content-md-center">
						<div class="blue_btn"> <a href="/cart"> Add To Cart  <span> <img src="/img/icon/link.svg" class="img-fluid" /> </span> </a> </div>
						<div> <a href="#" class="know_more blue_btn"> Download Brochure  <span> <img src="/img/icon/link_1.svg" class="img-fluid" /> </span> </a> </div> 
					</div>
				</div>
			</div>
		</div>  
	</section>
	<section id="product_view" class="pt-0">
		<div class="container">  
			<div class="row justify-content-md-between text-center">
				<div class="col-lg-12">
					<h3> Explore More in Packaging Solutions </h3>
				</div> <!-- --> 
			</div>
			<br />
			<div class="row justify-content-md-between more_solutions">
				<div class="col-lg-12">
					<div class="swiper-container" id="more_solutions"> 
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div class="box">
									<a href="#"> Semi-Solid Dosages <span> <img src="/img/icon/link_2.svg" class="img-fluid" /> </span></a>	
								</div> <!-- --> 
							</div> 
							<div class="swiper-slide">
								<div class="box">
									<a href="#"> Liquid  Dosages <span> <img src="/img/icon/link_2.svg" class="img-fluid" /> </span></a>	
								</div> <!-- --> 
							</div> 
							<div class="swiper-slide">
								<div class="box">
									<a href="#"> Parenteral Dosages <span> <img src="/img/icon/link_2.svg" class="img-fluid" /> </span></a>	
								</div> <!-- --> 
							</div>  
						</div>
					</div> 
				</div> <!-- -->   
			</div>
		</div>  
	</section>
 


@include('frontend.layout.client')
@include('frontend.layout.footer')