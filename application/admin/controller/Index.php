<?php
/**
 * Created by PhpStorm.
 * User: 17424
 * Date: 2018/6/6
 * Time: 19:04
 */

namespace app\admin\controller;


use app\admin\model\Admin_user;
use app\admin\model\Course;
use app\admin\model\Department;
use app\admin\model\Professional;
use app\admin\model\Teachers;
use app\admin\model\Vc_class;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class Index extends Controller
{
    /**
     * @return mixed
     *访问控制，限制使部分需登录
     */
    protected $beforeActionList = [
        "LoginTest"=>["except"=>'login,logincheck,loginview,exitlogin'],
    ];
    public function index()
    {
        return $this->fetch('index');
    }

    public function LoginTest()
    {
        if(!$this->LoginCheck())  //未登录
        {
            return $this->redirect('/admin/index/loginview');
        }
    }
    public function LoginCheck()
    {
        //检测登录记录
        if(!Session::has('userid')&&Session::has('pass'))
        {
            return false;
        }
        /**
         * 核对登录记录
         */
        $userid = Session::get('userid');
        $pass = Session::get('pass');
        $model = new Admin_user();
        $rel = $model->where([
            "userid"=>$userid,
            "pass"=>$pass
        ])->select();
        if(!$rel)
        {
            Session::delete('userid');  //清除失效数据
            Session::delete('pass');
            return false;
        }
        return true;   //通过
    }
    public function welcome()
    {
        echo 2;
    }
    public function LoginView() //登录界面
    {
        if($this->LoginCheck())  //已登录
        {
            return $this->redirect('/admin');
        }
        return $this->fetch('login');
    }

    public function login(Request $request)
    {
        $dataAry = $request->post();
        /**
         * 二次数据审查
         * state  状态
         */
        if(!preg_match('/^[a-zA-Z0-9]{5,10}$/',$dataAry['userid']))
        {
            echo json_encode($data = [

                "state"=>false,
                "messages"=>"账号由5-10个大小写英文字符和数字组成"
            ]);
            return;
        }
        if(!preg_match('/^[a-zA-Z0-9\+\-\_]{5,16}$/',$dataAry['pass']))
        {
            echo json_encode($data = [
                "state"=>false,
                "messages"=>"密码由5-16个大小写英文字符和数字,'+','-',下划线组成"
            ]);
            return;
        }
        /**
         * 登录验证
         */
        $model = new Admin_user();
        if(!$rel = $model->where([
            "userid"=>$dataAry['userid'],
            "pass"=>md5(md5($dataAry['userid']).md5($dataAry['pass']).md5('!@#$%^&*()_+'))
        ])->select())
        {
            echo json_encode($data = [
                "state"=>false,
                "messages"=>"账号或密码不正确!"
            ]);
            return;
        }
        /**
         * 生成登录记录
         */
        Session::set('userid',$dataAry['userid']);
        Session::set('pass',md5(md5($dataAry['userid']).md5($dataAry['pass']).md5('!@#$%^&*()_+')));
        echo json_encode($data = [
            "state"=>true,
            "messages"=>"登录成功"
        ]);
        return;
    }

    public function ExitLogin()//注销登录
    {
        Session::delete('userid');
        Session::delete('pass');
        return $this->redirect('/admin');
    }

    /*
     * 综合管理
     * *系部
     * *专业
     * *班级
     * *课程
     * start
     */
    public function Department()  //系部
    {
        /**
         * 完成数据分页显示
         */
        $DepModel = new Department();
        $page = isset($_GET['page'])?$_GET['page']:1;
        $count = $DepModel->count();  //总条数
        $num=ceil($count/10);   //总页数
        $page = $page<1?1:($page<=$num?$page:$num);
        $dataAry = $DepModel->page($page,10)->order('id','asc')->select();//分页数据
        $this->assign('data',$dataAry);
        return $this->fetch('department',['count'=>$count,'num'=>$num,'page'=>$page]);
    }

    public function deleDep(Request $request)  //系删除
    {
        $Ary = $request->post();
        $model = new Department();
        $rel = $model->where($Ary)->where('pro_count','=',0)
            ->where('teachers_count','=',0)->delete();
        if(!$rel)
        {
            echo json_encode($data = [
                "state"=>false,
                "messages"=>"该系部存在专业或教师，不可被删除"
            ]);
            return;
        }
        echo json_encode($data = [
            "state"=>true,
            "messages"=>"已删除"
        ]);
        return;
    }

    public function AddView()   //新增系部->视图
    {
        return $this->fetch('add');
    }
    public function AddDep(Request $request)   //系部新加
    {
        $Ary = $request->post();
        $model = new Department();
        $rel = $model->where(['name'=>$Ary['name']])->select();
        if($rel)
        {
            echo json_encode($data = [
                'state' => false,
                'messages' => '该系部已存在'
            ]);
            return;
        }
        $rel = $model->save($Ary);
        if(!$rel)
        {
            echo json_encode($data = [
                'state' => false,
                'messages' => '该系部已存在'
            ]);
            return;
        }
        echo json_encode($data = [
            'state' => true,
            'messages' => '已添加'
        ]);
        return;
    }

    public function UpView()  //系部修改->view
    {
        if(!isset($_GET['id']))
        {
            echo "未知错误";
            return;
        }
        $Id = $_GET['id'];
        $model = new Department();
        $data = $model->where(['Id'=>$Id])->select();
        if(!$data)
        {
            echo "未知错误";
            return;
        }
        $this->assign('datas',$data);
        return $this->fetch('updep');
    }

    public function UpDep(Request $request)  //更新
    {
        $Ary = $request->post();
        $model = new Department();
        $rel = $model->where(['name'=>$Ary['name']])->select();
        if($rel)
        {
            echo json_encode($data = [
                'state' => false,
                'messages' => '该系部已存在'
            ]);
            return;
        }
        $rel = $model->where(['Id'=>$Ary['Id']])->update(['name'=>$Ary['name']]);
        if($rel)
        {
            echo json_encode($data = [
                'state' => true,
                'messages' => '已修改'
            ]);
            return;
        }
    }

    /***
     * 专业
     */
    public function ProfessionalView()   //专业界面的   view
    {
        $model = new Professional();
        $page = isset($_GET['page'])?$_GET['page']:1;
        $count = $model->count();  //总条数
        $num=ceil($count/10);   //总页数
        $page = $page<1?1:($page<=$num?$page:$num);
        $dataAry = $model->page($page,10)->order('id','asc')->select();//分页数据
        $this->assign('data',$dataAry);
        return $this->fetch('professional',['count'=>$count,'num'=>$num,'page'=>$page]);
    }

    public function AddProView()   //添加专业   ->view
    {
        $model = new Department();
        $DepData = $model->field('Id,name')->select();
        $this->assign('Depdata',$DepData);
        return $this->fetch('addpro');
    }

    public function AddPro(Request $request)  //专业添加
    {
        $Ary = $request->post();
        $modelA = new Professional();  //专业表
        $modelB = new Department();    //系部表
        $rel = $modelA->where(['name'=>$Ary['name']])->select();
        if($rel)
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"该专业已存在"
            ]);
            return;
        }
        $rel = $modelA->save($Ary);
        if(!$rel)
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"发生未知错误,刷新后再试"
            ]);
            return;
        }
        $modelB->where(['Id'=>$Ary['department_id']])->setInc('pro_count');  //更新专业统计
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"已添加"
        ]);
        return;

    }

    public function DelePro(Request $request)   //删除专业
    {
        $Ary = $request->post();
        $model = new Professional();
        $Dep_id = $model->where(['Id'=>$Ary['Id']])->field('department_id')->select();  //得到对应系部id
        $rel = $model->where(['Id'=>$Ary['Id'],'class_count'=>0])->delete();
        if(!$rel)
        {
            echo json_encode($data = [
                "state"=>false,
                "messages"=>"该专业下存在有效班级,不可删除"
            ]);
            return;
        }
        $id = $Dep_id[0]['department_id'];
        $model = new Department();
        $model->where(["Id"=>$id])->setDec('pro_count');  //更新统计
        echo json_encode($data = [
            "state"=>true,
            "messages"=>"已删除"
        ]);
    }

    public function UpProView()  //专业编辑  视图
    {
        if(!isset($_GET['id']))   //未传参
        {
            echo '无效访问';
            return;
        }
        $id = $_GET['id'];
        $model = new Professional();
        $data = $model->where(['Id'=>$id])->select();
        if(!$data)
        {
            echo '无效访问';
            return;
        }
        $this->assign('Prodata',$data);  //该条记录
        $pro_dep_id = $data[0]['department_id'];
        $modelB = new Department();
        $dep_data = $modelB->where(['Id'=>$pro_dep_id])->select();
        $dep_all = $modelB->all();
        $this->assign('Depdata',$dep_data);
        $this->assign('Depall',$dep_all);
        return $this->fetch('uppro');

    }

    public function uPpro(Request $request)   //专业更新
    {
        $Ary = $request->post();
        $modelA = new Professional();  //专业表
        $modelB = new Department();    //系部表
        //检测是否存在更改
        $rel = $modelA->where(['Id'=>$Ary['id'],'name'=>$Ary['name'],'department_id'=>$Ary['department_id']])->select();
        if($rel)
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"未做任何更改"
            ]);
            return;
        }
        //检测是否存在同名专业
        if($modelA->where(['name'=>$Ary['name']])->where('Id','<>',$Ary['id'])->select())
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"该专业已存在"
            ]);
            return;
        }
        $upId = $modelA->where(['Id'=>$Ary['id']])->select();
        //如果更换系部，更新系部数据统计
        if(!$modelA->where(['Id'=>$Ary['id'],'department_id'=>$Ary['department_id']])->select())
        {
            //原属于系部的数据更新
            $modelB->where(['Id'=>$upId[0]['department_id']])->setDec('pro_count');
            //新选择系部统计更新
            $modelB->where(['Id'=>$Ary['department_id']])->setInc('pro_count');
        }
        $rel = $modelA->where(['Id'=>$Ary['id']])->update(['name'=>$Ary['name'],'department_id'=>$Ary['department_id']]);
        if(!$rel)
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"更新失败"
            ]);
            //原属于系部的数据更新还原
            $modelB->where(['Id'=>$upId[0]['department_id']])->setInc('pro_count');
            //新选择系部统计更新还原
            $modelB->where(['Id'=>$Ary['department_id']])->setDec('pro_count');
            return;
        }
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"更新完成"
        ]);
        return;
    }

    public function ClassView()//班级页面
    {
        $model = new Vc_class();
        $page = isset($_GET['page'])?$_GET['page']:1;
        $count = $model->count();  //总条数
        $num=ceil($count/10);   //总页数
        $page = $page<1?1:($page<=$num?$page:$num);
        $dataAry = $model->page($page,10)->order('id','asc')->select();//分页数据
        $this->assign('data',$dataAry);
        return $this->fetch('class',['count'=>$count,'num'=>$num,'page'=>$page]);
    }

    public function delClass(Request $request)   //班级删除
    {
        $Ary = $request->post();
        $modelA = new Vc_class();
        $modelB = new Professional();
        $pro_id = $modelA ->where(['Id'=>$Ary['Id']])->select();
        if(!$modelA->where(['Id'=>$Ary['Id'],'student_count'=>0,'course_count'=>0])->delete())
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"该班级存在有效学生信息或进行中课程,不可被删除"
            ]);
            return;
        }
        //更新专业表对班级的统计
        $modelB->where(['Id'=>$pro_id[0]['professional_id']])->setDec('class_count');
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"已删除"
        ]);
        return;
    }

    public function AddClassView()  //新增班级->view
    {
        $model = new Professional();
        $proData = $model->all();
        $this->assign('proData',$proData);
        return $this->fetch('addclass');
    }

    public function NewClass(Request $request)   //新增班级事件
    {
        $Ary = $request->post();
        $model = new Vc_class();
        //查询是否存在相同记录
        $isClass = $model->where(['professional_id'=>$Ary['professional_id'],
            'grade'=>$Ary['grade'],'sequence'=>$Ary['sequence']])->select();
        if($isClass)
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"该班级已存在"
            ]);
            return;
        }
        if(!$model->save($Ary))
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"添加班级失败"
            ]);
            return;
        }
        $model = new Professional();
        $model->where(['Id'=>$Ary['professional_id']])->setInc('class_count');
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"已新建班级"
        ]);
        return;

    }

    public function UpClassView()  //更新班级视图
    {
        if(!isset($_GET['id']))   //未传参
        {
            echo '无效访问';
            return;
        }
        $id = $_GET['id'];
        $model = new Vc_class();
        $data = $model->where(['Id'=>$id])->select();
        if(!$data)
        {
            echo '无效访问';
            return;
        }
        $ProData = Professional::all();
        $this->assign('ClassData',$data);  //该条记录
        $this->assign('ProData',$ProData);
        return $this->fetch('upclass');
    }

    public function UpClass(Request $request)
    {
        $Ary = $request->post();
        $model = new Vc_class();
        $modelA = new Professional();
        if($model->where($Ary)->select())
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"未作任何更改"
            ]);
            return;
        }
        if($model->where(['professional_id'=>$Ary['professional_id'],
            'grade'=>$Ary['grade'],'sequence'=>$Ary['sequence']
            ])->where('Id','<>',$Ary['Id'])->select())
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"该专业,已存在该班级"
            ]);
            return;
        }
        //获取原来的专业id
        $pro_id = $model->where(["Id"=>$Ary['Id']])->field('professional_id')->select();
        if(!$model->where(["Id"=>$Ary['Id'],"professional_id"=>$Ary['professional_id']])->select())
        {
            //专业表班级统计更新
            $modelA->where(['Id'=>$pro_id[0]['professional_id']])->setDec('class_count');
            //
            $modelA->where(['Id'=>$Ary['professional_id']])->setInc('class_count');
        }
        if(!$model->where(['Id'=>$Ary['Id']])->update($Ary))
        {
            //专业表数据回滚
            $modelA->where(['Id'=>$pro_id[0]['professional_id']])->setInc('class_count');
            //
            $modelA->where(['Id'=>$Ary['professional_id']])->setDec('class_count');
        }
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"班级信息已更新"
        ]);
        return;


    }

    public function CourseView()  //课程界面
    {
        $model = new Course();
        $page = isset($_GET['page'])?$_GET['page']:1;
        $count = $model->count();  //总条数
        $num=ceil($count/10);   //总页数
        $page = $page<1?1:($page<=$num?$page:$num);
        $dataAry = Db::field('a.Id,s.name as class_name,s.grade,s.sequence,a.name as course_name,b.name')
            ->table(['course'=>'a','vc_class'=>'s','teachers'=>'b'])
            ->where('a.class_id=s.id and a.teachers_id=b.Id')
            ->order('class_name','desc')->page($page,'10')
            ->select();
        $this->assign('data',$dataAry);
        return $this->fetch('course',['count'=>$count,'num'=>$num,'page'=>$page]);
    }

    public function AddCourseView()
    {
        $model = new Vc_class();
        $classData = $model->all();
        $model = new Teachers();
        $teachersData = $model->where('department_id','<>',0)->select();
        $this->assign('teachersData',$teachersData);
        $this->assign('classData',$classData);
        return $this->fetch('addcourse');
    }

    public function AddCourse(Request $request)   //课程数据添加
    {
        $Ary = $request->post();
        $model = new Course();
        if($model->where(['name'=>$Ary['name'],'class_id'=>$Ary['class_id']])->select())
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"该班级已存在该课程"
            ]);
            return;
        }
        if(!$model->save($Ary))
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"课程添加失败"
            ]);
            return;
        }
        $model = new Vc_class();
        $model->where(['Id'=>$Ary['class_id']])->setInc('course_count');
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"已添加新课程"
        ]);
        return;
    }

    public function DelCourse(Request $request)    //删除课程
    {
        $Ary = $request->post();
        $model = new Course();
        $class_id = $model->field('class_id')->where($Ary)->select();
        if(!$model->where($Ary)->delete())
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"删除课程失败"
            ]);
            return;
        }
        $model = new Vc_class();
        //更新班级数据课程统计
        $model->where(["Id"=>$class_id[0]['class_id']])->setDec('course_count');

        //删除与课程有关所有数据
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"课程已删除"
        ]);
        return;
    }

    public function UpCourseView()     //课程数据更新视图
    {
        if(!isset($_GET['id']))   //未传参
        {
            echo '无效访问';
            return;
        }
        $id = $_GET['id'];
        $model = new Course();
        $data = $model->where(['Id'=>$id])->select();
        if(!$data)
        {
            echo '无效访问';
            return;
        }
        $classdata = Vc_class::all();
        $teachers = Teachers::all();
        $this->assign('CourseData',$data);  //该条记录
        $this->assign('classData',$classdata);//班级列
        $this->assign('teachersData',$teachers);
        return $this->fetch('upcourse');
    }

    public function UpCourse(Request $request) //课程数据更新
    {
        $Ary = $request->post();
        $modelA = new Vc_class();  //班级表
        $modelB = new Course();    //课程表
        //检测是否存在更改
        $rel = $modelB->where($Ary)->select();
        if($rel)
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"未做任何更改"
            ]);
            return;
        }
        $class_id = $modelB->where(['Id'=>$Ary['Id']])->select();
        //检测是否更换班级
        if(!$modelB->where(['Id'=>$Ary['Id'],'class_id'=>$Ary['class_id']])->select())
        {
            //更换了班级  更新班级表课程数据统计
            $modelA->where(['Id'=>$class_id[0]['class_id']])->setDec('course_count');
            //更新现在所在班级数据统计
            $modelA->where(['Id'=>$Ary['class_id']])->setInc('course_count');
        }
        if(!$modelB->where(['Id'=>$Ary['Id']])->update($Ary))
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"更新失败"
            ]);
            //数据回滚还原
            $modelA->where(['Id'=>$Ary['class_id']])->setDec('course_count');

            $modelA->where(['Id'=>$class_id[0]['class_id']])->setInc('course_count');
            return;
        }
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"已更新课程信息"
        ]);
        return;
    }

    /**end
     * 综合管理
     */


}