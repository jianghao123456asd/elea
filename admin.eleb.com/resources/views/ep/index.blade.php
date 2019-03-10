@include('layoutf.nav')
@foreach(['success','info','danger'] as $status)
    @if(session()->has($status))
        <div class="alert alert-{{ $status }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session($status) }}</div>
    @endif
@endforeach
<div class="container">
    <a href="/eventprizes/create">添加试用商品</a>

    <table class="table table-striped table-hover" >

        <tr><th>奖品</th><th>活动名</th><th>中奖商家名字</th>
            <th>是否已开奖</th>

            <th>操作</th></tr>

        @foreach($Event_prizes as $Event_prize)
            <tr>   <td>{{$Event_prize->name}}</td>
                <td>{{$Event_prize->et->title??''}}</td>
                <td>{{$Event_prize->user->name??''}}</td>
                <td>@if($Event_prize->member_id)已开奖@else未开奖 @endif</td>
                <td>
                    @if($Event_prize->member_id)
                        <form style="display: inline" method="post" action="">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit" disabled class="btn btn-danger">删除</button>

                        @else
                                <form style="display: inline" method="post" action="{{route('eventprizes.destroy',[$Event_prize])}}">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-danger">删除</button>@endif

                    </form>
                @if($Event_prize->member_id) <a href="" disabled="disabled"class="btn btn-info">修改</a>@else<a href="{{route('eventprizes.edit',[$Event_prize])}}"  class="btn btn-info">修改</a> @endif

                </td>

            </tr>
        @endforeach


    </table>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    <!-- Small modal -->




</div>

