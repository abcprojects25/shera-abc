<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Blogs;
use App\Models\admin\Tags;
use App\Models\Categories;
use App\Models\Subcategories;
use App\Models\admin\Categories_lookups;
use App\Models\admin\BlogImages;
use App\Models\admin\BannerImages;
use App\Models\admin\MediaImages;
use File;
    use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use GoogleTranslate;
use App\Models\admin\Media;

class BlogController extends Controller
{
    //
    public function Index(){
      $Blogs = Blogs::select('id','blog_order','blog_title','blog_url','blog_content','thumb_image','is_banner','is_popular','status','category_id','created_at')
      ->where('blogs.is_deleted',0)->orderBy('blog_order','desc')->get();
/*->where('status',1)
      foreach($Blogs as $blog){
        $obj = new MediaImages();
        $obj->status = 1;
        $obj->urls = $blog->thumb_image;
        $obj->thumbnails = $blog->thumb_image;
        $obj->save();
      }
      exit; */
       return view('admin.blog.listing',compact('Blogs'));
   }
 
    public function blogStatus($status,$id)
{
    $id=base64_decode($id);
    $status = base64_decode($status);
    if($status == 0){
        Blogs::where('id',$id)->update(['status' => 1]);
    }else{
        Blogs::where('id',$id)->update(['status' => 0]);
    }
    
    return response()->json(['success' => true]);
}

public function BlogBannerStatus($status,$id)
{
    $id=base64_decode($id);
    $status = base64_decode($status);
    if($status == 0){
        Blogs::where('id',$id)->update(['is_banner' => 1]);
    }else{
        Blogs::where('id',$id)->update(['is_banner' => 0]);
    }
    
    return response()->json(['success' => true]);
}

public function BlogPopularStatus($status,$id)
{
    $id=base64_decode($id);
    $status = base64_decode($status);
    if($status == 0){
        Blogs::where('id',$id)->update(['is_popular' => 1]);
    }else{
        Blogs::where('id',$id)->update(['is_popular' => 0]);
    }
    
    return response()->json(['success' => true]);
}

     
 
     public function add(){
         $Categories = Categories::select('id','name')->where('type',3)->get();
         $BannerImages = BannerImages::select('id','title','urls')->where('status',1)->where('type',3)->get();
         return view('admin.blog.add',compact('Categories','BannerImages'));
     }
 
