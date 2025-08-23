<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\DownloadEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DownloadEnquiryController extends Controller
{
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

          DownloadEnquiry::create($data + ['is_download' => true]);

         return redirect()->back()->with([
        'download_pdf' => $data['pdf_name'],
        'download_source' => $data['source'],
    ]);
}
}
