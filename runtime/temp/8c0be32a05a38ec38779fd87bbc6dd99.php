<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:105:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\public/../application/index\view\student\mycourse.html";i:1532255872;s:85:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\application\index\view\layout.html";i:1531482937;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<title>我的课程</title>

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
    


</head>
<body>

<?php echo widget('widgets/students'); ?>
<div class="line-one container">
    <div class="d-flex flex-wrap">
        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
        <div class="col-lg-2 card-top col-sm-3 col-6 p-sm-2" title="<?php echo $data['name']; ?>">
            <div class="card" data-url="/index/students/courseDetails?id=<?php echo $data['Id']; ?>&key=<?php echo $data['name']; ?>" onclick="OpenUrl(this)">
                <div class="card-body">
                    <img src="<?php echo $data['img_url']==''?'__IMG__/cover/DefaultCover.jpg':$data['img_url']; ?>" class="w-100" style="height:169px">   <!-- 封面 -->
                </div>
                <div class="card-footer text-center">
                    <marquee direction="left"  scrollamount="3">
                        <?php echo $data['name']; ?>
                    </marquee>
                </div>    <!-- 课程名 -->
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <ul class="text-dark container d-flex justify-content-center fixed-bottom">
            <?php echo $page; ?>
        </ul>
    </div>
</div>

</body>
</html>