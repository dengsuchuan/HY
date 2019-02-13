<?php
/**
 * Created by PhpStorm.
 * User: VcLin
 * Date: 2019/1/28
 * Time: 14:52
 */

namespace app\index\controller;


use app\index\common\controller\Base;

class WorkingHours extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}