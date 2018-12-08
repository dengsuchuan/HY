<?php /*a:2:{s:86:"I:\Project\WebServer\www\project\Hy\application\index\view\order\order_detail_add.html";i:1542470187;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
 <style>
   .layui-form-label {
     float: left;
     display: block;
     width: 80px;
     font-weight: 100;
     line-height: 20px;
     text-align: right;
     padding: 9px 15px;
   }
 </style>
<body>
<div class="x-body ">
  <form  class="layui-form">
    <?php if(is_array($blueprintInfo) || $blueprintInfo instanceof \think\Collection || $blueprintInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $blueprintInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
    <div style="border: 1px #636363 solid;padding-top: 4px;margin: 5px;">
      <div class="layui-form-item">

        <div class="layui-inline">
          <label class="layui-form-label">明细编号</label>
          <div class="layui-input-inline" style="width: 200px;">
            <input type="text" value="<?php echo htmlentities($info['drawing_detail_id']); ?>"  disabled  required="" lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
            <input type="hidden" value="<?php echo htmlentities($info['drawing_detail_id']); ?>"  name="drawing_detail_code[]"  >
            <input type="hidden" value="<?php echo htmlentities($info['id']); ?>"    name="drawing_detail_id[]" required="" lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
          <input type="hidden" value="<?php echo htmlentities($type); ?>" name="type">
          </div>
        </div>
        <div class="layui-inline">
          <label class="layui-form-label">产品名称</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" disabled value="<?php echo htmlentities($info['drawing_name']); ?>" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-inline">
          <label class="layui-form-label">材料类型</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" disabled value="<?php echo htmlentities($info['drawing_type']); ?>" autocomplete="off" class="layui-input">
          </div>
        </div>
        <hr>
        <br>

        <div class="layui-inline">
          <label class="layui-form-label">订单号</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" disabled value="<?php echo htmlentities($orderCode); ?>" autocomplete="off"  class="layui-input" name="ordercode">
            <input type="hidden" disabled value="<?php echo htmlentities($orderId); ?>" name="order_id[]" autocomplete="off" class="layui-input">
            <input type="hidden" disabled value="<?php echo htmlentities($orderId); ?>" name="order" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-inline">
          <label class="layui-form-label">订单数量</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="number" value="1" id="order_num<?php echo htmlentities($info['drawing_detail_id']); ?>" oninput="orderinput('<?php echo htmlentities($info['drawing_detail_id']); ?>')"  name="order_qty[]" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-inline">
          <label class="layui-form-label">计划数量</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="number" value="1"  id="jihua_num<?php echo htmlentities($info['drawing_detail_id']); ?>" oninput="jiahua('<?php echo htmlentities($info['drawing_detail_id']); ?>')" name="plan_qty[]" autocomplete="off" class="layui-input">
          </div>
        </div>
        <!--<div class="layui-inline">-->
          <!--<label class="layui-form-label">加工安排</label>-->
          <!--<div class="layui-input-inline" style="width: 100px;">-->
            <!--<select  name="arrange[]">-->
              <!--<option value="是">是</option>-->
              <!--<option value="否">否</option>-->
            <!--</select>-->
          <!--</div>-->
        <!--</div>-->
        <div class="layui-inline">
          <label class="layui-form-label">是否加工</label>
          <div class="layui-input-block">
            <input type="checkbox" name="arrange[]" lay-skin="switch" lay-filter="switchTest" lay-text="是|否"><div class="layui-unselect layui-form-switch" lay-skin="_switch"><em>否</em><i></i></div>
          </div>
        </div>


        <!--<div class="layui-inline">-->
          <!--<label class="layui-form-label">加工安排</label>-->
          <!--<div class="layui-input-inline" style="width: 100px;">-->
            <!--<select  name="arrange[]">-->
              <!--<option value="整体外协">整体外协</option>-->
              <!--<option value="自加工" selected>自加工</option>-->
              <!--<option value="标件不加工">标件不加工</option>-->
              <!--<option value="外协完成">外协完成</option>-->
            <!--</select>-->
          <!--</div>-->
        <!--</div>-->
        <div class="layui-inline">
          <label class="layui-form-label">单位</label>
          <div class="layui-input-inline"  style="width: 100px;">
            <select name="company[]" >
              <option value="件">件</option>
              <option value="套">套</option>
            </select>
          </div>
        </div>
        <div class="layui-inline">
          <label class="layui-form-label">加工内容</label>
          <div class="layui-input-inline" style="width: 340px;">
            <input type="text" name="content[]" autocomplete="off" class="layui-input">
          </div>
        </div>



        <div class="layui-inline">
          <label class="layui-form-label">交货日期</label>

          <div class="layui-inline"  style="width: 100px;"> <!-- 注意：这一层元素并不是必须的 -->
            <input type="text" class="layui-input" name="date_delivery[]" id="data" lay-key="1">
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
        <div class="layui-inline">
          <label class="layui-form-label">备料单编号</label>
          <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="purchase_id[]" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-inline">
          <label class="layui-form-label">材料来源</label>
          <div class="layui-input-inline" style="width: 100px;">
            <select name="material_source[]" >
              <option value="来料">来料</option>
              <option value="外购">外购</option>
              <option value="自备">自备</option>
            </select>
          </div>
        </div>
        <!--<div class="layui-inline">-->
          <!--<label class="layui-form-label">入库数量</label>-->
          <!--<div class="layui-input-inline" style="width: 100px;">-->
            <!--<input type="text" name="warehousing[]" autocomplete="off" class="layui-input">-->
          <!--</div>-->
        <!--</div>-->

        <?php switch($a): case "1": ?>
        <div class="layui-inline">
          <label class="layui-form-label">所属内图编号</label>
          <div class="layui-input-inline" style="width: 300px;">
            <input type="text" autocomplete="off" disabled name="drawing_externa_or_internal_id[]" value="<?php echo htmlentities($info['drawing_internal_id']); ?>" class="layui-input">
          </div>
        </div>
        <?php break; case "0": ?>
        <div class="layui-inline">
          <label class="layui-form-label">所属外图编号</label>
          <div class="layui-input-inline" style="width: 300px;">
            <input type="text" autocomplete="off" disabled name="drawing_externa_or_internal_id[]" value="<?php echo htmlentities($info['drawing_externa_id']); ?>" class="layui-input">

          </div>
        </div>
        <?php break; default: ?>default
        <?php endswitch; ?>



        <div class="layui-inline">
          <label class="layui-form-label">备注</label>
          <div class="layui-input-inline" style="width: 500px;">
            <input type="text" autocomplete="off"  name="remark[]"  class="layui-input" >
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
      <div class="layui-form-item">
        <label class="layui-form-label"></label>
        <button class="layui-btn" lay-submit lay-filter="addId" id="butt" >
          增加
        </button>

      </div>
  </form>
</div>
<script>
  function orderinput(d_id){
      var order_num = $("#order_num"+d_id).val();
      if(order_num < 1){
          $("#order_num"+d_id).val(1);
          $("#jihua_num"+d_id).val(1);
      }

      $("#jihua_num"+d_id).val(order_num);
      // alert(order_num);
  }

  function jiahua(d_id){
      var order_num = $("#jihua_num"+d_id).val();
      if(order_num < 1){
          $("#jihua_num"+d_id).val(1);
      }
  }
    $(function () {
       var code = <?php echo htmlentities($code); ?>;
       var state = <?php echo htmlentities($state); ?>;
       // alert(code);
       //  $ = layui.jquery;
       //  var layer = layui.layer;
       //  $ = layui.jquery;
       //  var form = layui.form,layer = layui.layer;
       if (code === -5){
           alert('暂无数据或者数据已添加');
           window.parent.location.reload();  //刷新父级页面
       }
       if(code === -4){
           alert('图纸明细为以下编码: '+'<?php echo htmlentities($msg); ?>'+'已经入库！');
           if(state === -10){
               window.parent.location.reload();  //刷新父级页面
           }
       }
    });
    layui.use(['form'], function(){
        $ = layui.jquery;
        var form = layui.form,layer = layui.layer;

        //监听提交
        form.on('submit(addId)', function(data){
            // $("#butt").attr("disabled", true);
            //console.log(data);
            $.post("<?php echo url('index/Order/addOrderDetail'); ?>",data.field,function(info){
                if (info) {
                    layer.alert("添加成功", {icon: 6},function () {
                        window.parent.parent.location.reload();  //刷新父级页面
                        // 获得frame索引
                        var index = parent.parent.layer.getFrameIndex(window.name);
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
</body>

</html>