<?php
namespace app\index\controller;
use app\index\model\BlueprintInfo;
use app\index\common\controller\Base;
use app\index\model\BlueprintOutside;
use app\index\model\Material;
use app\index\model\ProductProcess;
use think\facade\Request;

class Blueprint extends Base
{
    //--|图纸明细控制器以及相关子控制器
    public function blueprintInfo(){
        //判断是否为post提交请求。如果是，就代表是搜索。
        $blueprintKeyInfo = BlueprintInfo::order('create_time', 'desc')->select();
        if(Request::isPost()){
            $data = Request::post();
            $blueprintInfo = BlueprintInfo::order('create_time', 'desc')
                ->where(['drawing_detail_id'=>$data['modules']])
                ->whereOr(['drawing_internal_id'=>$data['modules']])
                ->whereOr(['drawing_externa_id'=>$data['modules']])
                ->paginate(5);
            $blueprintInfoCount = $blueprintInfo->total();
            $this->assign('blueprintInfo', $blueprintInfo);
            $this->assign('blueprintInfoCount', $blueprintInfoCount);
            $this->assign('blueprintKeyInfo', $blueprintKeyInfo);
            return $this->view->fetch('blueprint-info');
        }
        $blueprintInfo = BlueprintInfo::order('create_time', 'desc')->paginate(25);
        $blueprintInfoCount = $blueprintInfo->total();
        $this->assign('blueprintInfo', $blueprintInfo);
        $this->assign('blueprintInfoCount', $blueprintInfoCount);
        $this->assign('blueprintKeyInfo', $blueprintKeyInfo);
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
        $drawing_detail_id = input('drawing_detail_id');  //获取图纸明细编号
        //获取工艺/工序信息
        $processInfo = ProductProcess::where(['drawing_detial_id'=>$drawing_detail_id])->order('sort','asc')->paginate(10);
        $count = count($processInfo);
        $this->assign([
           'processInfo'           =>  $processInfo,
            'drawing_detail_id'    =>  $drawing_detail_id,
            'count'                =>  $count
        ]);
        return $this->view->fetch('process');
    }