    public function blogStore(Request $request){
    // dd($request);
    ini_set('memory_limit', '3072M');
    ini_set('max_execution_time', 10080);
    ini_set('upload_max_filesize', '20M');

    if($request->tags != null){
        // if tag not exist insert
        foreach($request->tags as $k => $item){
            $check = Tags::select('id')->where('name', $item)->first();
            if(empty($check)){
                $data = new Tags();
                $data->name = $item;
                $data->status = 1;
                $data->save();
            }
        }

        $tags = implode(',', $request->tags);

        // Commented out Google Translate logic
        // $ar_tags = GoogleTranslate::trans($tags, 'ar');
        // $es_tags = GoogleTranslate::trans($tags, 'es');
        // $fr_tags = GoogleTranslate::trans($tags, 'fr');
        // $sw_tags = GoogleTranslate::trans($tags, 'sw');

        $ar_tags = null;
        $es_tags = null;
        $fr_tags = null;
        $sw_tags = null;
    } else {
        $tags = null;
        $ar_tags = null;
        $es_tags = null;
        $fr_tags = null;
        $sw_tags = null;
    }

    $rand = rand(11111, 99999);

    if($request->banner_image != null){
        $image = $request->file('banner_image');
        $imageName = $image->getClientOriginalName();
        $extension = $request->banner_image->getClientOriginalExtension();
        $img1 = Image::make($image);   
        $title_img = 'Blog_banner_' . $rand . '.' . $extension;
        $banner_path = '/img/blog/Blog_banner_' . $rand . '.' . $extension;
        $img1->save(public_path('/img/blog/' . $title_img));

        $obj = new MediaImages();
        $obj->status = 1;
        $obj->urls = $banner_path;
        $obj->thumbnails = $banner_path;
        $obj->save();
    } else {
        $banner_path = null;
    }

    if($request->thumb_image != null){
        $thumb_path = $this->uploadcropimages($request->thumnail, $rand);
        $obj = new MediaImages();
        $obj->status = 1;
        $obj->urls = $thumb_path;
        $obj->thumbnails = $thumb_path;
        $obj->save();
    } else {
        $thumb_path = null;
    }

    $publish_date = date("Y-m-d", strtotime($request->publish_date));  

    if($request->blog_name !== null){
        // $ar_blog_title = GoogleTranslate::trans($request->blog_name, 'ar');
        // $es_blog_title = GoogleTranslate::trans($request->blog_name, 'es');
        // $fr_blog_title = GoogleTranslate::trans($request->blog_name, 'fr');
        // $sw_blog_title = GoogleTranslate::trans($request->blog_name, 'sw');

        $ar_blog_title = null;
        $es_blog_title = null;
        $fr_blog_title = null;
        $sw_blog_title = null;
    } else {
        $ar_blog_title = null;
        $es_blog_title = null;
        $fr_blog_title = null;
        $sw_blog_title = null;
    }

    if($request->blog_content !== null){
        // $ar_blog_content = GoogleTranslate::trans($request->blog_content, 'ar');
        // $es_blog_content = GoogleTranslate::trans($request->blog_content, 'es');
        // $fr_blog_content = GoogleTranslate::trans($request->blog_content, 'fr');
        // $sw_blog_content = GoogleTranslate::trans($request->blog_content, 'sw');

        $ar_blog_content = null;
        $es_blog_content = null;
        $fr_blog_content = null;
        $sw_blog_content = null;
    } else {
        $ar_blog_content = null;
        $es_blog_content = null;
        $fr_blog_content = null;
        $sw_blog_content = null;
    }

    if($request->page_title !== null){
        // $ar_page_title = GoogleTranslate::trans($request->page_title, 'ar');
        // $es_page_title = GoogleTranslate::trans($request->page_title, 'es');
        // $fr_page_title = GoogleTranslate::trans($request->page_title, 'fr');
        // $sw_page_title = GoogleTranslate::trans($request->page_title, 'sw');

        $ar_page_title = null;
        $es_page_title = null;
        $fr_page_title = null;
        $sw_page_title = null;
    } else {
        $ar_page_title = null;
        $es_page_title = null;
        $fr_page_title = null;
        $sw_page_title = null;
    }

    if($request->meta_keywords !== null){
        // $ar_meta_keywords = GoogleTranslate::trans($request->meta_keywords, 'ar');
        // $es_meta_keywords = GoogleTranslate::trans($request->meta_keywords, 'es');
        // $fr_meta_keywords = GoogleTranslate::trans($request->meta_keywords, 'fr');
        // $sw_meta_keywords = GoogleTranslate::trans($request->meta_keywords, 'sw');

        $ar_meta_keywords = null;
        $es_meta_keywords = null;
        $fr_meta_keywords = null;
        $sw_meta_keywords = null;
    } else {
        $ar_meta_keywords = null;
        $es_meta_keywords = null;
        $fr_meta_keywords = null;
        $sw_meta_keywords = null;
    }

    if($request->meta_description !== null){
        // $ar_meta_description = GoogleTranslate::trans($request->meta_description, 'ar');
        // $es_meta_description = GoogleTranslate::trans($request->meta_description, 'es');
        // $fr_meta_description = GoogleTranslate::trans($request->meta_description, 'fr');
        // $sw_meta_description = GoogleTranslate::trans($request->meta_description, 'sw');

        $ar_meta_description = null;
        $es_meta_description = null;
        $fr_meta_description = null;
        $sw_meta_description = null;
    } else {
        $ar_meta_description = null;
        $es_meta_description = null;
        $fr_meta_description = null;
        $sw_meta_description = null;
    }

    $obj = new Blogs();
    $obj->category_id = $request->category_id;
    $obj->banner_image = $banner_path;
    $obj->thumb_image = $thumb_path;
    $obj->blog_title = $request->blog_name;
    $obj->ar_blog_title = $ar_blog_title;
    $obj->es_blog_title = $es_blog_title;
    $obj->fr_blog_title = $fr_blog_title;
    $obj->sw_blog_title = $sw_blog_title;
    $obj->blog_url = strtolower($request->blog_url);
    $obj->blog_content = $request->blog_content;
    $obj->ar_blog_content = $ar_blog_content;
    $obj->es_blog_content = $es_blog_content;
    $obj->fr_blog_content = $fr_blog_content;
    $obj->sw_blog_content = $sw_blog_content;
    $obj->tags = $tags;
    $obj->author = $request->author;
    $obj->ar_tags = $ar_tags;
    $obj->es_tags = $es_tags;
    $obj->fr_tags = $fr_tags;
    $obj->sw_tags = $sw_tags;
    $obj->page_title = $request->page_title;
    $obj->ar_page_title = $ar_page_title;
    $obj->es_page_title = $es_page_title;
    $obj->fr_page_title = $fr_page_title;
    $obj->sw_page_title = $sw_page_title;
    $obj->meta_keywords = $request->meta_keywords;
    $obj->ar_meta_keywords = $ar_meta_keywords;
    $obj->es_meta_keywords = $es_meta_keywords;
    $obj->fr_meta_keywords = $fr_meta_keywords;
    $obj->sw_meta_keywords = $sw_meta_keywords;
    $obj->meta_description = $request->meta_description;
    $obj->ar_meta_description = $ar_meta_description;
    $obj->es_meta_description = $es_meta_description;
    $obj->fr_meta_description = $fr_meta_description;
    $obj->sw_meta_description = $sw_meta_description;
    $obj->publish_date = $publish_date;
    $obj->is_published = $request->is_published;
    $obj->status = $request->is_published;
    $obj->save();

    $Update = Blogs::find($obj->id);
    $Update->blog_order = $obj->id;
    $Update->update();

    return redirect('/admin/blog/all-post');
}

