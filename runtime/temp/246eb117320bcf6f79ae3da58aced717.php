<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:94:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\public/../application/zonghe\view\index\index.html";i:1524236629;}*/ ?>
<html>
    <head>
        <title>综合数据操作</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="__BOOTSTRAP__/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="__CSS__/zonghe/style.css">
        <script src="__BOOTSTRAP__/js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="__BOOTSTRAP__/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="__BOOTSTRAP__/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="__JQTEST__/dist/jquery.validate.min.js" type="text/javascript"></script>
        <script src="__JQTEST__/dist/localization/messages_zh.min.js" type="text/javascript"></script>
        <script src="__JS__/zonghe/main.js"></script>
    </head>
    <body>
        <div class="container-fluid">
        <div class="row">
        <div class="col-sm" style="background:#ccccff" id="Box">
        <div id="inputBox">
    <div class="container">
        <form onsubmit="return  false" id="forms">
    <div class="form-group">
      <label for="num">账号:</label>
      <input type="text" class="form-control" name="usernum" id="num">
    </div>
    <div class="form-group">
      <label for="usr">用户名:</label>
      <input type="text" class="form-control" name="username" id="usr">
    </div>
    <div class="form-group">
      <label for="pwd">密码:</label>
      <input type="password" class="form-control" name="pass" id="pwd">
    </div>
    <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" name="eml" id="email">
    </div>
    <div class="form-group">
    <label for="phone">电话:</label>
    <input type="text" class="form-control" name="phone" id="phone">
    </div>
    <div class="form-group" >
        <input type="submit" class="btn btn-info" value="确定">
    </div>
    </form>
    </div>
        </div>
            <div id="putBox">
<table class="table table-hover" id="userbook" style="text-align: center">
    <thead>
      <tr>
        <th>账号</th>
        <th>用户名</th>
        <th>邮箱</th>
        <th>电话</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
            </div>
        </div>
        </div>
        </div>
    </body>
</html>
