<?php
namespace app\index\controller;

use app\index\model\BlueprintInfo;
use app\index\common\controller\Base;
use app\index\model\BlueprintOutside;

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
        $blueprintOutside = BlueprintOutside::field("W180706-")->select();

        $this->assign("blueprintOutsideList",$blueprintOutside);
        return $this->view->fetch("add-drawing-externa");
    }

    //--|--|添加图纸明细控制器
    public function addDrawingDetial(){
        return $this->view->fetch('add-drawing-detial');
    }




    public function blueprintInterior(){

        return $this->view->fetch('blueprint-interior');
    }




}