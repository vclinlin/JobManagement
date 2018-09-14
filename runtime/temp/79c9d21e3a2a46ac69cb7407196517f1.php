<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:104:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\public/../application/admin\view\user\upteachers.html";i:1529238033;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>编辑教师</title>
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
    <form class="layui-form" action="" id="froms">
        <?php if(is_array($teachers) || $teachers instanceof \think\Collection || $teachers instanceof \think\Paginator): $i = 0; $__LIST__ = $teachers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
        <div class="layui-form-item">
            <label class="layui-form-label">教师号</label>
            <div class="layui-input-block">
                <input type="text" id="number"
                       placeholder="请输入教师号,例如018888**" autocomplete="off"
                       value="<?php echo $data['number']; ?>" class="layui-input">

            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">姓名</label>
            <div class="layui-input-block">
                <input type="text" id="name" placeholder="请输入姓名"
                       value="<?php echo $data['name']; ?>" autocomplete="off" class="layui-input">
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="layui-form-item">
            <label class="layui-form-label">所属系部</label>
            <div class="layui-input-block">
                <select id="department_id" name="department_id" lay-verify="required">
                    <option value="">请选择</option>
                    <?php if(is_array($classData) || $classData instanceof \think\Collection || $classData instanceof \think\Paginator): $i = 0; $__LIST__ = $classData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $data['Id']; ?>"><?php echo $data['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">默认密码</label>
            <div class="layui-input-block">
                <input type="text"  placeholder="123456"
                       autocomplete="off" class="layui-input" value="123456" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <?php if(is_array($teachers) || $teachers instanceof \think\Collection || $teachers instanceof \think\Paginator): $i = 0; $__LIST__ = $teachers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                <button class="layui-btn" onclick="up(<?php echo $data['Id']; ?>)"  lay-filter="formDemo">立即提交</button>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
<script>
    function up(Id) {
        var name = $("#name").val().trim();
        var department_id = $("#department_id").val().trim();
        var number = $("#number").val().trim();
        /**
         * 验证数据
         * @type {RegExp}
         */
        var names = /^[a-zA-Z\u4e00-\u9fa5]{2,16}$/;
        var numbers = /^[0-9]{8,12}$/;
        if(!numbers.test(number))
        {
            layer.msg('教师号为8-12位数字');
            return;
        }
        if(!names.test(name))
        {
            layer.msg('教师姓名为：2-16个中英文字符组成');
            return;
        }
        if(!department_id>0)
        {
            layer.msg('请选择系部');
            return;
        }
        $.ajax({
            url:"/admin/user/UpTeachers",
            type:"post",
            dataType:"json",
            data:{
                Id,
                name,
                number,
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
                    //表单清空
                    $("#froms")[0].reset();
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