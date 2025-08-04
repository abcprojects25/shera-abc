<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Brands;
use App\Models\Brandimages;
use App\Models\Brandpdfs;
use App\Models\Countries;
use Response;
use File;
use Image;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public function __construct()
  {
      $this->middleware('auth');
  }

 
    public function index_view()
    {
   
      $data = Brands::orderBy('id','desc')->get();
      return view('admin.brands.listing',compact('data'));
    }

    public function edit($id)
    {
      $id=base64_decode($id);
      $data = Brands::where('id',$id)->first();
      //print_r($data);
      //exit;
      $countries = Countries::where('status',1)->orderBy('id','asc')->get();
      return view('admin.brands.edit_brand',compact('data','countries'));
    }

    public function add_view()
    {
      $countries = Countries::where('status',1)->orderBy('id','asc')->get();
      return view('admin.brands.add_brand',compact('countries'));
    }

    public function p_data()
    {
      $id= $_GET['id'];
      $data = Brands::where('id',$id)->first();
      $datas = '<div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">'.$data->title.'</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div><div class="modal-body partner_listing"><div class="row"><div class="col-lg-3 col-md-3"><img src="'.$data->image.'" class="img-fluid d-block"></div><div class="col-lg-7 col-md-6 text-content-block wow light wow fadeIn animated" style="visibility: visible;"><h6> '.$data->title.' </h6><p> '.$data->description.' </p> <div class="d-flex"><div class="">  <h1> '.$data->list_title1.' </h1> '.$data->list_data1.' </div><div class="">  <h1> '.$data->list_title2.' </h1> '.$data->list_data2.' </div> </div></div> <div class="col-lg-2 col-md-3"> <a data-fancybox href="'.$data->video.'"><img src="/img/play.png" class="img-fluid play_icon"><img src="'.$data->thumbnail.'" class="img-fluid d-block"> </a></div></div></div> </div>';

      return $datas;
    }
  
    public function index(Request $request)
      {
  
          //    print_r($_POST);
          //	exit; 
  
          $thumb = $request->file('vthumbnail');
          $images = $request->file('images');
          $rand = mt_rand("0000000", "9999999");
          $thumb_url = $this->uploadImage($thumb,'brand_'.$rand);
          
          $rightimage = $request->file('rightimage');
          $rightimage_url = $this->uploadImage($rightimage,'right_'.$rand);

          $seourl = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title));


          $obj = new Brands;
          $obj->title = $request->title;
          $obj->seourl = $seourl;
          $obj->country_id = $request->country;
          $obj->brand_logo = $thumb_url;
          $obj->right_image = $rightimage_url;
          $obj->description = $request->description;
          $obj->structure_type = $request->structure;
          $obj->status = $request->is_active;

          if ($request->file('Brochure') != null) {
            $bpdf = $request->file('Brochure');
            $pdf_url = $this->uploadImage($bpdf,'Brochure_'.$rand);
            $obj->Brochure = $pdf_url;
          }

          $obj->save();

          if($request->structure == 1) {$k=0;}
          if($request->structure == 2) {$k=7;}
          if ($request->file('images') != null) {
            $id=$obj->id;
            $i=$k;
            for($i; $i<count($images)+$k; $i++){
             // print_r(count($images));
            //  print_r($images[$k]);
             // exit;
             $gall_img = $this->uploadImage($images[$i],'gall_'.$rand."_".$i);

              $img =new Brandimages;
              $img->brands_id = $id;
              $img->image = $gall_img;
              $img->save();
            }   
          }
            Session::flash('success','Brands Successfully added');
            return redirect('/admin/brands');
         
         
      }

      public function update(Request $request)
      {
        $rand = mt_rand("0000000", "9999999");
        $seourl = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title));

        $update = Brands::find($request->id);
        $update->title = $request->title;
        $update->seourl = $seourl;
        $update->country_id = $request->country;
        $update->description = $request->description;
        if ($request->file('vthumbnail') != null) {
          $thumb = $request->file('vthumbnail');
          $thumb_url = $this->uploadImage($thumb,'brand_'.$rand);
          $update->brand_logo = $thumb_url;
        }

        if ($request->file('rightimage') != null) {
          $rightimage = $request->file('rightimage');
          $rightimage_url = $this->uploadImage($rightimage,'right_'.$rand);
          $update->right_image = $rightimage_url;
        }
        $update->save();

        Session::flash('success','Brands Successfully Updated');
            return redirect('/admin/brands');
      }


      public function add_brouchers(Request $request)
      {
        $rand = mt_rand("0000000", "9999999");

        if ($request->file('Brochure_images') != null) {
          $thumb1 = $request->file('Brochure_images');
          $thumb_url = $this->uploadImage($thumb1,'BBrochure_'.$rand);
          
        }

        if ($request->file('Brochure') != null) {
          $bpdf1 = $request->file('Brochure');
          $pdf_url = $this->uploadImage($bpdf1,'BBrochure_'.$rand);
          
        }

        $bro =new Brandpdfs;
        $bro->brands_id = $request->id;
        $bro->title = $request->title;
        $bro->pdf = $pdf_url;
        $bro->thumbnails = $thumb_url;
        $bro->save();

        Session::flash('success','Brochure Added Successfully!!!');
        return redirect('/admin/brands');

      }

    public function view_images($structure, $id, $title)
    {
      $id = base64_decode($id);
      $images = Brandimages::where('status',1)->where('brands_id',$id)->orderBy('id','asc')->get();
      $total_count = count($images);
      return view('admin.brands.view_images',compact('images','title','structure', 'total_count'));
    }  
  
      public function uploadcropimages($imgdata, $randn)
      {
              $title_img = $randn.'.jpg';
              $path = ('/img/brands_upload/'.$title_img);
              $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgdata));
              $img1=Image::make($info);
             // $img1->resize(400, 446);
              $img1->save(public_path($path));
              $url = url('img/brands_upload/'.$title_img);
              return $path;
              //$seourl = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-',$request->title));
      }

      
      public function uploadImage($f, $randn)
      {
        ini_set('memory_limit', '3072M');
		 ini_set('max_execution_time', 10080);
         ini_set('upload_max_filesize', '10M');

          $file = $f;
        //  print_r($file); exit;
          $mime = $file->getClientMimeType();
          $ext = $file->getClientOriginalExtension();
          $fileName = $randn . "." . $ext;
          $upload = $f->move(public_path('/img/brands_upload'), $fileName);
            $url = url('img/brands_upload/' . $fileName);
            $path = ('/img/brands_upload/'.$fileName);
  
  
          return $path;
      }


      public function changeStatus($status,$id)
      {
        $id=base64_decode($id);
       
          $photo = Brands::find($id);
          $photo->status= $status;
          $photo->save();
  
          Session::flash('success','Status Updated Successfully.');
          return redirect()->back();
      }
  
        public function delete($id)
        {
          $id=base64_decode($id);
          $photo = Brands::find($id)->delete();
  
         
          Session::flash('error','Successfully Deleted.');
          return redirect()->back();
        }
}
