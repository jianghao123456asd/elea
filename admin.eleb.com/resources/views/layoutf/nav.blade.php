
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
<?php
            $rows = \App\Models\Navs::where('pid',0)->get();
            //                var_dump($Dmenus);exit;
            $navs =  \App\Models\Navs::where('pid','!=',0)->get();?>
            <ul class="nav navbar-nav">
                @foreach($rows as $row)
                    @if(auth()->user()->can($row->permission->name))
                <li class="dropdown">
                    @if($row->pid==0)
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$row->name}}</a>
                    @endif
                        @endif

                    <ul class="dropdown-menu">

                        @foreach($navs as $n)
                              @if(auth()->user()->can($n->permission->name))
                            @if($n->pid==$row->id)  <li><a href="/{{$n->url}}" > {{$n->name}}</a></li> @endif
                                  @endif
                                @endforeach

                    </ul>

                </li>
                @endforeach

                        <li class="dropdown">
                                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜单</a>

                            <ul class="dropdown-menu">


                                    <li><a href="/navs"> 菜单列表</a></li>

                            </ul>

                        </li>

            </ul>





                        <ul class="nav navbar-nav navbar-right">
                            @guest
                                <li><a href="/login"  >登录</a></li>
                            @endguest
                            <li class="dropdown">
                                @auth

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>{{auth()->user()->name}} <span class="caret"></span></a>

                                    <ul class="dropdown-menu">

                                        <li><a href="#">个人中心</a></li>
                                        <li><a href="#">修改资料</a></li>
                                        <li><a href="#">修改密码</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="{{route('logout')}}">退出登陆 </a></li>

                                    </ul>
                                @endauth
                            </li>
                        </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
