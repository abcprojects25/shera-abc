<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Catalogues;
use File;
use Image;
use Alert;

class CatalogueController extends Controller
{
    //index
    public function Index(){
       $Catalogues = Catalogues::orderby('id','desc')->get();
       return view('admin.support.listing',compact('Catalogues'));
    }

    public function catalogue_add(){
        return view('admin.support.add');
    }

    public function catalogue_edit($id){
        $id = base64_decode($id);
        $EditData = Catalogues::where('id',$id)->first();
        return view('admin.support.edit',compact('EditData'));
    }
    

    public function catalogueStore(Request $request){
        ini_set('memory_limit', '3072M');
        ini_set('max_execution_time', 10080);
        ini_set('upload_max_filesize', '20M');
    
        $request->validate([
            'catalogue_pdf' => 'required|mimes:pdf'
         ]);
         $rand = rand(11111,99999);

         //upload pdf        
        $fileName = 'Catalogue_PDF'.'_'.$rand;
        $PDFile = $request->file('catalogue_pdf');
        $pdf_url = $this->uploadImage($PDFile,$fileName);
    
         // Upload thumnail file
        if($request->thumnail != null){
            $thumnail = $this->uploadcropimages($request->thumnail, 'catalogue_'.$rand);
        }else{
            $thumnail = $request->thumnail;
        }

        $obj = new Catalogues();
        $obj->title = $request->catalogue_title;
        $obj->thumnail = $thumnail;
        $obj->pdf = $pdf_url;
        $obj->description = $request->catalogue_desc;      
        $obj->status = 1;
        $obj->save();
       toast('Catalogue Inserted Successfully!!!','success');
      return redirect('/admin/support/catalogues');
    }

    public function catalogueUpdate(Request $request){
        ini_set('memory_limit', '3072M');
        ini_set('max_execution_time', 10080);
        ini_set('upload_max_filesize', '20M');
    
        if($request->catalogue_pdf != null){
            $request->validate([
                'catalogue_pdf' => 'required|mimes:pdf'
             ]);
        }
        $rand = rand(11111,99999);
        //Delete Existing PDF if  
        $PDF_Path = public_path().'/img/catalogue/PDF/'.$request->edit_pdf;
        if(File::exists($PDF_Path) && $request->catalogue_pdf != null) {
            File::delete($PDF_Path);
        }
         //Delete Existing File if    
        $Image_path = public_path().$request->edit_thumnail;
        if(File::exists($Image_path) && $request->thumnail != null) {
        File::delete($Image_path);
        }

        //upload pdf   
        if($request->catalogue_pdf != null){
            $fileName = 'Catalogue_PDF'.'_'.$rand;
            $PDFile = $request->file('catalogue_pdf');
            $pdf_url = $this->uploadImage($PDFile,$fileName);
        }else{
            $pdf_url = $request->edit_pdf;
        }

        // Upload thumnail file
         if($request->thumnail != null){
            $thumnail = $this->uploadcropimages($request->thumnail, 'catalogue_'.$rand);
        }else{
            $thumnail = $request->edit_thumnail;
        }

        $obj = Catalogues::find($request->edit_id);
        $obj->title = $request->catalogue_title;
        $obj->thumnail = $thumnail;
        $obj->pdf = $pdf_url;
        $obj->description = $request->catalogue_desc;      
        $obj->status = 1;
        $obj->save();
       toast('Catalogue Updated Successfully!!!','success');
       return redirect('/admin/support/catalogues');
    }

    public function catalogueDelete($id){
        $delete_id=base64_decode($id);
        Catalogues::where('id',$delete_id)->delete();
        toast('Catalogue Deleted Successfully!!!','success');
        return redirect()->back();
    }

    public function catalogueStatus($status,$id){
        $id=base64_decode($id);
        $status = base64_decode($status);
        if($status == 0){
         Catalogues::where('id',$id)->update(['status' => 1]);
        }else{
         Catalogues::where('id',$id)->update(['status' => 0]);
        }
        toast('Status Updated Successfully!!!','success');
        return redirect()->back();
    }


    public function uploadcropimages($imgdata, $randn)
    {
            $title_img = $randn.'.jpg';
            $path = ('/img/catalogue/'.$title_img);
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgdata));
            $img1=Image::make($info);
           // $img1->resize(400, 446);
            $img1->save(public_path($path));
            $url = url('img/catalogue/'.$title_img);
            return $path;
    }

    public function uploadImage($f, $randn)
    {
      ini_set('memory_limit', '3072M');
      ini_set('max_execution_time', 10080);
      ini_set('upload_max_filesize', '20M');
  
        $file = $f;
      //  print_r($file); exit;
        $mime = $file->getClientMimeType();
        $ext = $file->getClientOriginalExtension();
        $fileName = $randn . "." . $ext;
        $upload = $f->move(public_path('/img/catalogue/PDF'), $fileName);
          $url = url('img/catalogue/PDF/' . $fileName);
          $path = ('/img/catalogue/PDF/'.$fileName);
        return $fileName;
    }

}
