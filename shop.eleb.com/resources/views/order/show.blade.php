<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        #box22{margin-top: 8px;
            float: left
        ;margin-left: 10px}
    </style>
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
    @foreach(['success','info','danger'] as $status)
        @if(session()->has($status))
            <div class="alert alert-{{ $status }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session($status) }}</div>
        @endif
    @endforeach
    <div class="container">
        {{--  <div class="btn-group" id="box22" style="margin-top: 44px">
              <button type="button" class="btn btn-default btn btn-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  商品 <span class="caret"></span>
              </button>

              <ul class="dropdown-menu">
                  @foreach($clas as $cla)
                      <li><a href="{{route('menus.show',[$cla])}}">{{$cla->name}}</a></li>
                  @endforeach
              </ul>
          </div>--}}

        <h1>订单列表</h1>
        <div class="btn-group" id="box22" style="margin-top: 44px">
            <button type="button" class="btn btn-default btn btn-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                历史订单 <span class="caret"></span>
            </button>

            <ul class="dropdown-menu">

                <li><a href="{{route('Or.tj')}}">最近七天 </a></li>
                <li><a href="{{route('Ordermans.yue')}}">最近三个月 </a></li>
            </ul>
        </div>
        <table class="table table-striped table-hover" >
<h1>订单详情</h1>
            <tr><th>订单创建时间</th><th>订单编号</th><th>收货人名字</th><th>地址</th><th>订单价格</th> <th>状态</th>
                <th>操作</th></tr>


                <tr>
                    <td>{{$or->created_at}}</td>
                    <td>{{$or->sn}}</td>
                    <td>{{$or->name}}</td>
                    <td>{{$or->address}}</td>
                    <td>{{$or->total}}</td>

                    <td>@if($or->status==0)<a class="btn-info">代发货</a>@elseif($or->status==2)<a class="btn-success"> 待确定</a>@elseif($or->status==3)完成订单@else<a class="btn-warning">取消订单</a>@endif</td>

                    <td>
                        @if($or->status==0)
                            <a href="{{route('Ordermans.fahuo',[$or->id])}}" class="btn btn-info">发货</a>
                        @elseif($or->status==2)
                            <a href="" class="btn btn-info">已发货</a>
                        @else
                            <a href="" class="btn btn-info">已取消</a>
                        @endif

                        <a href="{{route('Ordermans.show',[$or->id])}}" class="btn btn-primary">查看订单</a>
                        <a href="{{route('Ordermans.stop',[$or->id])}}" class="btn btn-warning">取消订单</a></td>




        </table>




        </form>
    </div>
</div>
</div>

</div>


</div>    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>