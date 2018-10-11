<?php
/**
 * 账户类型
 * User: @ 若雨
 * Date: 2018/8/7
 * Time: 21:26
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use catetree\Catetree;
use app\index\model\AccountType as AccountTypeModel;
use think\facade\Request;
class AccountType extends Base
{

    protected $beforeActionList = [
        'isLogin',
    ];
    public function Info(){
        $costInfo = AccountTypeModel::getCostInfo();
        $this->assign([
            'costInfo' =>  $costInfo
        ]);
        return $this->fetch('cost-info');
    }
    public function costAdd(){
        if(Request::isAjax()){
            $data = Request::post();
            $info = AccountTypeModel::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $costInfo = AccountTypeModel::getCostInfo();
        $this->assign([
            'costInfo' =>  $costInfo
        ]);
        return $this->fetch('cost-add');
    }
    //删除操作
    public function delete(){
        $id = intval(Request::post('id'));
        $obj = db('account_type');
        $cateTtee = new Catetree();
        $sonids = $cateTtee->childrenids($id,$obj);
        $sonids[] = $id;
        if($obj->delete($sonids)){
            return json(1);
        }else{
            return json(0);
        }
    }
    //修改
    public function costEdit($id){
        if(Request::post()){
            $id = intval($id);
            $data = Request::post();
            $info = AccountTypeModel::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval($id);
        $costRow = AccountTypeModel::get($id);
        $costInfo = AccountTypeModel::where('id','<>',$id)->select();
        $cate = new Catetree();
        $costInfo = $cate->catetree($costInfo);
        $this->assign([
            'costInfo' =>  $costInfo,
            'costRow'  =>  $costRow
        ]);
        return $this->fetch('cost-edit');
    }
}