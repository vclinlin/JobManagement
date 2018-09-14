<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\public/../application/home\view\index\test.html";i:1524794664;}*/ ?>
<html>
    <head>
        <title>测试</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="__BOOTSTRAP__/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="__BOOTSTRAP__/js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="__BOOTSTRAP__/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="__BOOTSTRAP__/js/bootstrap.min.js" type="text/javascript"></script>
        <style>
            .row
            {
                padding: 0;
            }
            .row div
            {
                width: 50%;
                float: left;
            }
            .row div:nth-child(1)
            {
                
            }
        </style>
        <script>
            $(function (){
               var heightW = $(".logos").find("div").eq(1).css('height');
               alert(heightW);
            });
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm bg-dark text-white logos">
                    <div>1</div>
                    <div>2</div>
                </div>
            </div>
        </div>
    </body>
</html>
