<?php /*a:6:{s:67:"D:\WebServer\www\project\Hy\application\index\view\index\index.html";i:1528382475;s:62:"D:\WebServer\www\project\Hy\application\index\view\layout.html";i:1528379754;s:69:"D:\WebServer\www\project\Hy\application\index\view\public\header.html";i:1528379407;s:66:"D:\WebServer\www\project\Hy\application\index\view\public\top.html";i:1528382974;s:67:"D:\WebServer\www\project\Hy\application\index\view\public\left.html";i:1528383912;s:69:"D:\WebServer\www\project\Hy\application\index\view\public\footer.html";i:1528383141;}*/ ?>
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
</head>
<body>
<!-- 顶部开始 -->
<div class="container">
    <div class="logo"><a href="<?php echo url('index/index/index'); ?>">恒易管理 v2.0</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="iconfont">&#xe699;</i>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">admin</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <dd><a onclick="x_admin_show('个人信息','http://www.baidu.com')">个人信息</a></dd>
                <dd><a onclick="x_admin_show('切换帐号','http://www.baidu.com')">切换帐号</a></dd>
                <dd><a href="#">退出</a></dd>
            </dl>
        </li>
    </ul>
</div>
<!-- 顶部结束 -->
<!-- 左侧菜单开始 -->
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
                        <a _href="admin-list.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>管理员列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="admin-list.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>员工列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="client-list.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>客户列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="cate.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限分类</cite>
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
                        <a _href="blueprint-info.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>图纸明细</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="blueprint-interior.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>内部图纸</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="blueprint-outside.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>外部图纸</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a _href="agreement.html">
                    <i class="icon iconfont">&#xe6fb;</i>
                    <cite>合同管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b5;</i>
                    <cite>任务管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="in-task.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>在制任务</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="already-task.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>已制任务</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="classes.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>轮班安排</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="evidence.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>发货单据</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="send-goods-inquiry.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>发货查询</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="send-goods-gather.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>发货汇总</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="stop-record.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>停机记录</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a _href="mould.html">
                    <i class="icon iconfont">&#xe6ae;</i>
                    <cite>模具管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
            </li>
            <li>
                <a _href="material.html">
                    <i class="icon iconfont">&#xe698;</i>
                    <cite>材料管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
            </li>
            <li>
                <a _href="order.html">
                    <i class="icon iconfont">&#xe702;</i>
                    <cite>订单管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
            </li>
            <li>
                <a _href="agreement.html">
                    <i class="icon iconfont">&#xe6cb;</i>
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
                <iframe src="<?php echo url('index/index/welcome'); ?>" frameborder="0" scrolling="yes" class="x-iframe">
                </iframe>
            </div>
        </div>
    </div>
</div>
﻿测试
<div class="page-content-bg"></div>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
<!-- 底部开始 -->
<div class="footer">
    <div class="copyright">Copyright ©2018 恒易管理 v2.0</div>
</div>
<!-- 底部结束 -->
</body>
</html>