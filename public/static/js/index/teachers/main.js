$(function (){
    $("#main_nav").addClass('fixed-top');
    // console.log($("#main_nav")["0"].clientHeight); //打印一下当前导航栏高度
    $(".line-one").css('margin-top',$("#main_nav")[0].clientHeight+'px'); //偏移下方内容所在位置 <公共属性 行一>
});
function OpenUrl(_this) {
    window.location.href=_this.dataset.url;
}