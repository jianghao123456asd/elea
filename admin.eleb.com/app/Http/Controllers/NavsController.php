<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use App\Models\Navs;

use Illuminate\Http\Request;

class NavsController extends Controller
{
    //
    public function create(){
        $psa=  Permission::all();

        $rows=Navs::where('pid',0)->get();
        $navs=Navs::where('pid','!=',0)->get();
        $pid=Navs::where('pid',0)->get();
        return view('navs.create',compact('pid','rows','navs','psa'));
    }
    public function store(Request $request){
        $n=new Navs();
        $n->name=$request->name;
        $n->url=$request->url??'';
        $n->permission_id=$request->Permission;
        $n->pid=$request->pid;
        $n->save();
        return redirect()->route('navs.index')->with('success','添加成功');

    }
    public function edit(Navs $nav){
//        $pid=Navs::where('id',$nav->pid)->get();
              $pid= Navs::find($nav->pid);
              $ps=Navs::where('pid',0)->get();
            $psa=  Permission::all();
//              var_dump($ps);exit;
      return  view('navs.edit',compact('nav','pid','ps','psa'));
    }
    public function update(Navs $nav,Request $request){
                    $nav->update([
                        'name'=>$request->name,
                        'pid'=>$request->pid,
                        'url'=>$request->url??'',
                        'permission_id'=>$request->Permission
                    ]);
        return redirect()->route('navs.index')->with('success','修改成功');
    }
    public function index(){
        $rows=Navs::where('pid',0)->get();
        $navs=Navs::where('pid','!=',0)->get();

       $dhs=Navs::all();

       return view('navs.index',compact('dhs','rows','navs'));
        }
    public function destroy(Navs $nav){
//     var_dump($navs);
    $nav->delete();
        return redirect()->route('navs.index')->with('success','删除成功');

    }
    public function layo(){
      $rows=Navs::where('pid',0)->get();
        $navs=Navs::where('pid','!=',0)->get();
        return view('layoutf.nav',compact('rows','navs'));
    }
}
