<?php /*a:6:{s:67:"D:\WebServer\www\project\Hy\application\index\view\hello\index.html";i:1528381003;s:62:"D:\WebServer\www\project\Hy\application\index\view\layout.html";i:1528379754;s:69:"D:\WebServer\www\project\Hy\application\index\view\public\header.html";i:1528379407;s:66:"D:\WebServer\www\project\Hy\application\index\view\public\top.html";i:1528381481;s:67:"D:\WebServer\www\project\Hy\application\index\view\public\left.html";i:1528381712;s:69:"D:\WebServer\www\project\Hy\application\index\view\public\footer.html";i:1528379586;}*/ ?>
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
                <iframe src="<?php echo url('index/hello/index'); ?>" frameborder="0" scrolling="yes" class="x-iframe">
<div class="x-body layui-anim layui-anim-up">
    <blockquote class="layui-elem-quote">欢迎管理员：
        <span class="x-red">Admin</span>！当前时间:2018-04-25 20:50:53</blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据统计</legend>
        <div class="layui-field-box">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body">
                        <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 90px;">
                            <div carousel-item="">
                                <ul class="layui-row layui-col-space10 layui-this">
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>成员总数</h3>
                                            <p><cite>12</cite></p></a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>图纸总数</h3>
                                            <p><cite>66</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>合同总数</h3>
                                            <p><cite>67</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>任务总数</h3>
                                            <p><cite>99</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>订单总数</h3>
                                            <p><cite>67</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>资料总数</h3>
                                            <p><cite>6766</cite></p></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="layui-elem-field">
        <legend>通知</legend>
        <div class="layui-field-box">
            <table class="layui-table" lay-skin="line">
                <tbody>
                <tr>
                    <td >
                        <a class="x-a" href="/" target="_blank">
                            为便于叶片审核数量，请在填写加工数量时按件分开填写。比如大端完整加工为0.6，接上班已填写0.4，本班先填写上班剩余0.2，再填写本班加工的数量。审核时如本班未完整加工，会暂时不审核，留下一班填写时参考。
                        </a>
                    </td>
                </tr>
                <tr>
                    <td >
                        <a class="x-a" href="/" target="_blank">
                            经检查，发现之前填写存在错填、多填、漏填。未避免错误，请加工后及时填写。填写时仔细选择。
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </fieldset>
    <fieldset class="layui-elem-field">
        <legend>系统信息</legend>
        <div class="layui-field-box">
            <table class="layui-table">
                <tbody>
                <tr>
                    <th>xxx版本</th>
                    <td>1.0.180420</td></tr>
                <tr>
                    <th>服务器地址</th>
                    <td>x.xuebingsi.com</td></tr>
                <tr>
                    <th>操作系统</th>
                    <td>WINNT</td></tr>
                <tr>
                    <th>运行环境</th>
                    <td>Apache/2.4.23 (Win32) OpenSSL/1.0.2j mod_fcgid/2.3.9</td></tr>
                <tr>
                    <th>PHP版本</th>
                    <td>5.6.27</td></tr>
                <tr>
                    <th>PHP运行方式</th>
                    <td>cgi-fcgi</td></tr>
                <tr>
                    <th>MYSQL版本</th>
                    <td>5.5.53</td></tr>
                <tr>
                    <th>ThinkPHP</th>
                    <td>5.0.18</td></tr>
                <tr>
                    <th>上传附件限制</th>
                    <td>2M</td></tr>
                <tr>
                    <th>执行时间限制</th>
                    <td>30s</td></tr>
                <tr>
                    <th>剩余空间</th>
                    <td>86015.2M</td></tr>
                </tbody>
            </table>
        </div>
    </fieldset>
    <fieldset class="layui-elem-field">
        <legend>开发团队</legend>
        <div class="layui-field-box">
            <table class="layui-table">
                <tbody>
                <tr>
                    <th>版权所有</th>
                    <td>恒易</td>
                </tr>
                <tr>
                    <th>开发者</th>
                    <td>邓素川、唐玉琳、王恒兵</td></tr>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>
</iframe>
</div>
</div>
</div>
</div>
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