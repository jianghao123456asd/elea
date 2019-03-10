<?php

namespace App\Http\Controllers;

use App\Models\menu_categorie;
use App\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Shop;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function if(){

      if (auth()->user()->status==0){
            Auth::logout();//注销登录
            return redirect()->route('login')->with('danger','你账号有问题');
            }else{
            return redirect()->route('users.index');
        }

    }

    public function index(){


        $clas=menu_categorie::all()->where('shop_id',auth()->user()->id);
     $user= User::find(auth()->user()->id);


    return view('user.index',compact('user'),compact('clas'));
    }
    public function create(){
        $ShopCategorys=ShopCategory::all();
        return view('user.user',compact('ShopCategorys'));

    }
    public function store(
        Request $request){

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



            ]);

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

            'status'=>0 ,
        ]);
     /*  User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->passowrd),
            'shop_id'=>$shop->id,
            'status'=>0
        ]);*/
        $user=new User();
        $user->name=$request->input('name');
        $user->password=Hash::make($request->input('password'));
        $user->email=$request->input('email');
        $user->shop_id=$shop->id;
        $user->status=1;
        $user->save();
    }
    public function password(){

        $user= User::find(auth()->user()->id);
        return view('user.password',compact('user'));
    }
    public function save(User $user,Request $request){


    $this->validate($request,  [

            'captcha' => 'required|captcha',
             'jiu'=>'required',
        'password'=>'required|min:6|confirmed',
        'password_confirmation' => 'required|min:6'
        ],
            [
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'请输入正确的验证码',
                'jiu.required'=>'请输入旧密码',
                'password.required'=>'请输入新密码'
            ]);
        $jiu=$request->jiu;
        var_dump($jiu);
        if (Hash::check($jiu,auth()->user()->password)) {
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
        }else{echo  '旧密码错误';
        }
    }

}
