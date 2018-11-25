<?php
/**
 * 订单报价明细
 * User: dengsuchuan
 * Date: 18-9-6
 * Time: 下午4:48
 */
namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\QuotedMode;

class Quoted extends  Base{
    public function viewshow(){
        $quoteId = input("quoteId");
        //获取所有的报价明细
        $quoted = QuotedMode::order('create_time', 'asc')
                ->paginate(25);
        $quotedCount = $quoted->total();


        $this->view->assign(compact("quoted","quotedCount","quoteId"));
        return $this->view->fetch();
    }

    public function addquoted(){
        //获取明细编号
        $quoteId = input("quoteId");
        $model = new QuotedMode();
        $quote_info_id = $this->getNewId($quoteId,$model,'quote_info_id');
        //

        $this->view->assign(compact("quote_info_id"));
        return $this->view->fetch("add-quoted");
    }
}