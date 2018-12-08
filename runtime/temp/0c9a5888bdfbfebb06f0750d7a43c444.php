<?php /*a:2:{s:88:"I:\Project\WebServer\www\project\Hy\application\index\view\bao_jia\delivery-details.html";i:1544244861;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
﻿ <!doctype html>
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
  <?php if($show): ?>
  <xblock>
    <a class="layui-btn"  target="_blank" href="<?php echo url('index/BaoJia/deliveryDetails',['deliverId'=>$deliveryId,'show'=>'0']); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>
    <button class="layui-btn" onclick="x_admin_show('选择明细','<?php echo url('index/BaoJia/selectOrder',['deliveryId'=>$deliveryId]); ?>')"><i class="layui-icon"></i>添加订单</button>
    <!--<a class="layui-btn" href="javascript:location.replace(location.href);">刷新</a>-->
  </xblock>
  <?php endif; ?>
  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 5px;">
    <legend>送货单明细</legend>
  <div class="layui-row">
    <div class="container-wrap">
      <div class="box-1">
        <table class="layui-table">
          <thead>
          <tr>
            <?php if($show): ?>
            <th width="40px;">操作</th>
            <?php endif; ?>
            <!--<th>明细编号</th>-->
            <th>序号</th>
            <th>订单明细</th>
            <th width="70">送货数量</th>
            <th>内图编号</th>
            <th>外图编号</th>
            <th>图纸名称</th>
            <th>材料</th>
            <th>图纸工艺</th>
            <th>客户项目号</th>
            <th>版本</th>
            <th>下单时间</th>
            <th>申请人</th>
            <th>产品价格</th>
            <th>备注</th>
          </tr>
          </thead>
          <?php if($deliverOrderCount): ?>
          <tbody>
            <?php $i = 1;$count = 1; if(is_array($orderDatailInfo) || $orderDatailInfo instanceof \think\Collection || $orderDatailInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $orderDatailInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
            <tr>
              <?php if($show): ?>
              <td>
                <a title="删除" href="javascript:void(0);" onclick="delete_(this,'<?php echo htmlentities($info['deliveryInfoId']); ?>')" style="color: red">
                  <i  style="color:red;" class="layui-icon"></i>
                </a>
                <!--<a href="#" onclick="updateNum('<?php echo htmlentities($info['deliveryInfoId']); ?>')" style="color:green;">修改</a>-->
                <a href="#" onclick="x_admin_show('修改明细','<?php echo url('index/BaoJia/editOrder',['id'=>$info['id'],'quantity'=>$info['quantity'],'remarks'=>$info['remarks']]); ?>',500,300)" style="color:green;">
                  <i style="color: green" class="layui-icon"></i>
                </a>
              </td>
              <?php endif; 
               $isTask = getIsTask($info['id']);
               ?>
              <!--<td><?php echo htmlentities($info['deliveryInfoId']); ?></td>-->
              <td><?php echo htmlentities($count); ?></td>
              <?php $count++ ?>
              <td><?php echo htmlentities($info['orderCode']); ?></td>
              <td><?php echo htmlentities($info['quantity']); ?>
                <!--<div class="layui-inline">-->
                  <!--<div class="layui-input-inline">-->
                    <!--<input type="number" style="width: 50px;" id="<?php echo htmlentities($info['deliveryInfoId']); ?>" autocomplete="off" class="layui-input" value="<?php echo htmlentities($info['quantity']); ?>">-->
                  <!--</div>-->
                <!--</div>-->
              </td>
              <td>
                <a href="javascript:;" onclick="x_admin_show('<span class=\' layui-bg-blue\'><?php echo htmlentities($info['external']); ?></span> 的图纸明细','<?php echo url('index/blueprint/blueprintInfo',['codeId'=>$info['external'],'key'=>'internal']); ?>')" ><span style="color: #1E9FFF"><?php echo htmlentities($info['external']); ?></span></a>
              </td>
              <td>
                <a href="javascript:;" onclick="x_admin_show('<span class=\' layui-bg-blue\'><?php echo htmlentities($info['waiExternal']); ?></span> 的图纸明细','<?php echo url('index/blueprint/blueprintInfo',['codeId'=>$info['waiExternal'],'key'=>'externa']); ?>')" ><span style="color: #1E9FFF"><?php echo htmlentities($info['waiExternal']); ?></span></a>
              </td>
              <td><?php echo htmlentities($info['drawingName']); ?></td>
              <td><?php echo htmlentities($info['materialName']); ?></td>
              <?php $blueprintInfoList = getOrderSelect($info['orderCode']);?>
              <td class="td-manage">



                <?php if($blueprintInfoList['files_state']==0||$blueprintInfoList['drawing_externa_id']==""||!widget('Widget/drawing_check',['drawing_id'=>$blueprintInfoList['drawing_externa_id']])): ?><!-- 不继承或者外图继承无效 -->
                <button title="图纸" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的图纸文件',
          '<?php echo url('index/blueprint/is_DrawingFiles',['id'=>$blueprintInfoList['id'],'key'=>'wai','drawing_num'=>$blueprintInfoList['drawing_detail_id']]); ?>')" href="javascript:;">
                  <span class="layui-badge layui-bg-<?php echo widget('Widget/files_check',['id'=>$blueprintInfoList['id'],'tip'=>'abroad']); ?>">图</span></button>
                <?php elseif($blueprintInfoList['files_state']==1): ?> <!-- 继承 -->
                <button title="图纸" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的图纸文件',
          '<?php echo url('index/blueprint/is_outDrawing',['id'=>$blueprintInfoList['drawing_externa_id']]); ?>')" href="javascript:;"><span class="layui-badge layui-bg-orange">图</span></button>
                <?php endif; ?>
                <button title="模型" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的3d模型文件',
          '<?php echo url('index/blueprint/is_DrawingFiles',['id'=>$blueprintInfoList['id'],'key'=>'nei','drawing_num'=>$blueprintInfoList['drawing_detail_id']]); ?>')" href="javascript:;"><span class="layui-badge layui-bg-<?php echo widget('Widget/files_check',['id'=>$blueprintInfoList['id'],'tip'=>'within']); ?>">3D</span></button>
                <button title="程序单" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的程序单文件',
          '<?php echo url('index/blueprint/is_DrawingFiles',['id'=>$blueprintInfoList['id'],'key'=>'cheng','drawing_num'=>$blueprintInfoList['drawing_detail_id']]); ?>')" href="javascript:;"><span class="layui-badge layui-bg-<?php echo widget('Widget/files_check',['id'=>$blueprintInfoList['id'],'tip'=>'engineering']); ?>">程</span></button>
                <?php if($blueprintInfoList['is_gongxu'] !=0): ?>
                <button title="工"  href="javascript:;" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的工艺信息','<?php echo url('index/blueprint/process',['drawing_detail_id'=>$blueprintInfoList['drawing_detail_id']]); ?>')" ><span class="layui-badge layui-bg-green">工</span></button>
                <?php else: ?>
                <button title="工"  href="javascript:;" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的工艺信息','<?php echo url('index/blueprint/process',['drawing_detail_id'=>$blueprintInfoList['drawing_detail_id']]); ?>')" ><span  class="layui-badge layui-bg-blue">工</span></button>
                <?php endif; ?>




              </td>
              <td><?php echo htmlentities($info['client_prj_id']); ?></td>
              <td><?php echo htmlentities($info['materialVersion']); ?></td>
              <td><?php echo htmlentities($info['order_time']); ?></td>
              <td><?php echo htmlentities($info['application']); ?></td>
              <td>￥<?php echo htmlentities($info['price']); ?></td>
              <td><?php echo htmlentities($info['remarks']); ?></td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
          <?php endif; ?>
        </table>
      </div>
    </div>
  </div>
  </fieldset>
</div>
<script>
    /*删除*/
    function delete_(obj,id){
        layer.confirm('从发货单列表中删除？',function(index){
            var url = "<?php echo url('/index/BaoJia/delOrder'); ?>";
            var postData ={"id":id};
            $.post(url,postData,function (result) {
                if(result){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                    $("#sx").click();
                }else {
                    layer.alert("删除失败", {icon: 5});
                }
            },"json");
        });
    }

    function updateNum(id){
        var number = $("#"+id+"").val();
        layer.confirm("明细: <span style='color: green'>"+id+"</span> <br>发货数量改为: <span style='color: green'>"+number+"</span> <br> 确认吗？",function(index){
            var url = "<?php echo url('/index/BaoJia/updateNum'); ?>";
            var postData ={"deliveryInfoId":id,'quantity':number};
            $.post(url,postData,function (result) {
                if(result){
                    layer.msg('修改成功!',{icon:1,time:1000});
                    window.location.reload();  //刷新父级页面
                }else {
                    layer.alert("修改失败", {icon: 5});
                }
            },"json");
        });
    }
</script>
</body>
</html>