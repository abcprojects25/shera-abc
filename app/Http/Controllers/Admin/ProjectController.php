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
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
// use GoogleTranslate;

class ProjectController extends Controller
{
  
    public function index_view()
    {
      $data = Projects::orderBy('project_order','desc')->get();
      return view('admin.projects.listing',compact('data'));
    }


  public function userProjectPage()
{
    $category = Categories::select('id', 'name', 'seourl')->where('type', 2)->first();

    $data = Projects::where('status', 1)
                    ->where('category_id', $category->id)
                    ->orderBy('project_order', 'desc')
                    ->paginate(10);

    return view('frontend.project', [
        'data' => $data,
        'Categories' => $category,
        'BannerImages' => BannerImages::where('status', 1)->where('type', 2)->get(),
        'categories' => Categories::select('id', 'name', 'seourl')->where('type', 2)->get(),
    ]);
}


    public function userProjectPageByCategory($categorySeoUrl)
{
    $category = Categories::where('seourl', $categorySeoUrl)->firstOrFail();

    $data = Projects::where('status', 1)
                    ->where('category_id', $category->id)
                    ->orderBy('project_order', 'desc')
                    ->paginate(10);

    return view('frontend.project', [
        'data' => $data,
        'Categories' => $category,
        'BannerImages' => BannerImages::where('status', 1)->where('type', 2)->get(),
        'categories' => Categories::select('id', 'name', 'seourl')->where('type', 2)->get(),
    ]);
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
      
        foreach($request->tags as $k=>$item){
          $check = Tags::select('id')->where('name',$item)->first();
          if(empty($check)){
            $data = new Tags();
            $data->name = $item;
            $data->status = 1;
            $data->save();
          }
        }

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


      if ($request->banner_image != null) {
    $image = $request->file('banner_image');
    $extension = $image->getClientOriginalExtension();

    // Create a new unique name
    $title_img = 'Project_banner_' . $rand . '.' . $extension;
    $banner_path = '/img/project/banner/' . $title_img;

    // Move the uploaded file to public/img/project/banner
    $image->move(public_path('img/project/banner'), $title_img);
} else {
    $banner_path = null;
}

if ($request->tags != null) {
    foreach ($request->tags as $k => $item) {
        $check = Tags::select('id')->where('name', $item)->first();
        if (empty($check)) {
            $data = new Tags();
            $data->name = $item;
            $data->status = 1;
            $data->save();
        }
    }
    $tags = implode(',', $request->tags);
} else {
    $tags = null;
}


 
      $Insert = new Projects();
        $Insert->category_id = $category_ids;
        $Insert->banner_image = $banner_path;
        $Insert->title = $request->page_title;
        $Insert->project_summary = $request->project_summary;        
        $Insert->url = $request->page_url;
        $Insert->city_state_name = $request->city_state_name;
        $Insert->image = $thumnail;
        // $Insert->video_title = $request->video_title;
        // $Insert->video_type = $request->video_type;
        // $Insert->video_url = $request->video_url;
        $products = $request->products ? implode(',', $request->products) : null;
        $Insert->products = $products;
        $Insert->thickness = $request->thickness;
        $Insert->size = $request->size;
        $Insert->total_sqft = $request->total_sqft;
        $Insert->tags = $tags;
        $Insert->direction = $request->direction; 
        $Insert->description = $request->description;
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
    $rand = mt_rand(0000000, 9999999);

    $update = Projects::find($request->id);

    if (!$update) {
        return back()->with('error', 'Project not found!');
    }

    $update->title = $request->title;
    $update->description = $request->description;
    $update->city_state_name = $request->city_state_name;
    $update->thickness = $request->thickness;
    $update->size = $request->size;
    $update->total_sqft = $request->total_sqft;

    if ($request->hasFile('vthumbnail')) {
        $thumb = $request->file('vthumbnail');
        $thumb_url = $this->uploadImage($thumb, 'pro_' . $rand);
        $update->image = $thumb_url;
    }

    $update->save();

    toast('Project Successfully Updated!!!', 'success');

    return redirect('/admin/projects');
}


      public function uploadcropimages($imgdata, $randn)
{
    $title_img = $randn . '.jpg';
    $path = public_path('img/project/' . $title_img);

    // Decode base64 and store
    $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgdata));
    file_put_contents($path, $info);

    return '/img/project/' . $title_img; // relative path
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

      }

        $Image_path = public_path().$request->edit_thumnail;
    if(File::exists($Image_path) && $request->thumnail != null) {
        File::delete($Image_path);
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

      if ($request->hasFile('banner_image')) {
    $image = $request->file('banner_image');
    $extension = $image->getClientOriginalExtension();
    $title_img = 'Project_banner_' . $rand . '.' . $extension;
    $banner_path = '/img/project/banner/' . $title_img;

    // Move the uploaded file to the public folder directly
    $image->move(public_path('img/project/banner'), $title_img);
} else {
    $banner_path = $request->edit_banner_image ?? null;
}

// Process tags input
if ($request->tags != null) {
    $tags = implode(',', $request->tags);
} else {
    $tags = null;
}

// Process products input
if ($request->products != null) {
    $products = implode(',', $request->products);
} else {
    $products = null;
}



      $obj = Projects::Find($request->edit_id);
        $obj->category_id = $category_ids;
        $obj->banner_image = $banner_path;
        $obj->title = $request->page_title;
       
        $obj->project_summary = $request->project_summary;
        $obj->url = $request->page_url;
        $obj->city_state_name = $request->city_state_name;
       
        $obj->image = $thumnail;
        $obj->video_title = $request->video_title;
        $obj->video_type = $request->video_type;
        $obj->video_url = $request->video_url;
        $obj->products = $products;
     
        $obj->tags = $tags;
        
        $obj->direction = $request->direction;        
        $obj->description = $request->description;
      
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

           
           $Insert = new Categories;
           $Insert->name = $value;
          $Insert->seourl = $request->seourl ?? $this->slugify($value);
           $Insert->description = $request->category_description;
          
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
     

       $obj = Categories::find($request->edit_id);
       $obj->name = $request->edit_category_name;
   
       $obj->description = $request->category_description;
 
       $obj->type = $request->type;
       $obj->status = $request->is_active_edit;
       $obj->update();
       toast('Category Successfully Edited!!!','success');
     }
     return redirect()->back();
  }

  private function slugify($text)
{
    // Replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // Transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // Trim
    $text = trim($text, '-');

    // Remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // Lowercase
    $text = strtolower($text);

    // Return 'n-a' if empty
    if (empty($text)) {
        return 'n-a';
    }

    return $text;
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