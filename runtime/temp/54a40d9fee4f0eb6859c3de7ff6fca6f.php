<?php /*a:2:{s:82:"I:\Project\WebServer\www\project\Hy\application\index\view\order\upload_views.html";i:1541577171;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1541478155;}*/ ?>
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
<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">订单管理</a>
        <a>
          <cite>合同文件</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <button class="layui-btn layui-btn-sm" onclick="x_admin_show('上传文件(支持多文件)','<?php echo url('index/Order/upOrderFile',['id'=>$id]); ?>')">上传文件</button>
    <button class="layui-btn-sm layui-btn layui-btn-danger"
    onclick="Clear()">清理失效记录</button>
    <div class="layui-row">
        <div class="container-wrap">
            <div class="box-1">
                <table class="layui-table" style="text-align: center">
                    <tbody>
                        <tr style="background-color:lightgray">
                            <td>序号</td>
                            <td>上传时间</td>
                            <td>上传者</td>
                            <td>预览</td>
                            <td>备注</td>
                            <td>操作</td>
                        </tr>
                    <?php if(!$files||count($files)<=0): ?>
                        <tr>
                            <td colspan="6" style="text-align: center">还没有上传合同文件</td>
                        </tr>
                    <?php else: if(is_array($files) || $files instanceof \think\Collection || $files instanceof \think\Paginator): $i = 0; $__LIST__ = $files;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo htmlentities($key+1); ?></td>
                            <td><?php echo htmlentities($data['create_time']); ?></td>
                            <td><?php echo htmlentities($data['create_user']); ?></td>
                            <td>
                                <?php if($data['type'] =='png'||$data['type'] =='jpg'): ?>
                                <button onclick="YuLan('<?php echo htmlentities($data['path']); ?>')">方式一</button>
                                <button onclick="YuLans('<?php echo htmlentities($data['path']); ?>')">方式二</button>
                                <?php endif; if($data['type'] =='doc'||$data['type'] =='docx'): ?>
                                预留
                                <?php endif; if($data['type'] =='tif'): ?>
                                tif
                                <?php endif; if($data['type'] == 'pdf'): ?>
                                <button class="layui-btn layui-btn-sm"
                                onclick="x_admin_show('合同文件预览','<?php echo url('index/Order/previewPdf',['id'=>$data['id']]); ?>')">
                                    <i class="layui-icon">PDF</i>
                                </button>
                                <?php endif; ?>
                            </td>
                            <td>
                                <input id="name<?php echo htmlentities($key+1); ?>" class="layui-input" type="text" style="text-align: center"
                                       value="<?php echo htmlentities($data['describe']); ?>" onchange="editName('name<?php echo htmlentities($key+1); ?>',<?php echo htmlentities($data['id']); ?>)">
                            </td>
                            <td>
                                <button class="layui-btn layui-btn-sm layui-btn-danger"
                                onclick="delFiles('<?php echo htmlentities($data['id']); ?>')">
                                    <i class="layui-icon layui-icon-delete"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page">
            <?php echo $page; ?>
        </div>
    </div>
</div>
<!-- 脚本 -->
<script>
    $(function () {
    })
    function YuLan(url) {
        var html = '<body>'+
            '<div align="center" style="width: 100%">'+
            '<img id="imgY" style="max-width: 100%;height: auto" src="'+url+'"/>'+
            '</div>'+
            '</body>';
        layer.open({
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['80%', '80%'], //宽高
            skin: 'layui-layer-nobg', //没有背景色
            shadeClose: true,
            content: html
        });
    }
    function YuLans(url) {
        var html = '<body>'+
            '<div align="center" style="max-width:100%">'+
            '<img id="imgY" src="'+url+'"/>'+
            '</div>'+
            '</body>';
        var newwindow = window.open('', "_blank",'');
        newwindow.document.write(html);
    }
    function delFiles(id) {
        layer.confirm('确定删除该记录与文件？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.ajax({
                url:'<?php echo url("index/Order/DelFiles"); ?>',
                type:'post',
                dataType:'json',
                data:{
                    id
                },success:function (data) {
                    try{
                        if(data.state == 200){
                            layer.msg(data.msg,{icon:1,time:2000},function () {
                                window.location.reload()
                            });
                            return
                        }
                        if(data.state == 400){
                            layer.msg(data.msg,{icon:0,time:2000});
                            return
                        }
                    }catch (e) {
                        layer.msg('网络错误,稍后再试',{icon:0,time:2000});
                        return
                    }
                },error:function (data) {
                    layer.msg('网络错误稍后再试',{icon:0,time:2000});
                    return;
                }
            })
        }, function(){
            layer.msg('已取消', {
                time: 2000, //2s后自动关闭
            });
            return false;
        });
    }
    function Clear() {
        layer.confirm('确定清除所有失效文件的记录,耗时可能较长？', {
            btn: ['确定','取消'] //按钮
        },function () {
            $.ajax({
                url:'<?php echo url("index/order/DelAllFiles",["order_id"=>$id]); ?>',
                type:'get',
                dataType:'json',
                success:function (data) {
                    try{
                        if(data.state == 200){
                            layer.msg(data.msg,{icon:1,time:2000},function () {
                                window.location.reload()
                            });
                            return
                        }
                        if(data.state == 400){
                            layer.msg(data.msg,{icon:0,time:2000});
                            return
                        }
                    }catch (e) {
                        layer.msg('网络错误,稍后再试',{icon:0,time:2000});
                        return
                    }
                },error:function (data) {
                    layer.msg('网络错误稍后再试',{icon:0,time:2000});
                    return;
                }
            });
        },function () {

        });
    }
    function editName(id,Id) {
        var IdName = '#'+id;
        var name = $(IdName).val().trim()==""?"无":$(IdName).val().trim();
        $.ajax({
            url:'<?php echo url("index/Order/editName"); ?>',
            type:'post',
            data:{
                name,Id
            },error:function () {
                layer.msg('修改失败,稍后再试',function () {
                    window.location.reload();
                    return;
                })
            }
        })
    }
</script>
</body>