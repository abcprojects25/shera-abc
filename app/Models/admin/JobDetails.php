<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class JobDetails extends Model
{
    protected $table = 'job_details';

    protected $fillable = [
        'title',
        'url',
        'location',
        'date_posted',
        'job_type',
        'job_description',
        'responsibilities',
        'skills_and_qualifications',
        'experience',
        'working_hours',
        'working_days',
        'salary',
        'vacancy',
        'deadline',
        'status'
    ];
}