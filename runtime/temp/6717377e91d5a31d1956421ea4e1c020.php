<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:88:"D:\Vc_PHP\Apache24\htdocs\2018\ThinkPHP\public/../application/index\view\index\index.php";i:1527516960;s:87:"D:\Vc_PHP\Apache24\htdocs\2018\ThinkPHP\public/../application/index\view\widget\nav.php";i:1527579772;s:89:"D:\Vc_PHP\Apache24\htdocs\2018\ThinkPHP\public/../application/index\view\widget\turns.php";i:1527516765;s:89:"D:\Vc_PHP\Apache24\htdocs\2018\ThinkPHP\public/../application/index\view\widget\walls.php";i:1527581690;}*/ ?>

<script src="__JS__/index/walls.js"></script>

<div class="row">
    <div class="col-12">留言:<hr style="border: #0C0C0C 2px solid" />
        <div class="input-group mb-3">
            <input type="text" id="wallText" class="form-control" value="" placeholder="说点什么!">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="UpWalls()">留言</button>
            </div>
        </div>
    </div>
    <div class="col-12 pre-scrollable" id="wallCont" style="max-height:300px;">

    </div>
</div>
