<a href="/student/add">添加用户</a>
<table>
    <tr><th>姓名</th><th>年龄</th><th>性别</th><th>删出</th></tr>
    @foreach($students as $studen)
    <tr><td>{{$studen->name}}</td><td>{{$studen->age}}</td><td>{{$studen->sex}}
        </td>    <td><a href="{{ route('student.del',['id'=>$studen->id]) }}">删出</a> </td>
    <td>{{$studen->id}}</td></tr>
    @endforeach
</table>


