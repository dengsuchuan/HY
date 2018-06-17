<?php /*a:5:{s:77:"D:\WebServer\www\project\Enterprise\application\index\view\product\index.html";i:1527765098;s:70:"D:\WebServer\www\project\Enterprise\application\index\view\layout.html";i:1527764072;s:77:"D:\WebServer\www\project\Enterprise\application\index\view\public\header.html";i:1527771319;s:76:"D:\WebServer\www\project\Enterprise\application\index\view\public\slide.html";i:1528077890;s:77:"D:\WebServer\www\project\Enterprise\application\index\view\public\footer.html";i:1527779201;}*/ ?>
<!DOCTYPE html>
<html xmlns:wb="http://open.weibo.com/wb" lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="Cache-Control" content="no-transform"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta http-equiv="Content-Language" content="zh-CN" />
    <meta name="keywords" content="<?php echo htmlentities((isset($webInfo['keywords']) && ($webInfo['keywords'] !== '')?$webInfo['keywords']:'默认关键字')); ?>" />
    <meta name="description" content="<?php echo htmlentities((isset($webInfo['description']) && ($webInfo['description'] !== '')?$webInfo['description']:'默认描述')); ?>" />
    <link rel="shortcut icon" type="image/x-icon" href="/static/index/skin/ecms079/images/favicon.ico" />
    <title><?php echo htmlentities((isset($webInfo['title']) && ($webInfo['title'] !== '')?$webInfo['title']:'默认主题')); ?></title>
    <link rel="stylesheet" type="text/css" href="/static/index/skin/ecms079/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/static/index/skin/ecms079/css/font-awesome.min.css" />
    <script src="/static/index/skin/ecms079/js/common.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/static/index/skin/ecms079/js/respond.min.js" ></script>
    <![endif]-->
    <!--[if IE 7]>
    <link rel="stylesheet" href="/static/index/skin/ecms079/css/font-awesome-ie7.min.css" >
    <![endif]-->
    <script src="https://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div id="header">
    <div class="header">
        <div class="logo"> <a href="index.htm" title="<?php echo htmlentities((isset($webInfo['title']) && ($webInfo['title'] !== '')?$webInfo['title']:'默认主题')); ?>"><img src="/static/index/skin/ecms079/images/logo.png" alt="<?php echo htmlentities((isset($webInfo['title']) && ($webInfo['title'] !== '')?$webInfo['title']:'默认主题')); ?>"/></a> </div>
        <div class="searchBtn"><a name="search"></a></div>
        <div class="language"> <span class="on">简</span> <span><a href="" id="StranLink">繁</a></span> </div>
        <div class="menu" id="menu">
            <ul>
                <li><a href="<?php echo url('index/Index/index'); ?>" class="">首页</a></li>
                <li>
                    <a href="<?php echo url('index/product/index'); ?>"  class="">产品中心</a>
                    <ul class="sub-menu">
                        <?php if(is_array($GoodsClassLists) || $GoodsClassLists instanceof \think\Collection || $GoodsClassLists instanceof \think\Paginator): $i = 0; $__LIST__ = $GoodsClassLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$GoodsClassList): $mod = ($i % 2 );++$i;?>
                        <li class="menu-item"><a href="?GoodsClassId=<?php echo htmlentities($GoodsClassList['GoodsClassId']); ?>"><?php echo htmlentities($GoodsClassList['ClassName']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo url('index/News/index'); ?>" class="">新闻动态</a>
                    <ul class="sub-menu">
                        <?php if(is_array($NewsClassLists) || $NewsClassLists instanceof \think\Collection || $NewsClassLists instanceof \think\Paginator): $i = 0; $__LIST__ = $NewsClassLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$NewsClassList): $mod = ($i % 2 );++$i;?>
                        <li class="menu-item"><a href="?NewsClassId=<?php echo htmlentities($NewsClassList['NewsClassId']); ?>"><?php echo htmlentities($NewsClassList['ClassName']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo url('index/Cases/index'); ?>" class="">案例展示</a>
                    <ul class="sub-menu">
                        <?php if(is_array($CasesClassLists) || $CasesClassLists instanceof \think\Collection || $CasesClassLists instanceof \think\Paginator): $i = 0; $__LIST__ = $CasesClassLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$CasesClassList): $mod = ($i % 2 );++$i;?>
                        <li class="menu-item"><a href="?CaseClassId=<?php echo htmlentities($CasesClassList['CaseClassId']); ?>"><?php echo htmlentities($CasesClassList['ClassName']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li>
                <li><a href="<?php echo url('index/Contact/index'); ?>" class="">联系我们</a></li>
                <li><a href="<?php echo url('index/About/index'); ?>" class="">关于我们</a></li>
                <li><a href="<?php echo url('index/Message/index'); ?>" class="">在线留言</a></li>
                <li><a href="<?php echo url('index/Service/index'); ?>" class="">我们的服务</a></li>
            </ul>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="rslides_container">
    <ul class="rslides" id="slider">
        <li><a target="_blank" title="<?php echo htmlentities((isset($webInfo['slide01_title']) && ($webInfo['slide01_title'] !== '')?$webInfo['slide01_title']:'幻灯大图一')); ?>"><img src="/static/index/images/default/<?php echo htmlentities((isset($webInfo['slide01_img']) && ($webInfo['slide01_img'] !== '')?$webInfo['slide01_img']:'1.jpg')); ?>" alt="<?php echo htmlentities((isset($webInfo['slide01_title']) && ($webInfo['slide01_title'] !== '')?$webInfo['slide01_title']:'幻灯大图一')); ?>"/></a></li>
        <li><a target="_blank" title="<?php echo htmlentities((isset($webInfo['slide02_title']) && ($webInfo['slide02_title'] !== '')?$webInfo['slide02_title']:'幻灯大图二')); ?>"><img src="/static/index/images/default/<?php echo htmlentities((isset($webInfo['slide02_img']) && ($webInfo['slide02_img'] !== '')?$webInfo['slide02_img']:'2.jpg')); ?>" alt="<?php echo htmlentities((isset($webInfo['slide02_title']) && ($webInfo['slide02_title'] !== '')?$webInfo['slide02_title']:'幻灯大图二')); ?>"/></a></li>
        <li><a target="_blank" title="<?php echo htmlentities((isset($webInfo['slide03_title']) && ($webInfo['slide03_title'] !== '')?$webInfo['slide03_title']:'幻灯大图三')); ?>"><img src="/static/index/images/default/<?php echo htmlentities((isset($webInfo['slide03_img']) && ($webInfo['slide03_img'] !== '')?$webInfo['slide03_img']:'3.jpg')); ?>" alt="<?php echo htmlentities((isset($webInfo['slide03_title']) && ($webInfo['slide03_title'] !== '')?$webInfo['slide03_title']:'幻灯大图二')); ?>"/></a></li>
    </ul>
</div>
<div id="breadcrumb">
    <div class="breadcrumb">
        <div class="right">
            <h3>关注微博</h3>
            <div class="weibo">
                <wb:follow-button uid="<?php echo htmlentities((isset($contact['weibo']) && ($contact['weibo'] !== '')?$contact['weibo']:'5312068257')); ?>" type="red_1" width="67" height="24" ></wb:follow-button>
            </div>
        </div>
        <div class="left">
            <h3>动态新闻</h3>
            <div class="notice">
                <ul class="newsList">
                    <?php $count = '1'; if(is_array($NewsInfos) || $NewsInfos instanceof \think\Collection || $NewsInfos instanceof \think\Paginator): $i = 0; $__LIST__ = $NewsInfos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$NewsInfoList): $mod = ($i % 2 );++$i;if($count < 7): ?>
                        <li><a href="<?php echo htmlentities($NewsInfoList['newsId']); ?>" title="<?php echo htmlentities($NewsInfoList['newsname']); ?>" target="_blank"><?php echo htmlentities($NewsInfoList['newsname']); ?></a></li>
                        <?php endif; $count = $count+1; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <ul class="swap">
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="container">
  <div class="sidebar">
    <div class="sideMenu">
      <h3><a href="index.htm" tppabs="http://ecms079.99yuanma.net:8889/products/" title="产品中心" target="_blank">产品中心</a></h3>
      <ul>
        <li><a href="phone/index.htm" tppabs="http://ecms079.99yuanma.net:8889/products/phone/" title="智能手机">智能手机</a></li><li><a href="notebook/index.htm" tppabs="http://ecms079.99yuanma.net:8889/products/notebook/" title="笔记本">笔记本</a></li>      </ul>
    </div>
    <div class="widget">
      <h3>联系信息</h3>
      <div class="textwidget">
        <p><img src="/static/index/skin/ecms079/images/online.jpg" tppabs="http://ecms079.99yuanma.net:8889/skin/ecms079/images/online.jpg" alt="联系信息"/></p>
        <p><b>全国服务热线：400-1234-5678</b></p>
        <p><b>移动电话：</b>13888888888</p>
        <p><b>联系Q Q： </b>123456789</p>
        <p><b>电子邮箱： </b>12345678@qq.com</p>
        <p><b>公司地址： </b>山东省济南市高新区英才路2号</p>
      </div>
    </div>
  </div>
  <div class="main">
    <div class="itemList">
      <h3>产品中心</h3>
      <ul>
        <li>
          <div class="thumbnail"> <a href="notebook/2015-12-07/41.html" tppabs="http://ecms079.99yuanma.net:8889/products/notebook/2015-12-07/41.html" title="游戏本 宏碁V-Nitro" target="_blank"> <img alt="游戏本 宏碁V-Nitro" src="/static/index/d/file/products/notebook/2015-12-07/3ddf089e4ad569f2d2c91a9fc5ade680.jpg" tppabs="http://ecms079.99yuanma.net:8889/d/file/products/notebook/2015-12-07/3ddf089e4ad569f2d2c91a9fc5ade680.jpg"/> </a>
            <div class="onBackground"> <a href="notebook/2015-12-07/41.html" tppabs="http://ecms079.99yuanma.net:8889/products/notebook/2015-12-07/41.html" title="游戏本 宏碁V-Nitro" target="_blank"></a> </div>
          </div>
          <h2> <a href="notebook/2015-12-07/41.html" tppabs="http://ecms079.99yuanma.net:8889/products/notebook/2015-12-07/41.html" title="游戏本 宏碁V-Nitro" target="_blank">游戏本 宏碁V-Nitro</a> </h2>
        </li><li>
          <div class="thumbnail"> <a href="phone/2015-12-07/42.html" tppabs="http://ecms079.99yuanma.net:8889/products/phone/2015-12-07/42.html" title="小清新最爱 魅蓝手机" target="_blank"> <img alt="小清新最爱 魅蓝手机" src="/static/index/d/file/products/phone/2015-12-07/4e9d41819cf0194df826281232b377be.jpg" tppabs="http://ecms079.99yuanma.net:8889/d/file/products/phone/2015-12-07/4e9d41819cf0194df826281232b377be.jpg"/> </a>
            <div class="onBackground"> <a href="phone/2015-12-07/42.html" tppabs="http://ecms079.99yuanma.net:8889/products/phone/2015-12-07/42.html" title="小清新最爱 魅蓝手机" target="_blank"></a> </div>
          </div>
          <h2> <a href="phone/2015-12-07/42.html" tppabs="http://ecms079.99yuanma.net:8889/products/phone/2015-12-07/42.html" title="小清新最爱 魅蓝手机" target="_blank">小清新最爱 魅蓝手机</a> </h2>
        </li><li>
          <div class="thumbnail"> <a href="phone/2015-12-07/43.html" tppabs="http://ecms079.99yuanma.net:8889/products/phone/2015-12-07/43.html" title="无边框ID的魅力 乐视超级手机" target="_blank"> <img alt="无边框ID的魅力 乐视超级手机" src="/static/index/d/file/products/phone/2015-12-07/1874fd1282dad260898eebdb325be567.jpg" tppabs="http://ecms079.99yuanma.net:8889/d/file/products/phone/2015-12-07/1874fd1282dad260898eebdb325be567.jpg"/> </a>
            <div class="onBackground"> <a href="phone/2015-12-07/43.html" tppabs="http://ecms079.99yuanma.net:8889/products/phone/2015-12-07/43.html" title="无边框ID的魅力 乐视超级手机" target="_blank"></a> </div>
          </div>
          <h2> <a href="phone/2015-12-07/43.html" tppabs="http://ecms079.99yuanma.net:8889/products/phone/2015-12-07/43.html" title="无边框ID的魅力 乐视超级手机" target="_blank">无边框ID的魅力 乐视超级手机</a> </h2>
        </li><li>
          <div class="thumbnail"> <a href="notebook/2015-12-07/37.html" tppabs="http://ecms079.99yuanma.net:8889/products/notebook/2015-12-07/37.html" title="惠普Spectre Pro x360" target="_blank"> <img alt="惠普Spectre Pro x360" src="/static/index/d/file/products/notebook/2015-12-07/bf1348e04201845ef1bc0cb9f5269076.jpg" tppabs="http://ecms079.99yuanma.net:8889/d/file/products/notebook/2015-12-07/bf1348e04201845ef1bc0cb9f5269076.jpg"/> </a>
            <div class="onBackground"> <a href="notebook/2015-12-07/37.html" tppabs="http://ecms079.99yuanma.net:8889/products/notebook/2015-12-07/37.html" title="惠普Spectre Pro x360" target="_blank"></a> </div>
          </div>
          <h2> <a href="notebook/2015-12-07/37.html" tppabs="http://ecms079.99yuanma.net:8889/products/notebook/2015-12-07/37.html" title="惠普Spectre Pro x360" target="_blank">惠普Spectre Pro x360</a> </h2>
        </li><li>
          <div class="thumbnail"> <a href="notebook/2015-12-07/38.html" tppabs="http://ecms079.99yuanma.net:8889/products/notebook/2015-12-07/38.html" title="联想超极本 YOGA 3 11" target="_blank"> <img alt="联想超极本 YOGA 3 11" src="/static/index/d/file/products/notebook/2015-12-07/78d43c5336abddcc247bc9d1befe4595.jpg" tppabs="http://ecms079.99yuanma.net:8889/d/file/products/notebook/2015-12-07/78d43c5336abddcc247bc9d1befe4595.jpg"/> </a>
            <div class="onBackground"> <a href="notebook/2015-12-07/38.html" tppabs="http://ecms079.99yuanma.net:8889/products/notebook/2015-12-07/38.html" title="联想超极本 YOGA 3 11" target="_blank"></a> </div>
          </div>
          <h2> <a href="notebook/2015-12-07/38.html" tppabs="http://ecms079.99yuanma.net:8889/products/notebook/2015-12-07/38.html" title="联想超极本 YOGA 3 11" target="_blank">联想超极本 YOGA 3 11</a> </h2>
        </li><li>
          <div class="thumbnail"> <a href="phone/2015-12-07/33.html" tppabs="http://ecms079.99yuanma.net:8889/products/phone/2015-12-07/33.html" title="拍照手机中的战斗机 nubia Z9 Max" target="_blank"> <img alt="拍照手机中的战斗机 nubia Z9 Max" src="/static/index/d/file/products/phone/2015-12-07/e9ae42c6ace01a5113ecc54e684c816d.jpg" tppabs="http://ecms079.99yuanma.net:8889/d/file/products/phone/2015-12-07/e9ae42c6ace01a5113ecc54e684c816d.jpg"/> </a>
            <div class="onBackground"> <a href="phone/2015-12-07/33.html" tppabs="http://ecms079.99yuanma.net:8889/products/phone/2015-12-07/33.html" title="拍照手机中的战斗机 nubia Z9 Max" target="_blank"></a> </div>
          </div>
          <h2> <a href="phone/2015-12-07/33.html" tppabs="http://ecms079.99yuanma.net:8889/products/phone/2015-12-07/33.html" title="拍照手机中的战斗机 nubia Z9 Max" target="_blank">拍照手机中的战斗机 nubia Z9 Max</a> </h2>
        </li>
      </ul>
      <div class="pagenavi"> &nbsp;<span class='page now-page'>1</span>&nbsp;<a href="index_2.html" tppabs="http://ecms079.99yuanma.net:8889/products/index_2.html">2</a><a href="index_2.html" tppabs="http://ecms079.99yuanma.net:8889/products/index_2.html"><span class="page">››</span></a> </div>
    </div>
  </div>
