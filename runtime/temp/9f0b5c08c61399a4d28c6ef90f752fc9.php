<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:99:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\public/../application/index\view\teachers\addwork.html";i:1536908768;s:79:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\application\index\view\layout.html";i:1537327581;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<title>新增作业</title>

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
    
<style>

</style>

</head>
<body>

<!-- 导航栏 -->
<?php echo widget('widgets/teachers'); ?>
<div class="container line-one">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group">
            <label for="workTitle"></label>
            <input type="text" class="form-control" id="workTitle"  placeholder="输入作业标题">
        </div>
        <div class="form-group">
            <label for="EndDate">选择结束时间</label>
            <input type="date" class="form-control" id="EndDate" placeholder="选择结束时间">
        </div>
        <div class="form-group">
            <label for="Select">选择作业提交方式</label>
            <select class="form-control" id="Select">
                <option value="0">提交文件</option>
                <option value="1">提交文本</option>
            </select>
        </div>
        <div class="form-group">
            <label for="msg">作业要求</label>
            <textarea class="form-control" id="msg" rows="10"></textarea>
        </div>
        <button type="button" data-id="<?php echo $id; ?>" onclick="AddWork(this)" class="btn btn-primary">发布</button>
        <button type="button" onclick="javascript:history.back(-1);" class="btn btn-danger" style="margin-left: 10px;">返回</button>
    </div>
</div>
<script>
    $("#EndDate").change(function () {
        var Ary = this.value.split('-');
        var date = new Date(Ary[0],Ary[1]-1,Ary[2]);//实例化选择的时间
        var NewDate = new Date();
        var NewsDate = new Date(NewDate.getFullYear(),NewDate.getMonth(),NewDate.getDate());//实例化当前时间
        if(date.getTime()<NewsDate.getTime()) //比较时间大小
        {
            layer.msg('请选择合理结束时间',{icon:0,time:1500});
            this.value=null;
            return;
        }
    });
    function AddWork(_this){
        var title = $("#workTitle").val().trim();//标题
        var end_time = $("#EndDate").val();//时间
        var scheme = $("#Select").val();//提交方式
        var msg = $("#msg").val();
        if(!/^[^\n\f\r]{1,24}$/.test(title))
        {
            layer.msg('标题由1-24个字符组成',{icon:0,time:1500});
            return;
        }
        if(end_time==null||end_time=="")
        {
            layer.msg('请选择结束时间',{icon:0,time:1500});
            return;
        }
        if(!/^[^\f]+$/.test(msg))
        {
            layer.msg('作业要求只能包含中英文字符或数字',{icon:0,time:1500});
            return;
        }
        $.ajax({
            url:"/index/teachers/addwork",
            type:"post",
            dataType:"json",
            data:{
                title,                  //标题
                end_time,               //结束
                scheme,                 //方案
                msg,                    //内容
                course_id:_this.dataset.id     //识别
            },
            success(res){
               if(res.state!=200)
               {
                   layer.msg(res.message);
                   return;
               }
                layer.msg(res.message);
                document.getElementById("workTitle").value=null;
                document.getElementById("EndDate").value=null;
                document.getElementById("msg").value="";
                return;
            }
        })
    }
</script>

</body>
</html>