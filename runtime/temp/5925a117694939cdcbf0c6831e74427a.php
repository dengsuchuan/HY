<?php /*a:2:{s:76:"I:\Project\WebServer\www\project\Hy\application\index\view\task\in-task.html";i:1541587638;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1541478155;}*/ ?>
﻿  <!doctype html>
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
        <a href="">任务管理</a>
        <a>
          <cite>在制任务</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <?php if($model===1): ?>
        <button class="layui-btn" onclick="x_admin_show('下达任务','<?php echo url('index/ProductTask/addProductTask',['id'=>$id]); ?>',600,500)"><i class="layui-icon"></i>添加</button>
        <?php endif; ?>
        <span class="x-right" style="line-height:40px">共<?php echo htmlentities($oCount); ?>条 · 共<?php echo htmlentities(getInt($oCount/25)); ?>页</span>
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
            <th>任务编号</th>
            <th>产品图号</th>
            <th>产品名称</th>
            <th>外来图号</th>
            <th>材料</th>
            <th>数量</th>
            <th>图纸工艺</th>
            <th>下达日期</th>
            <th>内图编号</th>
            <th>外图编号</th>
            <?php if($model===1): ?>
            <th>是否完成</th>
            <?php endif; ?>
            <th>要求日期</th>
            <th>设备名称</th>
            <th>备注</th>
            <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if(is_array($productTaskInfo) || $productTaskInfo instanceof \think\Collection || $productTaskInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $productTaskInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;$blueprintInfoList = getblueprintInfo($info['order_detial_id']);?>

        <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td><?php echo htmlentities($info['task_id']); ?></td>
            <td><?php echo htmlentities($blueprintInfoList['drawing_detail_id']); ?></td>
            <td><?php echo htmlentities(getOrderDrawingName($info['order_detial_id'])); ?></td>
            <td></td>
            <td><?php echo htmlentities(getMaterialType($blueprintInfoList['material'])); ?></td>
            <td><?php echo htmlentities($info['task_qty']); ?></td>
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
            <td><?php echo htmlentities($info['create_time']); ?></td>
          <?php $order_detial_id = getTaskIdExternal($info['order_detial_id'])?>
          <td> <a href="javascript:;" onclick="x_admin_show('','<?php echo url('index/blueprint/blueprintInfo',['codeId'=>$order_detial_id,'key'=>'internal']); ?>')" ><span style="color: #1E9FFF"><?php echo htmlentities(getTaskIdExternal($info['order_detial_id'])); ?></span></a></td>
          <?php $drawing_externa_id = getTaskIdWaiExternal($info['order_detial_id'])?>
          <td> <a href="javascript:;" onclick="x_admin_show('','<?php echo url('index/blueprint/blueprintInfo',['codeId'=>$drawing_externa_id,'key'=>'externa']); ?>')" ><span style="color: #1E9FFF"><?php echo htmlentities(getTaskIdWaiExternal($info['order_detial_id'])); ?></span></a></td>
          <?php if($model===1): ?>
            <td>
              <?php if($info['if_completr'] == 1): ?>
                  完成
               <?php else: ?>
                  未完成
              <?php endif; ?>
            </td>
          <?php endif; ?>
          <td></td>
          <td>
            <?php $equipmentInfo = getEquipmentInfo($info['eqpmt_id']);?>
             <?php echo htmlentities($equipmentInfo['eqpmt_name']); ?>
          </td>
          <td><?php echo htmlentities($info['remark']); ?></td>
            <td class="td-manage">
              <button class="layui-btn layui-btn layui-btn-xs"  onclick="x_admin_show('编辑','<?php echo url('index/Task/editTask',['id'=>$info['id']]); ?>',600,500)" ><i class="layui-icon">&#xe642;</i>编辑</button>
            </td>
          </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
          </div>
        </div>
      </div>
      <div class="page">
       <?php echo $productTaskInfo; ?>
      </div>
      <?php if($model==1): ?>
      <div class="x-body "  style="margin-bottom: 5em">
        <form  class="layui-form">
          <div class="layui-form-item">
            <label for="process_name" class="layui-form-label">任务编号</label>
            <div class="layui-input-inline">
              <input type="text" id="process_name" value="<?php echo htmlentities($taskCode); ?>" disabled lay-verify="required" autocomplete="off" class="layui-input" >
            </div>
          </div>
          <div class="layui-form-item">
            <label for="process_price" class="layui-form-label">订单明细</label>
            <div class="layui-input-inline">
              <input type="text" id="process_price" value="<?php echo htmlentities($orderDetailCode); ?>" disabled  lay-verify="required" name="order_detial_id"  autocomplete="off" class="layui-input"  placeholder="￥">
              <input type="hidden"  value="<?php echo htmlentities($orderDetailID); ?>" disabled  lay-verify="required" name="order_detial_id"  autocomplete="off" class="layui-input"  placeholder="￥">
            </div>
          </div>
          <div class="layui-form-item">
            <label for="process_price" class="layui-form-label">任务数量</label>
            <div class="layui-input-inline">
              <input type="text" id="cost_price" name="task_qty"  lay-verify="required" value="<?php echo htmlentities($orderplan_qty); ?>" autocomplete="off" class="layui-input"  >
            </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label">是否完成</label>
            <div class="layui-input-block">
              <input type="checkbox"  name="if_completr" lay-skin="switch" lay-filter="switchTest" lay-text="是|否">
              <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">设备编号</label>
            <div class="layui-input-block">
              <select name="eqpmt_id" lay-verify="required">
                <option value=""></option>
                <?php if(is_array($euipmentInfo) || $euipmentInfo instanceof \think\Collection || $euipmentInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $euipmentInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo htmlentities($info['id']); ?>"><?php echo htmlentities($info['eqpmt_id']); ?>--<?php echo htmlentities($info['eqpmt_name']); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
            </div>
          </div>

          <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block">
              <textarea class="layui-textarea"  id="remark" name="remark"></textarea>
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
      <?php endif; ?>
      <script>
          layui.use(['form'], function(){
              $ = layui.jquery;
              var form = layui.form,layer = layui.layer;

              //监听提交
              form.on('submit(addId)', function(data){
                  //console.log(data);
                  $.post("<?php echo url('index/ProductTask/addProductTask'); ?>",data.field,function(info){
                      if (info) {
                          layer.alert("添加成功", {icon: 6},function () {
                              window.location.reload();  //刷新父级页面

                          });
                      }else{
                          layer.alert("添加失败", {icon: 5});
                      }
                  },'json');
                  return false;
              });


          });
      </script>
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