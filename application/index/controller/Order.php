<?php
/**
 *  订单模块
 * User: dengs
 * Date: 2018/6/7 0007
 * Time: 23:20
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\DeliveryInfoModel;
use app\index\model\Order as OrderMode;
use app\index\model\BlueprintOutside;
use app\index\model\DrawingInternal;
use app\index\model\Order_files;
use function Couchbase\defaultDecoder;
use think\debug\Html;
use think\facade\Request;
use app\index\model\BlueprintInfo;
use app\index\model\OrderDetail;
use app\index\model\Client;
use app\index\model\ProductTask;
use think\facade\Session;

class Order extends Base
{
    protected $beforeActionList = [
        'isLogin',
    ];
    public function order(){
        $orderInfo = OrderMode::order('order_id asc')->paginate(25);
        $count =  $orderInfo->total();
        $this->assign([
            'orderInfo' =>  $orderInfo,
            'count'    =>  $count
        ]);
        return $this->view->fetch('order');
    }
    //添加订单
    public function addOrder(){
//        判断是否为post
        if(Request::isPost()){
            $data = Request::post();
            $mode = new OrderMode();
            $code = $this->getNewId('C'.date('y').date('m').date('d'),$mode,'order_id');
            $data['order_id'] = $code;
            $data['receivables'] = isset($data['receivables']) ? '1' : '0';
            $data['deliver_goods'] = isset($data['deliver_goods']) ? '1' : '0';
//            $data['if_complete'] = isset($data['if_complete']) ? '1' : '0';
            $data['create_name'] = session('user.user_name');
            $info = OrderMode::create($data);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        //生成编号
        $mode = new OrderMode();
        $code = $this->getNewId('C'.date('y').date('m').date('d'),$mode,'order_id');
        //获取外图信息
        $externalInfo = BlueprintOutside::field('id,drawing_external_id')->select();
        //获取内图相关信息
        $internalInfo = DrawingInternal::field('id,drawing_Internal_id')->select();
        //获取客户简称
        $clientInfo = Client::field('id,client_abbreviation')->select();
        $this->assign([
            'code' => $code,
            'externalInfo' =>  $externalInfo,
            'internalInfo' =>  $internalInfo,
            'clientInfo'    =>$clientInfo
        ]);
        return  $this->view->fetch('order_add');
    }
    public function editOrder(){
        if(Request::isPost()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            $data['receivables'] = isset($data['receivables']) ? '1' : '0';
            $data['deliver_goods'] = isset($data['deliver_goods']) ? '1' : '0';
            $data['if_complete'] = isset($data['if_complete']) ? '1' : '0';
            $data['modify_name'] = session('user.user_name');
            $info = OrderMode::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $orderRow = OrderMode::get(intval(input('id')));
        $this->assign([
            'orderRow' => $orderRow,
        ]);
        return  $this->view->fetch('order_edit');
    }

    public function orderDetail(){
        $model = intval(input('model'));
        $id = intval(input('id'));
        //echo $id;
        if($model == 1){
            $actrion = input('actrion');
            if(!isset($actrion)){
                $actrion = 1;
            }
            $orderRow = OrderMode::where(['id'=>$id])->select();
            $orderCode = OrderMode::where(['id'=>$id])->value('id');
            //获取订单明细
            $orderDatailInfo = OrderDetail::where(['order_id'=>$id])->order('sort asc')->order('if_show desc')->paginate(25);
            $orderDatailInfoC = count($orderDatailInfo);
            $orderDatailInfoNoShow = count(OrderDetail::where(['order_id'=>$id])->where(['if_show'=>0])->select());
            $this->assign([
                'orderRow'            => $orderRow,
                'orderCode'           => $orderCode,
                'orderDatailInfo'     => $orderDatailInfo,
                'orderDatailInfoNoShow' =>$orderDatailInfoNoShow,
                'orderDatailInfoC'    =>$orderDatailInfoC,
                'id'                  =>$id,
                'model'               =>1,
                'actrion'             =>$actrion
            ]);
            return  $this->view->fetch('order-detail-info');
        }
        $actrion = input('actrion');
        if(!isset($actrion)){
            $actrion = 1;
        }
        $orderRow = OrderMode::where(['id'=>$id])->select();
        $orderCode = OrderMode::where(['id'=>$id])->value('id');
        //获取订单明细
        $orderDatailInfo = OrderDetail::where(['order_id'=>$id])->where(['if_show'=>1])->order('sort asc')->order('if_show desc')->paginate(25);
        $orderDatailInfoC = count($orderDatailInfo);
        $orderDatailInfoNoShow = count(OrderDetail::where(['order_id'=>$id])->where(['if_show'=>0])->select());
        $this->assign([
            'orderRow'            => $orderRow,
            'orderCode'           => $orderCode,
            'orderDatailInfo'     => $orderDatailInfo,
            'orderDatailInfoNoShow' =>$orderDatailInfoNoShow,
            'orderDatailInfoC'    =>$orderDatailInfoC,
            'id'                  =>$id,
            'actrion'             =>$actrion,
            'model'               =>0
        ]);
        return  $this->view->fetch('order-detail-info');
    }
    public function addOrderDetail(){
        $this->assign([
            'code'   =>  4,
            'msg'    => '',
            'state'  => 0
        ]);
        if (Request::isPost()){
            $data = Request::post();
            $type = $data['type'];
            if($type == 'n'){
                $tu = 1;
            }else{
                $tu = 0;
            }
            $coder = $data['order'];
            $code = OrderDetail::where(['order_id'=>$coder])->order('order_detail_code desc')->value('order_detail_code');
            $sort = OrderDetail::where(['order_id'=>$coder])->order('sort desc')->value('sort');
            if($sort == null){
                $sort = 0;
            }
            if($code == null){
                $tempid = 1;
            }else{
                $tempid =  substr($code,strripos($code,"-")+1) +1;
            }
            unset($data['ordercode']);
            unset($data['order']);
            $order_code = Request::post('ordercode');
            $datas = [];
            foreach ($data as $key=>$value){
                if($key == 'drawing_detail_id'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
//                        OrderDetail::where('drawing_detail_id','=',$v1)->where(['order_id'=>$coder])->delete();
                        $datas[$i][$key] = $value[$i];
                        $datas[$i]['order_detail_code'] = $order_code.'-'. ($tempid<10 ? '0'.$tempid :$tempid);
                        $datas[$i]['sort'] = ++$sort;
                        $datas[$i]['create_name'] =  session('user.user_name');
                        $datas[$i]['if_tu'] = $tu;
                        $i++;
                        $tempid++;
                    }
                }

                if($key == 'drawing_detail_code'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }

                if($key == 'order_id'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'plan_qty'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $datas[$i]['plan_qty'] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'arrange'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'company'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }

                if($key == 'content'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'order_qty'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'date_delivery'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'purchase_id'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'material_source'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
//                if($key == 'warehousing'){
//                    $i = 0;
//                    foreach ($value as $k1=>$v1){
//                        $datas[$i][$key] = $value[$i];
//                        $i++;
//                    }
//                }
               if($key == 'remark'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'purchase_id'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        $datas[$i][$key] = $value[$i];
                        $i++;
                    }
                }
                if($key == 'drawing_externa_or_internal_id'){
                    $i = 0;
                    foreach ($value as $k1=>$v1){
                        if($type == 'n'){
                            $datas[$i][$key] = getNExternaId($value[$i]);
                        }else{
                            $datas[$i][$key] = getExternaId($value[$i]);
                        }
                        $i++;
                    }
                }
            }
            $orderDetail = new OrderDetail();
            $info = $orderDetail->saveAll($datas);
//            dd($datas);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $type =  input('type');
        $id = input('id');
        $ids = explode(',',$id);
        $orderId = input('order');
        $orderCode = OrderMode::where(['id'=>$orderId])->value('order_id');
        if($type == 'n'){
            $a = 1;
            $blueprintInfoId = BlueprintInfo::where('drawing_internal_id','in',$ids)->field('id')->select();
            $b_id = [];
            foreach ($blueprintInfoId as $itme){
                $b_id[] = $itme['id'];
            }
            $orderDetail =  OrderDetail::where(['order_id'=>$orderId])->where('drawing_detail_id','in',$b_id)->field('drawing_detail_id')->select();
            $b_id = [];
            foreach ($orderDetail as $itme){
                $b_id[] = $itme['drawing_detail_id'];
            }
            $blueprintInfo_ = BlueprintInfo::where('id','in',$b_id)->field('drawing_internal_id')->select();

            $blueprintInfo = BlueprintInfo::where('drawing_internal_id','in',$ids)->where('id','not in',$b_id)->select();
//            dd($blueprintInfo_);

            if($blueprintInfo_->count() !=0){

                $blueprintInfo_istr = '';
                foreach ($blueprintInfo_ as $itme){
                    $blueprintInfo_istr .= $itme['drawing_internal_id'].'   ';
                }
                $state = 0;
                if($blueprintInfo->count() == 0){
                    $state = -10;
                }
                $this->assign([
                    'code'   =>  -4,
                    'msg'    => $blueprintInfo_istr,
                    'state'  => $state
                ]);
                $this->assign([
                    'orderId'        =>  $orderId,
                    'orderCode'      =>  $orderCode,
                    'blueprintInfo'  =>   $blueprintInfo,
                    'type' =>$type,
                    'a'    => $a
                ]);

                return  $this->view->fetch('order_detail_add');
            }
            if($blueprintInfo->count() == 0){
                $this->assign([
                    'code'   =>  -5
                ]);
                $this->assign([
                    'orderId'        =>  $orderId,
                    'orderCode'      =>  $orderCode,
                    'blueprintInfo'  =>   $blueprintInfo,
                    'type' =>$type,
                    'a'    => $a
                ]);
                return  $this->view->fetch('order_detail_add');
            }

        }else if($type=='w'){
            $a = 0;
            $blueprintInfoId = BlueprintInfo::where('drawing_externa_id','in',$ids)->field('id')->select();
            $b_id = [];
            foreach ($blueprintInfoId as $itme){
                $b_id[] = $itme['id'];
            }
            $orderDetail =  OrderDetail::where(['order_id'=>$orderId])->where('drawing_detail_id','in',$b_id)->field('drawing_detail_id')->select();
            $b_id = [];
            foreach ($orderDetail as $itme){
                $b_id[] = $itme['drawing_detail_id'];
            }
//            dd($b_id);
            $blueprintInfo_ = BlueprintInfo::where('id','in',$b_id)->field('drawing_detail_id')->select();
            $blueprintInfo = BlueprintInfo::where('drawing_externa_id','in',$ids)->where('id','not in',$b_id)->select();

            if($blueprintInfo_->count() !=0){
                $blueprintInfo_istr = '';
                foreach ($blueprintInfo_ as $itme){
                    $blueprintInfo_istr .= $itme['drawing_detail_id'].'   ';
                }
                $state = 0;
                if($blueprintInfo->count() == 0){
                    $state = -10;
                }
                $this->assign([
                    'code'   =>  -4,
                    'msg'    => $blueprintInfo_istr,
                    'state'  => $state
                ]);

                $this->assign([
                    'orderId'        =>  $orderId,
                    'orderCode'      =>  $orderCode,
                    'blueprintInfo'  =>   $blueprintInfo,
                    'type' =>$type,
                    'a'    => $a
                ]);

                return  $this->view->fetch('order_detail_add');
            }
            if($blueprintInfo->count() == 0){
                $this->assign([
                   'code'   =>  -5
                ]);
                $this->assign([
                    'orderId'        =>  $orderId,
                    'orderCode'      =>  $orderCode,
                    'blueprintInfo'  =>   $blueprintInfo,
                    'type' =>$type,
                    'a'    => $a
                ]);
                return  $this->view->fetch('order_detail_add');
            }
        }
        $this->assign([
            'orderId'        =>  $orderId,
            'orderCode'      =>  $orderCode,
            'blueprintInfo'  =>   $blueprintInfo,
            'type' =>$type,
            'a'    => $a
        ]);
        return  $this->view->fetch('order_detail_add');
    }
    public function newOrder(){
        $this->assign([
            'code'   =>  0,
            'msg'    => '',
            'state'  => 0
        ]);
        $ids = input();
        $ocder_id = $ids['id'];
        $type = input('type');
        $o_drawing_details = OrderDetail::where(['order_id'=>$ids['id']])->where(['drawing_externa_or_internal_id'=>$ids['ex_or_id']])->field('drawing_detail_id')->select();  //现有的明细
        if($type == '1') {
            $ex_or_code =DrawingInternal::where(['id' => $ids['ex_or_id']])->value('drawing_Internal_id'); // 跟据外图id获取外图编号
            $d_drawing_details = BlueprintInfo::where(['drawing_internal_id'=>$ex_or_code])->field('id')->select(); // 跟据外图编号获取图纸明细
        }else{
            $ex_or_code = BlueprintOutside::where(['id' => $ids['ex_or_id']])->value('drawing_external_id'); // 跟据外图id获取外图编号
            $d_drawing_details = BlueprintInfo::where(['drawing_externa_id'=>$ex_or_code])->field('id')->select(); // 跟据外图编号获取图纸明细
        }

        $d_ids = [];  // 数据转换
        foreach ( $d_drawing_details as $item) {
            $d_ids[] = $item['id'];
        }
        $o_ids = [];
        foreach ($o_drawing_details  as $value) {
            $o_ids[] = $value['drawing_detail_id'];
        }
        $ids = array_diff($d_ids,$o_ids);  // 求两个数组的交集
        $orderId = $ocder_id;
        $orderCode = OrderMode::where(['id'=>$orderId])->value('order_id');

        if($type == '1'){
            $type = 'n';
            $a = 1;
            $blueprintInfo = BlueprintInfo::where('id','in',$ids)->select();
        }else if($type=='0'){
            $type = 'w';
            $a = 0;
            $blueprintInfo = BlueprintInfo::where('id','in',$ids)->select();
        }
        $this->assign([
            'orderId'        =>  $orderId,
            'orderCode'      =>  $orderCode,
            'blueprintInfo'  =>  $blueprintInfo,
            'type' =>$type,
            'a'    => $a
        ]);
        return  $this->view->fetch('order_detail_add');
    }
    public function orderDelete(){
        $id = intval(Request::post('id')); // 获取id
        //删除订单
        $info = OrderMode::where(['id'=>$id])->delete(); //

        if($info){
            $ids = OrderDetail::where(['order_id'=>$id])->field('id')->select();
            foreach ($ids as $v ){
                ProductTask::where(['order_detial_id'=>$v['id']])->delete();
            }
            OrderDetail::where(['order_id'=>$id])->delete();
            return json(1);
        }else{
            return json(0);
        }
    }
    public function editOrderDetail(){
        if(Request::isPost()){
            $data = Request::post();
            $id = $data['id'];
            unset($data['id']);
            $data['if_show'] =  isset($data['if_show']) ? '1' : '0';
            $data['modify_name'] =  session('user.user_name');
            $info = OrderDetail::update($data,['id'=>$id]);
            if($info){
                return json(1);
            }else{
                return json(0);
            }
        }
        $id = intval(input('id'));
        $ordeDetailRow = OrderDetail::where(['id'=>$id])->find();
        $this->assign([
            'ordeDetailRow' =>  $ordeDetailRow
        ]);
        return $this->view->fetch('order_edit_detail');
    }
    public function updateShow(){
        $data = Request::post();
        $info = OrderDetail::update(['if_show'=>$data['show']],['id'=>$data['id']]);
        if($info){
            return json(1);
        }else{
            return json(0);
        }
    }
    public function deleteDetail(){
        //对应订单明细的ID  数字
        $id = input('id');
        $order_detail_code = OrderDetail::where(['id'=>$id])->value('order_detail_code');
        $info = OrderDetail::where(['id'=>$id])->delete();
        if($info){
            ProductTask::where(['order_detial_id'=>intval(input('id'))])->delete();
            DeliveryInfoModel::where(['orderCode'=>$order_detail_code])->delete();
            return json(1);
        }else{
            return json(0);
        }
    }
    //@DrawingInternal 为当前数据表模型
    public function SanSort(){
        $data = Request::post();
        $OrderDetail = new OrderDetail();
        return $this->Sort($data,$OrderDetail);
    }

    // 一键复制
    public function copyOrderDetail(){
        $order_detail_id = input('id');
        // 查询不包括自己的订单明细
        $order_detail_info = OrderMode::where('id','<>',$order_detail_id)->order('create_time', 'desc')->select();
        // 获取订单编号
        $order_code = OrderMode::where(['id'=>$order_detail_id])->value('order_id');
        $this->assign([
            'order_detail_id'   =>      $order_detail_id,
            'order_detail_info'     =>  $order_detail_info,
            'order_code'            =>  $order_code
        ]);
        return $this->view->fetch('order-detail-copy');
    }
    // 复制
    public function exeOrderDetail(){
        $copyCode = OrderMode::where(['order_id'=>Request::post('copy')])->value('id'); ;  //复制到某个下面的编号
        $original =  OrderMode::where(['order_id'=>Request::post('order_detail_id')])->value('id'); ;  //复制到某个下面的编号
        $delivery_time =  OrderMode::where(['order_id'=>Request::post('order_detail_id')])->value('delivery_time'); ;  //复制到某个下面的编号
        //跟据 copyCode 查找出是否有工序
        $copyOrderDetail = OrderDetail::where(['order_id'=>$copyCode])->select()->toArray();
        //如果没有一条工序，则直接进行复制
        if(count($copyOrderDetail) === 0){
            return json([
                'code'  =>  1000,
                'msg'   =>  '选中的订单没有订单明细'
            ]);
        }else{
            foreach ($copyOrderDetail as $item){
                unset($item['id']);
                unset($item['create_time']);
                unset($item['update_time']);
                $item['order_id'] = $original;
                $item['date_delivery'] = $delivery_time;
                $item['create_name'] = session('user.user_name');
                OrderDetail::create($item);
            }
        }
        return json([
            'code'  => 1,
        ]);

    }

    public function OrderFile()
    {
        $id = input('id');
        $model = new OrderMode();
        if(!$data = $model->get(['id'=>$id]))
        {
            echo '<h1 class="layui-text">无效订单</h1>';
            return;
        }
        $model = new Order_files();
        $rel = $model->where(['order_id'=>$id])->order('type','desc')->paginate(15);
        $this->assign('files',$rel);
        $this->assign('page',$rel->render());
        return $this->fetch('upload_views',['id'=>$id,'order_number'=>$data['order_id']]);
    }

    public function upOrderFile()
    {
        $order_id = input('id');
        $model = new OrderMode();
        if(!$model->get(['id'=>$order_id]))
        {
            echo '<h1 class="layui-text">无效订单</h1>';
            return;
        }
        return $this->fetch('uploads',['order_id'=>$order_id]);
    }

    public function upOrderFiles()
    {
        $order_id = input('order_id');
        $describe = $this->request->post('describe');
        if($describe == "")
        {
            $describe ='合同文件';
        }else{
            $describe = htmlspecialchars($describe);
        }
        $files = $this->request->file('file');
        $yesNum =0;
        $noNum = 0;
        $model = new Order_files();
        try {
            foreach ($files as $file) {
                //支持常见图片,文档的上传
                $info = $file
                    ->validate([
                        'ext' => 'docx,doc,jpg,png,pdf,tif'])
                    ->move('./order_files/', time() . rand(rand(1, 1000), rand(1000, 100000)));
                if (!$info) {
                    $noNum += 1;
                    continue;
                }
                $model->insert([
                    'order_id'=>$order_id,
                    'path'=>'/order_files/' . $info->getSaveName(),
                    'describe'=>$describe,
                    'create_time'=>time(),
                    'type'=>$info->getExtension(),
                    'create_user'=>Session::get('user.user_name')
                ]);
                $yesNum += 1;
            }
            echo json_encode([
                'state'=>200,
                'count' => $yesNum + $noNum,
                'yes' => $yesNum,
                'no' => $noNum,
                'msg' => '上传完成'
            ]);
            return;
        }catch (Exception $e)
        {
            echo json_encode([
                'state'=>400,
                'msg' => '上传失败'
            ]);
            return;
        }
    }

    public function DelFiles()
    {
        $id = input('id');
        $model = new Order_files();
        $data = $model->get(['id'=>$id]);
        if(!$data)
        {
            echo json_encode([
                'state'=>400,
                'msg'=>'删除失败'
            ]);
            return;
        }
        if(file_exists('.'.$data['path']))
        {
            if(!unlink('.'.$data['path']))
            {
                echo json_encode([
                    'state'=>400,
                    'msg'=>'删除失败'
                ]);
                return;
            }
        }
        if(!$model->where(["id"=>$id])->delete())
        {
            echo json_encode([
                'state'=>400,
                'msg'=>'记录删除失败'
            ]);
            return;
        }
        echo json_encode([
            'state'=>200,
            'msg'=>'已删除'
        ]);
        return;
    }

    public function DelAllFiles()
    {
        $order_id = input('order_id');
        $model = new Order_files();
        $data = $model->where(['order_id'=>$order_id])->select();
        foreach ($data as $list)
        {
            try {
                if (!file_exists('.' . $list['path'])) {
                    $model->where(['id' => $list['id']])->delete();
                }
            }catch (Exception $e){
                continue;
            }
        }
        echo json_encode([
            'state'=>200,
            'msg'=>'清理完成'
        ]);
        return;
    }

    public function previewPdf()
    {
        $id=input('id');
        $model = new Order_files();
        if(!$rel = $model->get(['id'=>$id]))
        {
            $this->error('非法操作');
            return;
        }
        $model = new OrderMode();
        if(!$data = $model->get(['id'=>$rel['order_id']]))
        {
            $name = '已删除订单的文件';
        }else{
            $name = $data['order_id'];
        }
        return $this->fetch('order_pdf',['path'=>$rel['path'],'name'=>$name]);
    }
    public function editName()
    {
        $describe = htmlspecialchars($this->request->post('name'));
        $id = input('Id');
        $model = new Order_files();
        try {
            $model->where(['id' => $id])->update(['describe' => $describe]);
        }catch (Exception $e) {
            return $e->getMessage();
        }
        return;
    }
}

