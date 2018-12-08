<?php /*a:2:{s:81:"I:\Project\WebServer\www\project\Hy\application\index\view\bao_jia\view_show.html";i:1544283230;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
        <a><cite> 单据报价</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <xblock>
          <button class="layui-btn" onclick="x_admin_show('添加单据','<?php echo url('index/BaoJia/addShow'); ?>',500,600)"><i class="layui-icon"></i>添加单据</button>
          <span class="x-right" style="line-height:40px">共条<?php echo htmlentities($quoteCount); ?> · 共<?php echo htmlentities(getInt($quoteCount)); ?>页</span>
        </xblock>
  <div class="layui-row">
    <div class="container-wrap">
      <div class="box-1">
      <table class="layui-table">
        <thead>
        <tr>
            <th width="40">操作</th>
            <th>报价单编号</th>
            <th>摘要说明</th>
            <th>确认金额</th>
            <th>客户简称</th>
            <th>是否定额</th>
            <th>客户确认</th>
            <th>确认日期</th>
            <th>备注</th>
        </tr>
        </thead>

        <tbody>
        <?php if(is_array($quote) || $quote instanceof \think\Collection || $quote instanceof \think\Paginator): $i = 0; $__LIST__ = $quote;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
        <tr>
            <td class="td-manage">
                <a title="修改" onclick="x_admin_show('修改<?php echo htmlentities($list['quoteId']); ?>的报价单信息','<?php echo url('index/Quote/edit',['id'=>$list['id']]); ?>',500,600)" href="javascript:;"><i style="color: green" class="layui-icon"></i></a>
                <a title="删除" onclick="delete_(this,'<?php echo htmlentities($list['id']); ?>')" href="javascript:void(0);" >
                    <i  style="color:red;" class="layui-icon"></i>
                </a>
            </td>
            <td><a href="#" style="color: green"
                   onclick="x_admin_show('<?php echo htmlentities($list['quoteId']); ?>的报价明细','<?php echo url('index/Quoted/viewshow',['quoteId'=>$list['quoteId'],'show'=>'1']); ?>')"><?php echo htmlentities($list['quoteId']); ?></a></td>
            <td><?php echo htmlentities($list['summary']); ?></td>
            <td><?php echo htmlentities($list['amount']); ?></td>
            <td><?php echo htmlentities($list['clientName']); ?></td>
            <td><?php echo !empty($list['ifPrice']) ? "是" : "否"; ?></td>
            <td><?php echo !empty($list['determine']) ? "已确认" : "未确认"; ?></td>
            <td><?php echo htmlentities($list['determineTime']); ?></td>
            <td><?php echo htmlentities($list['remarks']); ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="page">
  <?php echo $quote; ?>
  </div>
</div>
    <script>
        /*删除*/
        function delete_(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                var url = "<?php echo url('index/Quote/delete'); ?>";
                var postData = {"id":id};
                $.post(url,postData,function (result) {
                    if(result != 0){
                        $(obj).parents("tr").remove();
                        layer.alert('已删除!',{icon:1,time:1000});
                    }else {
                        layer.alert("删除失败", {icon:5,time:1000});
                    }
                },"json");
            });
        }
    </script>
    </div>
  </body>
</html>