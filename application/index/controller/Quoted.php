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
    public function quotedInfo(){
        return $this->view->fetch("view-quoted-info");
    }


}