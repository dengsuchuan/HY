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
    return $clientName;
}

function getMateria($id){
    $clientName = MaterialShape::where("id","$id")->value("shape");
    return $clientName;
}