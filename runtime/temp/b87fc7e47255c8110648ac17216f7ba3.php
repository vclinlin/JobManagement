<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\public/../application/mvc2\view\ca\Ca.html";i:1523411437;}*/ ?>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <table border="1">
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?>
    <tr>
        <td><?php echo $row['Id']; ?></td>
        <td><?php echo $row['names']; ?></td>
        <td><?php echo $row['numbers']; ?></td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    </body>
</html>
