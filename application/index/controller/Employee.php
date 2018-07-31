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
class Employee extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    //渲染列表
    public function employeeInfo(){
        $employeeInfo  = EmployeeModel::alias('e')
            ->join('hy_department d','e.department_name=d.id')
            ->join('hy_duties u','e.duties_name=u.id')
            ->field('e.*,d.department_name,e.duties_name')
            ->paginate('10');
        $this->assign([
            'employeeInfo' =>   $employeeInfo
        ]);
        return $this->view->fetch('employee-info');
    }
    //添加员工
    public function employeeAdd(){
        //获取部门信息
        $departmentInfo = Department::field('id,department_name')->select();
        //获取职务信息
        $dutiesInfo = Duties::field('id,duties_name')->select();
        $this->assign([
            'departmentInfo'    =>  $departmentInfo,
            'dutiesInfo'        =>  $dutiesInfo
        ]);
        return $this->view->fetch('employee-add');
    }
}