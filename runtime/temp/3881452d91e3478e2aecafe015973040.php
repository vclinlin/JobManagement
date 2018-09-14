<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:94:"D:\Vc_PHP\Apache24\htdocs\Bookstore\shop\public/../application/index\view\widget\head_nav.html";i:1528121217;}*/ ?>
<nav class="navbar navbar-light navbar-expand-sm bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">ThinkPHP5.0网上书店系统</a>


        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".collapsibleNavbarA">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse justify-content-end collapsibleNavbarA ">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/index/index/login">登录</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index/index/reglogin">注册</a>
                </li>
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        个人中心
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">我的订单</a>
                        <a class="dropdown-item" href="#">我的关注</a>
                        <a class="dropdown-item" href="#">我的消息</a>
                        <a class="dropdown-item" href="#">商品评价</a>
                        <a class="dropdown-item" href="#">商品咨询</a>
                        <a class="dropdown-item" href="#">收货地址</a>
                        <a class="dropdown-item" href="#">账户金额</a>
                        <a class="dropdown-item" href="#">账户安全</a>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</nav>