<form method="post" action="/contacts/store" id="inquiry" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6 form-group">
            <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="" placeholder="First Name*...." >
            @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> 
        <div class="col-md-6 form-group">
            <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="" placeholder="Last Name*....">
            @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> 
        <div class="col-md-6 form-group">
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="" placeholder="Email...">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
       <div class="col-md-6 form-group">
    <input type="text" id="contact" name="contact"
        class="form-control @error('contact') is-invalid @enderror"
        value="{{ old('contact') }}"
        placeholder="Contact..."
        required
        pattern="\d{10}"
        maxlength="10"
        minlength="10"
        title="Enter a valid 10-digit contact number">
    @error('contact')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
        <div class="col-md-6 form-group">
            <input type="text" id="Requirement" name="designation" class="form-control @error('designation') is-invalid @enderror" value="" placeholder="Requirement....">
            @error('designation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> 
        <div class="col-md-6 form-group">
            <input type="text" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="" placeholder="Company Name...." >
            @error('company_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> 
        <div class="col-md-6 form-group">
            <select class="form-select" name="country" required>
                <option selected disabled> Select Country </option>
                <option value="India">India</option> 
                <option value="USA">USA</option> 
                <option value="UK">UK</option> 
                <!-- Add more countries as needed -->
            </select>  
            @error('country')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror 
        </div> 
        <div class="col-md-6 form-group">
            <select class="form-select" name="industry" required>
                <option selected disabled> Select Industry </option>
                <option value="food">Food</option> 
                <option value="beverage">Beverage</option> 
                <option value="pharmaceutical">Pharmaceutical</option> 
                <option value="other">Other</option> 
            </select>  
            @error('industry')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror 
        </div>  
    </div>
    <div class="form-group">
        <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" placeholder="Message..." cols="30" rows="8"></textarea>
        @error('message')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="submit">
        <input type="submit" name="submit" class="btn btn-primary w-100" value="Submit">
    </div> 
</form>

<script>
document.getElementById("inquiry").addEventListener("submit", function (e) {
    let valid = true;
    let errors = [];
    const email = document.getElementById("email").value.trim();
    const contact = document.getElementById("contact").value.trim();
    const country = document.querySelector("select[name='country']").value;
    const industry = document.querySelector("select[name='industry']").value;
    // Email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email || !emailPattern.test(email)) {
        valid = false;
        errors.push("Please enter a valid email.");
    }
    // Contact validation: only 10-digit number
    const contactPattern = /^\d{10}$/;
    if (!contact || !contactPattern.test(contact)) {
        valid = false;
        errors.push("Please enter a valid 10-digit contact number.");
    }
    // Country and industry required
    if (!country) {
        valid = false;
        errors.push("Please select a country.");
    }
    if (!industry) {
        valid = false;
        errors.push("Please select an industry.");
    }
    // If not valid, prevent submission and show alerts
    if (!valid) {
        e.preventDefault();
        alert(errors.join("\n"));
    }
});
</script>
