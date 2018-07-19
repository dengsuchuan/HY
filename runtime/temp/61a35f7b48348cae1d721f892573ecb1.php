<?php /*a:2:{s:60:"D:\code\Hy\application\index\view\blueprint\add-process.html";i:1532012557;s:52:"D:\code\Hy\application\index\view\public\header.html";i:1529297217;}*/ ?>
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
            <label for="process_id" class="layui-form-label">工艺编号</label>
            <div class="layui-input-inline">
                <input type="text" id="process_id" disabled="disabled" name="process_id" lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo htmlentities($drawing_detail_id); ?>">
                <p id="pLog" style="color:red"></p>
            </div>
        </div>


        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">工艺说明</label>
            <div class="layui-input-block">
                <textarea name="process_content" id="content" ></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">工艺类型</label>
            <div class="layui-input-block">
                <select name="process_type" lay-verify="required">
                    <option value=""></option>
                    <?php if(is_array($processType) || $processType instanceof \think\Collection || $processType instanceof \think\Paginator): $i = 0; $__LIST__ = $processType;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$processTypeInfo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo htmlentities($processTypeInfo['id']); ?>"><?php echo htmlentities($processTypeInfo['process_name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <script type="text/javascript">
            //实例化编辑器
            //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
            UE.getEditor('content',{initialFrameWidth:300,initialFrameHeight:200,elementPathEnabled:false,wordCount:false, toolbars:[['bold','superscript','subscript','fontsize','spechars']]});
        </script>

        <!--<div class="layui-form-item">-->
            <!--<label for="process_content" class="layui-form-label">工艺说明</label>-->
            <!--<div class="layui-input-block">-->
                <!--<textarea id="process_content" name="process_content" class="layui-textarea" ></textarea>-->
                <!--<div class="layui-btn-container layadmin-layer-demo" style="margin-top:5px; ">-->
                    <!--<input   type="button" 	class="layui-btn layui-btn-xs" onclick="openModak()" style="width:50px;height: 20px;" value="☼">-->
                <!--</div>-->
                <!--<script>-->
                    <!--function openModak(){-->
                        <!--$("[name='testname']").val("xxxxxxxxxxxxxxx");//向模态框中赋值-->
                        <!--layui.use(['layer'],function () {-->
                            <!--var layer = layui.layer,$=layui.$;-->
                            <!--layer.open({-->
                                <!--type:1,//类型-->
                                <!--area:['200px','200px'],//定义宽和高-->
                                <!--title:'特殊符号输入',//题目-->
                                <!--shadeClose:true,//点击遮罩层关闭-->
                                <!--content: $('#motaikunag')//打开的内容-->
                            <!--});-->
                        <!--})-->
                    <!--}-->
                <!--</script>-->
                <!--<div id="motaikunag" style="display: none;">-->
                    <!--<table class="layui-table">-->
                        <!--<tr>-->
                            <!--<td onclick="inputTs('Φ')">Φ</td>-->
                            <!--<td onclick="inputTs('∥')">∥</td>-->
                            <!--<td onclick="inputTs('◎')">◎</td>-->
                            <!--<td onclick="inputTs('⊙')">⊙</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                            <!--<td onclick="inputTs('○')">○</td>-->
                            <!--<td onclick="inputTs('☆')">☆</td>-->
                            <!--<td onclick="inputTs('□')">□</td>-->
                            <!--<td onclick="inputTs('≡')">≡</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                            <!--<td onclick="inputTs('⊥')">⊥</td>-->
                            <!--<td onclick="inputTs('√')">√</td>-->
                            <!--<td onclick="inputTs('˚')">˚</td>-->
                            <!--<td onclick="inputTs('⌒')">⌒</td>-->
                        <!--</tr>-->
                        <!--<tr>-->

                            <!--<td onclick="inputTs('⊕')">⊕</td>-->
                            <!--<td onclick="inputTs('℃')">℃</td>-->
                            <!--<td onclick="inputTs('±')">±</td>-->
                            <!--<td onclick="inputTs('∠')">∠</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                            <!--<td onclick="inputTs('⊿')">⊿</td>-->
                            <!--<td onclick="inputTs('◁')">◁</td>-->
                            <!--<td onclick="inputTs('↗')">↗</td>-->
                            <!--<td onclick="inputTs('×')">×</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                            <!--<td onclick="inputTs('÷')">÷</td>-->
                            <!--<td onclick="inputTs('≦')">≦</td>-->
                            <!--<td onclick="inputTs('≧')">≧</td>-->
                            <!--<td onclick="inputTs('≠')">≠</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                            <!--<td onclick="inputTs('Ⅰ')">Ⅰ</td>-->
                            <!--<td onclick="inputTs('Ⅱ')">Ⅱ</td>-->
                            <!--<td onclick="inputTs('Ⅲ')">Ⅲ</td>-->
                            <!--<td onclick="inputTs('Ⅳ')">Ⅳ</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                            <!--<td onclick="inputTs('Ⅴ')">Ⅴ</td>-->
                            <!--<td onclick="inputTs('Ⅵ')">Ⅵ</td>-->
                            <!--<td onclick="inputTs('Ⅶ')">Ⅶ</td>-->
                            <!--<td onclick="inputTs('Ⅷ')">Ⅷ</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                            <!--<td onclick="inputTs('Ⅸ')">Ⅸ</td>-->
                            <!--<td onclick="inputTs('Ⅹ')">Ⅹ</td>-->
                            <!--<td onclick="inputTs('Ⅺ')">Ⅺ</td>-->
                            <!--<td onclick="inputTs('Ⅷ')">Ⅻ</td>-->
                        <!--</tr>-->
                    <!--</table>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
        <!--<script>-->
            <!--function inputTs(str) {-->
               <!--var count =  $("#process_content").val() + str;-->
                <!--$("#process_content").val(count);-->
            <!--}-->
        <!--</script>-->
        <div class="layui-form-item">
            <label for="process_quota" class="layui-form-label">工序定额h(小时)</label>
            <div class="layui-input-inline">
                <input type="text" id="process_quota" name="process_quota"  autocomplete="off" class="layui-input" placeholder="￥" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否检验</label>
            <div class="layui-input-block">
                <input type="checkbox"  name="if_check" lay-skin="switch" lay-filter="switchTest" lay-text="是|否">
                <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">工序报价</label>
            <div class="layui-input-inline">
                <input type="text" id="process_quoted_price" name="process_quoted_price"  placeholder="￥"  autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">定额报价</label>
            <div class="layui-input-inline">
                <input type="text" id="quota_quotation"  placeholder="￥"  name="quota_quotation" autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">外协报价</label>
            <div class="layui-input-inline">
                <input type="text" id="process_real_price" placeholder="￥"  name="process_real_price" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-inline">
                <input type="text" id="remark" name="remark" autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">创建人</label>
            <div class="layui-input-inline">
                <input type="text" id="create_name" name="create_name"  autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">明细编号</label>
            <div class="layui-input-inline">
                <input type="text" id="drawing_detial_id" name="drawing_detial_id" lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo htmlentities($drawing_detail_ids); ?>" disabled="disabled">
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
<script>
    layui.use(['form'], function(){
        $ = layui.jquery;
        var form = layui.form,layer = layui.layer;

        //监听提交
        form.on('submit(addId)', function(data){
            //console.log(data);
            $.post("<?php echo url('index/Blueprint/addProcess'); ?>",data.field,function(info){
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


    });
</script>
<script>var _hmt = _hmt || []; (function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();</script>
</body>

</html>