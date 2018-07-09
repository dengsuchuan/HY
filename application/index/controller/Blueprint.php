<?php
namespace app\index\controller;

use app\index\model\BlueprintInfo;
use app\index\common\controller\Base;
use app\index\model\BlueprintOutside;
use think\facade\Request;


class Blueprint extends Base
{
    //--|图纸明细控制器以及相关子控制器
    public function blueprintInfo(){
       $blueprintInfo = BlueprintInfo::order('create_time','desc')->paginate(25);
       $blueprintInfoCount = $blueprintInfo->total();
       $this->assign('blueprintInfo',$blueprintInfo);
       $this->assign('blueprintInfoCount',$blueprintInfoCount);
       return $this->view->fetch('blueprint-info');
    }
    //--|--|明细具体项目详情
    public function blueprintInfos($id){
        $blueprintInfo = BlueprintInfo::where('drawing_detail_id',$id)->find();
        $this->assign('blueprintInfo',$blueprintInfo);
        return $this->view->fetch('blueprint-infos');
    }
    //--|--|工艺管理详情
    public function process(){
        return $this->view->fetch('process');
    }
    //--|--|工艺管理里面的工序详情
    public function sequence(){
        return $this->view->fetch('sequence');
    }


    //--|外图控制器以及子控制器
    public function blueprintOutside(){
        $blueprintOutside = BlueprintOutside::order('create_time','desc')->paginate(25);
        $blueprintOutsideCount = $blueprintOutside->total();
        $this->assign('blueprintOutside',$blueprintOutside);
        $this->assign('blueprintOutsideCount',$blueprintOutsideCount);
        return $this->view->fetch('blueprint-outside');
    }
    //--|--|添加外图视图生成器
    public function addDrawingExterna(){
        //获取数据库中W180706-x的数量实现自动生成编号
        $blueprintOutside = BlueprintOutside::where('drawing_external_id',"LIKE","W180706-%")
            ->order("drawing_external_id",'DESC')
            ->find();
        $this->assign("blueprintOutsideList",$blueprintOutside);
        if($blueprintOutside){
            $stdClassTemp = json_decode($blueprintOutside);
            $stdClassJson  =json_encode($stdClassTemp); //把她转换为json字符串
            $stdClassArray = json_decode($stdClassJson,true); //再把json字符串格式化为数组
            $drawingExternalId = $stdClassArray['drawing_external_id'];
        }else{
            $drawingExternalId = "W180706-0";
        }

        $arrayTemp = explode("-", $drawingExternalId);
        $numberTemp = $arrayTemp[1]+1;

        $this->assign("createId","W180706-".$numberTemp);
        return $this->view->fetch("add-drawing-externa");
    }

    public function addDrawingExternalId(){//传入编号和备注
        if(Request::isAjax()){
            //获取提交过来的所有数据
            $data = Request::post();
            $res = BlueprintOutside::create($data);
            if($res){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    //--|--|添加图纸明细控制器
    public function addDrawingDetial(){
        return $this->view->fetch('add-drawing-detial');
    }

    public function blueprintInterior(){

        return $this->view->fetch('blueprint-interior');
    }




}