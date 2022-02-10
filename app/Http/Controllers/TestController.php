<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
   public function getUploadView(){
       return view('tests.upload-file');
   }

   public function doUpload(Request $request){
       $rules=[
           'file'=>'required|image|max:2048|mimes:jpg,png,jpeg'
       ];
       $validator=Validator::make($request->all(),$rules);
       if($validator->fails()){
           return redirect('/tests/upload-file')->withErrors($validator->errors());
       }
       $file=$request->file('file');
       $ext=$file->getClientOriginalExtension();
       $newName=sha1(time()) . "." .$ext;
       Storage::disk('public')->put($newName,File::get($file));
   }
}
