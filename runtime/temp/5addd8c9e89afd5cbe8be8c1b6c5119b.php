<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\public/../application/mvc2\view\index\index.html";i:1523412767;}*/ ?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <table border="1">
            <tr>
                <td>序列</td>
                <td>姓名</td>
                <td>学号</td>
            </tr>
            <?php if(is_array($rows) || $rows instanceof \think\Collection || $rows instanceof \think\Paginator): $i = 0; $__LIST__ = $rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><?php echo $row['Id']; ?></td>
                <td><?php echo $row['names']; ?></td>
                <td><?php echo $row['numbers']; ?></td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </body>
</html>
