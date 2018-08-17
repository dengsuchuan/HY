<?php
/*
 * 设备管理
 */
namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\EquipmentInfo;
use app\index\model\EquipmentType;
use think\facade\Request;

class Equipment extends Base
{
    //展示设备页面
    public function equipmentInfo(){
        if(Request::isPost()){
            $data = Request::post();
            if($data['id']!=""){//这个ID是主键
                $equipmentInfo = EquipmentInfo::where("eqpmt_type_id",$data['id'])->paginate(25);
            }else{
                $equipmentInfo = EquipmentInfo::order('create_time', 'desc')
                    ->where("eqpmt_id","LIKE","%".$data['modules']."%")
                    ->whereOr("eqpmt_name","LIKE","%".$data['modules']."%")
                    ->whereOr("eqpmt_model","LIKE","%".$data['modules']."%")
                    ->whereOr("manufacturer","LIKE","%".$data['modules']."%")
                    ->paginate(25);
            }
        }else{
            $equipmentInfo = EquipmentInfo::order('create_time', 'desc')->paginate(25);
        }

        $equipmentInfoCount = $equipmentInfo->total();
        $this->assign("equipmentInfo",$equipmentInfo);
        $this->assign("equipmentInfoCount",$equipmentInfoCount);

        $equipmentType = EquipmentType::all();
        $this->assign("equipmentType",$equipmentType);


        return $this->view->fetch("equipment-info");
    }

    //展示设备添加页面
    public function addEquipmentInfo(){
        $equipmentType = EquipmentType::all();
        $this->assign("equipmentType",$equipmentType);
        return $this->view->fetch("add-equipment-info");
    }

    //保存添加的设备函数
    public function saveEquipmentInfo(){
        $data = Request::post();
        $data['is_working'] = isset($data['is_working']) ? '1' : '0';
        $info = EquipmentInfo::create($data);
        if($info){
            return json(1);
        }else{
            return json(0);
        }

    }

    //删除设备
    public function delete(){
        $id = Request::post("id");
        $info = EquipmentInfo::where('id',$id)->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }

    //编辑设备信息
    public function editEquipmentInfo(){
        $id = input("id");
        $equipmentInfo = EquipmentInfo::where('id',$id)->select();
        $this->assign("equipmentInfo",$equipmentInfo);

        $equipmentType = EquipmentType::all();
        $this->assign("equipmentType",$equipmentType);

        return $this->view->fetch("edit-equipment-info");
    }

    //更新设备信息
    public function update(){
        if(Request::isAjax()) {
            $data = Request::post();
            $id = $data['id'];
            $data['is_working'] = isset($data['is_working']) ? '1' : '0';
            $info = EquipmentInfo::update($data, ['id' => $id]);
            if ($info) {
                return json(1);
            } else {
                return json(0);
            }
        }
    }
}