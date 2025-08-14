<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\admin\Cmspages;
use Alert;
use Auth;
use Image;
use App\Models\admin\careers;
use App\Models\admin\Subscribes;
use App\Models\admin\Certificates;
use App\Models\admin\Testimonials;
use App\Models\admin\Events;
use App\Models\admin\EventImages;
use App\Models\admin\FAQ;
use App\Models\admin\BranchAddress;
use App\Models\admin\OurMilestones;
use App\Models\admin\FollowUs;
use App\Models\Contacts;
use App\Models\Enquires;
use App\Models\Admin;
use App\Models\Videos;
use Illuminate\Support\Facades\Hash;
use File;
use DB;
use GoogleTranslate;

class CmsController extends Controller
{
    //
    public function cms_listing(){
        $Cmspages_list = Cmspages::select('cmspages.id','category_id','page_title','page_url','cmspages.status','cmspages.created_at')
        ->where('cmspages.is_deleted',0)->orderby('cms_order','asc')->get();

      $count = Cmspages::where('is_deleted',0)->count();
      $activecount = Cmspages::where('status',1)->count();
      $incativecount = Cmspages::where('status',0)->count();
      
      return view('admin.cms.listing',compact('Cmspages_list','count','activecount','incativecount'));
    }

    public function cms_add(){
      $Categories = Categories::select('id','name')->where('status',1)->get();
      return view('admin.cms.add',compact('Categories'));
    }

    public function cms_edit($id){
      $id = base64_decode($id);
      $data = Cmspages::select('id','page_name','page_title','page_url','status','category_id','sub_category_id','meta_keywords',
      'meta_description','contents','created_at')
      ->where('is_deleted',0)->where('id',$id)->first();

      $Categories = Categories::select('id','name')->where('status',1)->get();

      return view('admin.cms.edit',compact('data','Categories'));
    }

    // public function cms_view($id){
    //  $id = base64_decode($id);
    //  $data = Cmspages::where('id',$id)->first();
    //   return view('admin.cms.view',compact('data'));
    // }

    public function cms_store(Request $request)
    {
        $obj = new Cmspages;
        $obj->category_id = $request->category_id;
        $obj->sub_category_id = $request->sub_category_id;
        $obj->page_name = $request->name;
        $obj->page_title = $request->page_title;
        $obj->page_url = $request->page_url;
        $obj->contents = $request->description;
        $obj->meta_keywords = $request->meta_keywords;
        $obj->meta_description = $request->meta_description;
        $obj->status = $request->is_active;
        $obj->save();
         
        toast('Page added successfully!!!','success');
         return redirect('/admin/cms/all-pages');
    }

    public function cms_update(Request $request){
        $update = Cmspages::find($request->id);
        $update->category_id = $request->category_id;
        $update->sub_category_id = $request->sub_category_id;
        $update->page_name = $request->name;
        $update->page_title = $request->page_title;
        $update->page_url = $request->page_url;
        $update->contents = $request->description;
        $update->meta_keywords = $request->meta_keywords;
        $update->meta_description = $request->meta_description;
        $update->status = $request->is_active;
        $update->update();

        toast('Page updated successfully!!!','success');
        return redirect('/admin/cms/all-pages');

    }

    public function cms_delete($id)
    {
      $id=base64_decode($id);
      $del = Cmspages::find($id);
      $del->status =0;
      $del->is_deleted =1;
      $del->update();

      toast('Page Successfully Deleted!!!','success');
      return redirect()->back();
    }

    public function cmsStatus($status,$id)
    {
      $id=base64_decode($id);
      $status = base64_decode($status);
      if($status == 0){
        Cmspages::where('id',$id)->update(['status' => 1]);
      }else{
        Cmspages::where('id',$id)->update(['status' => 0]);
      }
      toast('Status Updated Successfully!!!','success');

      return redirect()->back();

    }
    
    // -------------------START------------------
    public function Career()
    {
      $careers = careers::where('is_deleted',0)->paginate(10);
      return view('admin.career',compact('careers'))->render();
    }

    public function CareerDelete($id){
        $delete_id=base64_decode($id);
        careers::where('id',$delete_id)->delete();
        toast('Career Deleted Successfully!!!','success');
        return redirect()->back();
    }

    public function Subscribe()
    {
      $Subscribes = Subscribes::latest()->paginate(10);
      return view('admin.newsletter_subscription',compact('Subscribes'))->render();
    }

    public function SubscribeDelete($id){
        $delete_id=base64_decode($id);
        Subscribes::where('id',$delete_id)->delete();
        toast('Career Deleted Successfully!!!','success');
        return redirect()->back();
    }
    // Contact us
	public function ContactUs(){
    $data = DB::select("SELECT * FROM enquires ORDER BY created_at DESC");
      return view('admin.contact-us',compact('data'));
    }
    