</div>
<div id="footer">
    <div class="footLine"></div>
    <div class="footer">
        <div class="footLeft">
            <div class="pageslist">
                <ul>
                    <li><a href="<?php echo url('index/Message/index'); ?>" title="在线留言" target="_blank">在线留言</a></li>
                    <li><a href="<?php echo url('index/Contact/index'); ?>" title="联系我们" target="_blank">联系我们</a></li>
                    <li><a href="<?php echo url('index/About/index'); ?>" title="关于我们" target="_blank">关于我们</a></li>
                    <li><a href="<?php echo url('index/Service/index'); ?>" title="我们的服务" target="_blank">我们的服务</a></li>
                </ul>
            </div>
            <div class="socialSns">
                <a class="weibo" rel="nofollow" target="_blank">新浪微博</a>
                <a class="tencent" rel="nofollow" target="_blank">腾讯微博</a>
                <a class="qzone" rel="nofollow" target="_blank">QQ空间</a>
            </div>
            <div class="friendlinks">
                <ul>
                    <li><strong>友情链接：</strong></li>
                    <?php if(is_array($link) || $link instanceof \think\Collection || $link instanceof \think\Paginator): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo htmlentities($list['realm']); ?>" target="_blank"><?php echo htmlentities($list['title']); ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="footRight">
            <div class="phone"> <i class="icon-phone"></i> <a href="tel:<?php echo htmlentities((isset($contact['telephone']) && ($contact['telephone'] !== '')?$contact['telephone']:'400-1234-5678')); ?>" rel="nofollow"><?php echo htmlentities((isset($contact['telephone']) && ($contact['telephone'] !== '')?$contact['telephone']:'400-1234-5678')); ?></a> </div>
            <div class="copyright">
                <p>Copyright <a href="<?php echo htmlentities((isset($webInfo['realm']) && ($webInfo['realm'] !== '')?$webInfo['realm']:'https://www.geekln.cn/')); ?>" target="_blank"><?php echo htmlentities((isset($webInfo['title']) && ($webInfo['title'] !== '')?$webInfo['title']:'默认标题')); ?></a> Rights Reserved. <?php echo htmlentities((isset($webInfo['record']) && ($webInfo['record'] !== '')?$webInfo['record']:'川ICP备1234567-9号')); ?> . 统计代码</p>
                <p> 企业站点系统 @ <a href="https://www.geekln.cn/" title="静影探风" target="_blank">静影探风</a>. </p>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div id="backTop"> <a href="#header" title="返回顶部"><i class="icon-arrow-up"></i></a> </div>
<div id="simplemodal-container"></div>
<div id="searchbar">
    <p>全站搜索</p>
    <form onSubmit="return checkSearchForm()" method="post" name="searchform" action="http://ecms079.99yuanma.net:8889/e/search/index.php" >
        <input type="hidden" value="title" name="show">
        <input type="hidden" value="1" name="tempid">
        <input type="hidden" value="news" name="tbname">
        <input name="mid" value="1" type="hidden">
        <input name="dopost" value="search" type="hidden">
        <input type="text" name="keyboard" id="edtSearch" class="text" value="输入搜索关键词" onblur="if($(this).val() == ''){$(this).val('输入搜索关键词');}" onfocus="if($(this).val() == '输入搜索关键词'){$(this).val('');}" x-webkit-speech=""/>
        <input type="submit" id="btnPost" name="submit" class="submit" value="搜索"/>
    </form>
</div>
<script type="text/javascript" src="/static/index/skin/ecms079/js/responsiveslides-bxslider.min.js"></script>
<script type="text/javascript" src="/static/index/skin/ecms079/js/leonhere.js"></script>
<script type="text/javascript" src="/static/index/skin/ecms079/js/transform.js"></script>
</body>
</html>