<?php /*a:2:{s:83:"I:\Project\WebServer\www\project\Hy\application\index\view\delivery\view_order.html";i:1541524206;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
 <!doctype html>
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
    <div class="layui-row">
        <div class="container-wrap">
            <div class="box-1">
                <table id="table0" class="layui-table">
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($orderInfo) || $orderInfo instanceof \think\Collection || $orderInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $orderInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <!--<td><a title="订单明细" href="" style="color: green"  data-id="<?php echo htmlentities($info['order_id']); ?>"> <?php echo htmlentities($info['order_id']); ?> </a></td>-->
                        <td>  <a title="订单明细" style="color: green" onclick="addOrder(this,'<?php echo htmlentities($info['id']); ?>')" href="#"> <?php echo htmlentities($info['order_id']); ?> </a></td>
                        <!--<td>  <a title="订单明细" onclick="x_admin_show('<span class=\' layui-bg-blue\'><?php echo htmlentities($info['order_id']); ?></span> 订单明细','<?php echo url('index/Order/orderDetail',['id'=>$info['id']]); ?>')", href="javascript:;"> <?php echo htmlentities($info['order_id']); ?> </a></td>-->

                        <td><?php echo htmlentities($info['order_content']); ?></td>
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
                        <td></td>
                        <td><?php echo htmlentities($info['create_time']); ?></td>
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
</div>
</body>
<script>
        function addOrder(obj,id){
        var url = "/index/Order/orderDetail/actrion/0/id/"+id;

        //alert("<?php echo htmlentities($deliveryId); ?>");
        top.SearchTeacherLayerId = top.layer.open({
            title: "选择产品",
            type: 2,
            shadeClose: true,
            area: ['85%', '90%'],
            content: url,
            success: function () {
                $(top.document.body).find('#layui-layer-iframe' + top.SearchTeacherLayerId).contents().find("td a").on('click', function () {
                    //alert($(this).attr('data-id'));
                    var order_id = $(this).attr('data-id');//订单编号
                    var url = "<?php echo url('index/Delivery/addNexus'); ?>";
                    var data = {'deliverId':'<?php echo htmlentities($deliveryId); ?>','orderId':order_id};
                    $.post(url,data,function(info){
                        if (info){
                            layer.msg("写入成功",{icon:1,time:2000});
                            window.parent.location.reload();  //刷新父级页面
                        } else{
                            layer.msg("写入失败",{icon:5,time:2000});
                        }
                    },'json');
                    top.layer.close(top.SearchTeacherLayerId);
                    //location.replace(location.href);
                    //window.location.reload();  //刷新父级页面
                    //window.parent.location.reload();  //刷新父级页面
                });
            }
        });
    }

</script>

</html>