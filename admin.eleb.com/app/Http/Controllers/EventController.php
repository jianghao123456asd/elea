<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Event_member;
use App\Models\Event_prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    //
    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
//         dd($request->signup_end);
        $e = new Event();
        $e->signup_num = $request->signup_num;
        $e->title = $request->title;
        $e->content = $request->content;
        $e->signup_start = $request->signup_start;
        $e->signup_end = $request->signup_end;
        $e->prize_date = $request->prize_date;
        $e->is_prize = 0;
        $e->save();
        return redirect()->route('events.index')->with('success','添加成功');
    }

    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function kaijiang($id)
    {
//        var_dump($id);
        DB::beginTransaction();
        try{
        $eps = Event_prize::where('events_id', $id)->get()->toarray();
        $ems = event_member::where('events_id', $id)->get()->toArray();
        $user = [];
        $ids = [];
        $et=Event::find($id);



        if (count($eps)==0){
            return redirect()->route('events.index')->with('danger','没有设置奖品');
        }
            if (count($ems)<2){
                return redirect()->route('events.index')->with('danger','没有人报名,或者至少两人才能开奖');
            }
        foreach ($ems as $em => $v) {
            $user[] = $v['member_id'];

        }
        $bs = array_rand($user, 2);
        foreach ($bs as $l) {
            $ids[] = $user[$l];
        }
        for ($i=0; $i <count($eps); $i++) {
            Event_prize::where('id', $eps[$i]['id'])->update(['member_id' => $ids[$i]??'0']);

              }
              $event=Event::find($id);
              $event->is_prize=1;
              $event->save();
            DB::commit();

            return redirect()->route('events.index')->with('success','开奖成功');
        }catch(QueryException $exception){
            DB::rollBack();
        }
    }
               public function destroy(Event $event){
                 $event->delete();
                   return redirect()->route('events.index')->with('success','删除成功');
               }
               public function edit(Event $event){

                      $prize_date=$event->prize_date;
                   $start=$event->signup_start;
                   $end=$event->signup_end;
//        var_dump($endtime);
                   $end=str_replace(' ','T',$end);
                   $start=str_replace(' ','T',$start);
                   $prize_date=str_replace(' ','T',$prize_date);
//                   var_dump($start,$end);exit;
                return view('events.edit',compact('event','end','start','prize_date'));
               }
               public function update(Event $event,Request $request){
                      $e= Event::find($event->id);
                   $e->signup_num = $request->signup_num;
                   $e->title = $request->title;
                   $e->content = $request->content;
                   $e->signup_start = $request->signup_start;
                   $e->signup_end = $request->signup_end;
                   $e->prize_date = $request->prize_date;
                   $e->is_prize = 0;
                   $e->save();
                   return redirect()->route('events.index')->with('success','修改成功');
               }
               }



