<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //

        public function index()
        {
            //获取所有学生数据
            $students = Student::all();
            //调用视图，传参
            return view('student.index',['student'=>$students]);//student/index.blade.php

    }
}
