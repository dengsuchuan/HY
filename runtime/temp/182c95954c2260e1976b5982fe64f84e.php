<?php /*a:2:{s:86:"I:\Project\WebServer\www\project\Hy\application\index\view\employee\employee-info.html";i:1541478155;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
        <a href="">人力资源</a>
        <a>
          <cite>员工列表</cite>
        </a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <xblock>
        <a class="layui-btn"  target="_blank" href="<?php echo url(); ?>"><i class="iconfont">&#xe718;</i> 框架页面</a>

        <!--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>-->
        <button class="layui-btn" onclick="x_admin_show('添加员工','<?php echo url('index/Employee/employeeAdd'); ?>',500,550)"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：<?php echo htmlentities($employeeInfoCount); ?>条· 共<?php echo htmlentities(getInt($employeeInfoCount/100)); ?>页</span>

      </xblock>
      <div class="container-wrap">
        <div class="box-1">
          <table class="layui-table">
            <thead>
            <tr>
            <!--<th>-->
              <!--<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>-->
            <!--</th>-->
            <th  width="40px;">操作</th>
            <th>员工编号</th>
            <th>员工姓名</th>
            <th>手机号</th>
            <th>部门名称</th>
            <th>职务名称</th>
              <th>备注</th>
              <th>身份</th>
              <th>定额权限</th>
              <th>价格权限</th>
              <th>报价权限</th>
            <th>身份证号码</th>
            <th>银行卡号</th>
            <th>业主</th>
            <th>是否离职</th>
            <th>开户行</th>
            <th>进厂日期</th>
            <th>离职日期</th>
            <th>创建时间</th>
            <th>更新时间</th>
        </thead>
        <tbody>
        <?php if(is_array($employeeInfo) || $employeeInfo instanceof \think\Collection || $employeeInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $employeeInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
          <tr>
            <!--<td>-->
              <!--<div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>-->
            <!--</td>-->
            <td>
              <a title="编辑"onclick="x_admin_show('修改操作','<?php echo url('index/Employee/employeeEdit',['id'=>$info['id']]); ?>',500,550)" href="javascript:;">
                <i style="color: green" class="layui-icon"></i>
              </a>
              <a title="删除" onclick="delete_(this,'<?php echo htmlentities($info['id']); ?>')" href="javascript:;">
                <i  style="color:red;" class="layui-icon"></i>
              </a>
              <?php if(app('session')->get('user.admin') == 'admin'): if($info['employee_lv'] == 0): ?>
              <a title="设置为管理员" onclick="admin('<?php echo htmlentities($info['id']); ?>','1')" href="javascript:;">
                <i class="layui-icon layui-icon-username"></i>
              </a>
              <?php else: ?>
              <a title="取消管理员" onclick="admin('<?php echo htmlentities($info['id']); ?>','0')" href="javascript:;">
                <i class="layui-icon layui-icon-close"></i>
              </a>
              <?php endif; endif; ?>
            </td>
            <td><?php echo htmlentities($info['employee_code']); ?></td>
            <td><?php echo htmlentities($info['employee_name']); ?></td>
            <td><?php echo htmlentities($info['tle']); ?></td>
            <td>
              <?php if($info['department_name'] == ''): ?>
              未指定
              <?php else: ?>
              <?php echo htmlentities($info['department_name']); endif; ?>
            </td>
            <td>
              <?php if($info['duties_name'] == ''): ?>
              未指定
              <?php else: ?>
              <?php echo htmlentities($info['duties_name']); endif; ?>
            </td>
            <td><?php echo htmlentities($info['annotation']); ?>
            <td>
            <?php if($info['employee_lv'] == 0): ?>
             普通员工
            <?php else: ?>
            管理员
            <?php endif; ?>
           </td>
            <td>
              <?php if($info['is_quota'] == 1): ?>
              修改
              <?php else: ?>
              查看
              <?php endif; ?>
            </td>
            <td>
              <?php switch($info['is_price']): case "0": ?>隐藏<?php break; case "1": ?>查看<?php break; case "2": ?>修改<?php break; default: endswitch; ?>
            </td>
            <td>
              <?php switch($info['is_offer']): case "0": ?>隐藏<?php break; case "1": ?>查看<?php break; case "2": ?>修改<?php break; default: endswitch; ?>
            </td>
            <td><?php echo htmlentities($info['id_card_no']); ?></td>
            <td><?php echo htmlentities($info['bank_card']); ?></td>
            <td><?php echo htmlentities($info['owner']); ?></td>
            <td>
              <?php if($info['is_leftis'] != 0): ?>
              是
              <?php else: ?>
              否
              <?php endif; ?>
            </td>
            <td><?php echo htmlentities($info['opening_bank']); ?></td>
            <td><?php echo htmlentities($info['factory_date']); ?></td>
            <td><?php echo htmlentities($info['leave_date']); ?></td>
            <td><?php echo htmlentities($info['create_time']); ?></td>
            <td><?php echo htmlentities($info['update_time']); ?></td>
          </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
        </div>
      </div>
      </div>
      <div class="page">
        <?php echo $employeeInfo; ?>
    </div>
    <script>
     function admin(id,admin) {
         $.ajax({
             url:"<?php echo url('/index/Employee/employeeLv'); ?>",
             type:"POST",
             dataType:"json",
             data:{
                 id:id,
                 admin:admin   //数据
             },
             success:function (res) {
                 if(res === 1 ){
                     layer.alert("更改成功", {icon: 6},function () {
                         window.location.reload();  //刷新父级页面
                     });
                 }else {
                     layer.alert("更改失败", {icon: 5});
                 }
             },
         });
     }
     /*删除*/
     function delete_(obj,id){
         layer.confirm('确认要删除吗？',function(index){
             var url = "<?php echo url('/index/Employee/delete'); ?>";
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
    </script>
  </body>

</html>