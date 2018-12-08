<?php /*a:2:{s:87:"I:\Project\WebServer\www\project\Hy\application\index\view\order\order-detail-info.html";i:1543068690;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 5px;">
    <legend>订单明细</legend>
    <div class="layui-row">
      <div class="container-wrap">
        <div class="box-1">
          <table class="layui-table">
            <thead>
            <tr>
              <th>订单编号</th>
              <th>订单内容</th>
              <th>交货日期</th>
              <th>客户简称</th>
              <th>备料</th>
              <th>订单报价</th>
              <th>客户项目号</th>
              <th>完成</th>
              <th>发货</th>
              <th>收款</th>
              <th>评审</th>
              <th>建档时间</th>
              <th>报价</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($orderRow) || $orderRow instanceof \think\Collection || $orderRow instanceof \think\Paginator): $i = 0; $__LIST__ = $orderRow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
            <tr>
              <td> <?php echo htmlentities($info['order_id']); ?></td>
              <td><?php echo htmlentities($info['order_content']); ?></td>
              <td><?php echo htmlentities($info['delivery_time']); ?></td>
              <td><?php echo htmlentities($info['client_id']); ?></td>
              <td><?php echo htmlentities($info['prepare']); ?></td>
              <td><?php echo htmlentities($info['order_price']); ?></td>
              <td>
                <?php echo htmlentities($info['client_prj_id']); ?>
              </td>
              <td>
                <?php if($info['if_complete'] == 1): ?>
                完成
                <?php else: ?>
                未完成
                <?php endif; ?>
              </td>
              <td>
                <?php if($info['deliver_goods']): ?>
                已发货
                <?php else: ?>
                未发货
                <?php endif; ?>
              </td>
              <td>
                <?php if($info['receivables'] == 1): ?>
                已收款
                <?php else: ?>
                未收款
                <?php endif; ?>
              </td>
              <td></td>
              <td><?php echo htmlentities($info['create_time']); ?></td>

              <th>报价</th>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </fieldset>
  <xblock>
    <a class="layui-btn"  target="_blank" href="<?php echo url(); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>

    <button class="layui-btn"  onclick="openLinke('<?php echo htmlentities($info['id']); ?>')"><i class="layui-icon"></i>添加</button>

    <?php if($model == 1): ?>
    <a href="<?php echo url('index/Order/orderDetail',['id'=>$id]); ?>"><button class="layui-btn">隐藏</button></a>
    <?php else: ?>
    <a href="<?php echo url('index/Order/orderDetail',['id'=>$id,'model'=>'1']); ?>"><button class="layui-btn">显示</button></a>
    <?php endif; ?>
    <button class="layui-btn" onclick ="x_admin_show('一键复制','<?php echo url('index/Order/copyOrderDetail',['id'=>$id]); ?>',500,400)">一键复制</button>
    <span class="x-right" style="line-height:40px">共条<?php echo htmlentities($orderDatailInfoC); ?> · 未显示 <?php echo htmlentities($orderDatailInfoNoShow); ?> 条 </span>
  </xblock>
    <div class="layui-row">
        <div class="container-wrap">
            <div class="box-1">
                <?php if(!$actrion): ?>
                <table class="layui-table" id="table0">
                    <td>
                        ID: <a data-id="" id="data_a" href="#" style="color: green"></a>   <span style="color: red">请点击左边有效数据</span>
                    </td>
                </table>
                <?php endif; ?>
                <table class="layui-table">
                    <thead>
                    <tr>
                        <?php if($actrion): ?>
                        <th>操作</th>
                        <?php else: ?>
                        <th  onclick="openAll()">
                            <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                        </th>
                        <?php endif; ?>
                        <th>订单状态</th>
                        <th>序号</th>
                        <th>图纸明细</th>
                        <th>产品名称</th>
                        <th>材料</th>
                        <th>形状</th>
                        <th>热处理</th>
                        <th>单位</th>
                        <th>订单 / 计划 / 完成 / 发货 </th>
                        <!--<th>计划数量 </th>-->
                        <th>图纸工艺</th>
                        <th>加工内容</th>
                        <th>交货日期</th>
                        <th>完成状态</th>
                        <!--<th>入库数量</th>-->
                        <th>备注</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;if(is_array($orderDatailInfo) || $orderDatailInfo instanceof \think\Collection || $orderDatailInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $orderDatailInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <?php
                    $count = getCountExterna($info['drawing_externa_or_internal_id'],$info['order_id'],$info['if_tu']);
                  if($actrion): ?>
                        <td>
                            <a title="修改" onclick="x_admin_show('修改订单','<?php echo url('index/Order/editOrderDetail',['id'=>$info['id']]); ?>',600,500)", href="javascript:;"><i style="color: green" class="layui-icon"></i></a>
                            <a title="删除" onclick="delete_(this,'<?php echo htmlentities($info['id']); ?>')" href="javascript:void(0);" ><i  style="color:red;" class="layui-icon"></i></a>
                        </td>
                        <?php else: ?>
                        <td onclick="openAll()">
                            <div class="layui-unselect layui-form-checkbox"  lay-skin="primary" data-id='<?php echo htmlentities($info['id']); ?>'><i class="layui-icon">&#xe605;</i></div>
                        </td>
                        <?php endif; 
             $isTask = getIsTask($info['id']);
             ?>
                        <td>
                            <button title="任务"   style="border: 0;background: transparent;cursor: pointer"  class="renwu" onclick="x_admin_show('订单任务','<?php echo url('index/task/inTask',['id'=>$info['id']]); ?>')"
                                    <?php if($info['arrange'] =='否'): ?>
                                    disabled
                                    <?php endif; ?>
                            >

                            <?php if($info['arrange'] =='否'): ?>
                            无需加工
                            <?php else: if($isTask): $wc = getWc($info['id']);if($wc == 1): ?>
                            任务完成
                            <?php else: ?>
                            已下任务
                            <?php endif; else: ?>
                            未下任务
                            <?php endif; endif; ?>
                            <!--<?php if($info['arrange'] =='自加工'): ?>-->
                            <!--<?php if($isTask): ?>-->
                            <!--<?php $wc = getWc($info['id']);?>-->
                            <!--<?php if($wc == 1): ?>-->
                            <!--完成-->
                            <!--<?php else: ?>-->
                            <!--已下任务-->
                            <!--<?php endif; ?>-->
                            <!--<?php else: ?>-->
                            <!--未下任务-->
                            <!--<?php endif; ?>-->
                            <!--<?php else: ?>-->
                            <!--<?php if($info['arrange'] =='整体外协'): ?>-->
                            <!--整体外协-->
                            <!--<?php elseif($info['arrange'] =='标件不加工'): ?>-->
                            <!--标件不加工-->
                            <!--<?php elseif($info['arrange'] =='外协完成'): ?>-->
                            <!--外协完成-->
                            <!--<?php endif; ?>-->
                            <!--<?php endif; ?>-->
                            </button>
                            <!--<a title="任务"  href="javascript:;" onclick="x_admin_show('下达任务','<?php echo url('index/ProductTask/addProductTask',['id'=>$info['id']]); ?>',600,500)" >下任务</a>-->
                        </td>
                        <td>
                            <?php if($count): ?>
                            <?php echo  $i ;?>  <a onclick="x_admin_show('添加订单明细','<?php echo url('index/Order/newOrder',['id'=>$info['order_id'],'ex_or_id'=>$info['drawing_externa_or_internal_id'],'type'=>$info['if_tu']]); ?>',800,500)", href="javascript:;"><span style="color: red">新</span></a>
                            <?php else: ?>
                            <?php echo  $i ;endif; ?>
                            <span class="layui-table-sort layui-inline">
                   <i class="layui-edge layui-table-sort-asc" onclick="SanSort('<?php echo htmlentities($info['id']); ?>','asc')"></i>
                   <i class="layui-edge layui-table-sort-desc"  onclick="SanSort('<?php echo htmlentities($info['id']); ?>','desc')"></i>
                 </span>
                        </td>

                        <td>
                            <?php echo htmlentities(getDrawingDetailId($info['drawing_detail_id'])); ?>
                        </td>
                        <td><?php echo htmlentities(getDrawingName($info['drawing_detail_id'])); ?></td>
                        <?php $blueprintInfoList = getblueprintInfoList($info['drawing_detail_id']);?>
                        <td><?php echo htmlentities(getMaterialType($blueprintInfoList['material'])); ?></td>
                        <td><?php echo htmlentities(getMateria($blueprintInfoList['material_type'])); ?></td>
                        <td><?php echo htmlentities($blueprintInfoList['heat_treatment']); ?></td>
                        <td><?php echo htmlentities($info['company']); ?> </td>
                        <?php $wangc =  getOrderOk($info['id']);
                              $fahuo =  getSonghuo($info['order_detail_code']);
                              $flag = 0;
                               if($wangc == $fahuo){
                               $flag = 1;
                               }
                               ?>
                        <td><?php echo htmlentities($info['order_qty']); ?> /  <?php echo htmlentities($info['plan_qty']); ?> / <span <?php if($flag == 1): ?> style="color: #28ac17" <?php endif; ?>  ><?php echo getOrderOk($info['id']);?></span> /  [<span style="cursor: pointer" onclick="x_admin_show('送货单明细','<?php echo url('index/Delivery/viewShow'); ?>'+'?model=1&order_detail_code='+'<?php echo htmlentities($info['order_detail_code']); ?>')"><?php echo getSonghuo($info['order_detail_code']);?></span>]</td>
                        <!--<td>计划</td>-->
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
                        <td><?php echo htmlentities($info['content']); ?></td>
                        <td><?php echo htmlentities($info['date_delivery']); ?></td>
                        <td>
                            <?php if($info['if_complete'] == 0): ?>
                            未完成
                            <?php else: ?>
                            完成
                            <?php endif; ?>
                        </td>
                        <!--<td><?php echo htmlentities($info['warehousing']); ?> 入库</td>-->
                        <td><?php echo htmlentities($info['remark']); ?></td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page">
            <?php echo $orderDatailInfo; ?>
        </div>
    </div>
</div>
<script>

    function openLinke(id) {
        layer.open({
            content: '选择你要进入的图纸类型～～'
            ,btn: ['外图', '内图'] //按钮
            ,yes: function(index, layero){
                //按钮【按钮一】的回调
                x_admin_show("外图",'<?php echo url('index/blueprint/blueprintoutside',['id'=>1,'model'=>1,'order'=>$orderCode]); ?>');
            },btn2: function(index, layero){
                //按钮【按钮二】的回调
                x_admin_show("内图",'<?php echo url('index/internal/internalinfo',['id'=>1,'model'=>1,'order'=>$orderCode]); ?>');
            },btn3: function(index, layero){
                //按钮【按钮三】的回调
                x_admin_show("总价报价","<?php echo url('index/quoted/quotedInfoType3'); ?>?id=" + id);
            }
            ,cancel: function(){
                //右上角关闭回调
            }
        });
    }

    function openAll () {
        var data = tableCheck.getData();
        to(data);
    }
    function to(data) {
        $("#data_a").attr('data-id',data);
        $("#data_a").text(data+" 已选"+data.length+"项");
        if(!data.length){
            $("#data_a").text("");
        }
    }
  function show(obj,id,show) {
      layer.confirm('确定要更改吗？',function(index){
          var url = "<?php echo url('/index/Order/updateShow'); ?>";
          var postData ={"id":id,"show":show};
          $.post(url,postData,function (result) {
              if(result == 1 ){
                  layer.alert("更改成功", {icon: 6},function () {
                      window.location.reload();  //刷新父级页面
                  });
              }else {
                  layer.alert("更改失败", {icon: 5});
              }
          },"json")
      });
  }
  function SanSort(id,sort) {
      $.ajax({
          url:"/index/Order/SanSort",
          type:"POST",
          dataType:"json",
          data:{
              id:id,
              sort:sort
          },
          success:function (res) {
              if(res.error === 1000 ){
                  layer.msg(res.msg, {icon: 5});
              }else if(res.error === 1) {
                  window.location.reload();  //刷新父级页面
              }else {
                  layer.msg(res.msg, {icon: 5});
              }
          },
      });
  }

    /*删除*/
    function delete_(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            var url = "<?php echo url('/index/Order/deleteDetail'); ?>";
            var postData ={"id":id};
            $.post(url,postData,function (result) {
                if(result === 1 ){
                    layer.alert("删除成功", {icon: 6},function () {
                        window.location.reload();  //刷新父级页面
                    });
                }else {
                    layer.alert("删除失败", {icon: 5});
                }
            },"json");
        });
    }


</script>
</body>
</html>