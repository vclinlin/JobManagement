<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\public/../application/fenye\view\index\index.html";i:1524300129;}*/ ?>
<html>
    <head>
        <title>首页</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="__BOOTSTRAP__/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="__BOOTSTRAP__/js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="__BOOTSTRAP__/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="__BOOTSTRAP__/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="__JS__/fenye/main.js" type="text/javascript"></script>
        <style>
            #Nav{
                width: 200px;
                height:100%;
                position:fixed;
                z-index:2;
                right: -200px;
                top:0;
            }
        </style>
    </head>
    <body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top" id="HomeNav">
  <a class="navbar-brand" href="#">SCITC</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" onclick="openNav()" >
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" >
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        关于川信
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">学院简介</a>
        <a class="dropdown-item" href="#">机构设置</a>
        <a class="dropdown-item" href="#">现任领导</a>
        <a class="dropdown-item" href="#">办学特色</a>
        <a class="dropdown-item" href="#">学院视频</a>
        <a class="dropdown-item" href="#">校园导游</a>
      </div>
    </li>
      <li class="nav-item">
        <a class="nav-link" href="#">专业设置</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">招生就业</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">人才引进</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="#">人文川信</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">信息公开</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">联系我们</a>
      </li>
    </ul>
  </div>  
	</nav>
        <div id="Nav" class="bg-dark"></div>
    </body>
</html>
