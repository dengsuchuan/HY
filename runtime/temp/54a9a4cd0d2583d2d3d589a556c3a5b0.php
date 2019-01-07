<?php /*a:2:{s:86:"I:\Project\WebServer\www\project\Hy\application\index\view\internal\internal-info.html";i:1541492431;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
        <a href="">图纸管理</a>
        <a>
          <cite>内部图纸</cite>
        </a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">

    <xblock>
        <a class="layui-btn"  target="_blank" href="<?php echo url(); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>

        <!--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>-->
        <button class="layui-btn" onclick="x_admin_show('添加内图','<?php echo url('index/Internal/internalAdd'); ?>',400,400)"><i class="layui-icon"></i>添加</button>
        <div class="layui-input-inline">
            <!--<input type="tel" id="findText" lay-verify="required|phone" autocomplete="off" placeholder="请输入关键字..." class="layui-input">-->
            <form class="layui-form" action="<?php echo url('index/Internal/internalInfo'); ?>" method="post">
                <?php if($mode == 1): ?>
                <input type="hidden" name="model" value="1" >
                <input type="hidden" name="order" value="<?php echo htmlentities($order); ?>" >
                <?php endif; ?>
                <div class="layui-input-inline">
                    <input type="text" name="modules" autocomplete="off" placeholder="请输入关键字..." class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <select name="id" lay-search="" >
                        <option value=""></option>
                        <optgroup label="内图编号">
                            <?php if(is_array($internalCode) || $internalCode instanceof \think\Collection || $internalCode instanceof \think\Paginator): $i = 0; $__LIST__ = $internalCode;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$InfoList): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($InfoList['id']); ?>"><?php echo htmlentities($InfoList['drawing_Internal_id']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </optgroup>
                    </select>
                </div>
                <button type="submit" class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </form>
        </div>
        <?php if($mode == 1): ?>
        <button class="layui-btn" onclick="exeOrder()"><i class="layui-icon"></i>生成订单明细</button>
        <?php endif; ?>
        <span class="x-right" style="line-height:40px">共<?php echo htmlentities($countInternalInfo); ?>条 · 共<?php echo htmlentities(getInt($countInternalInfo/25)); ?>页</span>
        <script>
            // $(function () {
            //     $("input").click(function () {
            //         $("input").val("");
            //     });
            //     $("xblock").click(function () {
            //         $("dd").val("");
            //     });
            // });
        </script>
    </xblock>
    <div class="container-wrap">
        <div class="box-1">
            <table class="layui-table">
                <thead>
            <tr>
                <?php if($mode == 1): ?>
                <th width="20px;">
                    <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                </th>
                <?php endif; ?>
                <th width="2%">
                    操作
                    <?php if($mode == 1): ?>
                    &nbsp;
                    <?php if($code == 'M'): ?>
                    <a href="<?php echo url('/index/Internal/internalInfo',['model'=>1,'order'=>$order]); ?>"> <span  style="color: red">组</span></a>
                    <?php elseif($code == 'N'): else: ?>
                    <a href="<?php echo url('/index/Internal/internalInfo',['code'=>'M','model'=>1,'order'=>$order]); ?>" style="color:#3020d2;"> <span >组</span></a>
                    <?php endif; else: ?>
                    &nbsp;
                    <?php if($code == 'M'): ?>
                    <a href="<?php echo url('/index/Internal/internalInfo'); ?>"> <span  style="color: red">组</span></a>
                    <?php elseif($code == 'N'): else: ?>
                    <a href="<?php echo url('/index/Internal/internalInfo',['code'=>'M']); ?>" style="color:#3020d2;"> <span >组</span></a>
                    <?php endif; endif; ?>
                </th>
                <th width="13%">
                    内图编号
                    <span class="layui-table-sort layui-inline"  lay-sort="<?php if($sort == 'asc'): ?>asc<?php else: ?>desc<?php endif; ?>">
                <a href="<?php echo url('/index/Internal/internalInfo',['sort'=>'asc']); ?>"><i class="layui-edge layui-table-sort-asc"></i></a>
                <a href="<?php echo url('/index/Internal/internalInfo',['sort'=>'desc']); ?>"><i class="layui-edge layui-table-sort-desc"></i></a>
              </span>
                </th>
                <th>所属组件图纸</th>
                <th>备注</th>
                <th>创建人</th>
                <th>创建时间</th>
                <th>修改人</th>
                <th>修改时间</th>

            </tr>
        </thead>
        <tbody>
        <?php if(is_array($internalInfo) || $internalInfo instanceof \think\Collection || $internalInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $internalInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
        <tr>
            <?php if($mode == 1): ?>
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo htmlentities($info['drawing_Internal_id']); ?>'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <?php endif; ?>

            <td class="td-manage" width="50px;">
                <a title="编辑"onclick="x_admin_show('修改操作','<?php echo url('index/Internal/edit',['id'=>$info['id']]); ?>',500,400)" href="javascript:;">
                    <i style="color: green" class="layui-icon"></i>
                </a>
                <a title="删除" onclick="delete_(this,'<?php echo htmlentities($info['id']); ?>')" href="javascript:;">
                    <i  style="color:red;" class="layui-icon"></i>
                </a>
                <a title="添加明细" onclick="x_admin_show('为内图 <span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($info['drawing_Internal_id']); ?></span> 添加明细','<?php echo url('index/Internal/addDetial', ['id'=>$info['drawing_Internal_id']]); ?>')" href="javascript:;"><i style="color: green" class="iconfont nav_right">&#xe6b9;</i></a>
            </td>
            <td>
                <?php
                    $count = getCodet($info['drawing_Internal_id']);
                if($count == 0): ?>
          <?php echo htmlentities($info['drawing_Internal_id']); else: ?>
                <a title="序号<?php echo htmlentities($info['drawing_Internal_id']); ?>" onclick="x_admin_show('<span class=\'layui-badge layui-bg-blue\'><?php echo htmlentities($info['drawing_Internal_id']); ?></span> 的所有明细','<?php echo url('index/Blueprint/blueprintInfo', ['modules' => $info['drawing_Internal_id']]); ?>')" href="javascript:;"> <span style="color: #1E9FFF"><?php echo htmlentities($info['drawing_Internal_id']); ?></span></a>
                <?php endif; ?>
            </td>
            <td>
                <?php
                    if($info['assembly_code'] != null){
                        echo $info['assembly_code'];
                    }else{
                        echo "";
                    }
                ?>
            </td>
            <td><?php echo htmlentities($info['remark']); ?></td>
            <td><?php echo htmlentities($info['create_name']); ?></td>
            <td><?php echo htmlentities($info['create_time']); ?></td>
            <td><?php echo htmlentities($info['modify_name']); ?></td>
            <td><?php echo htmlentities($info['update_time']); ?></td>

        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
        </div>
    </div>
    <div class="page">
        <?php echo $internalInfo; ?>
    </div>

</div>
<script>
    function exeOrder() {
        var data = tableCheck.getData();
        var code = "<?php echo htmlentities($order); ?>";
        var index = parent.layer.getFrameIndex(window.name);
        if(data == ''){
            layer.msg('请选择数据');
            return;
        }
        //关闭当前弹出层
        x_admin_show('填写订单明细',"<?php echo url('index/Order/addOrderDetail'); ?>?id="+data+"&order="+code+"&type=n");

    }
    /*删除*/

    function delete_(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            var url = "<?php echo url('/index/Internal/delete'); ?>";
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
                url:"<?php echo url('/index/Internal/delAll'); ?>",
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
</script>
</body>
</html>