<?php /*a:2:{s:79:"I:\Project\WebServer\www\project\Hy\application\index\view\quoted\viewshow.html";i:1544282289;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
    <xblock>
        <a class="layui-btn"  target="_blank" href="<?php echo url(''); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>
        <!--<button class="layui-btn" onclick="x_admin_show('添加单据明细','<?php echo url('index/Quoted/addquoted',['quoteId'=>$quoteId]); ?>',500,600)"><i class="layui-icon"></i>选择订单</button>-->
        <button class="layui-btn"
                onclick="x_admin_show('选择订单','<?php echo url('index/Quoted/selectOrder',['quoteId'=>$quoteId]); ?>')"><i
                class="layui-icon"></i>添加订单</button>
        <span class="x-right" style="line-height:40px">共<?php echo htmlentities($quotedCount); ?>条 · 共<?php echo htmlentities(getInt($quotedCount/25)); ?>页</span>
    </xblock>

    <div class="container-wrap">
        <div class="box-1">
            <table class="layui-table">
                <thead>
                <tr>
                    <th width="40px;">操作</th>
                    <th>报价明细</th>
                    <th>订单明细</th>
                    <th>外图编号</th>
                    <th>内图编号</th>
                    <th>产品名称</th>
                    <th>材料</th>
                    <th>形状</th>
                    <th>尺寸</th>
                    <th>图纸工艺</th>
                    <th>数量</th>
                    <th>单重</th>
                    <th>总重</th>
                    <th>单材料费</th>
                    <th>总材料费</th>
                    <th>精坯加工费</th>
                    <th>工序和定额</th>
                    <th>加工单价</th>
                    <th>加工总价</th>
                    <th>利润率</th>
                    <th>管理费率</th>
                    <th>税率</th>
                    <th>产品单价</th>
                    <th>含税单价</th>
                    <th>产品总价</th>
                    <th>确认单价</th>
                    <th>备注</th>
                    <th>创建人</th>
                    <th>创建时间</th>
                    <th>最后修改人</th>
                    <th>修改时间</th>
                </tr>
                </thead>
                <?php if($quotedCount): ?>
                <tbody>
                <?php if(is_array($quoted) || $quoted instanceof \think\Collection || $quoted instanceof \think\Paginator): $i = 0; $__LIST__ = $quoted;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quotedList): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td class="td-manage" width="50px;"><!-- 这里是设备管理里面某个设备的维修记录表-->
                        <a title="编辑"onclick="x_admin_show('修改报价','')" href="javascript:;">
                            <i style="color: green" class="layui-icon"></i>
                        </a>
                        <a title="删除" onclick="delete_(this,'<?php echo htmlentities($quotedList['id']); ?>')" href="javascript:;">
                            <i  style="color:red;" class="layui-icon"></i>
                        </a>
                    </td>
                    <td><?php echo htmlentities($quotedList['quote_info_id']); ?></td>
                    <td><?php echo htmlentities($quotedList['order_info_id']); ?></td>
                    <td><?php echo htmlentities($quotedList['waitu_id']); ?></td>
                    <td><?php echo htmlentities($quotedList['neitu_id']); ?></td>
                    <td><?php echo htmlentities($quotedList['chanpin_name']); ?></td>
                    <td><?php echo htmlentities($quotedList['cailiao']); ?></td>
                    <td><?php echo htmlentities($quotedList['xingzhuang']); ?></td>
                    <td><?php echo htmlentities($quotedList['tuzhigongyi']); ?></td>
                    <td><?php echo htmlentities($quotedList['shuliang']); ?></td>
                    <td><?php echo htmlentities($quotedList['danzhong']); ?></td>
                    <td><?php echo htmlentities($quotedList['zongjia']); ?></td>
                    <td><?php echo htmlentities($quotedList['dancailiaofeiyon']); ?></td>
                    <td><?php echo htmlentities($quotedList['zongcailiaofeiyon']); ?></td>
                    <td><?php echo htmlentities($quotedList['jingpijiagongfeiyon']); ?></td>
                    <td><?php echo htmlentities($quotedList['gongxuanddinge']); ?></td>
                    <td><?php echo htmlentities($quotedList['jiagongdanjia']); ?></td>
                    <td><?php echo htmlentities($quotedList['jiagongzongjia']); ?></td>
                    <td><?php echo htmlentities($quotedList['lirunlv']); ?></td>
                    <td><?php echo htmlentities($quotedList['guanlifeilv']); ?></td>
                    <td><?php echo htmlentities($quotedList['shuilv']); ?></td>
                    <td><?php echo htmlentities($quotedList['chanpindanjia']); ?></td>
                    <td><?php echo htmlentities($quotedList['hanshuidanjia']); ?></td>
                    <td><?php echo htmlentities($quotedList['chanpinzongjia']); ?></td>
                    <td><?php echo htmlentities($quotedList['querendanjia']); ?></td>
                    <td><?php echo htmlentities($quotedList['beizhu']); ?></td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
<script>
    /*删除*/
    function delete_(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            var url = "<?php echo url('index/Quoted/delete'); ?>";
            var postData ={"id":id};
            $.post(url,postData,function (result) {
                if(result === 1){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }else {
                    layer.alert("删除失败", {icon: 5});
                }
            },"json");
        });
    }
</script>
</body>
</html>