<?php

namespace App\Http\Controllers;

use App\Models\Navs;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //
    public function index(){
         $shops=Shop::all();
        $rows=Navs::where('pid',0)->get();
        $navs=Navs::where('pid','!=',0)->get();
         return view('shop.index',compact('shops','rows','navs'));
    }
    public function create(){
        $rows=Navs::where('pid',0)->get();
        $navs=Navs::where('pid','!=',0)->get();
      $ShopCategorys=  ShopCategory::all();
          return view('shop.add',compact('ShopCategorys','rows','navs'));
    }
    public function store(Request $request){


        $this->validate($request,
            ['name'=>'required',
                'shop_category_id'=>'required',
                'shop_name'=>'required',
                'shop_img'=>'required',
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
               'name'=>'required',
                'email'=>'required',
                'password'=>'required',


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
                'name.required'=> '请填写用户名',
                'email.required'=> '请填写邮箱',
                'password.required'=> '请填写密码',

                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'请填写正确验证码',


            ]);




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
            'shop_img'=>$request->img,
            'status'=>1,
        ]);
                 $user= new User();
                 $user->name=$request->name;
                 $user->email=$request->email;
                 $user->password=Hash::make($request->password);
                 $user->shop_id=$shop->id;
                 $user->status=1;
     $user->save();

        return redirect()->route('shops.index')->with('success','添加成功');
    }
    public function destroy(Shop $shop){

        $shop->delete();
        return redirect()->route('shops.index')->with('success','删除成功');

    }
    public function edit(Shop $shop){
        $rows=Navs::where('pid',0)->get();
        $navs=Navs::where('pid','!=',0)->get();
       $ShopCategorys= ShopCategory::all();
       return view('shop.edit',compact('shop','rows','navs'),compact('ShopCategorys'));
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
        $img=$request->shop_img;

        if ($img){

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
                'shop_img'=>$request->shop_img,
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



    }
    public function status(){
        $rows=Navs::where('pid',0)->get();
        $navs=Navs   ::where('pid','!=',0)->get();

        $shops = Db::select('select * from shops where status = ?', [0]);
             return view('shop.status',compact('shops','rows','navs'));

    }
    public function statusa($id){

     $shop= Shop::find($id);
        $shop->status=1;
       $shop->save();
        $title = '饱了吗';
        $content = '<p>	
重要的邮件如何才能让<span style="color: red">对方立刻查看</span>！
你的核申已经通过了</p>';
        try{
            \Illuminate\Support\Facades\Mail::send('shop.youjian',compact('title','content'),
                function($message){
                    $to = '15928830307@163.com';
                    $message->from(env('MAIL_USERNAME'))->to($to)->subject('阿里云数据库10月刊:Redis2发布');
                });
        }catch (Exception $e){
            return '邮件发送失败';
//
    }
        return redirect()->route('shop.status')->with('success','核审通过成功');
    }
    public function del($id){
        Shop::destroy($id);
        return redirect()->route('shop.status')->with('success','核审失败成功并删除该核审记录');
    }
}
