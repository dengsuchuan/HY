<?php
namespace app\index\controller;
use app\index\model\BlueprintInfo;
use app\index\common\controller\Base;
use app\index\model\BlueprintOutside;
use app\index\model\ComparnyM;
use app\index\model\ComparnyP;
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
        $processInfo = ProductProcess::where(['drawing_detial_id'=>$drawing_detail_id])->select();
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
        //如果是ajax提交则代表为入库操作
        if(Request::isAjax()){
            $data = Request::post();
            $data['if_check'] = isset($data['if_check']) ? '1' : '0';
            $info = ProductProcess::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $drawing_detail_id = input('id');  //获取图纸明细编号
        $drawing_detail_ids = input('id');  //获取图纸明细编号
        //获取当前图纸明细的工艺记录
        $processInfo = ProductProcess::where(['drawing_detial_id'=>$drawing_detail_id])->field('id,process_id')->select();
        //统计工艺条数
        $count = count($processInfo);
        //生成工艺编号
        if($count == 0){
            $drawing_detail_id.= '-P01';
        }else{
            $processInfo = $processInfo[--$count];
            $code = intval(substr($processInfo['process_id'],strpos($processInfo['process_id'],'P')+1));
            $code++;
            $drawing_detail_id = $code<10 ? $drawing_detail_id .= '-P0'.$code:$drawing_detail_id .= '-P'.$code;
        }
        $this->assign([
            'drawing_detail_id'    =>  $drawing_detail_id,
            'drawing_detail_ids'   =>  $drawing_detail_ids,
        ]);
        return $this->view->fetch('add-process');
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
    public function getMP($data){
        $strM = "M".date('y').date('m').date('d');
        $strP = "P".date('y').date('m').date('d');
        $mArray = ComparnyM::where("mid","like",$strM."-%")->select(); //查找M的数据
        $pArray = ComparnyP::where("pid","like",$strP."-%")->select(); //查找P的数据

        if($data == "M"){/*获取有多少M*/

            if(count($mArray)){ /*count($mArray)等于0，则执行else的内容*/
                //拆分字符串为数组
                foreach ($mArray as $value){
                    $midArray[] = explode("-",$value['mid']);
                }
                //拆分单独的序号出来
                foreach ($midArray as $value){
                    $midOrder[] = $value[1];
                }
                //找到最大的序号
                $maxMid = max($midOrder);

                //合成将要生成的M编号
                $tempMid = $strM."-".($maxMid+1);
                //合成新的公司编号
                $companyNumber = $tempMid."-1";

                $tempArray = [
                    "cou"=>count($mArray),
                    "mes"=>"存在",
                    "mid"=>$midArray,
                    "max"=>$maxMid,
                    "companyNumber"=>$tempMid
                ];
            }else{
                $tempArray = ["cou"=>0,"mes"=>"不存在","companyNumber"=>$strM."-1"];
            }
            return $tempArray;


        }else if ($data == "P"){//获取有多少P
            if(count($pArray)){ /*count($mArray)等于0，则执行else的内容*/
                //拆分字符串为数组
                foreach ($pArray as $value){
                    $pidArray[] = explode("-",$value['pid']);
                }
                //拆分单独的序号出来
                foreach ($pidArray as $value){
                    $pidOrder[] = $value[1];
                }
                //找到最大的序号
                $maxPid = max($pidOrder);

                //合成将要生成的P编号
                $tempPid = $strP."-".($maxPid+1);

                $tempArray = [
                    "cou"=>count($pArray),
                    "mes"=>"存在",
                    "pids"=>$pidArray,
                    "max"=>$maxPid,
                    "companyNumber"=>$tempPid
                ];
            }else{
                $tempArray = ["cou"=>0,"mes"=>"不存在","companyNumber"=>$strP."-1"];
            }
            return $tempArray;
        }else{//获取有多少MP
            return "MP";
        }
    }

    //拿到新的公司编号值
    public function newM(){
        if(Request::isAjax()){
            $mid = Request::post("p");
            $mArray = ComparnyM::where("mid","like",$mid."-%")->select(); //查找M的数据
            if(count($mArray)){ /*count($mArray)等于0，则执行else的内容*/
                //拆分字符串为数组
                foreach ($mArray as $value){
                    $midArray[] = explode("-",$value['mid']);
                }
                //拆分单独的序号出来
                foreach ($midArray as $value){
                    $midOrder[] = $value[1];
                }
                //找到最大的序号
                $maxMid = max($midOrder);

                //合成将要生成的M编号
                $tempMid = $mid."-".($maxMid+1);
                //合成新的公司编号
                $companyNumber = $tempMid."-1";

                $tempArray = [
                    "companyNumber"=>$companyNumber
                ];

            }else{
                $tempArray = ["companyNumber"=>$mid."-1"];
            }

            return $tempArray;

        }
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
        /*----------------公司编号处理----------------------*/
        //先获取所有的模具M
        $allM = ComparnyM::order("id","desc")->select();
        $allP = ComparnyP::order("id","desc")->select();
        $this->assign("allM",$allM);
        $this->assign("allP",$allP);

        $midArray = $this->getMP("M");
        $pidArray = $this->getMP("P");
        //print_r($tempArray);
        $this->assign("midArray",$midArray);
        $this->assign("pidArray",$pidArray);




        /*----------------公司编号处理----------------------*/



        return $this->view->fetch('add-drawing-detial');
    }

    public function blueprintInterior(){
        return $this->view->fetch('blueprint-interior');
    }
}