<?php
/**
 * 员工控制器
 * User: @ 若雨
 * Date: 2018/7/30
 * Time: 19:28
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\Department;
use app\index\model\Duties;
use app\index\model\Employee as EmployeeModel;
use think\facade\Request;

class Employee extends Base
{
    protected $beforeActionList = [
        'isLogin',
        'isLeftis'
    ];
    //渲染列表
    public function employeeInfo(){
        $employeeInfo  = EmployeeModel::alias('e')
            ->join('hy_department d','e.department_name=d.id')
            ->join('hy_duties u','e.duties_name=u.id')
            ->field('e.*,d.department_name,u.duties_name')
            ->where('e.is_delete','=',0)
            ->paginate('15');
        $this->assign([
            'employeeInfo' =>   $employeeInfo
        ]);
        return $this->view->fetch('employee-info');
    }
    //添加员工
    public function employeeAdd(){
        if(Request::isAjax()){
            $data = Request::post();
            $data['is_leftis'] =  isset($data['is_leftis']) ? '1' : '0';
            $data['factory_date'] = $data['factory_date'] == ''? null:$data['factory_date'];
            $data['leave_date'] = $data['leave_date'] == ''? null:$data['leave_date'];
            $info = EmployeeModel::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        //获取部门信息
        $departmentInfo = Department::field('id,department_name')->select();
        //获取职务信息
        $dutiesInfo = Duties::field('id,duties_name')->select();
        //自动生成编号
        $employeeCode = EmployeeModel::order('employee_code desc')->where('employee_code','like','%HY%')->value('employee_code');
        $employeeCode = intval(trim(strrchr($employeeCode, 'Y'),'Y'));
        $employeeCode = $employeeCode<100? 'HY'.'00'.++$employeeCode : 'HY'.++$employeeCode;
        $this->assign([
            'departmentInfo'    =>  $departmentInfo,
            'dutiesInfo'        =>  $dutiesInfo,
            'employeeCode'     =>  $employeeCode
        ]);
        return $this->view->fetch('employee-add');
    }
    //信息修改
    public function employeeEdit(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            $data['is_leftis'] =  isset($data['is_leftis']) ? '1' : '0';
            $data['factory_date'] = $data['factory_date'] == ''? null:$data['factory_date'];
            $data['leave_date'] = $data['leave_date'] == ''? null:$data['leave_date'];
            $info = EmployeeModel::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        $employeeRow = EmployeeModel::get($id);
        //获取部门信息
        $departmentInfo = Department::field('id,department_name')->select();
        //获取职务信息
        $dutiesInfo = Duties::field('id,duties_name')->select();
        $this->assign([
            'departmentInfo'    =>  $departmentInfo,
            'dutiesInfo'        =>  $dutiesInfo,
            'employeeRow'       =>  $employeeRow
        ]);
        return $this->view->fetch('employee-edit');
    }
    //管理员更改
    public function employeeLv(){

        if(Request::isAjax()){
            $admin = session('user.admin');
            if(!$admin == 'admin'){
                return $this->redirect('index/index/index');
            }
            $id = intval(Request::post('id'));
            $admin = intval(Request::post('admin'));
            $info = EmployeeModel::update(['employee_lv'=>$admin],['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }
    public function delete(){
        $info =  EmployeeModel::update(['is_delete'=>1],['id'=>intval(input('id'))]);
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
}