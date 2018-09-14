<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:111:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\public/../application/index\view\students\coursedetails.html";i:1536677767;s:85:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\application\index\view\layout.html";i:1531482937;}*/ ?>
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
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    
<style>

</style>

</head>
<body>

<!-- 导航栏 -->
<?php echo widget('widgets/students'); ?>
<div class="line-one container">
    <div class="row p-2 m-2  bg-light border">
        <div class="col-sm-9 d-flex justify-content-center flex-column">
                <div class="h4">[<span class="text-danger"><?php echo $course['name']; ?></span>]作业列表</div>
        </div>
        <div class="col-sm-3 d-flex justify-content-center flex-column">
            <input type="button" class="btn btn-block btn-success"
                   onclick="javascript:history.back(-1);" value="我的课程" />
            <input type="button" class="btn btn-block btn-primary"
                   data-url="" value="课程资料" onclick="OpenUrl(this)"/>
        </div>
    </div>
    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $key = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($key % 2 );++$key;?>
    <div class="row p-2 m-2 bg-light border">
        <div class="col-sm-9 d-flex justify-content-start">
            <div class="text-dark">
                <div class="h4"><?php echo $data['title']; ?></div>
                <div>截至时间：<?php echo date('Y-m-d',$data['end_time']); ?></div>
                <div>
                    <!-- 作业要求简介 -->
                    要求：<?php echo $data['msg_cut']; ?>......<a href=".demo<?php echo $key; ?>" data-toggle="collapse">更多</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3 d-flex justify-content-center flex-column">
            <?php if($data['end_time']>=time()): ?>  <!-- 如果还未到结束时间 -->
            <input type="button" data-url="<?php echo url('index/Students/WorkDetails',['id'=>$data['Id']]); ?>"
                   onclick="OpenUrl(this)" class="btn btn-block btn-success" value="<?php echo widget('widgets/workstate',['work_id'=>$data['Id']]); ?>答题"/>
            <?php else: ?>
            <input type="button" disabled class="btn btn-block btn-danger"  value="已结束"/>
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