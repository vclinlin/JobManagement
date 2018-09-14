<?php
/**
 * Created by PhpStorm.
 * User: 17424
 * Date: 2018/6/18
 * Time: 16:16
 */

namespace app\index\controller;


use app\index\model\Course;
use app\index\model\Department;
use app\index\model\Homework;
use app\index\model\Professional;
use app\index\model\Vc_class;
use think\Controller;
use think\Db;
use think\Image;
use think\Request;
use think\Session;

class Teachers extends Controller
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
        $model = new \app\index\model\Teachers();
        if($model->where(['number'=>Session::get('user'),'state'=>'0'])
            ->where('department_id','<>','0')->select())
        {
            echo "<h2 style='color: red;text-align: center'>你的账号已被冻结,请联系管理员有关部门处理</h2>";
            exit();
        }

    }

    public function LoginTest()
    {
        if(!Session::has('cate')||Session::get('cate')!=2)
        {
            return false;
        }
        if(Session::has('user')&&Session::has('pass'))
        {
            $model = new \app\admin\model\Teachers();
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
        $model = new \app\index\model\Teachers();
        if($model->where(['number'=>Session::get('user'),'department_id'=>'0'])
            ->select())
        {
            $this->redirect('/index/teachers/seldep');
            exit();
        }
        $Details = Db::field('A.name,A.number,B.name as depName')
            ->table(['teachers'=>'A','department'=>'B'])
            ->where('A.department_id=B.Id and A.number='.Session::get('user').'')->select();
        $this->assign('Details',$Details);
        return $this->fetch('teachers/index');
    }
    public function SelDep()  //首次登录初始化
    {
        $model = new \app\index\model\Teachers();
        $data = $model->where(['number'=>Session::get('user'),'pass'=>Session::get('pass')])
            ->field('name,number,department_id')->select();
        if($data[0]['department_id']!=0) //已经首次登陆过且激活账号过的
        {
            $this->error('你不可以这么做');
            return;
        }
        $model = new Department();
        $depData = $model->all();
        $this->assign('DepData',$depData);
        $this->assign('data',$data);
        return $this->fetch('teachers/seldep');
    }
    public function Activated(Request $request)  //教师账号初次激活
    {
        //二次验证
        $Ary = $request->post();
        if($Ary['number']!==Session::get('user'))
        {
            echo json_encode($data = [
                "state"=>false,
                "messages"=>"只能输入你自己的教师号"
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
        $model = new \app\index\model\Teachers();
        if(!$model->where(['number'=>Session::get('user')])
        ->update(['department_id'=>$Ary['department_id'],'pass'=>$Ary['pass'],'state'=>1]))
        {
            echo json_encode($data = [
                "state"=>false,
                "messages"=>"激活账号失败,请稍后再试"
            ]);
            return;
        }
        $model = new Department();
        $model->where(['Id'=>$Ary['department_id']])->setInc('teachers_count');
        echo json_encode($data = [
            "state"=>true,
            "messages"=>"激活成功,请重新登陆"
        ]);
        return;
    }
    public function Personal()  //个人中心
    {
        return $this->fetch();
    }
    public function Course()  //我的课程
    {
        //教师
        $id = $this->GetTeachersId();
        //课程
        //显示班级
        $data = Db::field('a.Id,s.name as class_name,a.img_url,s.grade,s.sequence,a.name as course_name')
        ->table(['course'=>'a','vc_class'=>'s'])
        ->where('a.class_id=s.id and a.teachers_id='.$id.'')
        ->order('a.Id','asc')->paginate(11);
        $this->assign('data',$data);
        //获取分页
        $page = $data->render();
        $this->assign('page',$page);
        return $this->fetch();
    }
    public function CourseDetails()  //课程作业视图
    {
        //获取教师id防止越权课程
        $id = $this->GetTeachersId();
        //课程id
        $course_id = $_GET['id'];
        $model = new Course();
        if(!$model->where(['Id'=>$course_id,'teachers_id'=>$id])->select())
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
        return $this->fetch();
    }

    public function AddWorkView() //新增作业视图页
    {
        //获取教师id防止越权课程
        $id = $this->GetTeachersId();
        //课程id
        $course_id = $_GET['id'];  //传递
        $model = new Course();
        if(!$model->where(['Id'=>$course_id,'teachers_id'=>$id])->select())
        {
            $this->error('权限不足');
            return;
        }
        $this->assign('id',$course_id);
        return $this->fetch('addwork');
    }

    public function AddWork(Request $request)//添加作业
    {
        $Ary = $request->post();
        $id = $this->GetTeachersId();//教师id
        $model = new Course();
        if(!$model->where(['Id'=>$Ary['course_id'],'teachers_id'=>$id])->select())
        {
            echo json_encode([
                "state"=>0,
                "message"=>"课程权限不足"
            ]);
            return;
        }
        $Ary['end_time']=strtotime($Ary['end_time']."23:59:59");//时间转化
        $Ary['title'] = htmlentities($Ary['title'],ENT_QUOTES,'UTF-8');
        $Ary['msg'] = htmlentities($Ary['msg'],ENT_QUOTES,'UTF-8');
        $Ary['msg_cut']=mb_substr($Ary['msg'],0,15,'utf-8');//截取片段
        $model = new Homework();
        if(!$model->save($Ary))
        {
            echo json_encode([
                "state"=>0,
                "message"=>"作业添加失败"
            ]);
            return;
        }
        echo json_encode([
            "state"=>200,
            "message"=>"已添加作业[".$Ary['title'].']'
        ]);
        return;
    }
    public function GetTeachersId()
    {
        //获取教师id防止越权课程
        $model = new \app\index\model\Teachers();
        $Iddata = $model->where(['number'=>Session::get('user'),
            'pass'=>Session::get('pass')
        ])->field('Id')->select();
        $id = $Iddata[0]['Id'];
        return $id;
    }
    public function AddCourse()   //新增课程视图页面
    {
        //获取教师数据
        $model = new \app\index\model\Teachers();
        $Iddata = $model->where(['number'=>Session::get('user'),
            'pass'=>Session::get('pass')
        ])->field('Id,department_id')->select();
        //系部id
        $department = $Iddata[0]['department_id'];
        //获取专业
        $model = new Professional();
        $depData = $model->where(['department_id'=>$department])->select();
        $this->assign('data',$depData);
        return $this->fetch();
    }

    public function CourseImgView($id)  //添加课程封面视图界面
    {
        $model = new Course();
        if(!$model->get(['Id'=>$id]))
        {
            $this->error('该课程不存在');
            return;
        }
        $data =$model->where(["Id"=>$id])->field('img_url')->select()[0]['img_url'];
        $this->assign('id',$id);
        $this->assign('data',$data);
        return $this->fetch('');
    }
    public function GetClass(Request $request)  //获取班级数据
    {
        $Ary = $request->post();
        $model = new Vc_class();
        $data = $model->where($Ary)->select();
        echo json_encode([
            "state"=>200,
            "data"=>$data
        ]);
        return;
    }

    public function AddCourseData(Request $request)//教师新增课程事件
    {
        $Ary = $request->post();
        //教师id
        $Ary['teachers_id']= $this->GetTeachersId();
        $model = new Course();
        if($model->get(['class_id'=>$Ary['class_id'],'name'=>$Ary['name']]))
        {
            echo json_encode([
                "state"=>0,
                "message"=>"该班级已存在相关课程"
            ]);
            return;
        }
        if(!$model->save($Ary))
        {
            echo json_encode([
                "state"=>0,
                "message"=>"添加课程失败,稍后再试"
            ]);
            return;
        }
        $id = $model->where($Ary)->select()[0]['Id'];
        echo json_encode([
            "state"=>200,
            "message"=>"已添加新课程".$Ary['name'],
            "id"=>$id
        ]);
        $model = new Vc_class();
        $model->where(["Id"=>$Ary['class_id']])->setInc('course_count');
        return;
    }

    public function UpCourseImg($id)  //更新课程封面
    {
        $file = $this->request->file('file');
        //保存并裁剪
        $data=Course::get(["Id"=>$id]);
        $model = new Course();
        $info = $file->validate(['ext'=>'jpg,png,gif'])
            ->move(ROOT_PATH . 'public' . DS . 'upload'.DS.'course_img',$data['Id'].'img');
        if(!$info){
            echo json_encode([
                "code"=>0,
                "msg"=>"文件上传失败！".$file->getError()
            ]);
            return;
        }
        $path ='/upload/course_img/'.$info->getFilename();
        $path = str_replace('\\','/',$path);
        if($data['img_url']!=""||$data['img_url']!=null)
        {
            //倘若该文件存在，且与当前上传的不是同一个,则删除
            if(file_exists('.'.$data['img_url'])&&$data['img_url']!=$path)
            {
                unlink('.'.$data['img_url']);
            }
        }
        $model->where(['Id'=>$id])->update(['img_url'=>$path]);
        echo json_encode([
            "code"=>200,
            "msg"=>"封面修改完成"
        ]);
        return;
    }
    public function Pending()  //待批阅作业
    {
        return $this->fetch();
    }
    public function Marking()  //已批阅作业
    {
        return $this->fetch();
    }
    public function Information()  //已批阅作业
    {
        return $this->fetch();
    }
    public function WorkDetails($id,$course_id)
    {
        $workModel = new Homework();
        //防止越权访问
        $rel = $workModel->get(['Id'=>$id,'course_id'=>$course_id]);
        $courseModel = new Course();
        $TeachersId = $this->GetTeachersId();
        $rels = $courseModel -> get(['Id'=>$course_id,'teachers_id'=>$TeachersId]);
        if(!$rel||!$rels)
        {
            return $this->error('非正常访问');
        }
        $this->assign('course_data',$rel); //该作业信息
        return $this->fetch('workdetails');
    }

    public function UpDateWork($id,$course_id)
    {
        $workModel = new Homework();
        //防止越权访问
        $rel = $workModel->get(['Id'=>$id,'course_id'=>$course_id]);
        $courseModel = new Course();
        $TeachersId = $this->GetTeachersId();
        $rels = $courseModel -> get(['Id'=>$course_id,'teachers_id'=>$TeachersId]);
        if(!$rel||!$rels)
        {
            return $this->error('非正常访问');
        }
        $this->assign('data',$rel);
        return $this->fetch('updatework',['id'=>$course_id]);
    }

    public function UpDateWorks(Request $request)  //更新
    {
        $Ary = $request->post();
        $id = $this->GetTeachersId();//教师id
        $model = new Course();
        if(!$model->where(['Id'=>$Ary['course_id'],'teachers_id'=>$id])->select())
        {
            echo json_encode([
                "state"=>0,
                "message"=>"课程权限不足"
            ]);
            return;
        }
        if(array_key_exists('end_time',$Ary))
        {
            $Ary['end_time']=strtotime($Ary['end_time']."23:59:59");//时间转化
//            echo $Ary['end_time'];
        }
        $Ary['title'] = htmlentities($Ary['title'],ENT_QUOTES,'UTF-8');
        $Ary['msg'] = htmlentities($Ary['msg'],ENT_QUOTES,'UTF-8');
        $Ary['msg_cut']=mb_substr($Ary['msg'],0,15,'utf-8');//截取片段
        $model = new Homework();
        if(!$model->where(['Id'=>$Ary['Id'],'course_id'=>$Ary['course_id']])->
        update($Ary))
        {
            echo json_encode([
                "state"=>0,
                "message"=>"作业更新失败"
            ]);
            return;
        }
        echo json_encode([
            "state"=>200,
            "message"=>"已更新作业[".$Ary['title'].']'
        ]);
        return;
    }
}