<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
   public function index(){

       $lastOrder=Order::where('is_checked_out',false)->where('user_id',Auth::user()->id)
           ->orderBy('created_at','DESC')->first();
       return view('shopping-cart',[
           'lastOrderDetails'=>$lastOrder ? $lastOrder->orderDetails : [],
       ]);
   }

    public function deleteItemFromCart(Request $request)
    {
        if (!\Auth::check()) {
            return redirect('/login');
        }

        $rules = ['product' => 'required'];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('/shopping-cart');
        }

        $productID = $request->get('product');
        $product = Product::find($productID);
        if (!$product) {
            return redirect('/shopping-cart');
        }

        $lastOrder = Order::where('is_checked_out', '=', false)
            ->where('user_id', '=', \Auth::user()->id)
            ->orderBy('created_at', 'DESC')->first();

        if ($lastOrder) {
            $productInOrder = OrderDetail::where('product_id', '=', $productID)
                ->where('order_id', '=', $lastOrder->id)->first();

            if ($productInOrder) {
                $productInOrder->delete();
                return redirect('/shopping-cart')
                    ->with(['success' => 'Item is removed from your cart successfully!']);
            } else {
                return redirect('/shopping-cart');
            }
        } else {
            return redirect('/shopping-cart');
        }
    }

    public function deleteCart(){
        if (!\Auth::check()) {
            return redirect('/login');
        }
        $lastOrder = Order::where('is_checked_out', '=', false)
            ->where('user_id', '=', \Auth::user()->id)
            ->orderBy('created_at', 'DESC')->first();

        if ($lastOrder) {
            $products = OrderDetail::where('order_id', '=', $lastOrder->id)->get();
            foreach ($products as $product){
                $product->delete();
            }
            $lastOrder->delete();
            return redirect('/shopping-cart')
                ->with(['success' => 'Item is removed from your cart successfully!']);
        }else{
            return redirect('/shopping-cart');
        }
    }
}
