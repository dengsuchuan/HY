<?php
/**
 * Created by PhpStorm.
 * User: 17424
 * Date: 2018/8/11
 * Time: 15:20
 */

namespace app\index\widget;


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
           echo 'red';
           return;
       }
       if(!file_exists('.'.$data[$tip]))//文件无效
       {
           echo 'red';
           return;
       }
       echo 'green';
    }

}