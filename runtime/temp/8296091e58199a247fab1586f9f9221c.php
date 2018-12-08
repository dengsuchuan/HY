<?php /*a:2:{s:81:"I:\Project\WebServer\www\project\Hy\application\index\view\quoted\add-quoted.html";i:1543141639;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
 <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>恒易管理</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="keywords" content="机械,过程管理,制造业">
    <link rel="shortcut icon" href="/static/index/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/static/index/css/font.css">
    <link rel="stylesheet" href="/static/index/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/static/index/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/static/index/js/xadmin.js"></script>
    <style>
        .container-wrap {
            width: 100%;
            height: 100%;
            white-space: nowrap;
            overflow: hidden;
            overflow-x: scroll; /* 1 */
            -webkit-backface-visibility: hidden;
            -webkit-perspective: 1000;
            -webkit-overflow-scrolling: touch; /* 2 */
            text-align: justify; /* 3 */
        &::-webkit-scrollbar {
             display: none;
         }
        }

        .container > div {
            display: inline-block;
            height: 50px;
            color: #fff;
            text-align: center;
            line-height: 50px;
        }
        .box-1 {
            width:100%;
        }

    </style>
</head>
<body>
<div class="x-body">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">报价明细编号</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="quote_info_id" value="<?php echo htmlentities($quote_info_id); ?>" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">订单明细编号</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="order_info_id" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">外图编号</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="waitu_id" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">内图编号</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="neitu_id" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">产品名称</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="chanpin_name" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">材料</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="cailiao" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">形状</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="xingzhuang" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">尺寸</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="chicun" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">图纸工艺</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="tuzhigongyi" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">数量</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="shuliang" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">单重</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="danzhong" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">总重</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="zongjia" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">单材料费</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="dancailiaofeiyon" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">总材料费</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="zongcailiaofeiyon" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">精坯加工费</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="jingpijiagongfeiyon" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">工序和定额</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="gongxuanddinge" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">加工单价</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="jiagongdanjia" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">加工总价</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="jiagongzongjia" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">利润率</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="lirunlv" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">管理费率</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="guanlifeilv" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">税率</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="shuilv" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">产品单价</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="chanpindanjia" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">含税单价</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="hanshuidanjia" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">产品总价</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="chanpinzongjia" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">确认单价</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="querendanjia" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="beizhu" value="" >
            </div>
        </div>
        <input type="hidden" name="create_name" value="<?php echo htmlentities(app('session')->get('user.user_name')); ?>" >

        <div class="layui-form-item">
            <label class="layui-form-label">
            </label>
            <button class="layui-btn" lay-submit lay-filter="addId">
                确认添加
            </button>
        </div>
    </form>
</div>
<script>
$(function () {
    layui.use(['form'], function(){
        $ = layui.jquery;
        var form = layui.form,layer = layui.layer;
        //监听提交
        form.on('submit(addId)', function(data){
            if(data.field['ifPrice']){
                data.field['ifPrice']="1"
            }else{
                data.field['ifPrice']="0"
            }
            if(data.field['determine']){
                data.field['determine']="1"
            }else{
                data.field['determine']="0"
            }
            layer.msg("添加失败", {time:1000,icon: 5});
            // $.post("<?php echo url('index/Quote/savequote'); ?>",data.field,function(info){
            //     if (info) {
            //         layer.msg("添加成功", {time:1000,icon: 6},function () {
            //             window.parent.location.reload();  //刷新父级页面
            //             // 获得frame索引
            //             var index = parent.layer.getFrameIndex(window.name);
            //             //关闭当前弹出层
            //             parent.layer.close(index);
            //         });
            //     }else{
            //         layer.msg("添加失败", {time:1000,icon: 5});
            //     }
            // },'json');
            return false;
        });
    });
});
</script>
</body>

</html>