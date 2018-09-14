<?php
/**
 * Created by PhpStorm.
 * User: 17424
 * Date: 2018/7/8
 * Time: 17:33
 */

namespace app\index\model;


use think\Model;

class Homework extends Model
{
    //开启自动时间戳
    protected $autoWriteTimestamp = true;
    //设置创建时间为自动生成
    protected $createTime = "create_time";
    //关闭不需要的时间戳
    protected $updateTime = false;
}