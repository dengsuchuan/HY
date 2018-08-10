<?php
namespace app\index\controller;

use app\index\common\controller\Base;


class Storehouse extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    public function delivery(){
        return $this->view->fetch('delivery');
    }

    public function purchase(){
        return $this->view->fetch('purchase');
    }
}