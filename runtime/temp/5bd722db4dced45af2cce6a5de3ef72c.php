<?php /*a:2:{s:85:"I:\Project\WebServer\www\project\Hy\application\index\view\test_record\edit_show.html";i:1542032945;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1541478155;}*/ ?>
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
        <?php if(is_array($testRecord) || $testRecord instanceof \think\Collection || $testRecord instanceof \think\Paginator): $i = 0; $__LIST__ = $testRecord;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
        <div class="layui-form-item">
            <label class="layui-form-label">检验记录编号</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="check_id" value="<?php echo htmlentities($list['check_id']); ?>" disabled>
                <input type="hidden" class="layui-input" name="id" value="<?php echo htmlentities($list['id']); ?>" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属生产记录</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="log_id" value="<?php echo htmlentities($list['log_id']); ?>" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">名义尺寸</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="nromal_dim" value="<?php echo htmlentities($list['nromal_dim']); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">实际尺寸1</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="real_dim1" value="<?php echo htmlentities($list['real_dim1']); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">实际尺寸2</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="real_dim2" value="<?php echo htmlentities($list['real_dim2']); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="remark" value="<?php echo htmlentities($list['remark']); ?>">
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="layui-form-item">
            <label class="layui-form-label">
            </label>
            <button class="layui-btn" lay-submit lay-filter="addId">
                提交修改
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form'], function(){
        $ = layui.jquery;
        var form = layui.form,layer = layui.layer;

        //监听提交
        form.on('submit(addId)', function(data){
            //console.log(data);
            $.post("<?php echo url('index/TestRecord/editSave'); ?>",data.field,function(info){
                if (info) {
                    layer.alert("修改成功", {icon: 6},function () {
                        window.parent.location.reload();  //刷新父级页面
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前弹出层
                        parent.layer.close(index);
                    });
                }else{
                    layer.alert("修改失败", {icon: 5});
                }
            },'json');
            return false;
        });
    });
</script>
</body>

</html>