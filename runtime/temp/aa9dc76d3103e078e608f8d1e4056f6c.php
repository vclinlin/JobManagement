<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"D:\Vc_PHP\Apache24\htdocs\2018\ThinkPHP\public/../application/index\view\index\regview.php";i:1527528553;s:72:"D:\Vc_PHP\Apache24\htdocs\2018\ThinkPHP\application\index\view\tpout.php";i:1527582006;}*/ ?>
<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"  content="width=device-width, user-scalable=no,
     initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注册</title>
    <!--静态资源-->
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    <script src="__BOOTSTRAP__/js/jquery-3.2.1.min.js"></script>
    <script src="__BOOTSTRAP__/js/popper.min.js"></script>
    <script src="__BOOTSTRAP__/js/bootstrap.min.js"></script>
    <!--动态加载资源-->
    
<link rel="stylesheet" href="__CSS__/index/regview.css">
<script src="__JS__/index/regview.js"></script>

</head>
<body>
<!--页面展示-->

<?php echo widget('widgets/nav')?>

<div class="row" style="margin-top:60px;" id="Items_io">
    <div class="col-12" style="padding:0;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index">首页</a></li>
            <li class="breadcrumb-item active" aria-current="page">注册</li>
        </ol>
    </div>
    <div class="col-12">
        <div class="container" id="RegForm">
            <h2>注册</h2>
            <dd class="small">请填写以下内容,完成账号注册：</dd>
            <div class="form-group">
                <label for="usr">用户名:</label>
                <input type="text" class="form-control" id="usr" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="file0">头像:</label>
                <input type="file" class="form-control" name="file0" id="file0" multiple="multiple" />
                <img src="" id="img0" >
            </div>
            <div class="form-group">
                <label for="email">邮箱:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="pwd">密码:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password">
            </div>
            <div class="form-group">
                <label for="pwds">再次输入密码:</label>
                <input type="password" class="form-control" id="pwds" placeholder="Enter password">
            </div>
            <div class="form-group">
                <label for="captcha">验证码: <img id="captcha_img" src="<?php echo captcha_src(); ?>" onclick="ReCaptcha()" ></label>
                <input type="text" class="form-control" id="captcha" placeholder="Enter captcha">
            </div>
            <button type="button" onclick="RegFrom()" class="btn btn-primary">确认</button>
        </div>
    </div>
</div>


</body>
</html>
