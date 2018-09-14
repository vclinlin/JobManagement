<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:107:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\public/../application/admin\view\user\teachersexcel.html";i:1529236833;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Excel导入教师信息</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="__X-ADMIN__/css/font.css">
    <link rel="stylesheet" href="__X-ADMIN__/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="__X-ADMIN__/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="__X-ADMIN__/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">
    <h2>Excel数据表格基本要求和注意事项：</h2>
    <h5>1.格式如表所示</h5>
    <h5>2.已存在教师信息不会被上传</h5>
    <h5>3.教师未进行第一次登陆的账户,不会显示在已注册的教师表中</h5>
    <h5>4.因为Excel导入,数据格式检测性差,请按要求填写</h5>
    <table class="layui-table">
        <thead>
        <tr>
            <th>教师号</th>
            <th>姓名</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>0188888**</td>
            <td>唐*</td>
        </tr>
        </tbody>
    </table>
    <form  class="layui-form" method="post" action="">
        <div class="layui-form-item" >
            <div class="layui-input-inline">
                <div class="layui-upload">
                    <button type="button" name="myfile" class="layui-btn" id="myfile">
                        <i class="layui-icon"></i>选择Excel</button>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
<script>
    layui.use(['form','upload'],function(){
        var form=layui.form;
        var upload=layui.upload;

        upload.render({ //允许上传的文件后缀
            elem: '#myfile'
            ,url: "<?php echo url('user/upTeachersExcel'); ?>"
            ,accept: 'file' //普通文件
            ,exts: 'xls|excel|xlsx' //只允许上传压缩文件
            ,done: function(res){
                if(res.code==1){
                    layer.msg(res['msg'],{icon:6});
                }
            }
        });

        form.on('submit(formsub)',function(data){
            layer.msg('导入数据具体详情未协商确认,待确认后处理');
            return false;
        })


    })
</script>
</html>