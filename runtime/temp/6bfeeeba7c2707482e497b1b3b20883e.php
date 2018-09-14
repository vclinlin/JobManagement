<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:102:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\public/../application/admin\view\index\upclass.html";i:1528819761;}*/ ?>
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
    <table class="layui-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>原班级名称</th>
            <th>年级</th>
            <th>班序</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($ClassData) || $ClassData instanceof \think\Collection || $ClassData instanceof \think\Paginator): $i = 0; $__LIST__ = $ClassData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
        <tr>
            <td id="ids"><?php echo $data['Id']; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td><?php echo $data['grade']; ?></td>
            <td><?php echo $data['sequence']; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <form class="layui-form" action="" id="froms">
        <div class="layui-form-item">
            <label class="layui-form-label">班级名</label>
            <div class="layui-input-block">
                <input type="text" id="name"
                       placeholder="请输入班级名,例如PHP班" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属专业</label>
            <div class="layui-input-block">
                <select id="professional_id" name="professional_id" lay-verify="required">
                    <option value="">请选择</option>
                    <?php if(is_array($ProData) || $ProData instanceof \think\Collection || $ProData instanceof \think\Paginator): $i = 0; $__LIST__ = $ProData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $data['Id']; ?>"><?php echo $data['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">年级</label>
            <div class="layui-input-block">
                <input type="text" id="grade" placeholder="请输入年级"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">班序</label>
            <div class="layui-input-block">
                <input type="text" id="sequence" placeholder="班序"
                       autocomplete="off" class="layui-input">
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
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#grade', //指定元素
            type: 'year'
        });
    });
    function add() {
        var Id = $("#ids").text();
        var name = $("#name").val().trim();
        var professional_id = $("#professional_id").val().trim();
        var grade = $("#grade").val().trim();
        var sequence = $("#sequence").val().trim();
        /**
         * 验证数据
         * @type {RegExp}
         */
        var names = /^[a-zA-Z0-9\u4e00-\u9fa5]{2,16}$/;
        var grades = /^(20)[0-9]{2}$/;
        var sequences = /^[\d]+$/;
        if(!names.test(name))
        {
            layer.msg('有效班级名为：2-16个中英文字符或数字组成');
            return;
        }
        if(!professional_id>0)
        {
            layer.msg('请选择班级所在专业');
            return;
        }
        if(!grades.test(grade))
        {
            layer.msg('请输入有效年限：2000-2999');
            return;
        }
        if(!sequences.test(sequence))
        {
            layer.msg('请输入有效班序,大于0的数字');
            return;
        }
        if(sequence<=0)
        {
            layer.msg('请输入有效班序,大于0的数字');
            return;
        }
        $.ajax({
            url:"/admin/index/UpClass",
            type:"post",
            dataType:"json",
            data:{
                Id,
                name,
                professional_id,
                grade,
                sequence
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