@include('layoutf.nav')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">

        <table class="table table-striped table-hover" >
            <h1>添加管理员</h1>
            <form method="post"  action="{{route('admins.update',[$admin])}}" enctype="multipart/form-data">
                <h4>管理员名字</h4>
                <input type="text" value="{{$admin->name}}" name="name" class="form-control" placeholder="请输入管理员名字">
                <h4>管理员密码</h4>
                <input type="password"  name="password" class="form-control" placeholder="请输入管理员密码">
                <h4>管理员邮箱</h4>

                <input type="text" value="{{$admin->email}}" name="email" class="form-control" placeholder="请输入管理员名字">

                <div class="form-group">

                    @foreach($rs as $r)
                        <input  type="checkbox" name="syncRoles[]"
                                @if($admin->hasRole($r->name))checked @endif
                                value="{{$r->name}}"/>{{$r->name}}
                    @endforeach


                    {{csrf_field()}}
                    {{ method_field('patch') }}





                    <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">添加</button>
                </div>
            </form>


        </table>


        <!-- Small modal -->


        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">

                <div class="modal-content">

                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">用户名</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="请输入手机号登录">
                        </div>
                        <div class="form-group">


                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="请输入密码">
                        </div>



                    </form>
                </div>
            </div>
        </div>

    </div>


</div>


</body>
</html>