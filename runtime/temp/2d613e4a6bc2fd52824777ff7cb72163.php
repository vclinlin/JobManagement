<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:93:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\public/../application/muban\view\index\index.html";i:1526142014;s:77:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\application\muban\view\tpout.html";i:1526261353;}*/ ?>


<html>
<head>
    <title>模板首页</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="__BOOTSTRAP__/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
    <link href="__BOOTSTRAP__/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
    <link href="__BOOTSTRAP__/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="__CSS__/muban/index.css">
    <script src="__BOOTSTRAP__/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="__BOOTSTRAP__/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="__BOOTSTRAP__/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="__JS__/muban/echarts.min.js" type="text/javascript"></script>
    <script src="__JS__/muban/main.js" type="text/javascript"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top">
  <!-- Brand -->
  <a class="navbar-brand logos" href="#" onclick="xgUser();return false;"><?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><?php echo $row['names']; endforeach; endif; else: echo "" ;endif; ?></a>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
 
  <!-- Navbar links -->
  <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
    <ul class="navbar-nav nav-text">
      <li class="nav-item">
        <a class="nav-link text-white" href="/muban/index/saved">账单</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#">统计</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#">钱包</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#">日记</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white"  href="/muban/index/exits" >退出</a>
      </li>
    </ul>
  </div> 
</nav>
<div class="row">
    <div class="col-sm">
<div id="demo" class="carousel slide" data-ride="carousel">
 
  <!-- 指示符 -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
    <li data-target="#demo" data-slide-to="3"></li>
  </ul>
 
  <!-- 轮播图片 -->
  <div class="carousel-inner">
     <div class="carousel-item active">
        <img class="li-imgs" src="__CSS__/muban/images/timg.jpg" alt=""/>
    </div>
    <div class="carousel-item">
        <img class="li-imgs" src="__CSS__/muban/images/timg1.jpg" alt=""/>
    </div>
    <div class="carousel-item">
        <img class="li-imgs" src="__CSS__/muban/images/timg2.jpg" alt=""/>
    </div>
    <div class="carousel-item">
        <img class="li-imgs" src="__CSS__/muban/images/timg3.jpg" alt=""/>
    </div>
  </div>
  </div>
  </div>
</div>
    <div class="row" style="padding:0">
        <div class="col-sm-6"  style="padding:0">
            <div class="col-sm bg-secondary text-white text-center" id="xfTitle"  style="margin: 0;">消费情况分析</div>
            <div class="col-sm bg-light" id="xfChart"  style="margin: 0;"></div>
        </div>
        <div class="col-sm-6"  style="padding:0">
            <div class="col-sm bg-secondary text-white text-center" id="dateTitle" style="margin: 0;">近期消费预览</div>
            <div class="col-sm bg-light" id="dateChart"  style="margin: 0;"></div>
        </div>
    </div>
</body>
<div class="modal" id="XgModal" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
 
      <!-- 模态框头部 -->
<div class="modal-header">
        <h4 class="modal-title">Loading....</h4>
        <button type="button" class="close" data-dismiss="modal"  >&times;</button>
</div>
      <!-- 模态框主体 -->
<div class="modal-body">
    <div class="form-group">
      <label for="username">用户名:</label>
      <input type="text" class="form-control" id="username" value="网络开小差了！" >
    </div>
    <div class="form-group">
        <label for="user">帐号<small style="color: red;">(账号不可被更改)</small></label>
      <input type="text" class="form-control" id="user" value="连接不上啊"  readonly="readonly">
    </div>
    <div class="form-group">
      <label for="pwd">原密码:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password">
    </div>
    <div class="form-group">
      <label for="newPwd">新密码:</label>
      <input type="password" class="form-control" id="newPwd" placeholder="Enter new password">
    </div>
    <div class="form-group">
      <label for="newPwds">确认密码:</label>
      <input type="password" class="form-control" id="newPwds" placeholder="Enter new password">
    </div>
    <div class="form-check">
      <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="onlyName"> 仅用户名
      </label>
    </div>
</div>
      <!-- 模态框底部 -->
<div class="modal-footer">
    <button type="button" onclick="xgPass()" class="btn btn-secondary">确定</button>
</div>

    </div>
  </div>
</div>
</html>
    
