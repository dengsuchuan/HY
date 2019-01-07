<?php /*a:2:{s:92:"I:\Project\WebServer\www\project\Hy\application\index\view\blueprint\add-drawing-detial.html";i:1545557044;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
            <label class="layui-form-label">明细编号</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" title="无法编辑" value="<?php echo htmlentities($detailArray['drawing_detail_id']); ?>" id="drawing_detail_id"  disabled="">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">内图编号</label>
            <div class="layui-input-inline" id="customNumberDiv">
                <input type="text" class="layui-input" id="customNumber"  placeholder="自定义编号">
            </div>
            <!--<button type="button" class="layui-btn layui-btn-normal" id="model">切换模式</button>-->
            <div class="layui-input-inline" id="voluntarily">
                <select name="modules" lay-verify="required" lay-search="" id="selectMid" lay-filter="selectMid">
                    <option value=""></option>
                    <optgroup label="新的编号">
                        <option value="new"><?php echo htmlentities($internal['new']); ?></option>
                    </optgroup>
                    <optgroup label="以往编号">
                        <?php if(is_array($internal['old']) || $internal['old'] instanceof \think\Collection || $internal['old'] instanceof \think\Paginator): $i = 0; $__LIST__ = $internal['old'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$internalList): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo htmlentities($internalList['drawing_Internal_id']); ?>"><?php echo htmlentities($internalList['drawing_Internal_id']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </optgroup>
                </select>
            </div>
            <p style="color:red" id="customW">* 你选择的是当前日期的编号，在数据库提交的时候可能会更新到新的编号，请留意添加之后的结果。</p>
            <div class="layui-input-inline" id="addMidNumber">
                <input type="hidden" class="layui-input" placeholder="内图编号" id="addMidNumberInput">
                <input type="hidden"  placeholder="临时" id="temp_nternal">
            </div>
            <div class="layui-input-inline" id="mes">
                <input type="hidden" class="layui-input" placeholder="编号描述" id="mesInput">
            </div>
            <input type="hidden" class="layui-btn" id="createNumber">
            <input type="hidden" class="layui-btn layui-btn-warm" id="renovateNumber" title="此按钮只针对当前日期的编号" value="刷新">
            <!--<button type="button" class="layui-btn" onclick="x_admin_show('模具管理','<?php echo url('index/mould/mould'); ?>')" >模具管理</button>-->
            <script>
                $(function () {
                    $("#voluntarily").show(); //自动生成div
                    $("#customNumberDiv").hide();//自定义编号div
                    $("#addMidNumber").hide();//公司编号div
                    $("#mes").hide();//描述div
                    $("#customW").hide();//新旧警告


                    //切换模式
                    $("#model").on("click",function () {
                        $('#voluntarily').toggle();//自动生成div
                        $('#customNumberDiv').toggle();//自定义编号div

                        $("#addMidNumber").hide();//生成公司编号div
                        $("#mes").hide();
                        $("#renovateNumber").hide();

                        $("#customNumber").val("");//自定义编号
                        $("#selectMid").val("");
                    });

                    $("#renovateNumber").on("click",function () {
                        $.ajax({
                            url:"<?php echo url('index/blueprint/getP'); ?>",
                            success:function (data) {
                                $("#addMidNumberInput").val(data);
                            },
                        });
                    });

                    //生成公司编号
                    $("#createNumber").on("click",function () {
                        var customNumber = $("#customNumber").val();
                        var selectMid = $("#selectMid").val();

                        if(customNumber || selectMid){
                            $("#addMidNumber").show();
                            $("#mes").show();
                            var str = customNumber?customNumber:selectMid;
                            var dateId = '';//定义一个保存时间编号的变量
                            if(str == "new"){
                                dateId = "<?php echo htmlentities($internal['new']); ?>";
                                $("#temp_nternal").val("new");
                                $("#customW").show();//新旧警告
                            }else{
                                dateId = str;
                                $("#temp_nternal").val("");
                                $("#customW").hide();//新旧警告
                            }
                            //alert(str)
                            $("#addMidNumberInput").val(dateId);//内图编号写到编辑框
                            $("#renovateNumber").show();
                        }else{
                            layer.msg('数据丢失，请重新选择!',{icon:5,time:1000});
                        }
                    });
                });
            </script>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">外图编号</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="<?php echo htmlentities($detailArray['drawing_external_id']); ?>"  title="无法编辑" id="drawing_external_id" disabled="">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">图纸名称</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value=" " id="drawing_external_name" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">版本</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value=" " id="version" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">材料类型</label>
            <div class="layui-input-inline">
                <div class="layui-input-inline">
                    <select name="material" lay-verify="required" lay-search="" id="findText">
                        <option value=""></option>
                        <?php if(is_array($detailArray['material']) || $detailArray['material'] instanceof \think\Collection || $detailArray['material'] instanceof \think\Paginator): $i = 0; $__LIST__ = $detailArray['material'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$materialList): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo htmlentities($materialList['id']); ?>"><?php echo htmlentities($materialList['material_id']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">热处理类型</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value=" "  id="heat_treatment">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">图纸类型</label>
            <div class="layui-input-inline">
                <div class="layui-input-inline">
                    <select name="modules" lay-verify="required" lay-search="" id="drawing_type">
                        <option value="零件">零件</option>
                        <option value="组件">组件</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">客户简称</label>
            <div class="layui-input-inline">
                <select name="modules" lay-verify="required" lay-search="" id="client_id">
                    <option value>请选择</option>
                    <?php if(is_array($client) || $client instanceof \think\Collection || $client instanceof \think\Paginator): $i = 0; $__LIST__ = $client;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$clientList): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo htmlentities($clientList['id']); ?>"><?php echo htmlentities($clientList['client_abbreviation']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">是否批量</label>
            <div class="layui-input-inline">
                <input type="checkbox" name="close" lay-skin="switch" lay-text="是|否"  id="if_batch">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">材料形状</label>
            <div class="layui-input-block">
                <div class="layui-input-inline">
                    <select name="modules" lay-verify="required" lay-search="" lay-filter="materialSelect" id="materialSelect">
                        <?php if(is_array($materialShapeArray) || $materialShapeArray instanceof \think\Collection || $materialShapeArray instanceof \think\Paginator): $i = 0; $__LIST__ = $materialShapeArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shapeArrayList): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo htmlentities($shapeArrayList['id']); ?>"><?php echo htmlentities($shapeArrayList['shape']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <input type="hidden" class="layui-btn" id="generatingForm">
                <!--<button type="button" class="layui-btn" id="resettinGeneratingForm">重置</button>-->
            </div>
        </div>
        <div id="materialDiv">
            <div class="layui-form-item" id="thickness2">
                <label class="layui-form-label">毛坯</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off"
                           class="layui-input" id="thickness2Input">
                </div>
            </div>
            <div class="layui-form-item" id="thickness">
                <label class="layui-form-label">厚度</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" id="thicknessInput">
                </div>

                <div class="specialDiv">
                    <label class="layui-form-label">保证厚度</label>
                    <input type="checkbox" name="close" lay-skin="switch" lay-text="ON|OFF"   id="memoryThickness">
                </div>
            </div>
            <div class="layui-form-item" id="length">
                <label class="layui-form-label">长度</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" id="lengthInput">
                </div>

                <div class="specialDiv">
                    <label class="layui-form-label">保证长度</label>
                    <input type="checkbox" name="close" lay-skin="switch" lay-text="ON|OFF" id="memoryLength">
                </div>
            </div>
            <div class="layui-form-item" id="width">
                <label class="layui-form-label">宽度</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" id="widthInput">
                </div>

                <div class="specialDiv">
                    <label class="layui-form-label">保证宽度</label>
                    <input type="checkbox" name="close" lay-skin="switch" lay-text="ON|OFF"  id="memoryWidth">
                </div>
            </div>
            <div class="layui-form-item" id="altitude">
                <label class="layui-form-label">高度</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" id="altitudeInput">
                </div>
            </div>
            <div class="layui-form-item" id="specifications">
                <label class="layui-form-label">截面积</label>
                <div class="layui-input-inline">
                    <select lay-verify="required" lay-search="" name="material_type" lay-filter="channel_select" id="channel_select">
                        <option value="">查找规格</option>
                        <optgroup label="选择规格">
                            <?php if(is_array($section) || $section instanceof \think\Collection || $section instanceof \think\Paginator): $i = 0; $__LIST__ = $section;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sectionList): $mod = ($i % 2 );++$i;?>
                            <option value="{'weight':'<?php echo htmlentities($sectionList['weight']); ?>','spec':'<?php echo htmlentities($sectionList['spec']); ?>'}"><?php echo htmlentities($sectionList['spec']); ?>      尺寸:<?php echo htmlentities($sectionList['size']); ?>      理论重量:<?php echo htmlentities($sectionList['weight']); ?>      </option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="layui-form-item" id="sideLength1">
                <label class="layui-form-label">边长1</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input"  id="sideLength1Input">
                </div>
            </div>
            <div class="layui-form-item" id="sideLength2">
                <label class="layui-form-label">边长2</label>
                <div class="layui-input-inline">
                    <input type="text" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input"  id="sideLength2Input">
                </div>
            </div>
            <input type="hidden" id="spec">
            <div class="layui-form-item" id="weight">
                <label class="layui-form-label">重量</label>
                <div class="layui-input-inline">
                    <input type="text" name="weight" lay-verify="required" autocomplete="off" class="layui-input"  id="weightInput" disabled>
                </div>
            </div>
            <div class="layui-form-item" id="saveButton">
                <label class="layui-form-label">
                </label>
                <button  type="button" class="layui-btn" id="addwebsql">保存材料形状参数</button>
                <!--<p id="textTest"></p>-->
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">排料数量</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value=" "  id="layout_qty">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">材料要求</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value=" "  id="material_requirements">
            </div>
        </div>

        <!--设置价格权限-->
        <?php switch(app('session')->get('user.is_price')): case "0": break; case "1": ?>
        <div class="layui-form-item">
            <label class="layui-form-label">产品加工费</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" placeholder="￥" disabled value="0" id="product_mfg_cost">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">产品报价</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input"  placeholder="￥" disabled value="0" id="product_quotation">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">产品实价</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" placeholder="￥" disabled value="0" id="product_real_price">
            </div>
        </div>
        <?php break; default: ?>
        <div class="layui-form-item">
            <label class="layui-form-label">产品加工费</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" placeholder="￥" id="product_mfg_cost">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">产品报价</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input"  placeholder="￥" id="product_quotation">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">产品实价</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" placeholder="￥" id="product_real_price">
            </div>
        </div>
        <?php endswitch; ?>
        <div >
            <label class="layui-form-label">继承图纸文件</label>
            <div class="layui-input-inline">
                <input type="checkbox" checked="true" name="files_state" lay-skin="switch" lay-text="是|否"  id="files_state">
            </div>
        </div>  <!-- 是否继承外图图纸文件 默认选中为是-->
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block">
                <textarea class="layui-textarea"  id="remark"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">
            </label>
            <button type="button"  class="layui-btn" id="addData">
                确认增加
            </button>
        </div>
    </form>
    <div id="mess" style="color: red;"></div>
</div>
<script>


    $(function () {
        //全局变量
        var materialSelectId;

        $("#thickness").hide(); //厚度
        $("#thickness2").hide(); //厚度
        $("#length").hide();//长度
        $("#width").hide();//宽度
        $("#altitude").hide();//高度
        $("#specifications").hide();//规格
        $("#sideLength1").hide();//边长1
        $("#sideLength2").hide();//边长2


        //重置
        $("#resettinGeneratingForm").on("click",function () {
            $("#materialDiv").attr("style"," ");
            $("#addwebsql").hide();//保存按钮

            $("#thickness").hide(); //厚度
            $("#thickness2").hide(); //厚度
            $("#length").hide();//长度
            $("#width").hide();//宽度
            $("#altitude").hide();//高度
            $("#specifications").hide();//规格
            $("#sideLength1").hide();//边长1
            $("#sideLength2").hide();//边长2
            $("#weight").hide();//重量

            materialSelectId = 0;
        });

        $("dd").on("click",function () {
            $("#generatingForm").click();
        });

        $("#thickness").show(); //厚度
        $("#thickness2").show(); //厚度
        $("#length").show();//长度
        $("#width").show();//宽度
        $("#addwebsql").hide();//保存按钮


        //默认板
        $("#materialDiv").attr("style","border:1px #D8BFD8 solid;margin:10px 0 15px 0;padding:10px 10px 10px 0;box-shadow: 10px 10px 5px #888888;");
        $("#altitude").hide();//高度
        $("#sideLength1").hide();//边长1
        $("#sideLength2").hide();//边长2
        $("#specifications").hide();//规格
        $(".specialDiv").show();//保证
        $("#weight").hide();//重量
        materialSelectId = 1;

        //生成
        $("#generatingForm").on("click",function () {
            var materialSelect = parseInt($("#materialSelect").val());
            $("#weight").hide();//重量
            $(".specialDiv").hide();//保证
            $("#materialDiv").attr("style","border:1px #D8BFD8 solid;margin:10px 0 15px 0;padding:10px 10px 10px 0;box-shadow: 10px 10px 5px #888888;");
            $("#addwebsql").hide();//保存按钮
            $("#materialDiv > input").val("");
            materialSelectId = 0;
            switch (materialSelect){
                case 1:
                    $("#thickness").show(); //厚度
                    $("#thickness > label").text("厚度");
                    $("#thickness2").show(); //厚度
                    $("#length").show();//长度
                    $("#width").show();//宽度
                    $(".specialDiv").show();//保证


                    $("#altitude").hide();//高度
                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    $("#specifications").hide();//规格
                    materialSelectId = 1;
                    break;
                case 2:
                    $("#length").show();//长度
                    $("#width").show();//宽度  ->直径
                    $("#width > label").text("直径");


                    $("#thickness").hide(); //厚度
                    $("#thickness2").hide(); //厚度
                    $("#altitude").hide();//高度
                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    $("#specifications").hide();//规格
                    materialSelectId = 2;
                    break;
                case 3:
                    $("#specifications").show();//规格
                    $("#length").show();//长度
                    $("#weight").hide();//重量

                    $("#altitude").hide();//高度
                    $("#width").hide();//宽度 ->腿宽
                    $("#thickness").hide(); //厚度 ->腰厚
                    $("#thickness2").hide(); //厚度 ->腰厚
                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    materialSelectId = 3;
                    break;
                case 4:
                    $("#length").show();//长度
                    $("#thickness").show(); //厚度 ->管厚
                    $("#thickness2").show();
                    $("#thickness > label").text("管厚");
                    $("#width").show();//宽度 ->大径
                    $("#width > label").text("大径");

                    $("#altitude").hide();//高度
                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    $("#specifications").hide();//规格
                    materialSelectId = 4;
                    break;
                case 5:
                    $("#length").show();//长度
                    $("#specifications").show();//规格
                    $("#weight").hide();//重量

                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    $("#thickness").hide(); //厚度
                    $("#thickness2").hide(); //厚度
                    $("#width").hide();//宽度
                    $("#altitude").hide();//高度
                    materialSelectId = 5;
                    break;
                case 6:
                    $("#length").show();//长度
                    $("#specifications").show();//规格
                    $("#weight").hide();//重量

                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    $("#thickness").hide(); //厚度
                    $("#thickness2").hide(); //厚度
                    $("#width").hide();//宽度
                    $("#altitude").hide();//高度
                    materialSelectId = 6;
                    break;
                case 7:
                    $("#length").show();//长度
                    $("#specifications").show();//规格
                    $("#weight").hide();//重量

                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    $("#thickness").hide(); //厚度
                    $("#thickness2").hide(); //厚度
                    $("#width").hide();//宽度
                    $("#altitude").hide();//高度
                    materialSelectId = 7;
                    break;

            }
        });

        var materialSelectArray = new Array();

        $("#addwebsql").on("click",function () {

            materialSelectArray = [];

            var thickness = $("#thicknessInput").val();//厚度
            var thickness2 = $("#thickness2Input").val();//厚度
            var lengths = $("#lengthInput").val();//长度
            var width = $("#widthInput").val();//宽度
            var altitude = $("#altitudeInput").val();//高度
            var specifications = $("#spec").val();//规格
            var sideLength1 = $("#sideLength1Input").val();//边长1
            var sideLength2 = $("#sideLength2Input").val();//边长2
            var weight = $("#weightInput").val();//重量

            var memoryThickness = $("#memoryThickness:checked").val();//保证厚度
            memoryThickness = memoryThickness==undefined?"0":"1";
            var memoryLength = $("#memoryLength:checked").val();//保证长度
            memoryLength = memoryLength==undefined?"0":"1";
            var memoryWidth = $("#memoryWidth:checked").val();//保证宽度
            memoryWidth = memoryWidth==undefined?"0":"1";

            switch (materialSelectId){
                case 1://板
                    materialSelectArray["length_dim"] = lengths;
                    materialSelectArray["width_dim"] = width;
                    materialSelectArray["thickness_Dia"] = thickness;
                    materialSelectArray["thickness2_Dia"] = thickness2;
                    materialSelectArray["if_thickness"] = memoryThickness;
                    materialSelectArray["if_length"] = memoryLength;
                    materialSelectArray["if_width"] = memoryWidth;
                    layer.msg('保存成功!',{icon:6,time:1000});
                    break;
                case 2://棒
                    materialSelectArray["length_dim"] = lengths;//长度
                    materialSelectArray["width_dim"] = width;//直径
                    layer.msg('保存成功!',{icon:6,time:1000});
                    break;
                case 3://槽钢
                    materialSelectArray["length_dim"] = lengths;
                    materialSelectArray["weight"] = weight;
                    materialSelectArray["specifications"] = specifications;//规格
                    break;
                case 4://管
                    materialSelectArray["thickness_Dia"] = thickness;
                    materialSelectArray["length_dim"] = lengths;
                    materialSelectArray["width_dim"] = width;
                    layer.msg('保存成功!',{icon:6,time:1000});
                    break;
                case 5://轨道
                    materialSelectArray["length_dim"] = lengths;
                    materialSelectArray["weight"] = weight;
                    materialSelectArray["specifications"] = specifications;//规格

                    layer.msg('保存成功!',{icon:6,time:1000});
                    break;
                case 6://角钢
                    materialSelectArray["length_dim"] = lengths;
                    materialSelectArray["weight"] = weight;
                    materialSelectArray["specifications"] = specifications;//规格

                    layer.msg('保存成功!',{icon:6,time:1000});
                    break;
                case 7://矩管
                    materialSelectArray["length_dim"] = lengths;
                    materialSelectArray["weight"] = weight;
                    materialSelectArray["specifications"] = specifications;//规格

                    layer.msg('保存成功!',{icon:6,time:1000});
                    break;
            }
            //layer.msg('保存成功!',{icon:6,time:1000});
            console.log(materialSelectArray);
        });


        $("#addData").on("click",function () {
            $("#addwebsql").click();

           var drawing_detail_id = $("#drawing_detail_id").val();
           var addMidNumberInput = $("#addMidNumberInput").val();
           var drawing_external_id = $("#drawing_external_id").val();
           var drawing_external_name = $("#drawing_external_name").val();
           var findText = $("#findText").val();
           var heat_treatment = $("#heat_treatment").val();
           var drawing_type = $("#drawing_type").val();
           var client_id = $("#client_id").val();
           var if_batch = $("#if_batch:checked").val();
            if_batch = if_batch==undefined?"0":"1";
            var files_state = $("#files_state:checked").val();//是否继承图纸
            files_state = files_state==undefined?"0":"1";
            var layout_qty = $("#layout_qty").val();
            var material_requirements = $("#material_requirements").val();
            var product_mfg_cost = $("#product_mfg_cost").val();
            var product_quotation = $("#product_quotation").val();
            var product_real_price = $("#product_real_price").val();
            var remark = $("#remark").val();
            var mesInput = $("#mesInput").val();//编号描述
            var materialSelect = $("#materialSelect").val();//材料形状
            var version = $("#version").val();//材料形状

            //组装数组
            materialSelectArray['drawing_detail_id']=drawing_detail_id;//明细编号
            materialSelectArray['drawing_internal_id']=addMidNumberInput; //内图编号
            materialSelectArray['mesInput']=mesInput; //内图编号描述
            materialSelectArray['drawing_externa_id']=drawing_external_id;//外图编号
            materialSelectArray['drawing_name']=drawing_external_name; //图纸名称
            materialSelectArray['heat_treatment']=heat_treatment;//热处理类型
            materialSelectArray['drawing_type']=drawing_type;//图纸类型
            materialSelectArray['client_id']=client_id; //客户简称  /这里放进去用户ID
            materialSelectArray['if_batch']=if_batch;    //是否批量  1是  0否
            materialSelectArray['files_state']=files_state;    //是否继承
            materialSelectArray['material']=findText;//材料类型 这里放进去的是材料类型的ID  板 槽  之类的
            materialSelectArray['layout_qty']=layout_qty; //排料数量
            materialSelectArray['material_requirements']=material_requirements;//材料要求
            materialSelectArray['product_mfg_cost']=product_mfg_cost; //产品加工费
            materialSelectArray['product_quotation']=product_quotation;//产品报价
            materialSelectArray['product_real_price']=product_real_price;//产品实际价格
            materialSelectArray['remark']=remark;//备注
            materialSelectArray['version']=version;//备注
            materialSelectArray['create_name']="<?php echo htmlentities(app('session')->get('user.user_name')); ?>";//创建人
            materialSelectArray['modify_name']="";//修改人
            materialSelectArray['material_type']=materialSelect;//材料形状
            // materialSelectArray['create_time']= "";//当前时间戳  创建时间
            // materialSelectArray['update_time']= "";//修改时间


            //console.log(materialSelectArray);
            //console.log(materialSelectArray)
                var jsonData = "";
                for(let key in materialSelectArray){
                    jsonData += '"'+key + '":"' +materialSelectArray[key]+'",';
                }
            jsonData = jsonData.substr(0,jsonData.length-1)
            jsonData = "{"+jsonData+"}";
            //console.log(jsonData);
            //alert(drawing_external_name?1:0)
            if(drawing_external_name==" "){
                layer.msg('至少请填写【图纸名称】字段',{icon:5,time:1000});
            }else {
                //写入新的内图信息
                var temp_internal = $("#temp_nternal").val();
                var jsons = "";
                if(temp_internal == "new"){
                    jsons = {"json":jsonData,"drawing_Internal_id":materialSelectArray['drawing_internal_id']};
                }else{
                    jsons = {"json":jsonData};
                }

                //写入图纸明细信息
                $.ajax({
                    url:"<?php echo url('index/blueprint/createBlueprintInfo'); ?>",
                    type:"POST",
                    dataType:"json",
                    data:jsons,
                    success:function (data) {
                        if(data){
                            layer.alert("明细添加成功", {icon: 6},function () {
                                window.parent.location.reload();  //刷新父级页面
                                // 获得frame索引
                                var index = parent.layer.getFrameIndex(window.name);
                                //关闭当前弹出层
                                parent.layer.close(index);
                            });
                        }else{
                            layer.msg('明细添加失败!',{icon:5,time:1000});
                        }
                    },
                });

            }
        });
    });

    layui.use('form', function() {
        $ = layui.jquery;
        var form = layui.form
            , layer = layui.layer;

        //监听事件
        form.on('select(channel_select)', function (data) {
            $("#weightInput").val("");
            var dataJson = $("#channel_select").val();
            dataJson = dataJson.replace(/'/g,'"');
            var dataArray = JSON.parse(dataJson);

            $("#weightInput").val(dataArray['weight']);//给重量编辑框
            $("#spec").val(dataArray['spec']);//给规格编辑框
        });

        form.on('select(materialSelect)', function (data) {
            $("#generatingForm").click();
        });

        form.on('select(selectMid)', function (data) {
            $("#createNumber").click();
        });
    });


</script>
</body>

</html>