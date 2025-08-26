<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\JobDetails;
use Illuminate\Support\Str;


class JobController extends Controller
{
   public function index() {
    $jobDetails = JobDetails::all();
    return view('admin.career-details', compact('jobDetails'));
   }

    public function userPage($url) {
    $jobs = JobDetails::where('url', $url)->firstOrFail();
    return view('frontend.career-details', compact('jobs'));
}

public function userListJobs()
{
    $list = JobDetails::latest()->take(3)->get();

    return view('frontend.careers', compact('list'));
}
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        
        'status' => 'required|in:active,inactive,closed',
    ]);

    JobDetails::create([
        'title' => $request->title,
        'url' => Str::slug($request->title),
        'location' => $request->location,
        'date_posted' => $request->date_posted,
        'job_type' => $request->job_type,
        'job_description' => $request->job_description,
        'responsibilities' => $request->responsibilities,
        'skills_and_qualifications' => $request->skills_and_qualifications,
        'experience' => $request->experience,
        'working_hours' => $request->working_hours,
        'working_days' => $request->working_days,
        'salary' => $request->salary,
        'vacancy' => $request->vacancy,
        'deadline' => $request->deadline,
        'status' => $request->status,
    ]);

    return redirect()->route('admin.career-details.index')->with('success', 'Job added successfully!');
}

public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:active,inactive,closed',
        ]);

        $job = JobDetails::findOrFail($id);

        $job->update([
            'title' => $request->title,
            'url' => Str::slug($request->title),
            'location' => $request->location,
            'date_posted' => $request->date_posted,
            'job_type' => $request->job_type,
            'job_description' => $request->job_description,
            'responsibilities' => $request->responsibilities,
            'skills_and_qualifications' => $request->skills_and_qualifications,
            'experience' => $request->experience,
            'working_hours' => $request->working_hours,
            'working_days' => $request->working_days,
            'salary' => $request->salary,
            'vacancy' => $request->vacancy,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.career-details.index')->with('success', 'Job updated successfully!');
    }

public function destroy($id) {
        $job = JobDetails::findOrFail($id);
        $job->delete();
        return redirect()->route('admin.career-details.index')->with('success', 'Job deleted successfully!');
    }


}