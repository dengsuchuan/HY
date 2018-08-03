<?php
namespace app\index\controller;

use app\index\model\BlueprintInfo;
use app\index\common\controller\Base;
use app\index\model\BlueprintOutside;
use app\index\model\ComparnyM;
use app\index\model\ComparnyP;
use app\index\model\Drawing_files;
use app\index\model\Material;
use app\index\model\MaterialShape;
use app\index\model\ProductProcess;
use think\Db;
use think\facade\Request;
use app\index\model\ProcessType as ProcessTypeModel;

class Blueprint extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
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
        //获取当前的图纸明细
        $blueprintInfo = BlueprintInfo::where(['drawing_detail_id'=>$drawing_detail_id])->select();
        //获取工艺/工序信息
        $processInfo = ProductProcess::alias('p')
            ->join('process_type t','p.process_type = t.id')
            ->where(['drawing_detial_id'=>$drawing_detail_id])
            ->field('p.*,t.process_name,t.process_price')
            ->order('p.sort','asc')
            ->paginate(10);
        $count = count($processInfo);
        $this->assign([
            'processInfo'           =>  $processInfo,
            'drawing_detail_id'    =>  $drawing_detail_id,
            'count'                =>  $count,
            'blueprintInfo'       =>  $blueprintInfo
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
        //获取工艺类型数据
        $processType = ProcessTypeModel::order('sort asc')->select();
        $this->assign([
            'drawing_detail_id'    =>  $drawing_detail_id,
            'drawing_detail_ids'   =>  $drawing_detail_ids,
            'processType'          =>   $processType
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
        $tempi = 0;
        $str = "W".date('y').date('m').date('d')."-";//可以设置来之数据库的一个自定义字符串
        do{
            ++$i;
            if($i<10){
                $tempi = "0".$i;
                $i = $tempi;
            }
        }while($model->get(["drawing_external_id"=>$str.$i])); //如果存在就继续算下去

        $this->assign("createId",$str.$i);
        return $this->view->fetch("add-drawing-externa");
    }

    //获取M和P的值
    public function getMP(){
        $strP = "P".date('y').date('m').date('d');
        $pArray = ComparnyP::where("pid","like",$strP."-%")->select(); //查找P的数据

        if(count($pArray)){ /*count($mArray)等于0，则执行else的内容*/
            //拆分字符串为数组
            foreach ($pArray as $value){
                $pidArray[] = explode("-",$value['pid']);
            }
            //拆分单独的序号出来
            foreach ($pidArray as $value){
                $pidOrder[] =  intval($value[1]);
            }
            //找到最大的序号
            $maxPid = max($pidOrder);
            $maxPid += 1;

            if($maxPid<10){
                $maxPid = '0'.$maxPid.'';
            }

            echo "<script>console.log($maxPid)</script>";


            //合成将要生成的P编号//
            $tempPid = $strP."-".($maxPid);

            $tempArray = [
                "cou"=>count($pArray),
                "mes"=>"存在",
                "pids"=>$pidArray,
                "max"=>$maxPid,
                "companyNumber"=>$tempPid
            ];
        }else{
            $tempArray = ["cou"=>0,"mes"=>"不存在","companyNumber"=>$strP."-01"];
        }
        return $tempArray;
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
        $tempi = 0;
        $str = $id."-";//可以设置来之数据库的一个自定义字符串
        do{
            ++$i;  //第一次就为1，排除编号0
            if($i<10){
                $tempi = "0".$i;
                $i = $tempi;
            }
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
        $allP = ComparnyP::order("id","desc")->select();
        $this->assign("allP",$allP);

        $pidArray = $this->getMP("P");
        $this->assign("pidArray",$pidArray);

        /*----------------公司编号处理-结束---------------------*/

        /*----------------材料形状处理----------------------*/
        $materialShape = MaterialShape::all();
        $this->assign("materialShapeArray",$materialShape);




        return $this->view->fetch('add-drawing-detial');
    }

    public function blueprintInterior(){
        return $this->view->fetch('blueprint-interior');
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
        $drawing_detial_id = input('drawing_detial_id');

        $processList = ProductProcess::where(['drawing_detial_id'=>$drawing_detial_id])->field('id,sort')->order('sort','asc')->select();
        $top = 1;  //定义循环开始
        foreach ($processList as $list){
            $process_id = $top<10 ? $drawing_detial_id .= '-P0'.$top : $drawing_detial_id .= '-P'.$top;
            ProductProcess::update(['sort'=>$top++,'process_id'=>$process_id],['id'=>$list['id']]);
            $drawing_detial_id = input('drawing_detial_id');
        }

        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    //点击小三角进行排序  Asc
    public function updateAsc(){
        $id = input('id');
        $drawing_detial_id = input('drawing_detial_id');
        //获取当前数据的排序
        $Info = ProductProcess::where("id", "=", $id)->field('id,sort,process_id')->find();
        $infoSort = $Info['sort'];
        //获取上一条排序字段
        $ascInfo = ProductProcess::where("sort", "<", $infoSort)->where(['drawing_detial_id'=>$drawing_detial_id])->order("sort", "desc")->find();
        //如果是第一条数据
        if($ascInfo == null){
            return json([
                'error' => 1000,
                'msg'   =>  '已经是第一条数据'
            ]);
        }
        //元数据的信息
        $Ydata['yid'] = $Info['id'];
        $Ydata['Ysort'] = $Info['sort'];
        $Ydata['yprocessId'] = $Info['process_id'];
        //上一条记录的信息
        $Gdata['gid'] =  $ascInfo['id'];
        $Gdata['gsort'] =  $ascInfo['sort'];
        $Gdata['gprocessId'] =  $ascInfo['process_id'];
        //更新数据 将上面的改成下面的
        $info = ProductProcess::update(['sort'=>$Gdata['gsort'],'process_id'=>$Gdata['gprocessId']],['id'=> $Ydata['yid']]);
        $info1 =  ProductProcess::update(['sort'=>$Ydata['Ysort'],'process_id'=>$Ydata['yprocessId']],['id'=>$Gdata['gid']]);
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
    //点击小三角进行排序  Desc
    public function updateDesc(){
        $id = input('id');
        $drawing_detial_id = input('drawing_detial_id');
        //获取当前数据的排序
        $Info = ProductProcess::where("id", "=", $id)->field('id,sort,process_id')->find();
        $infoSort = $Info['sort'];
        //获取上一条排序字段
        $ascInfo = ProductProcess::where("sort", ">", $infoSort)->where(['drawing_detial_id'=>$drawing_detial_id])->order("sort", "asc")->find();
        //如果是第一条数据
        if($ascInfo == null){
            return json([
                'error' => 1000,
                'msg'   =>  '已经是最后一条数据'
            ]);
        }
        //元数据的信息
        $Ydata['yid'] = $Info['id'];
        $Ydata['Ysort'] = $Info['sort'];
        $Ydata['yprocessId'] = $Info['process_id'];
        //上一条记录的信息
        $Gdata['gid'] =  $ascInfo['id'];
        $Gdata['gsort'] =  $ascInfo['sort'];
        $Gdata['gprocessId'] =  $ascInfo['process_id'];
        //更新数据 将上面的改成下面的
        $info = ProductProcess::update(['sort'=>$Gdata['gsort'],'process_id'=>$Gdata['gprocessId']],['id'=> $Ydata['yid']]);
        $info1 =  ProductProcess::update(['sort'=>$Ydata['Ysort'],'process_id'=>$Ydata['yprocessId']],['id'=>$Gdata['gid']]);
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
        //获取工艺类型数据
        $processType = ProcessTypeModel::order('sort asc')->select();
        $this->assign([
            'processRow'    =>  $processRow,
            'processType'          =>   $processType
        ]);
        return $this->view->fetch('process-edit');
    }
    //工艺批量删除
    public function processDelAll(){
        $data = input();
        $drawing_detial_id = $data['dra_id'];
        $ids = $data['data'];
        $inf = false;
        foreach ($ids as $id){
            $info = ProductProcess::where(['id'=>$id])->delete();
            if($info){
                $inf = true;
            }
        }
        $processList = ProductProcess::where(['drawing_detial_id'=>$drawing_detial_id])->field('id,sort')->order('sort','asc')->select();
        $top = 1;  //定义循环开始
        foreach ($processList as $list){
            $process_id = $top<10 ? $drawing_detial_id .= '-P0'.$top : $drawing_detial_id .= '-P'.$top;
            ProductProcess::update(['sort'=>$top++,'process_id'=>$process_id],['id'=>$list['id']]);
            $drawing_detial_id = input('drawing_detial_id');
        }
        if($inf){
            return json(1);
        }else{
            return json(0);
        }
    }
    //一键复制工序界面
    public function copyProcess(){
        $drawing_detail_id = input('id');
        //查找当前图纸的所有工序
        $currentProcess = ProductProcess::where(['drawing_detial_id'=>$drawing_detail_id])->select();
        //查询现有的所有图纸明细
        $blueprintAllInfo = BlueprintInfo::where('drawing_detail_id','<>',$drawing_detail_id)->order('create_time', 'desc')->select();
        $this->assign([
            'drawing_detail_id'   =>   $drawing_detail_id,
            'blueprintAllInfo'     =>  $blueprintAllInfo,
        ]);
        return $this->view->fetch('process-copy');
    }
    //废弃
    public function exeCopyProcess(){
        if(Request::isAjax()){
            $copyCode = Request::post('copy');  //复制到某个下面的编号
            $original =  Request::post('drawing_detail_id');   //复制的源数据
            //跟据 copyCode 查找出是否有工序
            $copyProcess = ProductProcess::where(['drawing_detial_id'=>$copyCode])->order('sort desc')->select();
            //跟据original 查找出所有工序
            $originalProcess = ProductProcess::where(['drawing_detial_id'=>$original])->order('sort asc')->select()->toArray();
            //获取出copyCode的条数
            $copyCodeCount = count($copyProcess);
            //如果没有一条工序，则直接进行复制
            if($copyCodeCount === 0){
                foreach ($originalProcess as  $process){
                    unset($process['id']);
                    unset($process['create_time']);
                    unset($process['update_time']);
                    $process['process_id'] = $copyCode.= '-'.substr( $process['process_id'] ,strpos( $process['process_id'] ,'-')+1);
                    $process['drawing_detial_id'] =  Request::post('copy');
                    $copyCode = Request::post('copy');
                    $info = ProductProcess::create($process);
                }
            }else{
                $copyCode = Request::post('copy');
                //获取出最大的排序字段
                $maxSort = $copyProcess[0]['sort'];
                foreach ($originalProcess as  $process){
                    unset($process['id']);
                    unset($process['create_time']);
                    unset($process['update_time']);
                    $process['drawing_detial_id'] =  Request::post('copy');
                    $process['sort'] = ++$maxSort;
                    $process['process_id'] = $maxSort<10 ? $copyCode .= '-P0'.$maxSort:$copyCode .= '-P'.$maxSort;
                    $copyCode = Request::post('copy');
                    $info = ProductProcess::create($process);
                }
            }
            return json(1);
        }
    }
    //一键复制操作
    public function exeCopysProcess(){
        if(Request::isAjax()){
            $copyCode = Request::post('copy');  //复制到某个下面的编号
            $original =  Request::post('drawing_detail_id');   //复制的源数据
            //跟据 copyCode 查找出是否有工序
            $copyProcess = ProductProcess::where(['drawing_detial_id'=>$copyCode])->order('sort asc')->select()->toArray();
            //跟据original 查找出所有工序
            $originalProcess = ProductProcess::where(['drawing_detial_id'=>$original])->order('sort desc')->select()->toArray();
            //获取出copyCode的条数
            $copyCodeCount = count($copyProcess);
            $originalCount = count($originalProcess);
            //如果没有一条工序，则直接进行复制
            if($copyCodeCount === 0){
                return json([
                    'code'  =>  1000,
                    'msg'   =>  '选中的图纸没有工序'
                ]);
            }
            if($originalCount === 0 ){
                foreach ($copyProcess as $process){
                    unset($process['id']);
                    unset($process['create_time']);
                    unset($process['update_time']);
                    $process['process_id'] = $original.= '-'.substr( $process['process_id'] ,strpos( $process['process_id'] ,'-')+1);
                    $process['drawing_detial_id'] =  Request::post('drawing_detail_id');
                    $original =  Request::post('drawing_detail_id');   //复制的源数据
                    $info = ProductProcess::create($process);
                }
            }else{
                $copyCode = Request::post('copy');
                //获取出最大的排序字段
                $maxSort = $originalProcess[0]['sort'];
                foreach ($copyProcess as  $process){
                    unset($process['id']);
                    unset($process['create_time']);
                    unset($process['update_time']);
                    $process['drawing_detial_id'] =  Request::post('drawing_detail_id');
                    $process['sort'] = ++$maxSort;
                    $process['process_id'] = $maxSort<10 ? $original .= '-P0'.$maxSort:$original .= '-P'.$maxSort;
                    $original =  Request::post('drawing_detail_id');   //复制的源数据
                    $info = ProductProcess::create($process);
                }
            }
            return json([
                'code'  => 1,
            ]);
        }
    }

    //创建图纸明细
    public function createBlueprintInfo(){
        if(Request::isAjax()){
            $jsontext = Request::post("json");
            $jsonToArray = json_decode($jsontext);

            //公司编号
            $p = Request::post("p");
            $mes = Request::post("mes");
            $pArray = ["pid"=>$p,"mes"=>$mes];

            if (BlueprintInfo::create($jsonToArray)&&ComparnyP::create($pArray)){
                return 1;
            }else{
                return 0;
            }
        }

    }

    public function is_DrawingFiles($id,$key)//判断是否存在图纸文件  图纸明细id,类别
    {
        $model = new Drawing_files();
        $rel = $model->get(['drawing_id'=>$id]);
        switch ($key)
        {
            case 'wai':
//                echo '外图文件';
                if($rel['abroad']==null||$rel['abroad']=="")
                {
                    return $this->fetch('not-files',['key'=>'外图']);
                }
                break;

            case 'nei':
//                echo '内图文件';
                if($rel['within']==null||$rel['within']=="")
                {
                    return $this->fetch('not-files',['key'=>'内图']);
                }
                break;

            case 'cheng':
//                echo '程序图文件';
                if($rel['engineering']==null||$rel['engineering']=="")
                {
                    return $this->fetch('not-files',['key'=>'程序图']);
                }
                break;
            $this->error('非法访问');
        }
    }
}