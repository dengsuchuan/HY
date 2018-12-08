<?php /*a:2:{s:93:"I:\Project\WebServer\www\project\Hy\application\index\view\equipment\add-equipment-infos.html";i:1541478155;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1541478155;}*/ ?>
 <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>恒易管理</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

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
            <label class="layui-form-label">编号</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" name="eqpmt_id">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">类型</label>
            <div class="layui-input-inline">
                <div class="layui-input-inline">
                    <select name="eqpmt_type_id" lay-verify="required" lay-search="">
                        <option value=""></option>
                        <optgroup label="选择类型">
                        <?php if(is_array($equipmentType) || $equipmentType instanceof \think\Collection || $equipmentType instanceof \think\Paginator): $i = 0; $__LIST__ = $equipmentType;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$equipmentTypeList): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo htmlentities($equipmentTypeList['id']); ?>"><?php echo htmlentities($equipmentTypeList['eqpmt_type']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">名称</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" name="eqpmt_name">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">模型</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" name="eqpmt_model">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">生产地</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" name="manufacturer">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">正在运行</label>
            <div class="layui-input-inline">
                <input type="checkbox" name="is_working" lay-skin="switch" lay-text="是|否" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">生产日期</label>
            <div class="layui-input-inline">
                <input type="text" name="manufacture_date" id="manufacture_date" lay-verify="date" placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">购买日期</label>
            <div class="layui-input-inline">
                <input type="text" name="purchasing_date" id="purchasing_date" lay-verify="date" placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">购买价格</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" name="price">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">当前价值</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" name="current_price">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">卖出日期</label>
            <div class="layui-input-inline">
                <input type="text" name="sell_date" id="sell_date" lay-verify="date" placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">使用者</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" name="user">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <button class="layui-btn" lay-submit lay-filter="addId" >
                确认添加
            </button>
        </div>
    </form>
</div>
</body>
<script>
    //日期
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#manufacture_date' //指定元素
        });
        laydate.render({
            elem: '#purchasing_date' //指定元素
        });
        laydate.render({
            elem: '#sell_date' //指定元素
        });
    });
    layui.use(['form'], function(){
        $ = layui.jquery;
        var form = layui.form,layer = layui.layer;
        //监听提交
        form.on('submit(addId)', function(data){
            //console.log(data);
            $.post("<?php echo url('index/Equipment/saveEquipmentInfo'); ?>",data.field,function(info){
                if (info) {
                    layer.alert("添加成功", {icon: 6},function () {
                        window.parent.location.reload();  //刷新父级页面
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前弹出层
                        parent.layer.close(index);
                    });
                }else{
                    layer.alert("添加失败", {icon: 5});
                }
            },'json');
            return false;
        });
    });
</script>

</html>