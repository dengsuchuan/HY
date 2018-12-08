<?php /*a:2:{s:86:"I:\Project\WebServer\www\project\Hy\application\index\view\employee\employee-edit.html";i:1541478155;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1541478155;}*/ ?>
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
<script src="/static/ueditor/ueditor.config.js"></script>
<script src="/static/ueditor/ueditor.all.min.js"></script>
<script src="/static/ueditor/lang/zh-cn/zh-cn.js"></script>
<style>



</style>
<body>
<div class="x-body ">
    <form  class="layui-form">
        <div class="layui-form-item">
            <label for="employee_code" class="layui-form-label">员工编号</label>
            <div class="layui-input-inline">
                <input type="text" id="employee_code" disabled="disabled" value="<?php echo htmlentities($employeeRow['employee_code']); ?>" lay-verify="required" autocomplete="off" class="layui-input" >
                <input type="hidden" id="id" name="id" disabled="disabled" value="<?php echo htmlentities($employeeRow['id']); ?>" lay-verify="required" autocomplete="off" class="layui-input" >
            </div>
            <span style="color: red">*</span>
        </div>

        <div class="layui-form-item">
            <label for="employee_name" class="layui-form-label">员工姓名</label>
            <div class="layui-input-inline">
                <input type="text" id="employee_name" value="<?php echo htmlentities($employeeRow['employee_name']); ?>"  name="employee_name" lay-verify="required" autocomplete="off" class="layui-input" >
            </div>
            <span style="color: red">*</span>
        </div>
        <div class="layui-form-item">
            <label for="password" class="layui-form-label">登陆密码</label>
            <div class="layui-input-inline">
                <input type="text" id="password"  name="password" lay-verify="required" value="<?php echo htmlentities($employeeRow['password']); ?>"  autocomplete="off" class="layui-input" >
            </div>
            <span style="color: red">*</span>
        </div>
        <div class="layui-form-item">
            <label for="tle" class="layui-form-label">手机号</label>
            <div class="layui-input-inline">
                <input type="text" id="tle"  name="tle"  value="<?php echo htmlentities($employeeRow['tle']); ?>"   autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">部门名称</label>
            <div class="layui-input-block">
                <select name="department_name" >
                    <option value=""></option>
                    <?php if(is_array($departmentInfo) || $departmentInfo instanceof \think\Collection || $departmentInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $departmentInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
                     <option value="<?php echo htmlentities($info['id']); ?>"
                        <?php if($info['id'] == $employeeRow['department_name']): ?>
                             selected
                         <?php endif; ?>
                     ><?php echo htmlentities($info['department_name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">职务名称</label>
            <div class="layui-input-block">
                <select name="duties_name" >
                    <option value=""></option>
                    <?php if(is_array($dutiesInfo) || $dutiesInfo instanceof \think\Collection || $dutiesInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $dutiesInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo htmlentities($info['id']); ?>"
                            <?php if($info['id'] == $employeeRow['duties_name']): ?>
                            selected
                            <?php endif; ?>
                    ><?php echo htmlentities($info['duties_name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <!--<div class="layui-form-item">-->
            <!--<label for="process_id" class="layui-form-label">班次</label>-->
            <!--<div class="layui-input-inline">-->
                <!--<input type="text" id="process_id1" disabled="disabled" name="" lay-verify="required" autocomplete="off" class="layui-input" >-->
                <!--<p id="pLog" style="color:red"></p>-->
            <!--</div>-->
        <!--</div>-->
        <div class="layui-form-item">
            <label for="id_card_no" class="layui-form-label">身份证号码</label>
            <div class="layui-input-inline">
                <input type="text" id="id_card_no" value="<?php echo htmlentities($employeeRow['id_card_no']); ?>" name="id_card_no" autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label for="factory_date" class="layui-form-label">进厂日期</label>
            <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
                <input type="text"  value="<?php echo htmlentities($employeeRow['factory_date']); ?>" name="factory_date" class="layui-input" id="data">
            </div>
            <script>
                layui.use('laydate', function(){
                    var laydate = layui.laydate;

                    //执行一个laydate实例
                    laydate.render({
                        elem: '#data' //指定元素
                    });
                });
            </script>
        </div>
        <div class="layui-form-item">
            <label for="process_id" class="layui-form-label">离职日期</label>
            <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
                <input type="text" value="<?php echo htmlentities($employeeRow['leave_date']); ?>" name="leave_date" class="layui-input" id="data1">
            </div>
            <script>
                layui.use('laydate', function(){
                    var laydate = layui.laydate;

                    //执行一个laydate实例
                    laydate.render({
                        elem: '#data1' //指定元素
                    });
                });
            </script>
        </div>
        <div class="layui-form-item">
            <label for="bank_card" class="layui-form-label">银行卡号</label>
            <div class="layui-input-inline">
                <input type="text"  value="<?php echo htmlentities($employeeRow['bank_card']); ?>"  id="bank_card" name="bank_card"autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label for="owner" class="layui-form-label">业主</label>
            <div class="layui-input-inline">
                <input type="text" id="owner"  name="owner" value="<?php echo htmlentities($employeeRow['owner']); ?>"  autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label for="opening_bank" class="layui-form-label">开户行</label>
            <div class="layui-input-inline">
                <input type="text" id="opening_bank" name="opening_bank"  value="<?php echo htmlentities($employeeRow['opening_bank']); ?>"   autocomplete="off" class="layui-input" >
                <p id="pLog" style="color:red"></p>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否离职</label>
            <div class="layui-input-block">
                <input type="checkbox"  <?php if(1==$employeeRow['is_leftis']): ?>checked=""<?php endif; ?>   name="is_leftis"  lay-skin="switch" lay-filter="switchTest" lay-text="是|否">
                <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
            </div>
        </div>
        <div class="layui-form-item" lay-filter="sex">
            <label class="layui-form-label">定额权限</label>
            <div class="layui-input-block">
                <input type="radio"   <?php if($employeeRow['is_quota'] == 0): ?>checked=""<?php endif; ?>   name="is_quota" value="0" title="查看"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>查看</div></div>
                <input type="radio" <?php if($employeeRow['is_quota'] == 1): ?>checked=""<?php endif; ?>  name="is_quota" value="1" title="修改" ><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon layui-anim-scaleSpring"></i><div>修改</div></div>
            </div>
        </div>
        <div class="layui-form-item" lay-filter="sex">
            <label class="layui-form-label">价格权限</label>
            <div class="layui-input-block">
                <input type="radio" name="is_price" value="0" title="隐藏"  <?php if($employeeRow['is_price'] == 0): ?>checked=""<?php endif; ?> ><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon layui-anim-scaleSpring"></i><div>隐藏</div></div>
                <input type="radio" name="is_price" value="1" title="查看"   <?php if($employeeRow['is_price'] == 1): ?>checked=""<?php endif; ?>  ><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>查看</div></div>
                <input type="radio" name="is_price" value="2" title="修改"  <?php if($employeeRow['is_price'] == 2): ?>checked=""<?php endif; ?>  ><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>修改</div></div>
            </div>
        </div>
        <div class="layui-form-item" lay-filter="sex">
            <label class="layui-form-label">报价权限</label>
            <div class="layui-input-block">
                <input type="radio" name="is_offer" value="0" title="隐藏"  <?php if($employeeRow['is_offer'] == 0): ?>checked=""<?php endif; ?> ><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon layui-anim-scaleSpring"></i><div>隐藏</div></div>
                <input type="radio" name="is_offer" value="1" title="查看"  <?php if($employeeRow['is_offer'] == 1): ?>checked=""<?php endif; ?> ><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>查看</div></div>
                <input type="radio" name="is_offer" value="2" title="修改" <?php if($employeeRow['is_offer'] == 2): ?>checked=""<?php endif; ?> ><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>修改</div></div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-inline">
                <input type="text" id="annotation" value="<?php echo htmlentities($employeeRow['annotation']); ?>" name="annotation" autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <button class="layui-btn" lay-submit lay-filter="addId">
                修改
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form'], function(){
        $ = layui.jquery;
        var form = layui.form,layer = layui.layer;

        //监听提交
        form.on('submit(addId)', function(data){
            //console.log(data);
            $.post("<?php echo url('index/Employee/employeeEdit'); ?>",data.field,function(info){
                if (info) {
                    layer.alert("修改成功", {icon: 6},function () {
                        window.parent.location.reload();  //刷新父级页面
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前弹出层
                        parent.layer.close(index);
                    });
                }else{
                    layer.alert("修改失败", {icon: 5});
                }
            },'json');
            return false;
        });


    });
</script>
</body>

</html>