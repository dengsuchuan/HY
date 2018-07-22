<?php
/**
 * Created by PhpStorm.
 * User: dengs
 * Date: 2018/6/7 0007
 * Time: 23:20
 */

namespace app\index\controller;


use app\index\common\controller\Base;
use app\index\model\ComparnyM;
use app\index\model\ComparnyP;

class Mould extends Base
{
    public function mould(){
        return $this->view->fetch('mould');
    }

    public function mouldAdd(){
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


        return $this->view->fetch("mould-add");
    }

    //获取M和P的值
    public function getMP($data){
        $strM = "M".date('y').date('m').date('d');
        $mArray = ComparnyM::where("mid","like",$strM."-%")->select(); //查找M的数据

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
    }
}