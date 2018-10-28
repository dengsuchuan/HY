<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

use app\index\model\Client;
use app\index\model\MaterialShape;
use app\index\model\Section;
use app\index\model\BlueprintInfo;
use app\index\model\DrawingInternal;
use app\index\model\EquipmentType;
use app\index\model\CostType;
use app\index\model\BlueprintOutside;
use app\index\model\OrderDetail;
use app\index\model\EquipmentInfo;
use app\index\model\ProductTask;
use app\index\model\Material;
use app\index\model\ProcessType;
use app\index\model\ProductProcess;
use app\index\model\ProductLog;

// 应用公共文件
//截取右边的展示内容
function msubstr($content) {
    return mb_substr(strip_tags(str_replace(['&nbsp;','nbsp;','&amp;','nbsp;'],'',$content)),0,450).'...';
}
function dd($value){
    dump($value);
    die;
}

function getClientName($id){
    $clientName = Client::where("id","$id")->value("client_abbreviation");
    $data = [
        'clientName'    =>  $clientName,
        'id'    => $id,
    ];
    return $data;
}

function getMateria($id){
    $clientName = MaterialShape::where("id","$id")->value("shape");
    return $clientName;
}

//获取材料类型
function getMaterialType($id){
    $material = Material::where("id",$id)->value("material_id");
    return $material;
}

//材料形状的查询
function getWeight($id){//获取材料形状的重量
    $weight = Section::where("id","$id")->value("weight");
    return $weight;
}

function getWeightId($id){//获取材料形状的编号
    $weightId =  Section::where("id","$id")->value("spec");
    return $weightId;
}
function getCodet($id){
    $count = BlueprintInfo::where('drawing_internal_id','=',$id)->count();
    return$count;
}

//页数
function getInt($int){
    $int = $int > (int)$int?(int)$int+1:1;
    return $int;
}

//检查是否有子项    外图
function getDetialExternal($id){
    $count = BlueprintInfo::where('drawing_externa_id',$id)->count();
    return $count;
}

//检查是否有子项  组件
function getAssembly($id){
    $count = DrawingInternal::where('assembly_code',$id)->count();
    return $count;
}

//跟据id查询图纸明细编号
function getDrawingDetailId($id){
 return BlueprintInfo::where(['id'=>$id])->value('drawing_detail_id');
}

//跟据id获取客户简称
function getClientAbbreviation($id){
    return  $clientName = Client::where("id","$id")->value("client_abbreviation");
}

//获取设备名称
function getEquipmentName($id){
    return EquipmentType::where("id",$id)->value("eqpmt_type");
}

//获取量具名称
function getMeasuringName($id){
    return CostType::where("id",$id)->value("cost_name");
}
//获取外图ID
function getExternaId($code){
    return BlueprintOutside::where('drawing_external_id','=',$code)->value('id');
}
//获取外图编号
function getExternaCode($id){
    return BlueprintOutside::where('id','=',$id)->value('drawing_external_id');
}
//获取图纸明细编号
function getDrawingDetailCode($code){
    return BlueprintInfo::where(['drawing_externa_id'=>$code])->value('id');
}
function getCountExterna($id,$order_id){

    $drawing_external_id = BlueprintOutside::where('id','=',$id)->value('drawing_external_id');
    $d_count = count(BlueprintInfo::where(['drawing_externa_id'=>$drawing_external_id])->select());
    $o_counrt = count(OrderDetail::where(['drawing_externa_or_internal_id'=>$id])->where('order_id','=',$order_id)->select());
    if($d_count > $o_counrt){
        return true;
    }else{
        return false;
    }
}

// 通过图纸明细ID 获取产品名称
function getDrawingName($id){
    return BlueprintInfo::where(['id'=>$id])->value('drawing_name');
}
function getblueprintInfoList($id){
    return (BlueprintInfo::where(['id'=>$id])->find());

}
// 传入订单明细编号获取产品名称

function getOrderDrawingName($order_id){
    // 获取订单明细下面的图纸明细ID
    $p_id = OrderDetail::where(['id'=>$order_id])->value('drawing_detail_id');
    // 通过明细id 获取产品名称
    $drawingName = BlueprintInfo::where(['id'=>$p_id])->value('drawing_name');
    return $drawingName;
}
function getblueprintInfo($order_id){
    // 获取订单明细下面的图纸明细ID
    $p_id = OrderDetail::where(['id'=>$order_id])->value('drawing_detail_id');

    // 通过明细id 获取产品名称
    $blueprintInfo = BlueprintInfo::where(['id'=>$p_id])->find();
    return $blueprintInfo;
}
// 获取设备详情
function getEquipmentInfo($id){
    $EquipmentInfo = EquipmentInfo::where(['id'=>$id])->field('id,eqpmt_id,eqpmt_name')->find();
    return $EquipmentInfo;
}