 public function show($id)
    {
        $id = base64_decode($id);
$blog = Blogs::findOrFail($id);

        $blog = Blogs::where('id', $id)->where('is_published', 1)->firstOrFail();

        return view('frontend.products.blogdetails', compact('blog'));
    } 

     public function blog_details(){
         return view('admin.blog.add_details');
     }
 
     public function blog_view(){
         return view('admin.blog.view');
     }
 
     public function blog_edit($id){
      $id=base64_decode($id);
      $blog = Blogs::where('id',$id)->first();
      $Categories = Categories::select('id','name')->where('type',3)->get();

      return view('admin.blog.edit',compact('blog','Categories'));
     }

   public function blogUpdate(Request $request){
    ini_set('memory_limit', '3072M');
    ini_set('max_execution_time', 10080);
    ini_set('upload_max_filesize', '100M');

    if($request->tags != null){
        // if tag not exist insert
        foreach($request->tags as $k => $item){
            $check = Tags::select('id')->where('name', $item)->first();
            if(empty($check)){
                $data = new Tags();
                $data->name = $item;
                $data->status = 1;
                $data->save();
            }
        }

        $tags = implode(',', $request->tags);

        // Commented out Google Translate
        // $ar_tags = GoogleTranslate::trans($tags, 'ar');
        // $es_tags = GoogleTranslate::trans($tags, 'es');
        // $fr_tags = GoogleTranslate::trans($tags, 'fr');
        // $sw_tags = GoogleTranslate::trans($tags, 'sw');

        $ar_tags = null;
        $es_tags = null;
        $fr_tags = null;
        $sw_tags = null;
    } else {
        $tags = null;
        $ar_tags = null;
        $es_tags = null;
        $fr_tags = null;
        $sw_tags = null;
    }

    $Image_path = public_path() . $request->edit_banner_image;
    if(File::exists($Image_path) && $request->banner_image != null) {
        File::delete($Image_path);
    }

    $Image_path1 = public_path() . $request->edit_thumb_image;
    if(File::exists($Image_path1) && $request->thumb_image != null) {
        File::delete($Image_path1);
    }

    $rand = rand(11111, 99999);
    if($request->banner_image != null){
        $image = $request->file('banner_image');
        $imageName = $image->getClientOriginalName();
        $extension = $request->banner_image->getClientOriginalExtension();
        $img1 = Image::make($image);   
        $title_img = 'Blog_banner_'.$rand.'.'.$extension;
        $banner_path = '/img/blog/'.$title_img;
        $img1->save(public_path($banner_path));

        $obj = new MediaImages();
        $obj->status = 1;
        $obj->urls = $banner_path;
        $obj->thumbnails = $banner_path;
        $obj->save();
    } else {
        $banner_path = $request->edit_banner_image;
    }

    if($request->thumb_image != null){
        $thumb_path = $this->uploadcropimages($request->thumnail, $rand);

        $obj = new MediaImages();
        $obj->status = 1;
        $obj->urls = $thumb_path;
        $obj->thumbnails = $thumb_path;
        $obj->save();
    } else {
        $thumb_path = $request->edit_thumb_image;
    }

    $publish_date = $request->publish_date != null 
        ? date("Y-m-d", strtotime($request->publish_date)) 
        : $request->prv_publish_date;

    if($request->blog_name !== null){
        // $ar_blog_title = GoogleTranslate::trans($request->blog_name, 'ar');
        // $es_blog_title = GoogleTranslate::trans($request->blog_name, 'es');
        // $fr_blog_title = GoogleTranslate::trans($request->blog_name, 'fr');
        // $sw_blog_title = GoogleTranslate::trans($request->blog_name, 'sw');

        $ar_blog_title = null;
        $es_blog_title = null;
        $fr_blog_title = null;
        $sw_blog_title = null;
    } else {
        $ar_blog_title = null;
        $es_blog_title = null;
        $fr_blog_title = null;
        $sw_blog_title = null;
    }

    if($request->blog_content !== null){
        // $ar_blog_content = GoogleTranslate::trans($request->blog_content, 'ar');
        // $es_blog_content = GoogleTranslate::trans($request->blog_content, 'es');
        // $fr_blog_content = GoogleTranslate::trans($request->blog_content, 'fr');
        // $sw_blog_content = GoogleTranslate::trans($request->blog_content, 'sw');

        $ar_blog_content = null;
        $es_blog_content = null;
        $fr_blog_content = null;
        $sw_blog_content = null;
    } else {
        $ar_blog_content = null;
        $es_blog_content = null;
        $fr_blog_content = null;
        $sw_blog_content = null;
    }

    if($request->page_title !== null){
        // $ar_page_title = GoogleTranslate::trans($request->page_title, 'ar');
        // $es_page_title = GoogleTranslate::trans($request->page_title, 'es');
        // $fr_page_title = GoogleTranslate::trans($request->page_title, 'fr');
        // $sw_page_title = GoogleTranslate::trans($request->page_title, 'sw');

        $ar_page_title = null;
        $es_page_title = null;
        $fr_page_title = null;
        $sw_page_title = null;
    } else {
        $ar_page_title = null;
        $es_page_title = null;
        $fr_page_title = null;
        $sw_page_title = null;
    }

    if($request->meta_keywords !== null){
        // $ar_meta_keywords = GoogleTranslate::trans($request->meta_keywords, 'ar');
        // $es_meta_keywords = GoogleTranslate::trans($request->meta_keywords, 'es');
        // $fr_meta_keywords = GoogleTranslate::trans($request->meta_keywords, 'fr');
        // $sw_meta_keywords = GoogleTranslate::trans($request->meta_keywords, 'sw');

        $ar_meta_keywords = null;
        $es_meta_keywords = null;
        $fr_meta_keywords = null;
        $sw_meta_keywords = null;
    } else {
        $ar_meta_keywords = null;
        $es_meta_keywords = null;
        $fr_meta_keywords = null;
        $sw_meta_keywords = null;
    }

    if($request->meta_description !== null){
        // $ar_meta_description = GoogleTranslate::trans($request->meta_description, 'ar');
        // $es_meta_description = GoogleTranslate::trans($request->meta_description, 'es');
        // $fr_meta_description = GoogleTranslate::trans($request->meta_description, 'fr');
        // $sw_meta_description = GoogleTranslate::trans($request->meta_description, 'sw');

        $ar_meta_description = null;
        $es_meta_description = null;
        $fr_meta_description = null;
        $sw_meta_description = null;
    } else {
        $ar_meta_description = null;
        $es_meta_description = null;
        $fr_meta_description = null;
        $sw_meta_description = null;
    }

    $obj = Blogs::find($request->edit_id);
    $obj->category_id = $request->category_id;
    $obj->banner_image = $banner_path;
    $obj->thumb_image = $thumb_path;
    $obj->blog_title = $request->blog_name;
    $obj->ar_blog_title = $ar_blog_title;
    $obj->es_blog_title = $es_blog_title;
    $obj->fr_blog_title = $fr_blog_title;
    $obj->sw_blog_title = $sw_blog_title;
    $obj->blog_url = strtolower($request->blog_url);
    $obj->blog_content = $request->blog_content;
    $obj->ar_blog_content = $ar_blog_content;
    $obj->es_blog_content = $es_blog_content;
    $obj->fr_blog_content = $fr_blog_content;
    $obj->sw_blog_content = $sw_blog_content;
    $obj->tags = $tags;
    $obj->ar_tags = $ar_tags;
    $obj->es_tags = $es_tags;
    $obj->fr_tags = $fr_tags;
    $obj->sw_tags = $sw_tags;
    $obj->page_title = $request->page_title;
    $obj->ar_page_title = $ar_page_title;
    $obj->es_page_title = $es_page_title;
    $obj->fr_page_title = $fr_page_title;
    $obj->sw_page_title = $sw_page_title;
    $obj->meta_keywords = $request->meta_keywords;
    $obj->ar_meta_keywords = $ar_meta_keywords;
    $obj->es_meta_keywords = $es_meta_keywords;
    $obj->fr_meta_keywords = $fr_meta_keywords;
    $obj->sw_meta_keywords = $sw_meta_keywords;
    $obj->meta_description = $request->meta_description;
    $obj->ar_meta_description = $ar_meta_description;
    $obj->es_meta_description = $es_meta_description;
    $obj->fr_meta_description = $fr_meta_description;
    $obj->sw_meta_description = $sw_meta_description;
    $obj->publish_date = $publish_date;
    $obj->is_published = $request->is_published;
    $obj->status = $request->is_published;
    $obj->author = $request->author;
    $obj->update();

    return redirect('/admin/blog/all-post');
}