    //--|--|添加工艺
    public function addProcess(){
        $drawing_detail_id = input('id');  //获取图纸明细编号
        $drawing_detail_ids = input('id');  //获取图纸明细编号
        $processInfo = ProductProcess::where(['drawing_detial_id'=>$drawing_detail_id])->field('sort')->order('sort','desc')->select();
        //统计工艺条数
        $count = count($processInfo);
        //如果是ajax提交则代表为入库操作
        if(Request::isAjax()){
            $data = Request::post();
            $drawing_detial_id = $data['drawing_detial_id'];
            $processInfo = ProductProcess::where(['drawing_detial_id'=>$drawing_detial_id])->field('sort')->order('sort','desc')->select();
            //统计工艺条数 判断是否有值
            $count = count($processInfo);
            $data['if_check'] = isset($data['if_check']) ? '1' : '0';
            if($count == 0){
                $data['sort'] = 1;
            }else{
                $sort = $processInfo[0]['sort'];
                $data['sort'] = ++$sort;
            }
            $info = ProductProcess::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        //获取当前图纸明细的工艺记录
        //生成工艺编号
        if($count == 0){
            $drawing_detail_id.= '-P01';
        }else{
            $code = $processInfo[0]['sort'];
            ++$code;
            $drawing_detail_id = $code<10 ? $drawing_detail_id .= '-P0'.$code:$drawing_detail_id .= '-P'.$code;
        }
        $this->assign([
            'drawing_detail_id'    =>  $drawing_detail_id,
            'drawing_detail_ids'   =>  $drawing_detail_ids,
        ]);
        return $this->view->fetch('add-process');
    }
    //工序详情页面
    public function editProcess(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            $data['if_check'] = isset($data['if_check']) ? '1' : '0';
            $info = ProductProcess::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        $processRow = ProductProcess::get($id);
        $this->assign([
           'processRow'    =>  $processRow,
        ]);
        return $this->view->fetch('process-edit');
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
        $str = "W".date('y').date('m').date('d')."-";//可以设置来之数据库的一个自定义字符串
        do{
            ++$i;  //第一次就为1，排除编号0
        }while($model->get(["drawing_external_id"=>$str.$i])); //如果存在就继续算下去

        $this->assign("createId",$str.$i);
        return $this->view->fetch("add-drawing-externa");
    }

    //获取M和P的值
    public function getMP(){
        if(Request::isAjax()){
            $data = Request::post("action");
            if($data == "M"){
                return "M";
            }else{
                return "P";
            }
        }


//获取数据库中M和P的数量实现自动生公司编号
//        $model = new BlueprintOutside();//可实例化，也可不实例化
//        $i = 0;//编号
//        $str = "W".date('y').date('m').date('d')."-";//可以设置来之数据库的一个自定义字符串
//        do{
//            ++$i;  //第一次就为1，排除编号0
//        }while($model->get(["drawing_external_id"=>$str.$i])); //如果存在就继续算下去
    }

    public function addDrawingExternalId(){//传入编号和备注
        if(Request::isAjax()){
            //获取提交过来的所有数据
            $data = Request::post();

            //抛出异常  并  进行处理
            try {
                $res = BlueprintOutside::create($data);
            } catch (\Exception $e) {
                $res = 0;
            }

            if($res){
                return json(1);
            }else{
                return json(0);
            }
        }
    }
    //--|--|添加图纸明细控制器
    public function addDrawingDetial($id){//从视图传来

        $detailArray[] =[];
        /*------------------------------------------*/
        //获取数据库中$id的数量实现自动生成图纸明细编号
        $model = new BlueprintInfo();//可实例化，也可不实例化
        $i = 0;//编号
        $str = $id."-";//可以设置来之数据库的一个自定义字符串
        do{
            ++$i;  //第一次就为1，排除编号0
        }while($model->get(["drawing_detail_id"=>$str.$i])); //如果存在就继续算下去
        /*------------------------------------------*/

        $material = Material::all();//获取所有材料

        $detailArray = [
            'drawing_detail_id'=>$str.$i,//这个是图纸明细的编号，每次自动递增
            'drawing_external_id'=>$id,//外图编号
            'material'=>$material//获取所有材料
        ];

        $this->assign("detailArray",$detailArray);

        return $this->view->fetch('add-drawing-detial');
    }

    public function blueprintInterior(){
        return $this->view->fetch('blueprint-interior');
    }

    //工序排序
    public function updateSort(){
        if(Request::isAjax()){
            $data = Request::post();
            $id = intval($data['id']);
            $sort = intval($data['listorder']);
            $code = ProductProcess::where(['id'=>$id])->field('process_id')->find();
            $process_id = substr($code['process_id'],0,strpos($code['process_id'], '-'));
            $process_id = $sort<10 ? $process_id .= '-P0'.$sort:$process_id .= '-P'.$sort;
            $rew = db($data['table'])->where(['id'=>$id])->update([$data['value']=>$sort,'process_id'=>$process_id]);
            if($rew){
                return(1);
            }else{
                return(0);
            }
        }
    }
    /**
     * 工序一键排序
     * 1、获取对应图纸的所有工序。升序排序。
     * 2、然后获取总条数，
     * 3、然后1到总条数循环修改排序字段，
     * 4、最后 修改工序编号
     * */
    public function onekeySort(){
        $id = input('id');
        $processList = ProductProcess::where(['drawing_detial_id'=>$id])->field('id,sort')->order('sort','asc')->select();
        $top = 1;  //定义循环开始
        foreach ($processList as $list){
            $process_id = $top<10 ? $id .= '-P0'.$top : $id .= '-P'.$top;
            ProductProcess::update(['sort'=>$top++,'process_id'=>$process_id],['id'=>$list['id']]);

            $id = input('id');
        }
        return json(1);
    }
    //删除工序
    public function deleteProcess(){
        $id = intval(input('id'));
        $info = ProductProcess::where(['id'=>$id])->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }

    }
}