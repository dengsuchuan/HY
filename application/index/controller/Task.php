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
use app\index\model\EquipmentInfo;
use app\index\model\ProductTask as ProductTaskModel;
use app\index\model\OrderDetail;
use think\facade\Request;

class Task extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
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

            $id = intval(input('id'));
            //获取订单明细编号
            $orderDetailCode = OrderDetail::where(['id'=>$id])->value('order_detail_code');
            $orderplan_qty = OrderDetail::where(['id'=>$id])->value('plan_qty');
            // 获取 设备编号
            $equipmentInfo = EquipmentInfo::where(['is_working'=>1])->field('id,eqpmt_id,eqpmt_name')->select();
            //生成编号
            $num = ProductTaskModel::order('task_id desc')->find();
            if($num == null){
                $i = 1;
            }else{
                $task_id = $num['task_id'];
                $i = substr($task_id,strripos($task_id,"-")+1) +1;
            }
            $taskCode = $i<10 ? '0'.$i :$i;
            $taskCode = 'TK-'.date('Ymd').'-'.$taskCode;
            $this->assign([
                'taskCode'  =>  $taskCode,
                'orderDetailCode'  => $orderDetailCode,
                'orderDetailID'    => $id,
                'orderplan_qty'   => $orderplan_qty,
                'euipmentInfo'    =>$equipmentInfo
            ]);

            $this->assign([
                'productTaskInfo'   => $productTaskInfo,
                'oCount'            => $oCount,
                'model'             =>1,
                'id'                =>$id,
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

    public function editTask(){
        if(Request::isPost()){
            $data = Request::post();
            $data['if_completr'] =  isset($data['if_completr']) ? '1' : '0';
            $id = $data['id'];
            unset($data['id']);
            $info = ProductTask::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        // 获取 设备编号
        $equipmentInfo = EquipmentInfo::where(['is_working'=>1])->field('id,eqpmt_id,eqpmt_name')->select();
        $taskRow = ProductTask::where(['id'=>$id])->find();
        $this->assign([
            'taskrow'   =>  $taskRow,
            'equipmentInfo'   => $equipmentInfo
        ]);
       return $this->view->fetch('edit_product_task');
    }
}