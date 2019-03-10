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


<form method="post" action="{{route('eventprizes.update',[$ep->id])}}" >
    <div class="container">
        <h4>商品名称</h4>
        <input type="text" name="name" value="{{$ep->name}}" class="form-control" placeholder="请输入奖品名称">

        {{ method_field('patch') }}
        <h4>商品名称</h4>
        <select id="menu-parent_id" class="form-control" name="events_id" aria-required="true">
            <option value="{{$ep->events_id}}">{{$ep->et->title}}</option>
            @foreach($hds as $hd)
                <option value="{{$hd->id}}">{{$hd->title}}</option>
            @endforeach
        </select>
        <h4>活动详情</h4>
        <input type="text" value="{{$ep->description}}" name="description" class="form-control" placeholder="请输入活动详情">

        <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">提交</button>
        {{csrf_field()}}
    </div></form>


</body>
</html>