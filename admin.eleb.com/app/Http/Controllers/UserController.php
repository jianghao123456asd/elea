<?php

namespace App\Http\Controllers;

use App\Models\Navs;
use App\Models\ShopCategory;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    public function index()
    {
        $rows=Navs::where('pid',0)->get();
        $navs=Navs::where('pid','!=',0)->get();
   $users = User::all();


        return view('users.index', compact('users','rows','navs'));


    }
    public function destroy(User $user){

        $user->delete();
        Shop::destroy($user->shop_id);
        return redirect()->route('users.index')->with('success','删除成功');
    }
    public function edit(User $user){
        $rows=Navs::where('pid',0)->get();
        $navs=Navs::where('pid','!=',0)->get();




        return view('users.edit',compact('user','rows','navs'));

    }
    public function update(User $user,Request $request){
      $user->update([
         'name'=>$request->name,
         'password'=>Hash::make($request->password),
         'email'=>$request->email
      ]);
        return redirect()->route('shops.index')->with('success','修改成功');
    }
    public function password(User $user){
        $rows=Navs::where('pid',0)->get();
        $navs=Navs::where('pid','!=',0)->get();

    return view('users.password',compact('user','rows','navs'));
    }
    public function add(User $user,Request $request){
        $user1=User::find($user->id);
        $user1->password=Hash::make($request->password);
        $user1->save();
        return redirect()->route('users.index')->with('success','修改成功');
    }


}