function getIsTask($id){
    $info = ProductTask::where(['order_detial_id'=>$id])->select();
    $count = $info->count();
    if($count){
        return 1;
    }else{
        return 0;
    }
}

function getWc($id){
    $info = ProductTask::where(['order_detial_id'=>$id])->select();
    $count = $info->count();
    $i = 1;
    if($count){
        foreach ($info as $item){
            if($item['if_completr'] != 1){
                $i = 0;
                break;
            }
        }
        return $i;
    }
}

function getDrawingDetailId1($id){
    return OrderDetail::where(['id'=>$id])->value('order_detail_code');
}

function sjcTime($time){
    $date_time=date("Y-m-d H:i:s",$time);
    return $date_time;
}

function getProcess($id){
    $processName = ProcessType::where('id',$id)->value('process_name');
    return $processName;
}

function getGyType($id){
    $typeId = ProductProcess::where(['process_id'=>$id])->value('process_type');
    $tyepName = ProcessType::where(['id'=>$typeId])->value('process_name');
    return $tyepName;
}
function getOrderStaus($cp_id,$id,$p_id){
    $sum_count = ProductProcess::where('drawing_detial_id',$cp_id)->select()->count();
    $ProductLogs = ProductLog::where(['task_id'=>$id])->field('process_id,process_id')->order('process_id desc')->find();
    $sum = cut_str($ProductLogs['process_id'],'P',-1)+1;
    $sum = $sum < 10 ? substr($ProductLogs['process_id'],0,strpos($ProductLogs['process_id'], 'P')).'P0'.$sum : substr($ProductLogs['process_id'],0,strpos($ProductLogs['process_id'], 'P')).'p'.$sum;
    $leix = getGyType($ProductLogs['process_id']);
    $uu = substr($ProductLogs['process_id'],strpos($ProductLogs['process_id'],'P')+1)+1-1;

    // 颜色
    $xx = $uu <10 ? $cp_id.'-P0'.$uu:$cp_id.'-P'.$uu;
    $yanse = ProductLog::where(['task_id'=>$id])->where(['process_id'=>$xx])->select();
    $num = ProductTask::where(['id'=>$p_id])->value('task_qty');
    $x_num = 0;
    foreach ($yanse as $item){
        $x_num += $item['complete_qty'];
    }
    if($x_num == $num){
       $code = "<span style='color: #28ac17'>";

    }else{
        $code = "<span style='color: #666'>";

    }
    if ($uu == $sum_count){
        $k = '';
    }else{
        $k = '>';
    }
    $centent = $code.$uu.$leix."</span>".$k.getGyType($sum).'/'.$sum_count;
    return ($ProductLogs['process_id'] != null ?  $centent : 1 .'>/'.$sum_count);

}
function yanz($cp_id,$id,$p_id){
    $ProductLogs = ProductLog::where(['task_id'=>$id])->field('process_id,process_id')->order('process_id desc')->find();
    $uu = substr($ProductLogs['process_id'],strpos($ProductLogs['process_id'],'P')+1)+1-1;
    // 颜色
    $xx = $uu <10 ? $cp_id.'-P0'.$uu:$cp_id.'-P'.$uu;
    $yanse = ProductLog::where(['task_id'=>$id])->where(['process_id'=>$xx])->select();
    $num = ProductTask::where(['id'=>$p_id])->value('task_qty');
    $x_num = 0;
    foreach ($yanse as $item){
        $x_num += $item['complete_qty'];
    }
    if($x_num == $num){
        return 1;
    }else{
        return 0;
    }
}
function cut_str($str,$sign,$number){
    $array=explode($sign, $str);
    $length=count($array);
    if($number<0){
        $new_array=array_reverse($array);
        $abs_number=abs($number);
        if($abs_number>$length){
            return 'error';
        }else{
            return $new_array[$abs_number-1];
        }
    }else{
        if($number>=$length){
            return 'error';
        }else{
            return $array[$number];
        }
    }
}