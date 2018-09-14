$(function () {
    $("#login").click(function () {
        $(".error").remove();
        /**
         * 账号//密码
         * @type {jQuery}
         */
        var userid = $("#userid").val().trim();
        var pass = $("#pass").val().trim();

        /**
         * 规则
         * 账号由6-10个大小写英文字符和数字组成
         * 密码由6-16个大小写英文字符和数字,'+','-',下划线组成
         */
        var C_userid = /^[a-zA-Z0-9]{5,10}$/;
        var C_pass = /^[a-zA-Z0-9\+\-\_]{5,16}$/;
        if(!C_userid.test(userid))
        {
            $(".errors").after('<lable for="login" class="error">账号由5-10个大小写英文字符和数字组成</lable>');
            $('.error').css('color','red');
            $(".error").fadeOut(5000);
            return;
        }
        if(!C_pass.test(pass))
        {
            $(".errors").after('<lable for="login" class="error">密码由5-16个大小写英文字符和数字,\'+\',\'-\',下划线组成</lable>');
            $('.error').css('color','red');
            $(".error").fadeOut(5000);
            return;
        }
        $.ajax({
            url:"/admin/index/login",
            dataType:"json",
            type:"post",
            data:{
                userid,
                pass
            },
            success:function (data) {
                if(data['state'])
                {
                    $(".errors").after('<lable for="login" class="error">' +
                        data['messages'] +
                        '</lable>');
                    $('.error').css('color','red');
                    $(".error").fadeOut(2000,function () {
                        window.location.href='/admin';
                    });
                    return;
                }
                if(!data['state'])
                {
                    $(".errors").after('<lable for="login" class="error">' +
                        data['messages'] +
                        '</lable>');
                    $('.error').css('color','red');
                    $(".error").fadeOut(5000);
                    return;
                }
            },
            error:function (data) {

            }
        })

    });
});