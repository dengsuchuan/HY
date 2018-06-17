<?php /*a:5:{s:75:"D:\WebServer\www\project\Enterprise\application\index\view\index\index.html";i:1528088036;s:70:"D:\WebServer\www\project\Enterprise\application\index\view\layout.html";i:1527764072;s:77:"D:\WebServer\www\project\Enterprise\application\index\view\public\header.html";i:1527771319;s:76:"D:\WebServer\www\project\Enterprise\application\index\view\public\slide.html";i:1528077890;s:77:"D:\WebServer\www\project\Enterprise\application\index\view\public\footer.html";i:1527779201;}*/ ?>
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
<div id="service">
    <div class="allTitle"><span>我们的业务范围 »</span></div>
    <?php if(is_array($ScopeLists) || $ScopeLists instanceof \think\Collection || $ScopeLists instanceof \think\Paginator): $i = 0; $__LIST__ = $ScopeLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ScopeList): $mod = ($i % 2 );++$i;?>
    <div class="serviceBox">
        <div class="serviceBoxInfo">
            <h3><i class="<?php echo htmlentities((isset($ScopeList['icon']) && ($ScopeList['icon'] !== '')?$ScopeList['icon']:'icon-align-right')); ?> icon-2x"></i><span><a href="#" target="_blank" title="<?php echo htmlentities((isset($ScopeList['title']) && ($ScopeList['title'] !== '')?$ScopeList['title']:'默认业务选项')); ?>"><?php echo htmlentities((isset($ScopeList['title']) && ($ScopeList['title'] !== '')?$ScopeList['title']:'默认业务选项')); ?></a></span></h3>
            <div class="line"></div>
            <div class="serviceBoxTxt"><?php echo htmlentities((isset($ScopeList['describe']) && ($ScopeList['describe'] !== '')?$ScopeList['describe']:'默认业务描述默认业务描述默认业务描述默认业务描述')); ?></div>
        </div>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <div class="clear"></div>
