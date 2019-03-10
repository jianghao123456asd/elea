@include('layoutf.nav')

<div class="container">

    <table class="table table-striped table-hover" >
        <h1>添加菜单</h1>
        <form method="post" action="{{route('navs.store')}}" enctype="multipart/form-data">
            <h4>菜单名</h4>
            <input type="text" value="" name="name" class="form-control" placeholder="请输入菜单名字">
            {{csrf_field()}}
            <h4>上级菜单</h4>

            <select id="menu-parent_id" class="form-control" name="pid" aria-required="true">
                <option value="">=请选择上级菜单=</option>
                <option value="0">顶级菜单</option>
               @foreach($pid as $pi)
                    <option value="{{$pi->id}}">{{$pi->name}}</option>

                   @endforeach
            </select>
            <h4>权限</h4>
            <select id="menu-parent_id" class="form-control" name="Permission" >
                @foreach($psa as $pa)
                    <option value="{{$pa->id}}">{{$pa->name}}</option>
                @endforeach
            </select>




            <p class="help-block help-block-error"></p>
<div class="form-group field-menu-url">
    <label class="control-label" for="menu-url">地址/路由</label>
    <input type="text" value="" name="url" class="form-control" placeholder="请输入权限名字">
    <button class="btn            btn-lg btn-primary btn-block" style="width: 100px" type="submit">提交</button>
</div> </form>


    </table>


    <!-- Small modal -->




</div>