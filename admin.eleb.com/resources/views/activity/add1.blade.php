<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    @include('vendor.ueditor.assets')

</head>
<script src="/jquery.js"></script>
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
                <script></script>

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
                    <h1>添加活动</h1>
                    <form method="post" action="{{route('activitys.store')}}" >
                    <div>
                    <h4>活动标题</h4>
                    <input type="text" name="title" class="form-control" placeholder="请输入活动标题">
                    <h4>活动内容00</h4>
                        <script id="content" name="content" type="text/plain"></script>

                    <script type="text/javascript">
                        var ue = UE.getEditor('content');
                        ue.ready(function() {
                            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                        });
                    </script>

                    <h4>活动开始时间</h4>
                    <input type="date" name="start_time" placeholder="请输入活动开始时间" class="form-control" >
                    <h4>结束时间</h4>
                    <input type="date" name="endtime" placeholder="请输入活动停止时间" class="form-control" >{{csrf_field()}}
                    <label for="exampleInputPassword1">请输入验证码</label>
                    <input id="captcha" class="form-control" name="captcha" >
                    <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default   ?'+Math.random()" title="点击图片重新获取验证码">
                    <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">添加</button>
                    {{csrf_field()}}
                     </div></form>
                     </table>
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