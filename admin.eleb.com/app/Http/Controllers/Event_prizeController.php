<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Event_prize;
use Illuminate\Http\Request;

class Event_prizeController extends Controller
{
    //
    public function create(){
        $hds=Event::where('is_prize',0)->get();
        return view('ep.add',compact('hds'));
    }
    public function store(Request $request){
                $ep=new Event_prize();
                $ep->events_id=$request->events_id;
                $ep->name=$request->name;
                $ep->description=$request->description;
                $ep->save();
        return redirect()->route('eventprizes.index')->with('success','添加成功');
    }
    public function index(){
        $Event_prizes=Event_prize::all();
        return view('ep.index',compact('Event_prizes'));
    }
    public function destroy($id){
        Event_prize::destroy($id);
        return redirect()->route('eventprizes.index')->with('success','删除成功');
    }
    public function edit($id){
        $hds=Event::where('is_prize',0)->get();
        $ep=Event_prize::find($id);
        return view('ep.edit',compact('ep','hds'));
    }
    public function update($id,Request $request){
       $ep=Event_prize::find($id);
        $ep->events_id=$request->events_id;
        $ep->name=$request->name;
        $ep->description=$request->description;
        $ep->save();
        return redirect()->route('eventprizes.index')->with('success','修改成功');
    }
    public function show($id){
          $eps=Event_prize::where('events_id',$id)->get();
//          var_dump($eps);
        return view('ep.show',compact('eps'));

    }

}
