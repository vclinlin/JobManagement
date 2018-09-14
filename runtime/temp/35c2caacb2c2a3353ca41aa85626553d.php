<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:101:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\public/../application/admin\view\index\course.html";i:1529031953;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>课程</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="__X-ADMIN__/css/font.css">
    <link rel="stylesheet" href="__X-ADMIN__/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="__X-ADMIN__/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="__X-ADMIN__/js/xadmin.js"></script>
    <script src="__JS__/admin/course.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="javascript:">首页</a>
        <a href="javascript:">综合管理</a>
        <a>
          <cite>课程</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body" onsubmit="return false">
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('新增班级','/admin/index/AddCourseView')">
            <i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共设有课程：<?php echo $count; ?> 门</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>序号</th>
            <th>课程名称</th>
            <th>上课班级</th>
            <th>年级</th>
            <th>讲师</th>
            <th colspan="2" style="text-align: center">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['course_name']; ?></td>
            <td><?php echo $data['class_name']; ?></td>
            <td><?php echo $data['grade']; ?>级<?php echo $data['sequence']; ?>班</td>
            <td><?php echo $data['name']; ?></td>
            <td style="text-align: center" class="td-manage">
                <a title="编辑"  onclick="x_admin_show('编辑','/admin/index/upcourseview/?id=<?php echo $data['Id']; ?>')" href="javascript:;">
                    <i class="layui-icon">&#xe63c;</i>
                </a>
            </td>
            <td style="text-align: center">
                <a title="删除" onclick="member_del(this,'<?php echo $data['Id']; ?>')" href="javascript:;">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="page">
        <div>
            <a class="prev" href="./CourseView?page=<?php echo $page-1; ?>">&lt;&lt;</a>
            <a class="num" href="./CourseView?page=<?php echo $page-1; ?>"><?php echo $page-1; ?></a>
            <span class="current"><?php echo $page; ?></span>
            <a class="num" href="./CourseView?page=<?php echo $page+1; ?>">
                <?php
                    $page = $page+1>$num?$page:$page+1;
                echo $page;
                ?>
            </a>
            <a class="num" href="Javascript:">....</a>
            <a class="num" href="./CourseView?page=<?php echo $num; ?>"><?php echo $num; ?></a>
            <a class="next" href="./CourseView?page=<?php echo $page+1; ?>">&gt;&gt;</a>
        </div>
    </div>

</div>
</body>

</html>