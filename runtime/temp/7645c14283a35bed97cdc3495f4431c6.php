<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:101:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\public/../application/index\view\teachers\addcourse.html";i:1536908768;s:79:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\application\index\view\layout.html";i:1537327581;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<title>新增课程</title>

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
    
<script src="__JS__/index/teachers/addcourse.js"></script>
<style>

</style>

</head>
<body>

<!-- 导航栏 -->
<?php echo widget('widgets/teachers'); ?>
<div class="container line-one">
    <div class="row bg-light">
        <div class="col-sm-6 p-2 m-sm-2">
            <div class="form-group">
                <label for="names">课程名</label>
                <input type="text" class="form-control" id="names" placeholder="输入课程名">
            </div>
            <div class="form-group">
                <label for="sel1">选择专业</label>
                <select class="form-control" id="sel1" onchange="onloadClass()">
                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $data['Id']; ?>"><?php echo $data['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Vc_class">选择班级</label>
                <select class="form-control" id="Vc_class">
                    <option>加载失败</option>
                </select>
            </div>
            <input type="button" onclick="SubCourse()" value="确定" class="btn btn-success"/>
            <input type="button" onclick="javascript:history.back(-1);"
                   class="btn btn-danger" style="margin-left: 10px;" value="返回">
            <div class="text-danger p-2 m-2">*非本系部课程，只能联系管理员核实后添加</div>
            <div class="text-danger p-2 m-2">*课程添加后,非管理员不得删除</div>
        </div>
    </div>
</div>

</body>
</html>