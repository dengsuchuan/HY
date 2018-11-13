<?php
/**
 * 员工控制器
 * User: @ 若雨
 * Date: 2018/7/30
 * Time: 19:28
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\QualityModel;
use app\index\model\TestRecordModel;
use think\facade\Request;

class TestRecord extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];

    //显示出检测记录
    public function viewIndex(){
        $id = input("task_id");
        $testRecord = TestRecordModel::where(['log_id'=>$id])->select();
        $testRecordCount = count($testRecord);
        $this->view->assign(compact("id","testRecord","testRecordCount"));
        return $this->view->fetch();
    }

    //添加界面
    public function addShow(){
        $id = input("id");
        $TestRecord = new TestRecordModel();
        $check_id = $this->getNewId($id,$TestRecord,"check_id");
        $this->view->assign(compact("id","check_id"));
        return $this->view->fetch();
    }
    //保存添加的记录
    public function addSave(){
        if(Request::isAjax()){
            $data = Request::post();
            $info = TestRecordModel::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    //编辑界面
    public function editShow(){
        $id = input("id");
        $testRecord = TestRecordModel::where(['id'=>$id])->select();
        $this->view->assign(compact("testRecord"));
        return $this->view->fetch();
    }
    //保存修改的记录
    public function editSave(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            $info = TestRecordModel::where('id',$id)->update($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }
    //删除记录
    public function delete(){
        $id = input('id');
        $info =  TestRecordModel::where('id',$id)->delete();
        if($info){
            return 1;
        }else{
            return 0;
        }
    }
    //---------------------------华丽丽的分割线-------------------------
    //显示质量界面
    public function qualityShow(){
        $id = input("task_id");
        $ifQuality = QualityModel::where(['log_id'=>$id])->find();
        if(!$ifQuality){
            QualityModel::create(['log_id'=>$id]);
        }
        $quality = QualityModel::where(['log_id'=>$id])->select();

        $this->view->assign(compact("quality"));
        return $this->view->fetch();
    }
    //保存质量修改
    public function qualitySave(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            $info = QualityModel::where(['id'=>$id])->update($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    //保存质量修改
    public function qualityDel(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = $data['id'];
            $info = QualityModel::where(['id'=>$id])->delete();
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }


}