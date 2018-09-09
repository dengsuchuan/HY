<?php
/**
 *  任务控制器
 * User: @ 若雨
 * Date: 2018/9/7
 * Time: 17:26
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\ProductTask as ProductTaskModel;
use app\index\model\OrderDetail;
use app\index\model\EquipmentInfo;
use think\facade\Request;
class ProductTask extends Base
{
    public function addProductTask(){
        if(Request::isAjax()){
            $data = Request::post();
            $data['if_completr'] =  isset($data['if_completr']) ? '1' : '0';

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
            $data['create_name'] = session('user.user_name');
            $data['task_id'] = $taskCode;

            $info = ProductTaskModel::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
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
            'equipmentInfo'    => $equipmentInfo,
            'orderDetailID'    => $id,
            'orderplan_qty'   => $orderplan_qty
        ]);
        return $this->view->fetch('add_product_task');
    }
    public function product(){
        $id = intval(input('id'));
        $productTaskInfo = ProductTaskModel::where(['order_detial_id'=>$id])->select();
        $this->assign([
            'productTaskInfo'   => $productTaskInfo
        ]);
        return $this->assign([
        ]);
    }
}