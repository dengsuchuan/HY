<?php /*a:2:{s:95:"I:\Project\WebServer\www\project\Hy\application\index\view\production_records\view_process.html";i:1541478155;s:77:"I:\Project\WebServer\www\project\Hy\application\index\view\public\header.html";i:1542108818;}*/ ?>
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
<body>
<div class="x-body">
    <div>
        <table id="table0" class="layui-table">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>类型</th>
                    <th>定额</th>
                    <th>说明</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($process) || $process instanceof \think\Collection || $process instanceof \think\Paginator): $i = 0; $__LIST__ = $process;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$processList): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td width="40">
                        <a href="" style="color: green" data-id="<?php echo htmlentities($processList['process_id']); ?>">
                            <?php echo substr($processList['process_id'],strpos($processList['process_id'],'P'));; ?>
                        </a>
                    </td>
                    <td width="40"><?php echo htmlentities(getProcess($processList['process_type'])); ?></td>
                    <td width="30"><?php echo htmlentities($processList['process_quota']); ?></td>
                    <td><?php echo htmlentities($processList['process_content']); ?></td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>