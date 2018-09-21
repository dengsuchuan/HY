<?php
/**
 * Created by PhpStorm.
 * User: 17424
 * Date: 2018/8/11
 * Time: 15:20
 */

namespace app\index\widget;


use app\index\model\BlueprintOutside;
use app\index\model\DrawingFiles;

class Widget
{
    public function files_check($id,$tip)//测试文件存在否
    {
        /**
         * id=>图纸明细id
         */
       $model = new DrawingFiles();
       $data = $model->get(['drawing_id'=>$id]);
       if(!$data||$data[$tip]=="")//没有文件记录
       {
           echo 'blue';
           return;
       }
       if(!file_exists('.'.$data[$tip]))//文件无效
       {
           echo 'blue';
           return;
       }
       echo 'green';
    }

    public function drawing_check($drawing_id)//继承图纸测试
    {
        $model = new BlueprintOutside();
        $data = $model->get(['drawing_external_id'=>$drawing_id]);
        if($data['files_path']=="")//外图无文件记录
        {
            return false;
        }
        if(!file_exists('.'.$data['files_path']))//文件无效
        {
            return false;
        }
        return true;
    }

}