<?php
/**
 * 订单报价明细
 * User: dengsuchuan
 * Date: 18-9-6
 * Time: 下午4:48
 */
namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\BlueprintInfo;
use app\index\model\Order;
use app\index\model\OrderDetail;
use app\index\model\QuotedMode;
use app\index\model\QuotedOrderModel;
use app\index\model\QuoteModel;
use app\index\model\Material;
use think\facade\Request;

class Quoted extends  Base{
    public function viewshow(){
        //对应的送货单
        $quoteId = input('quoteId');
        $show = input('show');

        //查询报价单和订单的关系
        //echo $quoteId;
        $quoted = QuotedMode::where("quote_info_id","LIKE","%$quoteId%")->select();
        //var_dump($quoted);
        //获得数量
        $quotedCount = count($quoted);
        //如果存在数据
        if($quotedCount>0){
            $this->view->assign(compact('quoteId','quoted','quotedCount','show'));
        }else{
            $this->view->assign(compact('quoteId','quotedCount','show'));
        }


        return $this->view->fetch();
    }

    public function addquoted(){
        //获取明细编号
        $quoteId = input("quoteId");
        $model = new QuotedMode();
        $quote_info_id = $this->getNewId($quoteId,$model,'quote_info_id');

        $this->view->assign(compact("quote_info_id"));
        return $this->view->fetch("add-quoted");
    }

    public function selectOrder(){
        $orderInfo = Order::where(['if_complete'=>0])->order('order_id asc')->paginate(25);
        $count =  $orderInfo->total();
        $quoteId = input("quoteId");
        $this->assign(compact('orderInfo','count',"quoteId"));
        return $this->view->fetch('view_order');
    }


    //订单表和订单项目关系
    public function addNexus(){
        if(Request::isAjax()){
            $data = Request::post();
            $quoteId = $data['quoted_id'];
            //获取到订单产品的编号
            $orderIdArray = explode(",",$data['orderinfo_id']);
            //循环批量入库
            $res = 0;
            foreach ($orderIdArray as $value){
                //拿到对应订单id的详细信息
                $orderDetailInfo = OrderDetail::where(['id'=>$value])->select();
                //报价和订单的对应关系，如果有就删除
                QuotedOrderModel::where(['quoted_id'=>$quoteId,'orderinfo_id'=>$value])->delete();
                //写入报价和订单的对应关系
                $info = QuotedOrderModel::create(['quoted_id'=>$quoteId,'orderinfo_id'=>$value]);
                //上面对应关系入库成功，开始写入报价的明细
                if($info){
                    //用该函数，一个一个写入明细
                    $res = $this->saveDeliveryInfo($quoteId,$orderDetailInfo[0]);
                }
            }
            if($res){
                return json(1);
            }else{
                return json(0);
            }
        }
    }
    public function saveDeliveryInfo($quoteId,$orderDetailInfo){
        //拿到数量之后，开始生成明细单编号，写入明细对应
        //报价单明细编号
        $quoted = new QuotedMode();
        $deliveryInfoId = $this->getNewId($quoteId,$quoted,'quote_info_id');

        //下面是从订单明细里面拿资料出来
        //数量
        $quantity = $orderDetailInfo['order_qty'];
        //对应订单明细编号
        $orderStr = $orderDetailInfo['order_detail_code'];


        //先拿到图纸明细的编号Id
        $drawing_detail_id = $orderDetailInfo['drawing_detail_id'];

        //获得内图编号
        $external=BlueprintInfo::where(['id'=>$drawing_detail_id])->value('drawing_internal_id');

        //获得外图编号
        $waiExternal = BlueprintInfo::where(['id'=>$drawing_detail_id])->value('drawing_externa_id');

        //$waiExternal= "$drawing_detail_id";
        //获得产品名称
        $drawingName = getDrawingName($drawing_detail_id);

        //获得材料
        $materialId = BlueprintInfo::where(['id'=>$drawing_detail_id])->value('material');
        $materialName = Material::where(['id'=>$materialId])->value('material_id');


        //拿到订单数组
        $order_id = substr($orderStr, 0, -3);
        //$orderInfo = getOrderInfo($order_id);
        //$orderInfo = ['client_prj_id'=>$order_id,'order_time'=>$order_id,'application'=>$order_id];

        $array = [
            "quote_info_id"=>$deliveryInfoId,
            "order_info_id"=>$orderStr,
            "waitu_id"=>$waiExternal,
            "neitu_id"=>$external,
            "chanpin_name"=>$drawingName,
            "cailiao"=>$materialName,
            "shuliang"=>$quantity
        ];
        //var_dump($array);

        QuotedMode::where(['quote_info_id'=>$deliveryInfoId,'order_info_id'=>$orderStr])->delete();

        $info = QuotedMode::create($array);
        if ($info){
            return 1;
        }else{
            return 0;
        }

    }



























}