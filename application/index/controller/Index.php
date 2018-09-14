<?php
/**
 * Created by PhpStorm.
 * User: 17424
 * Date: 2018/6/6
 * Time: 8:43
 */

namespace app\index\controller;


use app\admin\model\Student;
use app\admin\model\Teachers;
use think\Controller;
use think\Request;
use think\Session;

class Index extends Controller
{
    protected $beforeActionList=[
        "catetest"=>['only'=>'index']
    ];
    public function index()//即登录界面
    {
        return $this->fetch('index');
    }

    public function cateTest()  //账户类型区分
    {
        if(Session::has('cate'))
        {
           if(Session::get('cate')==1)
           {
               $this->redirect('/index/students');
               return;
           }
           if(Session::get('cate')==2)
           {
                $this->redirect('/index/teachers');
                return;
           }
           Session::delete('cate');
        }
    }
    public function login(Request $request)
    {
        $Ary = $request->post();
        if($Ary['class_number'] ==1)   //学生账户
        {
            $model = new Student();
            if($model->where(['number'=>$Ary['number'],
                'pass'=>md5(md5($Ary['number']).md5($Ary['pass']).md5('!@#$%^&*()_+'))])
                ->select())
            {
                Session::set('user',$Ary['number']);
                Session::set('pass',md5(md5($Ary['number']).md5($Ary['pass']).md5('!@#$%^&*()_+')));
                Session::set('cate',$Ary['class_number']);
                echo json_encode($data=[
                    "state"=>true,
                    "messages"=>"登陆成功",
                    "url"=>"/index/students"
                ]);
                return;
            }
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"账号或密码错误"
            ]);
            return;
            return;
        }
        if($Ary['class_number'] ==2)   //教师账户
        {
            $model = new Teachers();
            if($model->where(['number'=>$Ary['number'],
                'pass'=>md5(md5($Ary['number']).md5($Ary['pass']).md5('!@#$%^&*()_+'))])
            ->select())
            {
                Session::set('user',$Ary['number']);
                Session::set('pass',md5(md5($Ary['number']).md5($Ary['pass']).md5('!@#$%^&*()_+')));
                Session::set('cate',$Ary['class_number']);
                echo json_encode($data=[
                    "state"=>true,
                    "messages"=>"登陆成功",
                    "url"=>"/index/teachers"
                ]);
                return;
            }
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"账号或密码错误"
            ]);
            return;
        }
    }

    public function ExitLogin()
    {
        Session::delete('user');
        Session::delete('pass');
        Session::delete('cate');
        $this->redirect('/');
    }
}