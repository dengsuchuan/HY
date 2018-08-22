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


        return $this->view->fetch("equipmentInfo");
    }

    //展示设备添加页面
    public function addEquipmentInfo(){
        $equipmentType = EquipmentType::all();
        $this->assign("equipmentType",$equipmentType);
        return $this->view->fetch("add-equipment-infos");
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

        return $this->view->fetch("edit-equipment-infos");
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

    //---------------------------------------------------------------

    //设备类型展示
    public function equipmentType(){
        $equipmentType = EquipmentType::order('create_time', 'desc')->paginate(25);
        $equipmentTypeCount = $equipmentType->total();

        $this->assign("equipmentType",$equipmentType);
        $this->assign("equipmentTypeCount",$equipmentTypeCount);
        return $this->view->fetch("equipmentTypeInfo");
    }
    //设备类型添加
    public function addEquipmentType(){
        return $this->view->fetch("add-equipment-type");
    }
    //设备类型添加保存
    public function saveEquipmentType(){
        $data = Request::post();
        $info = EquipmentType::create($data);
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    //设备类型删除
    public function deleteEquipmentType(){
        $id = Request::post("id");
        $info = EquipmentType::where('id',$id)->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    //设备类型编辑
    public function editEquipmentType(){
        $id = input("id");
        $equipmentType = EquipmentType::where('id',$id)->select();
        $this->assign("equipmentType",$equipmentType);
        return $this->view->fetch("edit-equipment-type");
    }
    //设备类型更新
    public function updateEquipmentType(){
        $data = Request::post();
        $id = $data['id'];
        $info = EquipmentType::update($data, ['id' => $id]);
        if ($info) {
            return json(1);
        } else {
            return json(0);
        }
    }

}