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
use app\index\model\ProductProcess;
use app\index\model\Employee;


class ProductionRecords extends Base
{
    public function index(){
        $task_id = input('task_id');
        $this->view->assign([
            'task_id'=>$task_id
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
}