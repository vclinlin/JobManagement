$(function () {
    onloadClass();
});
function onloadClass() {   //加载班级
    // console.log($("#sel1 option:selected").val());   //获取选中的专业值
    var professional_id = $("#sel1 option:selected").val();
    $.ajax({
        url:"/index/teachers/getclass",
        dataType:"json",
        type:"post",
        data:{
            professional_id
        },
        success:function (data) {
            if(data.state!=200)
            {
                $('#Vc_class').empty();
                $("#Vc_class").append('<option>加载失败</option>');
                return;
            }
            $('#Vc_class').empty();
            for(let i =0;i<data.data.length;i++)
            {
                $("#Vc_class").append('<option value="'+data.data[i].Id+'">'+
                    data.data[i].name+'-['+data.data[i].grade+
                    '级'+data.data[i].sequence+'班]</option>');
            }
        }
    })
}
function SubCourse() {
    var class_id=$("#Vc_class option:selected").val();  //班级选择
    var name = $("#names").val().trim();  //课程名
    if(!/^[A-Za-z0-9\u4e00-\u9fa5]+$/.test(name))
    {
        layer.msg('课程名只能包含中英文字符与数字',{time:1500});
        return;
    }
    $.ajax({
        url:"/index/teachers/addcoursedata",
        dataType:"json",
        type:"post",
        data:{
            class_id,
            name
        },
        success:function (res) {
            if(res.state!=200)
            {
                layer.msg(res.message);
                return;
            }
            layer.msg(res.message,{icon: 16,time:1000,shade : [0.5 , '#000' , true]},function (){
                document.getElementById("names").value=null;
                if(confirm("是否立即上传封面"))
                {
                    window.location.href="/index/teachers/CourseImgView?id="+res.id;
                    return;
                }
            });
            return;
        }
    })

}