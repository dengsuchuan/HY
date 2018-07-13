<?php /*a:2:{s:87:"D:\Vc_PHP\Apache24\htdocs\2018\Hy\application\index\view\blueprint\blueprint-infos.html";i:1531222015;s:75:"D:\Vc_PHP\Apache24\htdocs\2018\Hy\application\index\view\public\header.html";i:1531208093;}*/ ?>
﻿<!doctype html>
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
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="drawing_detail_id" title="无法编辑" value="<?php echo htmlentities($blueprintInfo['drawing_detail_id']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">公司编号</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="drawing_internal_id" title="无法编辑" value="<?php echo htmlentities($blueprintInfo['drawing_internal_id']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">外图编号</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="drawing_externa_id" value="<?php echo htmlentities($blueprintInfo['drawing_externa_id']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">图纸名称</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="drawing_name" value="<?php echo htmlentities($blueprintInfo['drawing_name']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">材料类型</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="material" value="<?php echo htmlentities($blueprintInfo['material']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">热处理类型</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="heat_treatment" value="<?php echo htmlentities($blueprintInfo['heat_treatment']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">图纸类型</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input"  name="drawing_type" value="<?php echo htmlentities($blueprintInfo['drawing_type']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">客户类型</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input"  name="client_id" value="<?php echo htmlentities($blueprintInfo['client_id']); ?>"  >
                </div>
            </div>



            <div class="layui-form-item">
                <label class="layui-form-label">是否批量</label>
                <div class="layui-input-block">
                    <input type="checkbox"   <?php if(1==$blueprintInfo['if_batch']): ?>checked=""<?php endif; ?>  name="if_batch" lay-skin="switch" lay-filter="switchTest" lay-text="是|否">
                    <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">材料形状</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input"  name="material_type" value="<?php echo htmlentities($blueprintInfo['material_type']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">厚度</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="thickness_Dia" value="<?php echo htmlentities($blueprintInfo['thickness_Dia']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">长度尺寸</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="length_dim" value="<?php echo htmlentities($blueprintInfo['length_dim']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">宽度尺寸</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="width_dim" value="<?php echo htmlentities($blueprintInfo['width_dim']); ?>"  >
                </div>
            </div>
            <!--<div class="layui-form-item">-->
                <!--<label class="layui-form-label">保证厚度</label>-->
                <!--<div class="layui-input-block">-->
                    <!--<input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['if_thickness']); ?>"  >-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
                <!--<label class="layui-form-label">保证长度</label>-->
                <!--<div class="layui-input-block">-->
                    <!--<input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['if_length']); ?>"  >-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
                <!--<label class="layui-form-label">保证宽度</label>-->
                <!--<div class="layui-input-block">-->
                    <!--<input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['if_width']); ?>"  >-->
                <!--</div>-->
            <!--</div>-->

            <div class="layui-form-item">
                <label class="layui-form-label">保证厚度</label>
                <div class="layui-input-block">
                    <input type="checkbox"   <?php if(1==$blueprintInfo['if_thickness']): ?>checked=""<?php endif; ?>  name="if_thickness" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
                    <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">保证长度</label>
                <div class="layui-input-block">
                    <input type="checkbox"   <?php if(1==$blueprintInfo['if_length']): ?>checked=""<?php endif; ?>  name="if_length" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
                    <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">保证宽度</label>
                <div class="layui-input-block">
                    <input type="checkbox"   <?php if(1==$blueprintInfo['if_width']): ?>checked=""<?php endif; ?>  name="if_width" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
                    <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">排料数量</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="layout_qty" value="<?php echo htmlentities($blueprintInfo['layout_qty']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">材料要求</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="material_requirements" value="<?php echo htmlentities($blueprintInfo['material_requirements']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">产品加工费</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="product_mfg_cost" value="<?php echo htmlentities($blueprintInfo['product_mfg_cost']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">产品报价</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="product_quotation" value="<?php echo htmlentities($blueprintInfo['product_quotation']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">产品实价</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="product_real_price" value="<?php echo htmlentities($blueprintInfo['product_real_price']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">创建人</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="create_name" value="<?php echo htmlentities($blueprintInfo['create_name']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">最后修改人</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="modify_name" value="<?php echo htmlentities($blueprintInfo['modify_name']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">创建时间</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['create_time']); ?>"  >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">修改时间</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['update_time']); ?>"  >
                </div>
            </div>
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
         layui.use('form', function(){
             $ = layui.jquery;
             var form = layui.form
                 ,layer = layui.layer;
                 //监听提交
                 form.on('submit(formDemo)', function(data){
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