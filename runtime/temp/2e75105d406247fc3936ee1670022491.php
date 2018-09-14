<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:104:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\public/../application/index\view\teachers\seldep.html";i:1529936330;s:85:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\application\index\view\layout.html";i:1529906355;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<title>教师首页</title>

    <script src="__JQ__/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap.css">
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap-grid.css">
    <link rel="stylesheet" href="__BOOTSTRAP__/css/bootstrap-reboot.css">
    <script src="__BOOTSTRAP__/js/bootstrap.bundle.js"></script>
    <script src="__BOOTSTRAP__/js/bootstrap.js"></script>
    <script src="__BOOTSTRAP__/popper.min.js"></script>
    <script src="__JS__/layer/layer.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    
<script src="__JS__/teachers/seldep.js"> </script>
<style>
    .errorBorder
    {
        border-color:red;
    }
</style>

</head>
<body>

<?php echo widget('widgets/teachers'); ?>
<div class="container">
    <div class="row" style="margin-top: 20px">
        <div class="col-sm-8">
            <h3 style="color: red">您只能进行一次该操作,请认真填写</h3>
            <hr/>
            <div class="form-group">
                <label for="user">教师号:</label>
                <input type="text" class="form-control" id="user" placeholder="请输入您的教师号" value="">
            </div>
            <div class="form-group">
                <label for="pwd">初始密码:</label>
                <input type="password" class="form-control" id="pwd" placeholder="请输入您的密码">
            </div>
            <div class="form-group">
                <label for="pass">新密码:</label>
                <input type="password" class="form-control" id="pass" placeholder="请输入新密码">
            </div>
            <div class="form-group">
                <label for="repass">确认密码:</label>
                <input type="password" class="form-control" id="repass" placeholder="请确认密码">
            </div>
            <div class="form-group">
                <label for="dep">系部选择:</label>
                <select class="form-control" id="dep">
                    <option value="">请选择</option>
                    <?php if(is_array($DepData) || $DepData instanceof \think\Collection || $DepData instanceof \think\Paginator): $i = 0; $__LIST__ = $DepData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$depdata): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $depdata['Id']; ?>"><?php echo $depdata['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
                <button type="button" id="btnIn" class="btn btn-primary">确认</button>
        </div>
    </div>
</div>

</body>
</html>