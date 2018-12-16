<?php /*a:2:{s:63:"D:\code\Hy\application\index\view\blueprint\blueprint-info.html";i:1541998774;s:52:"D:\code\Hy\application\index\view\public\header.html";i:1533941222;}*/ ?>
﻿ <!doctype html>
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
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">图纸管理</a>
        <a>

          <cite>图纸明细</cite>
        </a>
      </span>
  <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="/index/blueprint/blueprintInfo" title="刷新">
    <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>

<div class="x-body" >
  <xblock>
    <!--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>&nbsp;&nbsp;&nbsp;&nbsp;-->
    <a class="layui-btn"  target="_blank" href="<?php echo url(); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>

    <div class="layui-input-inline">
      <!--<input type="tel" id="findText" lay-verify="required|phone" autocomplete="off" placeholder="请输入关键字..." class="layui-input">-->
      <form class="layui-form" action="<?php echo url('index/Blueprint/blueprintInfo'); ?>" method="post">
        <div class="layui-input-inline">
          <input type="text" name="modules" autocomplete="off" placeholder="请输入关键字..." class="layui-input">
        </div>
        <div class="layui-input-inline">
          <select name="id" lay-search="" >
            <option value="">输入简称</option>
            <optgroup label="外图明细">
              <?php if(is_array($clientKeyInfo) || $clientKeyInfo instanceof \think\Collection || $clientKeyInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $clientKeyInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$clientKeyInfoList): $mod = ($i % 2 );++$i;?>
              <option value="<?php echo htmlentities($clientKeyInfoList['id']); ?>"><?php echo htmlentities($clientKeyInfoList['client_abbreviation']); ?></option>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </optgroup>
          </select>
        </div>
        <button type="submit" class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
      </form>
    </div>
      <span class="x-right" style="line-height:40px">共<?php echo htmlentities($blueprintInfoCount); ?>条 · 共<?php echo htmlentities(getInt($blueprintInfoCount/25)); ?>页</span>
    <script>
      $(function () {
          $("input").click(function () {
              $("input").val("");
          });
          $("xblock").click(function () {
              $("dd").val("");
          });

      });
    </script>
  </xblock>
  <div class="container-wrap">
    <div class="box-1">
      <table class="layui-table">
      <thead>
      <tr>
        <!--<th>-->
          <!--<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>-->
        <!--</th>-->
        <th>操作</th>
        <th>明细编号</th>
        <th>内图编号</th>
        <th>外图编号</th>
        <th>图纸名称</th>
        <th>材料</th>
        <th>形状</th>
        <th>类型</th>
        <th>版本</th>
        <th>客户</th>
        <th>批量</th>
        <th>图纸工艺</th>
        <?php if(app('session')->get('user.is_price') !=0): ?>
        <th>加工费</th>
        <th>报价</th>
        <th>实际价格</th>
        <?php endif; ?>
        <th>是否作废</th>
      </tr>
      </thead>
      <tbody>
      <?php if(is_array($blueprintInfo) || $blueprintInfo instanceof \think\Collection || $blueprintInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $blueprintInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$blueprintInfoList): $mod = ($i % 2 );++$i;?>
      <tr>
        <!--<td>-->
          <!--<div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo htmlentities($blueprintInfoList['id']); ?>'><i class="layui-icon">&#xe605;</i></div>-->
        <!--</td>-->
        <td class="td-manage">
          <a title="详" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的所有信息','<?php echo url('index/blueprint/blueprintInfos',['id'=>$blueprintInfoList['drawing_detail_id']]); ?>')" href="javascript:;"><i style="color: green" class="layui-icon"></i></a>
          <a title="删除" onclick="delete_(this,'<?php echo htmlentities($blueprintInfoList['id']); ?>')" href="javascript:void(0);" >
            <i  style="color:red;" class="layui-icon"></i>
          </a>
        </td>
        <td> <a href="javascript:;" onclick="x_admin_show('<span class=\' layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的工艺信息','<?php echo url('index/blueprint/process',['drawing_detail_id'=>$blueprintInfoList['drawing_detail_id']]); ?>')" ><span style="color: #1E9FFF"><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span></a></td>
        <td> <a href="javascript:;" onclick="x_admin_show('<span class=\' layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_internal_id']); ?></span> 的图纸明细','<?php echo url('index/blueprint/blueprintInfo',['codeId'=>$blueprintInfoList['drawing_internal_id'],'key'=>'internal']); ?>')" ><span style="color: #1E9FFF"><?php echo htmlentities($blueprintInfoList['drawing_internal_id']); ?></span></a></td>
        <td> <a href="javascript:;" onclick="x_admin_show('<span class=\' layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_externa_id']); ?></span> 的图纸明细','<?php echo url('index/blueprint/blueprintInfo',['codeId'=>$blueprintInfoList['drawing_externa_id'],'key'=>'externa']); ?>')" ><span style="color: #1E9FFF"><?php echo htmlentities($blueprintInfoList['drawing_externa_id']); ?></span></a></td>
        <td><?php echo htmlentities($blueprintInfoList['drawing_name']); ?></td>
        <td><?php echo htmlentities(getMaterialType($blueprintInfoList['material'])); ?></td>
        <td><?php echo htmlentities(getMateria($blueprintInfoList['material_type'])); ?></td>
        <td><?php echo htmlentities($blueprintInfoList['drawing_type']); ?></td>
        <td><?php echo htmlentities($blueprintInfoList['version']); ?></td>
        <?php   $clienyname = getClientName($blueprintInfoList['client_id']);?>
        <td> <a href="javascript:;" onclick="x_admin_show('<span class=\' layui-bg-blue\'><?php echo htmlentities($clienyname['clientName']); ?></span> 的图纸明细','<?php echo url('index/blueprint/blueprintInfo',['codeId'=>$clienyname['id'],'key'=>'clients']); ?>')" ><span style="color: #1E9FFF"> <?php  echo $clienyname['clientName'];  ?></span></a></td>
        <td><?php echo !empty($blueprintInfoList['if_batch']) ? "是" : "否"; ?></td>
        <td class="td-manage">
          <?php if($blueprintInfoList['files_state']==0||$blueprintInfoList['drawing_externa_id']==""||!widget('Widget/drawing_check',['drawing_id'=>$blueprintInfoList['drawing_externa_id']])): ?><!-- 不继承或者外图继承无效 -->
          <a title="图纸" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的图纸文件',
          '<?php echo url('index/blueprint/is_DrawingFiles',['id'=>$blueprintInfoList['id'],'key'=>'wai','drawing_num'=>$blueprintInfoList['drawing_detail_id']]); ?>')" href="javascript:;">
            <span class="layui-badge layui-bg-<?php echo widget('Widget/files_check',['id'=>$blueprintInfoList['id'],'tip'=>'abroad']); ?>">图</span></a>
          <?php elseif($blueprintInfoList['files_state']==1): ?> <!-- 继承 -->
          <a title="图纸" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的图纸文件',
          '<?php echo url('index/blueprint/is_outDrawing',['id'=>$blueprintInfoList['drawing_externa_id']]); ?>')" href="javascript:;"><span class="layui-badge layui-bg-green">图</span></a>
          <?php endif; ?>
          <a title="模型" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的3d模型文件',
          '<?php echo url('index/blueprint/is_DrawingFiles',['id'=>$blueprintInfoList['id'],'key'=>'nei','drawing_num'=>$blueprintInfoList['drawing_detail_id']]); ?>')" href="javascript:;"><span class="layui-badge layui-bg-<?php echo widget('Widget/files_check',['id'=>$blueprintInfoList['id'],'tip'=>'within']); ?>">3D</span></a>
          <a title="程序单" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的程序单文件',
          '<?php echo url('index/blueprint/is_DrawingFiles',['id'=>$blueprintInfoList['id'],'key'=>'cheng','drawing_num'=>$blueprintInfoList['drawing_detail_id']]); ?>')" href="javascript:;"><span class="layui-badge layui-bg-green layui-bg-<?php echo widget('Widget/files_check',['id'=>$blueprintInfoList['id'],'tip'=>'engineering']); ?>">程</span></a>

          <?php if($blueprintInfoList['is_gongxu'] !=0): ?>
          <a title="工"  href="javascript:;" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的工艺信息','<?php echo url('index/blueprint/process',['drawing_detail_id'=>$blueprintInfoList['drawing_detail_id']]); ?>')" ><span class="layui-badge layui-bg-green">工</span></a>
          <?php else: ?>
          <a title="工"  href="javascript:;" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的工艺信息','<?php echo url('index/blueprint/process',['drawing_detail_id'=>$blueprintInfoList['drawing_detail_id']]); ?>')" ><span  class="layui-badge layui-bg-blue">工</span></a>
          <?php endif; ?>
        </td>
        <?php if(app('session')->get('user.is_price') !=0): ?>
        <td>￥<?php echo htmlentities($blueprintInfoList['product_mfg_cost']); ?></td>
        <td>￥<?php echo htmlentities($blueprintInfoList['product_quotation']); ?></td>
        <td>￥<?php echo htmlentities($blueprintInfoList['product_real_price']); ?></td>
        <?php endif; ?>
        <td> <?php echo !empty($blueprintInfoList['if_discard']) ? '<span class="layui-badge">是</span>' : '<span class="layui-badge layui-bg-green">否</span>'; ?>  </td>
      </tr>
      <?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
    </div>
  </div>
  <!--___________________________________-->
  <div class="page">
    <?php echo $blueprintInfo; ?>
  </div>
  <script>
      /*删除*/
      function delete_(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              var url = "<?php echo url('/index/Blueprint/delete'); ?>";
              var postData ={"id":id};
              $.post(url,postData,function (result) {
                  if(result === 1 ){
                      $(obj).parents("tr").remove();
                      layer.msg('已删除!',{icon:1,time:1000});
                  }else {
                      layer.alert("删除失败", {icon: 5});
                  }
              },"json");
          });
      }

      layui.use('laydate', function(){
          var laydate = layui.laydate;

          //执行一个laydate实例
          laydate.render({
              elem: '#start' //指定元素
          });

          //执行一个laydate实例
          laydate.render({
              elem: '#end' //指定元素
          });
      });

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }

      function delAll (argument) {
          var data = tableCheck.getData();

          layer.confirm('确认要删除吗？',function(index){
              //捉到所有被选中的，发异步进行删除
              $.ajax({
                  url:"/index/Blueprint/DelAll",
                  type:"POST",
                  dataType:"json",
                  data:{
                      table:"hy_drawing_detial",  //表名
                      data:data   //数据
                  },
                  success:function (res) {
                      layer.msg(res.message, {icon: 1});
                      $(".layui-form-checked").not('.header').parents('tr').remove();
                  },
              });
          });
      }
  </script>
</div>

</body>
</html>