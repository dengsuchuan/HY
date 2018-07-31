<?php
/**
 * 工序类型控制器
 * User: @ 若雨
 * Date: 2018/7/19
 * Time: 9:25
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\ProcessType as ProcessTypeModel;
use think\facade\Request;
class ProcessType extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    //工序类型列表
    public function index(){
        //获取工序类型的所有信息1
       $ProcessTypeInfo =  ProcessTypeModel::order('sort asc')->select();
       $this->assign([
          'ProcessTypeInfo'     =>  $ProcessTypeInfo
       ]);
       return $this->view->fetch('process_type_info');
    }
    //添加操作
    public function addProcessType(){
        if(Request::isAjax()){
            $data = Request::post();
            $info = ProcessTypeModel::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        return $this->view->fetch('process_type_add');
    }
    //修改操作
    public function editProcessType(){
        if(Request::isAjax()){
            $id = Request::post('id');
            $process_name = Request::post('process_name');
            $process_price = Request::post('process_price');
            $info = ProcessTypeModel::update(['process_name'=>$process_name,'process_price'=>$process_price],['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        $ProcessTypeRow = ProcessTypeModel::get($id);
        $this->assign([
            'ProcessTypeRow'    =>  $ProcessTypeRow
        ]);
        return $this->view->fetch('process_type_edit');
    }
    //删除
    public function delete(){
        $info = ProcessTypeModel::where(['id'=>intval(input('id'))])->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    //排序操作
    public function updateSort(){
        $id = intval(input('id'));
        $sort = intval(input('sort'));
        $info = ProcessTypeModel::update(['sort'=>$sort],['id'=>$id]);
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
}