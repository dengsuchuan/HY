<?php
/**
 * 部门管理
 * User: @ 若雨
 * Date: 2018/7/30
 * Time: 21:40
 */

namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\Department as DepartmentMode;
use think\facade\Request;
class Department extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];

    //渲染列表
    public function departmentInfo(){
        $departmentInfo =  DepartmentMode::where('id',"<>",0)->select();
        $this->assign([
            'departmentInfo'     =>  $departmentInfo
        ]);
        return $this->view->fetch('department-info');
    }
    public function departmentAdd(){
        if(Request::isAjax()){
            $data['department_name'] = Request::post('department_name');
            $data['remark'] = Request::post('remark');
            $info = DepartmentMode::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        return $this->view->fetch('department-add');
    }
    //修改操作
    public function departmentEdit(){
        if(Request::isAjax()){
            $id = Request::post('id');
            $data['department_name'] = Request::post('department_name');
            $data['remark'] = Request::post('remark');
            $info = DepartmentMode::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        $departmentRow = DepartmentMode::get($id);
        $this->assign([
            'departmentRow'    =>  $departmentRow
        ]);
        return $this->view->fetch('department-edit');
    }
    //删除
    public function delete(){
        $info = DepartmentMode::where(['id'=>intval(input('id'))])->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
}