<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:108:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\public/../application/index\view\teachers\department.html";i:1530854994;s:85:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\application\index\view\layout.html";i:1530754984;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<title>我的系部</title>

    <script src="__JQ__/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap.css">
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap-grid.css">
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap-reboot.css">
    <script src="__BOOTSTRAP__/js/bootstrap.bundle.js"></script>
    <script src="__BOOTSTRAP__/js/bootstrap.js"></script>
    <script src="__BOOTSTRAP__/popper.min.js"></script>
    <script src="__JS__/layer/layer.js"></script>
    <script src="__JS__/index/teachers/main.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    
<style>

</style>

</head>
<body>

<!-- 导航栏 -->
<?php echo widget('widgets/teachers'); ?>
<!-- 发言板块 -->
<div class="box line-one container">
    <div class="row">
        <div class="box-head bg-light col-12">
            >系部交流
        </div>
        <div class="box-body col-12" style="margin-top: 10px;">
            <div class="card">
                <div class="card-header">教师A <small>2018-07-04 23:59</small></div>
                <div class="card-body">内容</div>
                <button type="button" class="btn btn-light btn-sm"
                        data-toggle="collapse" data-target="#reply1">展开回复</button>
                <div id="reply1" class="collapse card-body">
                    <button type="button" class="btn btn-sm btn-light btn-block">回复</button>
                    <div class="row" style="border-bottom: 1px beige solid">
                        <div class="col-12">教师A <small>[2018-07-04 23:59]:</small></div>
                        <div class="col-12" >
                            {}
                        </div>
                    </div>
                    <div class="row" style="border-bottom: 1px beige solid">
                        <div class="col-12">教师A <small>[2018-07-04 23:59]:</small></div>
                        <div class="col-12" >
                            {}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fixed-bottom container">
        <textarea id="speak" style="resize:none;"
                  class="border-dark col-12" rows="5" maxlength="512" placeholder="在此输入你的内容,512字符以内"></textarea>
    <button type="button" class="btn btn-primary btn-block" onclick="speak()">提交</button>
</div>
<script>
    function speak() {
        console.log($("#speak")[0].value);
    }
</script>

</body>
</html>