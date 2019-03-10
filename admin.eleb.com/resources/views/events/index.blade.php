@include('layoutf.nav')
@foreach(['success','info','danger'] as $status)
    @if(session()->has($status))
        <div class="alert alert-{{ $status }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session($status) }}</div>
    @endif
@endforeach
<div class="container">
    <a href="/events/create">添加活动</a>

    <table class="table table-striped table-hover" >

        <tr><th>活动名字</th><th>报名开始时间</th><th>报名结束时间</th><th>开奖日期</th><th>限制人数</th>
            <th>是否已开奖</th>

            <th>删除</th>
            <th>修改</th>
            <th>查看报名中奖人数</th>
            <th>开奖</th>
        </tr>

        @foreach($events as $event)
            <tr>   <td>{{$event->title}}</td>
                <td>{{$event->signup_start}}</td>
                <td>{{$event->signup_end}}</td>
                <td>{{$event->prize_date}} </td>

                <td>{{$event->signup_num}}</td>
                <td>@if($event->is_prize==0)未开奖@else已开奖 @endif</td  >
                <td><form style="display: inline" method="post" action="{{route('events.destroy',[$event])}}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form></td>
                <td><a href="{{route('events.edit',[$event])}}" class="btn btn-success">修改</a> </td>
                <td>
                    @if($event->is_prize==0)<a href="{{route('eventmembers.show',[$event->id])}}" class="btn btn-primary">查看报名人数</a>
                    @else<a href="{{route('eventprizes.show',[$event->id])}}" class="btn btn-primary">查看中奖人数</a> @endif</td>
                <td>@if($event->is_prize==0)<a href="{{route('es.kaijiang',[$event->id])}}" class="btn btn-primary">开奖</a></td>
                @else<a href="" disabled="disabled" class="btn btn-primary">已开奖</a></td> @endif</td>


            </tr>
        @endforeach


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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
