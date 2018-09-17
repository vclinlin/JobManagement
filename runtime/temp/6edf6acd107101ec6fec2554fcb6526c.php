<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:105:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\public/../application/index\view\teachers\courseimgview.html";i:1536908768;s:79:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\application\index\view\layout.html";i:1536908768;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<title>修改封面</title>

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
<script src="__JS__/teachers/courseImg.js"></script>

</head>
<body>

<!-- 导航栏 -->
<?php echo widget('widgets/teachers'); ?>
<div class="line-one container">
    <div class="d-flex flex-wrap justify-content-center">
        <div class="col-lg-2 card-top col-sm-3 col-6 p-sm-2">
            <div class="card">
                <div class="card-body">
                    <img src="<?php echo $data==''?'__IMG__/cover/DefaultCover.jpg':$data; ?>"
                         id="imgA" class="w-100" style="height:169px">   <!-- 默认-->
                </div>
                <div class="card-footer text-center" data-Id="<?php echo $id; ?>" id="ImgId">封面预览</div>    <!-- 描述 -->
            </div>
        </div>
    </div>
    <div class="m-2 p-2 text-danger text-center">为保证封面效果请使用宽高比为6:8的图片</div>
    <div class="form-group">
        <input  type="file" accept="image/*" name="file0" id="file0" multiple="multiple"
                class="form-control-file" >
    </div>
    <div class="input-group">
        <button class="btn-sm btn" data-id="<?php echo $id; ?>" onclick="FileUp(this)" style="margin-right: 10px;">确定</button>
        <button class="btn-sm btn btn-danger" onclick="javascript:history.back(-1);">返回</button>
    </div>
</div>

</body>
</html>