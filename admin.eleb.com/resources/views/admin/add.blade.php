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
            <form method="post" action="{{route('admins.store')}}" enctype="multipart/form-data">
                <h4>管理员名字</h4>
                <input type="text" name="name" class="form-control" placeholder="请输入管理员名字">
                <h4>管理员密码</h4>
                <input type="password" name="password" class="form-control" placeholder="请输入管理员密码">
                <h4>管理员邮箱</h4>

                <input type="text" name="email" class="form-control" placeholder="请输入管理员名字">
                <h4>角色</h4>
                @foreach($roles as $r)
                    <input type="checkbox" name="syncRoles[]" value="{{$r->name}}"/>{{$r->name}}
                @endforeach

                <div class="form-group">




                    {{csrf_field()}}




                    <label for="exampleInputPassword1">请输入验证码</label>
                    <input id="captcha" class="form-control" name="captcha" >
                    <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default   ?'+Math.random()" title="点击图片重新获取验证码">
                    <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">添加</button>
                </div>
            </form>


        </table>


        <!-- Small modal -->


        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">

                <div class="modal-content">



                </div>
            </div>
        </div>

    </div>


</div>


</body>
</html>