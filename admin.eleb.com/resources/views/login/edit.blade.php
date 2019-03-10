<DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
        <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    </head>

    <body>

    <div class="navbar">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/articles/">首页</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="">添加QQ<span class="sr-only">(current)</span></a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">产品<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="">产品列表</a></li>
                                <li><a href="">产品分类</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">新闻<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="">新闻列表</a></li>
                                <li><a href="">新闻分类</a></li>
                            </ul>
                        </li>
                    </ul>


                    <form class="navbar-form navbar-left">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="请输入关键词">
                        </div>
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                    </form>
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
        <div class="container">

            <table class="table table-striped table-hover" >
                <h1>修改密码</h1>
                <form method="post"  action="{{route('admins.update',[$admin])}}" enctype="multipart/form-data">
                    <h4>管理员名字</h4>
                    <input type="text" value="{{$admin->name}}" name="name" class="form-control" placeholder="请输入管理员名字">
                    <h4>管理员密码</h4>
                    <input type="password"  name="password" class="form-control" placeholder="请输入管理员密码">
                    <h4>管理员邮箱</h4>

                    <input type="text" value="{{$admin->email}}" name="email" class="form-control" placeholder="请输入管理员名字">

                    <div class="form-group">




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