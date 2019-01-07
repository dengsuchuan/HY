<?php /*a:2:{s:86:"I:\Project\WebServer\www\project\Hy\application\index\view\task\edit_product_task.html";i:1542033351;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
﻿  <!doctype html>
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
<div class="x-body ">
  <form  class="layui-form">
    <div class="layui-form-item">
      <label for="process_name" class="layui-form-label">任务编号</label>
      <div class="layui-input-inline">
        <input type="text" id="process_name" value="<?php echo htmlentities($taskrow['task_id']); ?>" disabled lay-verify="required" autocomplete="off" class="layui-input" >
        <input type="hidden" id="id" name="id" value="<?php echo htmlentities($taskrow['id']); ?>" disabled lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="process_price" class="layui-form-label">订单明细</label>
      <div class="layui-input-inline">
        <input type="text" id="process_price" value="<?php echo htmlentities(getDrawingDetailId1($taskrow['order_detial_id'])); ?>" disabled   lay-verify="required"  autocomplete="off" class="layui-input"  placeholder="￥">
      </div>
    </div>
    <div class="layui-form-item">
      <label for="process_price" class="layui-form-label">任务数量</label>
      <div class="layui-input-inline">
        <input type="text" id="cost_price" name="task_qty"  lay-verify="required" value="<?php echo htmlentities($taskrow['task_qty']); ?>" autocomplete="off" class="layui-input"  >
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">是否完成</label>
      <div class="layui-input-block">
        <input type="checkbox"  name="if_completr"    <?php if(1==$taskrow['if_completr']): ?>checked=""<?php endif; ?>  lay-skin="switch" lay-filter="switchTest" lay-text="是|否">
        <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
      </div>
    </div>

    <!--<div class="layui-form-item">-->
      <!--<label class="layui-form-label">设备编号</label>-->
      <!--<div class="layui-input-block">-->
        <!--<select name="eqpmt_id" lay-verify="required">-->
          <!--<option value=""></option>-->
            <!--<?php if(is_array($equipmentInfo) || $equipmentInfo instanceof \think\Collection || $equipmentInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $equipmentInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>-->
            <!--<option value="<?php echo htmlentities($info['id']); ?>"  <?php if($taskrow['eqpmt_id'] == $info['id']): ?> selected <?php endif; ?>><?php echo htmlentities($info['eqpmt_id']); ?>&#45;&#45;<?php echo htmlentities($info['eqpmt_name']); ?> </option>-->
            <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
          <!--</select>-->
      <!--</div>-->
    <!--</div>-->

    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">备注</label>
      <div class="layui-input-block">
        <textarea class="layui-textarea"  id="remark" name="remark"><?php echo htmlentities($taskrow['remark']); ?></textarea>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="process_price" class="layui-form-label">创建人</label>
      <div class="layui-input-inline">
        <input type="text" id="create_name" name="create_name" disabled  lay-verify="required"  value="<?php echo htmlentities($taskrow['create_name']); ?>" autocomplete="off" class="layui-input"  >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="process_price" class="layui-form-label">修改人</label>
      <div class="layui-input-inline">
        <input type="text" disabled   lay-verify="required"  value="<?php echo htmlentities(app('session')->get('user.user_name')); ?>" autocomplete="off" class="layui-input"  >
        <input type="hidden" id="modify_name" name="modify_name"  lay-verify="required"  value="<?php echo htmlentities(app('session')->get('user.user_name')); ?>" autocomplete="off" class="layui-input"  >
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-submit lay-filter="addId">
        确认修改
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
            $.post("<?php echo url('index/Task/editTask'); ?>",data.field,function(info){
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