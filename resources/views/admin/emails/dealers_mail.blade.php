<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Dealer Information</title>
</head>
<body>
    <h2>New Dealer Registered</h2>
    <p><strong>Firm Name:</strong> {{ $dealer->firm_name }}</p>
    <p><strong>Location:</strong> {{ $dealer->location }}</p>
    <p><strong>State:</strong> {{ $dealer->state }}</p>
    <p><strong>Owner Name:</strong> {{ $dealer->owner_name }}</p>
    <p><strong>Email:</strong> {{ $dealer->email }}</p>
    <p><strong>Phone Number:</strong> {{ $dealer->phone_number }}</p>
    <p><strong>Business Start:</strong> {{ $dealer->business_start }}</p>
    <p><strong>Products:</strong> {{ $dealer->products }}</p>
    <p><strong>Status:</strong> {{ $dealer->status == 1 ? 'Active' : 'Inactive' }}</p>
    <p><strong>URL Slug:</strong> {{ $dealer->url }}</p>
</body>
</html>