    public function blog_delete($id){
      $id=base64_decode($id);
      Blogs::where('id',$id)->update(['is_deleted' => 1]);
      toast('Blogs Successfully Deleted!!!','success');
      return redirect()->back();
    }
 
     public function blog_categories(){
         $Categories = Categories::where('type',3)->latest()->paginate(10);
        $totalcount = Categories::where('type',3)->count();
        $activecount = Categories::where('status',1)->where('type',3)->count();
        $incativecount = Categories::where('status',0)->where('type',3)->count();
        $Category_list = Categories::select('id','name')->where('type',3)->latest()->get();


        return view('admin.blog.categories',compact('Categories','totalcount','activecount','incativecount','Category_list'));
     }

    public function CategoriesAddEdit(Request $request){
      $categories = explode(',',$request->category_name);
      if($request->edit_id == 0){
        foreach($categories as $k=>$value){
          $is_exists = Categories::where('name',$value)->where('type',$request->type)->count();
          if($is_exists == 0){
            $Insert = new Categories;
            $Insert->name = $value;
            $Insert->type = $request->type;
            $Insert->status = $request->is_active;
            $Insert->save();

            $looup = new Categories_lookups;
            $looup->categry_lookup = $Insert->id;
            $looup->category_id = $Insert->id;
            $looup->save();
          }
        }
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
        $obj->type = $request->type;
        $obj->status = $request->is_active_edit;
        $obj->update();
        toast('Categories Successfully Edited!!!','success');
      }
      return redirect()->back();
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
 
     public function deleteCategories($id)
     {
       $id=base64_decode($id);
       Categories::where('id',$id)->delete();
       toast('Category Successfully Deleted!!!','success');
       return redirect()->back();
     }

     public function TagsIndex(Request $request){
       $Tags = Tags::select('id','name','status','created_at')->paginate(10);
       return view('admin.blog.tags',compact('Tags'));
     }

     public function tagsAddEdit(Request $request){
      // First Check Tag Exist or Not.
      if($request->tag_id == 0){
        $tags = explode(',',$request->tags);
        foreach($tags as $k=>$tag){
          $check = Tags::select('id')->where('name',$tag)->first();
          if(empty($check)){
              $obj = new Tags();
              $obj->name = $tag;
              $obj->status = $request->is_active;
              $obj->save();
              toast('Tag Successfully Added!!!','success');
            }
          }
      }else{        
        $obj = Tags::find($request->tag_edit_id);
        $obj->name = $tag;
        $obj->status = $request->is_active;
        $obj->update();
        toast('Tag Successfully Edited!!!','success');
      }
        return redirect('/admin/blog/blog-tags');
     }

     public function deleteTags($id){
          $id=base64_decode($id);
          Tags::where('id',$id)->delete();
          toast('Tag Successfully Deleted!!!','success');
          return redirect()->back();
     }

     
     public function statusTags($status,$id)
     {
       $id=base64_decode($id);
       $status = base64_decode($status);
       if($status == 0){
        Tags::where('id',$id)->update(['status' => 1]);
       }else{
        Tags::where('id',$id)->update(['status' => 0]);
       }
       toast('Status Updated Successfully!!!','success');
 
       return redirect()->back();
     }

    // Banner Images Upload

public function bannerFileStore(Request $request, $module)
    {
      
      ini_set('memory_limit', '3072M');
      ini_set('max_execution_time', 10080);
      ini_set('upload_max_filesize', '20M');

      $rnd = rand();
      $extension = $request->file->getClientOriginalExtension();
      $file = $request->file('file');
        if($extension == "mp4" || $extension == "ogg" || $extension == "avi" || $extension == "mov" || $extension == "mkv"){
          $title_img = 'blog'.'_'.$rnd.'.'.$extension;
          $path_img = '/img/blog/blog'.'_'.$rnd.'.'.$extension;
          $path = public_path().'/img/blog/';
          $file->move($path, $title_img);
        }else{
          $title_img = 'blog'.'_'.$rnd.'.jpg';
          $path_img = '/img/blog/blog'.'_'.$rnd.'.jpg';
          $path = public_path().'/img/blog/';
          $file->move($path, $title_img);
        }

        $obj = new BannerImages();
        $obj->type = 3;
        $obj->status = 1;
        $obj->urls = $path_img;
        $obj->save();
       toast('Images Upload Successfully!!!','success');
        return response()->json(['success'=>$title_img]);
    }


    
    public function deleteBannerPhoto(Request $request){
      $moduleid = (int) $request->moduleid;
      $Image_path = public_path().$request->inputUrl;
      $res=BannerImages::where('id',$moduleid)->delete();
      if(File::exists($Image_path)) {
         File::delete($Image_path);
            return true;
        }else{
            return false;
        }
    }

    public function editBannerImgStore(Request $request){
        $moduleid = $request->moduleid;
        $inputTitle = $request->inputTitle;
        $inputAlt = $request->inputAlt;
        $inputUrl = $request->inputUrl;
        $inputDescription = $request->inputDescription;
      
        BannerImages::where('id',$moduleid)->update(['title' => $inputTitle,'alt' => $inputAlt,'urls' => $inputUrl,
        'description' =>$inputDescription]);
        return redirect()->back();
    }




public function uploadcropimages($imgdata, $randn)
{
    $manager = new ImageManager(new GdDriver());

    $title_img = 'Blog_thumb_' . $randn . '.jpg';
    $relativePath = '/img/blog/thumbnail/' . $title_img;
    $fullPath = public_path($relativePath);

    // Ensure the directory exists
    $directory = dirname($fullPath);
    if (!file_exists($directory)) {
        mkdir($directory, 0755, true);
    }

    $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgdata));
    $img1 = $manager->read($info);
    // If you need resizing, uncomment below
    // $img1->resize(400, 446);
    $img1->save($fullPath);

