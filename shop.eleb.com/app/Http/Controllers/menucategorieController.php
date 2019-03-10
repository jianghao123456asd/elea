<?php

namespace App\Http\Controllers;

use App\Models\menu;
use App\Models\menu_categorie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Psy\Command\ListCommand\MethodEnumerator;

class menucategorieController extends Controller
{
    //
       public function __construct()
       {
           $this->middleware('auth');
       }

    public function index(){

        /*$= menu_categorie::find(auth()->user()->id);*/
        $clas=menu_categorie::all()->where('shop_id',auth()->user()->shop_id);
        $menuclas= DB::select('select * from menu_categories where shop_id = ?', [auth()->user()->shop_id]);
      //var_dump($menuclas);exit;
     return view('menu.index',compact('menuclas'),compact('clas'));

    }
    public function create(){
        return view('menu.add');
    }
    public function store(Request $request){

       /* $this->validate($request,  [

            'captcha' => 'required|captcha',
            'name'=>'required',
            'description'=>'required',
            'is_selected'=>'required',
            'type_accumulation'=>'required',


        ],
            [
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'请输入正确的验证码',
                'name.required'=>'请输入分类名',
                'description.required'=>'请填写分类描述',
                'is_selected.required'=>'请填是否默认分类',
                'type_accumulation.required'=>'请填写商品编号',
            ]);*/
        $str = str_shuffle('qwertyuiopasdfghjklzxcvbnm');
        $code = substr($str, 0, 4);
     if ($request->is_selected==1){
            menu_categorie::where('is_selected','=','1')->where('shop_id','=',auth()->user()->shop_id)
                ->update(['is_selected'=>0]);
          //DB::update('update  menu_categories  set is_selected=0 where is_selected=1 and  shop_id = ?', [auth()->user()->id]);
        menu_categorie::create([
            'name'=>$request->name,
            'type_accumulation'=>$code,
            'status'=>$request->status,
            'shop_id'=>auth()->user()->shop_id,
            'description'=>$request->description,
            'is_selected'=>$request->is_selected
        ]);
     }else{
         menu_categorie::create([
             'name'=>$request->name,
             'type_accumulation'=>$code,
             'status'=>$request->status,
             'shop_id'=>auth()->user()->shop_id,
             'description'=>$request->description,
             'is_selected'=>$request->is_selected]);
     }
        return redirect()->route('menucategories.index')->with('info','添加成功');


     /*   $menuclass=new menucategorie();
        $menuclass->name=$request->name;
        $menuclass->type_accumulation=$request->type_accumulation;
        $menuclass->shop_id=auth()->user()->id;
        $menuclass->description=$request->description;
        $meunuclass->is_selected=$request->is_selected;*/
    }
    public function destroy($id){
    //  $menuclas= DB::select('select * from menus where  category_id = ?', [$id] and 'category_id'=[auth()->user()] );
        $a=menu::all()->where('shop_id',auth()->user()->shop_id)->where('category_id',$id);
        $b=count($a);

         if ($b){
             return redirect()->route('menucategories.index')->with('danger','菜品列表有该分类删除失败');
         }else{
             menu_categorie::destroy($id);
             return redirect()->route('menucategories.index')->with('info','删除成功');


     }
     //$menus=menu::all()->where('shop_id',auth()->user()->id);

        /*var_dump($id);
        ;*/
    }
    public function edit($id){
       $menucla= menu_categorie::find($id);
 return view('menu.edit',compact('menucla'));
    }
    public function update($id,Request $request){
        $this->validate($request,  [

            'captcha' => 'required|captcha',
            'name'=>'required',
            'description'=>'required',
            'is_selected'=>'required',
            'type_accumulation'=>'required',


        ],
            [
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'请输入正确的验证码',
                'name.required'=>'请输入分类名',
                'description.required'=>'请填写分类描述',
                'is_selected.required'=>'请填是否默认分类',
                'type_accumulation.required'=>'请填写商品编号',
            ]);
        $menucla=menu_categorie::find($id);
     $menucla->name=$request->name;
     $menucla->is_selected=$request->is_selected;
     $menucla->description=$request->description;
     $menucla->type_accumulation=$request->type_accumulation;
     $menucla->save();
        return redirect()->route('menucategories.index')->with('info','修改成功');
    }

}
