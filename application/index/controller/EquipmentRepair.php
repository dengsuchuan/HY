<?php
/*
 * 设备保养记录
 */
namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\Repair;
use think\facade\Request;


class EquipmentRepair extends Base
{
    public function repairInfo(){
        $eqpmt_id = input("eqpmt_id");
        $repairInfo = Repair::where('eqpmt_id',$eqpmt_id)->order('maintenance_plan_date', 'desc')->paginate(25);
        $repairInfoCount = $repairInfo->total();
        $this->assign("repairInfo",$repairInfo);
        $this->assign("eqpmt_id",$eqpmt_id);
        $this->assign("repairInfoCount",$repairInfoCount);
        return $this->view->fetch("repairInfo");
    }

    public function allRepairInfo(){
        if(Request::isPost()){
            $data = Request::post();
            $repairInfo = Repair::order('maintenance_plan_date', 'desc')
                ->where('maintenance_plan_date','between',[$data['start'],$data['end']])
                ->paginate(25);
        }else{
            $repairInfo = Repair::order('maintenance_plan_date', 'desc')->paginate(25);
        }
        $repairInfoCount = $repairInfo->total();
        $this->assign("repairInfo",$repairInfo);
        $this->assign("repairInfoCount",$repairInfoCount);
        return $this->view->fetch("allRepairInfo");
    }

    //展示保养添加页面
    public function addRepairInfo(){
        $eqpmt_id = input("equi_id");
        $this->assign("equi_id",$eqpmt_id);
        return $this->view->fetch("add-repair-info");
    }

    //保存添加的保养函数
    public function saveRepairInfo(){
        $data = Request::post();
        $info = Repair::create($data);
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }

    //删除保养
    public function delete(){
        $id = Request::post("id");
        $info = Repair::where('id','=',$id)->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }

    //编辑信息
    public function editRepairInfo(){
        $id = input("id");
        $repairInfo = Repair::where('id',$id)->select();
        $this->assign("repairInfo",$repairInfo);
        return $this->view->fetch("edit-Repair-info");
    }

    //更新信息
    public function update(){
        if(Request::isAjax()) {
            $data = Request::post();
            $id = $data['id'];
            echo $id;
            $info = Repair::update($data, ['id' => $id]);
            if ($info) {
                return json(1);
            } else {
                return json(0);
            }
        }
    }











}