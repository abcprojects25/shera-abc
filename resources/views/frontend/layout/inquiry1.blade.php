<form method="post" action="/contacts/store" id="inquiry" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6 form-group">
            <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="" placeholder="First Name*...." required="required">
            @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> 
        <div class="col-md-6 form-group">
            <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="" placeholder="Last Name*...." required="required">
            @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> 
        <div class="col-md-6 form-group">
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="" placeholder="Email..." required="required">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6 form-group">
            <input type="number" id="contact" name="contact" class="form-control @error('contact') is-invalid @enderror" value="" placeholder="Contact..." required="required">
            @error('contact')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> 
        <div class="col-md-6 form-group">
            <input type="text" id="designation" name="designation" class="form-control @error('designation') is-invalid @enderror" value="" placeholder="Designation...." required="required">
            @error('designation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> 
        <div class="col-md-6 form-group">
            <input type="text" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="" placeholder="Company Name...." required="required">
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
        <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" placeholder="Message..." cols="30" rows="8" required="required"></textarea>
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
