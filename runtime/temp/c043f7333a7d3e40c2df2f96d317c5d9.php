<?php /*a:2:{s:87:"I:\Project\WebServer\www\project\Hy\application\index\view\equipment\equipmentInfo.html";i:1541478155;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1541478155;}*/ ?>
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
        <a href="">设备和量具</a>
        <a>
          <cite>设备管理</cite>
        </a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
        <a class="layui-btn"  target="_blank" href="<?php echo url(); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>
        <button class="layui-btn" onclick="x_admin_show('添加设备','<?php echo url('index/Equipment/addEquipmentInfo'); ?>')"><i class="layui-icon"></i>添加设备</button>
        <button class="layui-btn"  onclick="openLinke()">维修保养记录</button>
        <div class="layui-input-inline">
            <form class="layui-form" action="<?php echo url('index/Equipment/equipmentInfo'); ?>" method="post">
                <div class="layui-input-inline">
                    <input type="text" name="modules" autocomplete="off" placeholder="请输入关键字..." class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <select name="id" lay-search="" >
                        <option value=""></option>
                        <optgroup label="设备类型">
                            <?php if(is_array($equipmentType) || $equipmentType instanceof \think\Collection || $equipmentType instanceof \think\Paginator): $i = 0; $__LIST__ = $equipmentType;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$equipmentTypeList): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($equipmentTypeList['id']); ?>"><?php echo htmlentities($equipmentTypeList['eqpmt_type']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </optgroup>
                    </select>
                </div>
                <button type="submit" class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </form>
        </div>
        <span class="x-right" style="line-height:40px">共<?php echo htmlentities($equipmentInfoCount); ?>条 · 共<?php echo htmlentities(getInt($equipmentInfoCount/25)); ?>页</span>
    </xblock>
    <div class="container-wrap">
        <div class="box-1">
            <table class="layui-table">
                <thead>
                <tr>
                    <th width="2%">操作</th>
                    <th>编号</th>
                    <th>类型</th>
                    <th>名称</th>
                    <th>模型</th>
                    <th>生产地</th>
                    <th>生产日期</th>
                    <th>购买日期</th>
                    <th>购买价格</th>
                    <th>当前价值</th>
                    <th>正在运行</th>
                    <th>卖出日期</th>
                    <th>使用者</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($equipmentInfo) || $equipmentInfo instanceof \think\Collection || $equipmentInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $equipmentInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$equipmentInfoList): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td class="td-manage" width="50px;">
                        <a title="编辑"onclick="x_admin_show('修改设备','<?php echo url('index/Equipment/editEquipmentInfo',['id'=>$equipmentInfoList['id']]); ?>')" href="javascript:;">
                            <i style="color: green" class="layui-icon"></i>
                        </a>
                        <a title="删除" onclick="delete_(this,'<?php echo htmlentities($equipmentInfoList['id']); ?>')" href="javascript:;">
                            <i  style="color:red;" class="layui-icon"></i>
                        </a>
                        <a title="保养" onclick="x_admin_show('<?php echo htmlentities($equipmentInfoList['eqpmt_id']); ?>的保养记录','<?php echo url('index/EquipmentRepair/repairInfo',['eqpmt_id'=>$equipmentInfoList['eqpmt_id']]); ?>')" href="javascript:;">
                            <i style="color:green;" class="iconfont">&#xe707;</i>
                        </a>
                        <a title="维修" onclick="x_admin_show('<?php echo htmlentities($equipmentInfoList['eqpmt_id']); ?>的维修记录','<?php echo url('index/EquipmentMaintain/maintainInfo',['eqpmt_id'=>$equipmentInfoList['eqpmt_id']]); ?>')" href="javascript:;">
                            <i style="color:red;" class="iconfont">&#xe709;</i>
                        </a>
                    </td>
                    <td><?php echo htmlentities($equipmentInfoList['eqpmt_id']); ?></td>
                    <td><?php echo htmlentities(getEquipmentName($equipmentInfoList['eqpmt_type_id'])); ?></td>
                    <td><?php echo htmlentities($equipmentInfoList['eqpmt_name']); ?></td>
                    <td><?php echo htmlentities($equipmentInfoList['eqpmt_model']); ?></td>
                    <td><?php echo htmlentities($equipmentInfoList['manufacturer']); ?></td>
                    <td><?php echo htmlentities($equipmentInfoList['manufacture_date']); ?></td>
                    <td><?php echo htmlentities($equipmentInfoList['purchasing_date']); ?></td>
                    <td><?php echo htmlentities($equipmentInfoList['price']); ?></td>
                    <td><?php echo htmlentities($equipmentInfoList['current_price']); ?></td>
                    <td><?php echo !empty($equipmentInfoList['is_working']) ? '<span class="layui-badge layui-bg-green">是</span>' : '<span class="layui-badge">否</span>'; ?>  </td>
                    <td><?php echo htmlentities($equipmentInfoList['sell_date']); ?></td>
                    <td><?php echo htmlentities($equipmentInfoList['user']); ?></td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="page">
        <?php echo $equipmentInfo; ?>
    </div>

</div>
<script>
    /*删除*/
    function delete_(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            var url = "<?php echo url('/index/Equipment/delete'); ?>";
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

    function openLinke() {
        layer.confirm('请选择要查看的记录', {
                btn: ['保养','维修'] //按钮
            }, function(){
                x_admin_show('保养记录',"<?php echo url('index/EquipmentRepair/allRepairInfo'); ?>");
                layer.msg('保养', {
                    time: 500, //20s后自动关闭
                });
            }, function(){
                x_admin_show('维修记录',"<?php echo url('index/EquipmentMaintain/allMaintainInfo'); ?>");
                layer.msg('维修', {
                    time: 500, //20s后自动关闭
                });
            }
        );
    }
</script>
</body>
</html>