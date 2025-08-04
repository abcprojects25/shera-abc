<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Projects;
use App\Models\admin\ProjectImages;
use App\Models\Categories;
use App\Models\Subcategories;
use App\Models\admin\Categories_lookups;
use App\Models\admin\Tags;
use App\Models\admin\BannerImages;
use App\Models\Urls;
use Response;
use File;
use Alert;
use Image;
use Illuminate\Support\Facades\Session;
use GoogleTranslate;

class ProjectController extends Controller
{
  //   public function __construct()
  // {
  //     $this->middleware('auth');
  // }

    public function index_view()
    {
      $data = Projects::orderBy('project_order','asc')->get();
      return view('admin.projects.listing',compact('data'));
    }

    public function home_index(){
      $data = Projects::orderBy('project_order','asc')->where('is_home',1)->get();
      return view('admin.projects.listing-home',compact('data'));
    }

    public function project_edit($id){
      $id=base64_decode($id);
      $edit_data = Projects::where('id',$id)->first();
      $Categories = Categories::where('type',2)->get();
      $BannerImages = BannerImages::select('id','title','urls')->where('status',1)->where('type',2)->get();
      return view('admin.projects.edit',compact('edit_data','Categories','BannerImages'));
    }

    public function edit($id)
    {
      $id=base64_decode($id);
      $data = ProjectImages::where('id',$id)->first();
      return view('admin.projects.edit_project',compact('data'));
    }

    public function add_view()
    {
      $BannerImages = BannerImages::select('id','title','urls')->where('status',1)->where('type',2)->get();

      $Categories = Categories::select('id','name')->where('status',1)->where('type',2)->get();
      return view('admin.projects.add',compact('Categories','BannerImages'));
    }

