<?php /*a:2:{s:88:"I:\Project\WebServer\www\project\Hy\application\index\view\test_record\quality_show.html";i:1542107491;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
        <?php if(is_array($quality) || $quality instanceof \think\Collection || $quality instanceof \think\Paginator): $i = 0; $__LIST__ = $quality;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
        <div class="layui-form-item">
            <label class="layui-form-label">生产记录</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="log_id" value="<?php echo htmlentities($list['log_id']); ?>" disabled>
                <input type="hidden" class="layui-input" name="id" value="<?php echo htmlentities($list['id']); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">质量描述</label>
            <div class="layui-input-block" >
                <textarea placeholder="请输入内容" class="layui-textarea" name="quality"><?php echo htmlentities($list['quality']); ?></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">错误原因</label>
            <div class="layui-input-block" >
                <textarea placeholder="请输入内容" class="layui-textarea" name="cause"><?php echo htmlentities($list['cause']); ?></textarea>
            </div>
        </div>
        <!--<div class="layui-form-item">-->
            <!--<label class="layui-form-label">扣款金额</label>-->
            <!--<div class="layui-input-block" >-->
                <!--<input type="text" class="layui-input" name="cost" value="<?php echo htmlentities($list['cost']); ?>">-->
            <!--</div>-->
        <!--</div>-->
        <div class="layui-form-item">
            <label class="layui-form-label">落实跟踪</label>
            <div class="layui-input-block" >
                <textarea placeholder="请输入内容" class="layui-textarea" name="result"><?php echo htmlentities($list['result']); ?></textarea>
            </div>
        </div>
        <div style="border: 2px black solid;box-shadow: 10px 10px 5px #888888;">
            <br><br>
            <div class="layui-form-item" <?php echo $list['person1']=="" ? "hidden" : ""; ?>  id="person1Div">
                <label class="layui-form-label">责任人1</label>
                <div class="layui-input-block">
                    <?php if($list['person1']): ?>
                    <a class="layui-btn" title="点击取消签名" id="person1Qx"><?php echo htmlentities($list['person1']); ?> / <?php echo htmlentities($list['person1Time']); ?> / 取消签名</a>
                    <?php else: ?>
                    <a class="layui-btn" id="person1Btn" hidden>等待签名</a>
                    <?php endif; ?>
                    <script>
                        $(function () {
                            $("#person1Qx").click(function () {
                                $("#person1Qx").text("已取消，请先保存");
                                $("#person1").val("");
                                $("#person1Time").val("");
                                $("#person1CostDiv").hide();
                                $("#person1Cost").val("");
                            });
                        });
                    </script>
                    <input type="hidden" class="layui-input" name="person1" id="person1" value="<?php echo htmlentities($list['person1']); ?>">
                </div>
            </div>
            <div class="layui-form-item" hidden>
                <label class="layui-form-label">责任人1日期</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="person1Time" id="person1Time" value="<?php echo htmlentities($list['person1Time']); ?>">
                </div>
            </div>
            <div class="layui-form-item" id="person1CostDiv" <?php echo $list['person1']=="" ? "hidden" : ""; ?>>
                <label class="layui-form-label">1-金额</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="person1Cost" id="person1Cost" value="<?php echo htmlentities($list['person1Cost']); ?>">
                </div>
            </div>
            <div class="layui-form-item" <?php echo $list['person2']=="" ? "hidden" : ""; ?> id="person2Div">
                <label class="layui-form-label">责任人2</label>
                <div class="layui-input-block" >
                    <?php if($list['person2']): ?>
                    <a class="layui-btn" title="点击取消签名" id="person2Qx"><?php echo htmlentities($list['person2']); ?> / <?php echo htmlentities($list['person2Time']); ?> / 取消签名</a>
                    <?php else: ?>
                    <a class="layui-btn" id="person2Btn" hidden>等待签名</a>
                    <?php endif; ?>
                    <script>
                        $(function () {
                            $("#person2Qx").click(function () {
                                $("#person2Qx").text("已取消，请先保存");
                                $("#person2").val("");
                                $("#person2Time").val("");
                                $("#person2CostDiv").hide();
                                $("#person2Cost").val("");
                            });
                        });
                    </script>
                    <input type="hidden" class="layui-input" name="person2" id="person2" value="<?php echo htmlentities($list['person2']); ?>">
                </div>
            </div>
            <div class="layui-form-item" hidden>
                <label class="layui-form-label">责任人2日期</label>
                <div class="layui-input-block" >
                    <input type="text" class="layui-input" name="person2Time" id="person2Time" value="<?php echo htmlentities($list['person2Time']); ?>">
                </div>
            </div>
            <div class="layui-form-item" id="person2CostDiv" <?php echo $list['person2']=="" ? "hidden" : ""; ?>>
                <label class="layui-form-label">2-金额</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="person2Cost" id="person2Cost" value="<?php echo htmlentities($list['person2Cost']); ?>">
                </div>
            </div>
            <div class="layui-form-item" <?php echo $list['person3']=="" ? "hidden" : ""; ?> id="person3Div">
                <label class="layui-form-label">责任人3</label>
                <div class="layui-input-block" >
                    <?php if($list['person3']): ?>
                    <a class="layui-btn" title="点击取消签名" id="person3Qx"><?php echo htmlentities($list['person3']); ?> / <?php echo htmlentities($list['person3Time']); ?> / 取消签名</a>
                    <?php else: ?>
                    <a class="layui-btn" id="person3Btn" hidden>等待签名</a>
                    <?php endif; ?>
                    <script>
                        $(function () {
                            $("#person3Qx").click(function () {
                                $("#person3Qx").text("已取消，请先保存");
                                $("#person3").val("");
                                $("#person3Time").val("");
                                $("#person3CostDiv").hide();
                                $("#person3Cost").val("");
                            });
                        });
                    </script>
                    <input type="hidden" class="layui-input" name="person3" id="person3" value="<?php echo htmlentities($list['person3']); ?>">
                </div>
            </div>
            <div class="layui-form-item" hidden>
                <label class="layui-form-label">责任人3日期</label>
                <div class="layui-input-block" >
                    <input type="text" class="layui-input" name="person3Time" id="person3Time" value="<?php echo htmlentities($list['person3Time']); ?>">
                </div>
            </div>
            <div class="layui-form-item" id="person3CostDiv" <?php echo $list['person3']=="" ? "hidden" : ""; ?>>
                <label class="layui-form-label">3-金额</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="person3Cost" id="person3Cost" value="<?php echo htmlentities($list['person3Cost']); ?>">
                </div>
            </div>
            <center><button class="layui-btn" type="button" lay-submit id="allQm">责任人签名</button></center>
            <script>
                $(function () {
                    $("#allQm").click(function () {
                        var person1 = $("#person1").val();
                        var person2 = $("#person2").val();
                        var person3 = $("#person3").val();

                        if(!person1){
                            $("#person1Btn").text("<?php echo htmlentities(app('session')->get('user.user_name')); ?> / <?php echo date('Y-m-d H:i:s'); ?>");
                            $("#person1Btn").show();
                            $("#person1Div").show();
                            $("#person1CostDiv").show();
                            $("#person1").val("<?php echo htmlentities(app('session')->get('user.user_name')); ?>");
                            $("#person1Time").val("<?php echo date('Y-m-d H:i:s'); ?>");

                            return false;
                        }

                        if (!person2){
                            $("#person2Btn").text("<?php echo htmlentities(app('session')->get('user.user_name')); ?> / <?php echo date('Y-m-d H:i:s'); ?>");
                            $("#person2Btn").show();
                            $("#person2Div").show();
                            $("#person2CostDiv").show();
                            $("#person2").val("<?php echo htmlentities(app('session')->get('user.user_name')); ?>");
                            $("#person2Time").val("<?php echo date('Y-m-d H:i:s'); ?>");
                            return false;
                        }

                        if(!person3){
                            $("#person3Btn").text("<?php echo htmlentities(app('session')->get('user.user_name')); ?> / <?php echo date('Y-m-d H:i:s'); ?>");
                            $("#person3Btn").show();
                            $("#person3Div").show();
                            $("#person3CostDiv").show();
                            $("#person3").val("<?php echo htmlentities(app('session')->get('user.user_name')); ?>");
                            $("#person3Time").val("<?php echo date('Y-m-d H:i:s'); ?>");
                            return false;
                        }
                        if(person1 && person2 && person3){
                            layer.alert("签名人数已到上限", {icon: 5,time:700});
                        }
                    });
                });
            </script>
            <br><br>
        </div>
        <br><br>
        <div class="layui-form-item">
            <label class="layui-form-label">落实人员</label>
            <div class="layui-input-block" >
                <?php if($list['tracer']): ?>
                <a class="layui-btn" title="点击取消签名" id="tracerQx"><?php echo htmlentities($list['tracer']); ?> / <?php echo htmlentities($list['tracerTime']); ?> / 取消签名</a>
                <?php else: ?>
                <a class="layui-btn" title="检验员签名" id="tracerQm">签名</a>
                <?php endif; ?>
                <script>
                    $(function () {
                        $("#tracerQm").click(function () {
                            $("#tracerQm").text("<?php echo htmlentities(app('session')->get('user.user_name')); ?>:已签名，请先保存");
                            $("#tracer").val("<?php echo htmlentities(app('session')->get('user.user_name')); ?>");
                            $("#tracerTime").val("<?php echo date('Y-m-d H:i:s'); ?>");
                        });
                        $("#tracerQx").click(function () {
                            $("#tracerQx").text("已取消，请先保存");
                            $("#tracer").val("");
                            $("#tracerTime").val("");
                        });
                    });
                </script>
                <input type="hidden" class="layui-input" name="tracer" id="tracer" value="<?php echo htmlentities($list['tracer']); ?>">
            </div>
        </div>
        <div class="layui-form-item" hidden>
            <label class="layui-form-label">落实日期</label>
            <div class="layui-input-block" >
                <input type="hidden" class="layui-input" name="tracerTime" id="tracerTime" value="<?php echo htmlentities($list['tracerTime']); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">检验员</label>
            <div class="layui-input-block" >
                <?php if($list['inspector']): ?>
                <a class="layui-btn" title="点击取消签名" id="inspectorQx"><?php echo htmlentities($list['inspector']); ?> / <?php echo htmlentities($list['inspectorTime']); ?> / 取消签名</a>
                <?php else: ?>
                <a class="layui-btn" title="检验员签名" id="inspectorQm">签名</a>
                <?php endif; ?>
                <script>
                    $(function () {
                        $("#inspectorQm").click(function () {
                            $("#inspectorQm").text("<?php echo htmlentities(app('session')->get('user.user_name')); ?>:已签名，请先保存");
                            $("#inspector").val("<?php echo htmlentities(app('session')->get('user.user_name')); ?>");
                            $("#inspectorTime").val("<?php echo date('Y-m-d H:i:s'); ?>");
                        });
                        $("#inspectorQx").click(function () {
                            $("#inspectorQx").text("已取消，请先保存");
                            $("#inspector").val("");
                            $("#inspectorTime").val("");
                        });
                    });
                </script>
                <input type="hidden" class="layui-input" name="inspector" id="inspector" value="<?php echo htmlentities($list['inspector']); ?>">
            </div>
        </div>
        <div class="layui-form-item" hidden>
            <label class="layui-form-label">检验日期</label>
            <div class="layui-input-block" >
                <input type="hidden" class="layui-input" name="inspectorTime" id="inspectorTime" value="<?php echo htmlentities($list['inspectorTime']); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">质量主管</label>
            <div class="layui-input-block">
                <?php if($list['manager']): ?>
                <a class="layui-btn" title="点击取消签名" id="managerQx"><?php echo htmlentities($list['manager']); ?>  /  取消签名</a>
                <?php else: ?>
                <a class="layui-btn" title="检验员签名" id="managerQm">签名</a>
                <?php endif; ?>
                <script>
                    $(function () {
                        $("#managerQm").click(function () {
                            $("#managerQm").text("<?php echo htmlentities(app('session')->get('user.user_name')); ?>:已签名，请先保存");
                            $("#manager").val("<?php echo htmlentities(app('session')->get('user.user_name')); ?>");
                        });
                        $("#managerQx").click(function () {
                            $("#managerQx").text("已取消，请先保存");
                            $("#manager").val("");
                        });
                    });
                </script>
                <input type="hidden" class="layui-input" name="manager" id="manager" value="<?php echo htmlentities($list['manager']); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block" >
                <input type="text" class="layui-input" name="remark" value="<?php echo htmlentities($list['remark']); ?>">
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="layui-form-item">
            <label class="layui-form-label">
            </label>
            <button class="layui-btn" lay-submit lay-filter="addId">
                修改
            </button>
            <button class="layui-btn" lay-submit lay-filter="delId">
                删除
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
            $.post("<?php echo url('index/TestRecord/qualitySave'); ?>",data.field,function(info){
                if (info) {
                    layer.alert("添加成功", {icon: 6},function () {
                        window.parent.location.reload();  //刷新父级页面
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前弹出层
                        parent.layer.close(index);
                    });
                }else{
                    layer.alert("添加失败", {icon: 5});
                }
            },'json');
            return false;
        });
        //监听删除
        form.on('submit(delId)', function(data){
            //console.log(data);
            $.post("<?php echo url('index/TestRecord/qualityDel'); ?>",data.field,function(info){
                if (info) {
                    layer.alert("删除成功", {icon: 6},function () {
                        window.parent.location.reload();  //刷新父级页面
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前弹出层
                        parent.layer.close(index);
                    });
                }else{
                    layer.alert("删除失败", {icon: 5});
                }
            },'json');
            return false;
        });
    });
</script>
</body>

</html>