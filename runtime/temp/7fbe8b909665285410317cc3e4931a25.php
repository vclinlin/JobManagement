<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:97:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\public/../application/index\view\students\index.html";i:1536908768;s:79:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\application\index\view\layout.html";i:1536908768;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<title>学生首页</title>

    <script src="__JQ__/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap.css">
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap-grid.css">
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="__CSS__/index/teachers/main.css">
    <script src="__BOOTSTRAP__/js/bootstrap.bundle.js"></script>
    <script src="__BOOTSTRAP__/js/bootstrap.js"></script>
    <script src="__BOOTSTRAP__/popper.min.js"></script>
    <script src="__JS__/layer/layer.js"></script>
    <script src="__JS__/index/teachers/main.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    
<style>
    .Vcard > .card-body
    {
        border-radius:25px;
        cursor: pointer;
    }
    .Vcard > .card-body:hover
    {
        background:#e2e3e5;

    }
</style>

</head>
<body>

<?php echo widget('widgets/students'); ?>
<div class="container bg-light">
    <div class="row" style="padding:20px 0 20px 0;">
        <div class="col-lg-4" style="border-bottom: #1AA093 solid 1px">
            <div class="media">
                <img src="__IMG__/logo.png" class="align-self-center img-fluid img-thumbnail mr-3"
                     style="width:100px">
                <div class="media-body">
                    <?php if(is_array($Details) || $Details instanceof \think\Collection || $Details instanceof \think\Paginator): $i = 0; $__LIST__ = $Details;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Details): $mod = ($i % 2 );++$i;?>
                    <h4>您好,<?php echo $Details['name']; ?> </h4>
                    <dd>学号:<?php echo $Details['number']; ?></dd>
                    <dd>班级:<?php echo $Details['ClassName']; ?></dd>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            <div class="container" style="margin-top: 10px;">
                <dd class="text-secondary"><i class="fa fa-envelope-o" style="font-size:15px"></i>-作业消息0条</dd>
                <dd class="text-secondary"><i class="fa fa fa-pencil-square-o" style="font-size:15px"></i>-未交作业0条</dd>
            </div>
        </div>
        <div class="col-lg-8" style="border-bottom: #1AA093 solid 1px">
            <div class="row text-center Vcard">
                <div class="col-4 card-body">
                    <i class="fa fa-vcard-o" style="font-size:30px;color:red"></i>
                    <p>个人中心</p>
                </div>
                <div class="col-4 card-body" data-url="/index/students/course" onclick="OpenUrl(this)">
                    <i class="fa fa-calendar-check-o" style="font-size:30px;color:red"></i>
                    <p>我的课程</p>
                </div>
                <div class="col-4 card-body">
                    <i class="fa fa-clock-o" style="font-size:30px;color:red"></i>
                    <p>待交作业</p>
                </div>
                <div class="col-4 card-body">
                    <i class="fa fa-envelope-o" style="font-size:30px;color:red"></i>
                    <p>已批作业</p>
                </div>
                <div class="col-4 card-body">
                    <i class="fa fa-folder-open-o" style="font-size:30px;color:red"></i>
                    <p>课程资料</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin: 0 0 10px 0">
        <div class="col-md-4">1</div>
        <div class="col-md-4">2</div>
        <div class="col-md-4">3</div>
    </div>
    <div class="row">
        <div class="col text-center bg-info text-white">尾部</div>
    </div>
</div>

</body>
</html>