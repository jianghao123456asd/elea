<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>



<a href=""><H1>注册店铺</H1></a>

<ul class="nav navbar-nav navbar-right">
    <li><a href="#"  data-toggle="modal" data-target=".bs-example-modal-sm">登录</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>管理员 <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
        </ul>
    </li>
</ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@foreach(['success','info','danger'] as $status)
    @if(session()->has($status))
        <div class="alert alert-{{ $status }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session($status) }}</div>
    @endif
@endforeach
<div class="container">
    <h1>商户登陆</h1>

    <table class="table table-striped table-hover" >
        <form method="post" action="" enctype="multipart/form-data">
            <label for="exampleInputPassword1">商户用户名</label>
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="请输入商户名">
                <label for="exampleInputPassword1">密码</label>
                <input type="password" name="password" class="form-control" placeholder="请输入商户密码">
                {{csrf_field()}}

                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="1" name="rememberMe">自动登录
                    </label>
                </div>
                <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
                <label >请输入验证码</label>
                <input id="captcha" class="form-control" name="captcha" >
                <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">登陆</button>
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
