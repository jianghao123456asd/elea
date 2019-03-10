@include('layoutf.nav')


<div class="container">

    <table class="table table-striped table-hover" >
        <h1>添加修改</h1>
        <form method="post" action="{{route('roles.update',[$role])}}" enctype="multipart/form-data">
            <h4>角色名称名称</h4>
            <input type="text" value="{{$role->name}}" name="name" class="form-control" placeholder="请输入权限名字">
            {{csrf_field()}}
            <h4>角色权限</h4>
            {{ method_field('patch') }}
            @foreach($ps as $p)
                <input  type="checkbox" name="Permission[]"
                     @if($role->hasPermissionTo($p->name))checked @endif
                        value="{{$p->name}}"/>{{$p->name}}
            @endforeach
            <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">提交</button>


        </form>


    </table>


    <!-- Small modal -->




</div>