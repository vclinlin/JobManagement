<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:101:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\public/../application/admin\view\index\addpro.html";i:1528386037;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>新增班级</title>
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
<div class="x-body" onsubmit="return false">
    <form class="layui-form" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">专业名</label>
            <div class="layui-input-block">
                <input type="text" id="Vclass"
                       placeholder="请输入专业名" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属系部</label>
            <div class="layui-input-block">
                <select id="dep" name="dep" lay-verify="required">
                    <option value="">请选择</option>
                    <?php if(is_array($Depdata) || $Depdata instanceof \think\Collection || $Depdata instanceof \think\Paginator): $i = 0; $__LIST__ = $Depdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $data['Id']; ?>"><?php echo $data['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" onclick="add()"  lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
<script>
    function add() {
        var name = $("#Vclass").val().trim();
        var department_id = $("#dep").val().trim();
        var names = /^[a-zA-Z0-9\u4e00-\u9fa5]{2,16}$/;
        if(!names.test(name))
        {
            layer.msg('有效专业名为：2-16个中英文字符或数字组成');
            return;
        }
        if(!department_id>0)
        {
            layer.msg('请选择专业所属系部');
            return;
        }
        $.ajax({
            url:"/admin/index/addpro",
            type:"post",
            dataType:"json",
            data:{
                name,
                department_id
            },
            success:function (data) {
                if(!data['state'])
                {
                    layer.msg(data['messages']);
                    return;
                }
                if(data['state'])
                {
                    layer.msg(data['messages']);
                    document.getElementById("Vclass").value="";
                    return;
                }
                layer.msg('意料之外的错误');
                return;
            }
        })
    }
</script>
</body>

</html>