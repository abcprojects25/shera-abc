<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Download Enquiry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
        }
        .wrapper {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }
        h2 {
            color: #2a2a2a;
            margin-bottom: 10px;
        }
        p {
            margin: 4px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>New Download Enquiry Received From {{ $enquiry->name }} </h2>

        <p><strong>Name:</strong> {{ $enquiry->name }}</p>
        <p><strong>Company Name:</strong> {{ $enquiry->company_name }}</p>
        <p><strong>Designation:</strong> {{ $enquiry->designation }}</p>
        <p><strong>Contact Number:</strong> {{ $enquiry->contact_number }}</p>
        <p><strong>Email:</strong> {{ $enquiry->email }}</p>
        <p><strong>Source:</strong> {{ $enquiry->source }}</p>
        <p><strong>PDF Downloaded:</strong> {{ $enquiry->pdf_name }}</p>

        @if(!empty($enquiry->message))
            <p><strong>Message:</strong> {{ $enquiry->message }}</p>
        @endif

        <div class="footer">
            <p>This is an automated notification from your website.</p>
        </div>
    </div>
</body>
</html>
