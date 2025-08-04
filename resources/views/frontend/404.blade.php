@include('frontend.layout.header')

<style>
.error__page { padding-bottom:80px; }
.error__content img { }
.cta-btn-all { width:220px; }
</style> 

 
	<section class="error__page">
		<div class="container"> 
			<div class="row  justify-content-center">
				<div class="col-lg-6 col-md-10 text-center">
					<div class="error__content">
						<img src="/img/404.jpg" class="img-fluid" alt="Page not found">
						<h2>Sorry! page did not found</h2>
						<p>The page you are looking for doesn't exist or has been moved</p>
						<br />
						<a href="/" class="cta-btn-all cta-btn-blue d-flex justify-content-center align-items-center gap-3 mx-auto">
							<i class="fa-solid fa-chevron-right arrow-1"></i>
							<span class="button-text"> Back to Homepage  </span>
							<i class="fa-solid fa-chevron-right fa-sharp arrow-2"></i>
						</a>  
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Error page end -->

@include('frontend.layout.footer')
 
 
