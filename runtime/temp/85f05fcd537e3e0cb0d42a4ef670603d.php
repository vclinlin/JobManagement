<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:97:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\public/../application/admin\view\index\upcourse.html";i:1537093164;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>编辑课程</title>
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
            <th>原课程名称</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($CourseData) || $CourseData instanceof \think\Collection || $CourseData instanceof \think\Paginator): $i = 0; $__LIST__ = $CourseData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
        <tr>
            <td id="ids"><?php echo $data['Id']; ?></td>
            <td><?php echo $data['name']; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <form class="layui-form" action="" id="froms">
        <div class="layui-form-item">
            <label class="layui-form-label">课程名</label>
            <div class="layui-input-block">
                <?php if(is_array($CourseData) || $CourseData instanceof \think\Collection || $CourseData instanceof \think\Paginator): $i = 0; $__LIST__ = $CourseData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                <input type="text" id="name"
                       placeholder="请输入课程名,例如：PHP程序设计" autocomplete="off"
                       class="layui-input" value="<?php echo $data['name']; ?>">
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">上课班级</label>
            <div class="layui-input-block">
                <select id="class_id" name="class_id" lay-verify="required">
                    <option value="">请选择班级</option>
                    <?php if(is_array($classData) || $classData instanceof \think\Collection || $classData instanceof \think\Paginator): $i = 0; $__LIST__ = $classData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $data['Id']; ?>"><?php echo $data['name']; ?>--<?php echo $data['grade']; ?>级<?php echo $data['sequence']; ?>班</option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">讲师</label>
            <div class="layui-input-block">
                <select id="teachers_id" name="teachers_id" lay-verify="required">
                    <option value="">请选择讲师</option>
                    <?php if(is_array($teachersData) || $teachersData instanceof \think\Collection || $teachersData instanceof \think\Paginator): $i = 0; $__LIST__ = $teachersData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $data['Id']; ?>"><?php echo $data['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <!--<div class="layui-form-item">-->
            <!--<label class="layui-form-label">课程状态</label>-->
            <!--<div class="layui-input-block">-->
                <!--<select id="state" name="state" lay-verify="required">-->
                    <!--<option value="0">进行中</option>-->
                    <!--<option value="1">停课</option>-->
                <!--</select>-->
            <!--</div>-->
        <!--</div>-->
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
        var id = $("#ids").text();
        var name = $("#name").val().trim();
        var class_id = $("#class_id").val().trim();
        var teachers_id = $("#teachers_id").val().trim();
        // var state = $("#state").val().trim();
        /**
         * 验证数据
         * @type {RegExp}
         */
        var names = /^[a-zA-Z0-9\u4e00-\u9fa5]{2,16}$/;
        if(!names.test(name))
        {
            layer.msg('有效课程名为：2-16个中英文字符或数字组成');
            return;
        }
        if(!class_id>0)
        {
            layer.msg('请选择上课班级');
            return;
        }
        if(!teachers_id>0)
        {
            layer.msg('请选择讲师');
            return;
        }
        // if(state!=0&&state!=1)
        // {
        //     layer.msg('请选择课程状态');
        //     return;
        // }
        $.ajax({
            url:"/admin/index/upcourse",
            type:"post",
            dataType:"json",
            data:{
                "Id":id,
                name,
                class_id,
                teachers_id,
                // state
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