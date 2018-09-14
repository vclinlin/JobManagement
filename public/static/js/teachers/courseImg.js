$(function () {
    $("#file0").change(function(){   //文件客户端验证
        var file = this.value;  //得到文件
        if(!/.(gif|jpg|jpeg|png|GIF|JPG|bmp)$/.test(file)){  //非图片文件排除
            layer.msg("图片类型必须是.gif,jpeg,jpg,png,bmp中的一种");
            this.value=null;
            return false;
        }
        //返回Byte(B),保留小数点后两位
        if(((this.files[0].size).toFixed(2))>=(2*1024*1024)){  //限制大小2M
            layer.msg("请上传小于2M的图片");
            this.value=null;
            return false;
        }
        //验证通过
        var objUrl = getObjectURL(this.files[0]) ;
        if (objUrl) {
            $("#imgA").attr("src", objUrl) ;
        }
    }) ;
});
function FileUp(_this) {
    var formData = new FormData();
    formData.append("file", $("#file0")[0].files[0]);
    $.ajax({
        url:'/index/teachers/UpCourseImg?id='+_this.dataset.id,
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
                layer.msg(res.msg,{icon:1,time:1000,shade : [0.5 , '#000' , true]});
                return;
            }
            layer.msg(res.msg,{icon:0,time:1000,shade : [0.5 , '#000' , true]});
            return;
        }
    });
}
//建立一個可存取到該file的url
function getObjectURL(file) {
    var url = null ;
    if (window.createObjectURL!=undefined) { // basic   开始浏览器功能判断
        url = window.createObjectURL(file) ;
    } else if (window.URL!=undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file) ;
    } else if (window.webkitURL!=undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file) ;
    }
    return url ;
}