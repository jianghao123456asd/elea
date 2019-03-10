<?php

namespace App\Http\Controllers;

use App\Models\Event_member;
use Illuminate\Http\Request;

class Event_memberController extends Controller
{
    //
    public function show($id){

      $mes=Event_member::where('events_id',$id)->get();
     return view('events.show',compact('mes'));
    }
}
