<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:92:"D:\Vc_PHP\Apache24\htdocs\2018\ThinkPHP\public/../application/index\view\index\loginview.php";i:1527528479;s:72:"D:\Vc_PHP\Apache24\htdocs\2018\ThinkPHP\application\index\view\tpout.php";i:1527582006;}*/ ?>
<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"  content="width=device-width, user-scalable=no,
     initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录</title>
    <!--静态资源-->
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    <script src="__BOOTSTRAP__/js/jquery-3.2.1.min.js"></script>
    <script src="__BOOTSTRAP__/js/popper.min.js"></script>
    <script src="__BOOTSTRAP__/js/bootstrap.min.js"></script>
    <!--动态加载资源-->
    
<link rel="stylesheet" href="__CSS__/index/loginview.css">
<script src="__JS__/index/loginview.js"></script>

</head>
<body>
<!--页面展示-->

<?php echo widget('widgets/nav')?>
<div class="row" style="margin-top:60px;" id="Login_io">
    <div class="col-12" style="padding:0;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index">首页</a></li>
            <li class="breadcrumb-item active" aria-current="page">登录</li>
        </ol>
    </div>
    <div class="col-12">
    <div class="container" id="loginFrom">
        <h2>登录</h2>
        <div class="form-group">
            <label for="userid">账号:</label>
            <input type="text" class="form-control" id="userid" placeholder="Enter userid">
        </div>
        <div class="form-group">
            <label for="pwd">密码:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password">
        </div>
        <div class="form-group">
            <label for="captcha">验证码: <img id="captcha_img" src="<?php echo captcha_src(); ?>" onclick="ReCaptcha()" ></label>
            <input type="text" class="form-control" id="captcha" placeholder="Enter captcha">
        </div>
        <button type="button" onclick="LoginFrom()" class="btn btn-primary">确认</button>
    </div>
    </div>
</div>



</body>
</html>
