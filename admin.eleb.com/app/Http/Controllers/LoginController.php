<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
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
                    'name.required'=>'用户名名不能为空',
                    'password.required'=>'请输入密码',
                    'captcha.required'=>'验证码不能为空',
                    'captcha.captcha'=>'请输入正确的验证码'
                ]);
        if(Auth::attempt([
            'name'=>$request->name,
            'password'=>$request->password
        ],$request->has('rememberMe'))){//账号密码正确 ，创建会话（保存当前用户的信息到session）
            return redirect()->intended(route('admins.index'))->with('success','登录成功');
        }else{//账号密码不正确
            return back()->with('danger','账号密码不正确');
        }
        }
        public function destroy(){
        Auth::logout();
            return redirect()->route('login')->with('success','您已安全退出');
        }


}
