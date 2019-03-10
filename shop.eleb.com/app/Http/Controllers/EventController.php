<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\event_member;
use App\Models\Event_prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    //
    public function index(){
        $events=Event::all();
        return view('events.index',compact('events'));
    }
    //报名
    public function edit(Event $event){
        $results = event_member::where('events_id',$event->id)->count();
//       dd($results);
            $et=Event::find($event->id);
        $time=date('Y-m-d H:i:s');
        if ($et->signup_start>$time){
            return redirect()->route('events.index')->with('danger','报名时间未开始');
        }

        if ($et->is_prize!=0){
              return redirect()->route('events.index')->with('danger','活动已结束');
          }

       if ($results<$event->signup_num){
           $em=new event_member();
           $em->events_id=$event->id;
           $em->member_id=auth()->user()->id;
           $em->save();
           return redirect()->route('events.index')->with('success','报名成功');

       }else{
           return redirect()->route('events.index')->with('danger','报名人数已满');
       }


    }
    public function show(Event $event){

        return redirect()->route('events.index')->with('danger','你已经报名了！！！！');
    }
    public function zhongjiang($id){

        $eps=event_prize::where('events_id',$id)->get();

             return view('events.show',compact('eps'));
    }
}
