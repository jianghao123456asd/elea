@include('layoutf.nav')

@foreach(['success','info','danger'] as $status)
    @if(session()->has($status))
        <div class="alert alert-{{ $status }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session($status) }}</div>
    @endif
@endforeach

<div class="container">
<h4><a href="/navs/create">添加菜单</a> </h4>
    <table class="table table-striped table-hover" >

        <tr><th>菜单名</th><th>url</th><th>操作</th></tr>

        @foreach($dhs as $dh)
            <tr>   <td>{{$dh->name}}</td>
                <td>{{$dh->url}}</td>
                <td><form style="display: inline" method="post" action="{{route('navs.destroy',[$dh])}}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                    <a href="{{route('navs.edit',[$dh])}}" class="btn btn-info">编辑</a></td>
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
