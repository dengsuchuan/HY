<?php /*a:2:{s:88:"I:\Project\WebServer\www\project\Hy\application\index\view\production_records\index.html";i:1542081272;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
 <!doctype html>
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
        <a href="">在制任务</a>
        <a>
          <cite><?php echo htmlentities($task_id); ?>的生产记录</cite>
        </a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="<?php echo url(); ?>" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>

<div class="x-body" >
    <xblock>
        <a class="layui-btn"  target="_blank" href="<?php echo url(); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>
        <button class="layui-btn" id="addLog" onclick="x_admin_show('添加生产记录','<?php echo url('index/ProductionRecords/addLog',['task_id'=>$task_id,'drawing'=>$drawing]); ?>')"><i class="layui-icon"></i>添加生产记录</button>
        <span class="x-right" style="line-height:40px">共<?php echo htmlentities($productLogCount); ?>条 · 共<?php echo htmlentities(getInt($productLogCount/25)); ?>页</span>
    </xblock>
    <div class="container-wrap">
        <div class="box-1">
            <table class="layui-table">
                <thead>
                <tr>
                    <!--<th>-->
                    <!--<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>-->
                    <!--</th>-->
                    <th>操作</th>
                    <!--<th>生产记录编号</th>-->
                    <th>序号</th>
                    <th>检验记录</th>
                    <th>品管</th>
                    <th>类型</th>
                    <th>操作者</th>
                    <th>数量</th>
                    <th>完成日期</th>
                    <th>设备</th>
                    <!--<th>任务编号</th>-->
                    <th>外协费用</th>
                    <th>外协单位</th>
                    <th>合格数</th>
                    <th>质量等级</th>
                    <th>检验员</th>
                    <th>互检人</th>
                    <th>品质放行</th>
                    <th>生产管理审核</th>
                    <th>备注</th>
                    <th>创建日期</th>
                    <th>创建人</th>
                    <th>修改日期</th>
                    <th>修改人</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($productLog) || $productLog instanceof \think\Collection || $productLog instanceof \think\Paginator): $i = 0; $__LIST__ = $productLog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td class="td-manage">
                        <a title="修改" onclick="x_admin_show('修改 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($list['log_id']); ?></span> 生产记录','<?php echo url('index/ProductionRecords/edit',['id'=>$list['log_id'],'drawing'=>$drawing,'task_id'=>$task_id]); ?>')" href="javascript:;"><i style="color: green" class="layui-icon"></i></a>
                        <a title="删除" onclick="delete_(this,'<?php echo htmlentities($list['log_id']); ?>')" href="javascript:void(0);" >
                            <i  style="color:red;" class="layui-icon"></i>
                        </a>
                    </td>
                    <td <?php echo $list['fulfill']==0 ? '' : 'style="background:greenyellow"'; ?>><?php echo substr($list['log_id'],-2); ?></td>
                    <td>
                        <?php $ifczs = ifCz($list['process_id']);if($ifczs): ?>
                        <a style="color: green" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($list['log_id']); ?></span> 的检验记录','<?php echo url('index/TestRecord/viewIndex',['task_id'=>$list['log_id']]); ?>')" href="javascript:;">记录</a>
                        <?php else: ?>
                        <a style="color: green" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($list['log_id']); ?></span> 的检验记录','<?php echo url('index/TestRecord/viewIndex',['task_id'=>$list['log_id']]); ?>')" href="javascript:;">无</a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php $ifczs = ifPk($list['process_id']);if($ifczs): ?>
                        <a style="color: green" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($list['log_id']); ?></span> 的品管','<?php echo url('index/TestRecord/qualityShow',['task_id'=>$list['log_id']]); ?>',500)" href="javascript:;">品管</a>
                        <?php else: ?>
                        <a style="color: green" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($list['log_id']); ?></span> 的品管','<?php echo url('index/TestRecord/qualityShow',['task_id'=>$list['log_id']]); ?>',500)" href="javascript:;">无</a>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlentities(getGyType($list['process_id'])); ?></td>
                    <td><?php echo htmlentities($list['hr_id']); ?></td>
                    <td><?php echo htmlentities($list['complete_qty']); ?></td>
                    <td><?php echo htmlentities($list['complete_date']); ?></td>
                    <td><?php echo htmlentities($list['eqpmt_id']); ?></td>
                    <!--<td><?php echo htmlentities($list['task_id']); ?></td>-->
                    <td><?php echo htmlentities($list['cost']); ?></td>
                    <td><?php echo htmlentities($list['costUnit']); ?></td>
                    <td><?php echo htmlentities($list['product_qty']); ?></td>
                    <td><?php echo htmlentities($list['quality_grade']); ?></td>
                    <td>
                        <?php if($list['qc_inspector']==""): ?>
                        <a title="检验签字" onclick="sign_('<?php echo htmlentities($list['log_id']); ?>','qc_inspector_date','qc_inspector')" href="javascript:void(0);" >
                            未签字
                        </a>
                        <?php else: ?>
                        <a title="取消检验签字" onclick="signDown_('<?php echo htmlentities($list['log_id']); ?>','qc_inspector_date','qc_inspector')" href="javascript:void(0);" >
                            <?php echo htmlentities($list['qc_inspector']); ?> <?php echo htmlentities($list['qc_inspector_date']); ?>
                        </a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($list['other_checker']==""): ?>
                        <a title="互检签字" onclick="sign_('<?php echo htmlentities($list['log_id']); ?>','other_checker_date','other_checker')" href="javascript:void(0);" >
                            未签字
                        </a>
                        <?php else: ?>
                        <a title="取消互检签字" onclick="signDown_('<?php echo htmlentities($list['log_id']); ?>','other_checker_date','other_checker')" href="javascript:void(0);" >
                            <?php echo htmlentities($list['other_checker']); ?> <?php echo htmlentities($list['other_checker_date']); ?>
                        </a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($list['manege_name']==""): ?>
                        <a title="品质放行" onclick="sign_('<?php echo htmlentities($list['log_id']); ?>','manege_date','manege_name')" href="javascript:void(0);" >
                            未签字
                        </a>
                        <?php else: ?>
                        <a title="取消品质放行" onclick="signDown_('<?php echo htmlentities($list['log_id']); ?>','manege_date','manege_name')" href="javascript:void(0);" >
                            <?php echo htmlentities($list['manege_name']); ?> : <?php echo htmlentities($list['manege_date']); ?>
                        </a>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlentities($list['if_audit']); ?></td>
                    <td><?php echo htmlentities($list['remark']); ?></td>
                    <td><?php echo htmlentities($list['create_time']); ?></td>
                    <td><?php echo htmlentities($list['create_name']); ?></td>
                    <td><?php echo htmlentities($list['update_time']); ?></td>
                    <td><?php echo htmlentities($list['update_name']); ?></td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--___________________________________-->
    <div class="page">
        <?php echo $productLog; ?>
    </div>
    <script>
        /*删除*/
        function delete_(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                var url = "<?php echo url('index/ProductionRecords/delete'); ?>";
                var postData ={"id":id};
                $.post(url,postData,function (result) {
                    if(result === 1 ){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }else {
                        layer.msg("删除失败", {icon:5,time:1000});
                    }
                },"json");
            });
        }

        //签字
        function sign_(where,dateKey,nameKey){
            layer.confirm("确定要签名吗？<br>姓名:<?php echo htmlentities(app('session')->get('user.user_name')); ?><br>日期:<?php echo date('Y-m-d'); ?>",function(index){
                var url = "<?php echo url('index/ProductionRecords/sign'); ?>";
                var postData ={"where":where,"dateKey":dateKey,"nameKey":nameKey};
                $.post(url,postData,function (result) {
                    if(result){
                        location.reload();
                        layer.msg('已签名!',{icon:1,time:1000});
                    }else {
                        location.reload();
                        layer.alert("签名失败", {icon: 5});
                    }
                },"json");
            });
        }
        //签字
        function signDown_(where,dateKey,nameKey){
            layer.confirm('确定取消签名吗？',function(index){
                var url = "<?php echo url('index/ProductionRecords/signDown'); ?>";
                var postData ={"where":where,"dateKey":dateKey,"nameKey":nameKey};
                $.post(url,postData,function (result) {
                    if(result){
                        location.reload();
                        layer.msg('已取消签名!',{icon:1,time:1000});
                    }else {
                        location.reload();
                        layer.alert("取消签名失败", {icon: 5});
                    }
                },"json");
            });
        }
        $(function () {
            $("#addLog").click(function () {
                layer.msg('正在加载中...', {time:500});
            })
        });

    </script>
</div>

</body>
</html>