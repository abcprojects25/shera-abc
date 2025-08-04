@include('frontend.layout.header')

<title> Thanks For Contacting Us... </title>

<style>
.error__page { padding-bottom:80px; }
.redirecting {}
.redirecting div#countdown { font-size:30px; }
</style> 

	<section class="error__page">
		<div class="container"> 
			<div class="row  justify-content-center">
				<div class="col-lg-6 col-md-10 text-center">
					<div class="error__content">
						<img src="/img/thanks.png" class="img-fluid mx-auto d-block" />
						<h2>Thank You for Reaching Out!</h2>
						<p> We appreciate your inquiry. One of our representatives will get back to you shortly. </p>

						
						<div class="redirecting">
							<div id="countdown">6</div>
							<p> Redirecting to Home Page...</p> 
						</div>
					</div>
				</div>
			</div>
		</div> 
	</section>
	<!-- Thanks page end -->

@include('frontend.layout.footer')


<script>
$(document).ready(function() {
    let countdown = 6;
    const timer = setInterval(function() {
        countdown--;
        $('#countdown').text(countdown);
        if (countdown <= 0) {
            clearInterval(timer);
            window.location.href = "/"; // Replace with your home page URL
        }
    }, 1000);
});
</script>
 