<?php

namespace App\Http\Controllers;
use App\Models\menu;
use App\Models\menu_categorie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){

        $price1=$request->price1;
        $price2=$request->price2;

        $keyword=$request->keyword;
        //var_dump($keyword)

        $wheres = [];
        if($keyword) $wheres[]=['goods_name','like',"%$keyword%"];
        if($price1) $wheres[] = ['goods_price','>=',$price1];
        if($price2) $wheres[] = ['goods_price','<=',$price2];
       $rows=menu::where($wheres)->where('shop_id',auth()->user()->shop_id)->get();
        $clas=menu_categorie::all()->where('shop_id',auth()->user()->shop_id);
        return view('menu1.index',compact('rows','clas'));


    }
    public function create(){
        //$as= DB::select('select * from menu_categories where shop_id = ?',[auth()->user()->id]);
         /*$as=menu_categorie::find(auth()->user()->id);*/
   //var_dump($menuclas);exit;
    $as=menu_categorie::all()->where('shop_id',auth()->user()->shop_id);

        return view('menu1.add',compact('as'));
    }
    public function store(Request $request){
        $this->validate($request,
            [
                'goods_name'=>'required',
                'category_id'=>'required',
                'description'=>'required',
                'goods_price'=>'required',
                'description'=>'required',
                'month_sales'=>'required',
                'rating_count'=>'required',
                'tips'=>'required',
                'satisfy_count'=>'required',
                'satisfy_rate'=>'required',
                'goods_img'=>'required|image',
                'status'=>'required',
            ],
            [
                'goods_name.required'=>'请输入菜品名称',
                'rating.required'=>'请输入评分',
                'category_id.required'=>'请选择分类',
                'goods_price.required'=>'请输入价格',
                'description.required'=>'请输入描述',
                'month_sales.required'=>'请输入月销量',
                'rating_count.required'=>'请输入评分数',
                'tips.required'=>'请输入提示',
                'satisfy_count.required'=>'请输入满意度数量',
                'satisfy_rate.required'=>'请输入满意度评分',
                'status.required'=>'请选择状态',
                'goods_img.required'=>'请上传图片',
                'goods_img.image'=>'图片格式有误',
            ]);


        $img=$request->file('goods_img');

        $path=$img->store('public/shop');
               $menus=new menu();
               $menus->goods_name=$request->goods_name;
               $menus->rating=$request->rating;
               $menus->shop_id=auth()->user()->shop_id;
               $menus->category_id=$request->category_id;
               $menus->goods_price=$request->goods_price;
               $menus->description=$request->description;
               $menus->month_sales=$request->month_sales;
               $menus->rating_count=$request->rating_count;
               $menus->tips=$request->tips;
               $menus->satisfy_count=$request->satisfy_count;
               $menus->satisfy_rate=$request->satisfy_rate;
               $menus->status=$request->status;
               $menus->goods_img=url(Storage::url($path));
               $menus->save();
        return redirect()->route('menus.index')->with('info','成功添加');
    }
               public function show($id){

                   $clas=menu_categorie::all()->where('shop_id',auth()->user()->shop_id);

                $rows= menu::all()->where('shop_id',auth()->user()->shop_id)->where('category_id',$id);

              return view('menu1.show',compact('rows'),compact('clas'));
               }
               public function destroy(menu $menu){
            $menu->delete();
                   return redirect()->route('menus.index')->with('info','删除成功');

               }
               public function edit(menu $menu){
                   $as=menu_categorie::all()->where('shop_id',auth()->user()->id);
              return view('menu1.edit',compact('menu'),compact('as'));
               }
               public function update(menu $menu,Request $request){
                   $this->validate($request,
                       [
                           'goods_name'=>'required',
                           'category_id'=>'required',
                           'description'=>'required',
                           'goods_price'=>'required',
                           'description'=>'required',
                           'month_sales'=>'required',
                           'rating_count'=>'required',
                           'tips'=>'required',
                           'satisfy_count'=>'required',
                           'satisfy_rate'=>'required',

                           'status'=>'required',
                       ],
                       [
                           'goods_name.required'=>'请输入菜品名称',
                           'rating.required'=>'请输入评分',
                           'category_id.required'=>'请选择分类',
                           'goods_price.required'=>'请输入价格',
                           'description.required'=>'请输入描述',
                           'month_sales.required'=>'请输入月销量',
                           'rating_count.required'=>'请输入评分数',
                           'tips.required'=>'请输入提示',
                           'satisfy_count.required'=>'请输入满意度数量',
                           'satisfy_rate.required'=>'请输入满意度评分',
                           'status.required'=>'请选择状态',

                           'goods_img.image'=>'图片格式有误',
                       ]);

                   $img=$request->file('goods_img');
                   if ($img){
                       $path=$img->store('public/shop');
              $ma=menu::find($menu->id);
               $ma->goods_name=$request->goods_name;
               $ma->rating=$request->rating;
               $ma->shop_id=auth()->user()->id;
                   $ma->category_id=$request->category_id;
                   $ma->goods_price=$request->goods_price;
                   $ma->description=$request->description;
                   $ma->month_sales=$request->month_sales;
                   $ma->rating_count=$request->rating_count;
                   $ma->tips=$request->tips;
                   $ma->satisfy_count=$request->satisfy_count;
                   $ma->status=$request->status;
                   $ma->goods_img=url(Storage::url($path));
                   $ma->save();}else{
                       $ma=menu::find($menu->id);
                       $ma->goods_name=$request->goods_name;
                       $ma->rating=$request->rating;
                       $ma->shop_id=auth()->user()->id;
                       $ma->category_id=$request->category_id;
                       $ma->goods_price=$request->goods_price;
                       $ma->description=$request->description;
                       $ma->month_sales=$request->month_sales;
                       $ma->rating_count=$request->rating_count;
                       $ma->tips=$request->tips;
                       $ma->satisfy_count=$request->satisfy_count;
                       $ma->status=$request->status;
                       $ma->save();

                   }
                   return redirect()->route('menus.index')->with('info','修改');

 /*       $a=$request->goods_name;
var_dump($a);exit;
                   $img=$request->file('goods_img');

                       $path=$img->store('public/shop');
                       $menu->update([
                           'goods_name'=>$request->goods_name,
                           'rating'=>$request->rating,
                           'shop_id'=>$request->shop_id,
                           'category_id'=>$request->category_id,
                           'goods_price'=>$request->goods_price,
                           'description'=>$request->description,
                           'month_sales'=>$request->month_sales,
                           'rating_count'=>$request->rating_count,
                           'tips'=>$request->tips,
                           'satisfy_count'=>$request->satisfy_count,
                           'satisfy_rate'=>$request->satisfy_rate,
                           'status'=>$request->status,
                           'path'=>url(Storage::url($path))
                       ]);*/


                   }
                   public function keyword(Request $request){


                       }






}
