<?php

namespace App\Http\Controllers;

use App\Models\Navs;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends Controller
{
    //
    public function index(){
        $rows=Navs::where('pid',0)->get();
        $navs=Navs   ::where('pid','!=',0)->get();
        $shopCategorys=ShopCategory::all();
        return view('categorie.index',compact('shopCategorys','rows','navs'));
    }
    public function create(){

        return view('categorie.create');
    }
    public function store(Request $request){
        $this->validate($request,
            [
                'name'=>'required',
                'status'=>'required',

                'captcha' => 'required|captcha',


            ],
            [
                'name.required'=>'分类名不能为空',
                'status.required'=>'请选择分类状态',
                'captcha.required' => '验证码不能为空',
                'captcha.captcha' => '请输入正确的验证码',
                'img.required'=> '图片不能为空',

            ]);

        ShopCategory::create([
            'name'=>$request->input('name'),
            'img'=>$request->img,
            'status'=>$request->status
        ]);
        return redirect()->route('shopCategorys.index')->with('success','添加分类成功');}
        public function destroy(ShopCategory $shopCategory){
        $shopCategory->delete();
            return redirect()->route('shopCategorys.index')->with('success','删除分类成功');

        }
        public function edit(ShopCategory $shopCategory){

        return view('categorie.edit',compact('shopCategory'));
        }
        public function update(ShopCategory $shopCategory,Request $request){
            $this->validate($request,
                [
                    'name'=>'required',
                    'status'=>'required',
                    'img'=>'required'

                ],
                [
                    'name.required'=>'分类名不能为空',
                    'status.required'=>'请选择分类状态',

                ]);
            $img = $request->img;
            //dd($img);
            if($img){//有图片上传
                //保存文件

                $shopCategory->update([
                    'name'=>$request->input('name'),
                    'status'=>$request->status,
                    'img'=>$request->img

                ]);
            }else{//没有图片上传
                $shopCategory->update([
                    'name'=>$request->input('name'),
                    'status'=>$request->status,


                ]);
            }
            return redirect()->route('shopCategorys.index')->with('success','修改分类成功');
        }
    public function upload(Request $request)
    {
        $img = $request->file('file');
        $path = Storage::url($img->store('public/categories'));
        return ['path'=>$path];
    }

}
