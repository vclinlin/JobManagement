<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:98:"D:\Vc_PHP\Apache24\htdocs\2018\JobManagement\public/../application/admin\view\user\notstudent.html";i:1537175177;}*/ ?>
<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>未注册学生</title>
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
  
  <body class="layui-anim layui-anim-up">
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">用户管理</a>
        <a>
          <cite>学生</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('Excel导入','/admin/user/ExcelView')">
          <i class="layui-icon"></i>Excel导入</button>
        <span class="x-right" style="line-height:40px">未注册学生：<?php echo $count; ?> 名</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>学号</th>
            <th>姓名</th>
            <th>班级</th>
            <th style="text-align: center">删除</th>
          </tr>
        </thead>
        <tbody>
        <?php if(is_array($StudentData) || $StudentData instanceof \think\Collection || $StudentData instanceof \think\Paginator): $i = 0; $__LIST__ = $StudentData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary"
                   data-id='<?php echo $data['Id']; ?>'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td><?php echo $data['number']; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td>未选择</td>
            <td class="td-manage" style="text-align: center">
              <button class="layui-btn layui-btn-sm" title="删除"
                      onclick="member_del(this,<?php echo $data['Id']; ?>)"
              >
                <i class="layui-icon">&#xe640;</i>
              </button>
            </td>
          </tr>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
      <div class="pagination">
        <div>
          <a class="prev" href="./NotStudentView?page=<?php echo $page-1; ?>">&lt;&lt;</a>
          <a class="num" href="./NotStudentView?page=<?php echo $page-1; ?>"><?php echo $page-1; ?></a>
          <span class="current"><?php echo $page; ?></span>
          <a class="num" href="./NotStudentView?page=<?php echo $page+1; ?>">
            <?php
                    $page = $page+1>$num?$page:$page+1;
            echo $page;
            ?>
          </a>
          <a class="num" href="Javascript:">....</a>
          <a class="num" href="./NotStudentView?page=<?php echo $num; ?>"><?php echo $num; ?></a>
          <a class="next" href="./NotStudentView?page=<?php echo $page+1; ?>">&gt;&gt;</a>
        </div>
      </div>

    </div>
    <script>
      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $.ajax({
                  url:"/admin/user/delStudent",
                  dataType:"json",
                  type:"post",
                  data:{
                      Id:id
                  },
                  success:function (data) {
                      if(!data['state'])
                      {
                          layer.msg(data['messages'],{icon:5,time:3000});
                          return false;
                      }
                      if(data['state'])
                      {
                          $(obj).parents("tr").remove();
                          layer.msg(data['messages'],{icon:1,time:2000});
                          return false;
                      }
                      layer.msg('网络延时，刷新后再试',{icon:1,time:2000});
                      return false;
                  }
              });
          });
      }

      function delAll (argument) {

        var data = tableCheck.getData();

        layer.confirm('确认要删除吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.ajax({
                url:"/admin/user/delStudents",
                dataType:"json",
                type:"post",
                data:{
                    "Ary":data
                },
                success:function (data) {
                    if(!data['state'])
                    {
                        layer.msg(data['messages'],{icon:5,time:3000});
                        return false;
                    }
                    if(data['state'])
                    {
                        layer.msg(data['messages'],{icon:1,time:2000});
                        $(".layui-form-checked").not('.header').parents('tr').remove();
                        return false;
                    }
                    layer.msg('网络延时，刷新后再试',{icon:1,time:2000});
                    return false;
                }
            });
        });
      }
    </script>
  </body>

</html>