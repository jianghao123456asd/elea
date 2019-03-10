@include('layoutf.nav')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="/jquery.js"></script>
<!--引入CSS-->
<link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

<!--引入JS-->
<script type="text/javascript" src="/webuploader/webuploader.js"></script>

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
            <h1>添加商家信息</h1>
            <form method="post" action="{{route('shops.store')}}" enctype="multipart/form-data">
                <h4>店铺名称</h4>

                <input type="text" name="shop_name" class="form-control" placeholder="请输入店铺名称">
                <h4>店铺分类</h4>
                <select name="shop_category_id" id="">

                    <option value="">请选择分类</option>
                    @foreach($ShopCategorys as  $ShopCategory)
                        <option value="{{$ShopCategory->id}}">{{$ShopCategory->name}}</option>
                    @endforeach
                </select>

                <h4>店铺头像</h4>
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <input type="hidden" name="img" id="img_val">
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                    <img src="" id="img" />

                </div>
                <h4>起送金额</h4>
                <input type="text" name="start_send" class="form-control" placeholder="请输入起 送金额">
                <h4>配送费</h4>
                <input type="text" name="send_cost" class="form-control" placeholder="请输入配送费">
                <h4>店铺公告</h4>

                <input type="text" name="notice" class="form-control" placeholder="请输入店铺公告">
                <h4>店铺优惠信息</h4>

                <input type="text" name="discount" class="form-control" placeholder="请输入店铺优惠信息">
                <h4>评分</h4>
                <input type="text" name="shop_rating" class="form-control" placeholder="请输入评分">
                <h4>是否是品牌</h4>
                <input type="radio" name="brand" value="1"/> 是
                <input type="radio" name="brand" value="0"/> 否
                <h4>是否准时送达</h4>
                <input type="radio" name="on_time" value="1"/> 是
                <input type="radio" name="on_time" value="0"/> 否
                <h4>是否蜂鸟配送</h4>
                <input type="radio" name="fengniao" value="1"/> 是
                <input type="radio" name="fengniao" value="0"/> 否
                <h4>是否保标记</h4>
                <input type="radio" name="bao" value="1"/> 是
                <input type="radio" name="bao" value="0"/> 否
               <h4>是否票标记</h4>
                <input type="radio" name="piao" value="1"/> 是
                <input type="radio" name="piao" value="0"/> 否
                <div class="form-group">

          <h4>是否准标记</h4>
                    <input type="radio" name="zhun" value="1"/> 是
                    <input type="radio" name="zhun" value="0"/> 否
                    <h1>注册商家用户账号</h1>
                    <h4>用户名</h4>
                    <input type="text" name="name" class="form-control" placeholder="请输入用户名字">
                    <h4>密码</h4>
                    <input type="password" name="password" class="form-control" placeholder="请输入密码">
                    <h4>邮箱</h4>
                    <input type="text" name="email" class="form-control" placeholder="请输入邮箱">





                    {{csrf_field()}}

                    <label for="exampleInputPassword1">请输入验证码</label>
                    <input id="captcha" class="form-control" name="captcha" >
                    <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default   ?'+Math.random()" title="点击图片重新获取验证码">
                    <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">添加</button>
                </div>
            </form>
            <script>
                // 初始化Web Uploader
                var uploader = WebUploader.create({

                    // 选完文件后，是否自动上传。
                    auto: true,

                    // swf文件路径
                    //swf: '/js/Uploader.swf',

                    // 文件接收服务端。
                    server: '/upload',

                    // 选择文件的按钮。可选。
                    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                    pick: '#filePicker',

                    // 只允许选择图片文件。
                    accept: {
                        title: 'Images',
                        extensions: 'gif,jpg,jpeg,bmp,png',
                        mimeTypes: 'image/*'
                    },
                    //设置上传请求参数
                    formData:{
                        _token:'{{ csrf_token() }}'
                    }
                });
                //监听上传成功事件
                uploader.on( 'uploadSuccess', function( file,response ) {
                    // do some things.
                    console.log(response.path);
                    //图片回显
                    $("#img").attr('src',response.path);
                    //图片地址写入隐藏域
                    $("#img_val").val(response.path);
                });
            </script>



        </table>


        <!-- Small modal -->


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


</div>


</body>
</html>