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
use app\index\model\Client;
use think\facade\Request;
use app\index\model\ProductTask;


class ProductionRecords extends Base
{

    public function index(){
        $task_id = input('task_id');
        $drawing = input('drawing');
        $productLog = ProductLog::order('create_time', 'asc')
            ->where(["task_id"=>$task_id])
            ->paginate(25);
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
        $task_id = input('task_id');
        $drawing = input('drawing');
        $model = new ProductionRecordsModel();//实例
        $log_id = $this->getNewId("PL-".date('Ymd'),$model,'log_id');
        $eqpmt = EquipmentInfo::where(['is_working'=>1])->select();
        $client = Client::all();
        $this->view->assign([
            'task_id'=>$task_id,
            'log_id'=>$log_id,
            'eqpmt'=>$eqpmt,
            'client'=>$client,
            'drawing'=>$drawing,
        ]);
        return $this->view->fetch();
    }

    public function edit(){
        $id = input('id');
        $productLog = ProductLog::where(['log_id'=>$id])->select();
        //基本输出
        $task_id = input('task_id');
        $drawing = input('drawing');
        $model = new ProductionRecordsModel();//实例
        $log_id = $this->getNewId("PL-".date('Ymd'),$model,'log_id');
        $eqpmt = EquipmentInfo::where(['is_working'=>1])->select();
        $client = Client::all();
        $this->view->assign([
            'productLog'=>$productLog,
            'task_id'=>$task_id,
            'log_id'=>$log_id,
            'eqpmt'=>$eqpmt,
            'client'=>$client,
            'drawing'=>$drawing,
        ]);
        $this->assign(compact('productLog'));
        return $this->fetch('edit_view');
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
            $productLogArray = ProductLog::where(['process_id'=>$process_id,'task_id'=>$task_id])->select();
            $logSum = 0;
            foreach ($productLogArray as $value){
                $logSum += $value['product_qty'];
            }
            $task_qty = ProductTask::where(['task_id'=>$task_id])->value("task_qty");

            $array = ["ProductLogCount"=>$logSum,"task_qty"=>$task_qty];
            return $array;
        }
    }

    public function toExmine(){
        $thismonth = date('m');
        $thisyear = date('Y');
        $startDay = $thisyear . '-' . $thismonth . '-1';
        $endDay = $thisyear . '-' . $thismonth . '-' . date('t', strtotime($startDay));
        $b_time = strtotime($startDay);//当前月的月初时间戳
        $e_time = strtotime($endDay);//当前月的月末时间戳
        $thismonth = date('m');
        $thisyear = date('Y');
        if ($thismonth == 1) {
            $lastmonth = 12;
            $lastyear = $thisyear - 1;
        } else {$lastmonth = $thismonth - 1;
        $lastyear = $thisyear;
        }
        $lastStartDay = $lastyear . '-' . $lastmonth . '-1';
        $lastEndDay = $lastyear . '-' . $lastmonth . '-' . date('t', strtotime($lastStartDay));
        $s_time = strtotime($lastStartDay);//上个月的月初时间戳
//        $e_time = strtotime($lastEndDay);//上个月的月末时间戳

        $task_id = input('task_id');
        $drawing = input('drawing');
        $tag = input('tag');
        if ($tag == 0){
            $if_audit = '未审';
        }else{
            $if_audit = '已审';
        }
        $productLog = ProductLog::where(['if_audit'=>$if_audit])->whereTime('create_time', 'between',[$s_time,$e_time])->order('hr_id', 'asc')->order('log_id','asc')->paginate(25);
        $productLogCount = $productLog->total();
        $this->view->assign([
            'task_id'=>$task_id,
            'productLog'=>$productLog,
            'productLogCount'=>$productLogCount,
            'drawing'=>$drawing,
            'tag'    => $tag
        ]);
        return $this->fetch();
    }
    function shenhe(){
        if(Request::isAjax()) {
            $data = Request::post();
            $info = ProductLog::where(['log_id'=>$data['id']])->update(['if_audit'=>'已审']);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
    }
    function xuxiao(){
        $data = Request::post();
        $info = ProductLog::where(['log_id'=>$data['id']])->update(['if_audit'=>'未审']);
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    function quxiaoAll(){
        $data = Request::post();
        $ids = $data['data'];
        $info = ProductLog::where('log_id','in',$ids)->update(['if_audit'=>'未审']);
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    function sheheAll(){
        $data = Request::post();
        $ids = $data['data'];
        $info = ProductLog::where('log_id','in',$ids)->update(['if_audit'=>'已审']);
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
}
























