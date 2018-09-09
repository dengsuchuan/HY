<?php
/**
 *  订单模块
 * User: dengs
 * Date: 2018/6/7 0007
 * Time: 23:20
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\Order as OrderMode;
use app\index\model\BlueprintOutside;
use app\index\model\DrawingInternal;
use function Couchbase\defaultDecoder;
use think\facade\Request;
use app\index\model\BlueprintInfo;
use app\index\model\OrderDetail;
use app\index\model\Client;
class Order extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    public function order(){
        $orderInfo = OrderMode::order('order_id asc')->paginate(25);
        $count =  $orderInfo->total();
        $this->assign([
            'orderInfo' =>  $orderInfo,
            'count'    =>  $count
        ]);
        return $this->view->fetch('order');
    }
    //添加订单
    public function addOrder(){
//        判断是否为post
        if(Request::isPost()){
            $data = Request::post();
            $mode = new OrderMode();
            $code = $this->getNewId('C'.date('y').date('m').date('d'),$mode,'order_id');
            $data['order_id'] = $code;
            $data['receivables'] = isset($data['receivables']) ? '1' : '0';
            $data['deliver_goods'] = isset($data['deliver_goods']) ? '1' : '0';
            $data['if_complete'] = isset($data['if_complete']) ? '1' : '0';
            $data['create_name'] = session('user.user_name');
            $info = OrderMode::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        //生成编号
        $mode = new OrderMode();
        $code = $this->getNewId('C'.date('y').date('m').date('d'),$mode,'order_id');
        //获取外图信息
        $externalInfo = BlueprintOutside::field('id,drawing_external_id')->select();
        //获取内图相关信息
        $internalInfo = DrawingInternal::field('id,drawing_Internal_id')->select();
        //获取客户简称
        $clientInfo = Client::field('id,client_abbreviation')->select();
        $this->assign([
            'code' => $code,
            'externalInfo' =>  $externalInfo,
            'internalInfo' =>  $internalInfo,
            'clientInfo'    =>$clientInfo
        ]);
        return  $this->view->fetch('order_add');
    }
    public function editOrder(){
        if(Request::isPost()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            $data['receivables'] = isset($data['receivables']) ? '1' : '0';
            $data['deliver_goods'] = isset($data['deliver_goods']) ? '1' : '0';
            $data['if_complete'] = isset($data['if_complete']) ? '1' : '0';
            $data['modify_name'] = session('user.user_name');
            $info = OrderMode::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $orderRow = OrderMode::get(intval(input('id')));
        $this->assign([
            'orderRow' => $orderRow,
        ]);
        return  $this->view->fetch('order_edit');
    }

    public function orderDetail(){
        $model = intval(input('model'));
        $id = intval(input('id'));
        if($model == 1){
            $orderRow = OrderMode::where(['id'=>$id])->select();
            $orderCode = OrderMode::where(['id'=>$id])->value('id');
            //获取订单明细
            $orderDatailInfo = OrderDetail::where(['order_id'=>$id])->order('drawing_externa_or_internal_id desc')->order('sort asc')->order('if_show desc')->paginate(25);
            $orderDatailInfoC = count($orderDatailInfo);
            $orderDatailInfoNoShow = count(OrderDetail::where(['order_id'=>$id])->where(['if_show'=>0])->select());
            $this->assign([
                'orderRow'            => $orderRow,
                'orderCode'           => $orderCode,
                'orderDatailInfo'     => $orderDatailInfo,
                'orderDatailInfoNoShow'    =>$orderDatailInfoNoShow,
                'orderDatailInfoC'    =>$orderDatailInfoC,
                'id'                   =>$id,
                'model'                 =>1
            ]);
            return  $this->view->fetch('order-detail-info');
        }

        $orderRow = OrderMode::where(['id'=>$id])->select();
        $orderCode = OrderMode::where(['id'=>$id])->value('id');
        //获取订单明细
        $orderDatailInfo = OrderDetail::where(['order_id'=>$id])->order('drawing_externa_or_internal_id desc')->where(['if_show'=>1])->order('sort asc')->order('if_show desc')->paginate(25);
        $orderDatailInfoC = count($orderDatailInfo);
        $orderDatailInfoNoShow = count(OrderDetail::where(['order_id'=>$id])->where(['if_show'=>0])->select());
        $this->assign([
            'orderRow'            => $orderRow,
            'orderCode'           => $orderCode,
            'orderDatailInfo'     => $orderDatailInfo,
            'orderDatailInfoNoShow'    =>$orderDatailInfoNoShow,
            'orderDatailInfoC'    =>$orderDatailInfoC,
            'id'                   =>$id,
            'model'                 =>0
        ]);
        return  $this->view->fetch('order-detail-info');
    }
    public function addOrderDetail(){
        if (Request::isPost()){
            $data = Request::post();
            $coder = $data['order'];
            $code = OrderDetail::where(['order_id'=>$coder])->order('order_detail_code desc')->value('order_detail_code');
            $sort = OrderDetail::where(['order_id'=>$coder])->order('sort desc')->value('sort');
            if($sort == null){
                $sort = 0;
            }
            if($code == null){
                $tempid = 1;
            }else{
                $tempid =  substr($code,strripos($code,"-")+1) +1;
            }
            unset($data['ordercode']);
            unset($data['order']);
            $order_code = Request::post('ordercode');
            $datas = [];
            $mode =  new OrderDetail();
            foreach ($data as $key=>$value){
                if($key == 'drawing_detail_id'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        OrderDetail::where('drawing_detail_id','=',$v1)->where(['order_id'=>$coder])->delete();
                        $datas[][$key] = $value[$i];
                        $datas[$i]['order_detail_code'] = $order_code.'-'. ($tempid<10 ? '0'.$tempid :$tempid);
                        $datas[$i]['sort'] = ++$sort;
                        $datas[$i]['create_name'] =  session('user.user_name');
                        $i++;
                        $tempid++;
                    }
                }
                if($key == 'order_id'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'plan_qty'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $datas[$i]['plan_qty'] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'arrange'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'company'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'content'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'order_qty'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'date_delivery'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'purchase_id'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'material_source'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'warehousing'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'purchase_id'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'drawing_externa_or_internal_id'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = getExternaId($value[$i]);
                        $i++;
                    }
                }
            }
            $orderDetail = new OrderDetail();
            $info = $orderDetail->saveAll($datas);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }

        $id = input('id');
        $ids = explode(',',$id);
        $orderId = input('order');
        $orderCode = OrderMode::where(['id'=>$orderId])->value('order_id');
        $blueprintInfo = BlueprintInfo::where('drawing_externa_id','in',$ids)->select();
        $this->assign([
            'orderId'        =>  $orderId,
            'orderCode'      =>  $orderCode,
            'blueprintInfo'  =>   $blueprintInfo
        ]);
        return  $this->view->fetch('order_detail_add');
    }
    public function newOrder(){
        $ids = input();
        $ocder_id = $ids['id'];
        $o_drawing_details = OrderDetail::where(['order_id'=>$ids['id']])->where(['drawing_externa_or_internal_id'=>$ids['ex_or_id']])->field('drawing_detail_id')->select();  //现有的明细
        $ex_or_code = BlueprintOutside::where(['id'=>$ids['ex_or_id']])->value('drawing_external_id'); // 跟据外图id获取外图编号
        $d_drawing_details = BlueprintInfo::where(['drawing_externa_id'=>$ex_or_code])->field('id')->select(); // 跟据外图编号获取图纸明细
        $d_ids = [];  // 数据转换
        foreach ( $d_drawing_details as $item) {
            $d_ids[] = $item['id'];
        }
        $o_ids = [];
        foreach ($o_drawing_details  as $value) {
            $o_ids[] = $value['drawing_detail_id'];
        }
        $ids = array_diff($d_ids,$o_ids);  // 求两个数组的交集
        $orderId = $ocder_id;
        $orderCode = OrderMode::where(['id'=>$orderId])->value('order_id');
        $blueprintInfo = BlueprintInfo::where('id','in',$ids)->select();
        $this->assign([
            'orderId'        =>  $orderId,
            'orderCode'      =>  $orderCode,
            'blueprintInfo'  =>   $blueprintInfo
        ]);
        return  $this->view->fetch('order_detail_add');
    }
    public function orderDelete(){
        $id = intval(Request::post('id')); // 获取id
        //删除订单
        $info = OrderMode::where(['id'=>$id])->delete(); //
        if($info){
            // 删除订单对应的订单详细
            OrderDetail::where(['order_id'=>$id])->delete();
            return json(1);
        }else{
            return json(0);
        }
    }
    public function editOrderDetail(){
        if(Request::isPost()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            $data['if_show'] =  isset($data['if_show']) ? '1' : '0';
            $info = OrderDetail::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        $ordeDetailRow = OrderDetail::where(['id'=>$id])->find();
        $this->assign([
            'ordeDetailRow' =>  $ordeDetailRow
        ]);
        return $this->view->fetch('order_edit_detail');
    }
    public function updateShow(){
        $data = Request::post();
        $info = OrderDetail::update(['if_show'=>$data['show']],['id'=>$data['id']]);
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    public function deleteDetail(){
        $info = OrderDetail::where(['id'=>intval(input('id'))])->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    //@DrawingInternal 为当前数据表模型
    public function SanSort(){
        $data = Request::post();
        $OrderDetail = new OrderDetail();
        return $this->Sort($data,$OrderDetail);
    }
}

