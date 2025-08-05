<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Countries;
use Response;
use File;
use Image;
use Illuminate\Support\Facades\Session;

class CountryController extends Controller
{
    public function __construct()
  {
      $this->middleware('auth');
  }

  public function index11()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
    
    public function index_view()
    {
      $data = Countries::orderBy('id','desc')->get();
      return view('admin.brands.country_listing',compact('data'));
    }

    public function edit($id)
    {
      $id=base64_decode($id);
      $data = Countries::where('id',$id)->first();
      return view('admin.partner.edit_partner',compact('data'));
    }

    public function add_view()
    {
      return view('admin.partner.add_partner');
    }

    public function p_data()
    {
      $id= $_GET['id'];
      $data = Countries::where('id',$id)->first();
      $datas = '<div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">'.$data->title.'</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div><div class="modal-body partner_listing"><div class="row"><div class="col-lg-3 col-md-3"><img src="'.$data->image.'" class="img-fluid d-block"></div><div class="col-lg-7 col-md-6 text-content-block wow light wow fadeIn animated" style="visibility: visible;"><h6> '.$data->title.' </h6><p> '.$data->description.' </p> <div class="d-flex"><div class="">  <h1> '.$data->list_title1.' </h1> '.$data->list_data1.' </div><div class="">  <h1> '.$data->list_title2.' </h1> '.$data->list_data2.' </div> </div></div> <div class="col-lg-2 col-md-3"> <a data-fancybox href="'.$data->video.'"><img src="/img/play.png" class="img-fluid play_icon"><img src="'.$data->thumbnail.'" class="img-fluid d-block"> </a></div></div></div> </div>';

      return $datas;
    }
  
    public function index(Request $request)
      {
  
          //    print_r($_POST);
          //	exit; 
  
          $thumb = $request->file('vthumbnail');
          $rand = mt_rand("0000000", "9999999");
          $thumb_url = $this->uploadImage($thumb,'Flag_'.$rand);
          
          $seourl = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title));
  
          $obj = new Countries;
          $obj->title = $request->title;
          $obj->seourl = $seourl;
          $obj->flag = $thumb_url;
          $obj->status = $request->is_active;
          $obj->save();
  
            Session::flash('success','Country Successfully added!!!');
            return redirect('/admin/country');
         
         
      }

      public function update(Request $request)
      {
        $rand = mt_rand("0000000", "9999999");

        $update = Countries::find($request->id);
        $update->title = $request->title;
   


        if ($request->file('vthumbnail') != null) {
          $thumb = $request->file('vthumbnail');
          $thumb_url = $this->uploadImage($thumb,'Flag_'.$rand);
          $update->flag = $thumb_url;
        }
        $update->save();

        Session::flash('success','Country Successfully Updated');
            return redirect('/admin/country');
      }
  
      public function uploadcropimages($imgdata, $randn)
      {
              $title_img = $randn.'.jpg';
              $path = ('/img/flag/'.$title_img);
              $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgdata));
              $img1=Image::make($info);
             // $img1->resize(400, 446);
              $img1->save(public_path($path));
              $url = url('img/flag/'.$title_img);
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
          $upload = $f->move(public_path('/img/flag'), $fileName);
            $url = url('img/flag/' . $fileName);
            $path = ('/img/flag/'.$fileName);
  
  
          return $path;
      }
  
     
  
  
      public function changeStatus($status,$id)
      {
        $id=base64_decode($id);
      
          $photo = Countries::find($id);
          $photo->status=$status;
          $photo->save();
  
          Session::flash('success','Status Updated Successfully.');
          return redirect()->back();
  
        }

  
        public function delete($id)
        {
          $id=base64_decode($id);
          $photo = Countries::find($id)->delete();
  
         
          Session::flash('error','Successfully Deleted.');
          return redirect()->back();
        }
}
