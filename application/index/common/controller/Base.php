<?php
namespace app\index\common\controller;

use think\Controller;
class Base extends Controller
{
    //排序
    public function _updateSort($data){
        $id = intval($data['id']);
        $sort = intval($data['listorder']);
        $rew = db($data['table'])->where(['id'=>$id])->update([$data['value']=>$sort]);
        if($rew){
            return(1);
        }else{
            return(0);
        }
    }
}