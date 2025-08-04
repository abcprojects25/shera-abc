<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Medias;
use App\Models\admin\Products;
use App\Models\admin\ProductImages;
use App\Models\admin\Categories_lookups;
use App\Models\Categories;
use App\Models\admin\Catalogues;
use App\Models\Subcategories;
use App\Models\admin\Tags;
use App\Models\Urls;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use File;
use App\Models\admin\Media;
use App\Models\Admin\ProductApplication;
use App\Models\admin\CategoryImage;
use Illuminate\Support\Facades\DB;
// use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;


use Alert;
use GoogleTranslate;

class ProductController extends Controller
{
    //Index page
    public function Index(){
      $Products = Products::orderBy('product_order','asc')->get();
      $count = Products::where('is_deleted',0)->count();
      $activecount = Products::where('status',1)->where('is_deleted',0)->count();
      $incativecount = Products::where('status',0)->where('is_deleted',0)->count();
      return view('admin.product.listing',compact('Products','count','activecount','incativecount'));
    }

    public function userProductPage()
{
    $Products = Products::all();
    return view('frontend.products', compact('Products'));
}
    public function Home_Index(){
      $Products = Products::orderBy('product_order','asc')->where('is_master_pro',1)->get();
      $count = Products::where('is_deleted',0)->count();
      $activecount = Products::where('status',1)->where('is_deleted',0)->count();
      $incativecount = Products::where('status',0)->where('is_deleted',0)->count();
      return view('admin.product.listing-home',compact('Products','count','activecount','incativecount'));
    }

     // Add Product page
     public function AddProduct(){
      $Categories = Categories::where('type',1)->where('status',1)->get();
      $Catalogues = Catalogues::select('id','title','thumnail')->where('status',1)->get();
      return view('admin.product.add',compact('Categories','Catalogues'));
    }

     // Add Product details
    public function AddDetails(){
        return view('admin.product.add_details');
    }

     // Add Product View
    public function AddView($id){
      $id = base64_decode($id);
    $product = Products::where('id', $id)->first();
    $Categories = Categories::where('type', 1)->get();
    $Catalogues = Catalogues::select('id', 'title', 'thumnail')->where('status', 1)->get();

    return view('admin.product.view', compact('product', 'Categories', 'Catalogues'));
    }

    
    // Add Product Edit
    public function EditProduct($id){
      $id = base64_decode($id);
      $Categories = Categories::where('type',1)->get();
      $edit_data = Products::where('id',$id)->first();
      $Catalogues = Catalogues::select('id','title','thumnail')->where('status',1)->get();

      return view('admin.product.edit',compact('Categories','edit_data','Catalogues'));
    }

    public function product_categories(){
      $Categories = Categories::where('type',1)->latest()->paginate(10);
      $Category_list = Categories::select('id','name')->where('type',1)->orderby('category_order','asc')->get();

      return view('admin.product.categories',compact('Categories','Category_list'));
    }


public static function FetchSubCategories($parent_id)
{
    return \DB::table('categories_lookups')
        ->join('categories', 'categories.id', '=', 'categories_lookups.categry_lookup')
        ->where('categories_lookups.category_id', $parent_id)
        ->where('categories_lookups.categry_lookup','!=', $parent_id)
        ->select(
            'categories.id',
            'categories.name'
        )
        ->distinct()
        ->get();
}




 public function productStore(Request $request){
  ini_set('memory_limit', '3072M');
  ini_set('max_execution_time', 10980);
  ini_set('upload_max_filesize', '100M');

  // if tag not exist insert
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

    // $ar_tags = GoogleTranslate::trans($tags, 'ar');
    // $es_tags = GoogleTranslate::trans($tags, 'es');
    // $fr_tags = GoogleTranslate::trans($tags, 'fr');
    // $sw_tags = GoogleTranslate::trans($tags, 'sw');

    $ar_tags = null;
    $es_tags = null;
    $fr_tags = null;
    $sw_tags = null;
  }else{
    $tags = null;
    $ar_tags = null;
    $es_tags = null;
    $fr_tags = null;
    $sw_tags = null;
  }

