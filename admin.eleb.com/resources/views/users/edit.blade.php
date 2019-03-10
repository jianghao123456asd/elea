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
            <h1>修改账号</h1>
            <form method="post"  action="{{route('users.update',[$user])}}" enctype="multipart/form-data">

                    <h4>用户名</h4>
                    <input type="text" value="{{$user->name}}" name="name" class="form-control" placeholder="请输入用户名字">
                    <h4>密码</h4>
                    <input type="password"  name="password" class="form-control" placeholder="请输入密码">
                    <h4>邮箱</h4>
                    <input type="text" value="{{$user->email}}" name="email" class="form-control" placeholder="请输入邮箱">





                {{csrf_field()}}
                {{ method_field('patch') }}


                <label for="exampleInputPassword1">请输入验证码</label>
                    <input id="captcha" class="form-control" name="captcha" >
                    <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default   ?'+Math.random()" title="点击图片重新获取验证码">
                    <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">提交</button>
                </div>

            </form>


        </table>


        <!-- Small modal -->





                </div>
            </div>
        </div>

    </div>


</div>


</body>
</html>