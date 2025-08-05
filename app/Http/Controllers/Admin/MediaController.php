<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Medias;
use App\Models\admin\MediaImages;
use Illuminate\Support\Facades\Session;
use Image;
use File;
use Alert;
class MediaController extends Controller
{
    //Index view
    public function index_view()
    {
        // $Images = MediaImages::where('status',1)->get();
        // $uploadDir = 'img/'; // Path to the upload directory
        // $uploadedImages = scandir($uploadDir)
      return view('admin.media.index');
    }

    // images upload
    public function fileStore(Request $request)
    {
        ini_set('memory_limit', '3072M');
        ini_set('max_execution_time', 10080);
        ini_set('upload_max_filesize', '20M');
        $rnd = rand();
        $extension = $request->file->getClientOriginalExtension();
        if($extension == "mp4" || $extension == "webm" || $extension == "ogg" || $extension == "avi" || $extension == "mov" || $extension == "mkv"){
            $file = $request->file('file');
            $title_img = 'blog'.'_'.$rnd.'.'.$extension;
$path = public_path('img/blog/');
            $pathname = '/img/blog/'.$title_img;
            $file->move($path, $title_img);
        }else{
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();       
            $img1=Image::make($image);
            $title_img = 'media'.'_'.$rnd.'.'.$imageName;
            $path = public_path('img/blog/');
            $pathname = '/img/blog/'.$title_img;
            $img1->save(public_path('img/blog/'.$title_img));
        }

        $obj = new MediaImages();
        $obj->status = 1;
        $obj->urls = $pathname;
        $obj->thumbnails = $pathname;
        $obj->save();
        toast('Images Upload Successfully!!!','success');
        return response()->json(['success'=>$title_img]);
    }

    public function editStore(Request $request){
        $mediaid = $request->moduleid;
        $inputTitle = $request->inputTitle;
        $inputUrl = $request->inputUrl;
        $inputAlt = $request->inputAlt;
        $inputDescription = $request->inputDescription;
        MediaImages::where('id',$mediaid)->update(['title' => $inputTitle,'urls' => $inputUrl,'alt' => $inputAlt,'description' =>$inputDescription]);
        return redirect()->back();
    }

    public function deleteMediaPhoto(Request $request){
        $mediaid = (int) $request->moduleid;
        $Image_path = public_path('img/'.$request->inputUrl);
        $res=MediaImages::where('id',$mediaid)->delete();
        if(File::exists($Image_path)) {
            File::delete($Image_path);
            return true;
        }else{
            return false;
        }
    }

    public function uploadImage($f, $randn)
    {
        $file = $f;
        // print_r($file); exit;
        $mime = $file->getClientMimeType();
        $ext = $file->getClientOriginalExtension();
        $fileName = $randn . "." . $ext;
        $upload = $f->move(public_path('/img/media'), $fileName);
        $url = url('img/media/' . $fileName);
        $path = ('/img/media/'.$fileName);
        return $path;
    }
}
