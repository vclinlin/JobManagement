<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:95:"D:\Vc_PHP\Apache24\htdocs\Bookstore\shop\public/../application/index\view\widget\retrieval.html";i:1528096098;}*/ ?>
<link rel="stylesheet" href="__CSS__/index/retrieval.css">

<nav class="navbar navbar-expand-md bg-white">
    <div class="container " id="ret_nav">  <!-- 大屏内容 -->
        <!-- logo位 -->
    <a class="navbar-brand" href="#">
        <img src="__IMG__/logo.png" alt="javascript:">
    </a>
        <!-- 商品检索 -->
    <ul class="navbar-nav">
        <li class="nav-item m-md-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="搜索商品"
                       aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button">搜索</button>
                </div>
            </div>
        </li>
    </ul>
        <!-- 购物车 -->
        <ul class="navbar-nav">
            <li class="nav-item m-md-3">
                <button class="btn btn-danger" type="button">购物车</button>
            </li>
        </ul>
    </div>
    <div class="container" id="ret_navs"><!-- 小屏内容 -->
        <div class="row navbar-nav">
            <div class="col-12 nav-item m-md-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="搜索商品"
                           aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">搜索</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>