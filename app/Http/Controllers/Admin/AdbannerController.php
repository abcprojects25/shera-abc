<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Adbanners;
use File;
use Alert;
use Auth;
use Image;
class AdbannerController extends Controller
{
   //Ad Banners Start
   public function AdBanners()
   {
     $Adbanners = Adbanners::paginate(10);
     return view('admin.adbanners.index',compact('Adbanners'))->render();
   }

   public function AddBanner($id=null){
     $id = base64_decode($id);
     $editdata = Adbanners::where('status',1)->where('id',$id)->first();
     return view('admin.adbanners.add_banner',compact('editdata'));
   }

   public function AddBannerStore(Request $request){
     ini_set( 'memory_limit', '30772M' );
     ini_set( 'max_execution_time', 10080 );
     ini_set( 'upload_max_filesize', '50M' );

     $rand = mt_rand( '0000000', '9999999' );
     
     if($request->edit_id == 0){
       // Add Here
       if($request->mobile_file != null ) {
         $extension = $request->mobile_file->getClientOriginalExtension();
         $video = $request->file( 'mobile_file' );
         $title_video = 'mobile_video_'.$rand.'.'.$extension;
         $mobile_video = '/img/adbanners/mobile_video_'.$rand.'.'.$extension;
         $path = public_path().'/img/adbanners/';
         $video->move( $path, $title_video );
       }else{
           $mobile_video = null;
         }
         
         if($request->desktop_file != null ) {
         $extension1 = $request->desktop_file->getClientOriginalExtension();
         $video = $request->file( 'desktop_file' );
         $title_video = 'desktop_video_'.$rand.'.'.$extension1;
         $desktop_video = '/img/adbanners/desktop_video_'.$rand.'.'.$extension1;
         $path = public_path().'/img/adbanners/';
         $video->move( $path, $title_video );
       }else{
           $desktop_video = null;
       }
 
       $obj = new Adbanners;
       $obj->desktop_header = $request->desktop_header;
       $obj->desktop_video = $desktop_video;
       $obj->mobile_header = $request->mobile_header;
       $obj->mobile_video = $mobile_video;
       $obj->status = 1;
       $obj->save();
 
     }else{
       // update Here
       $Video_path = public_path().$request->prev_mobile_video;
       if ( File::exists( $Video_path ) && $request->mobile_file != null ) {
           File::delete( $Video_path );
       }

       $Video_path1 = public_path().$request->prev_desktop_video;
       if ( File::exists( $Video_path1 ) && $request->desktop_file != null ) {
           File::delete( $Video_path1 );
       }

       if($request->mobile_file != null ) {
         $extension = $request->mobile_file->getClientOriginalExtension();
         $video = $request->file( 'mobile_file' );
         $title_video = 'mobile_video_'.$rand.'.'.$extension;
         $mobile_video = '/img/adbanners/mobile_video_'.$rand.'.'.$extension;
         $path = public_path().'/img/adbanners/';
         $video->move( $path, $title_video );
       }else{
           $mobile_video = $request->prev_mobile_video;
       }
 
       if($request->desktop_file != null ) {
         $extension1 = $request->desktop_file->getClientOriginalExtension();
         $video = $request->file( 'desktop_file' );
         $title_video = 'desktop_video_'.$rand.'.'.$extension1;
         $desktop_video = '/img/adbanners/desktop_video_'.$rand.'.'.$extension1;
         $path = public_path().'/img/adbanners/';
         $video->move( $path, $title_video );
       }else{
           $desktop_video = $request->prev_desktop_video;
       }
 
       $obj = Adbanners::find($request->edit_id);
       $obj->desktop_header = $request->desktop_header;
       $obj->desktop_video = $desktop_video;
       $obj->mobile_header = $request->mobile_header;
       $obj->mobile_video = $mobile_video;
       $obj->status = 1;
       $obj->update();
 
     }
     
     return redirect('/admin/home-banner');

   }

   public function AdBannerStatus($status,$id){
     $id =  base64_decode($id);
  
     $obj = Adbanners::find($id);
     $obj->status = $status;
     $obj->update();

     toast('Status Updated Successfully!!!','success');

     return redirect('/admin/home-banner');
   }

   public function AdBannerArrowStatus($status,$id){
    $id =  base64_decode($id);
 
    $obj = Adbanners::find($id);
    $obj->is_arrow = $status;
    $obj->update();

    toast('Arrow Status Updated Successfully!!!','success');

    return redirect('/admin/home-banner');
  }


   public function AddBannerDelete($id){
     $id =  base64_decode($id);
     $result = Adbanners::select('mobile_video','desktop_video')->where('id',$id)->first();
     $Video_path = public_path().$result->mobile_video;
     if ( File::exists( $Video_path ) ) {
         File::delete( $Video_path );
     }
     $Video_path1 = public_path().$result->desktop_video;
     if ( File::exists( $Video_path1 )) {
         File::delete( $Video_path1 );
     }
     
     $res=Adbanners::where('id',$id)->delete();

     toast('AdBanner Deleted Successfully!!!','error');
     return redirect('/admin/home-banner');
   }
}
