<?php /*a:2:{s:91:"I:\Project\WebServer\www\project\Hy\application\index\view\blueprint\blueprint-outside.html";i:1541492431;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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

<body >
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">图纸管理</a>
        <a>
          <cite>外部图纸</cite>
        </a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
        <!--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>-->
        <a class="layui-btn"  target="_blank" href="<?php echo url(); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>
        <button class="layui-btn" onclick="x_admin_show('添加外图','<?php echo url('index/blueprint/addDrawingExterna'); ?>',500,400)"><i class="layui-icon"></i>添加</button>
        <div class="layui-input-inline">
            <form class="layui-form" action="<?php echo url('index/Blueprint/blueprintOutside'); ?>" method="post">
                <div class="layui-input-inline">
                    <input type="text" name="modules" autocomplete="off" placeholder="请输入关键字..." class="layui-input">
                </div>
                <?php if($mode == 1): ?>
                <input type="hidden" name="model" value="1">
                <input type="hidden" name="order" value="<?php echo htmlentities($order); ?>">
                <?php endif; ?>
                <div class="layui-input-inline">
                    <select name="id" lay-search="" >
                        <option value=""></option>
                        <optgroup label="外图编号">
                            <?php if(is_array($blueprintOutside) || $blueprintOutside instanceof \think\Collection || $blueprintOutside instanceof \think\Paginator): $i = 0; $__LIST__ = $blueprintOutside;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$outside): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($outside['id']); ?>"><?php echo htmlentities($outside['drawing_external_id']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </optgroup>
                    </select>
                </div>
                <button type="submit" class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </form>
        </div>
        <span class="x-right" style="line-height:40px">共<?php echo htmlentities($blueprintOutsideCount); ?>条 · 共<?php echo htmlentities(getInt($blueprintOutsideCount/25)); ?>页</span>
        <?php if($mode == 1): ?>
         <button class="layui-btn" onclick="exeOrder()"><i class="layui-icon"></i>生成订单明细</button>
        <?php endif; ?>
    </xblock>
<div class="container-wrap">
    <div class="box-1">
        <table class="layui-table">
            <thead>
                <tr>
                    <?php if($mode == 1): ?>
                    <th width="20px;">
                        <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                    </th>
                    <?php endif; ?>
                    <th width="30px;">操作</th>
                    <th>外来图号</th>
                    <th>建档日期</th>
                    <th>创建人</th>
                    <th>修改人</th>
                    <th>修改日期</th>
                    <th>备注</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($blueprintOutside) || $blueprintOutside instanceof \think\Collection || $blueprintOutside instanceof \think\Paginator): $i = 0; $__LIST__ = $blueprintOutside;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$blueprintOutsideList): $mod = ($i % 2 );++$i;?>
            <tr>
                <?php
                    $count = getDetialExternal($blueprintOutsideList['drawing_external_id']);
                 if($mode == 1): if($count != 0): ?>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo htmlentities($blueprintOutsideList['drawing_external_id']); ?>'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <?php else: ?>
                <td></td>
                <?php endif; endif; ?>
                <td class="td-manage">
                    <a title="修改" onclick="x_admin_show('修改外图','<?php echo url('index/Blueprint/outsideEdit',['id'=>$blueprintOutsideList['id']]); ?>',400,400)", href="javascript:;"><i style="color: green" class="layui-icon"></i></a>
                    <a title="删除" onclick="delete_(this,'<?php echo htmlentities($blueprintOutsideList['id']); ?>')" href="javascript:void(0);" ><i  style="color:red;" class="layui-icon"></i></a>
                    <a title="添加明细" onclick="x_admin_show('为外图 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintOutsideList['drawing_external_id']); ?></span> 添加明细','<?php echo url('index/blueprint/addDrawingDetial', ['id' => $blueprintOutsideList['drawing_external_id']]); ?>')" href="javascript:;"><i style="color: green" class="iconfont nav_right">&#xe6b9;</i></a>
                    <?php if(!widget('Widget/drawing_check',['drawing_id'=>$blueprintOutsideList['drawing_external_id']])): ?>
                    <a title="上传文件" onclick="x_admin_show('为外图 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintOutsideList['drawing_external_id']); ?></span> 上传图纸文件','<?php echo url('index/blueprint/upDrawing_files', ['id' => $blueprintOutsideList['id']]); ?>')" href="javascript:;"><i style="color:red" class="iconfont nav_right">&#xe71d;</i></a>
                    <?php else: ?>
                    <a title="查看文件" onclick="x_admin_show('查看外图 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintOutsideList['drawing_external_id']); ?></span> 图纸文件','<?php echo url('index/blueprint/upDrawing_files', ['id' => $blueprintOutsideList['id']]); ?>')" href="javascript:;"><i style="color:green" class="iconfont nav_right">&#xe6e6;</i></a>
                    <?php endif; ?>
                </td>
                <td>
                    <?php
                    $count = getDetialExternal($blueprintOutsideList['drawing_external_id']);
                    if($count == 0): ?>
                    <?php echo htmlentities($blueprintOutsideList['drawing_external_id']); else: ?>
                     <a title="序号<?php echo htmlentities($blueprintOutsideList['drawing_external_id']); ?>" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintOutsideList['drawing_external_id']); ?></span> 的所有明细','<?php echo url('index/Blueprint/blueprintInfo', ['modules' => $blueprintOutsideList['drawing_external_id']]); ?>')" href="javascript:;"><i class="layui-icon " style="color: #1E9FFF"><?php echo htmlentities($blueprintOutsideList['drawing_external_id']); ?></i></a>
                    <?php endif; ?>
                </td>
                <td><?php echo htmlentities($blueprintOutsideList['create_time']); ?></td>
                <td><?php echo htmlentities($blueprintOutsideList['create_name']); ?></td>
                <td><?php echo htmlentities($blueprintOutsideList['modify_name']); ?></td>
                <td><?php echo htmlentities($blueprintOutsideList['update_time']); ?></td>
                <td><?php echo htmlentities($blueprintOutsideList['remark']); ?></td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>
    <div class="page">
        <?php echo $blueprintOutside; ?>
    </div>
</div>
<script>
    /*删除*/
    function delete_(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            var url = "<?php echo url('/index/Blueprint/deleteOutside'); ?>";
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
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            $.ajax({
                url:"/index/index/delall",
                type:"POST",
                dataType:"json",
                data:{
                    table:"hy_drawing_external",  //表名
                    data:data   //数据
                },
                success:function (res) {
                    layer.msg(res.message, {icon: 1});
                    $(".layui-form-checked").not('.header').parents('tr').remove();
                },
            });
        });
    }
    function exeOrder() {
        var data = tableCheck.getData();
        var code = "<?php echo htmlentities($order); ?>";
        var index = parent.layer.getFrameIndex(window.name);
        if(data == ''){
            layer.msg('请选择数据');
            return;
        }
        //关闭当前弹出层
        x_admin_show('填写订单明细',"<?php echo url('index/Order/addOrderDetail'); ?>?id="+data+"&order="+code+"&type=w");

    }
</script>
</body>
</html>