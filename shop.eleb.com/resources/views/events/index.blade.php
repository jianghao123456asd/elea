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
                    <li class="active"><a href="/events">试用抽奖<span class="sr-only">(current)</span></a></li>
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
    @foreach(['success','info','danger'] as $status)
        @if(session()->has($status))
            <div class="alert alert-{{ $status }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session($status) }}</div>
        @endif
    @endforeach
<div class="container">


    <table class="table table-striped table-hover" >

        <tr><th>活动名字</th><th>报名开始时间</th><th>报名结束时间</th><th>开奖日期</th>
            <th>是否已开奖</th>

            <th>报名</th></tr>

        @foreach($events as $event)
            <tr>   <td>{{$event->title}}</td>
                <td>{{$event->signup_start}}</td>
                <td>{{$event->signup_end}}</td>

                <td>{{$event->prize_date}}</td>
                <td>@if($event->is_prize==0)未开奖@else<a href={{route('et.zj',[$event->id])}}>查看中奖</a> @endif</td>
                <td>

                 <?php
                    $em=\App\Models\event_member::where('member_id',auth()->user()->id)->where('events_id',$event->id)->get();
                    ?>
                    @if(count($em))
                    <a href="{{route('events.show',[$event])}}" class="btn btn-primary">已报名</a> </td>
                @else
                    <a href="{{route('events.edit',[$event])}}" class="btn btn-primary">报名</a> </td>
                    @endif
            </tr>
        @endforeach


    </table>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

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


</div>    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