    return $relativePath;
}



      // Sub categories Start
    public function blog_subcategories(){
      $Categories = Categories::select('id','name')->where('type',3)->get();
      $Subcategories = Subcategories::join('categories','categories.id','subcategories.category_id')
      ->select('subcategories.id','subcategories.name','subcategories.category_id','subcategories.status','subcategories.created_at')
      ->where('type',3)->get();
      return view('admin.blog.subcategories',compact('Subcategories','Categories'));
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

  public function sorting(Request $request)
  {
    $blogIdsArray = $_POST['order'];
    $count = 1;
    foreach ($blogIdsArray as $id) {
      $blogOrder = $count;
      $photo = Blogs::find($id);
      $photo->blog_order= $blogOrder;
      $photo->save();
      $count ++;      
    }
      return response(['message' => 'Blogs order is updated Successfully!!!', 'status' => 'success'], 200);
    
  }
  public function BlogCategorySorting(Request $request)
  {
    $productIdsArray = $_POST['order'];
    $count = 1;
    foreach ($productIdsArray as $id) {
      $categoryOrder = $count;
      $obj = Categories::where('id',$id)->where('type',3)->update(['category_order'=>$categoryOrder]);
      $count ++;
    }
      return response(['message' => 'Products order is updated Successfully!!!', 'status' => 'success'], 200);
    
  }
  
}
