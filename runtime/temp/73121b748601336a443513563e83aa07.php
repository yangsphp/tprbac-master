<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\phpStudy\WWW\tpshop\public/../application/admin\view\menu\index.html";i:1585310574;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="http://localhost/tpshop/public/static/admin/css/admin.css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/tpshop/public/static/admin/layui/css/layui.css"/>
</head>
<body>
<div class="page-content-wrap">
    <!--<div class="layui-input-inline">-->
        <!--<input style="height: 30px;border-radius: 0px;" type="text" name="keyword" id="keyword" placeholder="search"-->
               <!--autocomplete="off" class="layui-input">-->
    <!--</div>-->
    <!--<div class="layui-input-inline">-->
        <!--<button class="layui-btn layui-btn-sm" style="border-radius: 0px;">搜索</button>-->
    <!--</div>-->
    <table class="layui-hide" id="menu" lay-filter="menu"></table>
</div>

<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="add"><i class="layui-icon layui-icon-addition"></i>添加菜单
        </button>
        <button class="layui-btn layui-btn-danger layui-btn-sm" lay-event="delAll"><i
                class="layui-icon layui-icon-delete"></i>批量删除
        </button>
    </div>
</script>
<script type="text/html" id="operate">
    <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="child">添加子级</a><a class="layui-btn layui-btn-xs"
                                                                                   lay-event="edit">编辑</a><a
            class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">删除</a>
</script>
<script src="http://localhost/tpshop/public/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="http://localhost/tpshop/public/static/admin/lib/jquery/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script>
    layui.use('table', function () {
        let table = layui.table;
        table.render({
            id: "menu",
            elem: '#menu',
            url: "<?php echo url('menu/lst'); ?>",
            cols: [[
                {checkbox: true, fixed: true}
                , {field: 'id', title: 'ID'}
                , {
                    field: 'name', title: '菜单名称', templet: function (mdata) {
                        let html = "|-";
                        for (let i = 0; i < mdata.level + 1; i++) {
                            html += "---";
                        }
                        html += mdata.name;
                        return html;
                    }
                }
                , {field: 'icon', title: '图标'}
                , {field: 'url', title: '路径'}
                , {field: 'sort', title: '排序'}
                , {field: 'type', title: '是否菜单', templet: function (mdata) {
                        if (mdata.is_menu == 1) {
                            return '<span class="layui-badge layui-bg-green">是</span>';
                        }
                        return '<span class="layui-badge">否</span>';
                    }}
                , {
                    field: 'status', title: '状态', templet: function (mdata) {
                        if (mdata.status == 1) {
                            return '<span style="cursor: pointer;" class="layui-badge layui-bg-green">已启用</span>';
                        }
                        return '<span style="cursor: pointer;"  class="layui-badge">已停止</span>';
                    }
                }
                , {field: 'date_entered', title: '创建时间'}
                , {fixed: 'right', title: '操作', toolbar: '#operate', width: 180}
            ]],
            page: false,
            cellMinWidth: 80,
            toolbar: '#toolbar',
            defaultToolbar: ['filter', 'exports', 'print']
        });
        table.on('toolbar(menu)', function (obj) {
            let checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'add':
                    window.location.href = "<?php echo url('menu/add'); ?>";
                    break;
                case 'delAll':
                    let data = checkStatus.data, ids="";
                    if (data.length == 0) {
                        layer.msg("请选择要删除的项", {
                            icon: 5,
                            shift: 6
                        });
                        return false;
                    }
                    for (let i = 0; i < data.length; i++) {
                        if (i == data.length - 1) {
                            ids += data[i].id;
                        }else {
                            ids += data[i].id + ",";
                        }
                    }
                    delete_op(ids, "您确定要删除选中的菜单吗？");
                    break;
            }
        });
        table.on('tool(menu)', function (obj) {
            let data = obj.data, id = data.id;
            switch (obj.event) {
                case 'child':
                    window.location.href = "<?php echo url('menu/add'); ?>?id="+id;
                    break;
                case 'edit':
                    window.location.href = "<?php echo url('menu/edit'); ?>?id="+id;
                    break;
                case 'delete':
                    delete_op(id, "您确定要删除菜单吗？");
                    break;
            }
        });

        function delete_op(id, msg) {
            layer.confirm(msg, function (index) {
                $.ajax({
                    url: "<?php echo url('menu/delete_op'); ?>?id=" + id,
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
    });
</script>

</body>
</html>