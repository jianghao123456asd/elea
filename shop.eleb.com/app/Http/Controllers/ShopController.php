<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\shop_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //
    public function index(){
        $shops=Shop::all()->where('id',auth()->user()->shop_id);
//        var_dump($shops);
        return view('shop.index',compact('shops'));
    }
    public function edit(Shop $shop){
        $ShopCategorys=shop_categories::all();
//        var_dump($a);exit;
        return view('shop.edit',compact('shop'),compact('ShopCategorys'));
    }
    public function update(Shop $shop,Request $request){
        $this->validate($request,
            [
                'shop_category_id'=>'required',
                'shop_name'=>'required',

                'shop_rating'=>'required',
                'brand'=>'required',
                'on_time'=>'required',

                'bao'=>'required',
                'piao'=>'required',
                'zhun'=>'required',
                'start_send'=>'required',
                'send_cost'=>'required',
                'notice'=>'required',
                'notice'=>'required',
                'discount'=>'required',



                'captcha' => 'required|captcha',


            ],
            [
                'shop_category_id.required'=>'分类名不能为空',
                'shop_name.required'=>'店铺名称不能为空',
                'shop_img.required' => '请上传店铺头像',
                'shop_rating.required' => '请输入评分',
                'brand.required'=> '请选择品牌',
                'on_time.required'=> '请选择送达时间',
                'fengniao.required'=> '请选择是否疯鸟',
                'bao.required'=> '请选择保标记',
                'piao.required'=> '请选择是否嫖妓',
                'zhun.required'=> '请选择是否准标记',
                'start_send.required'=> '请选择送起送金额',
                'send_cost.required'=> '请选择配送费',
                'notice.required'=> '请填写店铺公告',
                'discount.required'=> '请选择优惠信息  ',


                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'请填写正确验证码',


            ]);
        $img=$request->file('shop_img');

        if ($img){
            $path=$img->store('public/shop');
            $shop->update([
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
                'status'=>1, ]);
            return redirect()->route('shops.index')->with('success','修改成功');
        }else{
            $shop->update([
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

                'status'=>1, ]);
            return redirect()->route('shops.index')->with('success','修改成功');
    }
}}
