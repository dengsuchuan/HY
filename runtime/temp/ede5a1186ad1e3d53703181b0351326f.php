<?php /*a:2:{s:81:"I:\Project\WebServer\www\project\Hy\application\index\view\blueprint\process.html";i:1541478154;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
  <a class="layui-btn"  target="_blank" href="<?php echo url(); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>
  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 5px;">
    <legend>工艺信息</legend>
    <div class="layui-row">
      <div class="container-wrap">
        <div class="box-1">
          <table class="layui-table">
            <thead>
            <tr>
              <th>明细编号</th>
              <th>公司编号</th>
              <th>外图编号</th>
              <th>图纸名称</th>
              <th>材料</th>
              <th>类型</th>
              <th>客户</th>
              <th>批量</th>
              <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($blueprintInfo) || $blueprintInfo instanceof \think\Collection || $blueprintInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $blueprintInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$blueprintInfoList): $mod = ($i % 2 );++$i;?>
            <tr>
              <td><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></td>
              <td><?php echo htmlentities($blueprintInfoList['drawing_internal_id']); ?></td>
              <td><?php echo htmlentities($blueprintInfoList['drawing_externa_id']); ?></td>
              <td><?php echo htmlentities($blueprintInfoList['drawing_name']); ?></td>
              <td><?php echo htmlentities($blueprintInfoList['heat_treatment']); ?></td>
              <td><?php echo htmlentities($blueprintInfoList['drawing_type']); ?></td>
              <td><?php echo htmlentities($blueprintInfoList['client_id']); ?></td>
              <td><?php echo htmlentities($blueprintInfoList['if_batch']); ?></td>
              <?php $blueprintInfoList = getblueprintInfoList($detail_id);?>
              <td class="td-manage">
                <?php if($blueprintInfoList['files_state']==0||$blueprintInfoList['drawing_externa_id']==""||!widget('Widget/drawing_check',['drawing_id'=>$blueprintInfoList['drawing_externa_id']])): ?><!-- 不继承或者外图继承无效 -->
                <a title="图纸" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的图纸文件',
          '<?php echo url('index/blueprint/is_DrawingFiles',['id'=>$blueprintInfoList['id'],'key'=>'wai','drawing_num'=>$blueprintInfoList['drawing_detail_id']]); ?>')" href="javascript:;">
                  <span class="layui-badge layui-bg-<?php echo widget('Widget/files_check',['id'=>$blueprintInfoList['id'],'tip'=>'abroad']); ?>">图</span></a>
                <?php elseif($blueprintInfoList['files_state']==1): ?> <!-- 继承 -->
                <a title="图纸" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的图纸文件',
          '<?php echo url('index/blueprint/is_outDrawing',['id'=>$blueprintInfoList['drawing_externa_id']]); ?>')" href="javascript:;"><span class="layui-badge layui-bg-orange">图</span></a>
                <?php endif; ?>
                <a title="模型" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的3d模型文件',
          '<?php echo url('index/blueprint/is_DrawingFiles',['id'=>$blueprintInfoList['id'],'key'=>'nei','drawing_num'=>$blueprintInfoList['drawing_detail_id']]); ?>')" href="javascript:;"><span class="layui-badge layui-bg-<?php echo widget('Widget/files_check',['id'=>$blueprintInfoList['id'],'tip'=>'within']); ?>">3D</span></a>
                <a title="程序单" onclick="x_admin_show('图纸明细 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的程序单文件',
          '<?php echo url('index/blueprint/is_DrawingFiles',['id'=>$blueprintInfoList['id'],'key'=>'cheng','drawing_num'=>$blueprintInfoList['drawing_detail_id']]); ?>')" href="javascript:;"><span class="layui-badge layui-bg-<?php echo widget('Widget/files_check',['id'=>$blueprintInfoList['id'],'tip'=>'engineering']); ?>">程</span></a>
                <?php if($blueprintInfoList['is_gongxu'] !=0): ?>
                <a title="工"  href="javascript:;" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的工艺信息','<?php echo url('index/blueprint/process',['drawing_detail_id'=>$blueprintInfoList['drawing_detail_id']]); ?>')" ><span class="layui-badge layui-bg-green">工</span></a>
                <?php else: ?>
                <a title="工"  href="javascript:;" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></span> 的工艺信息','<?php echo url('index/blueprint/process',['drawing_detail_id'=>$blueprintInfoList['drawing_detail_id']]); ?>')" ><span  class="layui-badge layui-bg-blue">工</span></a>
                <?php endif; ?>
              </td>

            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </fieldset>
  <xblock>
    <button class="layui-btn layui-btn-danger" onclick="delAll('<?php echo htmlentities($drawing_detail_id); ?>')"><i class="layui-icon"></i>批量删除</button>
    <button class="layui-btn" onclick="x_admin_show('工序信息','<?php echo url('index/blueprint/addProcess',['id'=>$drawing_detail_id]); ?>',500,500)"><i class="layui-icon"></i>添加</button>
      <button class="layui-btn" onclick ="sort('<?php echo htmlentities($drawing_detail_id); ?>')" >一键排序</button>
      <button class="layui-btn" onclick ="x_admin_show('一键复制','<?php echo url('index/blueprint/copyProcess',['id'=>$drawing_detail_id]); ?>',500,400)">一键复制</button>
    <span class="x-right" style="line-height:40px">共<?php echo htmlentities($count); ?>条 · 共<?php echo htmlentities(getInt($count/25)); ?>页</span>
  </xblock>
  <div class="layui-row">
    <div class="container-wrap">
      <div class="box-1">
        <table class="layui-table">
          <thead>
            <tr>
              <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
              </th>
              <th>操作</th>
              <th>工艺编号</th>
              <th>工艺类型</th>
              <th>工艺说明</th>
              <th>工序定额h(小时)</th>
              <th>是否检验</th>
              <?php if(app('session')->get('user.is_offer') !=0): ?>
              <th>报价定额h(小时)</th>
              <th>工序报价</th>
              <?php endif; ?>
              <th>外协费用</th>
              <th>备注</th>
            </tr>
          </thead>
          <tbody>
          <?php if(is_array($processInfo) || $processInfo instanceof \think\Collection || $processInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $processInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$processInfoList): $mod = ($i % 2 );++$i;?>
            <tr>
              <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo htmlentities($processInfoList['id']); ?>'><i class="layui-icon">&#xe605;</i></div>
              </td>
                <td>
                    <!--<a title="详" onclick="x_admin_show('工序详情 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($processInfoList['process_id']); ?></span> 修改操作','<?php echo url('index/blueprint/editProcess',['id'=>$processInfoList['id']]); ?>',450)" href="javascript:;"><i class="layui-icon">详</i></a>-->
                    <a title="修改" onclick="x_admin_show('修改工序 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($processInfoList['process_id']); ?></span> 修改操作','<?php echo url('index/blueprint/editProcess',['id'=>$processInfoList['id']]); ?>',500,500)" href="javascript:;"><i class="layui-icon" style="color: green">&#xe642;</i></a>
                    <a title="删除" onclick="delete_process(this,'<?php echo htmlentities($processInfoList['id']); ?>','<?php echo htmlentities($processInfoList['drawing_detial_id']); ?>')"><i class="layui-icon" style="color:red"></i></a>
                </td>
              <td>
                <?php echo substr($processInfoList['process_id'],strpos($processInfoList['process_id'],'P')+1); ?>
                  <span class="layui-table-sort layui-inline">
                    <i class="layui-edge layui-table-sort-asc" attr-id="<?php echo htmlentities($processInfoList['id']); ?>" attr-drawing_detial_id="<?php echo htmlentities($processInfoList['drawing_detial_id']); ?>"></i>
                    <i class="layui-edge layui-table-sort-desc" attr-id="<?php echo htmlentities($processInfoList['id']); ?>" attr-drawing_detial_id="<?php echo htmlentities($processInfoList['drawing_detial_id']); ?>"></i>
                  </span>
              </td>
              <td><?php echo htmlentities($processInfoList['process_name']); ?> --- <?php echo htmlentities($processInfoList['process_price']); ?></td>
              <td><?php echo $processInfoList['process_content'];?></td>
              <td><?php echo htmlentities($processInfoList['process_quota']); ?></td>
              <td>
                <?php if($processInfoList['if_check'] == 1): ?>
                <span class="layui-badge layui-bg-blue">是</span>
                <?php else: ?>
                <span class="layui-badge layui-bg-gray">否</span>
                <?php endif; ?>
              </td>
              <?php if(app('session')->get('user.is_offer') !=0): ?>
              <td><?php echo htmlentities($processInfoList['quota_quotation']); ?></td>
              <td><?php echo htmlentities($processInfoList['process_quoted_price']); ?></td>
              <?php endif; ?>
              <td><?php echo htmlentities($processInfoList['process_real_price']); ?></td>
              <td><?php echo htmlentities($processInfoList['remark']); ?></td>
            </tr>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="page">
      <?php echo $processInfo; ?>
    </div>
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
                url:"<?php echo url('/index/Blueprint/processDelAll'); ?>",
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
    //往上走
    $(".layui-table-sort-asc").click(function () {
        var url = "<?php echo url('/index/Blueprint/updateAsc'); ?>";
        var id = $(this).attr('attr-id');
        var drawing_detial_id = $(this).attr('attr-drawing_detial_id');
        var postData ={"id":id,"drawing_detial_id":drawing_detial_id};
        $.post(url,postData,function (result) {
              if(result.error === 1000 ){
                  layer.msg(result.msg,{icon:5,time:1000});
              }else if(result.error === 1) {
                  window.location.reload();  //刷新父级页面
              }else {
                  layer.msg(result.msg,{icon:5,time:1000});
              }
        },"json");
    });
    //往下走
    $(".layui-table-sort-desc").click(function () {
        var url = "<?php echo url('/index/Blueprint/updateDesc'); ?>";
        var id = $(this).attr('attr-id');
        var drawing_detial_id = $(this).attr('attr-drawing_detial_id');
        var postData ={"id":id,"drawing_detial_id":drawing_detial_id};
        $.post(url,postData,function (result) {
            if(result.error === 1000 ){
                layer.msg(result.msg,{icon:5,time:1000});
            }else if(result.error === 1) {
                window.location.reload();  //刷新父级页面
            }else {
                layer.msg(result.msg,{icon:5,time:1000});
            }
        },"json");
    });

    //排序
    $(".listorder input").blur(function () {
        var listorder =  $(this).val();
        var id = $(this).attr('attr-id');
        var url = "<?php echo url('/index/Blueprint/updateSort'); ?>";
        var postData ={"id":id,"listorder":listorder,'table':"product_process","value":"sort"};
        $.post(url,postData,function (result) {
            if(result == 1 ){
                layer.alert("更新成功、排序对应工序编号", {icon: 6},function () {
                    window.location.reload();  //刷新父级页面
                });
            }else {
                layer.alert("更新失败", {icon: 5});
            }
        },"json")
    });
    function sort(id) {
        var url = "<?php echo url('/index/Blueprint/onekeySort'); ?>";
        var postData ={"id":id};
        $.post(url,postData,function (result) {
            if(result === 1 ){
                layer.alert("排序成功", {icon: 6},function () {
                    window.location.reload();  //刷新父级页面
                });
            }else {
                layer.alert("排序失败", {icon: 5});
            }
        },"json")
    }

    /*删除*/
    function delete_process(obj,id,drawing_detial_id){
        layer.confirm('确认要删除吗？',function(index){
            var url = "<?php echo url('/index/Blueprint/deleteProcess'); ?>";
            var postData ={"id":id,"drawing_detial_id":drawing_detial_id};
            $.post(url,postData,function (result) {
                if(result === 1 ){
                    layer.alert("删除成功", {icon: 6},function () {
                        window.location.reload();  //刷新父级页面
                    });
                }else {
                    layer.alert("删除失败", {icon: 5});
                }
            },"json");
        });
    }


</script>
</body>
</html>