<?php
/**
 * 工装类型
 * User: @ 若雨
 * Date: 2018/7/27
 * Time: 11:21
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\LloolingType as LloolingTypeModel ;
use think\facade\Request;
class LoolingType extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    //例表显示
    public function loolingInfo(){
        $looinfInfo = LloolingTypeModel::order('sort asc')->select();
        $this->assign([
            'looinfInfo'    =>  $looinfInfo,
        ]);
        return $this->view->fetch('looging_info');
    }
    public function looingAdd(){
        if(Request::isAjax()){
            $info = LloolingTypeModel::create(['looling_type_name'=>Request::post('looling_type_name')]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        return $this->view->fetch('looling_add');
    }

    //修改操作
    public function looingEdit(){
        if(Request::isAjax()){
            $id = Request::post('id');
            $looling_type_name= Request::post('looling_type_name');
            $info = LloolingTypeModel::update(['looling_type_name'=>$looling_type_name],['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        $looingTypeRow = LloolingTypeModel::get($id);
        $this->assign([
            'looingTypeRow'    =>  $looingTypeRow
        ]);
        return $this->view->fetch('looling_edit');
    }

    //排序操作
    public function updateSort(){
        $id = intval(input('id'));
        $sort = intval(input('sort'));
        $info = LloolingTypeModel::update(['sort'=>$sort],['id'=>$id]);
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    //删除
    public function delete(){
        $info = LloolingTypeModel::where(['id'=>intval(input('id'))])->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
}