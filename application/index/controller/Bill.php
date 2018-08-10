<?php
namespace app\index\controller;



use app\index\common\controller\Base;

class Bill extends Base
{
    public function customerBill(){
        return $this->view->fetch('customer-bill');
    }

    public function readyMoneyBill(){
        return $this->view->fetch('ready-money-bill');
    }

    public function companyBill(){
        return $this->view->fetch('company-bill');
    }


}