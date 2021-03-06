<!DOCTYPE html>
<html lang="en">
@include('layoutf.nav')
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="/jquery.js"></script>
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
</head>




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
            <h1>添加分类</h1>
            <form method="post" action="{{route('shopCategorys.store')}}" enctype="multipart/form-data">
              <h4>分类名</h4>
                <input type="text" name="name" class="form-control" placeholder="请输入分类名字">

                <h4>商品状态</h4>
            <input type="radio" name="status" value="1"/> 是
                <input type="radio" name="status" value="0"/> 否

                <h4>分类图片</h4>
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <input type="hidden" name="img" id="img_val">
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                    <img src="" id="img" />
                </div>

                <div class="form-group">




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