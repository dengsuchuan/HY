<?php
/**
 * Created by PhpStorm.
 * User: dengs
 * Date: 2018/6/7 0007
 * Time: 23:20
 */

namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\ProductTask;
class Task extends Base
{
    public function alreadyTask(){
        return $this->view->fetch('already-task');
    }

    public function classes(){
        return $this->view->fetch('classes');
    }

    public function evidence(){
        return $this->view->fetch('evidence');
    }

    public function inTask(){
        $id = intval(input('id'));
        if($id){
            $productTaskInfo = ProductTask::where(['order_detial_id'=>$id])->paginate(25);
            $oCount = $productTaskInfo->total();
            $this->assign([
                'productTaskInfo'   => $productTaskInfo,
                'oCount'            => $oCount,
                'model'             =>1,
                'id'                =>$id
            ]);
            return $this->view->fetch('in-task');
        }
        $productTaskInfo = ProductTask::where(['if_completr'=>0])->paginate(25);
        $oCount = $productTaskInfo->total();
        $this->assign([
            'productTaskInfo'   => $productTaskInfo,
            'oCount'            => $oCount,
            'model'             => 0
        ]);
        return $this->view->fetch('in-task');
    }

    public function sendGoodsGather(){
        return $this->view->fetch('send-goods-gather');
    }

    public function sendGoodsInquiry(){
        return $this->view->fetch('send-goods-inquiry');
    }


}