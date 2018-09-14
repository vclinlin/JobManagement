<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\public/../application/ip\view\index\showall.html";i:1523844091;}*/ ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <title>数据显示</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/static/bootstrap4.0/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/bootstrap4.0/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/bootstrap4.0/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="/static/bootstrap4.0/js/jquery-3.2.1.min.js"></script>
    <script src="/static/bootstrap4.0/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="/static/bootstrap4.0/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
<div class="container">        
  <table class="table table-striped">
    <thead>
      <tr>
        <th>序号</th>
        <th>用户名</th>
        <th>学号</th>
        <th>来源ip</th>
        <th>写入时间</th>
      </tr>
    </thead>
    <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo $row['Id']; ?></td>
            <td><?php echo $row['names']; ?></td>
            <td><?php echo $row['num']; ?></td>
            <td><?php echo $row['ip']; ?></td>
            <td><?php echo date("Y-m-d H:i:s",$row['time']); ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
</div>
    </body>
</html>