    public function projectStore(Request $request){
      if($request->tags != null){
        // if tag not exist imsert
        foreach($request->tags as $k=>$item){
          $check = Tags::select('id')->where('name',$item)->first();
          if(empty($check)){
            $data = new Tags();
            $data->name = $item;
            $data->status = 1;
            $data->save();
          }
        }

        $tags = implode(',',$request->tags);
        $ar_tags = GoogleTranslate::trans($tags, 'ar');
        $es_tags = GoogleTranslate::trans($tags, 'es');
        $fr_tags = GoogleTranslate::trans($tags, 'fr');
        $sw_tags = GoogleTranslate::trans($tags, 'sw');
      }else{
        $tags = null;
        $ar_tags = null;
        $es_tags = null;
        $fr_tags = null;
        $sw_tags = null;
      }

      if($request->products != null){
        $products = implode(',',$request->products);
        $ar_products = GoogleTranslate::trans($products, 'ar');
        $es_products = GoogleTranslate::trans($products, 'es');
        $fr_products = GoogleTranslate::trans($products, 'fr');
        $sw_products = GoogleTranslate::trans($products, 'sw');
      }else{
        $products = null;
        $ar_products = null;
        $es_products = null;
        $fr_products = null;
        $sw_products = null;
      }

      if($request->category_ids != null){
        $category_ids = implode(',',$request->category_ids);
      }else{
        $category_ids = null;
      }

      $rand = rand(11111,99999);
      if($request->thumnail != null){
          $thumnail = $this->uploadcropimages($request->thumnail, 'project_'.$rand);
      }else{
          $thumnail = $request->thumnail;
      }
      if($request->banner_image != null){
        $image = $request->file('banner_image');
        $imageName = $image->getClientOriginalName();
        $extension = $request->banner_image->getClientOriginalExtension();
        $img1=Image::make($image);   
        $title_img = 'Project_banner_'.$rand.'.'.$extension;
        $banner_path = '/img/project/banner/Project_banner_'.$rand.'.'.$extension;
        $img1->save(public_path('/img/project/banner/'.$title_img));
      }else{
        $banner_path = null;
      }

      if($request->page_title !== null){
        $ar_title = GoogleTranslate::trans($request->page_title, 'ar');
        $es_title = GoogleTranslate::trans($request->page_title, 'es');
        $fr_title = GoogleTranslate::trans($request->page_title, 'fr');
        $sw_title = GoogleTranslate::trans($request->page_title, 'sw');
      }else{
        $ar_title = null;
        $es_title = null;
        $fr_title = null;
        $sw_title = null;
      }

      if($request->city_state_name !== null){
        $ar_city_state_name = GoogleTranslate::trans($request->city_state_name, 'ar');
        $es_city_state_name = GoogleTranslate::trans($request->city_state_name, 'es');
        $fr_city_state_name = GoogleTranslate::trans($request->city_state_name, 'fr');
        $sw_city_state_name = GoogleTranslate::trans($request->city_state_name, 'sw');
      }else{
        $ar_city_state_name = null;
        $es_city_state_name = null;
        $fr_city_state_name = null;
        $sw_city_state_name = null;
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
 
      $Insert = new Projects();
        $Insert->category_id = $category_ids;
        $Insert->banner_image = $banner_path;
        $Insert->title = $request->page_title;
        $Insert->ar_title = $ar_title;
        $Insert->es_title = $es_title;
        $Insert->fr_title = $fr_title;
        $Insert->sw_title = $sw_title;
        $Insert->project_summary = $request->project_summary;        
        $Insert->url = $request->page_url;
        $Insert->city_state_name = $request->city_state_name;
        $Insert->ar_city_state_name = $ar_city_state_name;
        $Insert->es_city_state_name = $es_city_state_name;
        $Insert->fr_city_state_name = $fr_city_state_name;
        $Insert->sw_city_state_name = $sw_city_state_name;
        $Insert->image = $thumnail;
        $Insert->video_title = $request->video_title;
        $Insert->video_type = $request->video_type;
        $Insert->video_url = $request->video_url;
        $Insert->products = $products;
        $Insert->ar_products = $ar_products;
        $Insert->es_products = $es_products;
        $Insert->fr_products = $fr_products;
        $Insert->sw_products = $sw_products;
        $Insert->tags = $tags;
        $Insert->ar_tags = $ar_tags;
        $Insert->es_tags = $es_tags;
        $Insert->fr_tags = $fr_tags;
        $Insert->sw_tags = $sw_tags;
        $Insert->direction = $request->direction; 
        $Insert->description = $request->description;
        $Insert->ar_description = $ar_description;
        $Insert->es_description = $es_description;
        $Insert->fr_description = $fr_description;
        $Insert->sw_description = $sw_description;
        $Insert->status = $request->is_active;
        $Insert->save();

        $Update = Projects::find($Insert->id);
        $Update->project_order = $Insert->id;
        $Update->update();

        $url = new Urls();
        $url->page_name = $request->page_title;
        $url->urls = $request->page_url;
        $url->utype = 'Project';
        $url->status = 1;
        $url->save();

        
       toast('New Project Added Successfully!!!','success');

      return redirect('/admin/project/all-project');
    }

    public function p_data()
    {
      $id= $_GET['id'];
      $data = Projects::where('id',$id)->first();
      $datas = '<div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">'.$data->title.'</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div><div class="modal-body partner_listing"><div class="row"><div class="col-lg-3 col-md-3"><img src="'.$data->image.'" class="img-fluid d-block"></div><div class="col-lg-7 col-md-6 text-content-block wow light wow fadeIn animated" style="visibility: visible;"><h6> '.$data->title.' </h6><p> '.$data->description.' </p> <div class="d-flex"><div class="">  <h1> '.$data->list_title1.' </h1> '.$data->list_data1.' </div><div class="">  <h1> '.$data->list_title2.' </h1> '.$data->list_data2.' </div> </div></div> <div class="col-lg-2 col-md-3"> <a data-fancybox href="'.$data->video.'"><img src="/img/play.png" class="img-fluid play_icon"><img src="'.$data->thumbnail.'" class="img-fluid d-block"> </a></div></div></div> </div>';

      return $datas;
    }
  
    public function index(Request $request)
      {
  
          //    print_r($_POST);
          //	exit; 
          $thumb = $request->file('vthumbnail');
          $rand = mt_rand("0000000", "9999999");
          $thumb_url = $this->uploadImage($thumb,'pro_'.$rand);

          $seourl = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title));
              
  
          $obj = new Projects;
          $obj->title = $request->title;
          $obj->seourl = $seourl;
          $obj->description = $request->description;
          $obj->image = $thumb_url;
          $obj->status = $request->is_active;
          $obj->save();
  
