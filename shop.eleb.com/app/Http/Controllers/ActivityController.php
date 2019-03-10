<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //
    public function index(){
       /*
        var_dump($time);*/
        $time=date('Y-m-d');
        $activitys= DB::select('select * from activities where  endtime >= ?', [$time]);
//        $activitys=Activity::all()->where('endtime','>=',$time);
        return view('activity.index',compact('activitys'));
        var_dump($activitys);

    }
    public function show($id){
        var_dump($id);
           $activity=Activity::find($id);
//           var_dump($activity);
       return view('activity.show',compact('activity'));
    }
}
