<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
   return view('login.index');
    }
    public function store(Request $request){

        $this->validate($request,  [
            'name'=>'required',
            'password'=>'required',
            'captcha' => 'required|captcha',

        ],
            [
                'name.required'=>'商户名名不能为空',
                'password.required'=>'请输入密码',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'请输入正确的验证码'
            ]);
        if(Auth::attempt([
            'name'=>$request->name,
           'password'=>$request->password,

        ])){

              return redirect()->intended(route('user.if'));
        }else{//账号密码不正确
            return back()->with('danger','账号密码不正确');
        }





    }
    public function destroy(){
        Auth::logout();
        return redirect()->route('login')->with('success','您已安全退出');
    }
}
