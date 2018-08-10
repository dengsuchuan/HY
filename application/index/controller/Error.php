<?php
/**
 * Created by PhpStorm.
 * User: @ 若雨
 * Date: 2018/8/1
 * Time: 10:45
 */

namespace app\index\controller;


use think\Controller;

class Error extends Controller
{
    public function _empty(){
        return $this->redirect('index/index/index');
    }
}
