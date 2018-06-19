<?php /*a:2:{s:81:"D:\WebServer\www\project\Hy\application\index\view\blueprint\blueprint-infos.html";i:1529424503;s:69:"D:\WebServer\www\project\Hy\application\index\view\public\header.html";i:1528981768;}*/ ?>
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
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label">明细编号</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" title="无法编辑" value="<?php echo htmlentities($blueprintInfo['drawing_detail_id']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">公司编号</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" title="无法编辑" value="<?php echo htmlentities($blueprintInfo['drawing_internal_id']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">外图编号</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['drawing_externa_id']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">图纸名称</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['drawing_name']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">材料类型</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['material']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">热处理类型</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['heat_treatment']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">图纸类型</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['drawing_type']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">客户类型</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['client_id']); ?>" disabled>
                </div>
            </div>
            <!--<div class="layui-form-item">-->
                <!--<label class="layui-form-label">是否批量</label>-->
                <!--<div class="layui-input-block">-->
                    <!--<input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['if_batch']); ?>" disabled>-->
                <!--</div>-->
            <!--</div>-->
            <div class="layui-form-item">
                <label class="layui-form-label">是否批量</label>
                <div class="layui-input-block">
                    <input type="checkbox" checked="" name="open" lay-skin="switch" lay-filter="switchTest" lay-text="是|否" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">材料形状</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['material_type']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">厚度</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['thickness_Dia']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">长度尺寸</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['length_dim']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">宽度尺寸</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['width_dim']); ?>" disabled>
                </div>
            </div>
            <!--<div class="layui-form-item">-->
                <!--<label class="layui-form-label">保证厚度</label>-->
                <!--<div class="layui-input-block">-->
                    <!--<input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['if_thickness']); ?>" disabled>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
                <!--<label class="layui-form-label">保证长度</label>-->
                <!--<div class="layui-input-block">-->
                    <!--<input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['if_length']); ?>" disabled>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
                <!--<label class="layui-form-label">保证宽度</label>-->
                <!--<div class="layui-input-block">-->
                    <!--<input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['if_width']); ?>" disabled>-->
                <!--</div>-->
            <!--</div>-->
            <div class="layui-form-item">
                <label class="layui-form-label">保证厚度</label>
                <div class="layui-input-block">
                    <input type="checkbox" checked="" name="open" lay-skin="switch" lay-filter="switchTest" lay-text="是|否" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">保证长度</label>
                <div class="layui-input-block">
                    <input type="checkbox" checked="" name="open" lay-skin="switch" lay-filter="switchTest" lay-text="是|否" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">保证宽度</label>
                <div class="layui-input-block">
                    <input type="checkbox" checked="" name="open" lay-skin="switch" lay-filter="switchTest" lay-text="是|否" disabled>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">排料数量</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['layout_qty']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">材料要求</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['material_requirements']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">产品加工费</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['product_mfg_cost']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">产品报价</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['product_quotation']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">产品实价</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['product_real_price']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">创建人</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['create_name']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">最后修改人</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['modify_name']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">创建时间</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['create_time']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">修改时间</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" value="<?php echo htmlentities($blueprintInfo['update_time']); ?>" disabled>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">备注</label>
                <div class="layui-input-block">
                    <textarea class="layui-textarea" disabled> <?php echo htmlentities($blueprintInfo['remark']); ?> </textarea>
                </div>
            </div>


      </form>
    </div>
    <script>
      layui.use(['form','layer'], function(){
          $ = layui.jquery;
        var form = layui.form
        ,layer = layui.layer;
          

        //监听提交
        form.on('submit(add)', function(data){
          console.log(data);
          //发异步，把数据提交给php
          layer.alert("增加成功", {icon: 6},function () {
              // 获得frame索引
              var index = parent.layer.getFrameIndex(window.name);
              //关闭当前frame
              parent.layer.close(index);
          });
          return false;
        });
        
        
      });
  </script>
  </body>

</html>