  if($request->project_tags != null){
    $project_tags = implode(',',$request->project_tags);

    // $ar_project_tags = GoogleTranslate::trans($project_tags, 'ar');
    // $es_project_tags = GoogleTranslate::trans($project_tags, 'es');
    // $fr_project_tags = GoogleTranslate::trans($project_tags, 'fr');
    // $sw_project_tags = GoogleTranslate::trans($project_tags, 'sw');

    $ar_project_tags = null;
    $es_project_tags = null;
    $fr_project_tags = null;
    $sw_project_tags = null;
  }else{
    $project_tags = null;
    $ar_project_tags = null;
    $es_project_tags = null;
    $fr_project_tags = null;
    $sw_project_tags = null;
  }

  $rand = rand(111,999);
  if($request->thumnail != null){
      $thumnail = $this->uploadcropimages($request->thumnail, 'product_'.$rand);
  }else{
      $thumnail = $request->thumnail;
  }

  if($request->category_ids != null){
    $category_ids = implode(',',$request->category_ids);
  }else{
    $category_ids = null;
  }

  if($request->product_title != null){
    // $ar_title = GoogleTranslate::trans($request->product_title, 'ar');
    // $es_title = GoogleTranslate::trans($request->product_title, 'es');
    // $fr_title = GoogleTranslate::trans($request->product_title, 'fr');
    // $sw_title = GoogleTranslate::trans($request->product_title, 'sw');

    $ar_title = null;
    $es_title = null;
    $fr_title = null;
    $sw_title = null;
  }else{
    $ar_title = null;
    $es_title = null;
    $fr_title = null;
    $sw_title = null;
  }

  if($request->features != null){
    // $ar_features = GoogleTranslate::trans($request->features, 'ar');
    // $es_features = GoogleTranslate::trans($request->features, 'es');
    // $fr_features = GoogleTranslate::trans($request->features, 'fr');
    // $sw_features = GoogleTranslate::trans($request->features, 'sw');

    $ar_features = null;
    $es_features = null;
    $fr_features = null;
    $sw_features = null;
  }else{
    $ar_features = null;
    $es_features = null;
    $fr_features = null;
    $sw_features = null;
  }

  if($request->properties != null){
    // $ar_properties = GoogleTranslate::trans($request->properties, 'ar');
    // $es_properties = GoogleTranslate::trans($request->properties, 'es');
    // $fr_properties = GoogleTranslate::trans($request->properties, 'fr');
    // $sw_properties = GoogleTranslate::trans($request->properties, 'sw');

    $ar_properties = null;
    $es_properties = null;
    $fr_properties = null;
    $sw_properties = null;
  }else{
    $ar_properties = null;
    $es_properties = null;
    $fr_properties = null;
    $sw_properties = null;
  }

  if($request->features != null){
    // $ar_application = GoogleTranslate::trans($request->application, 'ar');
    // $es_application = GoogleTranslate::trans($request->application, 'es');
    // $fr_application = GoogleTranslate::trans($request->application, 'fr');
    // $sw_application = GoogleTranslate::trans($request->application, 'sw');

    $ar_application = null;
    $es_application = null;
    $fr_application = null;
    $sw_application = null;
  }else{
    $ar_application = null;
    $es_application = null;
    $fr_application = null;
    $sw_application = null;
  }

  if($request->description != null){
    // $ar_description = GoogleTranslate::trans($request->description, 'ar');
    // $es_description = GoogleTranslate::trans($request->description, 'es');
    // $fr_description = GoogleTranslate::trans($request->description, 'fr');
    // $sw_description = GoogleTranslate::trans($request->description, 'sw');

    $ar_description = null;
    $es_description = null;
    $fr_description = null;
    $sw_description = null;
  }else{
    $ar_description = null;
    $es_description = null;
    $fr_description = null;
    $sw_description = null;
  }

