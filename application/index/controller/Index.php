<?php
namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\logs;
use think\Db;
use think\Request;

class Index extends Base
{
    public function index(){
        return $this->fetch();
    }

    public function welcome(){
        return $this->view->fetch('welcome');
    }
    public function DelAll(Request $request)  //用于删除
    {
        $Ary = $request->post();
        //总条数
        $count = count($Ary['data']);
        $sum = 0;
        $model = new logs();
        for($i=0;$i<$count;$i++)
        {
            if(!Db::table($Ary['table'])->where(["Id"=>$Ary['data'][$i]])->delete())
            {
                continue;//失败不统计
            }
            //计数
            $sum++;
            //写入日志
        }
        if($sum>0) {   //产生有效事件再记录日志
            $model->save([
                "date" => time(),
                "msg" => "删除" . $Ary['table'] . "表中记录" . $sum . "条"
            ]);
        }
        echo json_encode($data=[
            "state"=>200,
            "message"=>"选中".$count."条记录,共".$sum."条删除成功"
        ]);
        return;
    }
}
