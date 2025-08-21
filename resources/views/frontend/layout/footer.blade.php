 <div class="footer_top">
                        <div class="container clients_lising">
                            <div class="row align-center">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <img src="{{ asset('img/logo_w.svg') }}" class="img-fluid" />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                  <div class="d-flex justify-content-end">
                                    <p>Subscribe for updates</p>
                                    <form id="subscribeForm" action="{{ route('subscribe.store') }}" method="post" class="position-relative">
                                        @csrf
                                        <input class="form-control required" type="email" name="email" placeholder="Enter your email" required />
                                      
                                         <button type="submit" class="btn" aria-label="submit" id="subscribeBtn">
                        <img src="img/submit.png" class="img-fluid" id="btnText"/>
                         <span id="loader" class="spinner-border spinner-border-sm d-none" role="status"></span>
                      </button>

                                    </form>
                                </div>

                                <div id="subscribeMessage" class="mt-2"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer_sec">
                        <div class="container">
                            <div class="row justify-content-center align-items-center firts_ftr">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <a href="#" class="nav-link"> <img src="{{ asset('img/icons/call.svg') }}" class="img-fluid" /> +91 8047625780</a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                    <a href="#" class="nav-link"> <img src="{{ asset('img/icons/email.svg') }}" class="img-fluid" /> info@sheraindia.in</a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 text-end social-icons">
                                    <a href="#">
                                        <!-- <i class="fab fa-linkedin"></i>  -->
                                        <img src="{{ asset('img/icons/linkedin.svg') }}" alt="" />
                                    </a>
                                    <a href="#">
                                        <!-- <i class="fab fa-instagram"></i> -->
                                        <img class="instagram" src="{{ asset('img/icons/instagram.svg') }}" alt="" />
                                    </a>
                                    <a href="#">
                                        <!-- <i class="fab fa-youtube"></i>  -->
                                        <img class="youtube" src="{{ asset('img/icons/youtube.svg') }}" alt="" />
                                    </a>
                                </div>
                                <div class="col-12"><div class="divider-style-03"></div></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <h5>Products</h5>
                                    <a href="{{ url('/products') }}"> SHERA PRO </a>
                                    <a href="{{ url('/products') }}"> SHERA NEU </a>
                                    <a href="{{ url('/products') }}"> SHERA Accessories </a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <h5>Applications</h5>
                                    <!-- <a href=""> Roof </a> -->
                                    <a href=""> Ceiling </a>
                                    <a href=""> Wall </a>
                                    <a href=""> Floor </a>
                                    <!-- <a href=""> Fence </a> -->
                                    <!-- <a href=""> Door </a> -->
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <h5>About Us</h5>
                                    <a href="{{ url('/about-us') }}"> Overview </a>
                                    <a href=""> Mission Vision </a>
                                    <a href=""> Milestones </a>
                                    <a href=""> CSR </a>
                                    <a href=""> Sustainability </a>
                                    <a href=""> Team </a>
                                    <a href=""> Shera Global </a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <h5>Others</h5>
                                    <a href=""> Knowledge Center </a>
                                    <a href=""> Resources </a>
                                    <a href="{{ url('careers')}}"> Careers </a>
                                    <a href=""> Support </a>
                                    <a href="{{ url('contact-us') }}"> Contact Us </a>
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center last_ftr">
                                <div class="col-12"><div class="divider-style-03"></div></div>
                                <div class="col-lg-5">
                                    <ul class="d-flex">
                                        <a href="#" class="nav-link">Privacy Policy</a>
                                        <a href="#" class="nav-link">Terms and Conditions</a>
                                    </ul>
                                </div>
                                <div class="col-lg-7 text-end last-paragraph-no-margin">
                                    <p>© 2025 Shera Building Solutions India Private Limited. All Rights Reserved</p>
                                </div>
                            </div>
                        </div>
                    </div>

 <script>
document.getElementById('subscribeForm').addEventListener('submit', function(e) {
    e.preventDefault(); // stop normal form submit

    let form = this;
    let formData = new FormData(form);
    let btnText = document.getElementById('btnText');
    let loader = document.getElementById('loader');
    let msgBox = document.getElementById('subscribeMessage');

    // show loader
    btnText.classList.add('d-none');
    loader.classList.remove('d-none');

    fetch(form.action, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        btnText.classList.remove('d-none');
        loader.classList.add('d-none');

       if (data.success) {
    msgBox.innerHTML = `
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ${data.success}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
    form.reset();
} else if (data.error) {
    msgBox.innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ${data.error}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
}

    })
    .catch(error => {
        btnText.classList.remove('d-none');
        loader.classList.add('d-none');
        msgBox.innerHTML = `<div class="alert alert-danger">Something went wrong!</div>`;
    });
});
</script>