  $obj = new Products();
    $obj->category_id = $category_ids;
    $obj->title = $request->product_title;
    $obj->ar_title = $ar_title;
    $obj->es_title = $es_title;
    $obj->fr_title = $fr_title;
    $obj->sw_title = $sw_title;
    $obj->image = $thumnail;
    $obj->brochure_id = $request->brochure_id;        
    $obj->product_url = $request->product_url;        
    $obj->video_title = $request->video_title;
    $obj->video_type = $request->video_type;
    $obj->video_url = $request->video_url;
    $obj->sku = $request->sku;
    $obj->panel_size = $request->panel_size; 
    $obj->features = $request->features;
    $obj->ar_features = $ar_features;
    $obj->es_features = $es_features;
    $obj->fr_features = $fr_features;
    $obj->sw_features = $sw_features; 
    $obj->properties = $request->properties;
    $obj->ar_properties = $ar_properties;        
    $obj->es_properties = $es_properties;        
    $obj->fr_properties = $fr_properties;        
    $obj->sw_properties = $sw_properties;
    $obj->application = $request->application;
    $obj->ar_application = $ar_application;
    $obj->es_application = $es_application;
    $obj->fr_application = $fr_application;
    $obj->sw_application = $sw_application;
    $obj->thickness = $request->thickness;
    $obj->core = $request->core;    
    $obj->coil_thickness = $request->coil_thickness;
    $obj->tags = $tags;
    $obj->ar_tags = $ar_tags;
    $obj->es_tags = $es_tags;
    $obj->fr_tags = $fr_tags;
    $obj->sw_tags = $sw_tags;
    $obj->project_tags = $project_tags;
    $obj->ar_project_tags = $ar_project_tags;
    $obj->es_project_tags = $es_project_tags;
    $obj->fr_project_tags = $fr_project_tags;
    $obj->sw_project_tags = $sw_project_tags;
    $obj->description = $request->description;
    $obj->ar_description = $ar_description;
    $obj->es_description = $es_description;
    $obj->fr_description = $fr_description;
    $obj->sw_description = $sw_description;
    $obj->status = $request->is_active;
    $obj->texture = $request->texture;
    $obj->profile = $request->profile;
    $obj->colour = $request->colour;
    $obj->size = $request->size;
    $obj->weight = $request->weight;
    $obj->quantity = $request->quantity;
    $obj->save();

    $Update = Products::find($obj->id);
    $Update->product_order = $obj->id;
    $Update->update();

