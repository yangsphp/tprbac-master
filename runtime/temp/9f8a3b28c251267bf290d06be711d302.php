<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\phpStudy\WWW\tprbac\public/../application/admin\view\database\index.html";i:1586437555;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="http://localhost/tprbac/public/static/admin/css/admin.css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/tprbac/public/static/admin/layui/css/layui.css"/>
</head>
<body>
<div class="page-content-wrap">
    <div class="layui-input-inline">
        <input style="height: 30px;border-radius: 0px;" type="text" name="keyword" id="keyword" placeholder="search" autocomplete="off" class="layui-input">
    </div><div class="layui-input-inline">
        <button class="layui-btn layui-btn-sm" style="border-radius: 0px;">搜索</button>
    </div>
    <table class="layui-hide" id="database" lay-filter="database"></table>
    <table class="layui-hide" id="backup" lay-filter="backup"></table>
</div>

<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="doBack"><i class="layui-icon layui-icon-addition"></i>备份选中表
        </button>
    </div>
</script>
<script type="text/html" id="operate">
    <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="repair">修复</a><a class="layui-btn layui-btn-xs"
                                                                                   lay-event="best">优化</a><a
            class="layui-btn layui-btn-danger layui-btn-xs" lay-event="dict">字典</a>
</script>
<script type="text/html" id="b_operate">
    <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="callback">还原</a><a class="layui-btn layui-btn-xs"
                                                                                   lay-event="download">下载</a><a
            class="layui-btn layui-btn-danger layui-btn-xs" lay-event="deleteBack">删除</a>
</script>
<script src="http://localhost/tprbac/public/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="http://localhost/tprbac/public/static/admin/lib/jquery/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script>
    layui.use('table', function () {
        var table = layui.table;
        table.render({
            id: "database",
            elem: '#database',
            url: "<?php echo url('database/lst'); ?>",
            cols: [[
                {checkbox: true, fixed: true}
                , {field: 'name', title: '表名'}
                , {field: 'note', title: '表注释'}
                , {field: 'tsize', title: '表大小（M）'}
                , {field: 'index', title: '索引'}
                , {field: 'chip', title: '碎片'}
                , {field: 'rows', title: '记录数'}
                , {fixed: 'right', title: '操作', toolbar: '#operate', width: 150}
            ]],
            page: false,
            cellMinWidth: 80,
            toolbar: '#toolbar',
            defaultToolbar: ['filter', 'exports', 'print']
        });
        table.on('toolbar(database)', function (obj) {
           let checkStatus = table.checkStatus(obj.config.id);
           var data = checkStatus.data;
            switch (obj.event) {
                case 'doBack':
                    var tables="";
                    if (data.length == 0) {
                        layer.msg("请选择要备份的表", {
                            icon: 5,
                            shift: 6
                        });
                        return false;
                    }
                    for (let i = 0; i < data.length; i++) {
                        if (i == data.length - 1) {
                            tables += data[i].name;
                        }else {
                            tables += data[i].name + ",";
                        }
                    }
                    doBackTables(tables);
                    break;
            }
        });
        table.on('tool(database)', function (obj) {
            var data = obj.data;
            switch (obj.event) {
                case 'repair':
                    var index = layer.confirm("您确定要修复表吗？", function (index) {
                        $.ajax({
                            url: "<?php echo url('database/repair'); ?>?table=" + data.name,
                            type: "post",
                            success: function (data) {
                                if (data.code == 200) {
                                    layer.msg(data.msg, {
                                        icon: 1
                                    });
                                    table.reload("database");
                                } else {
                                    layer.msg(data.msg, {
                                        icon: 5,
                                        shift: 6
                                    });
                                }
                                layer.close(index);
                            }
                        });
                        layer.close(index);
                    });
                    break;
                case 'best':
                    var index = layer.confirm("您确定要优化表吗？", function (index) {
                        $.ajax({
                            url: "<?php echo url('database/optimize'); ?>?table=" + data.name,
                            type: "post",
                            success: function (data) {
                                if (data.code == 200) {
                                    layer.msg(data.msg, {
                                        icon: 1
                                    });
                                    table.reload("database");
                                } else {
                                    layer.msg(data.msg, {
                                        icon: 5,
                                        shift: 6
                                    });
                                }
                                layer.close(index);
                            }
                        });
                        layer.close(index);
                    });
                    break;
                case 'dict':
                    window.location.href = "<?php echo url('database/dict'); ?>?table="+data.name    ;
                    break;
            }
        });
        
        function doBackTables(tables) {
            layer.confirm("你确定要备份选中的表吗？", function (index) {
                $.ajax({
                    url: "<?php echo url('database/back_op'); ?>?tables=" + tables,
                    type: "get",
                    success: function (data) {
                        if (data.code == 200) {
                            layer.msg(data.msg, {
                                icon: 1
                            });
                            location.reload(true);
                        } else {
                            layer.msg(data.msg, {
                                icon: 5,
                                shift: 6
                            });
                        }
                        layer.close(index);
                    }
                });
                layer.close(index);
            });
        }

        var table_back = layui.table;
        table_back.render({
            id: "backup",
            elem: '#backup',
            url: "<?php echo url('database/backup'); ?>",
            cols: [[
                {checkbox: true, fixed: true}
                , {field: 'name', title: 'SQL文件'}
                , {field: 'size', title: '文件大小'}
                , {field: 'username', title: '操作人'}
                , {field: 'date_entered', title: '备份时间'}
                , {fixed: 'right', title: '操作', toolbar: '#b_operate', width: 150}
            ]],
            page: true,
            cellMinWidth: 80,
            defaultToolbar: ['filter', 'exports', 'print']
        });
        table_back.on("tool(backup)", function(obj){
            var data = obj.data;
            switch (obj.event) {
                case 'deleteBack':
                    var index = layer.confirm("您确定要删除备份吗？", function (index) {
                        $.ajax({
                            url: "<?php echo url('database/delback_op'); ?>?id=" + data.id,
                            type: "post",
                            success: function (data) {
                                if (data.code == 200) {
                                    layer.msg(data.msg, {
                                        icon: 1
                                    });
                                    location.reload(true);
                                } else {
                                    layer.msg(data.msg, {
                                        icon: 5,
                                        shift: 6
                                    });
                                }
                                layer.close(index);
                            }
                        });
                        layer.close(index);
                    });
                    break;
                case 'callback':
                    var index = layer.confirm("您确定要还原备份吗？", function (index) {
                        $.ajax({
                            url: "<?php echo url('database/callback_op'); ?>?id=" + data.id,
                            type: "post",
                            success: function (data) {
                                if (data.code == 200) {
                                    layer.msg(data.msg, {
                                        icon: 1
                                    });
                                    location.reload(true);
                                } else {
                                    layer.msg(data.msg, {
                                        icon: 5,
                                        shift: 6
                                    });
                                }
                                layer.close(index);
                            }
                        });
                        layer.close(index);
                    });
                    break;
                case 'download':
                    var url  = "<?php echo SITE_URL?>" + data.path;
                    let tempa = document.createElement('a');
                    tempa.download = data.name;
                    tempa.href = url;
                    document.body.appendChild(tempa);
                    tempa.click();
                    tempa.remove()
                    break;
            }
        })
    });
</script>

</body>
</html>