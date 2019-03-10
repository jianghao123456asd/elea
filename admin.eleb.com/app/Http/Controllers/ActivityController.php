<?php

namespace App\Http\Controllers;
use App\Http\Middleware\EncryptCookies;
use App\Models\Activity;
use App\Models\Navs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index(){
        $rows=Navs::where('pid',0)->get();
        $navs=Navs::where('pid','!=',0)->get();
        $activitys=Activity::all();
      return view('activity.index',compact('activitys','rows','navs'));
    }
    public function create(){
        return view('activity.add');
    }
    public function store(Request $request){

        $this->validate($request,  [
            'title'=>'required',
            'content'=>'required',
            'captcha' => 'required|captcha',
            'endtime'=>'required',
            'start_time'=>'required',
        ],
            [
                'name.required'=>'活动名不能为空',
                'content.required'=>'活动内容不能为空',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'请输入正确的验证码',
                'endtime.required'=>'请填写修改的结束时间',
                'start_time.required'=>'验证码不能为空',


            ]);
//       dd($request->content);
           $activity=new Activity();
           $activity->title=$request->title;
           $activity->content=$request->content;
           $activity->endtime=$request->endtime;
           $activity->start_time=$request->start_time;
           $activity->save();

        return redirect()->route('activitys.index')->with('success','添加成功');

    }
    public function edit(Activity $activity){
        $endtime=$activity->endtime;
        $strtime=$activity->start_time;
//        var_dump($endtime);
        $end=str_replace(' ','T',$endtime);
        $start_time=str_replace(' ','T',$strtime);
//        var_dump($end);

           return view('activity.edit',compact('activity','end','start_time'));
    }
    public function update(Activity $activity,Request $request){
        $this->validate($request,  [
            'title'=>'required',
            'content'=>'required',
            'captcha' => 'required|captcha',
            'endtime'=>'required',
            'start_time'=>'required',
        ],
            [
                'name.required'=>'活动名不能为空',
                'content.required'=>'活动内容不能为空',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'请输入正确的验证码',
                'endtime.required'=>'请填写修改的结束时间',
                'start_time.required'=>'验证码不能为空',


            ]);
          $activity->update([
              'title'=>$request->title,
              'content'=>$request->input('content'),
              'start_time'=>$request->start_time,
              'endtime'=>$request->endtime
          ]);
        return redirect()->route('activitys.index')->with('success','修改成功');
    }
    public function destroy(Activity $activity){
         $activity->delete();
        return redirect()->route('activitys.index')->with('success','删除成功');
    }
    public function for(){
   $time=date('Y-m-d');
         $activitys= Activity::all()->where('start_time','<',$time)->where('endtime','>',$time);
//    var_dump($activity);
    return view('activity.for',compact('activitys'));
    }  //进行中
    public function stop(){
        $time=date('Y-m-d');
        var_dump($time);
        $activitys= Activity::all()->where('endtime','<',$time);
//        var_dump($activity);
        return view('activity.stop',compact('activitys'));
    }//一结束
    public function notstart(){
        $time=date('Y-m-d');
        var_dump($time);
        $activitys=   $activitys= Activity::all()->where('start_time','>',$time); ;
        return view('activity.stop',compact('activitys'));
    }//未开始
    public function show($id){
        var_dump($id);
        $activity=Activity::find($id);
//           var_dump($activity);
        return view('activity.show',compact('activity'));
    }
}
