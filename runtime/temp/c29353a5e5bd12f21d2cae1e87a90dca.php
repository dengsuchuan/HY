<?php /*a:2:{s:88:"I:\Project\WebServer\www\project\Hy\application\index\view\delivery\index-view-show.html";i:1541516665;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">订单管理</a>
        <a>
          <cite>送货单</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <xblock>
          <a class="layui-btn"  target="_blank" href="<?php echo url(); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>

          <!--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>-->
          <button class="layui-btn" onclick="x_admin_show('添加送货单','<?php echo url('index/Delivery/addShow'); ?>',500,700)"><i class="layui-icon"></i>添加送货单</button>
          <span class="x-right" style="line-height:40px">共条<?php echo htmlentities($deliveryCount); ?> · 共<?php echo htmlentities(getInt($deliveryCount)); ?>页</span>
        </xblock>
  <div class="layui-row">
    <div class="container-wrap">
      <div class="box-1">
      <table class="layui-table">
        <thead>
          <tr>
            <th>操作</th>
            <th>单据编号</th>
            <th>客户名称</th>
            <th>单据说明</th>
            <th>收款账户</th>
            <th>收款金额</th>
            <th>单据日期</th>
            <th>创建人</th>
            <th>是否打印</th>
            <th>备注</th>
          </tr>
        </thead>

        <tbody>
          <?php if(is_array($delivery) || $delivery instanceof \think\Collection || $delivery instanceof \think\Paginator): $i = 0; $__LIST__ = $delivery;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$deliveryList): $mod = ($i % 2 );++$i;?>
          <tr>
            <td class="td-manage" width="50px;">
              <a title="编辑" onclick="x_admin_show('修改送货单: <?php echo htmlentities($deliveryList['deliveryId']); ?>','<?php echo url('index/Delivery/editShow',['id'=>$deliveryList['id']]); ?>',500,700)" href="javascript:;">
                <i style="color: green" class="layui-icon"></i>
              </a>
              <a title="删除" onclick="delete_(this,'<?php echo htmlentities($deliveryList['id']); ?>','<?php echo htmlentities($deliveryList['deliveryId']); ?>')" href="javascript:;">
                <i  style="color:red;" class="layui-icon"></i>
              </a>
            </td>
            <td><a onclick="x_admin_show('添加 <?php echo htmlentities($deliveryList['deliveryId']); ?> 的发货单明细','<?php echo url('index/Delivery/deliveryDetails',['deliverId'=>$deliveryList['deliveryId'],'show'=>'1']); ?>')" style="color: #0000cc" href="#"><?php echo htmlentities($deliveryList['deliveryId']); ?></a></td>
            <td><?php echo htmlentities(getClientAbbreviation($deliveryList['clientName'])); ?></td>
            <td><?php echo htmlentities($deliveryList['deliveryText']); ?></td>
            <td><?php echo htmlentities($deliveryList['accounts']); ?></td>
            <td><?php echo htmlentities($deliveryList['amount']); ?></td>
            <td><?php echo htmlentities($deliveryList['document']); ?></td>
            <td><?php echo htmlentities($deliveryList['create_name']); ?></td>
            <td><?php echo !empty($deliveryList['if_print']) ? "是" : "否"; ?></td>
            <td><?php echo htmlentities($deliveryList['remarks']); ?></td>
          </tr>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="page">
  <?php echo $delivery; ?>
  </div>
</div>
    <script>
        /*删除*/
        function delete_(obj,id,deliveryId){
            layer.confirm('确认要删除吗？',function(index){
                var url = "<?php echo url('/index/Delivery/delete'); ?>";
                var postData ={"id":id,"deliveryId":deliveryId};
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
    </script>
    </div>
  </body>
</html>