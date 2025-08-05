<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Press;
use App\Models\Partners;
use Response;
use File;
use Image;
use Illuminate\Support\Facades\Session;
class PressController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    
  public function index_view()
  {
 
    $data = Press::orderBy('id','desc')->get();
    return view('admin.press.listing',compact('data'));
  }

  public function edit($id)
    {
      $id=base64_decode($id);
      $data = Press::where('id',$id)->first();
      return view('admin.press.edit_press',compact('data'));
    }

  public function add_view()
  {
    return view('admin.press.add_press');
  }

  public function index(Request $request)
    {

			//print_r($_POST);
        //	exit; 

        $og_img =$request->thumnail;
        $rand = mt_rand("0000000", "9999999");
        $og_url = $this->uploadcropimages($og_img,'Press_'.$rand);
            

        $obj = new Press;
        $obj->title = $request->title;
        $obj->turl = $request->target_link;
        $obj->image = $og_url;
        $obj->status = $request->is_active;
        $obj->save();

          Session::flash('success','Press Successfully added');
          return redirect()->back();
       
       
    }

    public function update(Request $request)
      {
        $rand = mt_rand("0000000", "9999999");

        $update = Press::find($request->id);
        $update->title = $request->title;
        $update->turl = $request->target_link;
        
      if ($request->thumnail != null) {
          $og_img =$request->thumnail;
          $og_url = $this->uploadcropimages($og_img,'Press_'.$rand);
          $update->image = $og_url;
        }

        $update->save();

        Session::flash('success','Press Successfully Updated');
            return redirect('/admin/press');
      }


    public function uploadcropimages($imgdata, $randn)
    {
            $title_img = $randn.'.jpg';
            $path = ('/img/press/'.$title_img);
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgdata));
            $img1=Image::make($info);
           // $img1->resize(400, 446);
            $img1->save(public_path($path));
            $url = url('img/press/'.$title_img);
            return $path;
            //$seourl = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-',$request->title));
    }

   


    public function changeStatus($status,$id)
    {
      $id=base64_decode($id);
     
        $photo = Press::find($id);
        $photo->status= $status;
        $photo->save();

        Session::flash('success','Status Updated Successfully.');
        return redirect()->back();

      }

      public function delete($id)
      {
        $id=base64_decode($id);
        $photo = Press::find($id)->delete();

       
        Session::flash('error','Successfully Deleted.');
        return redirect()->back();
      }


      public function uploadImage($f, $randn)
      {
          $file = $f;
         // print_r($file); exit;
          $mime = $file->getClientMimeType();
          $ext = $file->getClientOriginalExtension();
          $fileName = $randn . "." . $ext;
          $path = $f->move(public_path('/img/uploads'), $fileName);
          $url = url('img/uploads/' . $fileName);
  
          // S3 upload 
          //   $filePathdata = public_path()."/img/uploads/$fileName";
          //   $contents = file_get_contents($filePathdata);
         //  $filePathAws = 'folder/'.$fileName;
         //  $pathaws = Storage::disk('s3')->put($filePathAws, $contents);
  
          return $fileName;
      }
  

    

    
}
