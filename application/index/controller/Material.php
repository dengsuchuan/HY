<?php
/**
 * Created by PhpStorm.
 * User: dengs
 * Date: 2018/6/7 0007
 * Time: 23:20
 */

namespace app\index\controller;


use app\index\common\controller\Base;

class Material extends Base
{
    public function material(){
        return $this->view->fetch('material');
    }
}