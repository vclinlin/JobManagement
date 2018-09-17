<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:103:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\public/../application/index\view\teachers\workdetails.html";i:1537152793;s:79:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\application\index\view\layout.html";i:1536908768;}*/ ?>
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
<?php echo widget('widgets/teachers'); ?>

<div class="line-one container">
    <div class="row p-2 m-2 bg-light border">
        <div class="col-sm-9 d-flex justify-content-start">
            <div class="text-dark">
                <div class="h4"><?php echo $course_data['title']; ?></div>
                <div>截至时间：<?php echo date('Y-m-d',$course_data['end_time']); ?></div>
                <div>
                    <!-- 作业要求简介 -->
                    要求：<?php echo $course_data['msg_cut']; ?><a href=".demo" data-toggle="collapse">......更多</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3 d-flex justify-content-center flex-column">
            <input type="button" class="btn btn-block btn-success"  value="修改信息"
                   data-url="<?php echo url('index/Teachers/UpDateWork',['id'=>$course_data['Id'],'course_id'=>$course_data['course_id']]); ?>"
                   onclick="OpenUrl(this)" />
            <input type="button" class="btn btn-block btn-danger"  value="返回前页"
                   onclick="OpenUrl(this)" data-url="/index/teachers/courseDetails?id=<?php echo $course_data['course_id']; ?>&key=<?php echo $course['name']; ?>" />
        </div>
    </div>
    <div  class="collapse p-2 m-2 bg-dark text-white demo" data-parent=".line-one">  <!-- 作业要求详细 -->
        <textarea style="resize:none"  class="col-12 bg-dark text-white border-0" disabled rows="10"><?php echo $course_data['msg']; ?></textarea>
    </div>
    <div  style="margin-top:20px;" class="table-responsive">
        <table class="table text-center table-hover" id="table-nowrap">
            <thead>
                <tr>
                    <td>学号</td>
                    <td>姓名</td>
                    <td>班级</td>
                    <td>作业类型</td>
                    <td>答题次数</td>
                    <td>提交时间</td>
                    <td>批阅</td>
                    <?php if($course_data['scheme'] == 0): ?>
                    <td>下载</td>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
            <?php if(count($workData) == 0): ?>
            <tr>
                <td colspan="8">还没有收到作业</td>
            </tr>
            <?php else: if(is_array($workData) || $workData instanceof \think\Collection || $workData instanceof \think\Paginator): $i = 0; $__LIST__ = $workData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$workData): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $workData['students_num']; ?></td>
                    <td><?php echo $workData['students_name']; ?></td>
                    <td><?php echo $workData['student_id']; ?></td>
                    <td>
                        <?php if($workData['type'] == 0): ?>
                        文件
                        <?php else: ?>
                        文本
                        <?php endif; ?>
                    </td>
                    <td><?php echo $workData['count_sum']; ?></td>
                    <td><?php echo date('Y-m-d:H:i:s',$workData['updatetime']); ?></td>
                    <td><a href="<?php echo url('index/teachers/MarkingView',['id'=>$workData['Id']]); ?>">批阅</a></td>
                    <?php if($course_data['scheme'] == 0): ?>
                    <td>下载</td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </tbody>
        </table>
    </div>
    <ul class="text-dark container d-flex justify-content-center fixed-bottom">
        <?php echo $page; ?>
    </ul>
</div>
<script>
    $(function () {
        //    -------
        $("#table-nowrap").find('td').attr('nowrap','nowrap');
    })
</script>

</body>
</html>