<?php

namespace App\Http\Controllers;

use App\Models\Admin;

use App\Models\Navs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //
    public function index(){
        $rows=Navs::where('pid',0)->get();
        $navs=Navs::where('pid','!=',0)->get();
    $admins=Admin::all();
    return view('admin.index',compact('admins','rows','navs'));
    }
    public function create(){
        $roles=Role::all();
      return view('admin.add',compact('roles'));
    }

    public function store(Request $request){

      $admin=new Admin();
      $admin->password=Hash::make($request->password);
      $admin->name=$request->name;
      $admin->email=$request->email;
      $admin->save();
      $admin->syncRoles($request->syncRoles);



        return redirect()->route('admins.index')->with('success','管理员添加成功');
    }
    public function edit(Admin $admin){
       $rs= Role::all();
        return view('admin.edit',compact('admin','rs'));

    }
    public function destroy(Admin $admin){
        $admin->delete();
        return redirect()->route('admins.index')->with('success','删除成功');
    }
    public function update(Admin $admin,Request $request){

        $admin->update([
            'name'=>$request->name,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
        ]);
        $admin->syncRoles($request->syncRoles);

        return redirect()->route('admins.index')->with('success','修改成功');
    }
    public function password(){
        $Admin= Admin::find(auth()->user()->id);
       return view('admin.password',compact('Admin'));
    }
    public function save(Admin $admin,Request $request){

         $this->validate($request,  [

              'captcha' => 'required|captcha',
             'jiu' => 'required',

             'password'=>'required|min:6|confirmed',
             'password_confirmation' => 'required|min:6'
          ],
              [
                  'captcha.required'=>'验证码不能为空',
                  'captcha.captcha'=>'请输入正确的验证码',
                  'jiu.required'=>'旧密码能为空',
                  'password.required'=>'请输入新密码',
                  'password.confirmed'=>'两次密码不一致'
              ]);
        $jiu=$request->jiu;
        var_dump($jiu);
        if (Hash::check($jiu,auth()->user()->password)) {
            $admin->update([
                'password'=>Hash::make($request->password)
            ]);
            return redirect()->route('admins.index')->with('success','修改成功');
        }else{  return back()->with('info','旧不正确');
        }

    }

}
