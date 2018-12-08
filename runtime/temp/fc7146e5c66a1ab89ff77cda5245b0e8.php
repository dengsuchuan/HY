<?php /*a:2:{s:91:"I:\Project\WebServer\www\project\Hy\application\index\view\equipment_repair\repairInfo.html";i:1541478155;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1541478155;}*/ ?>
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
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">设备</a>
        <a>
          <cite>设备保养</cite>
        </a>
      </span>
</div>
<div class="x-body">
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加保养','<?php echo url('index/EquipmentRepair/addRepairInfo',['equi_id'=>$eqpmt_id]); ?>')"><i class="layui-icon"></i>添加保养</button>
        <span class="x-right" style="line-height:40px">共<?php echo htmlentities($repairInfoCount); ?>条 · 共<?php echo htmlentities(getInt($repairInfoCount/25)); ?>页</span>
    </xblock>
    <div class="container-wrap">
        <div class="box-1">
            <table class="layui-table">
                <thead>
                <tr>
                    <th width="2%">操作</th>
                    <th>设备编号</th>
                    <th>维护计划日期</th>
                    <th>维护内容</th>
                    <th>维护结果</th>
                    <th>检查日期</th>
                    <th>负责人</th>
                    <th>检查人</th>
                    <th>备注</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($repairInfo) || $repairInfo instanceof \think\Collection || $repairInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $repairInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$repairInfoList): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td class="td-manage" width="50px;"><!-- 这里是设备管理里面某个设备的保养记录表-->
                        <a title="编辑"onclick="x_admin_show('修改记录','<?php echo url('index/EquipmentRepair/editRepairInfo',['id'=>$repairInfoList['id']]); ?>')" href="javascript:;">
                            <i style="color: green" class="layui-icon"></i>
                        </a>
                        <a title="删除" onclick="delete_(this,'<?php echo htmlentities($repairInfoList['id']); ?>')" href="javascript:;">
                            <i  style="color:red;" class="layui-icon"></i>
                        </a>
                    </td>
                    <td><?php echo htmlentities($repairInfoList['eqpmt_id']); ?></td>
                    <td><?php echo htmlentities($repairInfoList['maintenance_plan_date']); ?></td>
                    <td><?php echo htmlentities($repairInfoList['maintenance_content']); ?></td>
                    <td><?php echo htmlentities($repairInfoList['maintenance_result']); ?></td>
                    <td><?php echo htmlentities($repairInfoList['check_date']); ?></td>
                    <td><?php echo htmlentities($repairInfoList['person']); ?></td>
                    <td><?php echo htmlentities($repairInfoList['inspector']); ?></td>
                    <td><?php echo htmlentities($repairInfoList['remarks']); ?></td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="page">
        <?php echo $repairInfo; ?>
    </div>

</div>
<script>
    /*删除*/
    function delete_(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            var url = "<?php echo url('index/EquipmentRepair/delete'); ?>";
            var postData ={"id":id};
            $.post(url,postData,function (result) {
                if(result === 1){
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