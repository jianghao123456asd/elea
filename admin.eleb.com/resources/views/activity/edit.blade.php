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
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form method="post" action="{{route('activitys.update',[$activity])}}" >
    <div class="container">
        <h4>活动标题</h4>
        <input type="text" name="title" value="{{$activity->title}}" class="form-control" placeholder="请输入活动标题">
        <h4>活动内容</h4>
        <script id="content"  name="content" type="text/plain">{!!$activity->content!!}</script>

        <script type="text/javascript">
            var ue = UE.getEditor('content');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>

        <h4>活动开始时间</h4>
        <input type="datetime-local" value="{{$start_time}}" name="start_time" placeholder="请输入活动开始时间" class="form-control" >
        <h4>结束时间</h4>
        <input type="datetime-local" value="{{$end}}" name="endtime" placeholder="请输入活动停止时间" class="form-control" >{{csrf_field()}}
        <label for="exampleInputPassword1">请输入验证码</label>
        <input id="captcha" class="form-control" name="captcha" >
        <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default   ?'+Math.random()" title="点击图片重新获取验证码">
        <input type="submit" value="提交" class="btn btn-lg ">
        {{ method_field('patch') }}
        {{csrf_field()}}
    </div></form>


</body>
</html>