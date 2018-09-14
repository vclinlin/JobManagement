$(function () {
   // alert(1);
});

/**
 * 单条删除
 * @param obj
 * @param id
 */
function member_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
        //发异步删除数据
        $.ajax({
            url:"/admin/index/delepro",
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