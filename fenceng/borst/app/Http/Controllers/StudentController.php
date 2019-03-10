<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Model\StatusModel;

class StudentController extends Controller
{
    //
    public function index(){
     $students=Student::all();
     //调用视图
        //var_dump($students);
        return view('student.index',['students'=>$students]);//sutdent/index.blade.php

    }
    public function add(){
        return view('student.add');
    }
    public function save(Request $request){
     $student= new  Student();
     $student->name=$request->name;
     $student->age=$request->age;
     $student->sex=$request->sex;
     $student->save();
     return redirect('student/index');
    }
    public function del($id){
       Student::destroy($id);
        return redirect('student/index');
    }
}
