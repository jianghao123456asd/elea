<?php

namespace App\Http\Controllers;

use App\Models\Navs;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    //
    public function index(){
        $rows=Navs::where('pid',0)->get();
        $navs=Navs::where('pid','!=',0)->get();
        $rs=Role::all();
        return view('roles.index',compact('rs','rows','navs'));
    }
    public function create(){

     $ps=Permission::all();
     return view('roles.add',compact('ps'));
    }
    public function store(Request $request){
        $this->validate($request,
            [
                'name'=>'required|unique:roles,name'
            ],[
                'name.required'=>'角色名称必填',
                'name.unique'=>'账号已存在',
            ]);
//        dd($request);
         $role=new \Spatie\Permission\Models\Role();
        $role->name=$request->name;
        $role->save();
//       dd($request->PermissioMn);
        $role->syncPermissions($request->Permission);
        return redirect()->route('roles.index')->with('success','添加成功');
    }
    public function edit(Role $role){
        $ps=Permission::all();
      return  view('roles.edit',compact('ps','role'));
    }
    public function update(Role $role,Request $request){
//        $this->validate($request,
//            [
//                'name'=>'required|unique:roles,name'
//            ],[
//                'name.required'=>'角色名称必填',
//                'name.unique'=>'账号已存在',
//            ]);
              $role=Role::find($role->id);
            $role->name=$request->name;
            $role->save();
            $role->syncPermissions($request->Permission);
        return redirect()->route('roles.index')->with('success','修改成功');
    }
    public function destroy(Role $role){
        $role->delete();
        return redirect()->route('roles.index')->with('success','添加成功');
    }
}