            Session::flash('success','Projects Successfully added');
            return redirect('/admin/projects');
         
         
      }

      public function update(Request $request)
      {
        $rand = mt_rand("0000000", "9999999");

        $update = Projects::find($request->id);
        $update->title = $request->title;
        $update->description = $request->description;
      
        if ($request->file('vthumbnail') != null) {
          $thumb = $request->file('vthumbnail');
          $thumb_url = $this->uploadImage($thumb,'pro_'.$rand);
          $update->image = $thumb_url;
        }

        $update->save();
       toast('Project Successfully Updated!!!','success');

            return redirect('/admin/projects');
      }

      public function uploadcropimages($imgdata, $randn)
      {
              $title_img = $randn.'.jpg';
              $path = ('/img/project/'.$title_img);
              $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgdata));
              $img1=Image::make($info);
             // $img1->resize(400, 446);
              $img1->save(public_path($path));
              $url = url('img/project/'.$title_img);
              return $path;
              //$seourl = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-',$request->title));
      }
      
      public function uploadImage($f, $randn)
      {
        ini_set('memory_limit', '3072M');
		 ini_set('max_execution_time', 10080);
         ini_set('upload_max_filesize', '10M');

          $file = $f;
         // print_r($file); exit;
          $mime = $file->getClientMimeType();
          $ext = $file->getClientOriginalExtension();
          $fileName = $randn . "." . $ext;
          $upload = $f->move(public_path('/img/projects'), $fileName);
            $url = url('img/projects/' . $fileName);
            $path = ('/img/projects/'.$fileName);
  
  
          return $path;
      }
  
      public function changeStatus($status,$id)
      {
        $id=base64_decode($id);
        $status= base64_decode($status);
          if($status == 0){
            Projects::where('id',$id)->update(['status' => 1]);
          }else{      
            Projects::where('id',$id)->update(['status' => 0]);
          }
          toast('Status Updated Successfully!!!','success');
          
          return redirect()->back();
      }

      public function ChangeHomeStatus($status,$id)
      {
        $id=base64_decode($id);
        $status= base64_decode($status);
          if($status == 0){
            Projects::where('id',$id)->update(['is_home' => 1]);
          }else{      
            Projects::where('id',$id)->update(['is_home' => 0]);
          }
          toast('Status Updated Successfully!!!','success');
          
          return redirect()->back();
      }
  
        public function delete($id)
        {
          $id=base64_decode($id);
          $photo = ProjectImages::find($id)->delete();
          toast('Successfully Deleted!','success');

          return redirect()->back();
        }

    // images upload
    public function fileStore(Request $request)
    {
      ini_set('memory_limit', '3072M');
      ini_set('max_execution_time', 10080);
      ini_set('upload_max_filesize', '20M');
      
        $rnd = rand();
        $extension = $request->file->getClientOriginalExtension();
        if($extension == "mp4" || $extension == "ogg" || $extension == "avi" || $extension == "mov" || $extension == "mkv"){
          $file = $request->file('file');
          $title_img = 'project'.'_'.$rnd.'.'.$extension;
          $path_img = '/img/project/featured/project'.'_'.$rnd.'.'.$extension;
          $path = public_path().'/img/project/featured/';
          $file->move($path, $title_img);
        }else{
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();
            $img1=Image::make($image);   
            $title_img = 'project'.'_'.$rnd.'.jpg';
            $path_img = '/img/project/featured/project'.'_'.$rnd.'.jpg';
            $img1->save(public_path('/img/project/featured/'.$title_img));
        }

        $obj = new ProjectImages();
        $obj->project_id = $request->parent_id;
        $obj->status = 1;
        $obj->urls = $path_img;
        $obj->save();
        return response()->json(['success'=>$title_img]);
    }

    public function editImgStore(Request $request){
        $moduleid = $request->moduleid;
        $inputTitle = $request->inputTitle;
        $inputAlt = $request->inputAlt;
        $inputUrl = $request->inputUrl;
        $inputDescription = $request->inputDescription;
      
        ProjectImages::where('id',$moduleid)->update(['title' => $inputTitle,'alt' => $inputAlt,'urls' => $inputUrl,
        'description' =>$inputDescription]);
        return redirect()->back();
    } 

    public function editStore(Request $request){
      ini_set('memory_limit', '3072M');
      ini_set('max_execution_time', 10980);
      ini_set('upload_max_filesize', '100M');

      // if tag not exist imsert
      if($request->tags != null){
        foreach($request->tags as $k=>$item){
          $check = Tags::select('id')->where('name',$item)->first();
          if(empty($check)){
            $data = new Tags();
            $data->name = $item;
            $data->status = 1;
            $data->save();
          }
        }
        $tags = implode(',',$request->tags);
        $ar_tags = GoogleTranslate::trans($tags, 'ar');
        $es_tags = GoogleTranslate::trans($tags, 'es');
        $fr_tags = GoogleTranslate::trans($tags, 'fr');
        $sw_tags = GoogleTranslate::trans($tags, 'sw');
      }else{
        $tags = null;
        $ar_tags = null;
        $es_tags = null;
        $fr_tags = null;
        $sw_tags = null;
      }

      $Image_path = public_path().$request->edit_thumnail;
      if(File::exists($Image_path) && $request->thumnail != null) {
        File::delete($Image_path);
      }
      
      if($request->products != null){
        $products = implode(',',$request->products);
        $ar_products = GoogleTranslate::trans($products, 'ar');
        $es_products = GoogleTranslate::trans($products, 'es');
        $fr_products = GoogleTranslate::trans($products, 'fr');
        $sw_products = GoogleTranslate::trans($products, 'sw');
      }else{
        $products = null;
        $ar_products = null;
        $es_products = null;
        $fr_products = null;
        $sw_products = null;
      }

      if($request->category_ids != null){
        $category_ids = implode(',',$request->category_ids);
      }else{
        $category_ids = null;
      }
    
      $rand = rand(11111,99999);
      if($request->thumnail != null){
          $thumnail = $this->uploadcropimages($request->thumnail, $rand);
      }else{
          $thumnail = $request->edit_thumnail;
      }

      if($request->banner_image != null){
        $image = $request->file('banner_image');
        $imageName = $image->getClientOriginalName();
        $extension = $request->banner_image->getClientOriginalExtension();
        $img1=Image::make($image);   
        $title_img = 'Project_banner_'.$rand.'.'.$extension;
        $banner_path = '/img/project/banner/Project_banner_'.$rand.'.'.$extension;
        $img1->save(public_path('/img/project/banner/'.$title_img));
      }else{
        $banner_path = $request->edit_banner_image;
      }

      if($request->page_title !== null){
        $ar_title = GoogleTranslate::trans($request->page_title, 'ar');
        $es_title = GoogleTranslate::trans($request->page_title, 'es');
        $fr_title = GoogleTranslate::trans($request->page_title, 'fr');
        $sw_title = GoogleTranslate::trans($request->page_title, 'sw');
      }else{
        $ar_title = null;
        $es_title = null;
        $fr_title = null;
        $sw_title = null;
      }

      if($request->city_state_name !== null){
        $ar_city_state_name = GoogleTranslate::trans($request->city_state_name, 'ar');
        $es_city_state_name = GoogleTranslate::trans($request->city_state_name, 'es');
        $fr_city_state_name = GoogleTranslate::trans($request->city_state_name, 'fr');
        $sw_city_state_name = GoogleTranslate::trans($request->city_state_name, 'sw');
      }else{
        $ar_city_state_name = null;
        $es_city_state_name = null;
        $fr_city_state_name = null;
        $sw_city_state_name = null;
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

      $obj = Projects::Find($request->edit_id);
        $obj->category_id = $category_ids;
        $obj->banner_image = $banner_path;
        $obj->title = $request->page_title;
        $obj->ar_title = $ar_title;
        $obj->es_title = $es_title;
        $obj->fr_title = $fr_title;
        $obj->sw_title = $sw_title;
        $obj->project_summary = $request->project_summary;
        $obj->url = $request->page_url;
        $obj->city_state_name = $request->city_state_name;
        $obj->ar_city_state_name = $ar_city_state_name;
        $obj->es_city_state_name = $es_city_state_name;
        $obj->fr_city_state_name = $fr_city_state_name;
        $obj->sw_city_state_name = $sw_city_state_name;
        $obj->image = $thumnail;
        $obj->video_title = $request->video_title;
        $obj->video_type = $request->video_type;
        $obj->video_url = $request->video_url;
        $obj->products = $products;
        $obj->ar_products = $ar_products;
        $obj->es_products = $es_products;
        $obj->fr_products = $fr_products;
        $obj->sw_products = $sw_products;
        $obj->tags = $tags;
        $obj->ar_tags = $ar_tags;
        $obj->es_tags = $es_tags;
        $obj->fr_tags = $fr_tags;
        $obj->sw_tags = $sw_tags;
        $obj->direction = $request->direction;        
        $obj->description = $request->description;
        $obj->ar_description = $ar_description;
        $obj->es_description = $es_description;
        $obj->fr_description = $fr_description;
        $obj->sw_description = $sw_description;
        $obj->status = $request->is_active;
        $obj->update();
      return redirect('/admin/project/all-project');
    }

    public function deleteProject($id){
      $id = base64_decode($id);
      $check = Projects::select('image','banner_image')->where('id',$id)->first();
      $Image_path = public_path().$check->image;
      $Image_path1 = public_path().$check->banner_image;
      
      if(File::exists($Image_path)) {
        File::delete($Image_path);
      }
      if(File::exists($Image_path1)) {
        File::delete($Image_path1);
      }
      $res=Projects::where('id',$id)->delete();
      return redirect('/admin/project/all-project');
    }

    public function deleteProjectPhoto(Request $request){
      $moduleid = (int) $request->moduleid;
      $Image_path = public_path().$request->inputUrl;
      $res=ProjectImages::where('id',$moduleid)->delete();
      if(File::exists($Image_path)) {
         File::delete($Image_path);
            return true;
        }else{
            return false;
        }
    }

    // Categories Start
    public function project_categories(){
      $Categories = Categories::where('type',2)->latest()->paginate(10);
      $Category_list = Categories::select('id','name')->where('type',2)->latest()->get();

      return view('admin.projects.categories',compact('Categories','Category_list'));
    }
    
    public function statusCategories($status,$id)
    {
      $id=base64_decode($id);
      $status = base64_decode($status);
      if($status == 0){
        Categories::where('id',$id)->update(['status' => 1]);
      }else{      
        Categories::where('id',$id)->update(['status' => 0]);
      }
      toast('Status Updated Successfully!!!','success');

      return redirect()->back();
    }

    public function CategoriesAddEdit(Request $request){
     $categories = explode(',',$request->category_name);
     if($request->edit_id == 0){
       foreach($categories as $k=>$value){
         $is_exists = Categories::where('name',$value)->where('type',$request->type)->count();
         if($is_exists == 0){

            $ar_value = GoogleTranslate::trans($value, 'ar');
            $es_value = GoogleTranslate::trans($value, 'es');
            $fr_value = GoogleTranslate::trans($value, 'fr');
            $sw_value = GoogleTranslate::trans($value, 'sw');

            if($request->category_description !== null){
              $ar_description = GoogleTranslate::trans($request->category_description, 'ar');
              $es_description = GoogleTranslate::trans($request->category_description, 'es');
              $fr_description = GoogleTranslate::trans($request->category_description, 'fr');
              $sw_description = GoogleTranslate::trans($request->category_description, 'sw');
            }else{
              $ar_description = null;
              $es_description = null;
              $fr_description = null;
              $sw_description = null;
            }
           
           $Insert = new Categories;
           $Insert->name = $value;
           $Insert->ar_name = $ar_value;
           $Insert->es_name = $es_value;
           $Insert->fr_name = $fr_value;
           $Insert->sw_name = $sw_value;
           $Insert->description = $request->category_description;
           $Insert->ar_description = $ar_description;
           $Insert->es_description = $es_description;
           $Insert->fr_description = $fr_description;
           $Insert->sw_description = $sw_description;
           $Insert->type = $request->type;
           $Insert->status = $request->is_active;
           $Insert->save();

           $looup = new Categories_lookups;
           $looup->categry_lookup = $Insert->id;
           $looup->category_id = $Insert->id;
           $looup->save();
         }
       }
       toast('Category Successfully Added!!!','success');
     }else{
        if($request->category_id !== null){
          Categories_lookups::where('categry_lookup',$request->edit_id)->delete();

          foreach($request->category_id as $j=>$item){
            $looup = new Categories_lookups;
            $looup->categry_lookup = $request->edit_id;
            $looup->category_id = $item;
            $looup->save();
          }
        }
        $ar_value = GoogleTranslate::trans($request->edit_category_name, 'ar');
        $es_value = GoogleTranslate::trans($request->edit_category_name, 'es');
        $fr_value = GoogleTranslate::trans($request->edit_category_name, 'fr');
        $sw_value = GoogleTranslate::trans($request->edit_category_name, 'sw');
        if($request->category_description !== null){
          $ar_description = GoogleTranslate::trans($request->category_description, 'ar');
          $es_description = GoogleTranslate::trans($request->category_description, 'es');
          $fr_description = GoogleTranslate::trans($request->category_description, 'fr');
          $sw_description = GoogleTranslate::trans($request->category_description, 'sw');
        }else{
          $ar_description = null;
          $es_description = null;
          $fr_description = null;
          $sw_description = null;
        }

       $obj = Categories::find($request->edit_id);
       $obj->name = $request->edit_category_name;
       $obj->ar_name = $ar_value;
       $obj->es_name = $es_value;
       $obj->fr_name = $fr_value;
       $obj->sw_name = $sw_value;
       $obj->description = $request->category_description;
       $obj->ar_description = $ar_description;
       $obj->es_description = $es_description;
       $obj->fr_description = $fr_description;
       $obj->sw_description = $sw_description;
       $obj->type = $request->type;
       $obj->status = $request->is_active_edit;
       $obj->update();
       toast('Category Successfully Edited!!!','success');
     }
     return redirect()->back();
  }

    public function deleteCategories($id)
    {
      $id=base64_decode($id);
      Categories::where('id',$id)->delete();
      toast('Category Deleted Successfully!!!','success');
      return redirect()->back();
    }

     // Sub categories Start
     public function project_subcategories(){
      $Categories = Categories::select('id','name')->where('type',2)->get();
      $Subcategories = Subcategories::join('categories','categories.id','subcategories.category_id')
      ->select('subcategories.id','subcategories.name','subcategories.category_id','subcategories.status','subcategories.created_at')
      ->where('type',2)->paginate(10);
      return view('admin.projects.subcategories',compact('Subcategories','Categories'));
    }

    public function SubCategoriesAddEdit(Request $request){
      $categories = explode(',',$request->subcategory_name);
        foreach($categories as $k=>$value){
          $is_exists = Categories::where('name',$value)->where('type',$request->type)->count();
          if($is_exists == 0){
            $Insert = new Categories;
            $Insert->name = $value;
            $Insert->type = $request->type;
            $Insert->status = $request->is_active;
            $Insert->save();

            foreach($request->category_id as $j=>$item){
              $looup = new Categories_lookups;
              $looup->categry_lookup = $Insert->id;
              $looup->category_id = $item;
              $looup->save();
            }

          }
        }
        toast('Sub-Category Successfully Added!!!','success');
   
      return redirect()->back();
    }
  
  public function bannerFileStore(Request $request)
  {
    $rnd = rand();
    $extension = $request->file->getClientOriginalExtension();
    $file = $request->file('file');
      if($extension == "mp4" || $extension == "ogg" || $extension == "avi" || $extension == "mov" || $extension == "mkv"){
        $title_img = 'banner'.'_'.$rnd.'.'.$extension;
        $path_img = '/img/project/banner/banner'.'_'.$rnd.'.'.$extension;
        $path = public_path().'/img/project/banner/';
        $file->move($path, $title_img);
      }else{
        $title_img = 'banner'.'_'.$rnd.'.jpg';
        $path_img = '/img/project/banner/banner'.'_'.$rnd.'.jpg';
        $path = public_path().'/img/project/banner/';
        $file->move($path, $title_img);
      }

      $obj = new BannerImages();
      $obj->type = 2;
      $obj->status = 1;
      $obj->urls = $path_img;
      $obj->save();
     toast('Images Upload Successfully!!!','success');
      return response()->json(['success'=>$title_img]);
  }

  public function sorting(Request $request)
  {
    $projectIdsArray = $_POST['order'];
    $count = 1;
    foreach ($projectIdsArray as $id) {
      $projectOrder = $count;
      $photo = Projects::find($id);
      $photo->project_order= $projectOrder;
      $photo->save();
      $count ++;
    }
      return response(['message' => 'Projects order is updated Successfully!!!', 'status' => 'success'], 200);
  }

  public function ProjectCategorySorting(Request $request)
  {
    $productIdsArray = $_POST['order'];
    $count = 1;
    foreach ($productIdsArray as $id) {
      $categoryOrder = $count;
      $obj = Categories::where('id',$id)->where('type',2)->update(['category_order'=>$categoryOrder]);
      $count ++;  
    }
      return response(['message' => 'Products order is updated Successfully!!!', 'status' => 'success'], 200);
    
  }

}