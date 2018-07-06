<?php /*a:2:{s:83:"D:\WebServer\www\project\Hy\application\index\view\blueprint\blueprint-outside.html";i:1530868947;s:69:"D:\WebServer\www\project\Hy\application\index\view\public\header.html";i:1528981768;}*/ ?>
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
          <cite>外部图纸</cite>
        </a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加外图','<?php echo url('index/blueprint/addDrawingExterna'); ?>',500,400)"><i class="layui-icon"></i>添加</button>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <div class="layui-input-inline"><input type="tel" id="findText" lay-verify="required|phone" autocomplete="off" placeholder="请输入关键字..." class="layui-input"></div>
        <button class="layui-btn"  lay-submit="" lay-filter="sreach" id="find"><i class="layui-icon">&#xe615;</i></button>
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
      </xblock>
      <div class="container-wrap">
        <div class="box-1">
          <table class="layui-table">
            <thead>
              <tr>
                <th>
                  <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                </th>
                <th>外来图号</th>
                <th>建档日期</th>
                <th>备注</th>
                <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($blueprintOutside) || $blueprintOutside instanceof \think\Collection || $blueprintOutside instanceof \think\Paginator): $i = 0; $__LIST__ = $blueprintOutside;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$blueprintOutsideList): $mod = ($i % 2 );++$i;?>
            <tr>
                <td>
                  <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td>
                    <a title="序号#" onclick="x_admin_show('为外图 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintOutsideList['drawing_external_id']); ?></span> 添加明细','<?php echo url('index/blueprint/addDrawingDetial'); ?>',600)" href="javascript:;"><i class="layui-icon"><?php echo htmlentities($blueprintOutsideList['drawing_external_id']); ?></i></a>
                </td>
                <td><?php echo htmlentities($blueprintOutsideList['create_time']); ?></td>
                <td><?php echo htmlentities($blueprintOutsideList['remark']); ?></td>
                <td class="td-manage">
                  <button class="layui-btn layui-btn layui-btn-xs"  onclick="x_admin_show('编辑','#')" ><i class="layui-icon">&#xe642;</i>编辑</button>
                </td>
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
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
  </body>
</html>