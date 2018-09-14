<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:93:"D:\Vc_PHP\Apache24\htdocs\Bookstore\shop\public/../application/index\view\index\reglogin.html";i:1528142219;s:75:"D:\Vc_PHP\Apache24\htdocs\Bookstore\shop\application\index\view\layout.html";i:1528141230;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注册</title>
    <script src="__JQ__/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap.css">
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap-grid.css">
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap-reboot.css">
    <script src="__BOOTSTRAP__/js/bootstrap.bundle.js"></script>
    <script src="__BOOTSTRAP__/js/bootstrap.js"></script>
    <script src="__BOOTSTRAP__/popper.min.js"></script>
    <!--<script src="__JQ__/validate/dist/jquery.validate.js"></script>-->
    <!--<script src="__JQ__/validate/dist/localization/messages_zh.js"></script>-->
    
<script src="__JS__/index/relogin.js"></script>
<style>
    .error{
        color:red;
    }
</style>
    
</head>
<body>


<?php echo widget('widgets/head_nav'); ?>
<!-- 头部 -->
<!-- logo -->
<div>
    <div class="row border-bottom">
    <div class="col-12">
        <nav class="navbar  navbar-expand-sm ">
            <div class="container">
            <a class="navbar-brand" href="/">
                <img class="img-fluid" src="__IMG__/logo.png" alt="javascript:">
            </a>
            </div>
        </nav>
    </div>
    </div>
</div>
<!-- 表单 -->
<div class=" bg-info">
    <div class="container py-lg-5">
        <div class="col-lg-6 bg-white p-4 ">
            <h2>注册</h2>
            <form  id="reFrom">
                <div class="form-group">
                    <label for="email">邮箱:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="username">用户名:</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="pass">密码:</label>
                    <input type="password" class="form-control" name="pass" id="pass" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="repass">二次密码:</label>
                    <input type="password" class="form-control" name="repass" id="repass" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="captcha">验证码:<img id="captcha_img" src="<?php echo captcha_src(); ?>"  onclick="reCaptcha()" />
                    <span id="times" style="margin-left:10px;">180</span>s
                    </label>
                    <input type="text" class="form-control" name="captcha" id="captcha" placeholder="Enter captcha">
                </div>
                <button type="button" onclick="relogin()"  class="btn btn-primary">注册</button>
            </form>
        </div>
    </div>
</div>
<!-- 关于 -->
<div class="col-12 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-12 text-white">
                关于预留位
            </div>
        </div>
    </div>
</div>
<div class="container">
    <!-- 模态框 -->
    <div class="modal fade" id="myModal" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h5 class="modal-title">注册成功</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- 模态框主体 -->
                <div class="modal-body">
                    模态框内容..
                </div>

                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                </div>

            </div>
        </div>
    </div>

</div>

</body>
</html>