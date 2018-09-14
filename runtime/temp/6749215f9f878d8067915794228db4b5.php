<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\public/../application/wedit\view\index\index.html";i:1525018778;}*/ ?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="__BOOTSTRAP__/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
        <link href="__BOOTSTRAP__/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="__BOOTSTRAP__/js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="__BOOTSTRAP__/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="__BOOTSTRAP__/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="__WED__/release/wangEditor.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(function (){
        var E = window.wangEditor;
        var editor = new E('#editor');
        editor.customConfig.uploadImgShowBase64 = true   // 使用 base64 保存图片
        editor.create();//创建
        $("#btn1").click(function (){
            var htmlStr=editor.txt.html();
            $.ajax({
               url: "/wedit/index/rec",
               type: 'POST',
               dataType: '{"field": "value"}',
               data: {"cont":htmlStr},
               success: function (data, textStatus, jqXHR) {
                        
                    }
            });
        });
        $("#btn2").click(function (){
            var Str=editor.txt.text();
            $.ajax({
               url: "/wedit/index/rec",
               type: 'POST',
               dataType: 'json',
               data: {"cont":Str},
               success: function (data, textStatus, jqXHR) {
                        alert(data);
                    }
            });
        });
        });
        </script>
    </head>
    <body>
        <div id="editor">
        <p>欢迎使用 wangEditor 富文本编辑器</p>
        </div>
        <button id="btn1">获取html</button>
        <button id="btn2">获取text</button>
    </body>
</html>