    public function cartenquiry(){
         $data = DB::select("
        SELECT
            ce.id AS enquiry_id,
            ce.client_name,
            ce.email,
            ce.contact_no,
            ce.office_address,
            ce.created_at,
            ci.product_name,
            ci.product_image,
            ci.quantity,
            ci.requirement
        FROM cart_enquiry ce
        LEFT JOIN cart_items ci ON ce.id = ci.cart_enquiry_id
        ORDER BY ce.created_at DESC
    ");
      return view ('admin.product-inquiry',compact('data'));
    }
public function destroy($id)
{
    $id = base64_decode($id); // If you're encoding it in the URL
    DB::table('enquires')->where('id', $id)->delete();
    return redirect()->back()->with('success', 'Enquiry deleted successfully.');
}
    public function ContactUsDelete($id){
      $delete_id=base64_decode($id);
      Contacts::where('id',$delete_id)->delete();
      toast('Deleted Successfully!!!','success');
      return redirect()->back();
    }
    /*public function ContactUs(){
      $data = Contacts::orderBy('id','desc')->get();
      return view('admin.contact-us',compact('data'));
    }

    public function ContactUsDelete($id){
      $delete_id=base64_decode($id);
      Contacts::where('id',$delete_id)->delete();
      toast('Deleted Successfully!!!','success');
      return redirect()->back();
    }
	*/

    //Inquiry
    public function inquiry()
    {
      $data = Enquires::orderBy('id','desc')->get();
      return view('admin.inquiry',compact('data'));
    }

    public function InquiryDelete($id){
        $delete_id=base64_decode($id);
        Enquires::where('id',$delete_id)->delete();
        toast('Inquiry Deleted Successfully!!!','success');
        return redirect()->back();
    }

    //Design Serve
    public function DesignServe(){
      $data = DB::table('design_serves')->orderBy('id','desc')->get();
      return view('admin.design_serve',compact('data'));
    }

    
    public function DesignServeDelete($id,$file){
      $delete_id=base64_decode($id);
      $file=base64_decode($file);
      $Image_path = public_path().$file;
      
      if(File::exists($Image_path)) {
        File::delete($Image_path);
      }
      DB::table('design_serves')->where('id',$delete_id)->delete();
      toast('Design Serve Deleted Successfully!!!','success');
      return redirect()->back();
  }

    // Branches Start Here
    public function BranchesLocation(){
      $BranchAddress = BranchAddress::paginate(10);
      return view('admin.branch_address',compact('BranchAddress'))->render();
    }

    public function BranchesLocationAdd(){
      return view('admin.branch_address_add');
    }

    public function BranchesLocationEdit($eid){
      $eid = base64_decode($eid);
      $edit_data = BranchAddress::where('id',$eid)->first();
      return view('admin.branch_address_edit',compact('edit_data'));
    }

    public function BranchesLocationStore(Request $request){
      if($request->branch_img != null){
        $rnd = rand(111,999);
        $extension = $request->branch_img->getClientOriginalExtension();
        $file = $request->file('branch_img');
        $title_img = 'map_'.$rnd.'.'.$extension;
        $path_img = '/img/map/map_'.$rnd.'.'.$extension;
        $path = public_path().'/img/map/';
        $file->move($path, $title_img);
      }else{
        $path_img = null;
      }

      if($request->branch_name != null){
        $ar_branch = GoogleTranslate::trans($request->branch_name, 'ar');
        $es_branch = GoogleTranslate::trans($request->branch_name, 'es');
        $fr_branch = GoogleTranslate::trans($request->branch_name, 'fr');
        $sw_branch = GoogleTranslate::trans($request->branch_name, 'sw');
      }else{
        $ar_branch = null;
        $es_branch = null;
        $fr_branch = null;
        $sw_branch = null;
      }

      if($request->direction != null){
        $ar_direction = GoogleTranslate::trans($request->direction, 'ar');
        $es_direction = GoogleTranslate::trans($request->direction, 'es');
        $fr_direction = GoogleTranslate::trans($request->direction, 'fr');
        $sw_direction = GoogleTranslate::trans($request->direction, 'sw');
      }else{
        $ar_direction = null;
        $es_direction = null;
        $fr_direction = null;
        $sw_direction = null;
      }

      if($request->branch_heading != null){
        $ar_branch_heading = GoogleTranslate::trans($request->branch_heading, 'ar');
        $es_branch_heading = GoogleTranslate::trans($request->branch_heading, 'es');
        $fr_branch_heading = GoogleTranslate::trans($request->branch_heading, 'fr');
        $sw_branch_heading = GoogleTranslate::trans($request->branch_heading, 'sw');
      }else{
        $ar_branch_heading = null;
        $es_branch_heading = null;
        $fr_branch_heading = null;
        $sw_branch_heading = null;
      }

      if($request->branch_address != null){
        $ar_branch_address = GoogleTranslate::trans($request->branch_address, 'ar');
        $es_branch_address = GoogleTranslate::trans($request->branch_address, 'es');
        $fr_branch_address = GoogleTranslate::trans($request->branch_address, 'fr');
        $sw_branch_address = GoogleTranslate::trans($request->branch_address, 'sw');
      }else{
        $ar_branch_address = null;
        $es_branch_address = null;
        $fr_branch_address = null;
        $sw_branch_address = null;
      }

      $obj = new BranchAddress;
      $obj->direction = $request->direction;
      $obj->ar_direction = $ar_direction;
      $obj->es_direction = $es_direction;
      $obj->fr_direction = $fr_direction;
      $obj->sw_direction = $sw_direction;
      $obj->branch = $request->branch_name;
      $obj->ar_branch = $ar_branch;
      $obj->es_branch = $es_branch;
      $obj->fr_branch = $fr_branch;
      $obj->sw_branch = $sw_branch;
      $obj->longitude = $request->longitude;
      $obj->latitude = $request->latitude;
      $obj->branch_heading = $request->branch_heading;  
      $obj->ar_branch_heading = $ar_branch_heading;
      $obj->es_branch_heading = $es_branch_heading;
      $obj->fr_branch_heading = $fr_branch_heading;
      $obj->sw_branch_heading = $sw_branch_heading;
      $obj->branch_number = $request->branch_number;  
      $obj->branch_email = $request->branch_email;  
      $obj->branch_address = $request->branch_address; 
      $obj->ar_branch_address = $ar_branch_address;
      $obj->es_branch_address = $es_branch_address;
      $obj->fr_branch_address = $fr_branch_address;
      $obj->sw_branch_address = $sw_branch_address;
      $obj->branch_image = $path_img;
      $obj->status = 1;
      $obj->save();
      toast('Branch Added Successfully!!!','success');
      return redirect('/admin/branches-location');
    }

    public function BranchesLocationUpdate(Request $request){
      ini_set('memory_limit', '3072M');
      ini_set('max_execution_time', 10980);
      ini_set('upload_max_filesize', '50M');

      $PDF_Path = $request->edit_branch_img;
      if(File::exists($PDF_Path) && $request->branch_img != null) {
          File::delete($PDF_Path);
      }

      if($request->branch_img != null){
        $rnd = rand(111,999);
        $extension = $request->branch_img->getClientOriginalExtension();
        $file = $request->file('branch_img');
        $title_img = 'map_'.$rnd.'.'.$extension;
        $path_img = '/img/map/map_'.$rnd.'.'.$extension;
        $path = public_path().'/img/map/';
        $file->move($path, $title_img);
      }else{
        $path_img = $request->edit_branch_img;
      }

      if($request->branch_name != null){
        $ar_branch = GoogleTranslate::trans($request->branch_name, 'ar');
        $es_branch = GoogleTranslate::trans($request->branch_name, 'es');
        $fr_branch = GoogleTranslate::trans($request->branch_name, 'fr');
        $sw_branch = GoogleTranslate::trans($request->branch_name, 'sw');
      }else{
        $ar_branch = null;
        $es_branch = null;
        $fr_branch = null;
        $sw_branch = null;
      }

      if($request->direction != null){
        $ar_direction = GoogleTranslate::trans($request->direction, 'ar');
        $es_direction = GoogleTranslate::trans($request->direction, 'es');
        $fr_direction = GoogleTranslate::trans($request->direction, 'fr');
        $sw_direction = GoogleTranslate::trans($request->direction, 'sw');
      }else{
        $ar_direction = null;
        $es_direction = null;
        $fr_direction = null;
        $sw_direction = null;
      }

      if($request->branch_heading != null){
        $ar_branch_heading = GoogleTranslate::trans($request->branch_heading, 'ar');
        $es_branch_heading = GoogleTranslate::trans($request->branch_heading, 'es');
        $fr_branch_heading = GoogleTranslate::trans($request->branch_heading, 'fr');
        $sw_branch_heading = GoogleTranslate::trans($request->branch_heading, 'sw');
      }else{
        $ar_branch_heading = null;
        $es_branch_heading = null;
        $fr_branch_heading = null;
        $sw_branch_heading = null;
      }

      if($request->branch_address != null){
        $ar_branch_address = GoogleTranslate::trans($request->branch_address, 'ar');
        $es_branch_address = GoogleTranslate::trans($request->branch_address, 'es');
        $fr_branch_address = GoogleTranslate::trans($request->branch_address, 'fr');
        $sw_branch_address = GoogleTranslate::trans($request->branch_address, 'sw');
      }else{
        $ar_branch_address = null;
        $es_branch_address = null;
        $fr_branch_address = null;
        $sw_branch_address = null;
      }

      $obj = BranchAddress::find($request->edit_id);
      $obj->direction = $request->direction;
      $obj->ar_direction = $ar_direction;
      $obj->es_direction = $es_direction;
      $obj->fr_direction = $fr_direction;
      $obj->sw_direction = $sw_direction;
      $obj->branch = $request->branch_name;
      $obj->ar_branch = $ar_branch;
      $obj->es_branch = $es_branch;
      $obj->fr_branch = $fr_branch;
      $obj->sw_branch = $sw_branch;
      $obj->longitude = $request->longitude;
      $obj->latitude = $request->latitude;  
      $obj->branch_heading = $request->branch_heading;  
      $obj->ar_branch_heading = $ar_branch_heading;
      $obj->es_branch_heading = $es_branch_heading;
      $obj->fr_branch_heading = $fr_branch_heading;
      $obj->sw_branch_heading = $sw_branch_heading;
      $obj->branch_number = $request->branch_number;  
      $obj->branch_email = $request->branch_email;  
      $obj->branch_address = $request->branch_address;  
      $obj->ar_branch_address = $ar_branch_address;
      $obj->es_branch_address = $es_branch_address;
      $obj->fr_branch_address = $fr_branch_address;
      $obj->sw_branch_address = $sw_branch_address;
      $obj->branch_image = $path_img;
      $obj->status = 1;
      $obj->update();
      toast('Branch Updated Successfully!!!','success');
      return redirect('/admin/branches-location');
    }

    public function BranchesLocationStatus($status,$id){
      $id=base64_decode($id);
      $status = base64_decode($status);
      if($status == 0){
        BranchAddress::where('id',$id)->update(['status' => 1]);
      }else{
        BranchAddress::where('id',$id)->update(['status' => 0]);
      }
      toast('Status Updated Successfully!!!','success');
      return redirect('/admin/branches-location');
    }


    public function BranchesLocationDelete($id){
      $delete_id=base64_decode($id);

      $check = BranchAddress::select('branch_image')->where('id',$delete_id)->first();
      $PDF_Path = $check->branch_image;
      if(File::exists($PDF_Path)){
          File::delete($PDF_Path);
      }
      BranchAddress::where('id',$delete_id)->delete();
      toast('Branch Deleted Successfully!!!','success');
      return redirect('/admin/branches-location');
    }
    // Branches End Here

    public function FollowUs(){
      $FollowUs = FollowUs::where('is_deleted',0)->paginate();
      return view('admin.follow_us',compact('FollowUs'))->render();
    }

    public function FollowUsAdd(Request $request){

      if($request->image != null){
        $rnd = rand(111,999);
        $extension = $request->image->getClientOriginalExtension();
        $file = $request->file('image');
        $title_img = 'follow_us'.'_'.$rnd.'.'.$extension;
        $path_img = '/img/follow_us'.'_'.$rnd.'.'.$extension;
        $path = public_path().'/img/';
        $file->move($path, $title_img);
      }else{
        $path_img = null;
      }

      $obj = new FollowUs;
      $obj->url = $request->url;
      $obj->images = $path_img;
      $obj->icons = $request->icon;
      $obj->status = 1;
      $obj->save();

      return redirect('/admin/follow-us');
    }

    public function FollowUsStatus($status,$id){
      $id=base64_decode($id);
      $status = base64_decode($status);
      if($status == 0){
        FollowUs::where('id',$id)->update(['status' => 1]);
      }else{
        FollowUs::where('id',$id)->update(['status' => 0]);
      }
      toast('Status Updated Successfully!!!','success');

      return redirect()->back();
    } 
    
    public function FollowUsUpdate(Request $request){

      if($request->image != null){
        $rnd = rand(111,999);
        $extension = $request->image->getClientOriginalExtension();
        $file = $request->file('image');
        $title_img = 'follow_us'.'_'.$rnd.'.'.$extension;
        $path_img = '/img/follow_us'.'_'.$rnd.'.'.$extension;
        $path = public_path().'/img/';
        $file->move($path, $title_img);
      }else{
        $path_img = $request->edit_image_prv;
      }

      $obj = FollowUs::find($request->edit_id);
      $obj->url = $request->url;
      $obj->images = $path_img;
      $obj->icons = $request->icon;
      $obj->status = 1;
      $obj->save();
      return redirect()->back();
    }

    
    public function FollowUsDelete($id){
      $id=base64_decode($id);
      FollowUs::where('id',$id)->update(['is_deleted' => 1]);
      toast('Successfully Deleted!!!','success');
      return redirect()->back();
    }

    public function faqList()
    {
      $faqs = FAQ::orderBy('id','desc')->paginate(10);
      return view('admin.faq',compact('faqs'));
    }

    public function faqStore(Request $request){

      if($request->question != null){
        $ar_question = GoogleTranslate::trans($request->question, 'ar');
        $es_question = GoogleTranslate::trans($request->question, 'es');
        $fr_question = GoogleTranslate::trans($request->question, 'fr');
        $sw_question = GoogleTranslate::trans($request->question, 'sw');
      }else{
        $ar_question = null;
        $es_question = null;
        $fr_question = null;
        $sw_question = null;
      }

      if($request->answer != null){
        $ar_answer = GoogleTranslate::trans($request->answer, 'ar');
        $es_answer = GoogleTranslate::trans($request->answer, 'es');
        $fr_answer = GoogleTranslate::trans($request->answer, 'fr');
        $sw_answer = GoogleTranslate::trans($request->answer, 'sw');
      }else{
        $ar_answer = null;
        $es_answer = null;
        $fr_answer = null;
        $sw_answer = null;
      }
      
     $faq  = new FAQ;
     $faq->question = $request->question;
     $faq->ar_question = $ar_question;
     $faq->es_question = $es_question;
     $faq->fr_question = $fr_question;
     $faq->sw_question = $sw_question;
     $faq->answer = $request->answer;
     $faq->ar_answer = $ar_answer;
     $faq->es_answer = $es_answer;
     $faq->fr_answer = $fr_answer;
     $faq->sw_answer = $sw_answer;
     $faq->status = 1;
     $faq->save();

     toast('FAQ added successfully!!!','success');
     return redirect()->back();

    }

    public function faqUpdate(Request $request){

      if($request->question != null){
        $ar_question = GoogleTranslate::trans($request->question, 'ar');
        $es_question = GoogleTranslate::trans($request->question, 'es');
        $fr_question = GoogleTranslate::trans($request->question, 'fr');
        $sw_question = GoogleTranslate::trans($request->question, 'sw');
      }else{
        $ar_question = null;
        $es_question = null;
        $fr_question = null;
        $sw_question = null;
      }

      if($request->answer != null){
        $ar_answer = GoogleTranslate::trans($request->answer, 'ar');
        $es_answer = GoogleTranslate::trans($request->answer, 'es');
        $fr_answer = GoogleTranslate::trans($request->answer, 'fr');
        $sw_answer = GoogleTranslate::trans($request->answer, 'sw');
      }else{
        $ar_answer = null;
        $es_answer = null;
        $fr_answer = null;
        $sw_answer = null;
      }

      $faq = FAQ::find($request->edit_id);
      $faq->question = $request->question;
      $faq->ar_question = $ar_question;
      $faq->es_question = $es_question;
      $faq->fr_question = $fr_question;
      $faq->sw_question = $sw_question;
      $faq->answer = $request->answer;
      $faq->ar_answer = $ar_answer;
      $faq->es_answer = $es_answer;
      $faq->fr_answer = $fr_answer;
      $faq->sw_answer = $sw_answer;
      $faq->status = $request->is_active;
      $faq->save();

      toast('Page Successfully Updated!!!','success');
      return redirect()->back();
    }

    public function faqDelete($id){
      $delete_id=base64_decode($id);
      FAQ::where('id',$delete_id)->delete();
      toast('FAQ Deleted Successfully!!!','success');
      return redirect()->back();
    }

    public function changePasswordIndex(){
      return view('admin.change_password');
    }

    public function changePassword(Request $request){
      $admin_email = Auth::guard('admin')->user()->email;
      if (Hash::check($request->old_password, Auth::guard('admin')->user()->password)) {
        if($request->new_password == $request->confirm_password){
          Admin::where('email',$admin_email)
            ->update(['password' => Hash::make($request->confirm_password)]);
          toast('Password Changed Successfully!!!','success');
        }else{
          toast('Somting Went Wrong!','error');
        }
      }else{
        toast('Old Password Not Matched!','error');
      }

      return view('admin.change_password');

    }

    public function sorting(Request $request)
    {
      $posts = Cmspages::all();
      foreach ($posts as $post) {
        foreach ($request->order as $order) {
          if ($order['id'] == $post->id) {
              $cms = Cmspages::find($post->id);
              $cms->cms_order= $order['position'];
              $cms->save();
            }
          }
        }
        return response(['message' => 'Sorting Update Successfully'], 200);
    }
    // ------------------END-------------------

    // -------------------Test certificate-----------------------
    public function TestCertificate_index(){
      $Certificates = Certificates::latest()->get();
      return view('admin.about.certificate_listing',compact('Certificates'));
    }

    public function certificate_add(){
      return view('admin.about.certificate_add');
    }

    public function certificateStore(Request $request){
      $request->validate([
          'certificate_pdf' => 'required|mimes:pdf'
       ]);
       $rand = rand(1111,9999);
       //upload pdf        
       $foldname = 'test_certificate';
       $fileName = 'Certificate_PDF'.'_'.$rand;
       $PDFile = $request->file('certificate_pdf');
       $pdf_url = $this->uploadImage($PDFile,$foldname,$fileName);
  
       // Upload thumnail file
      if($request->thumnail != null){
          $thumnail = $this->uploadcropimages($request->thumnail,$foldname,'Certificate_'.$rand);
      }else{
          $thumnail = $request->thumnail;
      }

      $tags = implode(',',$request->tags);

      $obj = new Certificates();
      $obj->title = $request->certificate_title;
      $obj->thumnail = $thumnail;
      $obj->type =  $request->type;
      $obj->pdf = $pdf_url;  
      $obj->tags = $tags;
      $obj->certificate_assigned_by = $request->certificate_assigned_by;      
      $obj->status = 1;
      $obj->save();
     toast('Certificate Inserted Successfully!!!','success');
    return redirect('/admin/about/test-certificate');
  }

  public function certificate_edit($id){
    $id = base64_decode($id);
    $EditData = Certificates::where('id',$id)->first();
    return view('admin.about.certificate_edit',compact('EditData'));
  }

  public function certificateUpdate(Request $request){
    if($request->certificate_pdf != null){
      $request->validate([
        'certificate_pdf' => 'required|mimes:pdf'
      ]);
    }
    $rand = rand(1111,9999);
     //Delete Existing PDF if  
    $PDF_Path = public_path().'/img/about/test_certificate/'.$request->edit_pdf;
    if(File::exists($PDF_Path) && $request->certificate_pdf != null) {
        File::delete($PDF_Path);
    }
      //Delete Existing File if
    $Image_path = public_path().'/'.$request->edit_thumnail;
    if(File::exists($Image_path) && $request->thumnail != null) {
      File::delete($Image_path);
    }
    //upload pdf   
    $foldname = 'test_certificate';
    if($request->certificate_pdf != null){
      $fileName = 'Certificate_PDF'.'_'.$rand;
      $PDFile = $request->file('certificate_pdf');
      $pdf_url = $this->uploadImage($PDFile,$foldname,$fileName);
    }else{
      $pdf_url = $request->edit_pdf;
    }
    // Upload thumnail file
    if($request->thumnail != null){
        $thumnail = $this->uploadcropimages($request->thumnail, $foldname,'Certificate_'.$rand);
    }else{
        $thumnail = $request->edit_thumnail;
    }

  $tags = implode(',',$request->tags);

  $obj = Certificates::find($request->edit_id);
  $obj->title = $request->certificate_title;
  $obj->thumnail = $thumnail;
  $obj->type =  $request->type;
  $obj->pdf = $pdf_url;  
  $obj->tags = $tags;
  $obj->certificate_assigned_by = $request->certificate_assigned_by;
  $obj->status = 1;
  $obj->save();
   toast('Certificate Updated Successfully!!!','success');
   return redirect('/admin/about/test-certificate');
}

public function certificateDelete($id){
  $delete_id=base64_decode($id);
  $result = Certificates::select('thumnail')->where('id',$delete_id)->first();
  $Image_path = public_path().$result->thumnail;
  if(File::exists($Image_path)) {
    File::delete($Image_path);
  }

  Certificates::where('id',$delete_id)->delete();

    toast('Certificate Deleted Successfully!!!','success');
    return redirect()->back();
}

public function certificateStatus($status,$id){
  $id=base64_decode($id);
  $status = base64_decode($status);
  if($status == 0){
   Certificates::where('id',$id)->update(['status' => 1]);
  }else{
   Certificates::where('id',$id)->update(['status' => 0]);
  }
  toast('Status Updated Successfully!!!','success');
  return redirect()->back();
}

// -----------------------Testimonials---------------------------
  public function Testimonials_Index(){
    $Testimonials = Testimonials::latest()->get();
    return view('admin.about.testimonial_listing',compact('Testimonials'));
  }

  public function testimonial_add(){
    return view('admin.about.testimonial_add');
  }

  public function testimonialStore(Request $request){
    $rand = rand(1111,9999);
  
    // Upload thumnail file
      if($request->thumnail != null){
          $foldname = 'testimonial';
          $thumnail = $this->uploadcropimages($request->thumnail, $foldname,'Testimonial_'.$rand);
      }else{
          $thumnail = $request->thumnail;
      }

    if($request->name !== null){
      $ar_name = GoogleTranslate::trans($request->name, 'ar');
      $es_name = GoogleTranslate::trans($request->name, 'es');
      $fr_name = GoogleTranslate::trans($request->name, 'fr');
      $sw_name = GoogleTranslate::trans($request->name, 'sw');
    }else{
      $ar_name = null;
      $es_name = null;
      $fr_name = null;
      $sw_name = null;
    }

    if($request->occupation !== null){
      $ar_occupation = GoogleTranslate::trans($request->occupation, 'ar');
      $es_occupation = GoogleTranslate::trans($request->occupation, 'es');
      $fr_occupation = GoogleTranslate::trans($request->occupation, 'fr');
      $sw_occupation = GoogleTranslate::trans($request->occupation, 'sw');
    }else{
      $ar_occupation = null;
      $es_occupation = null;
      $fr_occupation = null;
      $sw_occupation = null;
    }

    if($request->occupation !== null){
      $ar_designation_company = GoogleTranslate::trans($request->designation_company, 'ar');
      $es_designation_company = GoogleTranslate::trans($request->designation_company, 'es');
      $fr_designation_company = GoogleTranslate::trans($request->designation_company, 'fr');
      $sw_designation_company = GoogleTranslate::trans($request->designation_company, 'sw');
    }else{
      $ar_designation_company = null;
      $es_designation_company = null;
      $fr_designation_company = null;
      $sw_designation_company = null;
    }

    if($request->description !== null){
      $ar_description = GoogleTranslate::trans($request->description, 'ar');
      $es_description = GoogleTranslate::trans($request->description, 'es');
      $fr_description = GoogleTranslate::trans($request->description, 'fr');
      $sw_description = GoogleTranslate::trans($request->description, 'sw');
    }else{
      $ar_description = null;
      $es_description = null;
      $fr_description = null;
      $sw_description = null;
    }

    $obj = new Testimonials();
    $obj->name =  $request->name;
    $obj->ar_name = $ar_name;
    $obj->es_name = $es_name;
    $obj->fr_name = $fr_name;
    $obj->sw_name = $sw_name;
    $obj->occupation = $request->occupation;
    $obj->ar_occupation = $ar_occupation;
    $obj->es_occupation = $es_occupation;
    $obj->fr_occupation = $fr_occupation;
    $obj->sw_occupation = $sw_occupation;
    $obj->thumnail = $thumnail;
    $obj->video_url = $request->video_url;  
    $obj->video_thumb = $request->video_thumb;  
    $obj->type = $request->type;
    $obj->designation_company = $request->designation_company;
    $obj->ar_designation_company = $ar_designation_company;
    $obj->es_designation_company = $es_designation_company;
    $obj->fr_designation_company = $fr_designation_company;
    $obj->sw_designation_company = $sw_designation_company;
    $obj->description = $request->description;  
    $obj->ar_description = $ar_description;
    $obj->es_description = $es_description;
    $obj->fr_description = $fr_description;
    $obj->sw_description = $sw_description;
    $obj->status = 1;
    $obj->save();

    toast('Testimonial Inserted Successfully!!!','success');
    return redirect('/admin/about/testimonials');
  }

  public function testimonialStatus($status,$id){
    $id=base64_decode($id);
    $status = base64_decode($status);
    if($status == 0){
      Testimonials::where('id',$id)->update(['status' => 1]);
    }else{
      Testimonials::where('id',$id)->update(['status' => 0]);
    }
    toast('Status Updated Successfully!!!','success');
    return redirect()->back();
  }

  public function testimonial_edit($id){
    $id = base64_decode($id);
    $EditData = Testimonials::where('id',$id)->first();
    return view('admin.about.testimonial_edit',compact('EditData'));
  }

  public function testimonialUpdate(Request $request){
    $rand = rand(1111,9999);
      //Delete Existing File if
    $Image_path = public_path().'/'.$request->edit_thumnail;
    if(File::exists($Image_path) && $request->thumnail != null) {
      File::delete($Image_path);
    }
   
    // Upload thumnail file
    if($request->thumnail != null){
      $foldname = 'testimonial';
      $thumnail = $this->uploadcropimages($request->thumnail, $foldname,'Testimonial_'.$rand);
    }else{
        $thumnail = $request->edit_thumnail;
    }

    if($request->name !== null){
      $ar_name = GoogleTranslate::trans($request->name, 'ar');
      $es_name = GoogleTranslate::trans($request->name, 'es');
      $fr_name = GoogleTranslate::trans($request->name, 'fr');
      $sw_name = GoogleTranslate::trans($request->name, 'sw');
    }else{
      $ar_name = null;
      $es_name = null;
      $fr_name = null;
      $sw_name = null;
    }

    if($request->occupation !== null){
      $ar_occupation = GoogleTranslate::trans($request->occupation, 'ar');
      $es_occupation = GoogleTranslate::trans($request->occupation, 'es');
      $fr_occupation = GoogleTranslate::trans($request->occupation, 'fr');
      $sw_occupation = GoogleTranslate::trans($request->occupation, 'sw');
    }else{
      $ar_occupation = null;
      $es_occupation = null;
      $fr_occupation = null;
      $sw_occupation = null;
    }

    if($request->occupation !== null){
      $ar_designation_company = GoogleTranslate::trans($request->designation_company, 'ar');
      $es_designation_company = GoogleTranslate::trans($request->designation_company, 'es');
      $fr_designation_company = GoogleTranslate::trans($request->designation_company, 'fr');
      $sw_designation_company = GoogleTranslate::trans($request->designation_company, 'sw');
    }else{
      $ar_designation_company = null;
      $es_designation_company = null;
      $fr_designation_company = null;
      $sw_designation_company = null;
    }

    if($request->description !== null){
      $ar_description = GoogleTranslate::trans($request->description, 'ar');
      $es_description = GoogleTranslate::trans($request->description, 'es');
      $fr_description = GoogleTranslate::trans($request->description, 'fr');
      $sw_description = GoogleTranslate::trans($request->description, 'sw');
    }else{
      $ar_description = null;
      $es_description = null;
      $fr_description = null;
      $sw_description = null;
    }

    $obj = Testimonials::find($request->edit_id);
    $obj->name =  $request->name;
    $obj->ar_name = $ar_name;
    $obj->es_name = $es_name;
    $obj->fr_name = $fr_name;
    $obj->sw_name = $sw_name;
    $obj->occupation = $request->occupation;
    $obj->ar_occupation = $ar_occupation;
    $obj->es_occupation = $es_occupation;
    $obj->fr_occupation = $fr_occupation;
    $obj->sw_occupation = $sw_occupation;
    $obj->thumnail = $thumnail;
    $obj->video_url = $request->video_url; 
    $obj->video_thumb = $request->video_thumb;  
    $obj->type = $request->type;
    $obj->designation_company = $request->designation_company;
    $obj->ar_designation_company = $ar_designation_company;
    $obj->es_designation_company = $es_designation_company;
    $obj->fr_designation_company = $fr_designation_company;
    $obj->sw_designation_company = $sw_designation_company;
    $obj->description = $request->description;  
    $obj->ar_description = $ar_description;
    $obj->es_description = $es_description;
    $obj->fr_description = $fr_description;
    $obj->sw_description = $sw_description;
    $obj->status = 1;
    $obj->save();

   toast('Testimonial Updated Successfully!!!','success');
   return redirect('/admin/about/testimonials');
  }

  public function testimonialDelete($id){
    $delete_id=base64_decode($id);
    $result = Testimonials::select('thumnail')->where('id',$delete_id)->first();
    $Image_path = public_path().$result->thumnail;
      if(File::exists($Image_path)) {
        File::delete($Image_path);
      }
      Testimonials::where('id',$delete_id)->delete();
      toast('Testimonial Deleted Successfully!!!','success');
      return redirect()->back();
  }
  // -------------------------------Video_Gallery_Index----------------------------------------

  public function Video_Gallery_Index(){
    $Videos = Videos::latest()->get();
    return view('admin.about.video_gallery_listing',compact('Videos'));
  }

  public function Video_gallery_add(){
    return view('admin.about.video_gallery_add');
  }

  public function Video_gallery_edit($id){
    $id = base64_decode($id);
    $EditData = Videos::where('id',$id)->first();
    return view('admin.about.video_gallery_edit',compact('EditData'));
  }
  
  public function videogalleryStore(Request $request){
    $rand = rand(111,999);
    $obj = new Videos();
    $obj->project_name =  $request->project_name;
    $obj->project_by = $request->project_by;
    $obj->vurl = $request->vurl;
    $obj->vthumb = $request->vthumb;    
    $obj->status = 1;
    $obj->save();

    toast('Gallery Video Successfully!!!','success');
    return redirect('/admin/about/video-gallery');
  }

  public function videogalleryUpdate(Request $request){
    $rand = rand(111,999);
    $obj = Videos::find($request->edit_id);
    $obj->project_name =  $request->project_name;
    $obj->project_by = $request->project_by;
    $obj->vurl = $request->vurl;
    $obj->vthumb = $request->vthumb;    
    $obj->status = 1;
    $obj->save();

    toast('Gallery Video Successfully!!!','success');
    return redirect('/admin/about/video-gallery');
  }

  public function videogalleryStatus($status,$id){
    $id=base64_decode($id);
    $status = base64_decode($status);
    if($status == 0){
      Videos::where('id',$id)->update(['status' => 1]);
    }else{
      Videos::where('id',$id)->update(['status' => 0]);
    }
    toast('Status Updated Successfully!!!','success');
    return redirect()->back();
  }


  public function videogalleryDelete($id){
    $delete_id=base64_decode($id);
   
    Videos::where('id',$delete_id)->delete();
      toast('Gallery Video Deleted Successfully!!!','success');
      return redirect()->back();
  }
// ----------------------------Event_Gallery_Index-----------------------------------
    public function Event_Gallery_Index(){
      $Events = Events::latest()->get();
      return view('admin.about.event_gallery_listing',compact('Events'));
    }
 
    public function EventGalleryStore(Request $request){
      $obj = new Events();
      $obj->name =  $request->event_name; 
      $obj->status = $request->is_active;
      $obj->save();

      toast('Event Added Successfully!!!','success');
      return redirect('/admin/about/event-gallery');
    }

    public function EventGalleryUpdate(Request $request){
      $obj = Events::find($request->edit_id);
      $obj->name =  $request->event_name; 
      $obj->status = $request->is_active;
      $obj->save();

      toast('Event Added Successfully!!!','success');
      return redirect('/admin/about/event-gallery');
    }

    public function EventGalleryDelete($id){
      $delete_id=base64_decode($id);
   
      Events::where('id',$delete_id)->delete();
        toast('Event Deleted Successfully!!!','success');
        return redirect()->back();
    }

    public function EventGalleryStatus($status, $id){
      $id=base64_decode($id);
      $status = base64_decode($status);
      if($status == 0){
        Events::where('id',$id)->update(['status' => 1]);
      }else{
        Events::where('id',$id)->update(['status' => 0]);
      }
      toast('Status Updated Successfully!!!','success');
      return redirect()->back();
    }

    public function EventFileStore(Request $request)
    {
      ini_set('memory_limit', '3072M');
      ini_set('max_execution_time', 10080);
      ini_set('upload_max_filesize', '5M');

      $rnd = rand();
      $extension = $request->file->getClientOriginalExtension();
      $file = $request->file('file');
        if($extension == "mp4" || $extension == "ogg" || $extension == "avi" || $extension == "mov" || $extension == "mkv"){
          $title_img = 'event_gallery'.'_'.$rnd.'.'.$extension;
          $path_img = '/img/about/event_gallery'.'_'.$rnd.'.'.$extension;
          $path = public_path().'/img/event_gallery/';
          $file->move($path, $title_img);
        }else{
          $title_img = 'event_gallery'.'_'.$rnd.'.jpg';
          $path_img = '/img/event_gallery/event_gallery'.'_'.$rnd.'.jpg';
          $path = public_path().'/img/event_gallery/';
          $file->move($path, $title_img);
        }

        $obj = new EventImages();
        $obj->event_id = $request->parent_id;
        $obj->status = 1;
        $obj->images = $path_img;
        $obj->save();
        toast('Images Upload Successfully!!!','success');
        return response()->json(['success'=>$title_img]);
    }

    public function deleteEventPhoto(Request $request){
      $moduleid = (int) $request->moduleid;
      $Image_path = public_path().$request->inputImage;
      $res=EventImages::where('id',$moduleid)->delete();
      if(File::exists($Image_path)) {
          File::delete($Image_path);
          return true;
        }else{
          return false;
        }
    }
// ------------------------Our_Milestone_Index-----------------------------
    public function Our_Milestone_Index(){
      $OurMilestones = OurMilestones::latest()->get();
      return view('admin.about.our_milestone_listing',compact('OurMilestones'));
    }

    public function Our_Milestone_add(){
      return view('admin.about.our_milestone_add');
    }

    public function Our_Milestone_Store(Request $request){

      if($request->background_image != null){
        $rnd = rand(111,999);
        $extension = $request->background_image->getClientOriginalExtension();
        $file = $request->file('background_image');
        $title_img = 'milestone'.'_'.$rnd.'.'.$extension;
        $path_img = '/img/about/milestone/milestone'.'_'.$rnd.'.'.$extension;
        $path = public_path().'/img/about/milestone/';
        $file->move($path, $title_img);
      }else{
        $path_img = null;
      }


      $obj = new OurMilestones();
      $obj->image_url = $path_img;
      $obj->title =  $request->title;
      $obj->sub_title = $request->sub_title;
      $obj->timeline_year = $request->timeline_year;    
      $obj->timeline_title = $request->timeline_title;    
      $obj->timeline_text = $request->timeline_text; 
      $obj->status = 1;
      $obj->save();
      toast('Our Milestone Added Successfully!!!','success');
      return redirect('/admin/about/our-milestone');
    }

    public function Our_Milestone_edit($id){
      $id = base64_decode($id);
      $EditData = OurMilestones::where('id',$id)->first();
      return view('admin.about.our_milestone_edit',compact('EditData'));
    }

    public function Our_Milestone_Update(Request $request){
      $Image_path = public_path().$request->edit_background_image;
      if(File::exists($Image_path) && $request->background_image != null) {
        File::delete($Image_path);
      }

      $rnd = rand(111,999).'_'.$request->timeline_year;
      if($request->background_image != null){
        $extension = $request->background_image->getClientOriginalExtension();
        $file = $request->file('background_image');
        $title_img = 'milestone'.'_'.$rnd.'.'.$extension;
        $path_img = '/img/about/milestone/milestone'.'_'.$rnd.'.'.$extension;
        $path = public_path().'/img/about/milestone/';
        $file->move($path, $title_img);
      }else{
        $path_img = $request->edit_background_image;
      }

      $obj = OurMilestones::find($request->edit_id);
      $obj->image_url =  $path_img;
      $obj->title =  $request->title;
      $obj->sub_title = $request->sub_title;
      $obj->timeline_year = $request->timeline_year;    
      $obj->timeline_title = $request->timeline_title;    
      $obj->timeline_text = $request->timeline_text; 
      $obj->status = 1;
      $obj->update();
      toast('Our Milestone Updated Successfully!!!','success');
      return redirect('/admin/about/our-milestone');
    }

    public function Our_Milestone_Status($status,$id){
      $id=base64_decode($id);
      $status = base64_decode($status);
      if($status == 0){
        OurMilestones::where('id',$id)->update(['status' => 1]);
      }else{
        OurMilestones::where('id',$id)->update(['status' => 0]);
      }
      toast('Status Updated Successfully!!!','success');
      return redirect()->back();
    }

    public function Our_Milestone_Delete($id){
      $delete_id=base64_decode($id);
   
      OurMilestones::where('id',$delete_id)->delete();
        toast('Milestone Deleted Successfully!!!','success');
        return redirect()->back();
    }


  public function uploadcropimages($imgdata, $foldername, $randn)
  {
    ini_set('memory_limit', '3072M');
    ini_set('max_execution_time', 10080);
    ini_set('upload_max_filesize', '10M');
    
      $title_img = $randn.'.jpg';
      $path = ('/img/about/'.$foldername.'/'.$title_img);
      $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgdata));
      $img1=Image::make($info);
      // $img1->resize(400, 446);
      $img1->save(public_path($path));
      $url = url('/img/about/'.$foldername.'/'.$title_img);
      return $path;
  }

  public function uploadImage($f, $foldername, $randn)
  {
    ini_set('memory_limit', '3072M');
    ini_set('max_execution_time', 10080);
    ini_set('upload_max_filesize', '10M');

      $file = $f;
    //  print_r($file); exit;
      $mime = $file->getClientMimeType();
      $ext = $file->getClientOriginalExtension();
      $fileName = $randn . "." . $ext;
      $upload = $f->move(public_path('/img/about/'.$foldername.'/'), $fileName);
        $url = url('img/about/'.$foldername.'/' . $fileName);
        $path = ('/img/about/'.$foldername.'/'.$fileName);
      return $fileName;
  }


  public function storeEnquiry(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'contact'      => 'required|string|max:20',
            'message'    => 'required|string',
        ]);

        $validated['country'] = null;
        Enquires::create($validated);

        return back()->with('success', 'Your enquiry has been submitted successfully!');
    }
}
