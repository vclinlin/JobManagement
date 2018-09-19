<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:94:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\public/../application/index\view\index\index.html";i:1537176792;s:79:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\application\index\view\layout.html";i:1536908768;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<title>首页</title>

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
    
<link rel="stylesheet" href="__CSS__/index/login.css"/>

</head>
<body>

<nav class="navbar navbar-expand-sm bg-success navbar-dark">
    <!-- Brand/logo -->
    <div class="container">
    <a class="navbar-brand" href="#">云课堂V1.0</a>

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link login" data-toggle="modal" data-target="#myModal" href="javascript:">登录</a>
        </li>
    </ul>
    </div>
</nav>
<!-- 轮播 -->
<div id="demo" class="carousel slide" data-ride="carousel">
    <!-- 轮播图片 -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="__IMG__/bg.jpg">
            <div class="text-fixed">
                <p>知否-云课堂V1.0</p>
                <p>开发时间:2018-06-07</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="__IMG__/bg01.jpg">
            <div class="text-fixed">
                <p>开发人员:知否丶</p>
                <p>QQ:2528087799</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="__IMG__/bg02.jpg">
            <div class="text-fixed">
                <p>本次开发,主要为了学习</p>
                <p>更多交流,请联系作者</p>
            </div>
        </div>
    </div>
</div>

<!-- 调用块 -->

<div class="modal fade" id="myModal" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- 模态框头部 -->
            <div class="modal-header">
                <h4 class="modal-title">登录</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- 模态框主体 -->
            <div class="modal-body">
                <form id="forms" onsubmit="return false">
                <div class="form-group">
                    <label for="number">账号:</label>
                    <input type="text" class="form-control" id="number" placeholder="学号/教师号"
                    oninput="checkLogin(this)">
                </div>
                <div class="form-group">
                    <label for="pass">密码:</label>
                    <input type="password" disabled class="form-control" id="pass" placeholder="密码">
                </div>
                <div class="form-group">
                    <label for="class_number">用户类型:</label>
                    <input type="text" readonly  class="form-control" id="class_number" placeholder="未知用户">
                </div>
                </form>
            </div>

            <!-- 模态框底部 -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">返回</button>
                <button type="button" class="btn btn-secondary" onclick="login()" >登录</button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-dark">
    <div class="col-12 text-white text-center">
        <dd>项目名:云课堂/开发人员:知否丶</dd>
        <dd>联系方式:QQ:2528087799/Email:vclinlin@vip.qq.com</dd>
    </div>
</div>
<script>
function login()
{
    var number = $("#number").val().trim();
    var pass = $("#pass").val().trim();
    var class_number = $("#class_number")[0].dataset.type;
    /**
     * 数据监测
     */
    var numbers = /^[0-9]{8,16}$/;
    var CheckPwd = /^[0-9a-zA-Z\+\-\_]{6,16}$/;
    if(!numbers.test(number))
    {
        layer.msg('账号由8-16位纯数字组成');
        return;
    }
    if(!CheckPwd.test(pass))
    {
        layer.msg('密码由6-16位数字或中英文字符组成');
        return;
    }
    if(class_number!=1&&class_number!=2)
    {
        layer.msg('请选择你的用户类型');
        return;
    }
    $.ajax({
        url:"<?php echo url('index/index/login'); ?>",
        type:"post",
        dataType:"json",
        data:{
            number,
            pass,
            class_number
        },
        success:function (data) {
            if(!data['state'])
            {
                layer.msg(data['messages'],{time:2000});
                return;
            }
            if(data['state'])
            {
                $("#forms")[0].reset();
                layer.msg(data['messages'],{time:2000},function () {
                    window.location.href=data.url;
                });
                return;
            }
        }
    })
}
function checkLogin(_this) {
    // console.log(_this.value)
    $.ajax({
        url:"<?php echo url('index/index/getNumber'); ?>",
        type: 'get',
        dataType: 'json',
        data:{
            id:_this.value
        },
        success:function (rel) {
            if(rel.class_state == 200)
            {
                if(rel.class_type == 1)
                {
                    document.getElementById("class_number").placeholder = '学生用户';
                }
                if(rel.class_type == 2)
                {
                    document.getElementById("class_number").placeholder = '教师用户';
                }
                // 解除禁用
                $("#pass").removeAttr("disabled");
                $("#class_number").attr("data-type",rel.class_type);
                return;
            }
            // 移除类型
            $("#class_number").removeAttr("data-type");
            document.getElementById("class_number").placeholder = '未知用户';
            $("#pass").attr("disabled","disabled");
            return;

        }
    })
}
</script>

</body>
</html>