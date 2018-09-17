<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:98:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\public/../application/index\view\teachers\course.html";i:1536943914;s:79:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\application\index\view\layout.html";i:1536908768;}*/ ?>
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
    
<style>
.card-top
{
    margin-top: 10px;
}
</style>

</head>
<body>

<!-- 导航栏 -->
<?php echo widget('widgets/teachers'); ?>
<div class="line-one container">
    <div class="d-flex flex-wrap">
        <div class="col-lg-2 card-top col-sm-3 col-6 p-sm-2" style="margin-top: 15px;">
            <div class="card">
                <div class="card-body" data-url="/index/teachers/addcourse" onclick="OpenUrl(this)">
                    <img src="__IMG__/cover/add.png" class="w-100" style="height:169px">   <!-- 默认第一个卡片：添加 -->
                </div>
                <div class="card-footer text-center">
                    <marquee behavior="left"  direction="5">新增课程</marquee></div>    <!-- 描述 -->
            </div>
        </div>
        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
        <div class="col-lg-2 card-top col-sm-3 col-6 p-sm-2" style="margin-top: 15px;" title="<?php echo $data['class_name']; ?>-<?php echo $data['grade']; ?>级<?php echo $data['sequence']; ?>班">
            <div class="card"  data-url="/index/teachers/courseDetails?id=<?php echo $data['Id']; ?>&key=<?php echo $data['course_name']; ?>" onclick="OpenUrl(this)">
                <div class="card-body">
                    <img src="<?php echo $data['img_url']==''?'__IMG__/cover/DefaultCover.jpg':$data['img_url']; ?>" class="w-100" style="height:169px">   <!-- 封面 -->
                </div>
                <div class="card-footer text-center">
                    <marquee direction="left"  scrollamount="5">
                        <?php echo $data['course_name']; ?>--[<?php echo $data['class_name']; ?>-<?php echo $data['grade']; ?>级<?php echo $data['sequence']; ?>班]
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