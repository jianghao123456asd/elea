@include('layoutf.nav')
</n
@foreach(['success','info','danger'] as $status)
    @if(session()->has($status))
        <div class="alert alert-{{ $status }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session($status) }}</div>
    @endif
@endforeach
<div class="container">

    <table class="table table-striped table-hover" >

        <tr><th>会员名</th><th>会员电话</th><th>创建时间</th><th>状态</th><th>操作</th></tr>


            <tr>   <td>{{$member->username}}</td>
                <td>{{$member->tel}}</td>
                <td>{{$member->created_at}}</td>
                <td>
                    @if($member->status==1)
                        正常
                    @else
                        禁用
                    @endif
                </td>
<td>


                    @if($member->status==1)
                        <a href="{{route('members.edit',[$member])}}" class="btn btn-warning">禁用</a></td>
                @elseif($member->status==0)
                    <a href="{{route('me.kaiqi',[$member->id])}}" class="btn btn-warning">启用</a></td>
                @endif
            </tr>
        {{--@endforeach--}}


    </table>


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