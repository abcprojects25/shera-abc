@include('frontend.layout.header')
<div class="inner_sec">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-12">
				<h1> Production Facility</h1>
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
						<li class="breadcrumb-item active" aria-current="page">Production Facility</li> 
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- ======= ======= -->

	<section id="contactdtls">  
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="fade-up" data-aos-duration="800">
					<h1 class="bebas text-black main_heading"> infrastructure </h1>  
					<br />
				</div> 
			</div>
			<div class="row portfolio-item grid" id="project_list"  data-aos="fade-down" data-aos-duration="800">  
				<div class="grid-item col-lg-6 col-md-6 col-sm-12 col-xs-12 All"> 
					<a href="/img/infrastructure/lg/1.jpg" data-fancybox="gallery" data-caption="">
						<span> View image </span>
						<img src="/img/infrastructure/1.jpg" alt="" class="img-fluid" />
					</a> 
				</div>
				<div class="grid-item col-lg-3 col-md-3 col-sm-6 All"> 
					<a href="/img/infrastructure/lg/2.jpg" data-fancybox="gallery" data-caption="">
						<span> View image </span>
						<img src="/img/infrastructure/2.jpg" alt="" class="img-fluid" />
					</a> 
				</div>
				<div class="grid-item col-lg-3 col-md-3 col-sm-6 All"> 
					<a href="/img/infrastructure/lg/3.jpg" data-fancybox="gallery" data-caption="">
						<span> View image </span>
						<img src="/img/infrastructure/3.jpg" alt="" class="img-fluid" />
					</a> 
				</div>
				<div class="grid-item col-lg-3 col-md-3 col-sm-6 All"> 
					<a href="/img/infrastructure/lg/4.jpg" data-fancybox="gallery" data-caption="">
						<span> View image </span>
						<img src="/img/infrastructure/4.jpg" alt="" class="img-fluid" />
					</a> 
				</div>
				<div class="grid-item col-lg-3 col-md-3 col-sm-6 All"> 
					<a href="/img/infrastructure/lg/5.jpg" data-fancybox="gallery" data-caption="">
						<span> View image </span>
						<img src="/img/infrastructure/5.jpg" alt="" class="img-fluid" />
					</a> 
				</div>
				<div class="grid-item col-lg-3 col-md-3 col-sm-6 All"> 
					<a href="/img/infrastructure/lg/6.jpg" data-fancybox="gallery" data-caption="">
						<span> View image </span>
						<img src="/img/infrastructure/6.jpg" alt="" class="img-fluid" />
					</a> 
				</div>
				<div class="grid-item col-lg-3 col-md-3 col-sm-6 All"> 
					<a href="/img/infrastructure/lg/7.jpg" data-fancybox="gallery" data-caption="">
						<span> View image </span>
						<img src="/img/infrastructure/7.jpg" alt="" class="img-fluid" />
					</a> 
				</div>
			
				
				<div class="grid-item col-lg-3 col-md-3 col-sm-6 All"> 
					<a href="/img/infrastructure/lg/8.jpg" data-fancybox="gallery" data-caption="">
						<span> View image </span>
						<img src="/img/infrastructure/8.jpg" alt="" class="img-fluid" />
					</a> 
				</div>
				<div class="grid-item col-lg-3 col-md-3 col-sm-6 All"> 
					<a href="/img/infrastructure/lg/9.jpg" data-fancybox="gallery" data-caption="">
						<span> View image </span>
						<img src="/img/infrastructure/9.jpg" alt="" class="img-fluid" />
					</a> 
				</div>
				<div class="grid-item col-lg-6 col-md-6 col-sm-12 col-xs-12 All"> 
					<a href="/img/infrastructure/lg/10.jpg" data-fancybox="gallery" data-caption="">
						<span> View image </span>
						<img src="/img/infrastructure/10.jpg" alt="" class="img-fluid" />
					</a> 
				</div>
				
			</div>
		</div>
	</section>

 

 
@include('frontend.layout.beoursupplier')
@include('frontend.layout.client')

@include('frontend.layout.footer')

<link rel="stylesheet" href="/css/jquery.fancybox.min.css" type="text/css">
<script src="/js/jquery.fancybox.min.js"></script>
<script>
// Fancybox Config
$('[data-fancybox="gallery"]').fancybox({
  buttons: [
    "slideShow",
    "thumbs",
    "zoom",
    "fullScreen", 
    "close"
  ],
  loop: false,
  protect: true
});
</script>
<!--
<script src="/js/isotope.pkgd.js"></script>
<script>
	jQuery(document).ready(function ($) {
		window.onload = function(){
			// init Isotope
			var grid = document.querySelector('.grid');

			var iso = new Isotope( grid, {
			  itemSelector: '.grid-item',
			  percentPosition: true, 
			}); 
		};
	}); // Main document ready END
</script> 
--> 












  