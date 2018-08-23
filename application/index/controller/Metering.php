<?php
/**
 * 计量
 * Created by PhpStorm.
 * User: dengs
 * Date: 2018/8/24 0024
 * Time: 1:57
 */

namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\Metering as MeteringModel;
use think\facade\Request;

class Metering extends Base
{

    public function MeteringInfo(){
        $id = input("id");
        $meteringInfo = MeteringModel::where('eqpmt_id',$id)->order('create_time', 'desc')->paginate(25);
        $meteringInfoCount = $meteringInfo->total();
        $this->assign("meteringInfo",$meteringInfo);
        $this->assign("id",$id);
        $this->assign("meteringInfoCount",$meteringInfoCount);
        return $this->view->fetch("view-metering-info");
    }

    public function allMeteringInfo(){
        if(Request::isPost()){
            $data = Request::post();
            $meteringInfo = MeteringModel::order('metering_date', 'desc')
                ->where('metering_date','between',[$data['start'],$data['end']])
                ->paginate(25);
        }else{
            $meteringInfo = MeteringModel::order('create_time', 'desc')
                ->paginate(25);
        }
        $meteringInfoCount = $meteringInfo->total();
        $this->assign("meteringInfo",$meteringInfo);
        $this->assign("meteringInfoCount",$meteringInfoCount);
        return $this->view->fetch("view-all-metering-info");
    }
    //展示计量添加页面
    public function addMeteringInfo(){
        $id = input("id");
        $this->assign("id",$id);
        return $this->view->fetch("view-add-metering-info");
    }
    //保存添加
    public function saveMeteringInfo(){
        $data = Request::post();
        $info = MeteringModel::create($data);
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    //删除保养
    public function delete(){
        $id = Request::post("id");
        $info = MeteringModel::where('id','=',$id)->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    //编辑信息
    public function editMeteringInfo(){
        $id = input("id");
        $meteringInfo = MeteringModel::where('id',$id)->select();
        $this->assign("meteringInfo",$meteringInfo);
        $this->assign("id",$id);
        return $this->view->fetch("view-edit-metering-info");
    }

    //更新信息
    public function update(){
        if(Request::isAjax()) {
            $data = Request::post();
            $id = $data['id'];
            $info = MeteringModel::update($data, ['id' => $id]);
            if ($info) {
                return json(1);
            } else {
                return json(0);
            }
        }
    }
}