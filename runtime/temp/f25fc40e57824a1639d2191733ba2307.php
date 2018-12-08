<?php /*a:2:{s:75:"I:\Project\WebServer\www\project\Hy\application\index\view\order\order.html";i:1541587638;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
          <cite>订单列表</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <xblock>
          <a class="layui-btn"  target="_blank" href="<?php echo url(); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>

          <!--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>-->
          <button class="layui-btn" onclick="x_admin_show('添加订单','<?php echo url('index/Order/addOrder'); ?>',600,600)"><i class="layui-icon"></i>添加</button>
          <div class="layui-input-inline">
            <form class="layui-form" action="<?php echo url('index/Blueprint/blueprintOutside'); ?>" method="post">
              <div class="layui-input-inline">
                <input type="text" name="modules" autocomplete="off" placeholder="请输入关键字..." class="layui-input">
              </div>
              <div class="layui-input-inline">
                <select name="id" lay-search="" >
                  <option value=""></option>

                </select>
              </div>
              <button type="submit" class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </form>
          </div>
          <span class="x-right" style="line-height:40px">共条<?php echo htmlentities($count); ?> · 共<?php echo htmlentities(getInt($count)); ?>页</span>
        </xblock>
      <div class="layui-row">
        <div class="container-wrap">
          <div class="box-1">
            <table class="layui-table">
              <thead>
              <tr>
                <th>操作</th>
                <th>订单编号</th>
                <th>订单内容</th>
                <th>申请人</th>
                <th>下单时间</th>
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
        <?php if(is_array($orderInfo) || $orderInfo instanceof \think\Collection || $orderInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $orderInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
          <tr>
            <td class="td-manage">
              <a title="修改" onclick="x_admin_show('修改订单明细','<?php echo url('index/Order/editOrder',['id'=>$info['id']]); ?>',600,600)", href="javascript:;"><i style="color: green" class="layui-icon"></i></a>
              <a title="删除" onclick="delete_(this,'<?php echo htmlentities($info['id']); ?>')" href="javascript:void(0);" ><i  style="color:red;" class="layui-icon"></i></a>
              <!-- 合同文件 -->
              <a title="合同文件" onclick="x_admin_show('上传合同文件','<?php echo url('index/Order/OrderFile',['id'=>$info['id']]); ?>')",
                 href="javascript:;">
                <i style="color: <?php echo widget('Widget/order_files',['id'=>$info['id']]); ?>" class="layui-icon">
                  &#xe681;
                </i>
              </a>
            </td>
            <td>  <a title="订单明细" onclick="x_admin_show('<span class=\' layui-bg-blue\'><?php echo htmlentities($info['order_id']); ?></span> 订单明细','<?php echo url('index/Order/orderDetail',['id'=>$info['id']]); ?>')", href="javascript:;"> <?php echo htmlentities($info['order_id']); ?> </a></td>
            <td><?php echo htmlentities($info['order_content']); ?></td>
            <td><?php echo htmlentities($info['application']); ?></td>
            <td><?php echo htmlentities($info['order_time']); ?></td>
            <td><?php echo htmlentities($info['delivery_time']); ?></td>
            <td><?php echo htmlentities(getClientAbbreviation($info['client_id'])); ?></td>
            <td><?php echo htmlentities($info['prepare']); ?></td>
            <td><?php echo htmlentities($info['order_price']); ?></td>
            <td>
             <?php echo htmlentities($info['client_prj_id']); ?>
            </td>
            <td>
              <?php if($info['if_complete'] == 1): ?> 完成 <?php else: ?> 未完成 <?php endif; ?>
            </td>
            <td>
              <?php if($info['deliver_goods']): ?>已发货<?php else: ?>未发货<?php endif; ?>
            </td>
            <td>
              <?php if($info['receivables'] == 1): ?> 已收款 <?php else: ?> 未收款 <?php endif; ?>
            </td>
            <td><?php echo htmlentities($info['review_content']); ?></td>
            <td><?php echo htmlentities($info['create_time']); ?></td>
            <td onclick="openLinke('<?php echo htmlentities($info['id']); ?>')"><a href="#">报价</a></td>
          </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
          </div>
        </div>
      <div class="page">
        <?php echo $orderInfo; ?>
      </div>

    </div>
    <script>
        function openLinke(id) {
            layer.open({
                content: '选择你要进入的报价类型～～'
                ,btn: ['产品报价', '定额报价', '总价报价'] //按钮
                ,yes: function(index, layero){
                    //按钮【按钮一】的回调
                    x_admin_show("产品报价","<?php echo url('index/quoted/quotedInfoType1'); ?>?id=" + id);
                },btn2: function(index, layero){
                    //按钮【按钮二】的回调
                    x_admin_show("定额报价","<?php echo url('index/quoted/quotedInfoType2'); ?>?id=" + id);
                },btn3: function(index, layero){
                    //按钮【按钮三】的回调
                    x_admin_show("总价报价","<?php echo url('index/quoted/quotedInfoType3'); ?>?id=" + id);
                }
                ,cancel: function(){
                    //右上角关闭回调
                }
            });
        }

        /*删除*/
        function delete_(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                var url = "<?php echo url('/index/Order/orderDelete'); ?>";
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

    </script>
    </div>
  </body>
</html>