<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:103:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\public/../application/index\view\teachers\markingview.html";i:1537328155;s:79:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\application\index\view\layout.html";i:1537327581;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<title>批阅作业</title>

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

<div class="line-one container bg-light Max-Box">
    <div  class="table-responsive pt-2 mt-2">
        <table class="table table-bordered  text-center table-hover" id="table-nowrap">
            <thead>
                <tr>
                    <th nowrap="nowrap">学号</th>
                    <th nowrap="nowrap">姓名</th>
                    <th nowrap="nowrap">提交时间</th>
                    <th nowrap="nowrap">提交次数</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td nowrap="nowrap"><?php echo $workData['students_num']; ?></td>
                    <td nowrap="nowrap"><?php echo $workData['students_name']; ?></td>
                    <td nowrap="nowrap"><?php echo $workData['updatetime']; ?></td>
                    <td nowrap="nowrap"><?php echo $workData['count_sum']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12 pt-2">
        <?php if($workData['type'] == 0): ?>
        <!-- 文件作业 -->
        <div class="form-group">
            <label for="filesData">作业详情:</label>
            <?php if($workData['readType'] == 1): ?>
                <textarea style="overflow-x: hidden;" wrap="virtual" class="form-control" id="filesData" readonly rows="15"><?php echo $workData['filesData']; ?></textarea>
            <?php endif; if($workData['readType'] == 0): if(in_array($workData['file_type'],['jpg','png','gif','bmp'])): ?>
                <div class="col-sm-12 text-center">
                    <img src="<?php echo $workData['message']; ?>" style="width:50%;height: auto">
                </div>
                <?php else: ?>
                    <p class="text-danger  m-2 p-2"><?php echo $workData['students_num'].' ' .$workData['students_name'].'.'.$workData['file_type']; ?></p>
                <?php endif; endif; ?>
            <input type="button" class="mt-2 btn-block btn btn-success" value="下载">
        </div>
        <?php endif; if($workData['type'] == 1): ?>
            <p>作业详情:</p>
            <textarea wrap="virtual"  class="form-control" disabled rows="20"><?php echo $workData['message']; ?></textarea>
        <?php endif; ?>
    </div>
</div>
<div class="container fixed-bottom bg-light border markingBox">
    <div class="form-group">
        <label for="marking">评语:</label>
        <textarea id="marking" style="resize: none" class="col-12" rows="2" placeholder="在此输入你的评语"></textarea>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="评分" id="numbers">
        <div class="input-group-append">
            <input type="button" class="btn-primary btn" value="确定">
        </div>
    </div>
</div>
<script>
    $(function () {
        var div = $(".markingBox");
        $("body").css('margin-bottom',div[0].clientHeight+30+'px');
    })
</script>

</body>
</html>