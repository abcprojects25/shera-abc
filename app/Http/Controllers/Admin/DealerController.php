<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Dealers;
use Illuminate\Support\Str;
use App\Mail\EnquiryResponseMail;
use Illuminate\Support\Facades\Mail;

class DealerController extends Controller{

    public function index()
{
    $dealers = Dealers::where('status', 1)->get(); // Only non-deleted dealers
    return view('admin.dealers', compact('dealers'));
}

    public function store(Request $request)
{
    $request->validate([
        'firm_name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'owner_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone_number' => 'required|string|max:20',
        'business_start' => 'required|string',
        'products' => 'required|string',
    ]);

    $dealer = new Dealers();
    $dealer->firm_name = $request->firm_name;
    $dealer->location = $request->location;
    $dealer->state = $request->state;
    $dealer->owner_name = $request->owner_name;
    $dealer->email = $request->email;
    $dealer->phone_number = $request->phone_number;
    $dealer->business_start = $request->business_start;
    $dealer->products = $request->products;
    $dealer->status = 1; // default active
    $dealer->url = Str::slug($request->firm_name);
    $dealer->source = $request->source ?? 'dealer';
    $dealer->save();

    Mail::send('admin.emails.dealers_mail', ['dealer' => $dealer], function ($message) use ($dealer) {
            $message->to('sofiya@abcdesigns.in')
                    ->subject('New ' . $dealer->source . ' - ' . $dealer->firm_name);
        });

    return redirect()->back()->with('success', 'Dealer info saved successfully!');
}

public function delete($id)
{
    $dealer = Dealers::findOrFail($id);
    $dealer->delete(); // This will remove the row completely from DB

    return redirect()->back()->with('success', 'Dealer deleted successfully!');
}

}