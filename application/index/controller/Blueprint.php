<?php
namespace app\index\controller;

use app\index\model\BlueprintInfo;
use app\index\common\controller\Base;
use app\index\model\BlueprintOutside;
use app\index\model\Client;
use app\index\model\ComparnyM;
use app\index\model\ComparnyP;
use app\index\model\DrawingInternal;
use app\index\model\Material;
use app\index\model\MaterialShape;
use app\index\model\ProductProcess;
use app\index\model\DrawingFiles;
use app\index\model\Section;

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

        $ClientKeyInfo = Client::select();
        $this->assign("clientKeyInfo",$ClientKeyInfo);

        //判断是否为post提交请求。如果是，就代表是搜索。
        $blueprintKeyInfo = BlueprintInfo::order('create_time', 'desc')->select();
        $tempData2 = [
            'modules'=>input('modules'),
            'id'=>input('id'),
            'codeId'   =>input('codeId'),
            'key'   => input('key'),
        ];

        if(Request::isPost() || isset($tempData2['modules']) || isset($tempData2['id']) || isset($tempData2['key']) || isset($tempData2['codeId'])){
            //$data = Request::post();
//            dd($tempData2);
            $tempData1 = Request::post();
            $data = isset($tempData1['id'])?$tempData1:$tempData2;
            if($data['id']!=""){//这个ID是客户ID
                $blueprintInfo = BlueprintInfo::where("client_id",$data['id'])->order('drawing_detail_id asc')->paginate(25);
            }else if ($tempData2['key']!=''){
                    switch ($tempData2['key']){
                        case 'internal':
                            $blueprintInfo =  BlueprintInfo::where("drawing_internal_id",$tempData2['codeId'])->order('drawing_detail_id asc')->paginate(25);
                            break;
                        case 'externa':
                            $blueprintInfo =  BlueprintInfo::where("drawing_externa_id",$tempData2['codeId'])->order('drawing_detail_id asc')->paginate(25);
                            break;
                        case 'clients':
                            $blueprintInfo = BlueprintInfo::where("client_id",$tempData2['codeId'])->order('drawing_detail_id asc')->paginate(25);
                    }
            } else{
                $blueprintInfo = BlueprintInfo::order('drawing_detail_id asc')
                    ->where("drawing_detail_id","LIKE","%".$data['modules']."%")
                    ->whereOr("drawing_internal_id","LIKE","%".$data['modules']."%")
                    ->whereOr("drawing_externa_id","LIKE","%".$data['modules']."%")
                    ->whereOr("drawing_name","LIKE","%".$data['modules']."%")
                    ->whereOr("material","LIKE","%".$data['modules']."%")
                    ->whereOr("drawing_type","LIKE","%".$data['modules']."%")
                    ->whereOr("material","LIKE","%".$data['modules']."%")
                    ->whereOr("client_id",'=',$data['modules'])
                    ->paginate(25);
            }

            $blueprintInfoCount = $blueprintInfo->total();
            $this->assign('blueprintInfo', $blueprintInfo);
            $this->assign('blueprintInfoCount', $blueprintInfoCount);
            $this->assign('blueprintKeyInfo', $blueprintKeyInfo);
            return $this->view->fetch('blueprint-info');

        }
        $blueprintInfo = BlueprintInfo::order('drawing_detail_id', 'asc')->paginate(25);

        $blueprintInfoCount = $blueprintInfo->total();
        $this->assign('blueprintInfo', $blueprintInfo);
        $this->assign('blueprintInfoCount', $blueprintInfoCount);
        $this->assign('blueprintKeyInfo', $blueprintKeyInfo);
        return $this->view->fetch('blueprint-info');
    }

    //--|--|明细具体项目详情
    public function blueprintInfos()
    {
        $section = Section::all();//材料规格
        $this->assign("section",$section);

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
            $data['if_discard'] = isset($data['if_discard']) ? '1' : '0';
            $data['files_state'] = isset($data['files_state']) ? '1' : '0';
            $data['modify_name'] = session('user.user_name');
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

        $drawingInternal = DrawingInternal::all();//所有内图
        $this->assign("drawingInternal",$drawingInternal);

        $client = Client::all();//所有客户
        $this->assign("client",$client);

        $materialShape = MaterialShape::all();//材料形状
        $this->assign("materialShape",$materialShape);

        $material = Material::all();//获取所有材料
        $this->assign("material",$material);

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
            ->paginate(25);
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
            if(session('user.is_quota') == 0){
                $data['process_quota'] = 0;
            }
            $drawing_detial_id = $data['drawing_detial_id'];
            $processInfo = ProductProcess::where(['drawing_detial_id'=>$drawing_detial_id])->field('sort')->order('sort','desc')->select();
            //统计工艺条数 判断是否有值
            $count = count($processInfo);
            $data['if_check'] = isset($data['if_check']) ? '1' : '0';

            if(session('user.is_offer') == 0){
                $data['quota_quotation'] = 0;
                $data['process_quoted_price'] = 0;
            }else if (session('user.is_offer') == 1){
                $data['quota_quotation'] = 0;
                $data['process_quoted_price'] = 0;
            }

            if($count == 0){
                $data['sort'] = 1;
            }else{
                $sort = $processInfo[0]['sort'];
                $data['sort'] = ++$sort;
            }
            $data['create_name'] = session('user.user_name');
            $info = ProductProcess::create($data);
            if($info){
                BlueprintInfo::update(['is_gongxu'=>1],['drawing_detail_id'=>$drawing_detial_id]);
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
        //-----------------------------------------
        //搜索功能
        if(Request::isPost()){
            $data = Request::post();
            if($data['id']!=""){//这个ID是主键
                $blueprintOutside = BlueprintOutside::where("id",$data['id'])->paginate(25);
            }else{
                $blueprintOutside = BlueprintOutside::order('drawing_external_id', 'asc')
                    ->where("drawing_external_id","LIKE","%".$data['modules']."%")
                    ->paginate(25);
            }
        }else{
            $blueprintOutside = BlueprintOutside::order('drawing_external_id','asc')->paginate(25);
        }
        //-----------------------------------------

        $this->assign('blueprintOutside',$blueprintOutside);
        $blueprintOutsideCount = $blueprintOutside->total();
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


    //公司编号-以作废
    //拿到新的公司编号值
//    public function newM(){
//        if(Request::isAjax()){
//            $mid = Request::post("p");
//            $mArray = ComparnyM::where("mid","like",$mid."-%")->select(); //查找M的数据
//            if(count($mArray)){ /*count($mArray)等于0，则执行else的内容*/
//                //拆分字符串为数组
//                foreach ($mArray as $value){
//                    $midArray[] = explode("-",$value['mid']);
//                }
//                //拆分单独的序号出来
//                foreach ($midArray as $value){
//                    $midOrder[] = $value[1];
//                }
//                //找到最大的序号
//                $maxMid = max($midOrder);
//
//                //合成将要生成的M编号
//                $tempMid = $mid."-".($maxMid+1);
//                //合成新的公司编号
//                $companyNumber = $tempMid."-1";
//
//                $tempArray = [
//                    "companyNumber"=>$companyNumber
//                ];
//
//            }else{
//                $tempArray = ["companyNumber"=>$mid."-1"];
//            }
//
//            return $tempArray;
//
//        }
//    }

    //添加外图
    public function addDrawingExternalId(){
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

    //获取最新的内图编号
    public function getP(){
        //获取数据库中P180706-x的数量实现自动生成编号
        $str = "P".date('y').date('m').date('d');//字符串
        $model = new DrawingInternal();//实例
        $newId = $this->getNewId($str,$model,"drawing_Internal_id");//最新的内图
        return $newId;
    }

    //添加图纸明细的视图里面的参数
    public function addDrawingDetial($id){//从视图传来

        $detailArray = array();
        /*------------------生成新的--明细编号------------------------*/
        //获取数据库中$id的数量实现自动生成图纸明细编号
        $model = new BlueprintInfo();//可实例化，也可不实例化
        $newId = $this->getNewId($id,$model,"drawing_detail_id");

        $material = Material::all();//获取所有材料

        $detailArray = [
            'drawing_detail_id'=>$newId,//图纸明细的编号
            'drawing_external_id'=>$id,//外图编号
            'material'=>$material,//获取所有材料
        ];
        $this->assign("detailArray",$detailArray);

        /*----------------内图编号处理----------------------*/
        //先获取所有已经存在的内图编号
        $allInternal = DrawingInternal::order("id","desc")->select();

        //获取最新的内图编号
        $newInternal = $this->getP();

        $internal['old'] = $allInternal;
        $internal['new'] = $newInternal;

        $this->assign("internal",$internal);
        /*----------------公司编号处理-结束---------------------*/


        /*----------------材料形状处理----------------------*/
        $materialShape = MaterialShape::all();
        $this->assign("materialShapeArray",$materialShape);

        $client = Client::all();//所有客户
        $this->assign("client",$client);

        $section = Section::all();//材料规格
        $this->assign("section",$section);

        //session的客户id
        $clientId = session('client_id')?session('client_id'):"";
        $this->assign("clientId",$clientId);

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
        $drawing_detial_id = input('drawing_detial_id');
        $info = ProductProcess::where(['id'=>$id])->delete();
        $count = count(ProductProcess::where(['drawing_detial_id'=>$drawing_detial_id])->field('id')->select());
        if($count==0){
            BlueprintInfo::update(['is_gongxu'=>0],['drawing_detail_id'=>$drawing_detial_id]);
        }
//        dd($drawing_detial_id);
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
            $data['modify_name'] = session('user.user_name');
//            if(session('user.is_offer') == 0){
//                $data['quota_quotation'] = 0;
//                $data['process_quoted_price'] = 0;
//            }else if (session('user.is_offer') == 1){
//                $data['quota_quotation'] = 0;
//                $data['process_quoted_price'] = 0;
//            }
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
        $count = count(ProductProcess::where(['drawing_detial_id'=>$drawing_detial_id])->field('id')->select());
        if($count==0){
            BlueprintInfo::update(['is_gongxu'=>0],['drawing_detail_id'=>$drawing_detial_id]);
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
                    if(session('user.is_quota') == 0){
                        $process['process_quota'] = 0;
                    }
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
                    if(session('user.is_quota') == 0){
                        $process['process_quota'] = 0;
                    }
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
            $jsonToArray = json_decode($jsontext,true);
            $arrayToJson = json_encode($jsonToArray);
            $jsonToArray = json_decode($arrayToJson,true);
            //更新一下最新的明细编号
            $str = $jsonToArray['drawing_externa_id'];
            $model = new BlueprintInfo();
            $newId = $this->getNewId($str,$model,'drawing_detail_id');
            $jsonToArray['drawing_detail_id'] = $newId;
            //写入创建者
            $jsonToArray['create_name'] = session('user.user_name');
            if(session('user.is_price') == 0){
                $jsonToArray['product_mfg_cost'] = 0;
                $jsonToArray['product_quotation'] = 0;
                $jsonToArray['product_real_price'] = 0;
            }else if (session('user.is_price') == 1){
                $jsonToArray['product_mfg_cost'] = 0;
                $jsonToArray['product_quotation'] = 0;
                $jsonToArray['product_real_price'] = 0;
            }



            //更新一下最新的内图编号
            $drawing_Internal_id = Request::post("drawing_Internal_id");

            $info = '';
            if(isset($drawing_Internal_id)){
                $drawing_Internal_id = $this->getP();
                $info1 = DrawingInternal::create(['drawing_Internal_id'=>$drawing_Internal_id,'remark'=>'','create_name'=>session('user.user_name')]);

                $jsonToArray['drawing_internal_id'] = $drawing_Internal_id;
                $info2 = BlueprintInfo::create($jsonToArray);
                if($info1 && $info2){
                    $info = 1;
                }else{
                    $info = 0;
                }
            }else{
                $info = BlueprintInfo::create($jsonToArray);
            }

            if ($info){
                session('client_id',$jsonToArray['client_id']);
                return json(1);
            }else{
                return json(0);
            }
        }

    }

    public function DelAll()  //用于删除
    {
        $Ary = Request::post();
        //总条数
        $count = count($Ary['data']);
        $sum = 0;
        for($i=0;$i<$count;$i++)
        {
            $id = $Ary['data'][$i];
            $drawing_detail_id = BlueprintInfo::where(['id'=>$id])->value('drawing_detail_id');
            if(!Db::table($Ary['table'])->where(["Id"=>$Ary['data'][$i]])->delete())
            {
                continue;//失败不统计
            }
            ProductProcess::where(['drawing_detial_id'=>$drawing_detail_id])->delete();
            //计数
            $sum++;
            //写入日志
        }
        echo json_encode($data=[
            "state"=>200,
            "message"=>"选中".$count."条记录,共".$sum."条删除成功"
        ]);
        return;
    }
    public function is_DrawingFiles($id,$key)//判断是否存在图纸文件  图纸明细id,类别
    {
        $model = new DrawingFiles();
        $rel = $model->get(['drawing_id'=>$id]);
        switch ($key)
        {
            case 'wai':
//                echo '外图文件';
                $data=['drawing_id'=>$id,'key'=>'图纸','tip'=>'abroad'];//图纸基本信息
                if($rel['abroad']==null||$rel['abroad']=="")//没有文件地址
                {
                    return $this->fetch('not-files',$data);
                }
                if(!file_exists('.'.$rel['abroad']))//文件不存在
                {
                    return $this->fetch('not-files',$data);
                }
                $data['url']=$rel['abroad'];
                return $this->fetch('drawing_files',$data);
                break;

            case 'nei':
//                echo '内图文件';
                $data=['drawing_id'=>$id,'key'=>'模型','tip'=>'within'];//图纸基本信息
                if($rel['within']==null||$rel['within']=="")
                {
                    return $this->fetch('not-files',$data);
                }
                if(!file_exists('.'.$rel['within']))//文件不存在
                {
                    return $this->fetch('not-files',$data);
                }
                $data['url']=$rel['within'];
                return $this->fetch('drawing_files',$data);
                break;

            case 'cheng':
//                echo '程序图文件';
                $data=['drawing_id'=>$id,'key'=>'程序单','tip'=>'engineering'];//图纸基本信息
                if($rel['engineering']==null||$rel['engineering']=="")
                {
                    return $this->fetch('not-files',$data);
                }
                if(!file_exists('.'.$rel['engineering']))//文件不存在
                {
                    return $this->fetch('not-files',$data);
                }
                $data['url']=$rel['engineering'];
                return $this->fetch('drawing_files',$data);
                break;
                $this->error('非法访问');
        }
    }

    public function FileUpload($drawing_id,$tip)//图纸文件上传
    {
        $files = $this->request->file('file');//得到文件
        $fileModel = new DrawingFiles();
        $data = $fileModel->get(['drawing_id'=>$drawing_id]);
        switch ($tip) { //文件分类上传
            //外部图纸
            case 'abroad':
                if(file_exists('.'.$data[$tip]))
                {
                    @unlink('.'.$data[$tip]);
                }
                $info = $files->validate(['ext'=>'pdf'])
                    ->move('./drawing/wai',strtoupper($tip).$drawing_id);
                $path= '/drawing/wai/'.strtoupper($tip).$drawing_id;
                break;
            //模型文件
            case 'within':
                if(file_exists('.'.$data[$tip]))
                {
                    @unlink('.'.$data[$tip]);
                }
                $info = $files->validate(['ext'=>'pdf'])
                    ->move('./drawing/nei',strtoupper($tip).$drawing_id);
                $path= '/drawing/nei/'.strtoupper($tip).$drawing_id;
                break;
            //程序图文件
            case 'engineering':
                if(file_exists('.'.$data[$tip]))
                {
                    @unlink('.'.$data[$tip]);
                }
                $info = $files->validate(['ext'=>'pdf'])
                    ->move('./drawing/cheng',strtoupper($tip).$drawing_id);
                $path= '/drawing/cheng/'.strtoupper($tip).$drawing_id;
                break;
        }
        if(!$info) //上传失败反馈
        {
            echo json_encode([
                'state' =>  500,
                'msg'   =>  '文件上传失败',
            ]);
            return;
        }
        if($data) {  //已经存在改图纸明细的文件记录
            $fileModel->where(['drawing_id'=>$drawing_id])->update([$tip=>'']);//清空原记录
            $rel = $fileModel->where(['drawing_id'=>$drawing_id])->update([$tip=>$path.'.pdf']);
            if(!$rel)
            {
                echo json_encode([
                    'state' =>  500,
                    'msg'   =>  '文件记录上传失败',
                ]);
                return;
            }
                echo json_encode([
                    'state' =>  200,
                    'msg'   =>  '文件上传完成',
                ]);
                return;
        }
        //不存在该图纸明细的文件记录
        $rel = $fileModel->save([$tip=>$path.'.pdf','drawing_id'=>$drawing_id]);
        if(!$rel)
        {
            echo json_encode([
                'state' =>  500,
                'msg'   =>  '文件记录上传失败',
            ]);
            return;
        }
            echo json_encode([
                'state' =>  200,
                'msg'   =>  '文件上传完成',
            ]);
            return;
    }

    public function delete(){
        $id = intval(input('id'));
        $drawing_detail_id = BlueprintInfo::where(['id'=>$id])->value('drawing_detail_id');  //获取编号
        $info =  BlueprintInfo::where('id',$id)->delete();
        if($info){
            ProductProcess::where(['drawing_detial_id'=>$drawing_detail_id])->delete();
            return 1;
        }else{
            return 0;
        }
    }
    public function deleteOutside(){//删除外图
        $id = intval(input('id'));
        $info =  BlueprintOutside::where('id',$id)->delete();
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }

    public function outsideEdit(){
        if(Request::isAjax()) {
            $data = Request::post();
            $id = $data['id'];
            $old_drawing_external_id =  $data['old_drawing_external_id'];
            $drawing_external_id =  $data['drawing_external_id'];
            unset($data['id']);
            unset($data['old_drawing_external_id']);

            //BlueprintInfo::where("drawing_externa_id","LIKE","%".$old_drawing_external_id."%")->update(["drawing_externa_id"=>$drawing_external_id]);

            $info = BlueprintOutside::update($data,['id'=>$id]);//修改外图
            $tempArray = BlueprintInfo::where("drawing_externa_id","LIKE","%".$old_drawing_external_id."%")->select();//先查找旧数据，返回一个结果集
            foreach ($tempArray as $value){
                $productProcess['old'][]= $value['drawing_detail_id'];//拿到所有旧的明细编号
            }

            $tempJson = str_replace($old_drawing_external_id,$drawing_external_id,$tempArray);//替换里面的旧数据为新数据
            $tempArray = json_decode($tempJson,true);//新数据转换为数组
            //修改明细表
            foreach ($tempArray as $value){//循环出ID
                $tempId = $value['id'];//获得所有ID
                $tempValueExterna = $value['drawing_externa_id'];
                $tempValueDetail = $value['drawing_detail_id'];
                $productProcess['new'][] = $value['drawing_detail_id'];//拿到所有新的明细编号表
                //开始循环修改
                BlueprintInfo::where('id', $tempId)
                    ->data(['drawing_externa_id' => $tempValueExterna,'drawing_detail_id' => $tempValueDetail])
                    ->update();
            }
            $productProcessArray['old'] = $productProcess['old'];
            $productProcessArray['new'] = $productProcess['new'];

            for($i = 0;$i < count($productProcessArray['old']);$i++){
                $old = $productProcessArray['old'][$i];
                $new = $productProcessArray['new'][$i];
                //echo "旧的:".$old."   新的:".$new."\n";
                ProductProcess::where('drawing_detial_id', $old)
                    ->data(['drawing_detial_id' => $new])
                    ->update();
            }

            if ($info){
                return json(1);
            }else{
                return json(0);
            }
        }


        $id = intval(input('id'));
        $outsideRow = BlueprintOutside::where('id',$id)->find();
        $this->assign('outsideRow',$outsideRow);
        return $this->view->fetch('outside-edit');
    }

    public function is_outDrawing($id)
    {
        echo $id;
    }

}