   toast('Product Inserted Successfully!!!','success');
  return redirect('/admin/product/all-product');
}


    //update product
  public function editStore(Request $request){
    ini_set('memory_limit', '3072M');
    ini_set('max_execution_time', 10980);
    ini_set('upload_max_filesize', '100M');

    // Same As Properties For All
    if($request->category_ids != null && isset($request->same_properties) && $request->same_properties == 1){
        foreach($request->category_ids as $k=>$item){
            $check = Products::select('id')->where('category_id',$item)->count();
            if($check > 0){
                $result = Products::select('id')->where('category_id',$item)->get();
                foreach($result as $item1){
                    $data1 = Products::Find($item1->id);
                    $data1->panel_size = $request->panel_size;
                    $data1->features = $request->features;
                    $data1->properties = $request->properties;
                    $data1->application = $request->application;
                    $data1->thickness = $request->thickness;
                    $data1->core = $request->core;
                    $data1->coil_thickness = $request->coil_thickness;    
                    $data1->update();
                }
            }
        }
    }

    // if tag not exist insert
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

        // $ar_tags = GoogleTranslate::trans($tags, 'ar');
        // $es_tags = GoogleTranslate::trans($tags, 'es');
        // $fr_tags = GoogleTranslate::trans($tags, 'fr');
        // $sw_tags = GoogleTranslate::trans($tags, 'sw');
        $ar_tags = null;
        $es_tags = null;
        $fr_tags = null;
        $sw_tags = null;

    }else{
        $tags = null;
        $ar_tags = null;
        $es_tags = null;
        $fr_tags = null;
        $sw_tags = null;
    }

    if($request->project_tags != null){
        $project_tags = implode(',',$request->project_tags);
        // $ar_project_tags = GoogleTranslate::trans($project_tags, 'ar');
        // $es_project_tags = GoogleTranslate::trans($project_tags, 'es');
        // $fr_project_tags = GoogleTranslate::trans($project_tags, 'fr');
        // $sw_project_tags = GoogleTranslate::trans($project_tags, 'sw');
        $ar_project_tags = null;
        $es_project_tags = null;
        $fr_project_tags = null;
        $sw_project_tags = null;
    }else{
        $project_tags = null;
        $ar_project_tags = null;
        $es_project_tags = null;
        $fr_project_tags = null;
        $sw_project_tags = null;
    }

    $Image_path = public_path().$request->edit_thumnail;
    if(File::exists($Image_path) && $request->thumnail != null) {
        File::delete($Image_path);
    }

    $rand = rand(111,999);
    if($request->thumnail != null){
        $thumnail = $this->uploadcropimages($request->thumnail, 'product_'.$rand);
    }else{
        $thumnail = $request->edit_thumnail;
    }

    if($request->category_ids != null){
        $category_ids = implode(',',$request->category_ids);
    }else{
        $category_ids = null;
    }

    if($request->product_title != null){
        // $ar_title = GoogleTranslate::trans($request->product_title, 'ar');
        // $es_title = GoogleTranslate::trans($request->product_title, 'es');
        // $fr_title = GoogleTranslate::trans($request->product_title, 'fr');
        // $sw_title = GoogleTranslate::trans($request->product_title, 'sw');
        $ar_title = null;
        $es_title = null;
        $fr_title = null;
        $sw_title = null;
    }else{
        $ar_title = null;
        $es_title = null;
        $fr_title = null;
        $sw_title = null;
    }

    if($request->features != null){
        // $ar_features = GoogleTranslate::trans($request->features, 'ar');
        // $es_features = GoogleTranslate::trans($request->features, 'es');
        // $fr_features = GoogleTranslate::trans($request->features, 'fr');
        // $sw_features = GoogleTranslate::trans($request->features, 'sw');
        $ar_features = null;
        $es_features = null;
        $fr_features = null;
        $sw_features = null;
    }else{
        $ar_features = null;
        $es_features = null;
        $fr_features = null;
        $sw_features = null;
    }

    if($request->properties != null){
        // $ar_properties = GoogleTranslate::trans($request->properties, 'ar');
        // $es_properties = GoogleTranslate::trans($request->properties, 'es');
        // $fr_properties = GoogleTranslate::trans($request->properties, 'fr');
        // $sw_properties = GoogleTranslate::trans($request->properties, 'sw');
        $ar_properties = null;
        $es_properties = null;
        $fr_properties = null;
        $sw_properties = null;
    }else{
        $ar_properties = null;
        $es_properties = null;
        $fr_properties = null;
        $sw_properties = null;
    }

    if($request->features != null){
        // $ar_application = GoogleTranslate::trans($request->application, 'ar');
        // $es_application = GoogleTranslate::trans($request->application, 'es');
        // $fr_application = GoogleTranslate::trans($request->application, 'fr');
        // $sw_application = GoogleTranslate::trans($request->application, 'sw');
        $ar_application = null;
        $es_application = null;
        $fr_application = null;
        $sw_application = null;
    }else{
        $ar_application = null;
        $es_application = null;
        $fr_application = null;
        $sw_application = null;
    }

    if($request->description != null){
        // $ar_description = GoogleTranslate::trans($request->description, 'ar');
        // $es_description = GoogleTranslate::trans($request->description, 'es');
        // $fr_description = GoogleTranslate::trans($request->description, 'fr');
        // $sw_description = GoogleTranslate::trans($request->description, 'sw');
        $ar_description = null;
        $es_description = null;
        $fr_description = null;
        $sw_description = null;
    }else{
        $ar_description = null;
        $es_description = null;
        $fr_description = null;
        $sw_description = null;
    }

    $obj = Products::Find($request->edit_id);
    $obj->category_id = $category_ids;
    $obj->title = $request->product_title;
    $obj->ar_title = $ar_title;
    $obj->es_title = $es_title;
    $obj->fr_title = $fr_title;
    $obj->sw_title = $sw_title;
    $obj->image = $thumnail;
    $obj->brochure_id = $request->brochure_id;
    $obj->product_url = $request->product_url;   
    $obj->video_title = $request->video_title;
    $obj->video_type = $request->video_type;
    $obj->video_url = $request->video_url;
    $obj->sku = $request->sku;
    $obj->panel_size = $request->panel_size;
    $obj->features = $request->features;
    $obj->ar_features = $ar_features;
    $obj->es_features = $es_features;
    $obj->fr_features = $fr_features;
    $obj->sw_features = $sw_features;        
    $obj->properties = $request->properties;
    $obj->ar_properties = $ar_properties;        
    $obj->es_properties = $es_properties;        
    $obj->fr_properties = $fr_properties;        
    $obj->sw_properties = $sw_properties;
    $obj->application = $request->application;
    $obj->ar_application = $ar_application;
    $obj->es_application = $es_application;
    $obj->fr_application = $fr_application;
    $obj->sw_application = $sw_application;
    $obj->thickness = $request->thickness;
    $obj->core = $request->core;
    $obj->coil_thickness = $request->coil_thickness;        
    $obj->tags = $tags;
    $obj->ar_tags = $ar_tags;
    $obj->es_tags = $es_tags;
    $obj->fr_tags = $fr_tags;
    $obj->sw_tags = $sw_tags;
    $obj->project_tags = $project_tags;
    $obj->ar_project_tags = $ar_project_tags;
    $obj->es_project_tags = $es_project_tags;
    $obj->fr_project_tags = $fr_project_tags;
    $obj->sw_project_tags = $sw_project_tags;
    $obj->description = $request->description;
    $obj->ar_description = $ar_description;
    $obj->es_description = $es_description;
    $obj->fr_description = $fr_description;
    $obj->sw_description = $sw_description;
    $obj->status = $request->is_active;
    $obj->update();

    toast('Product Updated Successfully!!!','success');
    return redirect('/admin/product/all-product');
}


  public function changeStatus($status, $id)
{
    $id = base64_decode($id);
    $status = base64_decode($status);

    Products::where('id', $id)->update([
        'status' => $status == 0 ? 1 : 0
    ]);

    toast('Status Updated Successfully!!!', 'success');
    return redirect()->back();
}



    public function ChangeHomeStatus($status,$id)
    {
      $id=base64_decode($id);
      $status= base64_decode($status);
      if($status == 0){
        Products::where('id',$id)->update(['is_master_pro' => 1]);
      }else{      
        Products::where('id',$id)->update(['is_master_pro' => 0]);
      }
      toast('Status Updated Successfully!!!','success');

      return redirect()->back();
    }
    