</div><div id="aboutUs">
    <?php if(is_array($AboutLists) || $AboutLists instanceof \think\Collection || $AboutLists instanceof \think\Paginator): $i = 0; $__LIST__ = $AboutLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$AboutList): $mod = ($i % 2 );++$i;?>
    <div class="aboutUs">
        <div class="allTitle"><span>« 关于我们</span></div>
        <div class="aboutUsThumb"> <a href="#" target="_blank" title="关于我们"> <img alt="关于我们" src="/static/index/skin/ecms079/images/<?php echo htmlentities($AboutList['images']); ?>"/> </a> </div>
        <div class="aboutUsTxt">
            <p><?php echo htmlentities(msubstr($AboutList['describe'])); ?></p>
            <p class="more"><a href="<?php echo url('index/About/index'); ?>" target="_blank" title="关于我们">阅读更多 »</a></p>
        </div>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div><div id="products">
    <div class="productsMenu">
        <ul>
            <?php if(is_array($GoodsClassLists) || $GoodsClassLists instanceof \think\Collection || $GoodsClassLists instanceof \think\Paginator): $i = 0; $__LIST__ = $GoodsClassLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$GoodsClassList): $mod = ($i % 2 );++$i;?>
            <li class="<?php if($GoodsClassList['GoodsClassId'] == '1'): ?>on<?php endif; ?>"><?php echo htmlentities($GoodsClassList['ClassName']); ?></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="productsAll">
        <?php if(is_array($GoodsClassLists) || $GoodsClassLists instanceof \think\Collection || $GoodsClassLists instanceof \think\Paginator): $i = 0; $__LIST__ = $GoodsClassLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$GoodsClassList): $mod = ($i % 2 );++$i;?>
        <div class="productsList <?php if($GoodsClassList['GoodsClassId'] != '1'): ?>hide<?php endif; ?>">
            <ul>
                <?php $count = '1'; if(is_array($GoodsInfoLists) || $GoodsInfoLists instanceof \think\Collection || $GoodsInfoLists instanceof \think\Paginator): $i = 0; $__LIST__ = $GoodsInfoLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$GoodsInfoList): $mod = ($i % 2 );++$i;if($GoodsInfoList['goodsclassid'] == $GoodsClassList['GoodsClassId']): if($count < 5): ?>
                <li>
                    <div class="productsThumb"> <a href="#" target="_blank" title="<?php echo htmlentities($GoodsInfoList['goodsname']); ?>"> <img alt="<?php echo htmlentities($GoodsInfoList['goodsname']); ?>" src="/static/index/images/<?php echo htmlentities($GoodsInfoList['images']); ?>"/> </a>
                        <div class="onBackground"> <a href="#" target="_blank" title="<?php echo htmlentities($GoodsInfoList['goodsname']); ?>"><span>+</span></a> </div>
                    </div>
                    <h2><a href="#" target="_blank" title="<?php echo htmlentities($GoodsInfoList['goodsname']); ?>"><?php echo htmlentities($GoodsInfoList['goodsname']); ?></a></h2>
                </li>
                <?php $count = $count+1; endif; endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<div id="news">
    <div class="newslist">
        <div class="newsMenu">
            <ul>
                <?php if(is_array($NewsClassLists) || $NewsClassLists instanceof \think\Collection || $NewsClassLists instanceof \think\Paginator): $i = 0; $__LIST__ = $NewsClassLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$NewsClassList): $mod = ($i % 2 );++$i;?>
                <li class="<?php if($NewsClassList['NewsClassId'] == '1'): ?>on<?php endif; ?>"><?php echo htmlentities($NewsClassList['ClassName']); ?></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="newsBox">
            <?php if(is_array($NewsClassLists) || $NewsClassLists instanceof \think\Collection || $NewsClassLists instanceof \think\Paginator): $i = 0; $__LIST__ = $NewsClassLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$NewsClassList): $mod = ($i % 2 );++$i;?>
            <div class="<?php if($NewsClassList['NewsClassId'] != '1'): ?>hide<?php endif; ?>">
                <ul>
                <?php $count = '1'; if(is_array($NewsInfos) || $NewsInfos instanceof \think\Collection || $NewsInfos instanceof \think\Paginator): $i = 0; $__LIST__ = $NewsInfos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$NewsInfo): $mod = ($i % 2 );++$i;if($NewsInfo['newsclassid'] == $NewsClassList['NewsClassId']): if($count < 7): ?>
                            <li><span><?php echo htmlentities($NewsInfo['create_time']); ?></span><i>»</i> <a href="#" target="_blank" title="<?php echo htmlentities($NewsInfo['newsname']); ?>"><?php echo htmlentities($NewsInfo['newsname']); ?></a></li>
                        <?php $count = $count+1; endif; endif; endforeach; endif; else: echo "" ;endif; ?>

                </ul>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>

    </div>
    <div class="partner">
        <div class="allTitle"><span>« 合作伙伴</span></div>
        <ul>
            <?php if(is_array($CooperateLists) || $CooperateLists instanceof \think\Collection || $CooperateLists instanceof \think\Paginator): $i = 0; $__LIST__ = $CooperateLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$CooperateList): $mod = ($i % 2 );++$i;?>
            <li><a title="<?php echo htmlentities($CooperateList['CooperateTitle']); ?>" href="<?php echo htmlentities($CooperateList['CooperateUrl']); ?>" rel="nofollow" target="_blank"><img src="/static/index/images/default/<?php echo htmlentities($CooperateList['CooperateImg']); ?>" alt="<?php echo htmlentities($CooperateList['CooperateTitle']); ?>"/></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>
<div id="showcase">
    <div class="showcase">
        <div class="allTitle"><span>案例展示 »</span></div>
        <ul class="bxslider" id="homebx">
            <?php if(is_array($CaseInfoLists) || $CaseInfoLists instanceof \think\Collection || $CaseInfoLists instanceof \think\Paginator): $i = 0; $__LIST__ = $CaseInfoLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$CaseInfoList): $mod = ($i % 2 );++$i;?>
            <li> <a href="#" target="_blank" title="<?php echo htmlentities($CaseInfoList['casename']); ?>"> <img alt="<?php echo htmlentities($CaseInfoList['casename']); ?>" src="/static/index/images/shocases/<?php echo htmlentities($CaseInfoList['images']); ?>"/> </a> </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>
<div id="contactUs">
    <div class="allTitle"><span>« 联系我们 »</span></div>
    <div class="contactInfo">
        <div class="contactTxt contactCon">
            <p>如果您对我们的产品感兴趣，您可以通过下面的<b>联系信息</b>联系我们，或者您可以直接在本站的在线留言页面留下您的称呼、邮箱以及留下您要咨询的内容，我们工作人员会在第一时间和您联系，感谢您对我们公司的支持，祝您生活愉快！！ </p>
        </div>
        <h3>联系信息</h3>
        <div class="contactTxt">
            <ul>
                <li><i class="icon-map-marker icon-large"></i>山东省济南市高新区英才路2号</li>
                <li><i class="icon-phone-sign"></i>400-1234-5678</li>
                <li><i class="icon-envelope"></i><a href="mailto:12345678@qq.com">12345678@qq.com</a></li>
            </ul>
        </div>
    </div>
    <div class="contactForm"> <img src="/static/index/skin/ecms079/images/map.png" tppabs="http://ecms079.99yuanma.net:8889//static/index/skin/ecms079/images/map.png" alt="地图"/> </div>
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