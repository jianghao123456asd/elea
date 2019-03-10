<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
  return view('login.index');
    }
    public function store(Request $request){

        if(Auth::attempt([
            'name'=>$request->name,
            'passwor'=>$request->password
        ],$request->has('rememberMe'))){//账号密码正确 ，创建会话（保存当前用户的信息到session）
     echo 'ok';
        }else{//账号密码不正确
            return back()->with('danger','账号密码不正确');
        }
    }
}
