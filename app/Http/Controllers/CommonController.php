<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin\Projects;
use App\Models\admin\Products;
use App\Models\admin\ProjectImages;
use App\Models\admin\Brandimages;
use App\Models\admin\BannerImages;
use App\Models\admin\EventImages;
use App\Models\admin\ProductImages;
use App\Models\Categories;
use App\Models\admin\Categories_lookups;
use App\Models\admin\Catalogues;
use App\Models\Subcategories;
use App\Models\admin\Tags;
use App\Models\admin\Cmspages;
use App\Models\admin\MediaImages;
use App\Models\admin\Blogs;
use App\Models\admin\FollowUs;
use App\Models\admin\Seo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Models\admin\Media;

class CommonController extends Controller
{
    //

    public static function ImagesFetch($module){
      if($module == 'project'){
          $results = ProjectImages::where('status',1)->get();
      }
      else if($module == 'product'){
        $results = ProductImages::where('status',1)->get();
      }
      else{
        $results = MediaImages::where('status',1)->get();
      }
    return $results;
    }


    public static function blog_images($module){
       
          $blog_images = Blogs::select('id','banner_image','thumb_image')->get();
        
      return $blog_images;
      }


    public static function BannerImagesFetch($module){
        if($module == 'project'){
            $type = 2;
        }else{
            $type = 3;
        }
        $results = BannerImages::where('status',1)->where('type',$type)->get();
        return $results;
    }

    public static function EventGalleryImagesFetch($module,$pid){
        $pid = strip_tags($pid);
        $results = EventImages::where('status',1)->get();
        return $results;
    }

    public function FetchCategories(Request $request){
        $result = Categories::select('name')->Where('name','like',"%{$request->category_name}%")->get();
        $arr = array();
        foreach($result as $item){
            $arr[] = $item->name;
        }
        return $arr;
    }

    public function FetchTags(Request $request){
        $result = Tags::select('name')->Where('name','like',"%{$request->category_name}%")->get();
        $arr = array();
        foreach($result as $item){
            $arr[] = $item->name;
        }
        return $arr;
    }

    public function FetchProducts(Request $request){
        $result = Products::select('title')->Where('title','like',"%{$request->category_name}%")->get();
        $arr = array();
        foreach($result as $item){
            $arr[] = $item->title;
        }
        return $arr;
    }

    public function FetchProjects(Request $request){
        $result = Projects::select('title')->Where('title','like',"%{$request->project_name}%")->get();
        $arr = array();
        foreach($result as $item){
            $arr[] = $item->title;
        }
        return $arr;
    }
    
    public function FetchSubCategories(Request $request){
        $result = Subcategories::select('name')->Where('name','like',"%{$request->subcategory_name}%")->get();
        $arr = array();
        foreach($result as $item){
            $arr[] = $item->name;
        }
        return $arr;
    }

    public function subCategoryListFetch(Request $request){
        $result = Categories_lookups::select('categry_lookup')->Where('category_id',$request->idCategory)->get();
        foreach($result as $k=>$item){
            $result1[] =  Categories::select('id','name')->Where('id',$item->categry_lookup)->first(); 
        }
        return response()->json(['result'=>$result1]);
      }

    public static function FetchOneTag($tag_id){
        $result = Tags::select('id','name')->Where('id',$tag_id)->first();
        $results = ($result == null) ? 'N/A' : $result;
        return $results;
    }

    public static function FetchOneCategory($Category_id){
        $results = Categories::select('id','name')->Where('id',$Category_id)->first();
        $result = ($results == null) ? 'N/A' : $results->name;
        return $result;
    }

    

    public static function FetchArrayCategories($Categories){
            $Categoryids = explode(',',$Categories);
            if (session()->has('locale') && session()->get('locale')!='en'){
                $name= app()->getLocale().'_name';
            }else {
                $name= 'name';
            }
            
            foreach($Categoryids as $Category_id){
                $result = Categories::select('id',"$name as name")->Where('id',$Category_id)->first();
                $results[] = ($result == null) ? 'N/A' : $result;
            }
            return $results;
    }

    public static function FetchArrayProducts($Products){
        $Productsname = explode(',',$Products);
        foreach($Productsname as $Product_name){
            $result = Products::Where('title',$Product_name)->first();
            $results[] = ($result == null) ? 'N/A' : $result;
        }
        return $results;
    }

    public static function FetchArrayProjects($Projects){
        $Projectname = explode(',',$Projects);
        foreach($Projectname as $Project_name){
            $result = Projects::Where('title',$Project_name)->first();
            $results[] = ($result == null) ? 'N/A' : $result;
        }
        return $results;
    }

