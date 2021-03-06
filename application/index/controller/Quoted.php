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
use app\index\model\BlueprintOutside;
use app\index\model\DrawingInternal;
use app\index\model\Order;
use app\index\model\OrderDetail;
use app\index\model\QuotedMode;
use app\index\model\QuotedOrderModel;
use app\index\model\QuoteModel;
use app\index\model\Material;
use app\index\model\Section as SectionModel;
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
        $order_qty = $orderDetailInfo['order_qty'];


        //先拿到图纸明细的编号Id
        $drawing_detail_id = $orderDetailInfo['drawing_detail_id'];


        //获得内图编号
        $external=BlueprintInfo::where(['id'=>$drawing_detail_id])->value('drawing_internal_id');

        //获得外图编号
        $waiExternal = BlueprintInfo::where(['id'=>$drawing_detail_id])->value('drawing_externa_id');
        //获得排料数量
        $layout_qty = BlueprintInfo::where(['id'=>$drawing_detail_id])->value('layout_qty');


        //获得产品名称
        $drawingName = getDrawingName($drawing_detail_id);

        //获得产品形状
        $material_type = BlueprintInfo::where(['id'=>$drawing_detail_id])->value('material_type');
        $shape = getMateria($material_type);

        $tempSize = "";

        //获得材料
        $materialId = BlueprintInfo::where(['id'=>$drawing_detail_id])->value('material');
        $materialName = Material::where(['id'=>$materialId])->value('material_id');

        //获得材料的密度
        $materialDensity = Material::where(['id'=>$materialId])->value('density');
        //获得材料的价格
        $materialPrice = Material::where(['id'=>$materialId])->value('material_price');

        //判断形状，获得不同的尺寸  && 根据材料和形状，计算出单重
        $maopijiage = 0;
        switch ($shape){
            case "板":
                $length = BlueprintInfo::where("id",$drawing_detail_id)->value("length_dim");
                $width = BlueprintInfo::where("id",$drawing_detail_id)->value("width_dim");
                $thickness = BlueprintInfo::where("id",$drawing_detail_id)->value("thickness2_Dia");
                $tempSize = ($length+5)." x ".($width+5)." x ".($thickness);
                $maopijiage = ($length+5)*($width+5)*$thickness*2 < 10?10:($length+5)*($width+5)*$thickness*2;
                //计算单重
                //长度  宽度  厚度  密度
                $danzhong = ($length+5)*($width+5)*$thickness*$materialDensity/1000000;
                //zongzhong  总重
                break;
            case "棒":
                $width = BlueprintInfo::where("id",$drawing_detail_id)->value("width_dim");
                $thickness = BlueprintInfo::where("id",$drawing_detail_id)->value("thickness_Dia");
                $tempSize = $thickness." x ".$width;

                //直径  长度  密度
                $danzhong = (3.14*($thickness/2)^2*$width*$materialDensity)/1000000;
                break;
            case "管":
                $length = BlueprintInfo::where("id",$drawing_detail_id)->value("length_dim");
                $width = BlueprintInfo::where("id",$drawing_detail_id)->value("width_dim");
                $thickness = BlueprintInfo::where("id",$drawing_detail_id)->value("thickness_Dia");
                $tempSize = $thickness." x ".$width." x ".$length;
                $danzhong = (3.14*(($width/2)^2-(($width-2*$thickness)/2)^2)*$length*$materialDensity)/1000000;
                break;
            case "槽钢":
                $length = BlueprintInfo::where("id",$drawing_detail_id)->value("length_dim");
                $hjbStr = BlueprintInfo::where("id",$drawing_detail_id)->value("specifications");
                $tempSize =  $hjbStr." x ".$length;
                //通过横截面积获得具体的参数
                $weight = SectionModel::where("spec",$hjbStr)->value("weight");
                $danzhong = ($weight*$length*$materialDensity)/10000;
                break;
            case "轨道":
                $length = BlueprintInfo::where("id",$drawing_detail_id)->value("length_dim");
                $hjbStr = BlueprintInfo::where("id",$drawing_detail_id)->value("specifications");
                $tempSize =  $hjbStr." x ".$length;
                //通过横截面积获得具体的参数
                $weight = SectionModel::where("spec",$hjbStr)->value("weight");
                $danzhong = ($weight*$length*$materialDensity)/10000;
                break;
            case "角钢":
                $length = BlueprintInfo::where("id",$drawing_detail_id)->value("length_dim");
                $hjbStr = BlueprintInfo::where("id",$drawing_detail_id)->value("specifications");
                $tempSize =  $hjbStr." x ".$length;
                //通过横截面积获得具体的参数
                $weight = SectionModel::where("spec",$hjbStr)->value("weight");
                $danzhong = ($weight*$length*$materialDensity)/10000;
                break;
            case "矩管":
                $length = BlueprintInfo::where("id",$drawing_detail_id)->value("length_dim");
                $hjbStr = BlueprintInfo::where("id",$drawing_detail_id)->value("specifications");
                $tempSize = $hjbStr." x ".$length;
                //通过横截面积获得具体的参数
                $weight = SectionModel::where("spec",$hjbStr)->value("weight");
                $danzhong = ($weight*$length*$materialDensity)/10000;
                break;
        }

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
            "shuliang"=>$quantity,
            "xingzhuang"=>$shape,
            "chicun"=>$tempSize,
            "tuzhimingxiid"=>$drawing_detail_id,
            "shuliang"=>$order_qty,
            "danzhong"=>round($danzhong,2)/$layout_qty,
            "zongzhong"=>((round($danzhong,2)/$layout_qty)*$order_qty),
            "dancailiaofeiyon"=>((round($danzhong,2)/$layout_qty)*$materialPrice),
            "zongcailiaofeiyon"=>((round($danzhong,2)/$layout_qty)*$order_qty)*$materialPrice,
            "jingpijiagongfeiyon"=>$maopijiage
        ];
        QuotedMode::where(['quote_info_id'=>$deliveryInfoId,'order_info_id'=>$orderStr])->delete();

        $info = QuotedMode::create($array);
        if ($info){
            return 1;
        }else{
            return 0;
        }

    }

    public function delete(){
        if(Request::isAjax()){
            $id = Request::post('id');
            $info = QuotedMode::where(['id'=>$id])->delete();
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

























}