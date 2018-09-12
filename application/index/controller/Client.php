<?php
/**
 * 员工控制器
 * User: @ 若雨
 * Date: 2018/7/30
 * Time: 19:28
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\Client as ClientModel;
use think\facade\Request;

class Client extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    //渲染列表
    public function clientInfo(){
        $clientInfo  = ClientModel::order('create_time', 'desc')->paginate('100');
        $clientInfoCount = $clientInfo->total();
        $this->assign(['clientInfo' =>   $clientInfo]);
        $this->assign(['clientInfoCount' => $clientInfoCount]);
        return $this->view->fetch('client-info');
    }
    public function clientAdd(){
        if(Request::isAjax()){
            $data = Request::post();
            $info = ClientModel::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        return $this->view->fetch('client-add');
    }

    public function clientEdit(){
        if(Request::isAjax()) {
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);

            $info = ClientModel::update($data,['id'=>$id]);
            if ($info){
                return json(1);
            }else{
                return json(0);
            }
        }

        $id = intval(input('id'));
        $clientRow = ClientModel::get($id);
        $this->assign('clientRow',$clientRow);
        return $this->view->fetch('client-edit');

    }

    public function delete(){
        $id = intval(input('id'));
        $info =  ClientModel::where('id',$id)->delete();
        if($info){
            return 1;
        }else{
            return 0;
        }
    }

}