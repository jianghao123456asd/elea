<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
<div class="container">
    <form action="/student/save" method="post">
        <div>
            <label >用户名</label>
            <input type="text" name="name" placeholder="请输入用户名" />
        </div>

        <div class="box1">
            <label >年龄</label>
            <input type="text" name="age" placeholder="请输入年龄">
        </div>

        <div class="box3"><input name="sex" type="radio" value="男" />男
            <input name="sex" type="radio" value="女" />女
        </div>
        {{csrf_field()}}
        <div class="box4">
            <button   type="submit" class="btn btn-default">注册</button>
        </div>
    </form>
</div>