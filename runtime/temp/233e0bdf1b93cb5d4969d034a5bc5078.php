<?php /*a:2:{s:89:"I:\Project\WebServer\www\project\Hy\application\index\view\administrators\admin-info.html";i:1541478154;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1541478155;}*/ ?>
﻿ <!doctype html>
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
        <a href="">人力资源</a>
        <a>
          <cite>管理员列表</cite>
        </a>

      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <xblock>
        <a class="layui-btn"  target="_blank" href="<?php echo url(); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>
        <button class="layui-btn" onclick="x_admin_show('添加管理员','<?php echo url('index/Administrators/adminAdd'); ?>',500,400)"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：<?php echo htmlentities($adminInfoCount); ?> 条 · 共<?php echo htmlentities(getInt($adminInfoCount/100)); ?>页</span>

      </xblock>
      <div class="container-wrap">
        <div class="box-1">
          <table class="layui-table">
            <thead>
            <tr>
              <th width="40px;">操作</th>
              <th>编号</th>
              <th>姓名</th>
              <th>手机</th>
              <th>邮箱</th>
              <th>登陆次数</th>
              <th>角色</th>
            <th>加入时间</th>

        </thead>
        <tbody>
        <?php if(is_array($adminInfo) || $adminInfo instanceof \think\Collection || $adminInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $adminInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
          <tr>
            <td>
              <a title="编辑"  onclick="x_admin_show('修改操作','<?php echo url('index/Administrators/adminEdit',['id'=>$info['id']]); ?>',500,400)" href="javascript:;">
                <i style="color: green" class="layui-icon"></i>
              </a>
              <a title="删除" onclick="delete_(this,'<?php echo htmlentities($info['id']); ?>')" href="javascript:;">
                <i  style="color:red;" class="layui-icon"></i>
              </a>
            </td>
            <td><?php echo htmlentities($info['admin_code']); ?></td>
            <td><?php echo htmlentities($info['admin_name']); ?></td>
            <td><?php echo htmlentities($info['tie']); ?></td>
            <td><?php echo htmlentities($info['mailbox']); ?></td>
            <td><?php echo htmlentities($info['login_number']); ?></td>
            <td>超级管理员</td>
            <td><?php echo htmlentities($info['create_time']); ?></td>
          </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
        </div>
      </div>
      <div class="page">
        <?php echo $adminInfo; ?>
      </div>
    </div>
    <script>
        /*删除*/
        function delete_(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                var url = "<?php echo url('/index/Administrators/delete'); ?>";
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