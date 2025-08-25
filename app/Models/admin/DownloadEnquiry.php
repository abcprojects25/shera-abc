<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadEnquiry extends Model
{
    use HasFactory;
    protected $table = 'download_enquiries';
      protected $fillable = [
    'name',
    'company_name',
    'designation',
    'contact_number',
    'email',
    'message',
    'source',
    'pdf_name',
    'is_download',
    
];

}
