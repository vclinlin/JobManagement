<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:100:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\public/../application/admin\view\index\login.html";i:1528288162;}*/ ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台登录-X-admin2.0</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="__X-ADMIN__/css/font.css">
	<link rel="stylesheet" href="__X-ADMIN__/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="__X-ADMIN__/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="__X-ADMIN__/js/xadmin.js"></script>
    <script src="__JS__/admin/login.js"></script>

</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message">云课堂后台系统</div>
        <div id="darkbannerwrap"></div>
        
        <form onsubmit="return false" class="layui-form" >
            <input name="userid" placeholder="账号"  type="text"
                   id="userid"  class="layui-input" >
            <hr class="hr15">
            <input name="pass"  placeholder="密码" id="pass" type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" id="login" lay-submit lay-filter="login" style="width:100%;" type="button">
            <hr class="hr10 errors">
            <!--<lable for="login" class="error">1</lable>-->
            <hr class="hr10" >
        </form>
    </div>
</body>
</html>