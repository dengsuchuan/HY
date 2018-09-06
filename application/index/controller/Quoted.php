<?php
/**
 * 订单报价.
 * User: dengsuchuan
 * Date: 18-9-6
 * Time: 下午4:48
 */
namespace app\index\controller;

use app\index\common\controller\Base;
class Quoted extends  Base{
    public function quotedInfoType1(){
        $order_id = input("id");
        $this->view->assign("order_id",$order_id);
        return $this->view->fetch("view-quoted-info");
    }

    public function quotedInfoType2(){
        $order_id = input("id");
        $this->view->assign("order_id",$order_id);
        return $this->view->fetch("view-quoted-info");
    }

    public function quotedInfoType3(){
        $order_id = input("id");
        $this->view->assign("order_id",$order_id);
        return $this->view->fetch("view-quoted-info");
    }
}