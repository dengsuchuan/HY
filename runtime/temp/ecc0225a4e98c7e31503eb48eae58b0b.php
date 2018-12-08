<?php /*a:2:{s:88:"I:\Project\WebServer\www\project\Hy\application\index\view\administrators\admin-add.html";i:1541478154;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1541478155;}*/ ?>
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
<div class="x-body ">
  <form  class="layui-form">
    <div class="layui-form-item">
      <label for="admin_code" class="layui-form-label">编号</label>
      <span style="color: red">*</span>
      <div class="layui-input-inline">
        <input type="text" id="admin_code" name="admin_code" value="<?php echo htmlentities($adminCode); ?>" lay-verify="required" disabled autocomplete="off" class="layui-input" >
        <p id="pLog" style="color:red"></p>
      </div>
    </div>


    <div class="layui-form-item">
      <label for="admin_name" class="layui-form-label">姓名</label>
      <div class="layui-input-inline">
        <input type="text" id="admin_name" name="admin_name"  lay-verify="required" autocomplete="off" class="layui-input"  >
        <p id="pLog" style="color:red"></p>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="password" class="layui-form-label">密码</label>
      <div class="layui-input-inline">
        <input type="text" id="password" name="password" lay-verify="required"  autocomplete="off" class="layui-input"  >
        <p id="pLog" style="color:red"></p>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="tie" class="layui-form-label">手机</label>
      <div class="layui-input-inline">
        <input type="text" id="tie" name="tie"   autocomplete="off" class="layui-input"  >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="mailbox" class="layui-form-label">邮箱</label>
      <div class="layui-input-inline">
        <input type="text" id="mailbox" name="mailbox"   autocomplete="off" class="layui-input"  >
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-submit lay-filter="addId">
        增加
      </button>
    </div>
  </form>
</div>
<script>
    layui.use(['form'], function(){
        $ = layui.jquery;
        var form = layui.form,layer = layui.layer;

        //监听提交
        form.on('submit(addId)', function(data){
            //console.log(data);
            $.post("<?php echo url('index/Administrators/adminAdd'); ?>",data.field,function(info){
                if (info) {
                    layer.alert("添加成功", {icon: 6},function () {
                        window.parent.location.reload();  //刷新父级页面
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前弹出层
                        parent.layer.close(index);
                    });
                }else{
                    layer.alert("添加失败", {icon: 5});
                }
            },'json');
            return false;
        });


    });
</script>
</body>

</html>