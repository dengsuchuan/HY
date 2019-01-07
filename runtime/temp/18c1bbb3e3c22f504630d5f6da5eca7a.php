<?php /*a:2:{s:90:"I:\Project\WebServer\www\project\Hy\application\index\view\blueprint\outdrawing_files.html";i:1541478154;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
 <!doctype html>
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
<head>

    <link rel="stylesheet" href="/static/index/pdf/jquery.touchPDF.css">
    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>

    <!-- popper.min.js 用于弹窗、提示、下拉菜单 -->
    <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>

    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <!-- 预览pdf组件 -->
    <script
            src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>
    <script src="/static/index/pdf/jquery.mousewheel.js"></script>
    <script src="/static/index/pdf/jquery.panzoom.js"></script>
    <script src="/static/index/pdf/jquery.touchPDF.js"></script>
    <script src="/static/index/pdf/jquery.touchSwipe.js"></script>
    <script src="/static/index/pdf/pdf.compatibility.js"></script>
    <script src="/static/index/pdf/pdf.js"></script>
    <script src="/static/index/pdf/pdf.worker.js"></script>
</head>
<body>
<?php if($type=='pdf'): ?>
<div id="myPDF" class="col-12 bg-dark text-dark">

</div>
<?php elseif($type=='jpg'): ?>
<img src="<?php echo htmlentities($url); ?>" class="p-3" style="width: 100%;height:auto;margin:auto">
<?php endif; ?>
<div class="container bg-white">
    <form onsubmit="return false">
        <div class="mt-3">
            <?php if($state==1): ?>
            <button type="button" onclick="DelFiles()" class="btn btn-danger">删除</button>
            <?php endif; ?>
            <a href="<?php echo htmlentities($url); ?>" download="外图<?php echo htmlentities($num); ?>的文件.<?php echo htmlentities($type); ?>"><button type="button"  class="btn btn-success">下载</button></a>
            <?php if($type=='pdf'): ?>
            <button type="button" onclick="window.location.href='<?php echo htmlentities($url); ?>'" class="btn btn-danger">直接打开</button>
            <?php endif; ?>
        </div>
    </form>
</div>
</body>
<script>
    <?php if($type=='pdf'): ?>
    $(function() {
        $("#myPDF").pdf({
            source: "<?php echo htmlentities($url); ?>",
            redrawOnWindowResize:true,
            color:'black',
            quality:1
        });
    });
    <?php endif; ?>
    function DelFiles() {
        $.ajax({
            url:"<?php echo url('index/Blueprint/DelOutDrawingFiles'); ?>",
            type:'post',
            dataType:'json',
            data:{
                id:"<?php echo htmlentities($id); ?>"
            },
            success:function (res) {
                if(res.state==500)
                {
                    layer.msg(res.msg);
                    return;
                }
                if(res.state==200)
                {
                    layer.msg(res.msg, {icon: 1,time: 1000},
                        function () {
                            location.reload();
                        });
                    return;
                }
            }
        })
    }
</script>
</html>