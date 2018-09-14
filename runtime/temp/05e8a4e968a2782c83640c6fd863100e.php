<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:109:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\public/../application/index\view\students\workdetails.html";i:1536845616;s:85:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\application\index\view\layout.html";i:1531482937;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<title>课程详情</title>

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

</style>

</head>
<body>

<!-- 导航栏 -->
<?php echo widget('widgets/students'); ?>
<div class="container line-one">
    <div class="row bg-light">
        <div class="col-sm-12">
            <h3>标题:<?php echo $work['title']; ?></h3>
            <p>要求:</p>
            <textarea style="resize:none"  class="col-12" disabled rows="6"><?php echo $work['msg']; ?></textarea>
            <small>截止日期:<?php echo date('Y-m-d:H:i:s',$work['end_time']); ?></small>
        </div>
    </div>
    <div  style="margin-top:15px;">
        <?php if($work['scheme']==0): ?>
            <p>选择文件:</p>
            <?php if($work['workState'] == 1): ?>
            <small class="text-danger">你于<?php echo date('Y-m-d:H:i:s',$work['workUpdateTime']); ?>已答题</small>
            <small class="text-danger">再次答题会覆盖上次记录</small>
            <?php endif; ?>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="file0" onchange="filesClick()" aria-describedby="inputGroupFileAddon04">
                <label class="custom-file-label" id="filesVal" for="file0">选择你的作业文件</label>
            </div>
            <div style="margin-top:20px;">
                <button type="button" class="btn btn-primary" onclick="filesUp()">确定</button>
                <button type="button" class="btn btn-danger" onclick="javascript:history.back(-1);">返回</button>
            </div>
        <?php endif; if($work['scheme']==1): ?>
            <p>输入或粘贴你的文本:</p>
            <textarea style="resize:none"  class="col-12"
                      rows="6" placeholder="在此处输入或粘贴你的文本"></textarea>
            <button type="button" class="btn btn-primary">确定</button>
            <button type="button" class="btn btn-danger" onclick="javascript:history.back(-1);">返回</button>
        <?php endif; ?>
    </div>
    <?php if($work['workState'] == 1): ?>
    <div  style="margin-top:20px;" class="table-responsive">
        <table class="table text-center table-bordered">
            <thead>
                <tr>
                    <td>学号</td>
                    <td>姓名</td>
                    <td>答题类型</td>
                    <td>答题时间</td>
                    <td>答题次数</td>
                    <td>是否批阅</td>
                    <td>操作</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $datas['students_num']; ?></td>
                    <td><?php echo $datas['students_name']; ?></td>
                    <td>
                        <?php if($datas['type'] == 0): ?>
                        文件
                        <?php endif; if($datas['type'] == 1): ?>
                        文本
                        <?php endif; ?>
                    </td>
                    <td><?php echo date('Y-m-d:H:i:s',$datas['updatetime']); ?></td>
                    <td><?php echo $datas['count_sum']; ?></td>
                    <td>
                        <?php if($datas['state'] == 0): ?>
                        未批阅
                        <?php endif; if($datas['state'] == 1): ?>
                        已批阅
                        <?php endif; ?>
                    </td>
                    <td>查看</td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<script>
    $(function () {
    //    -------
    })
    function filesUp() {
        var files = $("#file0");
        if(!files.val())
        {
            layer.msg("请选择有效文件");
            return;
        }
        var formData = new FormData();
        formData.append("file", $("#file0")[0].files[0]);
        $.ajax({
            url:"<?php echo url('index/Students/UpWorkFiles',['course_id'=>$work['course_id'],'work_id'=>$work['Id'],'end_time'=>$work['end_time']]); ?>",
            type: 'post',
            data: formData,
            //这两个设置项必填
            cache: false,
            contentType: false,    //不可缺
            processData: false,    //不可缺
            success: function (data) {
                var res = JSON.parse(data);  //处理字符串
                if(res.code==200)
                {
                    layer.msg(res.msg,{icon:1,time:1000,shade : [0.5 , '#000' , true]},function () {
                        location.reload();
                    });
                    return;
                }
                layer.msg(res.msg,{icon:0,time:1000,shade : [0.5 , '#000' , true]});
                return;
            }
        });
    }
    function filesClick() {
        var files = $("#file0");
        if(!files.val())
        {
            document.getElementById('filesVal').innerHTML = '请选择你的作业文件';
            return;
        }
        document.getElementById('filesVal').innerHTML = files.val();
    }
</script>

</body>
</html>