                 <!--let's talk modal -->
        <div class="modal fade enquiry-modal alt" id="viewDownloadModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="model-wrapper">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="modal-main">
                                    <div class="modal-header">
                                        <h2 class="heading modal-title fs-5" id="exampleModalLabel">Reach out to us!</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-box">
                                            <form action="{{ route('enquiry.submit') }}" method="post" id="modalForm">
                                                 @csrf
                                               
                                                <div class="form-floating mb-2">
                                                    <input type="text" class="form-control" id="firstName" placeholder=" " name="first_name" required="" />
                                                    <label for="firstName"> First Name <span>*</span> </label>
                                                </div>
                                                <div class="form-floating mb-2">
                                                    <input type="tel" class="form-control" id="lastname" placeholder=" " name="last_name" required="" />
                                                    <label for="lastname"> Last Name <span>*</span> </label>
                                                </div>
                                                <div class="form-floating mb-2">
                                                    <input type="text" class="form-control" id="email" placeholder=" " name="email" required="" />
                                                    <label for="email"> Email <span>*</span> </label>
                                                </div>
                                                <div class="form-floating mb-2">
                                                    <input type="tel" class="form-control" id="phone_number" placeholder=" " name="contact" required="" />
                                                    <label for="phone_number"> Phone Number <span>*</span> </label>
                                                </div>
                                                <div class="form-floating mb-2">
                                                    <textarea class="form-control" name="message" placeholder=" " id="message" style="height: 100px"></textarea>
                                                    <label for="message">Messages</label>
                                                </div>
                                            
                                                <div class="mt-4">
                                                     <button type="submit" class="wc-btn-group" id="submitBtn1" style="border: none; background: none; padding: 0;">
                             <span class="wc-btn-play">
                              <i class="arolax-theme arolax-wcf-icon icon-wcf-arrow-up-right2"></i>
                            </span>
                          <span class="wc-btn-primary" id="btnText1"> Send Message </span>
                            <span class="wc-btn-play">
                                  <i class="arolax-theme arolax-wcf-icon icon-wcf-arrow-up-right2"></i>
                             </span>
                        </button>
                 
                                                  </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="modal-img">
                                    <img src="./img/shera-applications/false-ceiling.jpg" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     <script> 
document.getElementById('modalForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Stop normal form submit

    let form = this;
    let btn1 = document.getElementById('submitBtn1');
    let btnText1 = document.getElementById('btnText1');

    btn1.disabled = true;
    btnText1.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';

    // Send AJAX request
    fetch(form.action, {
        method: "POST",
        body: new FormData(form),
        headers: {
            "X-Requested-With": "XMLHttpRequest"
        }
    })
    .then(response => response.json())
    .then(data => {
        btn1.disabled = false;
        btnText1.innerHTML = "Send Message";

        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Thank you!',
                text: data.success,
                confirmButtonColor: '#3085d6',
            });

            form.reset(); // clear fields
        } else if (data.error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: data.error,
            });
        }
    })
    .catch(err => {
        btn1.disabled = false;
        btnText1.innerHTML = "Send Message";
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong. Please try again.',
        });
    });
});
</script>