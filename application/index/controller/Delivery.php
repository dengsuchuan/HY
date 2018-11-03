<?php
/**
 * 材料截面
 * User: dengs
 * Date: 2018/6/7 0007
 * Time: 23:20
 */

namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\DeliveryInfoModel;
use app\index\model\DeliveryModel;
use app\index\model\Client;
use app\index\model\DeliveryOrderModel;
use app\index\model\Order;
use think\facade\Request;

class Delivery extends Base
{
    public function viewShow(){
        $delivery = DeliveryModel::order('create_time desc')->paginate(25);
        $deliveryCount = $delivery->total();
        $this->assign(compact('delivery','deliveryCount'));
        return $this->fetch('index-view-show');
    }

    public function addShow(){
        $delivery = new DeliveryModel();
        $str = "S".date('y').date('m').date('d');//字符串前部分
        $newId = $this->getNewId($str,$delivery,'deliveryId');//要获取的字符串前部分，实例，表对应的字段名
        $clientInfo = Client::all();
        $this->assign(compact('newId','clientInfo'));
        return $this->fetch('delivery_add');
    }

    public function addCreate(){
        if(Request::isAjax()){
            $data = Request::post();
            if(isset($data['if_print'])){
                $data['if_print'] = 1;
            }else{
                $data['if_print'] = 0;
            }
        }
        $info = DeliveryModel::create($data);
        if ($info){
            DeliveryInfoModel::create(['deliveryId'=>$data['deliveryId']]);
            return json(1);
        }else{
            return json(0);
        }
    }

    public function editShow(){
        $id = input('id');
        $delivery = DeliveryModel::where(['id'=>$id])->select();
        $clientInfo = Client::all();
        $this->assign(compact('clientInfo','delivery'));
        return $this->fetch('delivery_edit');
    }

    public function editUpdate(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            if(isset($data['if_print'])){
                $data['if_print'] = 1;
            }else{
                $data['if_print'] = 0;
            }
            $info = DeliveryModel::where(['id'=>$id])->update($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    public function delete(){
        if(Request::isAjax()){
            $id = Request::post('id');
            $deliveryId = Request::post('deliveryId');
            $info = DeliveryModel::where(['id'=>$id])->delete();
            if($info){
                DeliveryInfoModel::where(['deliveryId'=>$deliveryId])->delete();
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    //送货单明细
    public function deliveryDetails(){
        //对应的送货单
        $deliverId = input('deliverId');
        $delivery = DeliveryInfoModel::where(['deliveryId'=>$deliverId])->select();
        //该送货单拥有的订单

        //查询所有对应的订单
        $deliverOrder = DeliveryOrderModel::where(['deliverId'=>$deliverId])->select();
        if(count($deliverOrder)>0){
            foreach ($deliverOrder as $value){
                $tempArray[] = $value['orderId'];
            }
            $orderInfo = Order::where(['order_id'=>$tempArray])->select();
            $countOrder = count($orderInfo);
            $this->view->assign(compact('delivery','deliverId','orderInfo','countOrder'));
        }else{
            $countOrder = 0;
            $orderInfo = 0;
            $this->view->assign(compact('delivery','deliverId','countOrder','orderInfo'));
        }

        return $this->view->fetch('delivery-details');
    }

    //查看订单
    public function selectOrder(){
        $orderInfo = Order::where(['if_complete'=>0])->order('order_id asc')->paginate(25);
        $count =  $orderInfo->total();
        $this->assign(compact('orderInfo','count'));
        return $this->view->fetch('view_order');
    }

    //订单表和订单项目关系
    public function addNexus(){
        if(Request::isAjax()){
            $data = Request::post();
            $info = DeliveryOrderModel::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    //删除发货单和订单的关系
    public function delOrder(){
        if(Request::isAjax()){
            $id = Request::post();
            $info = DeliveryOrderModel::where(['orderId'=>$id])->delete();
            if ($info){
                return json(1);
            }else{
                return json(0);
            }
        }

    }





}