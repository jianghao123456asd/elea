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
            <h1>添加商家信息</h1>
            <form method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
                <h4>店铺名称</h4>

                <input type="text" name="shop_name" class="form-control" placeholder="请输入店铺名称">
                <h4>店铺分类</h4>
                <select name="shop_category_id" id="">

                    <option value="">请选择分类</option>
                    @foreach($ShopCategorys as  $ShopCategory)
                        <option value="{{$ShopCategory->id}}">{{$ShopCategory->name}}</option>
                    @endforeach
                </select>

                <h4>店铺头像</h4>
                <input type="file" name="shop_img" class="form-control" >
                <h4>起送金额</h4>
                <input type="text" name="start_send" class="form-control" placeholder="请输入起 送金额">
                <h4>配送费</h4>
                <input type="text" name="send_cost" class="form-control" placeholder="请输入配送费">
                <h4>店铺公告</h4>

                <input type="text" name="notice" class="form-control" placeholder="请输入店铺公告">
                <h4>店铺优惠信息</h4>

                <input type="text" name="discount" class="form-control" placeholder="请输入店铺优惠信息">
                <h4>评分</h4>
                <input type="text" name="shop_rating" class="form-control" placeholder="请输入评分">
                <h4>是否是品牌</h4>
                <input type="radio" name="brand" value="1"/> 是
                <input type="radio" name="brand" value="0"/> 否
                <h4>是否准时送达</h4>
                <input type="radio" name="on_time" value="1"/> 是
                <input type="radio" name="on_time" value="0"/> 否
                <h4>是否蜂鸟配送</h4>
                <input type="radio" name="fengniao" value="1"/> 是
                <input type="radio" name="fengniao" value="0"/> 否
                <h4>是否保标记</h4>
                <input type="radio" name="bao" value="1"/> 是
                <input type="radio" name="bao" value="0"/> 否
                <h4>是否票标记</h4>
                <input type="radio" name="piao" value="1"/> 是
                <input type="radio" name="piao" value="0"/> 否
                <div class="form-group">

                    <h4>是否准标记</h4>
                    <input type="radio" name="zhun" value="1"/> 是
                    <input type="radio" name="zhun" value="0"/> 否
                    <h1>注册商家用户账号</h1>
                    <h4>用户名</h4>
                    <input type="text" name="name" class="form-control" placeholder="请输入用户名字">
                    <h4>密码</h4>
                    <input type="password" name="password" class="form-control" placeholder="请输入密码">
                    <h4>邮箱</h4>
                    <input type="text" name="email" class="form-control" placeholder="请输入邮箱">





                    {{csrf_field()}}

                    {{-- <label for="exampleInputPassword1">请输入验证码</label>
                     <input id="captcha" class="form-control" name="captcha" >
                     <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default   ?'+Math.random()" title="点击图片重新获取验证码">--}}
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