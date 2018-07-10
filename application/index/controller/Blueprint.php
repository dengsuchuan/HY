<?php
namespace app\index\controller;

use app\index\model\BlueprintInfo;
use app\index\common\controller\Base;
use app\index\model\BlueprintOutside;
use think\facade\Request;

class Blueprint extends Base
{
    //--|图纸明细控制器以及相关子控制器
    public function blueprintInfo(){
        $blueprintInfo = BlueprintInfo::order('create_time', 'desc')->paginate(25);
        $blueprintInfoCount = $blueprintInfo->total();
        $this->assign('blueprintInfo', $blueprintInfo);
        $this->assign('blueprintInfoCount', $blueprintInfoCount);
        return $this->view->fetch('blueprint-info');
    }
    //--|--|明细具体项目详情
    public function blueprintInfos()
    {
        $id = input('id');
        //如果是POST请求的话就代表是执行修改操作
        if (Request::isAjax()) {
            //获取提交过来的所有数据
            $data = Request::post();
            //前台的开关按钮  如果开启 则是1  关闭的话为0
            $data['if_batch'] = isset($data['if_batch']) ? '1' : '0';
            $data['if_thickness'] = isset($data['if_thickness']) ? '1' : '0';
            $data['if_length'] = isset($data['if_length']) ? '1' : '0';
            $data['if_width'] = isset($data['if_width']) ? '1' : '0';
            //获取提交过来的ID
            $id = $data['id'];
            unset($data['id']);
            //执行更新操作  使用的模型更新  成功失败都会返回为当前模型的所以数据
            $res = BlueprintInfo::update($data, ['id' => $id]);
            if ($res) {
                return json(1);

            } else {

                return json(0);
            }
        }
        $blueprintInfo = BlueprintInfo::where('drawing_detail_id',$id)->find();
        $this->assign('blueprintInfo',$blueprintInfo);
        return $this->view->fetch('blueprint-infos');
    }
    //--|--|工艺管理详情
    public function process(){
        return $this->view->fetch('process');
    }
    //--|--|工艺管理里面的工序详情
    public function sequence(){
        return $this->view->fetch('sequence');

    }


    //--|外图控制器以及子控制器
    public function blueprintOutside(){
        $blueprintOutside = BlueprintOutside::order('create_time','desc')->paginate(25);
        $blueprintOutsideCount = $blueprintOutside->total();
        $this->assign('blueprintOutside',$blueprintOutside);
        $this->assign('blueprintOutsideCount',$blueprintOutsideCount);
        return $this->view->fetch('blueprint-outside');

    }
    //--|--|添加外图视图生成器
    public function addDrawingExterna(){
        //获取数据库中W180706-x的数量实现自动生成编号
        $model = new BlueprintOutside();//可实例化，也可不实例化
        $i = 0;//编号
        $str = "W180706-";//可以设置来之数据库的一个自定义字符串
        do{
            ++$i;  //第一次就为1，排除编号0
        }while($model->get(["drawing_external_id"=>$str.$i])); //如果存在就继续算下去
        $this->assign("createId",$str.$i);
        return $this->view->fetch("add-drawing-externa");
    }

    public function addDrawingExternalId(){//传入编号和备注
        if(Request::isAjax()){
            //获取提交过来的所有数据
            $data = Request::post();
            $res = BlueprintOutside::create($data);
            if($res){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    //--|--|添加图纸明细控制器
    public function addDrawingDetial(){
        return $this->view->fetch('add-drawing-detial');
    }


    public function blueprintInterior(){

        return $this->view->fetch('blueprint-interior');
    }




}