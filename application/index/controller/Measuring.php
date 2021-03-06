<?php
/*
 * 量具管理
 */
namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\MeasuringInfo;
use app\index\model\CostType;
use think\facade\Request;

class Measuring extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    //量具设备页面
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

        $measuringType = CostType::where("pid",36)->select();
        $this->assign("measuringType",$measuringType);


        return $this->view->fetch("measuring-info");
    }

    //展示量具添加页面
    public function addMeasuringInfo(){
        $measuringType = CostType::where("pid",36)->select();
        $this->assign("measuringType",$measuringType);
        return $this->view->fetch("add-measuring-info");
    }

    //保存添加的量具函数
    public function saveMeasuringInfo(){
        $data = Request::post();
        $info = MeasuringInfo::create($data);
        if($info){
            return json(1);
        }else{
            return json(0);
        }

    }

    //删除量具
    public function delete(){
        $id = Request::post("id");
        $info = MeasuringInfo::where('id',$id)->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }

    //编辑量具信息
    public function editMeasuringInfo(){
        $id = input("id");
        $measuringInfo = MeasuringInfo::where('id',$id)->select();
        $this->assign("measuringInfo",$measuringInfo);

        $measuringType = CostType::where("pid",36)->select();
        $this->assign("measuringType",$measuringType);

        return $this->view->fetch("edit-measuring-info");
    }

    //更新量具信息
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