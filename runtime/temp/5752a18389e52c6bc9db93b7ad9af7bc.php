<?php /*a:2:{s:86:"I:\Project\WebServer\www\project\Hy\application\index\view\assembly\assembly-info.html";i:1541478154;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a>
          <cite>组件图纸</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>

    <div class="x-body">
      <xblock>
        <!--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>删除</button>-->
        <a class="layui-btn"  target="_blank" href="<?php echo url(); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>

        <button class="layui-btn" onclick="x_admin_show('添加组件图纸','<?php echo url('index/Assembly/assemblyAdd'); ?>',500,500)"><i class="layui-icon"></i>添加组件图纸</button>
        <div class="layui-input-inline">
          <form class="layui-form" action="<?php echo url('index/Assembly/assemblyInfo'); ?>" method="post">
            <div class="layui-input-inline">
              <input type="text" name="modules" autocomplete="off" placeholder="请输入关键字..." class="layui-input">
            </div>
            <div class="layui-input-inline">
              <select name="id" lay-search="" >
                <option value=""></option>
                <optgroup label="组件编号">
                  <?php if(is_array($assemblyInfo) || $assemblyInfo instanceof \think\Collection || $assemblyInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $assemblyInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$assemblyInfoLest): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo htmlentities($assemblyInfoLest['id']); ?>"><?php echo htmlentities($assemblyInfoLest['assembly_code']); ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </optgroup>
              </select>
            </div>
            <button type="submit" class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
          </form>
        </div>
        <span class="x-right" style="line-height:40px">共<?php echo htmlentities($assembluCount); ?>条 · 共<?php echo htmlentities(getInt($assembluCount/25)); ?>页</span>
      </xblock>
      <div class="container-wrap">
        <div class="box-1">
          <table class="layui-table">
            <thead>
          <tr>
            <!--<th>-->
              <!--<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>-->
            <!--</th>-->
            <th width="2%"> 操作</th>
            <th width="13%">
              组件编号
              <span class="layui-table-sort layui-inline"  lay-sort="<?php if($sort == 'asc'): ?>asc<?php else: ?>desc<?php endif; ?>">
                <a href="<?php echo url('/index/Assembly/assemblyInfo',['sort'=>'asc']); ?>"><i class="layui-edge layui-table-sort-asc"></i></a>
                <a href="<?php echo url('/index/Assembly/assemblyInfo',['sort'=>'desc']); ?>"><i class="layui-edge layui-table-sort-desc"></i></a>
              </span>
            </th>
            <th>工装类型</th>
            <th>备注</th>
            <th>创建人</th>
            <th>创建时间</th>
            <th>最后修改人</th>
            <th>修改时间</th>
          </tr>
        </thead>
        <tbody>
        <?php if(is_array($assemblyInfo) || $assemblyInfo instanceof \think\Collection || $assemblyInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $assemblyInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
          <tr>
            <!--<td width="2% ">-->
              <!--<div class="layui-unselect layui-form-checkbox"  data-id='<?php echo htmlentities($info['id']); ?>' lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>-->
            <!--</td>-->
            <td class="td-manage" width="50px;">
              <a title="编辑"onclick="x_admin_show('修改操作','<?php echo url('index/Assembly/assemblyEdit',['id'=>$info['id']]); ?>',500,400)" href="javascript:;">
                <i style="color: green" class="layui-icon"></i>
              </a>
              <a title="删除" onclick="delete_(this,'<?php echo htmlentities($info['id']); ?>')" href="javascript:void(0);" >
                <i  style="color:red;" class="layui-icon"></i>
              </a>
              <a title="添加明细" onclick="x_admin_show('生成内图','<?php echo url('index/Internal/internalAddAssembly',['assembly_code'=>$info['id']]); ?>',400,400)" href="javascript:;"><i style="color: green" class="iconfont nav_right">&#xe6b9;</i></a>
            </td>
            <td>
                <?php
                    $count = getAssembly($info['assembly_code']);
                if($count == 0): ?>
                <?php echo htmlentities($info['assembly_code']); else: ?>
              <a style="color: #0000cc" href="javascript:void(0);" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($info['assembly_code']); ?></span> 的内图','<?php echo url('index/Internal/internalInfo',['assembly_code'=>$info['assembly_code'],'sort'=>'desc']); ?>')"><?php echo htmlentities($info['assembly_code']); ?></a>
                <?php endif; ?>
            </td>
            <td><?php echo htmlentities($info['looling_type_name']); ?></td>
            <td><?php echo htmlentities($info['remark']); ?></td>
            <td><?php echo htmlentities($info['create_name']); ?></td>
            <td><?php echo htmlentities($info['create_time']); ?></td>
            <td><?php echo htmlentities($info['modify_name']); ?></td>
            <td><?php echo htmlentities($info['update_time']); ?></td>
          </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
        </div>
      </div>
      <div class="page">
        <?php echo $assemblyInfo; ?>
      </div>

    </div>
    <script>
        //批量删除
        function delAll (drawing_detail_id) {
            var data = tableCheck.getData();
            if(data == ''){
                layer.msg('请选择需要删除的数据');
                return;
            }
            layer.confirm('确认要删除吗？',function(index){
                //捉到所有被选中的，发异步进行删除
                $.ajax({
                    url:"<?php echo url('/index/Assembly/delAll'); ?>",
                    type:"POST",
                    dataType:"json",
                    data:{
                        dra_id:drawing_detail_id,
                        data:data   //数据
                    },
                    success:function (res) {
                        if(res === 1 ){
                            layer.alert("删除成功", {icon: 6},function () {
                                window.location.reload();  //刷新父级页面
                            });
                        }else {
                            layer.alert("删除失败", {icon: 5});
                        }
                    },
                });
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

      /*删除*/
      function delete_(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              var url = "<?php echo url('/index/Assembly/delete'); ?>";
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
  </body>
</html>