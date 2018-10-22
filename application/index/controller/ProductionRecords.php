<?php
/**
 * Created by PhpStorm.
 * User: dengs
 * Date: 2018/10/15 0015
 * Time: 8:51
 */

namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\EquipmentInfo;
use app\index\model\ProductionRecordsModel;
use app\index\model\ProductLog;
use app\index\model\ProductProcess;
use app\index\model\Employee;
use think\facade\Request;
use app\index\model\ProductTask;


class ProductionRecords extends Base
{

    public function index(){
        $task_id = input('task_id');
        $drawing = input('drawing');
        $productLog = ProductLog::order('create_time', 'asc')->paginate(25);
        $productLogCount = $productLog->total();
        $this->view->assign([
            'task_id'=>$task_id,
            'productLog'=>$productLog,
            'productLogCount'=>$productLogCount,
            'drawing'=>$drawing,
        ]);
        return $this->view->fetch();
    }

    public function addLog(){
        //$taskCount = count(ProductTask::where(['if_completr'=>1])->select());
        $task_id = input('task_id');
        $drawing = input('drawing');
        $model = new ProductionRecordsModel();//实例
        $log_id = $this->getNewId("PL-".date('Ymd'),$model,'log_id');
        $eqpmt = EquipmentInfo::all();
        //$process = ProductProcess::where('drawing_detial_id',$drawing)->select();
        //$employee = Employee::all();
        $this->view->assign([
            'task_id'=>$task_id,
            'log_id'=>$log_id,
            'eqpmt'=>$eqpmt,
            //'employee'=>$employee,
            //'taskCount'=>$taskCount,
            'drawing'=>$drawing,
        ]);
        return $this->view->fetch();
    }

    public function saveLog(){
        if(Request::isAjax()){
            $data=Request::post();
            //hy_product_log
            $info = ProductLog::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    public function sign(){
        if(Request::isAjax()){
            $data = Request::post();
            $log_id = $data['where'];
            $nameKey = $data['nameKey'];
            $dateKey = $data['dateKey'];
            $username = session('user.user_name');
            $date = date('Y-m-d');
            $array=[
                "$nameKey"=>$username,
                "$dateKey"=>$date
            ];
            if(ProductLog::where("log_id",$log_id)->update($array)){
                return json(1);
            }else{
                return json(0);
            }
        }
    }
    public function signDown(){
        if(Request::isAjax()){
            $data = Request::post();
            $log_id = $data['where'];
            $nameKey = $data['nameKey'];
            $dateKey = $data['dateKey'];
            $username = "";
            $date = "";
            $array=[
                "$nameKey"=>$username,
                "$dateKey"=>$date
            ];
            if(ProductLog::where("log_id",$log_id)->update($array)){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    public function showProcess(){
        $drawing = input('drawing');
        $process = ProductProcess::where('drawing_detial_id',$drawing)->select();
        $this->assign("process",$process);
        return $this->view->fetch('view_process');
    }

    public function delete(){
        if(Request::isAjax()){
            $data = Request::post('id');
            $info = ProductLog::where(['log_id'=>$data])->delete();
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    public function edit(){
        $id = input('id');
        $productLog = ProductLog::where(['log_id'=>$id])->select();
        //基本输出
        //$taskCount = count(ProductTask::where(['if_completr'=>1])->select());
        $task_id = input('task_id');
        $drawing = input('drawing');
        $model = new ProductionRecordsModel();//实例
        $log_id = $this->getNewId("PL-".date('Ymd'),$model,'log_id');
        $eqpmt = EquipmentInfo::all();
        //$process = ProductProcess::where('drawing_detial_id',$drawing)->select();
        //$employee = Employee::all();
        $this->view->assign([
            'productLog'=>$productLog,
            'task_id'=>$task_id,
            'log_id'=>$log_id,
            'eqpmt'=>$eqpmt,
            //'employee'=>$employee,
            //'taskCount'=>$taskCount,
            'drawing'=>$drawing,
        ]);


        $this->assign(compact('productLog'));
        return $this->fetch('edit_view');
    }

    public function saveEdit(){
        if(Request::isAjax()){
            $data = Request::post();
            $log_id = $data['log_id'];
            unset($data['log_id']);
            $info = ProductLog::where('log_id',$log_id)->update($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    public function getCount(){
        if(Request::isAjax()){
            $data = Request::post();
            $process_id = $data['process_id'];
            $task_id = $data['task_id'];
            $ProductLogCount = count(ProductLog::where(['process_id'=>$process_id])->select());
            $task_qty = ProductTask::where(['task_id'=>$task_id])->value("task_qty");
            $array = ["ProductLogCount"=>$ProductLogCount,"task_qty"=>$task_qty];
            return $array;
        }
    }

}
























