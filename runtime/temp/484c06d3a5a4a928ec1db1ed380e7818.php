<?php /*a:2:{s:84:"I:\Project\WebServer\www\project\Hy\application\index\view\bao_jia\delivery_add.html";i:1544254075;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
<div class="x-body">
  <form class="layui-form">
    <div class="layui-form-item">
      <label class="layui-form-label">报价单编号</label>
      <div class="layui-input-block" >
        <input type="text" class="layui-input" value="<?php echo htmlentities($quoteId); ?>" disabled>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">摘要说明</label>
      <div class="layui-input-block" >
        <input type="text" class="layui-input" name="summary" value="">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">确认金额</label>
      <div class="layui-input-block" >
        <input type="text" class="layui-input" name="amount" value="0">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">客户简称</label>
      <div class="layui-input-block">
        <select name="clientName" lay-search="" >
          <option value=""></option>
          <?php if(is_array($client) || $client instanceof \think\Collection || $client instanceof \think\Paginator): $i = 0; $__LIST__ = $client;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
          <option value="<?php echo htmlentities($list['client_abbreviation']); ?>"><?php echo htmlentities($list['client_abbreviation']); ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">是否定额</label>
      <div class="layui-input-block">
        <input type="checkbox" name="ifPrice" lay-skin="switch" lay-text="是|否" checked>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">客户确认</label>
      <div class="layui-input-block">
        <input type="checkbox" name="determine" lay-skin="switch" lay-text="是|否">
      </div>
    </div>
    <div class="layui-form-item">
      <label for="factory_date" class="layui-form-label">确认日期</label>
      <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
        <input type="text" name="determineTime" class="layui-input" id="determineTime">
      </div>
      <script>
          layui.use('laydate', function(){
              var laydate = layui.laydate;

              //执行一个laydate实例
              laydate.render({
                  elem: '#determineTime' //指定元素
              });
          });
      </script>
    </div>
    <input type="hidden" class="layui-input" name="create_name" value="<?php echo htmlentities(app('session')->get('user.user_name')); ?>">
    <input type="hidden" class="layui-input" name="quoteId" value="<?php echo htmlentities($quoteId); ?>">
    <div class="layui-form-item">
      <label class="layui-form-label">备注</label>
      <div class="layui-input-block" >
        <input type="text" class="layui-input" name="remarks" value="">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">
      </label>
      <button class="layui-btn" lay-submit lay-filter="addId">
        确认添加
      </button>
    </div>
  </form>
</div>
<script>
    $(function () {
        layui.use(['form'], function(){
            $ = layui.jquery;
            var form = layui.form,layer = layui.layer;
            //监听提交
            form.on('submit(addId)', function(data){
                if(data.field['ifPrice']){
                    data.field['ifPrice']="1"
                }else{
                    data.field['ifPrice']="0"
                }
                if(data.field['determine']){
                    data.field['determine']="1"
                }else{
                    data.field['determine']="0"
                }
                $.post("<?php echo url('index/BaoJia/savequote'); ?>",data.field,function(info){
                    if (info) {
                        layer.msg("添加成功", {time:1000,icon: 6},function () {
                            window.parent.location.reload();  //刷新父级页面
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前弹出层
                            parent.layer.close(index);
                        });
                    }else{
                        layer.msg("添加失败", {time:1000,icon: 5});
                    }
                },'json');
                return false;
            });
        });
    });
</script>
</body>

</html>