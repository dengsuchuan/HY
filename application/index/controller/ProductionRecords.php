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


class ProductionRecords extends Base
{

    public function index(){
        $task_id = input('task_id');
        $productLog = ProductLog::order('create_time', 'asc')->paginate(25);
        $productLogCount = $productLog->total();
        $this->view->assign([
            'task_id'=>$task_id,
            'productLog'=>$productLog,
            'productLogCount'=>$productLogCount
        ]);
        return $this->view->fetch();
    }

    public function addLog(){
        $task_id = input('task_id');
        $model = new ProductionRecordsModel();//实例
        $log_id = $this->getNewId("PL-".date('Ymd'),$model,'log_id');
        $eqpmt = EquipmentInfo::all();
        $process = ProductProcess::all();
        $employee = Employee::all();
        $this->view->assign([
            'task_id'=>$task_id,
            'log_id'=>$log_id,
            'eqpmt'=>$eqpmt,
            'process'=>$process,
            'employee'=>$employee,
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
}
























