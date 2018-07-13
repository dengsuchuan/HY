<?php /*a:2:{s:68:"D:\code\Hy\application\index\view\blueprint\add-drawing-externa.html";i:1531488111;s:52:"D:\code\Hy\application\index\view\public\header.html";i:1529297217;}*/ ?>
<!doctype html>
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
    <div class="x-body">
        <form  class="layui-form">
          <div class="layui-form-item">
              <label for="drawing_external_id" class="layui-form-label">外来图号</label>
              <div class="layui-input-inline">
                  <input type="text" id="drawing_external_id" name="drawing_external_id" lay-verify="required" autocomplete="off" class="layui-input" value="">
                  <p id="pLog" style="color:red"></p>
              </div>
              <button type="button" class="layui-btn" id="createId">生成</button>
          </div>
          <div class="layui-form-item">
              <label for="remark" class="layui-form-label">备注</label>
              <div class="layui-input-inline">
                  <input type="text" id="remark" name="remark" lay-verify="required" autocomplete="off" class="layui-input">
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
        $(function () {
            //自动生成编号
            $("#createId").click(function () {
                $("#drawing_external_id").val("<?php echo htmlentities($createId); ?>");
                layer.msg('现在是自动生成的外图编号<br>书写自定义编号时请不要占用自动生成编号<br>此提示显示3秒', {
                    time: 3000, //20s后自动关闭
                });
                $("#pLog").text("当前是自动生成编号状态，请勿修改");
            });
        });


        layui.use(['form'], function(){
          $ = layui.jquery;
          var form = layui.form,layer = layui.layer;

          //监听提交
          form.on('submit(addId)', function(data){
            //console.log(data);
              $.post("<?php echo url('index/Blueprint/addDrawingExternalId'); ?>",data.field,function(info){
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
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>