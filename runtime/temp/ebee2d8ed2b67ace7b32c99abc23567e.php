<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\public/../application/ip\view\index\index.html";i:1523844302;}*/ ?>
<html>
    <head>
    <title>注入数据</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/static/bootstrap4.0/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/bootstrap4.0/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/bootstrap4.0/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="/static/bootstrap4.0/js/jquery-3.2.1.min.js"></script>
    <script src="/static/bootstrap4.0/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="/static/bootstrap4.0/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
            function Sub()
            {
            var names = $("#usr").val();
            var num = $("#pwd").val();
            $.ajax({
                url: "/ip/index/insert",
                data: {'names':names,'num':num},
                dataType: 'json',
                type: 'POST',
                success: function (rel) {
                        if(rel.zt == 1)
                        {
                            document.getElementById("usr").value="";
                            document.getElementById("pwd").value="";
                            alert(rel.re);
                        }
                    },
                    error: function () {
                        alert("连接服务器超时");
                    }
                
            });
            }
            function showAll()
            {
                window.open("/ip/index/showAll");
            }
    </script>
    <style>
        body{
            padding:300px;
            padding-top:0;
        }
        @media screen and (max-width:1024px)
        {
            body{
            padding:2px;
            padding-top:0;
        }
        }
    </style>
    </head>
    <body>
<div class="container-fluid">
  <div class="row">
      <div class="col-sm" style="background-color:lavender;">
    <div class="form-group">
      <label for="usr">用户名:</label>
      <input type="text" class="form-control" id="usr">
    </div>
    <div class="form-group">
      <label for="pwd">学号</label>
      <input type="text" class="form-control" id="pwd">
    </div>
          <button type="button" class="btn btn-info" onclick="Sub()">写入</button>
          <button type="button" class="btn btn-info" onclick="showAll()" >显示</button>
      </div>
  </div>
</div>
    </body>
</html>
