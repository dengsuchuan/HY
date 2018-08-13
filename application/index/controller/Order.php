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
class Order extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    public function order(){

        return $this->view->fetch('order');
    }
    //添加订单
    public function addOrder(){

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
}