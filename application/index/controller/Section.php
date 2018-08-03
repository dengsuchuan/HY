<?php
/**
 * 材料截面
 * User: dengs
 * Date: 2018/6/7 0007
 * Time: 23:20
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\Section as SectionModel;
use think\facade\Request;
class Section extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    //渲染列表
    public function section(){
        $sectionInfo = SectionModel::paginate(10);
        $this->assign([
            'sectionInfo'  =>  $sectionInfo,
        ]);
        return $this->view->fetch('section');
    }
    public function sectionAdd(){
        if(Request::isAjax()){
            $data = Request::post();
            $info = SectionModel::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        return $this->view->fetch('section_add');
    }
    public function sectionEdit(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            $info = SectionModel::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        $sectionRow = SectionModel::get($id);
        $this->assign([
            'sectionRow'  =>  $sectionRow,
        ]);
        return $this->view->fetch('section_edit');
    }
    //删除
    public function delete(){
        $info = SectionModel::where(['id'=>intval(input('id'))])->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }

}