<?php
/**
 * Created by PhpStorm.
 * User: 17424
 * Date: 2018/6/13
 * Time: 8:45
 */

namespace app\admin\controller;



use app\admin\model\Course;
use app\admin\model\Department;
use app\admin\model\Excel_path;
use app\admin\model\Student;
use app\admin\model\Teachers;
use app\admin\model\Vc_class;
use think\Db;
use think\Request;

class User extends Index
{
    /**
     * 用户管理
     * start
     */
    public function StudentView()
    {
        $model=new Student();
        $page = isset($_GET['page'])?$_GET['page']:1;
        $count = $model->where('class_id','<>',0)->count();  //总条数
        $num=ceil($count/10);   //总页数
        $page = $page<1?1:($page<=$num?$page:$num);
        $data = Db::field('A.Id,A.number,A.name,A.state,B.name as class_name,B.grade,
  B.sequence')
            ->table(['student' => 'A', 'vc_class' => 'B'])
            ->where('A.class_id = B.Id')
            ->order('class_name','desc')
            ->page($page,'10')
            ->select();
        $this->assign('StudentData',$data);
        return $this->fetch('student',['count'=>$count,'num'=>$num,'page'=>$page]);
    }

    public function StudentState(Request $request)  //学生账户状态
    {
        $Ary = $request->post();
        $model = new Student();
        if($Ary['state']==0)  //冻结
        {
            if(!$model->where(['Id'=>$Ary['Id']])->update(['state'=>$Ary['state']]))
            {
                echo json_encode($data=[
                    "state"=>false,
                    "messages"=>"更新状态失败"
                ]);
                return;
            }
            echo json_encode($data=[
                "state"=>true,
                "messages"=>"已冻结"
            ]);
            return;
        }
        if($Ary['state']==1)  //激活
        {
            if(!$model->where(['Id'=>$Ary['Id']])->update(['state'=>$Ary['state']]))
            {
                echo json_encode($data=[
                    "state"=>false,
                    "messages"=>"更新状态失败"
                ]);
                return;
            }
            echo json_encode($data=[
                "state"=>true,
                "messages"=>"已激活"
            ]);
            return;
        }
        echo json_encode($data=[
            "state"=>false,
            "messages"=>"更新状态失败"
        ]);
        return;
    }

    public function AddStudentView()
    {
        $classData = Vc_class::all();
        $this->assign('classData',$classData);
        return $this->fetch('addstudent');
    }
    public function AddStudent(Request $request) //手动添加学生账号
    {
        $Ary = $request->post();
        $model = new Student();
        /**
         * 学号不可重复
         */
        if($model->where(['number'=>$Ary['number']])->select())
        {
            echo json_encode($data= [
                "state"=>false,
                "messages"=>"该学生已存在"
            ]);
            return;
        }
        //生成默认密码
        $Ary['pass']=md5(md5($Ary['number']).md5('123456').md5('!@#$%^&*()_+'));
        if(!$model->save($Ary))
        {
            echo json_encode($data= [
                "state"=>false,
                "messages"=>"新增学生失败"
            ]);
            return;
        }
        $model = new Vc_class();
        $model->where(['Id'=>$Ary['class_id']])->setInc('student_count');
        echo json_encode($data= [
            "state"=>true,
            "messages"=>"添加成功"
        ]);
        return;
    }

    public function ExcelView()
    {
        return $this->fetch();
    }

    public function upExcel()  //通过excel导入学生信息
    {
        $file = $this->request->file('file');
        if(!$file){
            echo json_encode([
                "code"=>0,
                "msg"=>"文件上传失败！"
            ]);
            return;
        }
        //保存文件
        $info = $file->move(ROOT_PATH . 'public' . DS . 'upload'.DS.'cache');
        if(!$info){
            echo json_encode([
                "code"=>0,
                "msg"=>"文件上传失败！".$file->getError()
            ]);
            return;
        }
        $filename = './upload'.'/cache/'.$info->getSaveName();
        if(file_exists($filename)){
            $model = new Excel_path();
            $model->save(['path'=>$filename]);
        }else{
            echo json_encode([
                "code"=>0,
                "msg"=>"文件上传失败！"
            ]);
            return;
        }
        //读取excel
        vendor('PHPExcel.PHPExcel');
        $objPHPExcel = new \PHPExcel();
        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        $obj_PHPExcel =$objReader->load($filename, $encode = 'utf-8');  //加载文件内容,编码utf-8
        $excel_array=$obj_PHPExcel->getsheet(0)->toArray();   //转换为数组格式
        array_shift($excel_array);  //删除第一个数组(标题);
        $data = [];
        $i=0;
        foreach($excel_array as $k=>$v) {
            $data[$k]['number'] = $v[0];  //学号
            $data[$k]['name']=$v[1];  //姓名
            //产生默认密码
            $data[$k]['pass']=md5(md5($v[0]).md5('123456').md5('!@#$%^&*()_+'));
            $i++;
        }
        $model = new Student();
        $count = 0;
        foreach ($data as $key)
        {
            //如果该学生在数据库中不存在则添加
            if(!$model->where(['number'=>$key['number']])->select())
            {
                if($model->insert($key)){
                    $count++;
                }
            }
        }
        echo json_encode([
            "code"=>1,
            "msg"=>"共有学生信息".$i."条,上传了学生信息".$count."条"
        ]);
        return;
    }

    protected $beforeActionList=[
        "delexcel"=>[
            'only'=>'excelview,teachersexcel'  //每次访问导入页面 先清除原有文件
        ]
    ];

    public function DelExcel()
    {
        $All = Excel_path::all();
        foreach ($All as $key)
        {
            if(file_exists($key['path'])) {
                unlink($key['path']);
                Excel_path::where(['path' => $key['path']])->delete();
            }
        }
    }

    public function DelStudent(Request $request)//单条删除学生信息
    {
        $Ary = $request->post();
        $modelA = new Student();
        $modelB = new Vc_class();
        $class_id = $modelA ->where($Ary)->select();
        if(!$modelA->where($Ary)->delete())
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"删除失败"
            ]);
            return;
        }
        //更新专业表对班级的统计
        $modelB->where(['Id'=>$class_id[0]['class_id']])->setDec('student_count');
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"已删除"
        ]);
        return;
    }

    public function DelStudents(Request $request)  //批量删除学生信息
    {
        $Ary = $request->post();
        $modelA = new Student();
        $modelB = new Vc_class();
        $count = count($Ary['Ary']);
        $x = 0;
        //统计删除条数
        foreach ($Ary['Ary'] as $key)
        {
            $class_id = $modelA ->where(['Id'=>$key])->select();
            if(!$modelA->where(['Id'=>$key])->delete())
            {
                echo json_encode($data=[
                    "state"=>false,
                    "messages"=>"删除失败,已删除".$x."条"."共".$count."条"
                ]);
                return;
            }
            $modelB->where(['Id'=>$class_id[0]['class_id']])->setDec('student_count');
            $x++;
        }
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"删除完成,已删除".$x."条"."共".$count."条"
        ]);
        return;
    }

    public function UpStudentView()  //编辑学生信息视图
    {
        if(!isset($_GET['id']))   //未传参
        {
            echo '无效访问';
            return;
        }
        $id = $_GET['id'];
        $model = new Student();
        $data = $model->where(['Id'=>$id])->select();
        if(!$data)
        {
            echo '无效访问';
            return;
        }
        $classData = Vc_class::all();
        $this->assign('student',$data);
        $this->assign('classData',$classData);
        return $this->fetch('upstudent');
    }

    public function UpStudent(Request $request)  //更新学生信息
    {
        $Ary = $request->post();
        $model = new Student();
        if($model->where($Ary)->select())
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"未作任何更改"
            ]);
            return;
        }
        //非该条记录 存在相同学号
        if($model->where('Id','<>',$Ary['Id'])
            ->where(['number'=>$Ary['number']])->select())
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"该学号已存在"
            ]);
            return;
        }
        //如果更改了班级
        $modelA = new Vc_class();
        $class_id = $model->where(["Id"=>$Ary['Id']])->field('class_id')->select();
        if(!$model->where(["Id"=>$Ary['Id'],"class_id"=>$Ary['class_id']])->select())
        {
            //更新原属班级数据  -1
            $modelA->where(['Id'=>$class_id[0]['class_id']])->setDec('student_count');
            //更新现属于班级  +1
            $modelA->where(['Id'=>$Ary['class_id']])->setInc('student_count');
        }
        if(!$model->where(['Id'=>$Ary['Id']])->update($Ary))
        {
            //班级表数据回滚
            $modelA->where(['Id'=>$class_id[0]['class_id']])->setInc('student_count');
            //
            $modelA->where(['Id'=>$Ary['class_id']])->setDec('student_count');
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"更新失败"
            ]);
            return;
        }
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"学生信息已更新"
        ]);
        return;
    }

    public function ResetStudent(Request $request)//重置密码
    {
        $Ary = $request->post();
        $model = new Student();
        if(!$model->where($Ary)
            ->update(['pass'=>md5(md5($Ary['number']).md5('123456').md5('!@#$%^&*()_+')),
                      'state'=>1]))
        {
            echo json_encode($data = [
                "state"=>false,
                "messages"=>"重置密码失败"
            ]);
            return;
        }
        echo json_encode($data = [
            "state"=>true,
            "messages"=>"密码已重置"
        ]);
        return;
    }

    public function TeachersView()  //教师视图
    {
        $model=new Teachers();
        $page = isset($_GET['page'])?$_GET['page']:1;
        $count = $model->where('department_id','<>',0)->count();  //总条数
        $num=ceil($count/10);   //总页数
        $page = $page<1?1:($page<=$num?$page:$num);
        $data = Db::field('A.Id,
                          A.number,
                          A.name,
                          A.state,
                          B.name as dep_name')
            ->table(['teachers' => 'A', 'department' => 'B'])
            ->where('A.department_id = B.Id')
            ->order('dep_name','desc')
            ->page($page,'10')
            ->select();
        $this->assign('TeachersData',$data);
        return $this->fetch('teacher',['count'=>$count,'num'=>$num,'page'=>$page]);
    }

    public function TeacherState(Request $request)   //激活冻结账户
    {
        $Ary = $request->post();
        $model = new Teachers();
        if($Ary['state']==0)  //冻结
        {
            if(!$model->where(['Id'=>$Ary['Id']])->update(['state'=>$Ary['state']]))
            {
                echo json_encode($data=[
                    "state"=>false,
                    "messages"=>"更新状态失败"
                ]);
                return;
            }
            echo json_encode($data=[
                "state"=>true,
                "messages"=>"已冻结"
            ]);
            return;
        }
        if($Ary['state']==1)  //激活
        {
            if(!$model->where(['Id'=>$Ary['Id']])->update(['state'=>$Ary['state']]))
            {
                echo json_encode($data=[
                    "state"=>false,
                    "messages"=>"更新状态失败"
                ]);
                return;
            }
            echo json_encode($data=[
                "state"=>true,
                "messages"=>"已激活"
            ]);
            return;
        }
        echo json_encode($data=[
            "state"=>false,
            "messages"=>"更新状态失败"
        ]);
        return;
    }

    public function ResetTeacher(Request $request) //重置教师密码
    {
        $Ary = $request->post();
        $model = new Teachers();
        if(!$model->where($Ary)
            ->update(['pass'=>md5(md5($Ary['number']).md5('123456').md5('!@#$%^&*()_+')),
                'state'=>0]))
        {
            echo json_encode($data = [
                "state"=>false,
                "messages"=>"重置密码失败"
            ]);
            return;
        }
        echo json_encode($data = [
            "state"=>true,
            "messages"=>"密码已重置"
        ]);
        return;
    }

    public function DelTeacher(Request $request)//单条删除教师信息
    {
        $Ary = $request->post();
        $modelA = new Teachers();
        $modelB = new Department();
        $modelC = new Course();
        $department_id = $modelA ->where($Ary)->select();//获取原记录
        if($modelC->where(['teachers_id'=>$Ary['Id']])->select())
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"该教师有进行中课程,不可被删除"
            ]);
            return;
        }
        if(!$modelA->where($Ary)->delete())
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"该教师有进行中课程,不可被删除"
            ]);
            return;
        }
        //更新专业表对班级的统计
        $modelB->where(['Id'=>$department_id[0]['department_id']])->setDec('teachers_count');
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"已删除"
        ]);
        return;
    }

    public function DelTeachers(Request $request)  //批量删除教师信息
    {
        $Ary = $request->post();
        $modelA = new Teachers();
        $modelB = new Department();
        $modelC = new Course();
        $count = count($Ary['Ary']);
        $x = 0;
        //统计删除条数
        foreach ($Ary['Ary'] as $key)
        {
            $department_id = $modelA ->where(['Id'=>$key])->select();
            //如果该老师没有在上课程
            if(!$modelC->where(['teachers_id'=>$key])->select())
            {
            if(!$modelA->where(['Id'=>$key])->delete())
            {
                echo json_encode($data=[
                    "state"=>false,
                    "messages"=>"删除失败,已删除".$x."条"."共".$count."条"
                ]);
                return;
            }
            $modelB->where(['Id'=>$department_id[0]['department_id']])->setDec('teachers_count');
            $x++;
            }
        }
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"删除完成,已删除".$x."条"."共".$count."条"
        ]);
        return;
    }

    public function AddTeacherView()  //添加教师视图
    {
        $dep_Data = Department::all();
        $this->assign('dep_Data',$dep_Data);
        return $this->fetch('addteacher');
    }

    public function AddTeacher(Request $request) //手动添加教师账号
    {
        $Ary = $request->post();
        $model = new Teachers();
        /**
         * 教师号不可重复
         */
        if($model->where(['number'=>$Ary['number']])->select())
        {
            echo json_encode($data= [
                "state"=>false,
                "messages"=>"该教师已存在"
            ]);
            return;
        }
        //生成默认密码
        $Ary['pass']=md5(md5($Ary['number']).md5('123456').md5('!@#$%^&*()_+'));
        if(!$model->save($Ary))
        {
            echo json_encode($data= [
                "state"=>false,
                "messages"=>"新增教师失败"
            ]);
            return;
        }
        $model = new Department();
        $model->where(['Id'=>$Ary['department_id']])->setInc('teachers_count');
        echo json_encode($data= [
            "state"=>true,
            "messages"=>"添加成功"
        ]);
        return;
    }

    public function TeachersExcel() // Excel导入教师信息视图
    {
        return $this->fetch();
    }

    public function upTeachersExcel()  //通过excel导入学生信息
    {
        $file = $this->request->file('file');
        if(!$file){
            echo json_encode([
                "code"=>0,
                "msg"=>"文件上传失败！"
            ]);
            return;
        }
        //保存文件
        $info = $file->move(ROOT_PATH . 'public' . DS . 'upload'.DS.'cache');
        if(!$info){
            echo json_encode([
                "code"=>0,
                "msg"=>"文件上传失败！".$file->getError()
            ]);
            return;
        }
        $filename = './upload'.'/cache/'.$info->getSaveName();
        if(file_exists($filename)){
            $model = new Excel_path();
            $model->save(['path'=>$filename]);
        }else{
            echo json_encode([
                "code"=>0,
                "msg"=>"文件上传失败！"
            ]);
            return;
        }
        //读取excel
        vendor('PHPExcel.PHPExcel');
        $objPHPExcel = new \PHPExcel();
        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        $obj_PHPExcel =$objReader->load($filename, $encode = 'utf-8');  //加载文件内容,编码utf-8
        $excel_array=$obj_PHPExcel->getsheet(0)->toArray();   //转换为数组格式
        array_shift($excel_array);  //删除第一个数组(标题);
        $data = [];
        $i=0;
        foreach($excel_array as $k=>$v) {
            $data[$k]['number'] = $v[0];  //教师号
            $data[$k]['name']=$v[1];  //姓名
            //产生默认密码
            $data[$k]['pass']=md5(md5($v[0]).md5('123456').md5('!@#$%^&*()_+'));
            $i++;
        }
        $model = new Teachers();
        $count = 0;
        foreach ($data as $key)
        {
            //如果该学生在数据库中不存在则添加
            if(!$model->where(['number'=>$key['number']])->select())
            {
                if($model->insert($key)){
                    $count++;
                }
            }
        }
        echo json_encode([
            "code"=>1,
            "msg"=>"共有教师信息".$i."条,上传了教师信息".$count."条"
        ]);
        return;
    }

    public function UpTeachersView()
    {
        if(!isset($_GET['id']))   //未传参
        {
            echo '无效访问';
            return;
        }
        $id = $_GET['id'];
        $model = new Teachers();
        $data = $model->where(['Id'=>$id])->select();
        if(!$data)
        {
            echo '无效访问';
            return;
        }
        $classData = Department::all();
        $this->assign('teachers',$data);
        $this->assign('classData',$classData);
        return $this->fetch('upteachers');
    }

    public function UpTeachers(Request $request)  //更新教师信息
    {
        $Ary = $request->post();
        $model = new Teachers();
        if($model->where($Ary)->select())
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"未作任何更改"
            ]);
            return;
        }
        //非该条记录 存在相同教师号
        if($model->where('Id','<>',$Ary['Id'])
            ->where(['number'=>$Ary['number']])->select())
        {
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"该教师号已存在"
            ]);
            return;
        }
        //如果更改了系部
        $modelA = new Department();
        $department_id = $model->where(["Id"=>$Ary['Id']])->field('department_id')->select();
        if(!$model->where(["Id"=>$Ary['Id'],"department_id"=>$Ary['department_id']])->select())
        {
            //更新原属班级数据  -1
            $modelA->where(['Id'=>$department_id[0]['department_id']])->setDec('teachers_count');
            //更新现属于班级  +1
            $modelA->where(['Id'=>$Ary['department_id']])->setInc('teachers_count');
        }
        if(!$model->where(['Id'=>$Ary['Id']])->update($Ary))
        {
            //班级表数据回滚
            $modelA->where(['Id'=>$department_id[0]['class_id']])->setInc('teachers_count');
            //
            $modelA->where(['Id'=>$Ary['department_id']])->setDec('teachers_count');
            echo json_encode($data=[
                "state"=>false,
                "messages"=>"更新失败"
            ]);
            return;
        }
        echo json_encode($data=[
            "state"=>true,
            "messages"=>"教师信息已更新"
        ]);
        return;
    }

    public function NotTeachersView()
    {
        $model=new Teachers();
        $page = isset($_GET['page'])?$_GET['page']:1;
        $count = $model->where('department_id','=',0)->count();  //总条数
        $num=ceil($count/10);   //总页数
        $page = $page<1?1:($page<=$num?$page:$num);
        $data = $model->where(['department_id'=>0])->page($page,10)->select();
        $this->assign('TeachersData',$data);
        return $this->fetch('notteacher',['count'=>$count,'num'=>$num,'page'=>$page]);
    }

    public function NotStudentView()
    {
        $model=new Student();
        $page = isset($_GET['page'])?$_GET['page']:1;
        $count = $model->where('class_id','=',0)->count();  //总条数
        $num=ceil($count/10);   //总页数
        $page = $page<1?1:($page<=$num?$page:$num);
        $data = $model->where(['class_id'=>0])->select();
        $this->assign('StudentData',$data);
        return $this->fetch('notstudent',['count'=>$count,'num'=>$num,'page'=>$page]);
    }
}