public function deleteProduct($id)
{
    try {
        // Decode and validate the ID
        $decodedId = base64_decode($id);
        if (!is_numeric($decodedId) || $decodedId <= 0) {
            return redirect('/admin/product/all-product')->with('error', 'Invalid product ID');
        }

        // Find the product
        $product = Products::find($decodedId);
        
        if (!$product) {
            return redirect('/admin/product/all-product')->with('error', 'Product not found');
        }

        // Delete the image if exists
        if ($product->image) {
            $imagePath = public_path($product->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // Delete the product
        $product->delete();

        return redirect('/admin/product/all-product')->with('success', 'Product deleted successfully');

    } catch (\Exception $e) {
        return redirect('/admin/product/all-product')->with('error', 'Error deleting product: ' . $e->getMessage());
    }
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
            $title_img = 'product'.'_'.$rnd.'.'.$extension;
            $path_img = '/img/product/product'.'_'.$rnd.'.'.$extension;
            $path = public_path().'/img/product/';
            $file->move($path, $title_img);
          }else{
              $image = $request->file('file');
              $imageName = $image->getClientOriginalName();
              $img1=Image::make($image);   
              $title_img = 'product'.'_'.$rnd.'.jpg';
              $path_img = '/img/product/product'.'_'.$rnd.'.jpg';
              $img1->save(public_path('/img/product/'.$title_img));
          }
  
          $obj = new ProductImages();
          $obj->product_id = $request->parent_id;
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
      
        ProductImages::where('id',$moduleid)->update(['title' => $inputTitle,'alt' => $inputAlt,'urls' => $inputUrl,
        'description' =>$inputDescription]);
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

public function CategoriesAddEdit(Request $request){
    
    // Explode comma separated categories (for tags input)
    $categories = explode(',', $request->category_name);
    
    // If adding new categories
    if ($request->edit_id == 0) {
        foreach ($categories as $k => $value) {
            // Check if category already exists with same name and type
            $is_exists = Categories::where('name', $value)->where('type', $request->type)->count();
            if ($is_exists == 0) {

                // Uncomment if you want to translate category names/descriptions
                // $ar_name = GoogleTranslate::trans($value, 'ar');
                // $es_name = GoogleTranslate::trans($value, 'es');
                // $fr_name = GoogleTranslate::trans($value, 'fr');
                // $sw_name = GoogleTranslate::trans($value, 'sw');
                // $ar_description = GoogleTranslate::trans($request->category_description, 'ar');
                // $es_description = GoogleTranslate::trans($request->category_description, 'es');
                // $fr_description = GoogleTranslate::trans($request->category_description, 'fr');
                // $sw_description = GoogleTranslate::trans($request->category_description, 'sw');

                // Create new category object
                $Insert = new Categories;
                $Insert->name = $value;
                // $Insert->ar_name = null; // $ar_name;
                // $Insert->es_name = null; // $es_name;
                // $Insert->fr_name = null; // $fr_name;
                // $Insert->sw_name = null; // $sw_name;
                $Insert->description = $request->category_description;
                // $Insert->ar_description = null; // $ar_description;
                // $Insert->es_description = null; // $es_description;
                // $Insert->fr_description = null; // $fr_description;
                // $Insert->sw_description = null; // $sw_description;
                $Insert->type = $request->type;
                $Insert->status = $request->is_active;

                // Set SEO URL either from form or generate from category name
                $Insert->seourl = $request->seourl ?? $this->slugify($value);

                // Handle image upload for new category
                if ($request->hasFile('category_img')) {
                    $image = $request->file('category_img');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/categories'), $imageName);
                    $Insert->category_img = 'uploads/categories/' . $imageName;
                }

                // Save category
                $Insert->save();

                // Add lookup entry for category hierarchy
                $looup = new Categories_lookups;
                $looup->categry_lookup = $Insert->id;
                $looup->category_id = $Insert->id;
                $looup->save();
            }
        }
    } else {
        // If updating existing category
        
        // If related categories are sent for lookup, delete old and save new ones
        if ($request->category_id !== null) {
            Categories_lookups::where('categry_lookup', $request->edit_id)->delete();

            foreach ($request->category_id as $j => $item) {
                $looup = new Categories_lookups;
                $looup->categry_lookup = $request->edit_id;
                $looup->category_id = $item;
                $looup->save();
            }
        }

        // Find existing category by ID
        $obj = Categories::find($request->edit_id);

        // Update category fields
        $obj->name = $request->edit_category_name;
        // $obj->ar_name = null; // $ar_name;
        // $obj->es_name = null; // $es_name;
        // $obj->fr_name = null; // $fr_name;
        // $obj->sw_name = null; // $sw_name;
        $obj->description = $request->category_description;
        // $obj->ar_description = null; // $ar_description;
        // $obj->es_description = null; // $es_description;
        // $obj->fr_description = null; // $fr_description;
        // $obj->sw_description = null; // $sw_description;
        $obj->type = $request->type;
        $obj->status = $request->is_active_edit;

        // Update SEO URL only if provided in request
        if ($request->filled('seourl')) {
            $obj->seourl = $request->seourl;
        }

        // Handle image upload for existing category
        if ($request->hasFile('category_img')) {
            // Delete old image if exists
            if ($obj->category_img && file_exists(public_path($obj->category_img))) {
                unlink(public_path($obj->category_img));
            }

            $image = $request->file('category_img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/categories'), $imageName);
            $obj->category_img = 'uploads/categories/' . $imageName;
        }

        // Save updated category
        $obj->update();

        // Flash success message
        toast('Categories Successfully Edited!!!', 'success');
    }
    return redirect()->back();
}

// Helper function to generate SEO-friendly slugs from text
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

 public function uploadcropimages($imgdata, $randn)
{
    $manager = new ImageManager(new GdDriver());

    $title_img = $randn . '.jpg';
    $relativePath = '/img/product/' . $title_img;
    $fullPath = public_path($relativePath);

    // Ensure directory exists
    $directory = dirname($fullPath);
    if (!file_exists($directory)) {
        mkdir($directory, 0755, true);
    }

    $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgdata));
    $img1 = $manager->read($info);
    $img1->save($fullPath);

    return $relativePath;
}
    public function deleteProductPhoto(Request $request){
      $moduleid = (int) $request->moduleid;
      $Image_path = public_path().$request->inputUrl;
      $res=ProductImages::where('id',$moduleid)->delete();
      if(File::exists($Image_path)) {
         File::delete($Image_path);
            return true;
        }else{
            return false;
        }
    }

