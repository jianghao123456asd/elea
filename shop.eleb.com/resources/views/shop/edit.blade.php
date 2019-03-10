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
                <a class="navbar-brand" href="#">首页</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav">
                    <li class="active"><a href="/users">商户管理<span class="sr-only">(current)</span></a></li>

                    <li class="dropdown">
                    <li class="active"><a href="/shops"><span class="sr-only">(current)</span></a></li>

                    <li class="dropdown"> <li class="dropdown">
                    <li class="active"><a href="/menucategories">菜品分类<span class="sr-only">(current)</span></a></li>
                    <li class="active"><a href="/menus">菜品管理<span class="sr-only">(current)</span></a></li>
                    <li class="active"><a href="/activitys">活动<span class="sr-only">(current)</span></a></li>
                    <li class="active"><a href="/shops">店铺信息<span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">



                        <form class="navbar-form navbar-left">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="请输入关键词">
                            </div>
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                        </form>

                        <ul class="nav navbar-nav navbar-right">
                            @guest
                                <li><a href=""  >登录</a></li>
                            @endguest
                            <li class="dropdown">
                                @auth

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>{{auth()->user()->name}} <span class="caret"></span></a>

                                    <ul class="dropdown-menu">

                                        <li><a href="#">个人中心</a></li>
                                        <li><a href="#">修 改资料</a></li>
                                        <li><a href="{{route('user.password')}}">修改密码</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="{{route('logout')}}">退出登陆 </a></li>

                                    </ul>
                                @endauth
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
        <form method="post"  action="{{route('shops.update',[$shop])}}" enctype="multipart/form-data">
            <h4>店铺名称</h4>

            <input type="text" value="{{$shop->shop_name}}" name="shop_name" class="form-control" placeholder="请输入店铺名称">
            <h4>店铺分类</h4>
            <select name="shop_category_id" id="">

                <option value="{{$shop->shop_category_id}}">{{$shop->shopcategory->name}}</option>
                @foreach($ShopCategorys as  $ShopCategory)
                    <option value="{{$ShopCategory->id}}">{{$ShopCategory->name}}</option>
                @endforeach
            </select>

            <h4>店铺头像</h4>
            <img src="{{$shop->shop_img}}" style="height: 120px;width: 120px">
          <input type="file" name="shop_img">
            <h4>起送金额</h4>
            <input type="text" value="{{$shop->start_send}}" name="start_send" class="form-control" placeholder="请输入起 送金额">
            <h4>配送费</h4>
            <input type="text" value="{{$shop->send_cost}}" name="send_cost" class="form-control" placeholder="请输入配送费">
            <h4>店铺公告</h4>

            <input type="text" name="notice" value="{{$shop->notice}}" class="form-control" placeholder="请输入店铺公告">
            <h4>店铺优惠信息</h4>

            <input type="text" name="discount" {{$shop->discount}} class="form-control" placeholder="请输入店铺优惠信息">
            <h4>评分</h4>
            <input type="text" value="{{$shop->shop_rating}}" name="shop_rating" class="form-control" placeholder="请输入评分">
            <h4>是否是品牌</h4>

            <input type="radio" name="brand" value="1" @if($shop->brand==1) checked="checked" @endif/> 是
            <input type="radio" name="brand" value="0" @if($shop->brand==0) checked="checked" @endif/> 否
            <h4>是否准时送达</h4>

            <input type="radio" name="on_time" value="1" @if($shop->on_time==1) checked="checked" @endif/> 是
            <input type="radio" name="on_time" value="0" @if($shop->on_time==0) checked="checked" @endif/> 否
            <h4>是否蜂鸟配送</h4>


            <input type="radio" name="fengniao" value="1" @if($shop->fengniao==1) checked="checked" @endif/> 是
            <input type="radio" name="fengniao" value="0" @if($shop->fengniao==0) checked="checked" @endif/> 否
            <h4>是否保标记</h4>

            <input type="radio" name="bao" value="1" @if($shop->bao==1) checked="checked" @endif/> 是
            <input type="radio" name="bao" value="0" @if($shop->bao==0) checked="checked" @endif/> 否
            <h4>是否票标记</h4>

            <input type="radio" name="piao" value="1" @if($shop->piao==1) checked="checked" @endif/> 是
            <input type="radio" name="piao" value="0" @if($shop->piao==0) checked="checked" @endif/> 否
            <div class="form-group">

                <h4>是否准标记</h4>

                <input type="radio" name="zhun" value="1" @if($shop->zhun==1) checked="checked" @endif/> 是
                <input type="radio" name="zhun" value="0" @if($shop->zhun==0) checked="checked" @endif/> 否




                {{csrf_field()}}
                {{ method_field('patch') }}

                <label for="exampleInputPassword1">请输入验证码</label>
                <input id="captcha" class="form-control" name="captcha" >
                <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default   ?'+Math.random()" title="点击图片重新获取验证码">
                <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">添加</button>
            </div>
        </form>
        <script>
            // 初始化Web Uploader
            var uploader = WebUploader.create({

                // 选完文件后，是否自动上传。
                auto: true,

                // swf文件路径
                //swf: '/js/Uploader.swf',

                // 文件接收服务端。
                server: '/upload',

                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '#filePicker',

                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                },
                //设置上传请求参数
                formData:{
                    _token:'{{ csrf_token() }}'
                }
            });
            //监听上传成功事件
            uploader.on( 'uploadSuccess', function( file,response ) {
                // do some things.
                console.log(response.path);
                //图片回显
                $("#img").attr('src',response.path);
                //图片地址写入隐藏域
                $("#img_val").val(response.path);
            });
        </script>

    </table>


    <!-- Small modal -->


    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content">





                </form>
            </div>
        </div>
    </div>

</div>


</div>


</body>
</html>