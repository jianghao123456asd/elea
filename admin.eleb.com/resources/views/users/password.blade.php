@include('layoutf.nav')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">

        <table class="table table-striped table-hover" >
            <h1>修改用户密码</h1>
            <form method="post"  action="{{route('user.add',[$user])}}" enctype="multipart/form-data">

                <h4>新密码</h4>
                <input type="password"  name="password" class="form-control" placeholder="请输入新密码">






                {{csrf_field()}}



                <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">提交</button>
    </div>

    </form>


    </table>


    <!-- Small modal -->





</div>
</div>
</div>

</div>


</div>


</body>
</html>