public function SubCategoriesAddEdit(Request $request) {
    $categories = explode(',', $request->subcategory_name);

    foreach($categories as $k => $value) {
        $is_exists = Categories::where('name', $value)->where('type', $request->type)->count();

        if($is_exists == 0) {
            $Insert = new Categories;
            $Insert->name = $value;
            $Insert->description = $request->subcategory_description;
            $Insert->type = $request->type;
            $Insert->status = $request->is_active;

            // Save SEO URL from request (only first subcategory)
            if ($request->filled('seourl')) {
                $Insert->seourl = $request->seourl;
            } else {
                // fallback: create slug from name
                $Insert->seourl = \Str::slug($value);
            }

            // Handle image upload
            if ($request->hasFile('category_img')) {
                $image = $request->file('category_img');
                $imageName = time().'_'.$image->getClientOriginalName();
                $path = $image->storeAs('public/category_images', $imageName);
                $Insert->category_img = 'storage/category_images/'.$imageName;
            }

            $Insert->save();

            // Save lookup for all selected categories
            foreach($request->category_id as $j => $item) {
                $looup = new Categories_lookups;
                $looup->categry_lookup = $Insert->id;
                $looup->category_id = $item;
                $looup->save();
            }
        }
    }

    toast('Sub-Category Successfully Added!!!', 'success');
    return redirect()->back();
}


  public function sorting(Request $request)
  {
    $productIdsArray = $_POST['order'];
    $count = 1;
    foreach ($productIdsArray as $id) {
      $productOrder = $count;
      $photo = Products::find($id);
      $photo->product_order= $productOrder;
      $photo->save();
      $count ++;      
    }
      return response(['message' => 'Products order is updated Successfully!!!', 'status' => 'success'], 200);
    
  }

  public function ProCategorySorting(Request $request)
  {
    $productIdsArray = $_POST['order'];
    $count = 1;
    foreach ($productIdsArray as $id) {
      $categoryOrder = $count;
      $obj = Categories::where('id',$id)->where('type',1)->update(['category_order'=>$categoryOrder]);
      $count ++;  
    }
      return response(['message' => 'Products order is updated Successfully!!!', 'status' => 'success'], 200);
    
  }


