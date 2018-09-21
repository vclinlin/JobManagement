<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:105:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\public/../application/index\view\teachers\coursedetails.html";i:1537513338;s:79:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\application\index\view\layout.html";i:1537327581;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<title>课程详情</title>

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
    <script src="__JS__/index/auto-line-number.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    
<style>

</style>

</head>
<body>

<!-- 导航栏 -->
<?php echo widget('widgets/teachers'); ?>
<div class="line-one container">
    <div class="row p-2 m-2  bg-light border">
        <div class="col-sm-9 d-flex justify-content-center flex-column">
                <div class="h4">[<span class="text-danger"><?php echo $course['name']; ?></span>]作业列表</div>
        </div>
        <div class="col-sm-3 d-flex justify-content-center flex-column">
            <input type="button" class="btn btn-block btn-success"
                   data-url="/index/teachers/addworkview?id=<?php echo $course['course_id']; ?>" value="新增作业" onclick="OpenUrl(this)"/>
            <input type="button" class="btn btn-block btn-primary"
                   data-url="/index/teachers/CourseImgView?id=<?php echo $course['course_id']; ?>" value="修改封面" onclick="OpenUrl(this)"/>
            <input type="button" onclick="OpenUrl(this)" data-url="/index/teachers/course" class="btn btn-block  btn-danger" value="返回">
        </div>
    </div>
    <?php if(count($data) == 0): ?>
    <div class="row p-2 m-2 bg-light border">
        <div class="h4 col-12 text-center">还没有发布任何作业</div>
    </div>
    <?php endif; if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $key = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($key % 2 );++$key;?>
    <div class="row p-2 m-2 bg-light border">
    <div class="col-sm-9 d-flex justify-content-start">
        <div class="text-dark">
            <div class="h4"><?php echo $data['title']; ?></div>
            <div>截至时间：<?php echo date('Y-m-d',$data['end_time']); ?></div>
            <div>
                <!-- 作业要求简介 -->
                要求：<?php echo $data['msg_cut']; ?><a href=".demo<?php echo $key; ?>" data-toggle="collapse">......更多</a>
            </div>
        </div>
    </div>
    <div class="col-sm-3 d-flex justify-content-center flex-column">
        <input type="button" class="btn btn-block btn-success"  value="查看"
               data-url="<?php echo url('index/Teachers/WorkDetails',['id'=>$data['Id'],'course_id'=>$course['course_id']]); ?>" onclick="OpenUrl(this)" />
        <?php if($data['scheme'] == 0): ?>
        <input type="button" class="btn btn-block btn-primary"  value="下载所有" />
        <?php endif; ?>
    </div>
</div>
    <div  class="collapse p-2 m-2 bg-dark text-white demo<?php echo $key; ?>" data-parent=".line-one">  <!-- 作业要求详细 -->
        <textarea style="resize:none"  class="col-12 bg-dark text-white border-0" disabled rows="6"><?php echo $data['msg']; ?></textarea>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <ul class="text-dark container d-flex justify-content-center fixed-bottom">
        <?php echo $page; ?>
    </ul>
</div>

</body>
</html>