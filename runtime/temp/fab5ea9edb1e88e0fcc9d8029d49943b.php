<?php /*a:5:{s:77:"D:\WebServer\www\project\Enterprise\application\index\view\service\index.html";i:1527770847;s:70:"D:\WebServer\www\project\Enterprise\application\index\view\layout.html";i:1527764072;s:77:"D:\WebServer\www\project\Enterprise\application\index\view\public\header.html";i:1527771319;s:76:"D:\WebServer\www\project\Enterprise\application\index\view\public\slide.html";i:1528077890;s:77:"D:\WebServer\www\project\Enterprise\application\index\view\public\footer.html";i:1527779201;}*/ ?>
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
      <h3><a href="../index.htm" tppabs="http://ecms079.99yuanma.net:8889/" title="返回首页" target="_blank">返回首页</a></h3>
      <ul>
        <li><a href="../products/index.htm" tppabs="http://ecms079.99yuanma.net:8889/products/" title="产品中心">产品中心</a></li><li><a href="../news/index.htm" tppabs="http://ecms079.99yuanma.net:8889/news/" title="新闻动态">新闻动态</a></li><li><a href="../shocases/index.htm" tppabs="http://ecms079.99yuanma.net:8889/shocases/" title="案例展示">案例展示</a></li><li><a href="../contact/index.htm" tppabs="http://ecms079.99yuanma.net:8889/contact/" title="联系我们">联系我们</a></li><li><a href="../about/index.htm" tppabs="http://ecms079.99yuanma.net:8889/about/" title="关于我们">关于我们</a></li><li><a href="../guestbook/index.htm" tppabs="http://ecms079.99yuanma.net:8889/guestbook/" title="在线留言">在线留言</a></li><li><a href="index.htm" tppabs="http://ecms079.99yuanma.net:8889/service/" title="我们的服务">我们的服务</a></li>      </ul>
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
    <div class="post lightbox">
      <h2>我们的服务</h2>
      <div class="entry">
        <p>修改此处：后台--栏目--栏目管理--（我们的服务）--修改--单页内容（支持HTML代码，可以在DW等HTML编辑器里编辑好样式再黏贴到这里）</p>

<p style="text-align: center;"><span style="font-size: 20px;"><strong>以营销的理念做设计!</strong></span></p>

<p>品牌CISMI&nbsp; 即品牌理念识别，是品牌经营的核心观念，是指导CI方向的依托，所以在塑造品牌形象之前，可能会花一定的时间去思考并明确品牌的核心理念与诉求，提升 其品牌的附加值，所以不要认为MI没意义、没价值，而急于去追求视觉的呈现，因为没有理念识别的品牌就只是一具行尸走肉。</p>

<p><strong>VI&nbsp; </strong></p>

<p>即品牌视觉识别，以营销的思路做设计，首先会分析行业现状，主要通过寻找并研究品牌的竞争对手和要跟随的对象，竞争对手告诉我们需要打倒谁，并与他们 作出区隔，行业领先者告诉我们需要去向何方。然后再通过消费人群分析，最后找准自己的品牌核心定位，为客户、为市场传达出准确而独特的形象与内涵。因此， 判断一个品牌VI是否优秀，不能只追求漂亮或者个人审美，而更应站在品牌发展的角度，思考它是否深刻而鲜明地传达出品牌的核心理念与价值，并形成差异化的 品牌形象传播。</p>

<p><strong>SI&nbsp; </strong></p>

<p>终端形象店作为消费者直接体验的空间，更能精确传达品牌形象。因此，在设计时，会根据品牌的定位、个性、文化、核心价值对空间进行构思与创意，突显出 产品的附加值，它不仅是消费者购买商品的场所，更是从视觉、听觉、嗅觉、触觉、味觉等各方面全方位打造的营销空间，满足消费者的情感需求，激发人们的消费 欲望，从而抢占消费者心智，促进终端销售提升。</p>

<p>画册企业形象画册 优秀画册和拙劣画册之间的最大差别，不仅仅在于设计的漂亮与否，更为关键的是策划思维，画册是否具备高品质、有效性，又能吸引客户！以讲故事的形式致力&ldquo;营销型画册&rdquo;，首先，通过分析品牌原型，传承品牌的个性与气质，为每一本画册量身定制一个主题，它就是整本画册的思想、灵魂；然 后以讲故事的方式将整本画册的主线贯穿起来，再通过文案与设计的创意搭配，形成有思想的画面，让画册有血有肉地丰盈起来，而不再是干瘪的资料堆砌。通过画 册受众人群的分析，整体从画册内容、设计、装帧、工艺等多方位吸引客户，达到画册的宣传有效性。</p>

<p><strong>企业招商画册</strong></p>

<p>对于招商画册，如何吸引客户加盟合作才是关键，于是通过客户心理分析，总结出招商画册之道: 首先通过相关市场分析，让客户看到行业的发展空间；然后再展现企业的实力，品牌的差异化诉求，让客户感受到对企业和品牌的信心；再通过产品、渠道、推广、营 销等市场策略，让客户看到品牌营销发展的信心；最后通过加盟支持政策，不仅让客户切实清楚自己的可观收益，而且帮助客户解决加盟的后顾之忧。所以，对市 场、品牌、营销、收益、服务等都有了信心，相信不加盟都难。</p>

<p><strong>网站营销的&ldquo;道&rdquo;</strong></p>

<p>网站营销方面： 与其他公司在于&ldquo;道&rdquo;和&ldquo;术&rdquo;，其他公司在与品牌谈网站营销时经常一上来就说如何做网站，如果做关键词优化，如何选择关键词等等。这些内容对于网站营 销来说只能算得上是&ldquo;术&rdquo;而根本的&ldquo;道&rdquo;完全没有被涉及。品牌的&ldquo;道&rdquo;是品牌的灵魂，是品牌独有的DNA。&ldquo;道&rdquo;为品牌指引方向，而&ldquo;术&rdquo;则是达到这个方 向的方法，两者缺一不可，但只有明确了&ldquo;道&rdquo;才能够选择正确的&ldquo;术&rdquo;。</p>

<p>网站营销之&ldquo;道&rdquo;共四步：找到你、了解你、比较你、选择你。最终切实提升企业网上客户的关注度，真正做到网络开源、网络招商。</p>
      </div>
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