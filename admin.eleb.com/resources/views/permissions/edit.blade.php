@include('layoutf.nav')


<div class="container">

    <table class="table table-striped table-hover" >
        <h1>添加权限</h1>
        <form method="post" action="{{route('permissions.update',[$permission])}}" enctype="multipart/form-data">
            <h4>权限名称</h4>
            <input type="text" name="name"  value="{{$permission->name}}" class="form-control" placeholder="请输入权限名字">
            {{csrf_field()}}
            {{ method_field('patch') }}
            <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">修改</button>


        </form>


    </table>


    <!-- Small modal -->


    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content">



            </div>
        </div>
    </div>


</div>