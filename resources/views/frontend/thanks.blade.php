<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
    <!--<![endif]-->
@include('frontend.layout.header')

<!-- <title>Thanks For Contacting Us...</title> -->

<style>
.error__page { padding-bottom:80px; }
.redirecting {}
.redirecting div#countdown { font-size:30px; }
</style> 

<section class="error__page">
    <div class="container"> 
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10 text-center">
                <div class="error__content">
                    <img src="/img/thanks.png" class="img-fluid mx-auto d-block" />
                    <h2>Thank You for Reaching Out!</h2>
                    <p>We appreciate your inquiry. One of our representatives will get back to you shortly.</p>

                    <div class="redirecting">
                        <div id="countdown">6</div>
                        <p>Redirecting to Home Page...</p> 
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>

@include('frontend.layout.footer')

<script>
$(document).ready(function() {
    let countdown = 6;
    const timer = setInterval(function() {
        countdown--;
        $('#countdown').text(countdown);
        if (countdown <= 0) {
            clearInterval(timer);
            window.location.href = "/"; 
        }
    }, 1000);

    // Clear form fields from previous page when coming back
    if (window.history && window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
});
</script>
