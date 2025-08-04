@include('frontend.layout.header')
<div class="inner_sec">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-12">
				<h1> Food & Beverage </h1>
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
						<li class="breadcrumb-item active" aria-current="page">Food & Beverage</li> 
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<style>
#products,
.products_01, #BeOurSupplier, #client, footer { position:relative; }
#products:after, .products_01:after, #BeOurSupplier:after,
#client:after, footer:after { content:''; position:absolute; top:50%; transform:translateY(-50%); width:50px; height:100%; right:0px; background:#f5f5f5; z-index:555; }

#products:after { background:#fff; }
.products_01:after { background:var(--primary-maroon); }
#BeOurSupplier:after { background:var(--primary-maroon); }
#client:after { background:#fff; }
footer:after { background:#000; }
</style>

<!-- ======= ======= -->

	<section id="products" class="pd-0">  
        <div class="container">
			<div class="row justify-content-between align-items-center">
				<div class="col-lg-5 col-md-5"  data-aos="fade-left" data-aos-duration="800">
					<h1 class="bebas text-black main_heading"> Food & Beverage </h1>
					<p> Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur. </p>
					
					<p> Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur.  Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur.  Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur. </p>
					
					<p> Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur.  Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur. </p>				
				</div>   
                <div class="col-lg-6 col-md-6 product_Main_img" data-aos="fade-right" data-aos-duration="800"> 
					<img src="/img/product/food_beverage_1.jpg" class="img-fluid" />  
				</div> <!-- --> 
			</div>
		</div>
	</section>

	<section id="" class="products_01">  
        <div class="container">
			<div class="row justify-content-center text-center">
				<div class="col-lg-10 col-md-10"  data-aos="fade-up" data-aos-duration="800">
					<p class="text-white"> Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur.  Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur.  Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur. </p> 			
				</div>    
			</div>
		</div>
	</section>
	
	<section id="products_slides" class="food_page"> 
		<main id="one" class="panel foodslide_1">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800">
						<h1 class="bebas text-primary"> Lidding Foil </h1>
						<p class=""> AALPHA lidding Foil is used as a lid on plastic cups and containers which not only provides perfect closure to the cup but makes it pilfer proof and provides protection from external influences. </p> 			
					</div> <!-- --> 
				</div> 
					
				<div class="row justify-content-center">	
					<div class="col-lg-4 col-md-6 relative"> 
						<div class="" data-aos="fade-up" data-aos-duration="800">						
							<img src="/img/product/lidding_foil.png" class="img-fluid" />
						</div> 			
					</div> <!-- -->
				</div>
					
				<div class="row justify-content-end">	
					<div class="col-lg-4 col-md-4"  data-aos="fade-right" data-aos-duration="800">
						<p class=""> The low permeation properties of the foil to water vapor and oxygen ensures the required shelf life. The heat seal lacquer used in lidding foil can be made sealable to different cup/jar substrates such as PET, PP, PS, HDPE and PVC. Lidding foil with a universal coating which can seal with multiple substrates is also available. </p> 
						
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>
					</div> <!-- -->   
				</div>
			</div>
		</main> <!-- -->
		
		<main id="two" class="panel foodslide_2">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800">
						<h1 class="bebas text-primary"> CHEESE FOIL </h1>
						<p class=""> AALPHA cheese foil, which is the most consumed dairy product worldwide. Thus, we help your cheeses to be preserved and kept fresh. The cheese packages we offer for sale vary according to your needs. </p> 			
					</div> <!-- --> 
				</div> 
					
				<div class="row justify-content-center">	
					<div class="col-lg-4 col-md-6 relative"> 
						<div class="" data-aos="fade-up" data-aos-duration="800">						
							<img src="/img/product/cheese_foil.png" class="img-fluid" />
						</div>  
					</div> <!-- -->
				</div>
					
				<div class="row justify-content-end">	
					<div class="col-lg-4 col-md-4"  data-aos="fade-right" data-aos-duration="800">
						<p class=""> Cheese Packaging Aluminum Foil; It prevents loss of taste and moisture with its high barrier properties. Printing and lacquering can be done. It comes usually a triangular and square shape, it protects your cheese for a long time with its high barrier feature. </p> 
						
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>
					</div> <!-- -->   
				</div>
			</div> 
		</main> <!-- -->

		<main id="three" class="panel foodslide_3">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800">
						<h1 class="bebas text-primary"> Cigarette Foils </h1>
						<p class=""> AALPHA offers a wide range of aluminium / paper laminates for cigarette inner liners, including materials printed with the customer’s logo in any size and colour, either on the aluminium side or on the paper side. </p> 			
					</div> <!-- --> 
				</div> 
					
				<div class="row justify-content-center">	
					<div class="col-lg-4 col-md-6 ">
						<div class="relative"> 
							<div class="" data-aos="fade-up" data-aos-duration="800">						
								<img src="/img/product/cigarette_foils.png" class="img-fluid" />
							</div> 
						</div> <!-- -->
					</div> <!-- -->
				</div>
					
				<div class="row justify-content-end">	
					<div class="col-lg-4 col-md-4"  data-aos="fade-right" data-aos-duration="800">
						<p class=""> Focusing on consistent quality and optimum machinability, AALPHA’s cigarette inner liners are tailored to the last detail to meet the requirements and advanced features of even the most sophisticated cigarette packers available in the market. </p> 
						
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>
					</div> <!-- -->   
				</div>
			</div> 
		</main> <!-- -->

		<main id="four" class="panel foodslide_4">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4" data-aos="fade-left" data-aos-duration="800">
						<h1 class="bebas text-primary"> Chocolate Foils </h1>
						<p class=""> AALPHA offers a wide range of alu/paper laminates for chewing gum inner wrapping, materials either embossed or unembossed and/or printed in single colours. </p> 			
					</div> <!-- --> 
				</div> 
					
				<div class="row justify-content-center">	
					<div class="col-lg-4 col-md-6">
						<div class="relative"> 
							<div class="" data-aos="fade-up" data-aos-duration="800">						
								<img src="/img/product/chocolate_foils.png" class="img-fluid" />
							</div> 
						</div>  
					</div> <!-- -->
				</div>
					
				<div class="row justify-content-end">	
					<div class="col-lg-4 col-md-4"  data-aos="fade-right" data-aos-duration="800">
						<p class=""> Whether serving as a barrier for protecting chewing gum, or as a way of adding a touch of elegance or differentiation to a product, Symetal’s wrappers are properly adjusted to maintain an optimum performance level in all different types of chewing gum wrapping machines. </p> 
						
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>
					</div> <!-- -->   
				</div>
			</div> 

		</main> <!-- -->

		<main id="five" class="panel foodslide_5">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800">
						<h1 class="bebas text-primary"> 2 Layer / 3Layer Laminates & Pouches </h1>
						<p class=""> Laminates, when used as a packaging material provide protection to the product during transit, display and consumer storage from shelf loss due to bacterial contamination and physical injury. </p>
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a> 			
					</div> <!-- -->  	
				</div> <!-- -->

				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-6">
						<div class="relative"> 
							<div class="" data-aos="fade-up" data-aos-duration="800">						
								<img src="/img/product/laminates_pouches_1.png" class="img-fluid" />
							</div> 
						</div> 
					</div> <!-- --> 
				</div> <!-- --> 

				<div class="row justify-content-end">	
					<div class="col-lg-4 col-md-4"  data-aos="fade-right" data-aos-duration="800"> 
						<p class=""> The PET film used in the PET-FOIL-POLY laminates not only provides a suitable surface for excellent printing, but also strength to the Aluminium Foil, the other substrate, which is prone to damage during handling. Foil has the best barrier property and is non toxic in nature. The third substrate of the laminate, PE, acts as a sealing medium and ensures the properties required for immediate contact with the packed material.</p> 
						
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>			
					</div> <!-- -->  
				</div>  
			</div>  
		</main> <!-- -->

		<main id="six" class="panel foodslide_6">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800">
						<h1 class="bebas text-primary"> Ice Cream Cone Sleeve </h1>
						<p class=""> AALPHA Cone sleeves provide for two major functionalities - ‘Brand Appeal’ and ‘Cone Protection’. Towards fulfilling these requirements we have installed the most sophisticated, automatic imported machines that print dual to multilayered aluminum foil sleeves in up to 8 colors, in customized designs, as per individual customer needs. </p> 			
					</div> <!-- --> 
				</div> 
					
				<div class="row justify-content-center">	
					<div class="col-lg-4 col-md-6">	
						<div class="relative">	 
							<div class="" data-aos="fade-up" data-aos-duration="800">						
								<img src="/img/product/icecream_sleeve.png" class="img-fluid" />
							</div>  
						</div>
					</div>
				</div>
					
				<div class="row justify-content-end">	
					<div class="col-lg-4 col-md-4"  data-aos="fade-right" data-aos-duration="800">
						<p class=""> Each sleeve is moisture resistant in both, refrigerated and semi-refrigerated conditions. It prevents cone damage in transit and storage, and enables the cone to retain its flavor and crunchiness over extended periods of time. Printed in varied size requirements, each sleeve is finished with a protective food grade overcoat and conforms to global standard guidelines. </p> 
						
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>
					</div> <!-- -->   
				</div>
			</div>  
		</main> <!-- -->
 
		
		<nav class="products_nav">
			<div><a href="#one"> </a></div>
			<div><a href="#two"> </a></div>
			<div><a href="#three"> </a></div>
			<div><a href="#four"> </a></div>
			<div><a href="#five"> </a></div> 
			<div><a href="#six"> </a></div>  
		</nav>
 
	</section>
 
 
@include('frontend.layout.beoursupplier')
@include('frontend.layout.client')

@include('frontend.layout.footer')
 
 
<script src="/js/ScrollToPlugin.min.js"></script>
<script type="module" src="/js/product.js"></script> 