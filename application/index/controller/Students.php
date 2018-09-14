<?php
/**
 * Created by PhpStorm.
 * User: 17424
 * Date: 2018/6/18
 * Time: 15:21
 */

namespace app\index\controller;


use app\admin\model\Student;
use app\admin\model\Vc_class;
use app\index\model\Course;
use app\index\model\Error_log;
use app\index\model\Homework;
use app\index\model\Workfiles;
use think\Db;
use think\Request;
use think\Session;
use think\Controller;

class Students extends Controller
{
    /**
     * @var array
     * 排除恶意跨权限访问用户
     */
    protected $beforeActionList=[
        'check'=>['except'=>'logintest']
    ];

    public function check()
    {
        if(!$this->LoginTest())
        {
            $this->redirect('/');
            exit();
        }
        $model = new Student();
        if($model->where(['number'=>Session::get('user'),'state'=>'0'])
            ->where('class_id','<>','0')->select())
        {
            echo "<h2 style='color: red;text-align: center'>你的账号已被冻结,请联系管理员有关部门处理</h2>";
            exit();
        }
    }

    public function LoginTest()
    {
        if(!Session::has('cate')||Session::get('cate')!=1)
        {
            return false;
        }
        if(Session::has('user')&&Session::has('pass'))
        {
            $model = new Student();
            if(!$model->where(['number'=>Session::get('user'),'pass'=>Session::get('pass')])->select())
            {
                Session::delete('user');
                Session::delete('pass');
                Session::delete('cate');
                $this->redirect('/');
                return false;
            }
            return true;
        }
        //防止重复跳转,删除状态识别码
        Session::delete('cate');
        return false;
    }
    public function index()
    {
        $model = new Student();
        $data = $model->where(['number'=>Session::get('user'),'pass'=>Session::get('pass')])
            ->field('name,number,class_id,state')->select();
        if($data[0]['class_id']==0)
        {
            $this->redirect('/index/students/selclass');
            return;
        }
        $Details = Db::field('A.name,A.number,B.name as ClassName')
            ->table(['student'=>'A','vc_class'=>'B'])
            ->where('A.class_id=B.Id and A.number='.Session::get('user').'')->select();
        $this->assign('Details',$Details);
        return $this->fetch('index');
    }

    public function SelClass() //初始化学生账号
    {
        $model = new Student();
        $data = $model->where(['number'=>Session::get('user'),'pass'=>Session::get('pass')])
            ->field('name,number,class_id')->select();
        if($data[0]['class_id']!=0) //已经首次登陆过且激活账号过的
        {
            $this->error('你不可以这么做');
            return;
        }
        $Class = Vc_class::all();
        $this->assign('classdata',$Class);
        $this->assign('data',$data);
        return $this->fetch('selclass');
    }
    public function Activated(Request $request)  //学生账号初次激活
    {
        //二次验证
        $Ary = $request->post();
        if($Ary['number']!==Session::get('user'))
        {
            echo json_encode($data = [
                "state"=>false,
                "messages"=>"只能输入你自己的学号"
            ]);
            return;
        }
        if($Ary['pass']=="123456")
        {
            echo json_encode($data = [
                "state"=>false,
                "messages"=>"123456不可做为密码"
            ]);
            return;
        }
        //加密
        $Ary['pass'] = md5(md5(Session::get('user')).md5($Ary['pass']).md5('!@#$%^&*()_+'));
        $model = new Student();
        if(!$model->where(['number'=>Session::get('user')])
            ->update(['class_id'=>$Ary['class_id'],'pass'=>$Ary['pass'],'state'=>1]))
        {
            echo json_encode($data = [
                "state"=>false,
                "messages"=>"激活账号失败,请稍后再试"
            ]);
            return;
        }
        $model = new Vc_class();
        $model->where(['Id'=>$Ary['class_id']])->setInc('student_count');
        echo json_encode($data = [
            "state"=>true,
            "messages"=>"激活成功,请重新登陆"
        ]);
        return;
    }
    /**
     * 功能块
     */
    public function GetMyData()  //获取自己有关数据
    {
        $model = new Student();  //实例化
        $data = $model->where(['number'=>Session::get('user'),'pass'=>Session::get('pass')])
            ->field('Id,class_id,name')->select();
        return $data[0];
    }
    public function Course()//学生课程
    {
        //获取自己相关信息
        $mydata = $this->GetMyData();
        $model = new Course();
        $data = $model->where(['class_id'=>$mydata['class_id']])->paginate(11);
        $this->assign('data',$data);
        //获取分页
        $page = $data->render();
        $this->assign('page',$page);
        return $this->fetch('mycourse');
    }