// public function productListing($slug)
// {
//     // Step 1: Retrieve the current category using the provided slug
//     $category = Categories::where('seourl', $slug)->firstOrFail();

//     // Step 2: Attempt to fetch products directly linked to this category
//     $products = Products::where('category_id', $category->id)
//                         ->where('is_deleted', 0)
//                         ->where('status', 1)
//                         ->get();

//     // Step 3: Initialize a collection for child categories
//     $childCategories = collect();

//     // Step 4: If there are no products, check for direct child categories
//     if ($products->isEmpty()) {
//         $childCategoryIds = DB::table('categories_lookups')
//             ->where('category_id', $category->id)
//             ->pluck('categry_lookup');

//         if ($childCategoryIds->isNotEmpty()) {
//             $childCategories = Categories::whereIn('id', $childCategoryIds)->get();
//         }

//         // Step 5: If no child categories, try one level up (get parent category)
//         if ($childCategoryIds->isEmpty()) {
//             // Get the parent category of current category
//             $parentCategoryId = DB::table('categories_lookups')
//                 ->where('categry_lookup', $category->id)
//                 ->value('category_id');

//             if ($parentCategoryId) {
//                 $parentCategory = Categories::find($parentCategoryId);

//                 // Fetch products from the parent category
//                 $products = Products::where('category_id', $parentCategoryId)
//                                     ->where('is_deleted', 0)
//                                     ->where('status', 1)
//                                     ->get();

