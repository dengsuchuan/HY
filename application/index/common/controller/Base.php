<?php
namespace app\index\common\controller;

use think\Controller;
use think\Url;

class Base extends Controller
{
//    protected $beforeActionList = [
//        'isLogin',
//        ['isLogin' => ['only'=>'login,data']]
//    ];

//登陆权限
    public function isLogin (){
        if(!session('user')){
            return $this->redirect('index/index/index');
        }
    }
    public function isLeftis(){
        $employee_lv = session('user.employee_lv');
        if($employee_lv != 1){
            return $this->redirect('index/index/index');
        }
    }
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


    //这个函数用来获取最新的编号
    public  function getNewId($str,$model,$field,$mm = 0){//要获取的字符串前部分，实例，表对应的字段名
        //获取数据库中P180706-x的数量实现自动生成编号
        $i = 0;//编号
        $str = $str."-";//可以设置来之数据库的一个自定义字符串
        do{
            ++$i;  //第一次就为1，排除编号0
            if($i < 10){
                $i = '0'.$i;
            }
        }while($model->get(["$field"=>$str.$i])); //如果存在就继续算下去
        $tempArray = $str.$i;//最新的内图
        if($mm){
            return $i;
        }
        return $tempArray;
    }
}
