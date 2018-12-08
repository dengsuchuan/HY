<?php /*a:2:{s:89:"I:\Project\WebServer\www\project\Hy\application\index\view\blueprint\blueprint-infos.html";i:1541513223;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1541478155;}*/ ?>
﻿ <!doctype html>
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
    <div class="x-body">
        <form class="layui-form"  >
            <input type="hidden" class="layui-input" name="id" title="无法编辑" value="<?php echo htmlentities($blueprintInfo['id']); ?>"  >
            <div class="layui-form-item">
                <label class="layui-form-label">明细编号</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" title="无法编辑" value="<?php echo htmlentities($blueprintInfo['drawing_detail_id']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">内图编号</label>
                <div class="layui-input-inline">
                    <select  lay-search="" name="drawing_internal_id">
                        <option value="<?php echo htmlentities($blueprintInfo['drawing_internal_id']); ?>"><?php echo htmlentities($blueprintInfo['drawing_internal_id']); ?></option>
                        <optgroup label="选择内图编号">
                            <?php if(is_array($drawingInternal) || $drawingInternal instanceof \think\Collection || $drawingInternal instanceof \think\Paginator): $i = 0; $__LIST__ = $drawingInternal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$drawingInternalList): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($drawingInternalList['drawing_Internal_id']); ?>"><?php echo htmlentities($drawingInternalList['drawing_Internal_id']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">外图编号</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input"  value="<?php echo htmlentities($blueprintInfo['drawing_externa_id']); ?>" title="无法编辑" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">图纸名称</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="drawing_name" value="<?php echo htmlentities($blueprintInfo['drawing_name']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">版本</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="version" value="<?php echo htmlentities($blueprintInfo['version']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">材料类型</label>
                <div class="layui-input-inline">
                    <select  lay-search="" name="material">
                        <option value="<?php echo htmlentities($blueprintInfo['material']); ?>"><?php echo htmlentities($blueprintInfo['material']); ?></option>
                        <optgroup label="选择材料类型">
                            <?php if(is_array($material) || $material instanceof \think\Collection || $material instanceof \think\Paginator): $i = 0; $__LIST__ = $material;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$materialList): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($materialList['material_id']); ?>"><?php echo htmlentities($materialList['material_id']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">热处理类型</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="heat_treatment" value="<?php echo htmlentities($blueprintInfo['heat_treatment']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">图纸类型</label>
                <div class="layui-input-inline">
                    <select lay-search="" name="drawing_type">
                        <option value="<?php echo htmlentities($blueprintInfo['drawing_type']); ?>"><?php echo htmlentities($blueprintInfo['drawing_type']); ?></option>
                        <optgroup label="选择类型">
                            <option value="零件">零件</option>
                            <option value="组件">组件</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">客户简称</label>
                <div class="layui-input-inline">
                    <select lay-search="" name="client_id">
                        <option value="<?php echo htmlentities($blueprintInfo['client_id']); ?>">  <?php   $clienyname = getClientName($blueprintInfo['client_id']);?><?php echo htmlentities($clienyname['clientName']); ?></option>
                        <optgroup label="选择客户">
                            <?php if(is_array($client) || $client instanceof \think\Collection || $client instanceof \think\Paginator): $i = 0; $__LIST__ = $client;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$clientList): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($clientList['id']); ?>"><?php echo htmlentities($clientList['client_abbreviation']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </optgroup>
                    </select>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">是否批量</label>
                <div class="layui-input-inline">
                    <input type="checkbox"   <?php if(1==$blueprintInfo['if_batch']): ?>checked=""<?php endif; ?>  name="if_batch" lay-skin="switch" lay-filter="switchTest" lay-text="是|否">
                    <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
                </div>
            </div>

            <div id="fff">
                <div class="layui-form-item">
                    <label class="layui-form-label">材料形状</label>
                    <div class="layui-input-inline">
                        <select  lay-search="" name="material_type" lay-filter="material_type" id="material_type">
                            <option value="<?php echo htmlentities($blueprintInfo['material_type']); ?>"><?php echo htmlentities(getMateria($blueprintInfo['material_type'])); ?></option>
                            <optgroup label="选择形状">
                                <?php if(is_array($materialShape) || $materialShape instanceof \think\Collection || $materialShape instanceof \think\Paginator): $i = 0; $__LIST__ = $materialShape;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$materialShapeList): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo htmlentities($materialShapeList['id']); ?>"><?php echo htmlentities($materialShapeList['shape']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
            <div style="border:1px #D8BFD8 solid;margin:10px 0 15px 0;padding:10px 10px 10px 0;box-shadow: 10px 10px 5px #888888;" id="specia">
                <div class="layui-form-item" id="thickness_Dia">
                    <label class="layui-form-label">厚度</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="thickness_Dia" value="<?php echo htmlentities($blueprintInfo['thickness_Dia']); ?>"  >
                    </div>
                    <div class="specialDiv">
                        <label class="layui-form-label">保证厚度</label>
                        <div style="padding-top: 6px;">
                            <input type="checkbox"   <?php if(1==$blueprintInfo['if_thickness']): ?>checked=""<?php endif; ?>  name="if_thickness" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
                            <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item" id="length_dim">
                    <label class="layui-form-label">长度</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="length_dim" value="<?php echo htmlentities($blueprintInfo['length_dim']); ?>"  >
                    </div>
                    <div class="specialDiv">
                        <label class="layui-form-label">保证长度</label>
                        <div style="padding-top: 6px;">
                            <input type="checkbox"   <?php if(1==$blueprintInfo['if_length']): ?>checked=""<?php endif; ?>  name="if_length" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
                            <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item" id="width_dim">
                    <label class="layui-form-label">宽度</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="width_dim" value="<?php echo htmlentities($blueprintInfo['width_dim']); ?>"  >
                    </div>
                    <div class="specialDiv">
                        <label class="layui-form-label">保证宽度</label>
                        <div style="padding-top: 6px;">
                            <input type="checkbox"   <?php if(1==$blueprintInfo['if_width']): ?>checked=""<?php endif; ?>  name="if_width" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
                            <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item" id="altitudeInput">
                    <label class="layui-form-label">高度</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="altitudeInput" value="<?php echo htmlentities($blueprintInfo['altitudeInput']); ?>"  >
                    </div>
                </div>
                <div class="layui-form-item" id="specifications">
                    <label class="layui-form-label">截面积</label>
                    <div class="layui-input-inline">
                        <select  lay-search="" lay-filter="channel_select" id="channel_select">
                            <option value="<?php echo htmlentities($blueprintInfo['specifications']); ?>"><?php echo htmlentities($blueprintInfo['specifications']); ?></option>
                            <optgroup label="选择规格">
                                <?php if(is_array($section) || $section instanceof \think\Collection || $section instanceof \think\Paginator): $i = 0; $__LIST__ = $section;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sectionList): $mod = ($i % 2 );++$i;?>
                                <option value="{'weight':'<?php echo htmlentities($sectionList['weight']); ?>','spec':'<?php echo htmlentities($sectionList['spec']); ?>'}"><?php echo htmlentities($sectionList['spec']); ?>      尺寸:<?php echo htmlentities($sectionList['size']); ?>      理论重量:<?php echo htmlentities($sectionList['weight']); ?>      </option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <input type="hidden" class="layui-input" name="weight" value="<?php echo htmlentities($blueprintInfo['weight']); ?>" id="weightInput"  disabled>
                <input type="hidden" class="layui-input" name="specifications" value="<?php echo htmlentities($blueprintInfo['specifications']); ?>" id="specInput"  disabled>

                <div class="layui-form-item" id="sideLength1">
                    <label class="layui-form-label">边长1</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="sideLength1" value="<?php echo htmlentities($blueprintInfo['sideLength1']); ?>"  >
                    </div>
                </div>
                <div class="layui-form-item" id="sideLength2">
                    <label class="layui-form-label">边长2</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="sideLength2" value="<?php echo htmlentities($blueprintInfo['sideLength2']); ?>"  >
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">排料数量</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="layout_qty" value="<?php echo htmlentities($blueprintInfo['layout_qty']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">备料要求</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="material_requirements" value="<?php echo htmlentities($blueprintInfo['material_requirements']); ?>"  >
                </div>
            </div>



            <!--设置价格权限-->
            <?php switch(app('session')->get('user.is_price')): case "0": break; case "1": ?>
            <div class="layui-form-item">
                <label class="layui-form-label">产品加工费</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input"  disabled value="<?php echo htmlentities($blueprintInfo['product_mfg_cost']); ?>"  placeholder="￥">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">产品报价</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input"  disabled value="<?php echo htmlentities($blueprintInfo['product_quotation']); ?>"  placeholder="￥">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">产品实价</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" disabled value="<?php echo htmlentities($blueprintInfo['product_real_price']); ?>"  placeholder="￥">
                </div>
            </div>
            <?php break; default: ?>
            <div class="layui-form-item">
                <label class="layui-form-label">产品加工费</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="product_mfg_cost" value="<?php echo htmlentities($blueprintInfo['product_mfg_cost']); ?>"  placeholder="￥">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">产品报价</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="product_quotation" value="<?php echo htmlentities($blueprintInfo['product_quotation']); ?>"  placeholder="￥">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">产品实价</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="product_real_price" value="<?php echo htmlentities($blueprintInfo['product_real_price']); ?>"  placeholder="￥">
                </div>
            </div>
            <?php endswitch; ?>
            <div class="layui-form-item">
                <label class="layui-form-label">创建人</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['create_name']); ?>"  disabled title="不可修改">
                </div>
            </div>
            <input type="hidden" class="layui-input" name="modify_name" value="<?php echo htmlentities(app('session')->get('user.user_name')); ?>" >
            <div class="layui-form-item">
                <label class="layui-form-label">创建时间</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['create_time']); ?>"  disabled title="不可修改">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">修改时间</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['update_time']); ?>"   disabled title="不可修改">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">是否作废</label>
                <div class="layui-input-inline">
                    <input type="checkbox"   <?php if(1==$blueprintInfo['if_discard']): ?>checked=""<?php endif; ?>  name="if_discard" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
                    <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
                </div>
            </div>
            <div >
                <label class="layui-form-label">继承图纸文件</label>
                <div class="layui-input-inline">
                    <input type="checkbox" <?php if(1==$blueprintInfo['files_state']): ?>checked=""<?php endif; ?>  name="files_state" lay-skin="switch" lay-text="是|否"  id="files_state">
                    <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
                </div>
            </div>  <!-- 是否继承外图图纸文件 默认选中为是-->
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">备注</label>
                <div class="layui-input-block">
                    <textarea class="layui-textarea" name="remark" ><?php echo htmlentities($blueprintInfo['remark']); ?></textarea>
                </div>
            </div>

            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                <button class="layui-btn" lay-submit lay-filter="formDemo">确认修改</button>
            </div>
      </form>
    </div>

    <script>
        function showHide($id){
            switch ($id){
                case "1":
                    $(".specialDiv").show();//三个保存
                    $("#thickness_Dia").show();//厚度
                    $("#thickness_Dia > label").text("厚度");
                    $("#length_dim").show();//长度
                    $("#length_dim > label").text("长度");
                    $("#width_dim").show();//宽度
                    $("#width_dim > label").text("宽度");


                    $("#specifications").hide();//规格型号
                    $("#altitudeInput").hide();//高度
                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    break;
                case "2":
                    $("#length_dim").show();//长度
                    $("#length_dim > label").text("长度");
                    $("#width_dim").show();//宽度
                    $("#width_dim > label").text("直径");

                    $(".specialDiv").hide();//三个保存
                    $("#thickness_Dia").hide();//厚度
                    $("#specifications").hide();//规格型号
                    $("#altitudeInput").hide();//高度
                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    break;
                case "3":
                    $("#length_dim").show();//长度
                    $("#length_dim > label").text("长度");
                    $("#specifications").show();//规格型号


                    $("#thickness_Dia").hide();//厚度
                    $("#thickness_Dia > label").text("腰厚");
                    $("#width_dim").hide();//宽度
                    $("#width_dim > label").text("腿宽");
                    $("#altitudeInput").hide();//高度
                    $("#altitudeInput > label").text("高度");
                    $(".specialDiv").hide();//三个保存
                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    break;
                case "4":
                    $("#length_dim").show();//长度
                    $("#length_dim > label").text("长度");
                    $("#thickness_Dia").show();//厚度
                    $("#thickness_Dia > label").text("管厚");
                    $("#width_dim").show();//宽度
                    $("#width_dim > label").text("大径");

                    $("#altitudeInput").hide();//高度
                    $("#specifications").hide();//规格型号
                    $(".specialDiv").hide();//三个保存
                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    break;
                case "5":
                    $("#length_dim").show();//长度
                    $("#length_dim > label").text("长度");
                    $("#specifications").show();//规格型号


                    $("#thickness_Dia").hide();//厚度
                    $("#thickness_Dia > label").text("单位重量");
                    $("#width_dim").hide();//宽度
                    $("#altitudeInput").hide();//高度
                    $(".specialDiv").hide();//三个保存
                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    break;
                case "6":
                    $("#length_dim").show();//长度
                    $("#length_dim > label").text("长度");
                    $("#specifications").show();//规格型号

                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    $("#thickness_Dia").hide();//厚度
                    $("#width_dim").hide();//宽度
                    $("#altitudeInput").hide();//高度
                    $(".specialDiv").hide();//三个保存
                    break;
                case "7":
                    $("#length_dim").show();//长度
                    $("#length_dim > label").text("长度");
                    $("#specifications").show();//规格型号

                    $("#thickness_Dia").hide();//厚度
                    $("#thickness_Dia > label").text("厚度");
                    $("#sideLength1").hide();//边长1
                    $("#sideLength2").hide();//边长2
                    $("#thickness_Dia").hide();//厚度
                    $("#width_dim").hide();//宽度
                    $("#altitudeInput").hide();//高度
                    $(".specialDiv").hide();//三个保存
                    break;
            }
        }

        $(function () {
            var valuses = $("#material_type").val();
            showHide(valuses)
        })

         layui.use('form', function(){
             $ = layui.jquery;
             var form = layui.form
                 ,layer = layui.layer;

                //监听事件
                 form.on('select(material_type)', function(data){
                     $("#specia").val("");
                     //console.log(data.value); //得到被选中的值
                     var values = data.value;
                    showHide(values)
                 });

             form.on('select(channel_select)', function (data) {
                 var dataJson = $("#channel_select").val();
                 dataJson = dataJson.replace(/'/g,'"');
                 var dataArray = JSON.parse(dataJson);
                 console.log(dataArray)

                 $("#weightInput").val(dataArray['weight']);//给重量编辑框
                 $("#specInput").val(dataArray['spec']);//给规格编辑框
             });


                 //监听提交
                 form.on('submit(formDemo)', function(data){
                     console.log(data)
                     $.post("<?php echo url('index/Blueprint/blueprintinfos'); ?>",data.field,function(res){
                         if(res == 1){
                             layer.alert("修改成功", {icon: 6},function () {
                                 window.parent.location.reload();  //刷新父级页面
                                 // 获得frame索引
                                 var index = parent.layer.getFrameIndex(window.name);
                                 //关闭当前弹出层
                                 parent.layer.close(index);
                             });
                         }else {
                             layer.alert("修改失败", {icon: 5});
                         }
                         },'json');
                     return false;
                 });

         });
    </script>
  </body>

</html>