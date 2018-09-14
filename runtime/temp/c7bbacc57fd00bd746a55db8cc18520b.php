<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:105:"D:\Vc_PHP\Apache24\htdocs\2018\WorkManagement\shop\public/../application/index\view\widgets\teachers.html";i:1530754214;}*/ ?>
<nav id="main_nav" class="navbar navbar-expand-sm bg-success navbar-dark">
    <!-- Brand/logo -->
    <div class="container">
        <a class="navbar-brand" href="/">云课堂V1.0</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Links -->
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav ">
                <li class="nav-item dropdown">
                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                    <a class="nav-link dropdown-toggle" href="javascript:" id="navbardrop" data-toggle="dropdown">
                        <?php echo $data['name']; ?>-老师
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/index/index/exitlogin">注销</a>
                        <a class="dropdown-item" href="javascript:">个人中心</a>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>