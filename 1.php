<?php
class MyArray{
    private $data = null;
    private $size = 0;

    public function __construct(){
        $this->data = [];
    }

    // 添加元素
    public function add($e){
        $this->data[] = $e;
        $this->size ++;
    }

    // 获取数组数据
    public function getData(){
        return $this->data;
    }

    // 获取数组长度
    public function getLength(){
        return $this->size;
    }
    // 向index位置插入$e
    public function addIndex($index,$e){
        if($index < 0){
            return "参数错误";
        }
        for ($i = $this->size -1;$i>=$index;$i--){
            $this->data[$i+1] = $this->data[$i];
            $this->data[$index+1] = $e;
            $this->size ++;
        }
    }

    public function addFront($e){
        $this->addIndex(0,$e);
    }
}


$arrat = new MyArray();
$arrat->add(5);
$arrat->add(5);
echo "<pre>";
//echo $arrat->getLength();
$arrat->addIndex(1,4);
$arrat->addFront(66);
var_dump($arrat->getData());