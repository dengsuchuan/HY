<?php
/**
 * 部门管理
 * User: @ 若雨
 * Date: 2018/7/30
 * Time: 21:40
 */

namespace app\index\controller;



use app\index\common\controller\Base;
use app\index\model\Duties as DutiesMode;
use think\facade\Request;
class Duties extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    //渲染列表
    public function DutiesInfo(){
        $dutiesModeInfo =  DutiesMode::where('id',"<>",0)->select();
        $this->assign([
            'dutiesModeInfo'     =>  $dutiesModeInfo
        ]);
        return $this->view->fetch('duties-info');
    }
    public function DutiesAdd(){
        if(Request::isAjax()){
            $data['duties_name'] = Request::post('duties_name');
            $data['remark'] = Request::post('remark');
            $info = DutiesMode::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        return $this->view->fetch('duties-add');
    }
    //修改操作
    public function DutiesEdit(){
        if(Request::isAjax()){
            $id = Request::post('id');
            $data['duties_name'] = Request::post('duties_name');
            $data['remark'] = Request::post('remark');
            $info = DutiesMode::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        $dutiesRow = DutiesMode::get($id);
        $this->assign([
            'dutiesRow'    =>  $dutiesRow
        ]);
        return $this->view->fetch('duties-edit');
    }
    //删除
    public function delete(){
        $info = DutiesMode::where(['id'=>intval(input('id'))])->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
}