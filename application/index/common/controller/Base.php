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
    //传入又id和sort组成的输出$data。$model 为模型实例
    public function Sort($data,$model){
        //获取当然id的数据
        $Info = $model->where("id", "=", $data['id'])->field('id,sort')->find();
        $infoSort = $Info['sort'];
        if($data['sort'] == 'asc'){  //如果是上
            //获取上一条数据
            $ascInfo = $model->where("sort", "<", $infoSort)->field('id,sort')->order("sort", "desc")->find();
            if($ascInfo == null){ //如果没有数据 则是第一条数据
                return json([
                    'error' => 1000,
                    'msg'   =>  '已经是第一条数据'
                ]);
            }
            $ysort= $Info['sort'];
            $xsort = $ascInfo['sort'];
            //交换排序
            $info = $model->update(['sort'=>$ysort],['id'=> $ascInfo['id']]);
            $info1 = $model->update(['sort'=>$xsort],['id'=> $Info['id']]);
            if($info && $info1){
                return json([
                    'error' => 1,
                ]);
            }else{
                return json([
                    'error' => 0,
                    'msg'   =>  '排序失败'
                ]);
            }
        }else if($data['sort'] == 'desc'){
            $ascInfo = $model->where("sort", ">", $infoSort)->field('id,sort')->order("sort", "asc")->find();
            //如果是第一条数据
            if($ascInfo == null){
                return json([
                    'error' => 1000,
                    'msg'   =>  '已经是最后一条数据'
                ]);
            }
            $ysort= $Info['sort'];
            $xsort = $ascInfo['sort'];
            //交换排序
            $info = $model->update(['sort'=>$ysort],['id'=> $ascInfo['id']]);
            $info1 = $model->update(['sort'=>$xsort],['id'=> $Info['id']]);
            if($info && $info1){
                return json([
                    'error' => 1,
                ]);
            }else{
                return json([
                    'error' => 0,
                    'msg'   =>  '排序失败'
                ]);
            }
        }
    }
}