<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"D:\Vc_PHP\Apache24\htdocs\Bookstore\shop\public/../application/index\view\index\index.html";i:1528087620;s:75:"D:\Vc_PHP\Apache24\htdocs\Bookstore\shop\application\index\view\layout.html";i:1528141230;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="__JQ__/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap.css">
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap-grid.css">
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap-reboot.css">
    <script src="__BOOTSTRAP__/js/bootstrap.bundle.js"></script>
    <script src="__BOOTSTRAP__/js/bootstrap.js"></script>
    <script src="__BOOTSTRAP__/popper.min.js"></script>
    <!--<script src="__JQ__/validate/dist/jquery.validate.js"></script>-->
    <!--<script src="__JQ__/validate/dist/localization/messages_zh.js"></script>-->
    
    <link rel="stylesheet" href="__CSS__/index/index.css">
    
</head>
<body>


<!---->
<!-- 头部 -->
<div class="container-fluid bg-light">
    <div class="row">
        <div class="col-12 bg-light">
            <?php echo widget('widgets/head_nav'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 bg-white">
            <!--搜索预留位-->
            <?php echo widget('widgets/retrieval'); ?>
        </div>
    </div>
</div>
<div class="col-12 bg-dark">
    <div class="container">
        <div class="row">
        <div class="col-12 text-white">
            nav预留位
        </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-info">
    轮播预留位
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            新品预留位
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            销量排行榜预留位
        </div>
    </div>
</div>
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