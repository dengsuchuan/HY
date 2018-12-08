<?php /*a:2:{s:87:"I:\Project\WebServer\www\project\Hy\application\index\view\order\order_edit_detail.html";i:1541478155;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1541478155;}*/ ?>
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
      <label for="order_detail_code" class="layui-form-label">订单号</label>
      <span style="color: red">*</span>
      <div class="layui-input-inline">
        <input type="text" id="order_detail_code" value="<?php echo htmlentities($ordeDetailRow['order_detail_code']); ?>" disabled lay-verify="required" autocomplete="off" class="layui-input" >
        <input type="hidden" id="id" value="<?php echo htmlentities($ordeDetailRow['id']); ?>" name="id" disabled lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="plan_qty" class="layui-form-label">计划数量</label>
      <span style="color: red">*</span>
      <div class="layui-input-inline">
        <input type="text" id="plan_qty"  name="plan_qty" value="<?php echo htmlentities($ordeDetailRow['plan_qty']); ?>"  lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="arrange" class="layui-form-label">加工安排</label>
        <div class="layui-input-inline" style="width: 120px;">
          <select  name="arrange">
            <option value="整体外协" <?php if($ordeDetailRow['arrange'] == '整体外协'): ?> selected <?php endif; ?>>整体外协</option>
            <option value="自加工" <?php if($ordeDetailRow['arrange'] == '自加工'): ?> selected <?php endif; ?>>自加工</option>
            <option value="标件不加工" <?php if($ordeDetailRow['arrange'] == '标件不加工'): ?> selected <?php endif; ?>>标件不加工</option>
            <option value="外协完成" <?php if($ordeDetailRow['arrange'] == '外协完成'): ?> selected <?php endif; ?>>外协完成</option>
          </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="company" class="layui-form-label">单位</label>
      <div class="layui-input-inline">
        <div class="layui-input-inline"  style="width: 100px;">
          <select name="company" >
            <option value="件" <?php if($ordeDetailRow['company'] == '件'): ?> selected <?php endif; ?>>件</option>
            <option value="套" <?php if($ordeDetailRow['company'] == '套'): ?> selected <?php endif; ?>>套</option>
          </select>
        </div>
      </div>
    </div>
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">加工内容</label>
      <div class="layui-input-block">
        <textarea  placeholder="请输入内容"   name="content" class="layui-textarea"><?php echo htmlentities($ordeDetailRow['content']); ?></textarea>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="date_delivery" class="layui-form-label">交货日期</label>
      <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
        <input type="text" name="date_delivery"  value="<?php echo htmlentities($ordeDetailRow['date_delivery']); ?>" class="layui-input" id="data" lay-key="1">
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
      <label for="purchase_id" class="layui-form-label">备料单编号</label>
      <div class="layui-input-inline">
        <input type="text" id="client_id" name="purchase_id" value="<?php echo htmlentities($ordeDetailRow['purchase_id']); ?>" autocomplete="off" class="layui-input" >
      </div>
    </div>


    <div class="layui-form-item">
      <label for="order_price" class="layui-form-label">材料来源</label>
      <span style="color: red">*</span>
      <div class="layui-input-inline">
        <select name="material_source" >
          <option value="来料" <?php if($ordeDetailRow['material_source'] == '来料'): ?> selected <?php endif; ?> >来料</option>
          <option value="外购" <?php if($ordeDetailRow['material_source'] == '外购'): ?> selected <?php endif; ?> >外购</option>
          <option value="自备"  <?php if($ordeDetailRow['material_source'] == '自备'): ?> selected <?php endif; ?>>自备</option>
        </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="prepare" class="layui-form-label">入库数量</label>
      <div class="layui-input-inline">
        <input type="text" id="prepare" name="warehousing"  value="<?php echo htmlentities($ordeDetailRow['warehousing']); ?>"  autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">是否显示</label>
      <div class="layui-input-block">
        <input type="checkbox"  <?php if(1==$ordeDetailRow['if_show']): ?>checked=""<?php endif; ?>  name="if_show" lay-skin="switch" lay-filter="switchTest" lay-text="是|否">
        <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="create_name" class="layui-form-label">创建人</label>
      <div class="layui-input-inline">
        <input type="text" id="create_name" disabled  value="<?php echo htmlentities($ordeDetailRow['create_name']); ?>"  autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="create_time" class="layui-form-label">创建时间</label>
      <div class="layui-input-inline">
        <input type="text" id="create_time" disabled  value="<?php echo htmlentities($ordeDetailRow['create_time']); ?>"  autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="modify_name" class="layui-form-label">修改人</label>
      <div class="layui-input-inline">
        <input type="text" id="modify_name" name="modify_name"  value="<?php echo htmlentities(app('session')->get('user.user_name')); ?>"  autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="modify_name" class="layui-form-label">备注</label>
      <div class="layui-input-inline">
        <input type="text" id="remark" name="remark"  value="<?php echo htmlentities($ordeDetailRow['remark']); ?>"  autocomplete="off" class="layui-input" >
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
            $.post("<?php echo url('index/Order/editOrderDetail'); ?>",data.field,function(info){
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