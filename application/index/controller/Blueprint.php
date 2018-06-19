<?php
namespace app\index\controller;

use app\index\model\BlueprintInfo;
use app\index\common\controller\Base;
use app\index\model\BlueprintOutside;

class Blueprint extends Base
{
    public function blueprintInfo(){
       $blueprintInfo = BlueprintInfo::order('create_time','desc')->paginate(25);
       $blueprintInfoCount = $blueprintInfo->total();
       $this->assign('blueprintInfo',$blueprintInfo);
       $this->assign('blueprintInfoCount',$blueprintInfoCount);
       return $this->view->fetch('blueprint-info');
    }

    public function blueprintInterior(){

        return $this->view->fetch('blueprint-interior');
    }

    public function blueprintOutside(){
        //$blueprintOutside = BlueprintOutside::order('create_time','desc')->paginate(25);
        //$blueprintOutside = BlueprintOutside::all();
        $blueprintOutside = BlueprintOutside::order('create_time','desc')->paginate(25);
        $blueprintOutsideCount = $blueprintOutside->total();
        $this->assign('blueprintOutside',$blueprintOutside);
        $this->assign('blueprintOutsideCount',$blueprintOutsideCount);
        return $this->view->fetch('blueprint-outside');
    }

    public function blueprintInfos($id){
        $blueprintInfo = BlueprintInfo::where('drawing_detail_id',$id)->find();
        $this->assign('blueprintInfo',$blueprintInfo);
        return $this->view->fetch('blueprint-infos');
    }

    public function process(){
        return $this->view->fetch('process');
    }

    public function sequence(){
        return $this->view->fetch('sequence');
    }
}