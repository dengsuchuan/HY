<?php /*a:2:{s:84:"I:\Project\WebServer\www\project\Hy\application\index\view\current_task\in-task.html";i:1543068690;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
        <a href="">任务管理</a>
        <a>
          <cite><?php echo $btnText=="在制任务" ? "已制任务" : "在制任务"; ?></cite></a>
      </span>
  <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <span class="x-right" style="line-height:40px">共<?php echo htmlentities($oCount); ?>条 · 共<?php echo htmlentities(getInt($oCount/25)); ?>页</span>
  </xblock>
  <div class="layui-row">
    <div class="container-wrap">
      <div class="box-1">
        <table class="layui-table">
          <thead>
          <tr>
            <th>
              <a  href="<?php echo url('index/CurrentTask/inTask',['id'=>$ifCompletr]); ?>" ><button class="layui-btn layui-btn-sm"><?php echo htmlentities($btnText); ?></button></a>
            </th>
            <th>任务编号</th>
            <th>内部图号</th>
            <th>产品名称</th>
            <th>外部图号</th>
            <th>材料</th>
            <th>数量</th>
            <th>图纸工艺</th>
            <th>进度</th>
            <th>下达日期</th>
            <th>要求日期</th>
            <th>设备名称</th>
            <!--<th>是否完成</th>-->
            <th>备注</th>
          </tr>
          </thead>
          <tbody>
          <?php if(is_array($productTaskInfo) || $productTaskInfo instanceof \think\Collection || $productTaskInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $productTaskInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;$blueprintInfoList = getblueprintInfo($info['order_detial_id']);?>
          <tr>
            <td class="td-manage">
              <a title="编辑" onclick="x_admin_show('编辑','<?php echo url('index/Task/editTask',['id'=>$info['id']]); ?>',600,500)"  href="javascript:;">
                <i style="color: green" class="layui-icon"></i>
              </a>
              <a title="删除" onclick="" href="javascript:;">
                <i style="color:red;" class="layui-icon"></i>
              </a>
              <?php if($ifCompletr==1): ?>
              <i class="layui-icon layui-icon-add-1" style="cursor: pointer" onclick="x_admin_show('生产记录','<?php echo url('index/ProductionRecords/index',['task_id'=>$info['task_id'],'drawing'=>$blueprintInfoList['drawing_detail_id']]); ?>')" ></i>
              <?php endif; ?>

            </td>
            <td><span style="cursor: pointer" onclick="x_admin_show('生产记录','<?php echo url('index/ProductionRecords/index',['task_id'=>$info['task_id'],'drawing'=>$blueprintInfoList['drawing_detail_id']]); ?>')"><?php echo htmlentities($info['task_id']); ?></span></td>
            <td>
              <a title="序号 <?php echo htmlentities($blueprintInfoList['drawing_internal_id']); ?>" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'> <?php echo htmlentities($blueprintInfoList['drawing_internal_id']); ?></span> 的所有明细','<?php echo url('index/Blueprint/blueprintInfo', ['modules' => $blueprintInfoList['drawing_internal_id']]); ?>')" href="javascript:;"> <span style="color: #1E9FFF"> <?php echo htmlentities($blueprintInfoList['drawing_internal_id']); ?></span></a>
            </td>
            <td><?php echo htmlentities(getOrderDrawingName($info['order_detial_id'])); ?></td>
            <td>
                <?php $getexternal = getexternal($info['order_detial_id']);?>
              <a title="序号<?php echo htmlentities($getexternal); ?>" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($getexternal); ?></span> 的所有明细','<?php echo url('index/Blueprint/blueprintInfo', ['modules' => $getexternal]); ?>')" href="javascript:;"><i class="layui-icon " style="color: #1E9FFF"><?php echo htmlentities($getexternal); ?></i></a>
             </td>
            <td><?php echo htmlentities(getCaiLiao($info['order_detial_id'])); ?></td>
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

            <?php $data =  getOrderStaus($blueprintInfoList['drawing_detail_id'],$info['task_id'],$info['id']) ;$yans =  yanz($blueprintInfoList['drawing_detail_id'],$info['task_id'],$info['id']) ;?>
            <td>
              <?php echo $data;?>
            </td>
            <td><?php echo htmlentities($info['create_time']); ?></td>
            <td></td>
            <td>
              <?php $equipmentInfo = getEquipmentInfo($info['eqpmt_id']);?>
              <?php echo htmlentities($equipmentInfo['eqpmt_name']); ?>
            </td>
            <!--<td><?php echo $ifCompletr=="1" ? "<li style='color : red'>未完成</li>":"<li style='color:green'>已完成</li>"; ?></td>-->
            <td><?php echo htmlentities($info['remark']); ?></td>
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
  <script>
      $(function () {
          $("#switch").click(function () {
              layer.msg('正在切换到:<?php echo htmlentities($btnText); ?> ', {time:2000});
          })
      });
  </script>
</div>
</body>
</html>