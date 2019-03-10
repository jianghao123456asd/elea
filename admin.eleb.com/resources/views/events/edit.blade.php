<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    @include('vendor.ueditor.assets')

</head>
<script src="/jquery.js"></script>
<body>


<form method="post" action="{{route('events.update',[$event])}}" >
    <div class="container">
        <h4>活动标题</h4>
        <input type="text" name="title" value="{{$event->title}}" class="form-control" placeholder="请输入活动标题">
        <h4>活动内容00</h4>
        <script id="content" name="content" type="text/plain">{{$event->content}}</script>
        {{csrf_field()}}
        {{ method_field('patch') }}
        <script type="text/javascript">
            var ue = UE.getEditor('content');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });

        </script>

        <h4>报名开始时间</h4>
        <input type="datetime-local" name="signup_start"  value="{{$start}}" placeholder="请输入活动开始时间" class="form-control" >
        <h4>报名结束时间</h4>
        <input type="datetime-local"  value="{{$end}}" name="signup_end" placeholder="请输入活动停止时间" class="form-control" >{{csrf_field()}}
        <h4>报名人数限制</h4>
        <input type="text" value="{{$event->signup_num}}" name="signup_num" placeholder="请输入报名人数限制" class="form-control" >
        <h4>开奖日期</h4>
        <input type="datetime-local" name="prize_date" value="{{$prize_date}}" placeholder="请输入活动开始时间" class="form-control" >
        <label for="exampleInputPassword1">请输入验证码</label>
        <input id="captcha" class="form-control" name="captcha" >
        <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default   ?'+Math.random()" title="点击图片重新获取验证码">
        <input type="submit" value="提交" class="btn btn-lg ">


    </div></form>


</body>
</html>