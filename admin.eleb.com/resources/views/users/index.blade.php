@include('layoutf.nav')


                        <ul class="nav navbar-nav navbar-right">
                            @guest
                                <li><a href=""  >登录</a></li>
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
    @foreach(['success','info','danger'] as $status)
        @if(session()->has($status))
            <div class="alert alert-{{ $status }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session($status) }}</div>
        @endif
    @endforeach
    <div class="container">
        <a href="/shops/create"  @if(!auth()->user()->can('添加'))) style="display: none"@endif >添加商户</a>
        <h1>商户信息</h1>
        <table class="table table-striped table-hover" >

            <tr><th>用户名</th><th>用户邮箱</th><th>用户店铺名</th><th>用户状态</th><th>操作</th></tr>

          @foreach($users as $user)
                <tr>   <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>

                    <td>{{$user->shop->shop_name}}</td>
                    <td>@if($user->status==1)正常
                        @elseif ($user->status==0)
                            停用

                        @else




                        @endif</td>


                    <td><form style="display: inline" method="post" action="{{route('users.destroy',[$user])}}">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit" class="btn btn-danger"  @if(!auth()->user()->can('删除'))) style="display: none"@endif >删除</button>
                        </form>
                        <a href="{{route('users.edit',[$user])}} "  @if(!auth()->user()->can('修改'))) style="display: none"@endif class="btn btn-info">编辑</a>
                    <a href="{{route('user.password',[$user])}}"  class="btn btn-info"  @if(!auth()->user()->can('重置密码'))) style="display: none"@endif >重置密码</a></td>
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
