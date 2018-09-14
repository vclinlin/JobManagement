<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:93:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\public/../application/muban\view\index\login.html";i:1526140619;s:77:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\application\muban\view\tpout.html";i:1526261353;}*/ ?>


<html>
    <head>
        <title>登录</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="__BOOTSTRAP__/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="__BOOTSTRAP__/js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="__BOOTSTRAP__/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="__JS__/muban/main.js" type="text/javascript"></script>
        <style>
            body
            {
                padding: 0;
                margin: 0;
                background-image:url('__CSS__/muban/images/login.jpg');
                background-size: cover;
            }
        </style>
    </head>
<body>
<div class="modal" id="myModal" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
 
      <!-- 模态框头部 -->
<div class="modal-header">
        <h4 class="modal-title">用户登录</h4>
</div>
 
      <!-- 模态框主体 -->
<div class="modal-body">
    <div class="form-group">
      <label for="user">帐号:</label>
      <input type="text" class="form-control" id="user" placeholder="Enter user">
    </div>
    <div class="form-group">
      <label for="pwd">密码:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password">
    </div>
</div>
      <!-- 模态框底部 -->
<div class="modal-footer">
    <button type="button" id="butA"  class="btn btn-secondary">注册</button>
    <button type="button" id="butB" class="btn btn-secondary">登录</button>
</div>

    </div>
  </div>
</div>
    </body>
</html>
    
