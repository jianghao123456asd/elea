<?php

namespace App\Http\Controllers;


use App\Models\Navs;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
class PermissionController extends Controller
{
    //
    public function create(){
        return view('permissions.add');

    }
    public function index(){
        $rows=Navs::where('pid',0)->get();
        $navs=Navs   ::where('pid','!=',0)->get();
          $ps=Permission::all();
        return view('permissions.index',compact('ps','rows','navs'));
    }
    public function store(Request $request){
        $this->validate($request,
            [
                'name'=>'required|unique:roles,name'
            ],[
                'name.required'=>'权限名称必填',
                'name.unique'=>'权限已存在',
            ]);
        $name=$request->name;
       $p=new Permission();
       $p->name=$request->name;
       $p->save();
        return redirect()->route('permissions.index')->with('success','添加成功');
    }
    public function edit(Permission $permission,Request $request){
        return view('permissions.edit',compact('permission'));
    }
    public function update(Permission $permission,Request $request){
        $this->validate($request,
            [
                'name'=>'required|unique:roles,name'
            ],[
                'name.required'=>'权限名称必填',
                'name.unique'=>'权限已存在',
            ]);
         $p=Permission::find($permission->id);
         $p->name=$request->name;
         $p->save();
        return redirect()->route('permissions.index')->with('success','修改成功');
    }
    public function destroy(Permission $permission){
        $permission->delete();
        return redirect()->route('permissions.index')->with('success','修改成功');
    }
}
