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
use think\facade\Request;
use app\index\model\BlueprintInfo;
use app\index\model\OrderDetail;
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
            $code = $this->getNewId('0'.date('y').date('m').date('d'),$mode,'order_id');
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
        $code = $this->getNewId('0'.date('y').date('m').date('d'),$mode,'order_id');
        //获取外图信息
        $externalInfo = BlueprintOutside::field('id,drawing_external_id')->select();
        //获取内图相关信息
        $internalInfo = DrawingInternal::field('id,drawing_Internal_id')->select();

        $this->assign([
            'code' => $code,
            'externalInfo' =>  $externalInfo,
            'internalInfo' =>  $internalInfo
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
        $orderRow = OrderMode::where(['id'=>intval(input('id'))])->select();
        $orderCode = OrderMode::where(['id'=>intval(input('id'))])->value('id');
        $this->assign([
            'orderRow'      => $orderRow,
            'orderCode'    => $orderCode
        ]);
        return  $this->view->fetch('order-detail-info');
    }
    public function addOrderDetail(){
        if (Request::isPost()){
            $data = Request::post();
//            dd($data);
            $datas = [];
            foreach ($data as $key=>$value){
                if($key == 'drawing_detail_id'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'order_id'){
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

            }
            dd($datas);
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
}