    public function CourseDetails()//课程作业页面
    {
        //获取学生信息防止越权课程
        $mydata = $this->GetMyData();
        //课程id
        $course_id = $_GET['id'];
        $model = new Course();
        if(!$model->where(['Id'=>$course_id,'class_id'=>$mydata['class_id']])->select())
        {
            $this->error('权限不足');
            return;
        }
        $model = new Homework();
        //显示该课程的所有作业
        $data = $model->where(['course_id'=>$course_id])->paginate(8,false,
            ['query'=>request()->param()]);
        $this->assign('data',$data);
        $this->assign('page',$data->render());
        $this->assign('course',[
            "course_id"=>$course_id,
            "name"=>$_GET['key']
        ]);
        return $this->fetch('coursedetails');
    }
    public function WorkDetails($id)//作业详情界面
    {
        //清理失效文件
        $model = new Error_log();
        $ErrorData = Error_log::all();
        for($i=0;$i<count($ErrorData);$i++)
        {
            if(file_exists('.'.$ErrorData[$i]['path']))
            {
                @unlink('.'.$ErrorData[$i]['path']);
            }
            else
            {
                $model -> where(['path'=>$ErrorData[$i]['path']])->delete();
            }
        }
//        echo $id;  //作业id
        //获取学生信息验证作业有效性
        $mydata = $this->GetMyData();
        //作业有效验证
        $workModel = new Homework();
        //该作业信息
        $workData = $workModel->get(['Id'=>$id]);
        //非正常访问,或者作业已过期
        if(!$workData||$workData['end_time']<time())
        {
            $this->error('作业不存在,或作业已过期');
            return;
        }
        $course_id = $workData['course_id'];
//        echo $course_id;
        $courseModel = new Course();
        //如果作业不是学生所在班级的课程下的,返回错误反馈
        if(!$courseModel->where(['Id'=>$course_id,'class_id'=>$mydata['class_id']])->select())
        {
            $this->error('作业不存在');
            return;
        }
        //判断作业是否已答题
        $fileWork = new Workfiles();
        $fileWorkData = $fileWork->get(['students_num'=>Session::get('user'),'work_id'=>$id]);
        if($fileWorkData)
        {
            $workData['workState'] = 1;
            $workData['workUpdateTime'] = $fileWorkData['updatetime'];
            $this->assign('datas',$fileWorkData);
        }
        else
        {
            $workData['workState'] = 0;
        }
        $this->assign("work",$workData);
        return $this->fetch();

    }

    public function UpWorkFiles($course_id,$work_id,$end_time)
    {
        //获取学生信息验证作业有效性
        $mydata = $this->GetMyData();
        $workModel = new Homework();
        $rel = $workModel->get(['course_id'=>$course_id,'Id'=>$work_id,'end_time'=>$end_time]);
        //防止修改参数上传作业文件
        if(!$rel)
        {
            echo json_encode([
                "code"=>0,
                "msg"=>"作业提交失败:作业信息错误"
            ]);
            return;
        }
        if($end_time<time())
        {
            echo json_encode([
                "code"=>0,
                "msg"=>"作业提交失败:答题时间已过"
            ]);
            return;
        }
        $file = $this->request->file('file');
        $info = $file->move('./upload/workfiles',''.$mydata['Id'].time());
        if(!$info){
            echo json_encode([
                "code"=>0,
                "msg"=>"文件上传失败！".$file->getError()
            ]);
            return;
        }
        // 文件有效路径
        $path = '/upload/workfiles/'.$info->getSaveName();
        // 文件类型
        $type = $info->getExtension();
        $data=[
            'work_id'=>$work_id,
            'student_id'=>$mydata['Id'],
            'students_name'=>$mydata['name'],
            'students_num'=>Session::get('user'),
            'course_id'=>$course_id,
            'type'=>0,
            'message'=>$path,
            'file_type'=>$type,
            'updatetime'=>time()
        ];
        $model = new Workfiles();
        //未回答过本次作业
        $relData = $model->get(['work_id'=>$work_id,'student_id'=>$mydata['Id']]);
        if(!$relData) {
            if (!$model->save($data)) {
                $errorModel = new Error_log();
                $errorModel->save(['path' => $path]);
                echo json_encode([
                    "code" => 0,
                    "msg" => "作业提交失败,稍后再试"
                ]);
                return;
            }
            echo json_encode([
                "code"=>200,
                "msg"=>"作业提交完成"
            ]);
            return;
        }else{
            $errorModel = new Error_log();
            // 作业已经批阅
            if($relData['state'] == 1)
            {
                $errorModel->save(['path' => $path]);
                echo json_encode([
                    "code" => 0,
                    "msg" => "作业已批阅,无法完成操作"
                ]);
                return;
            }

            $errorModel->save(['path' => $relData['message']]);
            $data['count_sum'] = $relData['count_sum'] +=1;
            if (!$model->where(['work_id'=>$work_id,'student_id'=>$mydata['Id']])->update($data)) {
                $errorModel = new Error_log();
                $errorModel->save(['path' => $path]);
                echo json_encode([
                    "code" => 0,
                    "msg" => "作业更新失败,稍后再试"
                ]);
                return;
            }
            echo json_encode([
                "code"=>200,
                "msg"=>"作业更新完成"
            ]);
            return;
        }
    }
}