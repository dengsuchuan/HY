<?php
/*
 * 设备维修记录
 */
namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\Maintenance;
use think\facade\Request;


class EquipmentMaintain extends Base
{
    public function maintainInfo(){
        $eqpmt_id = input("eqpmt_id");
        $maintenanceInfo = Maintenance::where('equi_id',$eqpmt_id)->order('date', 'desc')->paginate(25);
        $maintenanceInfoCount = $maintenanceInfo->total();
        $this->assign("maintenanceInfo",$maintenanceInfo);
        $this->assign("eqpmt_id",$eqpmt_id);
        $this->assign("maintenanceInfoCount",$maintenanceInfoCount);
        return $this->view->fetch("maintainInfo");
    }

    public function allMaintainInfo(){
        if(Request::isPost()){
            $data = Request::post();
            $maintenanceInfo = Maintenance::order('date', 'desc')
                ->where("date","LIKE","%".$data['modules']."%")
                ->paginate(25);
        }else{
            $maintenanceInfo = Maintenance::order('date', 'desc')
                ->paginate(25);
        }
        $maintenanceInfoCount = $maintenanceInfo->total();
        $this->assign("maintenanceInfo",$maintenanceInfo);
        $this->assign("maintenanceInfoCount",$maintenanceInfoCount);
        return $this->view->fetch("allMaintainInfo");
    }

    //展示设备添加页面
    public function addMaintainInfo(){
        $equi_id = input("equi_id");
        $this->assign("equi_id",$equi_id);
        return $this->view->fetch("add-maintain-info");
    }

    //保存添加的保养函数
    public function saveMaintainInfo(){
        $data = Request::post();
        $info = Maintenance::create($data);
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }

    //删除保养
    public function delete(){
        $id = Request::post("id");
        $info = Maintenance::where('id','=',$id)->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }

    //编辑信息
    public function editMaintainInfo(){
        $id = input("id");
        $maintenanceInfo = Maintenance::where('id',$id)->select();
        $this->assign("maintenanceInfo",$maintenanceInfo);
        return $this->view->fetch("edit-maintain-info");
    }

    //更新信息
    public function update(){
        if(Request::isAjax()) {
            $data = Request::post();
            $id = $data['id'];
            $info = Maintenance::update($data, ['id' => $id]);
            if ($info) {
                return json(1);
            } else {
                return json(0);
            }
        }
    }











}