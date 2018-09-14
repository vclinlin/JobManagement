<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"D:\Vc_PHP\Apache24\htdocs\Bookstore\shop\public/../application/index\view\index\login.html";i:1528176578;s:75:"D:\Vc_PHP\Apache24\htdocs\Bookstore\shop\application\index\view\layout.html";i:1528141230;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录</title>
    <script src="__JQ__/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap.css">
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap-grid.css">
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap-reboot.css">
    <script src="__BOOTSTRAP__/js/bootstrap.bundle.js"></script>
    <script src="__BOOTSTRAP__/js/bootstrap.js"></script>
    <script src="__BOOTSTRAP__/popper.min.js"></script>
    <!--<script src="__JQ__/validate/dist/jquery.validate.js"></script>-->
    <!--<script src="__JQ__/validate/dist/localization/messages_zh.js"></script>-->
    
<script src="__JS__/index/login.js"></script>
<style>
    .error
    {
        color: red;
    }
</style>

</head>
<body>

<?php echo widget('widgets/head_nav'); ?>

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
            <h2>登录</h2>
            <form>
                <div class="form-group">
                    <label for="userid">账号:</label>
                    <input type="text" class="form-control" id="userid" placeholder="Enter userid">
                </div>
                <div class="form-group">
                    <label for="pass">密码:</label>
                    <input type="password" class="form-control" id="pass" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="captcha">验证码:<img id="captcha_img" src="<?php echo captcha_src(); ?>"  onclick="upCaptcha()" />
                        <span id="times" style="margin-left:10px;">180</span>s
                    </label>
                    <input type="text" class="form-control" id="captcha" placeholder="Enter captcha">
                </div>
                <button type="button" onclick="login()" class="btn btn-primary">登录</button>
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

</body>
</html>