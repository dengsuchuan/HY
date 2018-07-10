<?php /*a:5:{s:73:"D:\Vc_PHP\Apache24\htdocs\2018\Hy\application\index\view\index\index.html";i:1531208093;s:75:"D:\Vc_PHP\Apache24\htdocs\2018\Hy\application\index\view\public\header.html";i:1531208093;s:72:"D:\Vc_PHP\Apache24\htdocs\2018\Hy\application\index\view\public\top.html";i:1531208093;s:73:"D:\Vc_PHP\Apache24\htdocs\2018\Hy\application\index\view\public\left.html";i:1531208093;s:75:"D:\Vc_PHP\Apache24\htdocs\2018\Hy\application\index\view\public\footer.html";i:1531208093;}*/ ?>
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
<!-- 顶部开始 -->
<div class="container">
    <div class="logo"><a href="./index.html">恒易管理 v2.0</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="iconfont">&#xe699;</i>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">admin</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <dd><a onclick="x_admin_show('个人信息','http://www.baidu.com')">个人信息</a></dd>
                <dd><a onclick="x_admin_show('切换帐号','http://www.baidu.com')">切换帐号</a></dd>
                <dd><a href="./login.html">退出</a></dd>
            </dl>
        </li>
    </ul>
</div>
<!-- 顶部结束 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe726;</i>
                    <cite>人力资源</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('index/personnel/adminList'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>管理员列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/personnel/workerList'); ?>">
                        <i class="iconfont">&#xe6a7;</i>
                            <cite>员工列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/personnel/clientList'); ?>">
                        <i class="iconfont">&#xe6a7;</i>
                            <cite>客户列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/personnel/authorityClass'); ?>">
                        <i class="iconfont">&#xe6a7;</i>
                            <cite>权限分类</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6e5;</i>
                    <cite>流水账单</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('index/bill/customerBill'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>客户账单</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/bill/readyMoneyBill'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>现金账单</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/bill/companyBill'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>公司账户</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6f6;</i>
                    <cite>库房管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('index/storehouse/delivery'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>发货出库</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/storehouse/purchase'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>外购产品</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>图纸管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('index/blueprint/blueprintInfo'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>图纸明细</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/blueprint/blueprintInterior'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>内部图纸</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/blueprint/blueprintOutside'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>外部图纸</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b5;</i>
                    <cite>任务管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('index/task/inTask'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>在制任务</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/task/alreadyTask'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>已制任务</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/task/classes'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>轮班安排</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/task/evidence'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>发货单据</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/task/sendGoodsInquiry'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>发货查询</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/task/sendGoodsGather'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>发货汇总</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a _href="<?php echo url('index/mould/mould'); ?>">
                    <i class="icon iconfont">&#xe6ae;</i>
                    <cite>模具管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
            </li>
            <li>
                <a _href="datum.html">
                    <i class="icon iconfont">&#xe705;</i>
                    <cite>设备管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
            </li>
            <li>
                <a _href="<?php echo url('index/material/material'); ?>">
                    <i class="icon iconfont">&#xe698;</i>
                    <cite>材料管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
            </li>
            <li>
                <a _href="<?php echo url('index/order/order'); ?>">
                    <i class="icon iconfont">&#xe702;</i>
                    <cite>订单管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
            </li>
            <li>
                <a _href="<?php echo url('index/agreement/agreement'); ?>">
                    <i class="icon iconfont">&#xe740;</i>
                    <cite>技术资料</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
            </li>
            <li>
                <a _href="datum.html">
                    <i class="icon iconfont">&#xe705;</i>
                    <cite>规章制度</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
            </li>
            <li>
                <a _href="message.html">
                    <i class="icon iconfont">&#xe74e;</i>
                    <cite>留言建议</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
          <ul class="layui-tab-title">
            <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>
          </ul>
          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src="<?php echo url('index/index/welcome'); ?>" frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
<!-- 底部开始 -->
<div class="footer">
    <div class="copyright">Copyright ©2018 恒易管理 v2.0</div>
</div>
<!-- 底部结束 -->
</body>
</html>
