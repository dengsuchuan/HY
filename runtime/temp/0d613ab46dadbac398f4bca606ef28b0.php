<?php /*a:2:{s:56:"D:\code\Hy\application\index\view\blueprint\process.html";i:1531494195;s:52:"D:\code\Hy\application\index\view\public\header.html";i:1529297217;}*/ ?>
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
  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 5px;">
    <legend>工艺信息</legend>
  </fieldset>
  <xblock>
    <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
    <button class="layui-btn" onclick="x_admin_show('工序信息','<?php echo url('index/blueprint/addProcess',['id'=>$drawing_detail_id]); ?>',500,500)"><i class="layui-icon"></i>添加</button>
    <span class="x-right" style="line-height:40px">共有数据：<?php echo htmlentities($count); ?> 条</span>
  </xblock>
  <div class="layui-row">
    <div class="container-wrap">
      <div class="box-1">
        <table class="layui-table">
          <thead>
            <tr>
              <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
              </th>
              <th>工艺编号</th>
              <th>工艺类型</th>
              <th>工艺说明</th>
              <th>工序定额</th>
              <th>是否检验</th>
              <th>工序报价</th>
              <th>定额报价</th>
              <th>外协实际价格</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          <?php if(is_array($processInfo) || $processInfo instanceof \think\Collection || $processInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $processInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$processInfoList): $mod = ($i % 2 );++$i;?>
            <tr>
              <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id=''><i class="layui-icon">&#xe605;</i></div>
              </td>
              <td><?php echo htmlentities($processInfoList['process_id']); ?></td>
              <td><?php echo htmlentities($processInfoList['process_type']); ?></td>
              <td><?php echo htmlentities($processInfoList['process_content']); ?></td>
              <td><?php echo htmlentities($processInfoList['process_quota']); ?></td>
              <td>
                <?php if($processInfoList['if_check'] == 1): ?>
                <span class="layui-badge layui-bg-blue">是</span>
                <?php else: ?>
                <span class="layui-badge layui-bg-gray">否</span>
                <?php endif; ?>
              </td>
              <td><?php echo htmlentities($processInfoList['process_quoted_price']); ?></td>
              <td><?php echo htmlentities($processInfoList['quota_quotation']); ?></td>
              <td><?php echo htmlentities($processInfoList['process_real_price']); ?></td>
              <td></td>
            </tr>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</body>
</html>