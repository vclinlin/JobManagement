<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:98:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\public/../application/muban\view\index\accounting.html";i:1525696043;s:77:"D:\Vc_PHP\Apache24\htdocs\2018\TP5\ThinkPHP\application\muban\view\tpout.html";i:1525760946;}*/ ?>

<head>
    <title>记账</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="__BOOTSTRAP__/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
    <link href="__BOOTSTRAP__/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
    <link href="__BOOTSTRAP__/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="__BOOTSTRAP__/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="__BOOTSTRAP__/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="__JS__/muban/echarts.min.js" type="text/javascript"></script>
    <script src="__BOOTSTRAP__/js/bootstrap.min.js" type="text/javascript"></script>
    <style>
        body
        {
            padding: 0;
            margin: auto;
        }
        .row
        {
            padding: 0;
            margin:auto;
        }
        .col-sm
        {
            padding: 0;
        }
    </style>
    <script>
        $(function (){
            
        });
        function subT()
        {
            var val=$('input:radio[name="xfclass"]:checked').val();
            var amount = $("#Amount").val();
            if(!val)
            {
                alert("至少选择一项");
                return ;
            }
            if(!amount>0)
            {
                alert("金额无效");
                return ;
            }
            $.ajax({
               url: "/muban/index/accountings",
               type: 'POST',
               dataType: 'json',
               data: {
                   xfclass:val,
                   amount:amount
               },
               success: function (data, textStatus, jqXHR) {
                        
                    }
            });
        }
        function outS()
        {
            $.ajax({
                url: "/muban/index/outs",
                dataType: 'json',
                type: 'GET',
                success: function (data, textStatus, jqXHR) {
                    var datas = [];
                    x=0;
                    for(i in data)
                    {
                        datas[x]={value:data[i]['sum(amount)'], name:data[i]['xfclass']};
                        x++;
                    }
                    console.log(datas);
                var Chart = echarts.init(document.getElementById("xfChart"));   //初始化图表容器
    var option = {
    series : [
        {
            name: '访问来源',
            type: 'pie',
            radius: '55%',
            data:datas
        }
    ]
};
    Chart.setOption(option);//图表显示
                    }
            });
        }
    </script>
</head>
   


<body>
<div class="row">
<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="col-2 bg-dark text-center text-white">
        <input type="radio" name="xfclass" class="xfclass" value="<?php echo $vo['class']; ?>" /><?php echo $vo['class']; ?>
    </div>
<?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="row">
    <div class="col">
        <label for="Amount">金额:</label>
        <input type="text" class="form-control" id="Amount">
        <input type="button" class="btn btn-primary" onclick="subT()" value="提交"/>
        <input type="button" class="btn btn-primary" onclick="outS()" value="预览"/>
    </div>
</div>
    <div class="row">
        <div class="col">
            <div id="xfChart" style="width: 100%;height: 400px;"></div>
        </div>
    </div>
</body>
    

   
