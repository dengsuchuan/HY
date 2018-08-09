<?php
/**
 * Created by PhpStorm.
 * User: dengs
 * Date: 2018/6/7 0007
 * Time: 23:20
 */

namespace app\index\controller;


use app\index\common\controller\Base;

class Personnel extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    public function adminList(){
        return $this->view->fetch('admin-list');
    }

    public function workerList(){
        return $this->view->fetch('worker-list');
    }

    public function clientList(){
        return $this->view->fetch('client-list');
    }

    public function authorityClass(){
        return $this->view->fetch('authority-class');
    }
}