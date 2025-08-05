<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Seo;
use App\Models\Categories;
use App\Models\admin\HeaderSeo;
use Illuminate\Support\Facades\Session;

class SeoController extends Controller
{
    public function Index(){
        $seo_data = Seo::get();
        return view('admin.seo.listing',compact('seo_data'));
    }
    public function add(){
       $Categories = Categories::select('id','name')->where('status',1)->get();
        return view('admin.seo.add',compact('Categories'));
    }
    public function edit($id){
        $id = base64_decode($id);
        $edit_data = Seo::where('id',$id)->first();
        return view('admin.seo.edit',compact('edit_data'));
    }

    public function Store(Request $request){
        // dd($request);
        $url_id = $request->url_id;
        $page_name = $request->page_name;
        $page_title = $request->page_title;
        $page_url = $request->page_url;
        $languages = $request->language;
        $meta_keywords = $request->meta_keywords;
        $meta_description = $request->meta_description;
        $meta_tag_script = $request->meta_tag_script;
        $is_active = $request->is_active;

        foreach($languages as $k=>$item){
            $exist = Seo::where('urls',$page_url)->where('language',$item)->count();
            if($exist == 0){
                $obj = new Seo();
                $obj->url_id = $url_id;
                $obj->page_name = $page_name;
                $obj->title = $page_title;
                $obj->urls = $page_url;
                $obj->language = $item;
                $obj->meta_keywords = $meta_keywords;
                $obj->meta_description = $meta_description;
                $obj->meta_tag_script = $meta_tag_script;
                $obj->status = $is_active;
                $obj->save();
            }
        }  
        toast('Seo Added Successfully!!!','success');
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


    public function editStore(Request $request){
        $edit_id = $request->edit_id;
        $url_id = $request->url_id;
        $page_name = $request->page_name;
        $page_title = $request->page_title;
        $page_url = $request->page_url;
        $meta_keywords = $request->meta_keywords;
        $meta_description = $request->meta_description;
        $meta_tag_script = $request->meta_tag_script;
        $is_active = $request->is_active;

        Seo::where('id',$edit_id)->update(['url_id'=>$url_id,'page_name' => $page_name,'title' => $page_title,'urls' => $page_url,'meta_tag_script' => $meta_tag_script,
        'meta_keywords' =>$meta_keywords,'meta_description'=>$meta_description,'status'=>$is_active,'updated_at'=>now()]);
       
        Session::flash('success','Seo Updated Successfully.');
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
        $HeaderSeo = HeaderSeo::get();
        return view('admin.seo.header_listing',compact('HeaderSeo'));
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
            $obj->page_id = $request->page_id;
            $obj->tag_title = $request->tag_title;
            $obj->tag_description = $request->tags_description;
            $obj->status = $request->is_active;
            $obj->save();
    
        return redirect('admin/seo/header-tags');
    }

    public function headerSeoUpdate(Request $request){
        $edit_id = $request->edit_id;
    
        $obj = HeaderSeo::find($edit_id);
        $obj->page_id = $request->page_id;
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
    
}
