<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:98:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\public/../application/admin\view\index\add.html";i:1528370185;}*/ ?>
<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>增加系部</title>
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
        <form class="layui-form" onsubmit="return false">
          <div class="layui-form-item">
              <label for="DepName" class="layui-form-label">
                  <span class="x-red">*</span>系部名
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="DepName" name="username"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
            <div class="layui-form-item">
                <label for="DepName" class="layui-form-label">
                </label>
                <button onclick="add()"  class="layui-btn" lay-filter="add">
                    增加
                </button>
            </div>
      </form>
    </div>
    <script>
        function add() {
            var name = $("#DepName").val().trim();
            var names = /^[0-9a-zA-Z\u4e00-\u9fa5]{1,16}$/;
            if(!names.test(name))
            {
                layer.msg('系部名称由1-32个数字,中英文字符组成');
                return false;
            }
            $.ajax({
                url:"/admin/index/adddep",
                dataType:"json",
                type:"post",
                data:{
                    name:name
                },
                success:function (data) {
                    if(!data['state'])
                    {
                        layer.msg(data['messages']);
                        return false;
                    }
                    if(data['state'])
                    {
                        layer.msg(data['messages']);
                        document.getElementById('DepName').value="";
                        return false;
                    }
                }
            })
        }
    </script>
  </body>

</html>