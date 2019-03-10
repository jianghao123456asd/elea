<?php

namespace App\Http\Controllers;

use App\Models\ShopCategory;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function create(){
   $ShopCategorys=ShopCategory::all();
       return view('user.add',compact('ShopCategorys'));

    }
    public function store(Request $request){
        $img=$request->file('shop_img');
        $path=$img->store('public/shop');
        $shop=Shop::create([
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->input('shop_name'),
            'shop_rating'=>$request->input('shop_rating'),
            'brand'=>$request->input('brand'),
            'on_time'=>$request->input('on_time'),
            'fengniao'=>$request->input('fengniao'),
            'bao'=>$request->input('bao'),
            'piao'=>$request->input('piao'),
            'zhun'=>$request->input('zhun'),
            'start_send'=>$request->input('start_send'),
            'send_cost'=>$request->input('send_cost'),
            'notice'=>$request->input('notice'),
            'discount'=>$request->input('discount'),
            'shop_img'=>url(Storage::url($path)),
            'status'=>1,
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->passowrd),
            'shop_id'=>$shop->id,
            'status'=>1
        ]);
    }

}
