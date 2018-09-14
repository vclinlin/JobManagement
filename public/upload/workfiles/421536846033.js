window.onload=function(){
    document.onmousedown=function(ev){
        var oEvent=ev||event;
        var oDiv=document.createElement('div');
        var num = Math.floor(Math.random()*17+0); //0-17
        var TextAry = ['富强','民主','和谐','自由','法制','诚信','友善','公正','公平','友爱',
        '敬业','积极','爱国','美丽','善良','可爱','阳光','帅气'
        ];
        var ColorAry =['red','green','blue','BlueViolet','Orange','Magenta','Lime',
            'DimGray','LawnGreen','Aqua','DarkRed'];
        var nums = Math.floor(Math.random()*10+0); //0-10
        var Color =ColorAry[nums];
        var text = TextAry[num];
        var topPx = oEvent.clientY;   //距离顶部的距离
        oDiv.style.left=(oEvent.clientX-30)+'px'; // 指定创建的DIV在文档中距离左侧的位置
        oDiv.style.top=topPx+'px';  // 指定创建的DIV在文档中距离顶部的位置
        // oDiv.style.border='1px solid #FF0000'; // 设置边框
        oDiv.style.position='absolute'; // 为新创建的DIV指定绝对定位
        oDiv.style.width='60px'; // 指定宽度
        oDiv.style.height='20px'; // 指定高度
        oDiv.innerHTML = text;
        oDiv.style.textAlign='center';
        oDiv.style.lineHeight='20px';
        oDiv.style.fontSize='15px';
        oDiv.style.color=Color;
        oDiv.className='oDivA';
        oDiv.style.userSelect='none';
        document.body.appendChild(oDiv);
        $(".oDivA").animate({
            top:(topPx-100)+'px'
        },1000);
        $(".oDivA").fadeOut(100);
    }
}