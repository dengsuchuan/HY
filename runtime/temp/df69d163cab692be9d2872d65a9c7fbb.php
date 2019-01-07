<?php /*a:2:{s:81:"I:\Project\WebServer\www\project\Hy\application\index\view\material\material.html";i:1541478155;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <xblock>
        <a class="layui-btn"  target="_blank" href="<?php echo url(); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>

        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加材料','<?php echo url('index/Material/materialAdd'); ?>',500,400)"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据： <?php echo htmlentities($materialInfoCount); ?> 条</span>
      </xblock>
      <div class="container-wrap">
        <div class="box-1">
          <table class="layui-table">
            <thead>
            <tr>
            <th width="2%">
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>操作</th>
            <th>材料名称</th>
            <th>密度</th>
            <th>材料价格</th>
            <th>创建时间</th>
            <th>更新时间</th>
            </tr>
        </thead>
        <tbody>
        <?php if(is_array($materialInfo) || $materialInfo instanceof \think\Collection || $materialInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $materialInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary"  data-id='<?php echo htmlentities($info['id']); ?>' ><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td class="td-manage" width="50px;">
              <a title="编辑"onclick="x_admin_show('修改操作','<?php echo url('index/Material/materialEdit',['id'=>$info['id']]); ?>',500,400)" href="javascript:;">
                <i style="color: green" class="layui-icon"></i>
              </a>
              <a title="删除" onclick="delete_(this,'<?php echo htmlentities($info['id']); ?>')" href="javascript:void(0);" >
                <i  style="color:red;" class="layui-icon"></i>
              </a>
            </td>
            <td><?php echo htmlentities($info['material_id']); ?></td>
            <td><?php echo htmlentities($info['density']); ?></td>
            <td><?php echo htmlentities($info['material_price']); ?></td>
            <td><?php echo htmlentities(sjcTime($info['create_time'])); ?></td>
            <td><?php echo htmlentities(sjcTime($info['update_time'])); ?></td>
          </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
        </div>
      </div>
      <div class="page">

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
                    url:"<?php echo url('/index/Material/delAll'); ?>",
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
        /*删除*/
        function delete_(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                var url = "<?php echo url('/index/Material/delete'); ?>";
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