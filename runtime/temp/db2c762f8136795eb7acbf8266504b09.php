<?php /*a:2:{s:63:"D:\code\Hy\application\index\view\blueprint\blueprint-info.html";i:1531232830;s:52:"D:\code\Hy\application\index\view\public\header.html";i:1529297217;}*/ ?>
﻿<!doctype html>
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
  <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>

<div class="x-body" >
  <xblock>
    <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="layui-input-inline">
      <!--<input type="tel" id="findText" lay-verify="required|phone" autocomplete="off" placeholder="请输入关键字..." class="layui-input">-->
      <form class="layui-form" action="<?php echo url('index/Blueprint/blueprintInfo'); ?>" method="post">
        <div class="layui-input-inline">
          <select name="modules" lay-verify="required" lay-search="" id="findText">
            <option value="">请输入关键字...</option>
            <optgroup label="外图明细">
              <?php if(is_array($blueprintInfo) || $blueprintInfo instanceof \think\Collection || $blueprintInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $blueprintInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$blueprintInfoList): $mod = ($i % 2 );++$i;?>
              <option value="<?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?>"><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></option>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </optgroup>

            <optgroup label="公司编号">
              <?php if(is_array($blueprintInfo) || $blueprintInfo instanceof \think\Collection || $blueprintInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $blueprintInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$blueprintInfoList): $mod = ($i % 2 );++$i;?>
              <option value="<?php echo htmlentities($blueprintInfoList['drawing_internal_id']); ?>"><?php echo htmlentities($blueprintInfoList['drawing_internal_id']); ?></option>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </optgroup>

            <optgroup label="外图编号">
              <?php if(is_array($blueprintInfo) || $blueprintInfo instanceof \think\Collection || $blueprintInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $blueprintInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$blueprintInfoList): $mod = ($i % 2 );++$i;?>
              <option value="<?php echo htmlentities($blueprintInfoList['drawing_externa_id']); ?>"><?php echo htmlentities($blueprintInfoList['drawing_externa_id']); ?></option>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </optgroup>
          </select>
        </div>
        <button type="submit" class="layui-btn"  lay-submit="" lay-filter="sreach" id="find"><i class="layui-icon">&#xe615;</i></button>
      </form>
    </div>

    <script>
      $(function () {
          $("#find").click(function () {
              var findText = $("#findText").val();
              if(findText.length > 1){
                  window.location.href="<?php echo url('index/blueprint/blueprintInfo'); ?>";
              }else{
                  layer.msg('请输入查找的关键字!',{icon:0,time:2000});
              }

          });
      })
    </script>
    <!--<span class="x-right" style="line-height:40px">共：<?php echo htmlentities($blueprintInfoCount); ?>条数据</span>-->
  </xblock>
  <!------------------------------------------------------------------------------------------------------------------->
  <div class="container-wrap">
    <div class="box-1">
      <table class="layui-table">
      <thead>
      <tr>
        <th>
          <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
        </th>
        <th>明细编号</th>
        <th>公司编号</th>
        <th>外图编号</th>
        <th>图纸名称</th>
        <th>材料</th>
        <th>类型</th>
        <th>客户</th>
        <th>批量</th>
        <th>工费</th>
        <th>报价</th>
        <th>实际价格</th>
        <th>操作</th>
      </tr>
      </thead>
      <tbody>
      <?php if(is_array($blueprintInfo) || $blueprintInfo instanceof \think\Collection || $blueprintInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $blueprintInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$blueprintInfoList): $mod = ($i % 2 );++$i;?>
      <tr>
        <td>
          <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo htmlentities($blueprintInfoList['id']); ?>'><i class="layui-icon">&#xe605;</i></div>
        </td>
        <td><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></td>
        <td><?php echo htmlentities($blueprintInfoList['drawing_internal_id']); ?></td>
        <td><?php echo htmlentities($blueprintInfoList['drawing_externa_id']); ?></td>
        <td><?php echo htmlentities($blueprintInfoList['drawing_name']); ?></td>
        <td><?php echo htmlentities($blueprintInfoList['heat_treatment']); ?></td>
        <td><?php echo htmlentities($blueprintInfoList['drawing_type']); ?></td>
        <td><?php echo htmlentities($blueprintInfoList['client_id']); ?></td>
        <td><?php echo htmlentities($blueprintInfoList['if_batch']); ?></td>
        <td><?php echo htmlentities($blueprintInfoList['layout_qty']); ?></td>
        <td><?php echo htmlentities($blueprintInfoList['product_mfg_cost']); ?></td>
        <td><?php echo htmlentities($blueprintInfoList['product_quotation']); ?></td>
        <td class="td-manage">
          <a title="详" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的所有信息','<?php echo url('index/blueprint/blueprintInfos',['id'=>$blueprintInfoList['drawing_detail_id']]); ?>',450)" href="javascript:;"><i class="layui-icon">详</i></a>
          <a title="外" onclick="x_admin_show('外','http://php.me/[爱，就注定了一生的漂泊].刘墉.扫描版.pdf')" href="javascript:;"><i class="layui-icon">外</i></a>
          <a title="内" onclick="x_admin_show('内','http://php.me/超越平凡的平面设计+版式设计原理.pdf')" href="javascript:;"><i class="layui-icon">内</i></a>
          <a title="程" onclick="x_admin_show('程','http://php.me/微交互  细节设计成就卓越产品.pdf')" href="javascript:;"><i class="layui-icon">程</i></a>
          <a title="工" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的工艺信息','<?php echo url('index/blueprint/process'); ?>')" href="javascript:;"><i class="layui-icon">工</i></a>
        </td>
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
                  url:"/index/index/delall",
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
</body>
</html>