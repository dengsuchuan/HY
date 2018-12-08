<?php /*a:2:{s:83:"I:\Project\WebServer\www\project\Hy\application\index\view\blueprint\not-files.html";i:1541478154;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1541478155;}*/ ?>
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

    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>

    <!-- popper.min.js 用于弹窗、提示、下拉菜单 -->
    <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>

    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="jumbotron bg-light jumbotron-fluid">
    <div class="container bg-light">
        <h1>没有<?php echo htmlentities($key); ?>文件</h1>
        <p>您可以在此界面上传您的<?php echo htmlentities($key); ?>文件</p>
    </div>
</div>
​
<div class="container bg-white">
    <form onsubmit="return false">
        <p>选择<?php echo htmlentities($key); ?>文件:</p>
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="customFile" name="filename">
            <label class="custom-file-label" for="customFile" id="customFile_log">选择文件</label>
        </div>
        <div class="mt-3">
            <button type="button" onclick="UpFiles()" class="btn btn-primary">上传</button>
        </div>
    </form>
</div>
</body>
<script>
    function UpFiles(){
        var files = $("#customFile")[0].files[0];//获取文件
        var formFile = new FormData();//文件对象
        formFile.append('file',files);
        $.ajax({
            url:"<?php echo url('index/Blueprint/FileUpload',['drawing_id'=>$drawing_id,'tip'=>$tip]); ?>",
            data:formFile,
            type: "post",
            dataType: "json",
            processData: false,//用于对data参数进行序列化处理 这里必须false
            contentType: false, //必须
            success:function (res) {
                if(res.state==500)
                {
                    layer.msg(res.msg);
                    return;
                }
                if(res.state==200)
                {
                    layer.msg(res.msg+',请稍后', {icon: 16,time: 2000},
                    function () {
                        window.parent.location.reload();  //刷新父级页面
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前弹出层
                        parent.layer.close(index);
                    });
                    return;
                }
            }
        })
    }
    $("#customFile").change(function () {
        $("#customFile_log").html($("#customFile")[0].files[0].name);
        if(!/^[\S]+.(pdf|jpg)$/.test($("#customFile")[0].files[0].name))
        {
            layer.msg('请选择有效的图纸文件', {icon: 0,time: 2000},
                function () {
                    location.reload();
                });
            return;
        }
    });
</script>
</html>