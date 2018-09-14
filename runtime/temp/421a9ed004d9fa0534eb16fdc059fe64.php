<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:93:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\public/../application/muban\view\index\saved.html";i:1526140541;s:77:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\application\muban\view\tpout.html";i:1526261353;}*/ ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>记账</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="__BOOTSTRAP__/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="__BOOTSTRAP__/js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="__BOOTSTRAP__/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="__BOOTSTRAP__/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="__JS__/muban/echarts.min.js" type="text/javascript"></script>
        <link href="__CSS__/muban/saved/saved.css" rel="stylesheet" type="text/css"/>
        <script src="__JS__/muban/saved.js" type="text/javascript"></script>
    </head>
    <body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="/muban/index/saved">账单</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" href="" onclick="XzModal();return false; " >新增</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">统计</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">日记</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">钱包</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="/muban">首页</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/muban/index/exits">退出</a>
      </li>
    </ul>
  </div>  
</nav>
<div class="container-fluid">
<div class="row">
<div class="col-sm" id="table-ZD">  <!-- 支出收入位 -->
<table class="table text-center" >
    <thead>
      <tr>
          <th colspan="4">支出/收入分析</th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="4">你暂时没有任何帐单</td>
        </tr>
    </tbody>
  </table>
</div>
</div>
<div class="row">
    <div class="col-sm"><!-- 详细帐单位 -->
        <table class="table table-striped text-center" id="table-XX">
        <thead>
          <tr>
              <th colspan="6">详细帐单</th>
          </tr>
        </thead>
        <tbody  >
            <tr>
                <td colspan="6">你暂时没有任何帐单</td>
            </tr>
        </tbody>
      </table>
    </div>
</div>
</div>
<div class="modal fade" id="myModal" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
 
      <!-- 模态框头部 -->
      <div class="modal-header">
        <h4 class="modal-title">模态框头部</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
 
      <!-- 模态框主体 -->
      <div class="modal-body">
          <div class="row">
              <div class="col-6 text-center"><input type="radio" name="ifxf" value="支出" checked="checked" />支出</div>
              <div class="col-6 text-center"><input type="radio" name="ifxf" value="收入" />收入</div>
          </div>
          <div class="row" style="margin-top: 8px;">
            <div class="form-control col-sm">
            <label for="xfsell">消费/支出:</label>   <!--消费类别预留位-->
              <select  class="form-control" id="xfsell" size="3">
                <option>1</option>
              </select>
            <label for="dates">日期:</label>
            <input type="date" class="form-control" id="dates" placeholder="Enter date">
            <label for="rmb">金额:</label>
            <input type="text" class="form-control" id="rmb">
            </div>
          </div>
      </div>
 
      <!-- 模态框底部 -->
      <div class="modal-footer">
          <button type="button" id="xzbtu" class="btn btn-secondary">确定</button>
      </div>
 
    </div>
  </div>
</div>
        
        <!--  -->
<div class="modal fade" id="xxModal" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
 
      <!-- 模态框头部 -->
      <div class="modal-header">
        <h4 class="modal-title">模态框头部</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
 
      <!-- 模态框主体 -->
      <div class="modal-body">
          
      </div>
 
      <!-- 模态框底部 -->
      <div class="modal-footer">
          <button type="button"  class="btn btn-secondary">确定</button>
      </div>
 
    </div>
  </div>
</div>
    </body>
</html>
    
