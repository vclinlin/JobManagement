<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\public/../application/modal\view\index\index.html";i:1524465717;}*/ ?>
<html>
    <head>
        <title>模态框</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="__BOOTSTRAP__/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="__BOOTSTRAP__/js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="__BOOTSTRAP__/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="__BOOTSTRAP__/js/bootstrap.min.js" type="text/javascript"></script>
        <script>
            function Modal(str)
            {
                $(".modal-title").html(str);
            }
        </script>
    </head>
    
    <body>
<div class="container">
  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal" onclick="Modal('修改')">修改</button>
  <button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModal" onclick="Modal('展示')">展示</button> 
</div>
        
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
 
      <!-- 模态框头部 -->
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
 
      <!-- 模态框主体 -->
      <div class="modal-body">
        
      </div>
    </div>
  </div>
</div>
    </body>
</html>
