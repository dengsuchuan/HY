<?php /*a:5:{s:75:"I:\Project\WebServer\www\project\Hy\application\index\view\index\index.html";i:1541478155;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;s:74:"I:\Project\WebServer\www\project\Hy\application\index\view\public\top.html";i:1541478155;s:75:"I:\Project\WebServer\www\project\Hy\application\index\view\public\left.html";i:1544283005;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\footer.html";i:1541478155;}*/ ?>
﻿ <!doctype html>
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
<!-- 顶部开始 -->
<div class="container">
    <div class="logo"><a href="./index.html">恒易管理 v2.0</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="iconfont">&#xe699;</i>
    </div>
    <ul class="layui-nav right" lay-filter="">

        <?php if(app('session')->get('user.user_id')): ?>
        <li class="layui-nav-item">
            <a href="javascript:;"><?php echo htmlentities(app('session')->get('user.user_name')); ?></a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <dd><a onclick="x_admin_show('个人信息','http://www.baidu.com')">个人信息</a></dd>
                <?php if(app('session')->get('user.admin') === 'admin'): ?>
                <dd><a href="<?php echo url('index/login/switchLogin'); ?>">切换帐号</a></dd>
                <?php else: ?>
                <dd><a href="<?php echo url('index/login/switchLoginU'); ?>">切换帐号</a></dd>
                <?php endif; ?>
                <dd><a href="<?php echo url('index/login/outLogin'); ?>">退出</a></dd>
            </dl>
        </li>
        <?php else: ?>
        <li class="layui-nav-item">
            <a href="javascript:;">当前身份:游客</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <dd><a href="<?php echo url('index/Login/login'); ?>">登陆</a></dd>
            </dl>
        </li>
        <?php endif; ?>

    </ul>
</div>
<!-- 顶部结束 -->
 <div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <!--//超级管理权限-->
            <?php if(app('session')->get('user.user_id')): ?>
            <!--//管理员权限-->
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe726;</i>
                    <cite>人力资源</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <?php if(app('session')->get('user.admin') === 'admin'): ?>
                    <li>
                        <a _href="<?php echo url('index/Administrators/adminInfo'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>超级管理员列表</cite>
                        </a>
                    </li >
                    <?php endif; if(app('session')->get('user.employee_lv') == 1): ?>
                    <li>
                        <a _href="<?php echo url('index/Employee/employeeInfo'); ?>" >
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>员工列表</cite>
                        </a>
                    </li >
                    <?php endif; ?>

                    <li>
                        <a _href="<?php echo url('index/Client/clientInfo'); ?>">
                        <i class="iconfont">&#xe6a7;</i>
                            <cite>客户列表</cite>
                        </a>
                    </li >
                    <!--<li>-->
                        <!--<a _href="<?php echo url('index/personnel/authorityClass'); ?>">-->
                            <!--<i class="iconfont">&#xe6a7;</i>-->
                            <!--<cite>角色管理</cite>-->
                        <!--</a>-->
                    <!--</li >-->
                    <!--<li>-->
                        <!--<a _href="<?php echo url('index/personnel/authorityClass'); ?>">-->
                        <!--<i class="iconfont">&#xe6a7;</i>-->
                            <!--<cite>权限分类</cite>-->
                        <!--</a>-->
                    <!--</li >-->
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
                    <i class="iconfont">&#xe6f6;</i>
                    <cite>基础信息</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('index/ProcessType/index'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>工艺类型</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/LoolingType/loolingInfo'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>工装类型</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/material/material'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>材料管理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/Section/section'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>材料截面</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/Department/departmentInfo'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>部门名称</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/Duties/DutiesInfo'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>职务名称</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/Equipment/equipmentType'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>设备类型</cite>
                        </a>
                    </li >
                    <li>
                        <a href="javascript:;">
                            <i class="layui-icon layui-icon-rmb"></i>
                            <cite>财务相关</cite>
                            <i class="iconfont nav_right">&#xe697;</i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a _href="<?php echo url('index/CostType/costInfo'); ?>">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>费用类型</cite>
                                </a>
                            </li >
                            <li>
                                <a _href="<?php echo url('index/IncomeType/Info'); ?>">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>收入类型</cite>
                                </a>
                            </li >
                            <li>
                                <a _href="<?php echo url('index/AccountType/Info'); ?>">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>账户类型</cite>
                                </a>
                            </li >
                            <li>
                                <a _href="<?php echo url('index/StoreroomType/Info'); ?>">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>库房类型</cite>
                                </a>
                            </li >
                        </ul>
                    </li>
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
                        <a _href="<?php echo url('index/blueprint/blueprintOutside'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>外部图纸</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/Internal/internalInfo'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>内部图纸</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/Assembly/assemblyInfo'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>组件图纸</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/blueprint/blueprintInfo'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>图纸明细</cite>
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
                        <a _href="<?php echo url('index/CurrentTask/inTask',['id'=>0]); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>在制和已制</cite>
                        </a>
                    </li >
                    <!--<li>-->
                        <!--<a _href="<?php echo url('index/task/alreadyTask'); ?>">-->
                            <!--<i class="iconfont">&#xe6a7;</i>-->
                            <!--<cite>已制任务</cite>-->
                        <!--</a>-->
                    <!--</li >-->
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
                <a href="javascript:;">
                    <i class="icon iconfont">&#xe705;</i>
                    <cite>设备和量具</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('index/Equipment/equipmentInfo'); ?>" >
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>设备管理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/Measuring/measuringInfo'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>量具管理</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a  href="javascript:;">
                    <i class="icon iconfont">&#xe702;</i>
                    <cite>订单管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('index/order/order'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>订单列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/Delivery/viewShow'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>送货单</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/BaoJia/viewShow',['action'=>0]); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>报价单据</cite>
                        </a>
                    </li >
                    <!--<li>-->
                        <!--<a _href="<?php echo url('index/Quote/viewShow',['action'=>0]); ?>">-->
                            <!--<i class="iconfont">&#xe6a7;</i>-->
                            <!--<cite>报价单据</cite>-->
                        <!--</a>-->
                    <!--</li >-->
                </ul>
            </li>
            <?php endif; ?>
            <li>
                <a _href="">
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
                <iframe src="<?php echo url('/index/index/welcome'); ?>" frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
 <!-- 底部开始 -->
<div class="footer">
    <div class="copyright">Copyright ©2018 恒易管理 v2.0  &nbsp;
        <?php if(!app('session')->get('user')): ?>
        [<span style="font-size: 12px;color:#fff;"><a style="color: #fff" href="<?php echo url('index/Login/adminLogin'); ?>">管理员登陆入口</a></span>]
        <?php endif; ?>

    </div>
</div>
<!-- 底部结束 -->
</body>
</html>
