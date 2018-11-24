<?php
/**
 * Created by PhpStorm.
 * User: dengs
 * Date: 2018/10/15 0015
 * Time: 8:51
 */

namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\QuoteModel;
use app\index\model\Client as ClientModel;
use think\facade\Request;


class Quote extends Base
{

    public function viewshow(){
        $action = input("action");
        if($action == 0){
            $quote = QuoteModel::order('create_time', 'asc')
                ->where(["determine"=>0])
                ->paginate(25);
            $action = 1;
        }else{
            $quote = QuoteModel::order('create_time', 'asc')
                ->where(["determine"=>1])
                ->paginate(25);
            $action = 0;
        }

        $quoteCount = $quote->total();

        $this->view->assign(compact("quote","quoteCount","action"));
        return $this->view->fetch();
    }

    public function addquote(){
        $client = ClientModel::all();
        $model = new QuoteModel();
        $quoteId = $this->getNewId("QT".date('y').date('m').date('d'),$model,'quoteId');
        $this->view->assign(compact("client","quoteId"));
        return $this->view->fetch("add-quote");
    }

    public function savequote(){
        if(Request::isAjax()){
            $data = Request::post();
            $info = QuoteModel::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    public function edit(){
        $client = ClientModel::all();
        $id = input("id");
        $quote = QuoteModel::where(['id'=>$id])->select();
        $this->view->assign(compact("client","quote"));
        return $this->view->fetch("edit-quote");
    }

    public function delete(){
        if(Request::isAjax()){
            $id = Request::post('id');
            $info = QuoteModel::where(['id'=>$id])->delete();
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    public function update(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            $info = ProductLog::where('id',$id)->update($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

}
