    public static function FetchPageName($page_id){
        $result = Cmspages::select('page_title','page_url')->Where('id',$page_id)->first();
        $results = ($result == null) ? 'N/A' : $result;
        return $results;
    }

    public static function CountBlogCategory($Category_id){
        $count = Blogs::Where('category_id',$Category_id)->where('is_deleted',0)->where('status',1)->count();
        $counts = ($count == null) ? 0 : $count;
        return $counts;
    }

    public static function FetchBlogCategories(){
        if (session()->has('locale') && session()->get('locale')!='en'){
            $name= app()->getLocale().'_name';
        }else {
            $name= 'name';
        }

        $Categories = Categories::select('id',"$name as name")->where('status',1)->where('type',3)->get();   
        return $Categories;
    }


    public static function FetchBlogArchives_old(){
        $Archives = Blogs::select(
            DB::raw('count(id) as `count`'),
            DB::raw("DATE_FORMAT(publish_date, '%Y-%m') as publish_dates")
            )->where('publish_date','!=',null)->groupBy('publish_dates')->orderby('publish_dates','desc')->get();
        return $Archives;
    }

    public static function FetchBlogArchives(){
        $Archives = Blogs::select(
            DB::raw('count(id) as `count`'),
            DB::raw("DATE_FORMAT(publish_date, '%Y') as publish_dates")
            )->where('publish_date','!=',null)->groupBy('publish_dates')->orderby('publish_dates','desc')->get();
        return $Archives;
    }

    public static function FetchBlogArchives_month($publishdate){
        $Archives = Blogs::select(
            DB::raw('count(id) as `count`'),
            DB::raw("DATE_FORMAT(publish_date, '%Y-%m') as publish_dates")
            )->where('is_deleted',0)->where('status',1)->whereYear('publish_date','=',$publishdate)->groupBy('publish_dates')->orderby('publish_dates','asc')->get();
        return $Archives;
    }   
   
    public static function FollowUs(){
      $FollowUs = FollowUs::select('id','url','images','icons')->where('status',1)->get();
      return $FollowUs;
    } 

    public static function OneCatalogueFetch($Catalogue_id){
        $result = Catalogues::select('id','thumnail','pdf')->where('id',$Catalogue_id)->first();
        $results = ($result == null) ? 'N/A' : $result;
        return $results;
    }

    public static function SeoDetails($url){
        if(App::getLocale() == "en"){
            $seo = Seo::select('id','language','page_name','title','urls','meta_keywords','meta_description','meta_tag_script')
            ->where('language','en')->where('urls',$url)->first();
        }else{
            $seo = Seo::select('id','language','page_name','title','urls','meta_keywords','meta_description','meta_tag_script')
            ->where('language',App::getLocale())->where('urls',$url)->first();
        }
        
       return  $seo;
    }


    public static function BlogSeoDetails($url){
        $seo = DB::table('blogs')->select('id','page_title','meta_keywords','blog_url','meta_description')->where('blog_url',$url)->where('is_deleted',0)->first();
        return $seo;
    }

    public static function UrlsList(){
       $urls =  DB::table('urls')->where('status',1)->get();
       return $urls;
    }

    public static function ParentCategories(){

        if (session()->has('locale') && session()->get('locale')!='en'){
            $name= app()->getLocale().'_name';
        }else {
            $name= 'name';
        }
        
        $ParentCategories = Categories::join('categories_lookups','categories.id','categories_lookups.category_id')
        ->select('id',"$name as name",'type','status','categry_lookup','category_id','seourl')
        ->where('categories.status',1)
        ->where('categories.type',1)
        ->whereColumn('categories_lookups.categry_lookup', 'categories_lookups.category_id')
        ->orderby('category_order','asc')
        ->get();

        return $ParentCategories;
    }


    public static function ChildCategories($cid){
        if (session()->has('locale') && session()->get('locale')!='en'){
            $name= app()->getLocale().'_name';
        }else {
            $name= 'name';
        }

       $SubCategoryIds = Categories_lookups::select('categry_lookup','category_id')
       ->where('category_id',$cid)
       ->whereColumn('categories_lookups.categry_lookup','!=' ,'categories_lookups.category_id')
       ->get();

       $result = [];
        foreach($SubCategoryIds as $item){
           $result[] = Categories::select('id',"$name as name",'type','status','seourl')
           ->where('id',$item->categry_lookup)->where('type',1)->where('status',1)->first();
        }
    //    usort($result, fn($a, $b) => strcmp($a->category_order, $b->category_order));

    return $result;
    }

}
