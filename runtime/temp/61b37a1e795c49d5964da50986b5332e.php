<?php /*a:2:{s:80:"I:\Project\WebServer\www\project\Hy\application\index\view\order\order_edit.html";i:1541514429;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1541478155;}*/ ?>
﻿  <!doctype html>
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
<div class="x-body ">
  <form  class="layui-form">
    <div class="layui-form-item">
      <label for="order_id" class="layui-form-label">订单编号</label>
      <span style="color: red">*</span>
      <div class="layui-input-inline">
        <input type="text" id="order_id" value="<?php echo htmlentities($orderRow['order_id']); ?>" disabled lay-verify="required" autocomplete="off" class="layui-input" >
        <input type="hidden" id="id" value="<?php echo htmlentities($orderRow['id']); ?>"  lay-verify="required" name="id" autocomplete="off" class="layui-input" >
        <p id="pLog" style="color:red"></p>
      </div>
    </div>

    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">订单说明</label>
      <div class="layui-input-block">
        <textarea  placeholder="请输入内容" name="order_content" class="layui-textarea"><?php echo htmlentities($orderRow['order_content']); ?></textarea>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="delivery_time" class="layui-form-label">交货日期</label>
      <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
        <input type="text" name="delivery_time"  value="<?php echo htmlentities($orderRow['delivery_time']); ?>" class="layui-input" id="data" lay-key="1">
      </div>
      <script>
          layui.use('laydate', function(){
              var laydate = layui.laydate;

              //执行一个laydate实例
              laydate.render({
                  elem: '#data' //指定元素
              });
          });
      </script>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">收款</label>
      <div class="layui-input-block">
        <input type="checkbox" name="receivables"  <?php if(1==$orderRow['receivables']): ?>checked=""<?php endif; ?>   lay-skin="switch" lay-filter="switchTest" lay-text="是|否"><div class="layui-unselect layui-form-switch" lay-skin="_switch"><em>否</em><i></i></div>
      </div>
    </div>

    <div class="layui-form-item">
      <label for="client_id" class="layui-form-label">客户编号</label>
      <div class="layui-input-inline">
        <input type="text" id="client_id" name="client_id" value="<?php echo htmlentities($orderRow['client_id']); ?>" autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="order_price" class="layui-form-label">订单报价</label>
      <span style="color: red">*</span>
      <div class="layui-input-inline">
        <input type="text" id="order_price" name="order_price"  value="<?php echo htmlentities($orderRow['order_price']); ?>" lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="prepare" class="layui-form-label">备料</label>
      <div class="layui-input-inline">
        <input type="text" id="prepare" name="prepare"  value="<?php echo htmlentities($orderRow['prepare']); ?>"  autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">发货</label>
      <div class="layui-input-block">
        <input type="checkbox" name="deliver_goods" <?php if(1==$orderRow['deliver_goods']): ?>checked=""<?php endif; ?>  lay-skin="switch" lay-filter="switchTest" lay-text="是|否"><div class="layui-unselect layui-form-switch" lay-skin="_switch"><em>否</em><i></i></div>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">是否完成</label>
      <div class="layui-input-block">
        <input type="checkbox" name="if_complete" <?php if(1==$orderRow['if_complete']): ?>checked=""<?php endif; ?>  lay-skin="switch" lay-filter="switchTest" lay-text="是|否"><div class="layui-unselect layui-form-switch" lay-skin="_switch"><em>否</em><i></i></div>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="client_prj_id" class="layui-form-label">客户项目编号</label>
      <div class="layui-input-inline">
        <input type="text" id="client_prj_id" name="client_prj_id"  value="<?php echo htmlentities($orderRow['client_prj_id']); ?>"  autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="client_prj_id" class="layui-form-label">申请人</label>
      <div class="layui-input-inline">
        <input type="text" id="application" name="application"  value="<?php echo htmlentities($orderRow['application']); ?>"  autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="client_prj_id" class="layui-form-label">下单时间</label>
      <div class="layui-input-inline">
        <input type="date" id="order_time" name="order_time"  value="<?php echo htmlentities($orderRow['order_time']); ?>"  autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="client_prj_id" class="layui-form-label">评审</label>
      <div class="layui-input-inline">
        <input type="text" id="review_content" name="review_content"  autocomplete="off" class="layui-input" value="<?php echo htmlentities($orderRow['review_content']); ?>">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-submit lay-filter="addId" >
        修改
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
            $.post("<?php echo url('index/Order/editOrder'); ?>",data.field,function(info){
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