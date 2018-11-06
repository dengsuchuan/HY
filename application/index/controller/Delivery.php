<?php
/**
 * 材料截面
 * User: dengs
 * Date: 2018/6/7 0007
 * Time: 23:20
 */

namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\BlueprintInfo;
use app\index\model\DeliveryInfoModel;
use app\index\model\DeliveryModel;
use app\index\model\Client;
use app\index\model\DeliveryOrderModel;
use app\index\model\Order;
use app\index\model\OrderDetail;
use app\index\model\Material;
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
                DeliveryOrderModel::where(['deliverId'=>$deliveryId])->delete();
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    //送货单明细
    public function deliveryDetails(){
        //对应的送货单
        $deliveryId = input('deliverId');
        $show = input('show');

        //查询送货单和订单的关系
        $orderDatailInfo = DeliveryInfoModel::where(['deliveryId'=>$deliveryId])->order("orderCode asc")->select();
        //获得数量
        $deliverOrderCount = count($orderDatailInfo);
        //如果存在数据
        if($deliverOrderCount>0){
            $this->view->assign(compact('deliveryId','orderDatailInfo','deliverOrderCount','show'));
        }else{
            $this->view->assign(compact('deliveryId','deliverOrderCount','show'));
        }


        return $this->view->fetch('delivery-details');
    }

    //查看订单
    public function selectOrder(){
        $orderInfo = Order::where(['if_complete'=>0])->order('order_id asc')->paginate(25);
        $count =  $orderInfo->total();
        $deliveryId = input('deliveryId');
        $this->assign(compact('orderInfo','count','deliveryId'));
        return $this->view->fetch('view_order');
    }

    //订单表和订单项目关系
    public function addNexus(){
        if(Request::isAjax()){
            $data = Request::post();
            $deliveryId = $data['deliverId'];
            //获取到订单产品的编号
            $orderIdArray = explode(",",$data['orderId']);
            //循环批量入库
            $res = 0;
            foreach ($orderIdArray as $value){
                $orderDetailInfo = OrderDetail::where(['id'=>$value])->select();

                //查询是否已经存在对应的关系
                DeliveryOrderModel::where(['deliverId'=>$deliveryId,'orderId'=>$value])->delete();
                //不存在，开始准备入库
                //开始入库到送货单和订单产品单关系表
                $info = DeliveryOrderModel::create(['deliverId'=>$deliveryId,'orderId'=>$value]);
                //创建送货明细单，先拿出对应订单产品单里面的产品数量
                //查询数量
                if($info){
                    $res = $this->saveDeliveryInfo($deliveryId,$orderDetailInfo[0]);
                }
            }
            if($res){
                return json(1);
            }else{
                return json(0);
            }
        }
    }
    public function saveDeliveryInfo($deliveryId,$orderDetailInfo){
        //$orderDetailInfo = ['order_qty'=>12345,'order_detail_code'=>"A01-7F"];
        //$orderDetailInfo = ['order_qty'=>$order['order_qty'],'order_detail_code'=>$order['order_detail_code']];
        //拿到数量之后，开始生成明细单编号，写入明细对应
        //我现在需要，送货明细编号，送货单编号，送货数量，对应订单编号
        //送货单编号,赋值走个过场
        $deliveryId = $deliveryId;
        //送货明细编号
        $deliveryInfo = new DeliveryInfoModel();
        $deliveryInfoId = $this->getNewId($deliveryId,$deliveryInfo,'deliveryInfoId');
        //送货数量
        $quantity = $orderDetailInfo['order_qty'];
        //对应订单编号
        $orderStr = $orderDetailInfo['order_detail_code'];
        $orderCode = $orderStr;
        //先拿到图纸明细的编号Id
        $drawing_detail_id = $orderDetailInfo['drawing_detail_id'];
        //获得内图编号
        $external=BlueprintInfo::where(['id'=>$drawing_detail_id])->value('drawing_internal_id');
        //获得外图编号
        $waiExternal = BlueprintInfo::where(['id'=>$drawing_detail_id])->value('drawing_externa_id');
        //$waiExternal= "$drawing_detail_id";
        //获得图纸名称
        $drawingName = getDrawingName($drawing_detail_id);
        //获得材料
        $materialId = BlueprintInfo::where(['id'=>$drawing_detail_id])->value('material');
        $materialName = Material::where(['id'=>$materialId])->value('material_id');
        //获得版本号
        $materialVersion = BlueprintInfo::where(['id'=>$drawing_detail_id])->value('version');
//      $materialVersion= "$drawing_detail_id";

        //拿到订单数组
        $order_id = substr($orderStr, 0, -3);
        //$orderInfo = getOrderInfo($order_id);
        //$orderInfo = ['client_prj_id'=>$order_id,'order_time'=>$order_id,'application'=>$order_id];
        //得到客户项目号
        $client_prj_id = Order::where(['order_id'=>$order_id])->value("client_prj_id");
        //得到下单时间
        $order_time = Order::where(['order_id'=>$order_id])->value("order_time");
        //得到申请人
        $application = Order::where(['order_id'=>$order_id])->value("application");
        //得到产品价格
        $price = "0";

        //通过图纸明细，拿到外图和内图的编号
        //创建入库
        DeliveryInfoModel::where(['orderCode'=>$orderCode,'deliveryId'=>$deliveryId])->delete();
        $info = DeliveryInfoModel::create([
            'deliveryInfoId'=>$deliveryInfoId,
            'deliveryId'=>$deliveryId,
            'orderCode'=>$orderCode,
            'quantity'=>$quantity,
            'external'=>$external,
            'waiExternal'=>$waiExternal,
            'drawingName'=>$drawingName,
            'materialName'=>$materialName,
            'materialVersion'=>$materialVersion,
            'client_prj_id'=>$client_prj_id,
            'order_time'=>$order_time,
            'application'=>$application,
            'price'=>$price
        ]);
        if ($info){
            return 1;
        }else{
            return 0;
        }
    }

    //删除发货单和订单的关系
    public function delOrder(){
        if(Request::isAjax()){
            $id = Request::post('id');
            $info = DeliveryInfoModel::where(['deliveryInfoId'=>$id])->delete();
            if ($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    public function updateNum(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = $data['deliveryInfoId'];
            unset($data['deliveryInfoId']);
            $info = DeliveryInfoModel::where(['deliveryInfoId'=>$id])->update($data);
            if ($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    public function editOrder(){
        $id = input('id');
        $quantity = input('quantity');
        $remarks = input('remarks');
        $this->view->assign(compact('id','quantity','remarks'));
        return $this->view->fetch("delivery_order_edit");
    }
    public function updateOrder(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            $info = DeliveryInfoModel::where(['id'=>$id])->update($data);
            if ($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }





}