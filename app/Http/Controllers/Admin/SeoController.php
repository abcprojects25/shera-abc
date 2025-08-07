<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Seo;
use App\Models\Categories;
use App\Models\HeaderSeo;
use App\Models\Urls;
use App\Models\admin\BannerUrl;
use App\Models\admin\Banner;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SeoController extends Controller
{

    public function __construct()
    {
        $this->middleware('adminauth');

    }
    

  public function Index(){
    $seo_data = Seo::with('page')->get(); 
    return view('admin.seo.listing', compact('seo_data'));
}
    public function add(){
       $Categories = Categories::select('id','name')->where('status',1)->get();

    //    $urls_list = Urls::select('id','page_name')->where('status',1)->get();
        return view('admin.seo.add',compact('Categories'));
    }
public function edit($id)
{
    $id = base64_decode($id);
    $edit_data = Seo::where('id', $id)->first();

    // Join with URL to get current page_name
    $url = DB::table('urls')->where('id', $edit_data->page_id)->first();
    if ($url) {
        $edit_data->page_name = $url->page_name;
    }

    return view('admin.seo.edit', compact('edit_data'));
}


    public function Store(Request $request){
         $user_id = auth('admin')->user()->id;
      $page_id = $request->url_id;

        $page_title = $request->page_title;
        $page_url = $request->page_url;
        $meta_keywords = $request->meta_keywords;
        $meta_description = $request->meta_description;
        $is_active = $request->is_active;

        $obj = new Seo();
        $obj->page_id = $page_id;
        $obj->title = $page_title;
        $obj->urls = $page_url;
        $obj->meta_keywords = $meta_keywords;
        $obj->meta_description = $meta_description;
        $obj->script_header = $request->meta_tag_script_header;
        $obj->script_footer = $request->meta_tag_script_footer;
        $obj->meta_tag_script = $request->meta_tag_script;
        $obj->user_id = $user_id;

        $obj->status = $is_active;
        $obj->save();
        toast('Seo Added Successfully!!!','success');
        Session::flash('success','Seo Added Successfully!!');

        return redirect('admin/seo');
    }

    public function changeStatus($status,$id)
    {
        $id=base64_decode($id);
        $status=(int) base64_decode($status);
        if($status == 0){
            Seo::where('id',$id)->update(['status' => 1]);
        }else{
            Seo::where('id',$id)->update(['status' => 0]);
        }
        Session::flash('success','Status Updated Successfully.');
        return redirect('admin/seo');
    }


  public function editStore(Request $request)
{
    $edit_id = $request->edit_id;
    $page_id = $request->url_id; // maps to urls.id
    $page_name = $request->page_name;
    $page_title = $request->page_title;
    $page_url = $request->page_url;
    $meta_keywords = $request->meta_keywords;
    $meta_description = $request->meta_description;
    $script_header = $request->meta_tag_script_header;
    $script_footer = $request->meta_tag_script_footer;
    $meta_tag_script = $request->meta_tag_script;
    $is_active = $request->is_active;

    // Update SEO meta info
    Seo::where('id', $edit_id)->update([
        'title' => $page_title,
        'urls' => $page_url,
        'meta_keywords' => $meta_keywords,
        'meta_description' => $meta_description,
        'script_header' => $script_header,
        'script_footer' => $script_footer,
        'meta_tag_script' => $meta_tag_script,
        'status' => $is_active,
        'updated_at' => now(),
        'page_id' => $page_id, // optional but good to keep
    ]);

    // ✅ Also update the page_name in `urls` table
    DB::table('urls')->where('id', $page_id)->update([
        'page_name' => $page_name,
        'updated_at' => now(),
    ]);

    Session::flash('success', 'SEO and Page Name Updated Successfully.');
    return redirect('admin/seo');
}


    public function deleteSeo($id){
        $delete_id=base64_decode($id);
        Seo::where('id',$delete_id)->delete();

        Session::flash('success','Seo Deleted Successfully.');
        return redirect('admin/seo');
    }

    // --------------------START-----------------------
    public function headerIndex(){
        $HeaderSeo = HeaderSeo::paginate(10);
        return view('admin.seo.header_listing',compact('HeaderSeo'))->render();
    }

    public function header_add(){
        return view('admin.seo.header_add');
    }

    public function headerSeoStatus($status,$id)
    {
        $id=base64_decode($id);
        $status=(int) base64_decode($status);
        if($status == 0){
            HeaderSeo::where('id',$id)->update(['status' => 1]);
        }else{
            HeaderSeo::where('id',$id)->update(['status' => 0]);
        }
        Session::flash('success','Status Updated Successfully.');
        return redirect('admin/seo/header-tags');
    }

    public function headerSeoEdit($id){
        $editId = base64_decode($id);
        $editdata = HeaderSeo::where('id',$editId)->first();
        return view('admin.seo.header_edit',compact('editdata'));
    }

    public function headerSeoStore(Request $request){
            $obj = new HeaderSeo();
            $obj->page_id = 1;
            $obj->tag_title = $request->tag_title;
            $obj->tag_description = $request->tags_description;
            $obj->status = $request->is_active;
            $obj->save();
    
        return redirect('admin/seo/header-tags');
    }

    public function headerSeoUpdate(Request $request){
        $edit_id = $request->edit_id;
    
        $obj = HeaderSeo::find($edit_id);
        $obj->page_id = 1;
        $obj->tag_title = $request->tag_title;
        $obj->tag_description = $request->tag_description;
        $obj->status = $request->is_active;
        $obj->save();

        Session::flash('success','Header Seo Updated Successfully.');
        return redirect('admin/seo/header-tags');
    }

    public function deleteHeaderSeo($id){
        $delete_id=base64_decode($id);
        HeaderSeo::where('id',$delete_id)->delete();

        Session::flash('success','Header Seo Deleted Successfully.');
        return redirect('admin/seo/header-tags');
    }


    // SEO URL 

    public function UrlIndex(){
        $data = Urls::get();
       return view('admin.seo.url_listing',compact('data'));
    }

    public function Urledit($id){
        $id = base64_decode($id);
        $edit_data = Urls::where('id',$id)->first();
        return view('admin.seo.edit_url',compact('edit_data'));
    }


    public function UrlStore(Request $request){
        $user_id = auth('admin')->user()->id;
       
        $obj = new Urls();
        $obj->page_name = $request->page_name;
        $obj->urls = $request->page_url;
        $obj->utype = 2;
        $obj->id = $user_id;
        $obj->status = 1;
        $obj->save();
        // toast('URL Added Successfully!!!','success');
        Session::flash('success','URL Added Successfully!!');

        return redirect('admin/seo/url/listing');
    }

    public function UrlchangeStatus($status,$id)
    {
        $id=base64_decode($id);
        $status=(int) base64_decode($status);
        if($status == 0){
            Urls::where('id',$id)->update(['status' => 1]);
        }else{
            Urls::where('id',$id)->update(['status' => 0]);
        }
        Session::flash('success','Status Updated Successfully.');
        return redirect()->back();
    }


    public function UrleditStore(Request $request){
         $user_id = auth('admin')->user()->id;
      

        Urls::where('id',$request->edit_id)->update(['page_name' => $request->page_name,'urls' => $request->page_url,'id' => $user_id,
        'status'=>$request->is_active,'updated_at'=>now()]);
       
        Session::flash('success','URL Updated Successfully.');
        return redirect('admin/seo/url/listing');
    }


    public function UrldeleteSeo($id){
        $delete_id=base64_decode($id);
        Urls::where('id',$delete_id)->delete();

        Session::flash('success','URL Deleted Successfully.');
        return redirect()->back();
    }

    public static function UrlsList(){
       $urls =  DB::table('urls')->where('status',1)->get();
       return $urls;
    }



public static function SeoDetails($url){
            $seo = Seo::select('id','title','urls','meta_keywords','meta_description','meta_tag_script','script_header')->where('urls',$url)->first();
            return  $seo;
    }



public static function FetchHeaderTag()
    {
        return $results = HeaderSeo::where('status',1)->get();
    }

public function Bannershow()
{
    // Get active banner URLs
    $urls = BannerUrl::where('status', 1)->get();
 $banners = Banner::with('bannerUrl')->latest()->get();
    // Pass to view
    return view('admin.seo.add_banner', compact('urls', 'banners'));
}


    public function storeBannerUrl(Request $request)
{
    $request->validate([
        'page_name' => 'required|string|max:255',
        'page_url' => 'required|string|max:255',
        'status'    => 'required|in:0,1',
    ]);

    BannerUrl::create([
        'page_name' => $request->page_name,
        'page_url'  => $request->page_url,
        'status'    => 1,
    ]);

    return redirect()->back()->with('success', 'Banner URL added successfully!');
}

public function storebanner(Request $request)
{
    $request->validate([
        'banner_url_id' => 'required|exists:banner_urls,id',
        'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        'status' => 'required|in:0,1',
    ]);

    $image = $request->file('image');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('banners'), $imageName);

    Banner::create([
        'banner_url_id' => $request->banner_url_id,
        'image' => $imageName, 
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Banner uploaded successfully!');
}

public function deleteBanner($id)
{
    $banner = Banner::findOrFail($id);
    $banner->delete();

    return redirect()->back()->with('success', 'Banner deleted successfully.');
}

public function updateBanner(Request $request, $id)
{
    // Validate form data
    $request->validate([
        'page_name' => 'required|string|max:255',
        'page_url' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        'status' => 'required|in:0,1',
    ]);

    // Fetch banner and related bannerUrl
    $banner = Banner::findOrFail($id);
    $bannerUrl = $banner->bannerUrl;

    if ($bannerUrl) {
        $bannerUrl->page_name = $request->page_name;
        $bannerUrl->page_url = $request->page_url;
        $bannerUrl->save();
    }

    // Handle image
    $imageName = $banner->image;
    if ($request->hasFile('image')) {
        $oldPath = public_path('banners/' . $banner->image);
        if (!empty($banner->image) && file_exists($oldPath)) {
            unlink($oldPath);
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('banners'), $imageName);
    }

    // Update banner record
    $banner->update([
        'image' => $imageName,
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Banner updated successfully!');
}







    
}
