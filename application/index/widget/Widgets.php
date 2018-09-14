<?php
/**
 * Created by PhpStorm.
 * User: 17424
 * Date: 2018/6/25
 * Time: 22:03
 */

namespace app\index\widget;


use app\admin\model\Student;
use app\admin\model\Teachers;
use app\index\model\Workfiles;
use think\Controller;
use think\Session;

class Widgets extends Controller
{
    public function Teachers()
    {
        $model = new Teachers();
        $data = $model->where(['number'=>Session::get('user'),'pass'=>Session::get('pass')])
            ->field('name,number,department_id,state')->select();
        $this->assign('data',$data);
        return $this->fetch('widgets/teachers');
    }

    public function Students()
    {
        $model = new Student();
        $data = $model->where(['number'=>Session::get('user'),'pass'=>Session::get('pass')])
            ->field('name,number')->select();
        $this->assign('data',$data);
        return $this->fetch('widgets/students');
    }

    public function workstate($work_id)
    {
        $model = new Workfiles();
        if($model->get(['work_id'=>$work_id,'students_num'=>Session::get('user')]))
        {
           echo '已';
        }
        else {
            echo '未';
        }
    }
}