<?php
/**
 * 材料截面
 * User: dengs
 * Date: 2018/6/7 0007
 * Time: 23:20
 */

namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\DeliveryModel;
use app\index\model\Client;
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
            $info = DeliveryModel::where(['id'=>$id])->delete();
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    //送货单明细
    public function deliveryDetails(){
        return $this->view->fetch('delivery-details');
    }

}