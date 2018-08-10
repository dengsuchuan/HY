<?php
/**
 * 超级管理员
 * User: @ 若雨
 * Date: 2018/7/31
 * Time: 10:55
 */


namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\Administrators as AdministratorsModel;
use think\facade\Request;
class Administrators extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];

    //渲染列表
    public function adminInfo(){
        $adminInfo =  AdministratorsModel::select();
        $this->assign([
            'adminInfo'     =>  $adminInfo
        ]);
        return $this->view->fetch('admin-info');
    }
    public function adminAdd(){
        if(Request::isAjax()){
            $data['admin_code'] = Request::post('admin_code');
            $data['admin_name'] = Request::post('admin_name');
            $data['password'] = Request::post('password');
            $data['tie'] = Request::post('tie');
            $data['mailbox'] = Request::post('mailbox');
            $data['mailbox'] = Request::post('mailbox');
            $info = AdministratorsModel::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        //生成管理员编号
        $codeInfo = AdministratorsModel::order('admin_code desc')->value('admin_code');
        $code = intval(trim(strrchr($codeInfo, '-'),'-'));
        $adminCode = $code<10? 'A-'.'0'.++$code : 'A-'.++$code;
        $this->assign([
            'adminCode'     =>  $adminCode
        ]);
        return $this->view->fetch('admin-add');
    }
    //修改操作
    public function adminEdit(){
        if(Request::isAjax()){
            $id = Request::post('id');
            $data['admin_code'] = Request::post('admin_code');
            $data['admin_name'] = Request::post('admin_name');
            $data['password'] = Request::post('password');
            $data['tie'] = Request::post('tie');
            $data['mailbox'] = Request::post('mailbox');
            $data['mailbox'] = Request::post('mailbox');
            $info = AdministratorsModel::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        $adminRow = AdministratorsModel::get($id);
        $this->assign([
            'adminRow'    =>  $adminRow
        ]);
        return $this->view->fetch('admin-edit');
    }
    //删除
    public function delete(){
        $info = AdministratorsModel::where(['id'=>intval(input('id'))])->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
}