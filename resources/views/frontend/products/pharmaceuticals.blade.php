@include('frontend.layout.header')
<div class="inner_sec">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-12">
				<h1> Products </h1>
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
						<li class="breadcrumb-item active" aria-current="page">Pharmaceuticals</li> 
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
					<h1 class="bebas text-black main_heading"> PHARMACEUTICALS </h1>
					<p> Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur. </p>
					
					<p> Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur.  Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur.  Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur. </p>
					
					<p> Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur.  Lorem ipsum dolor sit amet consectetur. In aliquam massa mattis bibendum in. Lorem ipsum dolor sit amet consectetur. </p>				
				</div>   
                <div class="col-lg-6 col-md-6 product_Main_img" data-aos="fade-right" data-aos-duration="800"> 
					<img src="/img/product/pharmaceuticals.jpg" class="img-fluid" />  
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
	
	<section id="products_slides"> 
		<main id="one" class="panel productslide_1">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800">
						<h1 class="bebas text-primary"> Hard Blister Foil </h1>
						<p class=""> AALPHA offers high quality lidding foils developed under clean and hygienic conditions to ensure safety of our clients products. These foils are offered both in plain and printed forms. </p> 			
					</div> <!-- --> 
				</div> 
					
				<div class="row justify-content-center sheets">	
					<div class="col-lg-6 col-md-6 relative" data-aos="fade-up" data-aos-duration="800">
						<div class="lg-img">
							<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> HSL </span>  </p>
							<img src="/img/product/hsl-sh.png" class="img-fluid" />  
						</div>
						<div class="sm-img" data-aos="fade-up" data-aos-duration="800">						
							<img src="/img/product/hbf.png" class="img-fluid" />
						</div> 			
					</div> <!-- -->
				</div>
					
				<div class="row justify-content-end">	
					<div class="col-lg-4 col-md-4"  data-aos="fade-down" data-aos-duration="800">
						<p class=""> Primer coated Aluminium foil, hard tempered with HSL coating is available in various thickness ranging from 20 microns to 30 microns as requested by customers. HSL Coating can be done up to 3-10 GSM. We offer solutions for sealing with different Forming Films like PVC, PVDC, Cold Form, Tropical etc. </p> 
						
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>
					</div> <!-- -->   
				</div>
			</div>
		</main> <!-- -->
		
		<main id="two" class="panel productslide_2">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800">
						<h1 class="bebas text-primary"> Soft Blister Foil </h1>
						<p class=""> AALPHA Manufactures a range of LDPE laminated soft Aluminium Foils suitable for strip packaging of products, Aluminium Strip foil is an excellent barrier to moisture, vapour and gases. It completely blocks the passage of light and entry of unwanted odours. </p> 			
					</div> <!-- --> 
				</div> 
					
				<div class="row justify-content-center">	
					<div class="col-lg-6 col-md-6 sheets text-end relative">
						<div class="lg-img">
							<div class="softblister_foil_1" data-aos="fade-up" data-aos-duration="1200">
								<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> PE </span>  </p>
								<img src="/img/product/pe.png" class="img-fluid" />
							</div>
							<div class="softblister_foil_2">
								<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> Soft Foil </span>  </p> 
								<img src="/img/product/soft_foil-sh.png" class="img-fluid" />  			
							</div>
						</div>
						<div class="sm-img" data-aos="fade-up" data-aos-duration="800">						
							<img src="/img/product/soft_blister_foil.png" class="img-fluid" />
						</div>  
					</div> <!-- -->
				</div>
					
				<div class="row justify-content-end">	
					<div class="col-lg-4 col-md-4"  data-aos="fade-right" data-aos-duration="800">
						<p class=""> Each Tablet is individually protected. These foils are highly recommended for packaging pharmaceutical items Such as Tablet, Capsules (Both side strip foil and in centre tablet or capsules) also Suitable for Lidding Foil in certain cases and any other use with the consent of manufacturer. </p> 
						
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>
					</div> <!-- -->   
				</div>
			</div> 
		</main> <!-- -->

		<main id="three" class="panel productslide_3">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800">
						<h1 class="bebas text-primary"> Alu Alu Foil</h1>
						<p class=""> Alu Alu Foil is available in 45 & 50 Mic. Aluminum foil offering better mileage and cost saving to the customers. It is produces under AHU conditions to ensure maximum cleanliness and hygiene. Technical experts of Alu-Alu blister machines are trained by OEM’s. </p> 			
					</div> <!-- --> 
				</div> 
					
				<div class="row justify-content-center">	
					<div class="col-lg-6 col-md-6 sheets">
						<div class="relative">
							<div class="lg-img">
								<div class="alualu_foil_1">
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> PVC </span>  </p>
									<img src="/img/product/pvc-sh.png" class="img-fluid" />
								</div>
								<div class="alualu_foil_2" data-aos="fade-up" data-aos-duration="1200">
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> Foil </span>  </p> 
									<img src="/img/product/soft_foil.png" class="img-fluid" />  			
								</div> 
								<div class="alualu_foil_3" data-aos="fade-up" data-aos-duration="1600">
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> OPA </span>  </p> 
									<img src="/img/product/opa.png" class="img-fluid" />  			
								</div> 
							</div> 
							<div class="sm-img" data-aos="fade-up" data-aos-duration="800">						
								<img src="/img/product/alualu_foil.png" class="img-fluid" />
							</div> 
						</div> <!-- -->
					</div> <!-- -->
				</div>
					
				<div class="row justify-content-between">	
					<div class="col-lg-4 col-md-4"  data-aos="fade-down" data-aos-duration="800">
						<p class=""> For us customer satisfaction and quality assurance are two most important factors. We make sure that the products are of highest quality and clients get best value for money for their products. </p>  
					</div> <!-- --> 
					<div class="col-lg-4 col-md-4"  data-aos="fade-down" data-aos-duration="800">
						<p class=""> With maximum crack free resistance compared to other vendors, this foil is best suited for all kinds of pharmaceutical needs. In many foils, one may notice de-lamination after 6-8 months. But with AALPHA (Alu Alu Foil) –, there is no de-lamination even after testing the blisters after 6 months at accelerated stability conditions.</p> 
						
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>
					</div> <!-- -->   
				</div>
			</div> 
		</main> <!-- -->

		<main id="four" class="panel productslide_4">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800">
						<h1 class="bebas text-primary"> Tropical Foils </h1>
						<p class=""> Tropical Foils are used as a shield over the Plastic Packaging in order to protect moisture sensitive products against moisture, oxygen, light, UV Rays. </p> 			
					</div> <!-- --> 
				</div> 
					
				<div class="row justify-content-center">	
					<div class="col-lg-6 col-md-6 sheets">
						<div class="relative">
							<div class="lg-img">
								<div class="tropical_foil_1">
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> PVC </span>  </p>
									<img src="/img/product/opa-sh.png" class="img-fluid" />
								</div>
								<div class="tropical_foil_2" data-aos="fade-up" data-aos-duration="1200"> 
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> Foil </span>  </p>
									<img src="/img/product/soft_foil.png" class="img-fluid" />  			
								</div> 
								<div class="tropical_foil_3" data-aos="fade-up" data-aos-duration="1400"> 
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> OPA </span>  </p>
									<img src="/img/product/hsl.png" class="img-fluid" />  			
								</div> 
							</div> 
							<div class="sm-img" data-aos="fade-up" data-aos-duration="800">						
								<img src="/img/product/tropical_foils.png" class="img-fluid" />
							</div> 
						</div>  
					</div> <!-- -->
				</div>
					
				<div class="row justify-content-end">	
					<div class="col-lg-4 col-md-4"  data-aos="fade-down" data-aos-duration="800">
						<p class=""> Aesthetically designed and developed look of the blister makes the Tropical foil a special laminate in the industry. It can be used for packaging of various types of medicines. This laminate comprises of OPA, Aluminium foil with Heat Seal Lacquer. </p> 
						
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>
					</div> <!-- -->   
				</div>
			</div> 

		</main> <!-- -->

		<main id="five" class="panel productslide_5">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800">
						<h1 class="bebas text-primary"> CRSF FOILS </h1>
						<p class=""> AALPHA Child-Resistant Senior-Friendly (CRSF) healthcare packaging offers peel-push, peelable, and push-through variants for pharma applications to avoid accidental misuse by children and enable convenience in usage for senior citizens. All variants available in printed options. Configuration of Paper and Foil Tailormade. </p>
						<p> AALPHA Push through child-resistant (CR) foil is a non-toxic lid foil laminated with PVC. </p>
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a> 			
					</div> <!-- -->  	
					<div class="col-lg-7 col-md-7 sheets">
						<div class="relative">
							<div class="lg-img">
								<div class="crsf_foil_1">
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> Hard Foil </span>  </p>
									<img src="/img/product/soft_foil-sh.png" class="img-fluid" />
								</div>
								<div class="crsf_foil_2" data-aos="fade-up" data-aos-duration="1200">
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> Adhesive </span>  </p> 
									<img src="/img/product/peel_adhesive.png" class="img-fluid" />  			
								</div> 
								<div class="crsf_foil_3" data-aos="fade-up" data-aos-duration="1400"> 
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> PVC </span>  </p>
									<img src="/img/product/pvc.png" class="img-fluid" />  			
								</div> 
							</div> 
							<div class="sm-img" data-aos="fade-up" data-aos-duration="800">						
								<img src="/img/product/crsf_foils.png" class="img-fluid" />
							</div> 
						</div> 
					</div> <!-- --> 
				</div> 
				
				<div class="row justify-content-between">
					<div class="col-lg-7 col-md-7 sheets sheets_oppp">
						<div class="relative">
							<div class="lg-img">
								<div class="crsf_foil_4">
									<p class="mb-0 points-left"> <span> Paper </span> <img src="/img/product/point_1.png" class="img-fluid" /> </p>
									<img src="/img/product/paper.png" class="img-fluid" />
								</div>
								<div class="crsf_foil_5" data-aos="fade-up" data-aos-duration="1200">
									<p class="mb-0 points-left"> <span> PET </span> <img src="/img/product/point_1.png" class="img-fluid" />  </p> 
									<img src="/img/product/pet.png" class="img-fluid" />  			
								</div> 
								<div class="crsf_foil_6" data-aos="fade-up" data-aos-duration="1400">
									<p class="mb-0 points-left"> <span> Foil </span> <img src="/img/product/point_1.png" class="img-fluid" />  </p> 
									<img src="/img/product/soft_foil.png" class="img-fluid" />  			
								</div> 
								<div class="crsf_foil_7" data-aos="fade-up" data-aos-duration="1600">
									<p class="mb-0 points-left"> <span> HCL Peelable </span> <img src="/img/product/point_1.png" class="img-fluid" />  </p> 
									<img src="/img/product/hsl.png" class="img-fluid" />  			
								</div> 
							</div> 
							<div class="sm-img" data-aos="fade-up" data-aos-duration="800">						
								<img src="/img/product/crsf_foils_1.png" class="img-fluid" />
							</div> 
						</div> 
					</div> <!-- --> 
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800"> 
						<p class=""> AALPHA Non-toxic peelable heat seal lacquer coated lid foil increases aesthetic appeal due to flexibility of choice amongst several colored paper combinations and is compatible to sealing with PVC </p> 
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>			
					</div> <!-- --> 
				</div> 
				 
				<div class="row justify-content-between">
					<div class="col-lg-4 col-md-4"  data-aos="fade-right" data-aos-duration="800"> 
						<p class=""> AALPHA Peel and Push type lid foil and compatible to sealing with PVC/PVDC. </p> 
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>			
					</div> <!-- --> 
					<div class="col-lg-7 col-md-7 sheets">
						<div class="relative">
							<div class="lg-img">
								<div class="crsf_foil_8">
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> Paper </span>  </p>
									<img src="/img/product/paper-sh.png" class="img-fluid" />
								</div>
								<div class="crsf_foil_9" data-aos="fade-up" data-aos-duration="1200"> 
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> PET </span>  </p>
									<img src="/img/product/pet.png" class="img-fluid" /> 
								</div> 
								<div class="crsf_foil_10" data-aos="fade-up" data-aos-duration="1400">
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> Peel Adhesive </span>  </p> 
									<img src="/img/product/peel_adhesive.png" class="img-fluid" />  			
								</div> 
								<div class="crsf_foil_11" data-aos="fade-up" data-aos-duration="1600"> 
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> Foil </span>  </p>
									<img src="/img/product/soft_foil.png" class="img-fluid" />   			
								</div> 
								<div class="crsf_foil_12" data-aos="fade-up" data-aos-duration="1800">
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> HCL </span>  </p> 
									<img src="/img/product/hsl.png" class="img-fluid" />  			
								</div> 
							</div> 
							<div class="sm-img" data-aos="fade-up" data-aos-duration="800">						
								<img src="/img/product/crsf_foils_2.png" class="img-fluid" />
							</div> 
						</div> 
					</div> <!-- -->  
				</div> 
				
				<div class="row justify-content-between">
					<div class="col-lg-7 col-md-7 sheets sheets_oppp">
						<div class="relative">
							<div class="lg-img">
								<div class="crsf_foil_1">
									<p class="mb-0 points-left"> <span> Paper </span> <img src="/img/product/point_1.png" class="img-fluid" /> </p>
									<img src="/img/product/paper-sh.png" class="img-fluid" />
								</div>
								<div class="crsf_foil_2" data-aos="fade-up" data-aos-duration="1200"> 
									<p class="mb-0 points-left"> <span> Foil </span> <img src="/img/product/point_1.png" class="img-fluid" />   </p>
									<img src="/img/product/soft_foil.png" class="img-fluid" />  			
								</div> 
								<div class="crsf_foil_3" data-aos="fade-up" data-aos-duration="1400"> 
									<p class="mb-0 points-left"> <span> HCL </span> <img src="/img/product/point_1.png" class="img-fluid" />   </p>
									<img src="/img/product/hsl.png" class="img-fluid" />  			
								</div>
							</div>
							<div class="sm-img" data-aos="fade-up" data-aos-duration="800">						
								<img src="/img/product/crsf_foils_3.png" class="img-fluid" />
							</div>  
						</div> 
					</div> <!-- --> 
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800"> 
						<p class=""> AALPHA laminated Push through child-resistant & senior friendly (CR) foil is a non-toxic lid foil laminated with paper. </p> 
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>			
					</div> <!-- --> 
				</div>   
			</div>  
		</main> <!-- -->

		<main id="six" class="panel productslide_6">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800">
						<h1 class="bebas text-primary"> Suppositories </h1>
						<p class=""> AALPHA suppositories are solid dosage form intended for insertion into the human body cavities or orifices where they melt or dissolve and exert localised or systematic effect. </p> 			
					</div> <!-- --> 
				</div> 
					
				<div class="row justify-content-center">	
					<div class="col-lg-6 col-md-6 sheets">	
						<div class="relative">	
							<div class="lg-img">
								<div class="supp_1">
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> Soft Foil </span>  </p>
									<img src="/img/product/soft_foil-sh.png" class="img-fluid" />
								</div>
								<div class="supp_2" data-aos="fade-up" data-aos-duration="1200"> 
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> PE </span>  </p>
									<img src="/img/product/pe.png" class="img-fluid" />  			
								</div>
							</div>
							<div class="sm-img" data-aos="fade-up" data-aos-duration="800">						
								<img src="/img/product/suppositories.png" class="img-fluid" />
							</div>  
						</div>
					</div>
				</div>
					
				<div class="row justify-content-between">	
					<div class="col-lg-4 col-md-4"  data-aos="fade-down" data-aos-duration="800">
						<p class=""> Blister packs of suppositories can be made composed of Alu/PE in which  there is a top and bottom foil and sealing occurs with the PE side of both these top and bottom laminates. </p>  
					</div> <!-- -->  
					<div class="col-lg-4 col-md-4"  data-aos="fade-down" data-aos-duration="800">
						<p class=""> Suppository manufacturing and packing operation is a form-fill-seal operation and packing material has to undergo this cycle. Additionally, packing features such as peelable and tear apart can also be provided in the suppository packaging. </p> 
						
						<a href="#" class="view_products text-black maroon_btn"> Enquire Now <span> <img src="/img/icon/next.svg" class="img-fluid" /> </span> </a>
					</div> <!-- -->   
				</div>
			</div>  
		</main> <!-- -->

		<main id="seven" class="panel productslide_7">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4"  data-aos="fade-left" data-aos-duration="800">
						<h1 class="bebas text-primary"> Laminates & Pouches </h1>
						<p class="">Laminates, when used as a packaging material provide protection to the product during transit, display and consumer storage from shelf loss due to bacterial contamination and physical injury. </p> 			
					</div> <!-- --> 
				</div> 
					
				<div class="row justify-content-center">	
					<div class="col-lg-6 col-md-6 sheets">	
						<div class="relative">	
							<div class="lg-img">
								<div class="lamin_1">
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> PET </span>  </p>
									<img src="/img/product/pet-sh.png" class="img-fluid" /> 
								</div>
								<div class="lamin_2" data-aos="fade-up" data-aos-duration="1200"> 
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> Soft Foil </span>  </p>
									<img src="/img/product/soft_foil.png" class="img-fluid" />  			
								</div> 
								<div class="lamin_3" data-aos="fade-up" data-aos-duration="1400"> 
									<p class="mb-0 points-left"> <img src="/img/product/point.png" class="img-fluid" /> <span> PE </span>  </p>
									<img src="/img/product/pe.png" class="img-fluid" />  			
								</div> 
							</div>
							<div class="sm-img" data-aos="fade-up" data-aos-duration="800">						
								<img src="/img/product/laminates_pouches.png" class="img-fluid" />
							</div>  
						</div>
					</div>
				</div>
					
				<div class="row justify-content-between">	
					<div class="col-lg-4 col-md-4"  data-aos="fade-down" data-aos-duration="800">
						<p class=""> The PET film used in the PET-FOIL-POLY laminates not only provides a suitable surface for excellent printing, but also strength to the Aluminium Foil, the other substrate, which is prone to damage during handling. </p>  
					</div> <!-- -->  
					<div class="col-lg-4 col-md-4"  data-aos="fade-down" data-aos-duration="800">
						<p class=""> Foil has the best barrier property and is non toxic in nature. The third substrate of the laminate, PE, acts as a sealing medium and ensures the properties required for immediate contact with the packed material. </p> 
						
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
			<div><a href="#seven"> </a></div> 
		</nav>
 
	</section>
 
 
@include('frontend.layout.beoursupplier')
@include('frontend.layout.client')

@include('frontend.layout.footer')
 
 
<script src="/js/ScrollToPlugin.min.js"></script>
<script type="module" src="/js/product.js"></script> 