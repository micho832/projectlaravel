<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{


     public function getContactView(){

          return view('contact-us');
     }

     public function saveFeedback(Request $request)
     {
         $rules=[
             'name'=>'required|max:60|min:3',
             'phone'=>'max:25|required',
             'email'=>'required|email|max:125',
             'feedback'=>'required|max:1000'
         ];
             $date=$request->all();
             $validator=Validator::make($date,$rules);
             if($validator->fails()){
                 return redirect('/contact-us')->withInput($date)->withErrors($validator->errors());
             }
             $element=new Feedback();
             $element->name=$date["name"];
             $element->email=$date["email"];
             $element->phone=$date["phone"];
             $element->feedback=$date["feedback"];
             $element->save();

             return redirect('/contact-us')->with(["success"=>"Add feedback success"]);




     }

}
