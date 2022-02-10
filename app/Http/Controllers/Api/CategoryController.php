<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function index(Request $request){
      $categories=Category::with('image')->get();

      $reply = [
          'failed' => false,
          'errors' => null,
          'data' => $categories,
      ];
      return response()->json($reply);
  }


  public function getCatProduct(Request $request,$cid){

        $category=Category::find($cid); //9
        if($category){
            $reply = [
                'failed' => false,
                'errors' => null,
                'data' => $category->products()->with('image')->get(),
            ];
            return response()->json($reply);
        }else{
            $reply = [
                'failed' => true,
                'errors' => ['Category not fount'],
                'data' => null,
            ];
            return response()->json($reply);
        }

  }
}
