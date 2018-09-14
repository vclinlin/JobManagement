<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:88:"D:\Vc_PHP\Apache24\htdocs\2018\ThinkPHP\public/../application/index\view\index\index.php";i:1527516960;s:72:"D:\Vc_PHP\Apache24\htdocs\2018\ThinkPHP\application\index\view\tpout.php";i:1527582006;}*/ ?>
<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"  content="width=device-width, user-scalable=no,
     initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>首页</title>
    <!--静态资源-->
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    <script src="__BOOTSTRAP__/js/jquery-3.2.1.min.js"></script>
    <script src="__BOOTSTRAP__/js/popper.min.js"></script>
    <script src="__BOOTSTRAP__/js/bootstrap.min.js"></script>
    <!--动态加载资源-->
    
<link rel="stylesheet" href="__CSS__/index/index.css">

</head>
<body>
<!--页面展示-->

<?php echo widget('widgets/nav');?>

  <!--调用组件方式2-->

<div class="row" id="Index_box" style="margin-top:60px;">
    <div class="col-lg-9">
    <?php echo widget('widgets/turns');?>
    </div>
    <div class="col-lg-3">
        <?php echo widget('widgets/walls');?>
    </div>
</div>

</body>
</html>
