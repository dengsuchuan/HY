<?php
/**
 * 材料管理
 * User: dengs
 * Date: 2018/6/7 0007
 * Time: 23:20
 */

namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\Material as MaterialModel;
use think\Db;
use think\facade\Request;
class Material extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    //渲染列表
    public function material(){
        //$materialInfo = MaterialModel::order('material_id','desc')->paginate(25);
        $materialInfo = Db::query("SELECT * FROM hy_material ORDER BY CONVERT(material_id USING gbk);");
        $materialInfoCount = count($materialInfo);
        $this->assign([
            'materialInfo'  =>  $materialInfo,
            'materialInfoCount' => $materialInfoCount
        ]);
        return $this->view->fetch('material');
    }

    public function materialAdd(){
        if(Request::isAjax()){
            $data = Request::post();
            $info = MaterialModel::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        return $this->view->fetch('material_add');
    }
    public function materialEdit(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            $info = MaterialModel::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        $materialRow = MaterialModel::get($id);
        $this->assign([
            'materialRow'  =>  $materialRow,
        ]);
        return $this->view->fetch('material_edit');
    }
    //删除
    public function delete(){
        $info = MaterialModel::where(['id'=>intval(input('id'))])->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    //批量删除
    public function delAll()
    {
        $data = input();
        $ids = $data['data'];
        $inf = false;
        foreach ($ids as $id) {
            $info = MaterialModel::where(['id' => $id])->delete();
            if ($info) {
                $inf = true;
            }
        }
        if($inf){
            return json(1);
        }else{
            return json(0);
        }
    }
}