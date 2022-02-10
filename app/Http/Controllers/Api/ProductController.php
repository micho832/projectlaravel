<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function productDatails(Request $request,$pid){

     $product=Product::where('id',$pid)->with('image')->first();

       if($product){
           $reply = [
               'failed' => false,
               'errors' => null,
               'data' => $product
           ];
           return response()->json($reply);
       }else{
           $reply = [
               'failed' => true,
               'errors' => ['product  not fount'],
               'data' => null,
           ];
           return response()->json($reply);
       }

   }
}
