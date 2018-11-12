<?php

namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\ProductTask;
use think\facade\Request;

class CurrentTask extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];

    public function inTask(){
        $ifCompletr = intval(input('id'));
        if($ifCompletr){
            //已制任务
            $ifCompletr = 0;
            $btnText = "未完";
            $productTaskInfo = ProductTask::where(['if_completr'=>1])->paginate(25);
        }else{
            //未制任务
            $ifCompletr = 1;
            $btnText = "已完";
            $productTaskInfo = ProductTask::where(['if_completr'=>0])->paginate(25);
        }
        $oCount = $productTaskInfo->total();

        $this->assign([
            'productTaskInfo'   => $productTaskInfo,
            'oCount'            => $oCount,
            'ifCompletr'        => $ifCompletr,
            'btnText'        => $btnText
        ]);
        return $this->view->fetch('in-task');
    }

//    public function selectTask(){
//        if(Request::isPost()){
//            $data = Request::post();
//            if($data['ifCompletr']){
//                //已制任务
//                $ifCompletr = 0;
//                $btnText = "未制任务";
//                $productTaskInfo = ProductTask::where(['if_completr'=>1])
//                    ->whereOr("task_id","LIKE","%".$data['modules']."%")
//                    ->paginate(25);
//            }else{
//                //未制任务
//                $ifCompletr = 1;
//                $btnText = "已制任务";
//                $productTaskInfo = ProductTask::where(['if_completr'=>0])->paginate(25);
//            }
//        }
//    }







}