<!DOCTYPE html>
<html>
<head>
    <title>Job Application</title>
</head>
<body>
    <h2>New Job Application Received</h2>
    <p><strong>Name:</strong> {{ $careerData['career_name'] }}</p>
    <p><strong>Email:</strong> {{ $careerData['career_email'] }}</p>
    <p><strong>Mobile:</strong> {{ $careerData['career_mobile'] }}</p>
    <p><strong>Work Experience:</strong> {{ $careerData['career_work_exp'] }}</p>
    <p><strong>Current Company:</strong> {{ $careerData['career_current_company'] }}</p>
    <p><strong>Current Role:</strong> {{ $careerData['career_current_role'] }}</p>
    <p><strong>Current CTC:</strong> {{ $careerData['career_current_ctc'] }}</p>
    <p><strong>Job Category:</strong> {{ $careerData['career_job_cat'] }}</p>
    <p><strong>Function:</strong> {{ $careerData['career_function'] }}</p>
    <p><strong>Notice Period:</strong> {{ $careerData['career_notice_period'] }}</p>
    <!-- <p><strong>Site:</strong> {{ $careerData['site_val'] }}</p> -->

    @if(!empty($careerData['career_resume']))
        <p><strong>Resume:</strong> <a href="{{ asset('storage/' . $careerData['career_resume']) }}">Download Resume</a></p>
    @endif

    <hr>
    <p><em>This is an automated email from your website career form.</em></p>
</body>
</html>
