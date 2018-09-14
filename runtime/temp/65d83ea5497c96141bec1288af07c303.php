<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:88:"D:\Vc_PHP\Apache24\htdocs\2018\ThinkPHP\public/../application/index\view\index\index.php";i:1527516960;s:87:"D:\Vc_PHP\Apache24\htdocs\2018\ThinkPHP\public/../application/index\view\widget\nav.php";i:1527579772;}*/ ?>
<?php

?>
<link rel="stylesheet" href="__CSS__/index/nav.css">
<!--Nav资源-->

<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
    <!-- Brand -->
    <a class="navbar-brand" href="javascript:" id="Logo">知否丶</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/index">首页</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:">文章</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:">相册</a>
            </li>
        </ul>
    </div>
    <div class="collapse navbar-collapse justify-content-end collapsibleNavbar" id="ItemsR">
        <?php if(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty())): ?>
        <ul class="navbar-nav">
            <li class="nav-item"><a href="/index/index/Regview" class="nav-link">注册</a></li>
            <li class="nav-item"><a href="/index/index/LoginView" class="nav-link">登录</a></li>
        </ul>
        <?php else: if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <ul class="navbar-nav">
            <li class="dropdown">
                <a class=" dropdown-toggle" href="javascript:" data-toggle="dropdown">
                    <img style="height:40px;width:40px;" src="/<?php echo $vo['img_url']; ?>"  alt="<?php echo $vo['username']; ?>"\>
                    <span class="caret"></span>
                </a>
                <ul  class="dropdown-menu">
                    <li>
                        <a href="/index/index/exitlogin" tabindex="-1">
                            <i class="fa fa-sign-out"></i>退出
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <?php endforeach; endif; else: echo "" ;endif; endif; ?>


    </div>
</nav>
