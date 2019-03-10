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
            <h1>添加菜品</h1>
            <form method="post" action="{{route('menus.update',[$menu])}}" enctype="multipart/form-data">
                <h4>菜品名</h4>
                <input type="text" value="{{$menu->goods_name}}" name="goods_name" class="form-control" placeholder="请输入分类名字">

                <h4>评分</h4>
                <input type="text" value="{{$menu->rating}}" name="rating" class="form-control" placeholder="请输入评分">

                <h4>菜品分类</h4>
                <select name="category_id" id="">


             <option value="{{$menu->category_id}}">{{$menu->clas->name}}</option>
                    @foreach($as as  $a)

                        <option value="{{$a->id}}">{{$a->name}}</option>
                    @endforeach
                </select>

                <h4>价格</h4>
                <input type="text"placeholder="请输入价格" value="{{$menu->goods_price}}" name="goods_price" class="form-control" >
                <h4>描述</h4>

                <input type="text"placeholder="请输入描述" value="{{$menu->description}}" name="description" class="form-control" >
                <h4>月销量</h4>
                <input type="text"placeholder="请输入月销量" value="{{$menu->month_sales}}" name="month_sales" class="form-control" >
                <h4>评论数量</h4>
                <input type="text"placeholder="请输入评论数" value="{{$menu->rating_count}}" name="rating_count" class="form-control" >
                <h4>提示信息</h4>
                <input type="text"placeholder="请输入提示信息" value="{{$menu->tips}}" name="tips" class="form-control" >
                <h4>满意度数量</h4>
                <input type="text"placeholder="请输入满意度数量" value="{{$menu->satisfy_count}}" name="satisfy_count" class="form-control" >
                <h4>满意度评分</h4>
                <input type="text"placeholder="请输入满意度评分" value="{{$menu->satisfy_rate}}" name="satisfy_rate" class="form-control" >
                <h4>商品图片</h4>
                <input type="file"  name="goods_img" class="form-control" >
                <img src="{{$menu->goods_img}}">
                <h4>状态：1上架，0下架</h4>
                <input type="radio" name="status" value="1" @if($menu->status==1) checked="checked" @endif/> 是
                <input type="radio" name="status" value="0" @if($menu->status==0) checked="checked" @endif/> 否


                <div class="form-group">




                    {{csrf_field()}}
                    {{ method_field('patch') }}




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