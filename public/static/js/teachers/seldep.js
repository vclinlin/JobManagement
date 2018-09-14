$(function () {
    // alert(1);
    $("#btnIn").click(function () {
        if(!confirm('是否已确定填写无误？'))
        {
            return;
        }
        /**
         * 数据获取与验证
         * @type {jQuery}
         */
        var user = $("#user").val().trim();
        var pass = $("#pass").val().trim();
        var repass = $("#repass").val().trim();
        var pwd = $("#pwd").val().trim();
        var department_id = $("#dep").val().trim();
        if(!/^[0-9]{8,16}$/.test(user))
        {
            layer.msg('教师号由8-16位纯数字组成');
            $("#user").addClass("errorBorder");
            return;
        }
        $("#user").removeClass("errorBorder");


        if(!/^[0-9a-zA-Z\+\-\_]{6,16}$/.test(pwd))
        {
            layer.msg('密码由6-16位数字或中英文字符组成');
            $("#pwd").addClass("errorBorder");
            return;
        }
        $("#pwd").removeClass("errorBorder");


        if(!/^[0-9a-zA-Z\+\-\_]{6,16}$/.test(pass))
        {
            layer.msg('密码由6-16位数字或中英文字符组成');
            $("#pass").addClass("errorBorder");
            return;
        }
        if(pass==pwd)
        {
            layer.msg('密码不可与原密码相同');
            $("#pass").addClass("errorBorder");
            return;
        }
        $("#pass").removeClass("errorBorder");

        if(!/^[0-9a-zA-Z\+\-\_]{6,16}$/.test(repass))
        {
            layer.msg('密码由6-16位数字或中英文字符组成');
            $("#repass").addClass("errorBorder");
            return;
        }
        if(repass!=pass)
        {
            layer.msg('两次密码不相同');
            $("#repass").addClass("errorBorder");
            return;
        }
        $("#repass").removeClass("errorBorder");

        if(!department_id>0)
        {
            layer.msg('请选择系部');
            $("#dep").addClass("errorBorder");
            return;
        }
        $("#dep").removeClass("errorBorder");
        //异步激活账号
        $.ajax(
            {
                url:"/index/teachers/activated",
                dataType:"json",
                type:"post",
                data:{
                    'number':user,
                    pass,
                    department_id
                },
                success:function (data) {
                    if(!data.state)
                    {
                        layer.msg(data.messages);
                        return;
                    }
                    if(data.state)
                    {
                        layer.msg(data.messages,{time:2000},function () {
                            window.location.href="/";
                        });
                        return;
                    }
                }
            }
        )

    })
})
