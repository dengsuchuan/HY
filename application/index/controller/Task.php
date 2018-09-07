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
        $productTaskInfo = ProductTask::where(['if_completr'=>0])->select();
        $this->assign([
            'productTaskInfo'   => $productTaskInfo
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