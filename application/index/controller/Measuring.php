<?php
/*
 * 设备管理
 */
namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\MeasuringInfo;
use app\index\model\MeasuringType;
use think\facade\Request;

class Measuring extends Base
{
    //展示设备页面
    public function measuringInfo(){
        if(Request::isPost()){
            $data = Request::post();
            if($data['id']!=""){//这个ID是主键
                $measuringInfo = MeasuringInfo::where("measuring_name",$data['id'])->paginate(25);
            }else{
                $measuringInfo = MeasuringInfo::order('create_time', 'desc')
                    ->where("measuring_id","LIKE","%".$data['modules']."%")
                    ->whereOr("model","LIKE","%".$data['modules']."%")
                    ->whereOr("place_production","LIKE","%".$data['modules']."%")
                    ->whereOr("production_num","LIKE","%".$data['modules']."%")
                    ->whereOr("inspection_cycle","LIKE","%".$data['modules']."%")
                    ->paginate(25);
            }
        }else{
            $measuringInfo = MeasuringInfo::order('create_time', 'desc')->paginate(25);
        }

        $measuringInfoCount = $measuringInfo->total();
        $this->assign("measuringInfo",$measuringInfo);
        $this->assign("measuringInfoCount",$measuringInfoCount);

        $measuringType = MeasuringType::all();
        $this->assign("measuringType",$measuringType);


        return $this->view->fetch("measuring-info");
    }

    //展示设备添加页面
    public function addMeasuringInfo(){
        $measuringType = MeasuringType::all();
        $this->assign("measuringType",$measuringType);
        return $this->view->fetch("add-measuring-info");
    }

    //保存添加的设备函数
    public function saveMeasuringInfo(){
        $data = Request::post();
        $info = MeasuringInfo::create($data);
        if($info){
            return json(1);
        }else{
            return json(0);
        }

    }

    //删除设备
    public function delete(){
        $id = Request::post("id");
        $info = MeasuringInfo::where('id',$id)->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }

    //编辑设备信息
    public function editMeasuringInfo(){
        $id = input("id");
        $measuringInfo = MeasuringInfo::where('id',$id)->select();
        $this->assign("measuringInfo",$measuringInfo);

        $measuringType = MeasuringType::all();
        $this->assign("measuringType",$measuringType);

        return $this->view->fetch("edit-measuring-info");
    }

    //更新设备信息
    public function update(){
        if(Request::isAjax()) {
            $data = Request::post();
            $id = $data['id'];
            $info = MeasuringInfo::update($data, ['id' => $id]);
            if ($info) {
                return json(1);
            } else {
                return json(0);
            }
        }
    }
}