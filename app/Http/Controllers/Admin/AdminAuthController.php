<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;
use App\Models\admin\careers;
use App\Models\Contacts;
use App\Models\admin\Enquiry;
use App\Models\admin\Projects;
use App\Models\admin\Products;
use App\Models\admin\Blogs;
use App\Models\admin\Subscribes;
use Carbon\Carbon;

class AdminAuthController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

    //    print_r($_POST);
    //    exit;

        if(auth()->guard('admin')->attempt(['email' => $request->email,  'password' => $request->password])){
            $user = auth()->guard('admin')->user();
           // if($user->is_admin == 1){
                return redirect()->route('adminDashboard')->with('success','You are Logged in sucessfully.');
           // }
        }else {
            return back()->with('error','Whoops! invalid email and password.');
        }
    }

    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('adminLogin'));
    }
    public function dashboard(Request $request)
    {
        $Careers = careers::select('id','career_name','career_resume','created_at')->orderby('id','desc')->take(2)->get();
        $Contacts = Enquiry::select('id','first_name','contact','email','message','created_at')->orderby('id','desc')->take(2)->get();
        $careersCount = careers::count();
        $EnquiriesCount = Enquiry::count();
        $ProductsCount = Products::count();
        $BlogsCount = Blogs::count();
        $ProjectsCount = Projects::count();
        $SubscribesCount = Subscribes::count();
        $today = Carbon::now()->format('Y-m-d');
        $TodayEnquiries = Enquiry::whereDate("created_at", $today)->count();
        return view('admin.dashboard',compact('Careers','Contacts','EnquiriesCount','careersCount','ProductsCount','BlogsCount','ProjectsCount','SubscribesCount','TodayEnquiries'));
    }

}