<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Navs;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //

    public function index(Request $request){
        $rows=Navs::where('pid',0)->get();
        $navs=Navs::where('pid','!=',0)->get();
           $keyword=$request->keyword??'';

           if ($keyword){

            $member=Member::where('username','like',"%$keyword%")->get();
           }else{

               $member=Member::all();
           }
           return view('member.index',compact('member','rows','navs'));
    }
    public function edit(Member $member){
          $member=Member::find($member->id);
          $member->status=0;
          $member->save();
        return redirect()->route('members.index')->with('success','禁用成功');
    }
    public function kaiqi($id){
        $member=Member::find($id);
        $member->status=1;
        $member->save();
        return redirect()->route('members.index')->with('success','启用成功');

    }
    public function show(Member $member){

        return view('member.show',compact('member'));
    }
}
