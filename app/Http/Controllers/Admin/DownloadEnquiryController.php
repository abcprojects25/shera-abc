<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\DownloadEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Mail\EnquiryResponseMail;
use Illuminate\Support\Facades\Mail;

class DownloadEnquiryController extends Controller
{

     public function index()
{
    $catalogues = DownloadEnquiry::where('source', 'catalogues')
                      ->get();
    return view('admin.catalogues', compact('catalogues'));
}

     public function certIndex()
{
    $certificates = DownloadEnquiry::where('source', 'certificates')
                      ->get();
    return view('admin.certificates', compact('certificates'));
}

     public function manIndex()
{
    $manuals = DownloadEnquiry::where('source', 'manuals')
                      ->get();
    return view('admin.manuals', compact('manuals'));
}

     public function techIndex()
{
    $techDetails = DownloadEnquiry::where('source', 'technical-details')
                      ->get();
    return view('admin.tech-details', compact('techDetails'));
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'company_name'   => 'required|string|max:255',
            'designation'    => 'required|string|max:255',
            'contact_number' => 'required|string|max:50',
            'email'          => 'required|email',
            'message'        => 'nullable|string',
            'source'         => 'required|string',
            'pdf_name'       => 'required|string',
        ]);

          $enquiry = DownloadEnquiry::create($data + ['is_download' => true]);

    Mail::send('admin.emails.download_enquiry', ['enquiry' => $enquiry], function ($message) use ($enquiry) {
        $message->to('sofiya@abcdesigns.in')
                ->subject('New Download Enquiry - ' . $enquiry->name);
    });

 if ($request->ajax()) {
        return response()->json(['success' => 'Your Data has been submitted successfully! ',
    'pdf'     => $enquiry->pdf_name,
]);
    }

         return redirect()->back()->with([
        'download_pdf' => $data['pdf_name'],
        'download_source' => $data['source'],
    ]);
}

public function destroy($id)
{
    $enquiry = DownloadEnquiry::findOrFail($id);
    $enquiry->delete();

    return redirect()->back()->with('success', 'Enquiry deleted successfully.');
}

}