//                 // Optionally, assign parent category to `$category` if you want to update heading/content
//                 // $category = $parentCategory;
//             }
//         }
//     }

//     return view('frontend.products.product_listing', compact('products', 'category', 'childCategories'));
// }



private function getCategoryBreadcrumbTrail($categoryId)
{
    $trail = [];

    while ($categoryId) {
        $category = \App\Models\Categories::find($categoryId);
        if ($category) {
            $trail[] = $category;
            $categoryId = \DB::table('categories_lookups')
                            ->where('categry_lookup', $category->id)
                            ->value('category_id'); // parent ID
        } else {
            break;
        }
    }

    return array_reverse($trail); // From top to current
}

public function storeApplication(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|array',
        'name.*' => 'required|string|max:255',
        'alt_text' => 'nullable|array',
        'alt_text.*' => 'nullable|string|max:255',
        'image' => 'nullable|array',
        'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    foreach ($request->name as $index => $name) {
        $imagePath = null;
        if ($request->hasFile("image.$index")) {
            $imagePath = $request->file("image")[$index]->store('uploads/images', 'public');
        }

        ProductApplication::create([
            'category_id' => $request->category_id,
            'name' => $name,
            'alt_text' => $request->alt_text[$index] ?? null,
            'image' => $imagePath,
            'status' => 1,
        ]);
    }

    return redirect()->back()->with('success', 'Applications added successfully.');
}


public function storeCategoryImages(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'images.*' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        'alt.*' => 'nullable|string|max:255',
    ]);

    foreach ($request->file('images') as $index => $image) {
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/category_images'), $imageName);

        CategoryImage::create([
            'category_id' => $request->category_id,
            'image_path'  => 'uploads/category_images/' . $imageName,
            'alt'    => $request->alt[$index] ?? '',
            'status'      => 1,
        ]);
    }

    return back()->with('success', 'Images added successfully.');
}

}
