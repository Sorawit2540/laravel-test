<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class Frontedpage extends Controller
{
  
    public function catalog(Request $request)
    {
            DB::table('catalog')->insert(
                [
                 'c_name' =>$request->c_name,
                ]);
            $message = "สร้างคลังรูปภาพเรียบร้อย";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<meta http-equiv=\"refresh\"content=\"0;URL=\catalog\">\n";
    }

    public function store(Request $request)
    {
            $file = $request->file('file');
            $picName = $file->getClientOriginalName();
            $mime =$file->getClientMimeType();
            $size =$file->getsize();
            $imagePath = '/storage/images/';
            $file->move(public_path($imagePath), $picName);
            DB::table('photo')->insert(
                [
                 'name' =>$picName,
                 'c_id'=>$request->catalogid,
                 'mime'=>$mime,
                 'size'=>$size,
                ]);
            $message = "อัปโหลดรูปภาพเรียบร้อย";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<meta http-equiv=\"refresh\"content=\"0;URL=\home\">\n";
    }

    public function update(Request $request)
    {
        $file = $request->file('file');
        $picName = $file->getClientOriginalName();
        $imagePath = '/storage/images/';
        $file->move(public_path($imagePath), $picName);
        DB::table('photo')
        ->where('id',$request->photoid)
        ->update(['name' => $picName]);
        $message = "อัปโหลดรูปภาพเรียบร้อย";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<meta http-equiv=\"refresh\"content=\"0;URL=\home\">\n";
       
    }

    public function updatecatalog(Request $request)
    {
        DB::table('photo')
        ->where('id',$request->photoid)
        ->update(['c_id' =>$request->catalogid]);
        $message = "อัปเดตหมวดหมู่เรียบร้อย";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<meta http-equiv=\"refresh\"content=\"0;URL=\home\">\n";
       
    }

    public function updatenamecatalog(Request $request)
    {
        DB::table('catalog')
        ->where('c_id',$request->photoid)
        ->update(['c_name' =>$request->c_name]);
        $message = "อัปเดตชื่อหมวดหมู่เรียบร้อย";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<meta http-equiv=\"refresh\"content=\"0;URL=\catalog\">\n";
       
    }

    public function delete($id)
    {
            DB::table('photo')->where('id',$id)->delete();

            $message = "ลบรูปภาพเรียบร้อย";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<meta http-equiv=\"refresh\"content=\"0;URL=\home\">\n";
    }
    public function deletecatalog($id)
    {
            DB::table('catalog')->where('c_id',$id)->delete();

            $message = "ลบหมวดหมู่คลังรูปภาพเรียบร้อย";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<meta http-equiv=\"refresh\"content=\"0;URL=\catalog\">\n";
    }
}
