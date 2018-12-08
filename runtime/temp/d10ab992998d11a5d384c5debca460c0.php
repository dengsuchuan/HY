<?php /*a:2:{s:90:"I:\Project\WebServer\www\project\Hy\application\index\view\production_records\add_log.html";i:1542081053;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
<div class="x-body">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">记录编号</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="log_id" value="<?php echo htmlentities($log_id); ?>" disabled >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">任务编号</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="task_id" value="<?php echo htmlentities($task_id); ?>" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">员工</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="hr_id" value="<?php echo htmlentities(app('session')->get('user.user_name')); ?>" disabled >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">完成日期</label>
            <div class="layui-input-block">
                <select name="complete_date" lay-verify="required">
                    <option value='<?php echo date("Y-m-d"); ?>'>今天:<?php echo date("Y-m-d"); ?></option>
                    <option value='<?php echo date("Y-m-d",time()-3600*24); ?>'>昨天:<?php echo date("Y-m-d",time()-3600*24); ?></option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">工艺编号</label>
            <div class="layui-input-inline" >
                <input type="text" class="layui-input" name="process_id" id="process_id" value="" disabled>
            </div><a class="layui-btn layui-btn-sm layui-btn-normal" id="process">选择工艺</a>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block" >
                <a style="color: green">任务数量: <span id="taskCount">0</span> </a>
                <a style="color: green">已完成: <span id="logCount">0</span> </a>
                <a style="color: green">剩余: <span id="lastCount">0</span> </a>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">完成数量</label>
            <div class="layui-input-block" >
                <input type="number" class="layui-input" name="complete_qty" id="complete" value="" lay-verify="required">
                <br>
                <a style="color: red" hidden id="ifCount">完成数量不得超过剩余数量</a>
            </div>
        </div>
        <!--<a href="#" id="sss" onclick="x_admin_show('选择 <?php echo htmlentities($drawing); ?> 的工艺','<?php echo url('index/ProductionRecords/showProcess',['drawing'=>$drawing]); ?>')">选择工艺</a>-->
        <div class="layui-form-item">
            <label class="layui-form-label">设备编号</label>
            <div class="layui-input-block">
                <select name="eqpmt_id" lay-verify="required" lay-search="" >
                    <option value=""></option>
                    <?php if(is_array($eqpmt) || $eqpmt instanceof \think\Collection || $eqpmt instanceof \think\Paginator): $i = 0; $__LIST__ = $eqpmt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo htmlentities($list['eqpmt_name']); ?>"><?php echo !empty($list['eqpmt_name']) ? htmlentities($list['eqpmt_name']) : "空名称 编号:-".$list['eqpmt_id']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <input type="hidden" name="create_name" value="<?php echo htmlentities(app('session')->get('user.user_name')); ?>">
        <div class="layui-form-item">
            <label class="layui-form-label">合格品数量</label>
            <div class="layui-input-block" >
                <input type="number" class="layui-input" name="product_qty" id="product_qty" value="" lay-verify="required" placeholder="禁止修改:请填写完成数量参数" disabled>
            </div>
        </div>
        <div class="layui-form-item" hidden>
            <label class="layui-form-label">质量等级</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="quality_grade" value="1" id="quality_grade" lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" hidden>
            <label class="layui-form-label">是否审核</label>
            <div class="layui-input-block">
                <input type="checkbox" name="if_audit" lay-skin="switch" lay-text="已审|未审">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否外协</label>
            <div class="layui-input-block">
                <input type="checkbox" name="fulfill" lay-filter="fulfill" lay-skin="switch" lay-text="是|否">
            </div>
            <p style="color: red" id="costP" hidden>忽略显示，外协单位和外协费用已清空，请重新选择。</p>
        </div>
        <div id="cost" hidden>
            <div class="layui-form-item">
                <label class="layui-form-label">外协费用</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" id="costInput" name="cost" value="">
                    <p style="color: red" id="costInputP" hidden>外协费用费用必须大于0</p>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">外协单位</label>
                <div class="layui-input-block">
                    <select name="costUnit" lay-search="" >
                        <option value=""></option>
                        <?php if(is_array($client) || $client instanceof \think\Collection || $client instanceof \think\Paginator): $i = 0; $__LIST__ = $client;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo htmlentities($list['client_abbreviation']); ?>"><?php echo htmlentities($list['client_abbreviation']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="remark" value="">
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
       $("#process").click(function () {
           top.SearchTeacherLayerId = top.layer.open({
               title: "选择<?php echo htmlentities($drawing); ?>的工艺",
               type: 2,
               shadeClose: true,
               area: ['85%', '590px'],
               content: "<?php echo url('index/ProductionRecords/showProcess',['drawing'=>$drawing]); ?>",
               success: function () {
                   $(top.document.body).find('#layui-layer-iframe' + top.SearchTeacherLayerId).contents().find("td a").on('click', function () {
                       //alert($(this).attr('data-id'));
                       var process_id = $(this).attr('data-id');//工艺序号
                       var url = "<?php echo url('index/ProductionRecords/getCount'); ?>";
                       var data = {"process_id":process_id,"task_id":"<?php echo htmlentities($task_id); ?>"};
                       $.post(url,data,function(info){
                           var taskCount = info['task_qty'];//任务总数
                           var logCount = info['ProductLogCount'];//目标记录总数
                           var lastCount = (taskCount - logCount).toFixed(2);
                           $("#taskCount").text(taskCount?taskCount:"0");
                           $("#logCount").text(logCount?logCount:"0");
                           $("#lastCount").text(lastCount?lastCount:"0");
                           $("#process_id").val(process_id);
                           $("#completeDiv").show();
                       },'json');

                       top.layer.close(top.SearchTeacherLayerId);
                   });
               }
           });
       });

       //监听输入input
        $("#complete").bind("input propertychange",function(event){
            var inputVal = $("#complete").val();
            inputVal = parseFloat(inputVal);
            var lastCount = $("#lastCount").text();
            lastCount = parseFloat(lastCount);
            if(inputVal > lastCount || inputVal<0){
                $("#ifCount").show();
            }else{
                $("#product_qty").val(inputVal);
                $("#ifCount").hide();
            }
        });
        //判断外协费用
        $("#costInput").bind("input propertychange",function(event){
            var costInput = $("#costInput").val();
            costInput = parseFloat(costInput);
            if(costInput <=0){
                $("#costInputP").show();
                $("#costInput").val("");
            }else{
                $("#costInputP").hide();
            }
        });

    });

    layui.use(['form'], function(){
        $ = layui.jquery;
        var form = layui.form,layer = layui.layer;
        //监听提交
        form.on('submit(addId)', function(data){
            var lastCount = $("#lastCount").text();
            lastCount = parseFloat(lastCount)
            data.field['complere_qty'] = lastCount;
            if(data.field['complete_qty']>lastCount || data.field['complete_qty']<0){
                layer.alert("完成数量不得超过剩余数量: "+lastCount, {icon: 5});
                return false;
            }
            if(data.field['if_audit']){
                data.field['if_audit']="已审"
            }else{
                data.field['if_audit']="未审"
            }
            if(data.field['fulfill']){
                data.field['fulfill']="1"
            }else{
                data.field['fulfill']="0"
            }
            //console.log(data.field);
            $.post("<?php echo url('index/ProductionRecords/saveLog'); ?>",data.field,function(info){
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

        //监听是否外协
        form.on('switch(fulfill)',function (data) {
            $("#costInput").val("");
            if(data.elem.checked){
                $("#cost").show();
                $("#costP").show();
            }else{
                $("#cost").hide();
                $("select[name='costUnit']").val("");
                $("#costP").hide();
            }
        });
    });
</script>
</body>

</html>