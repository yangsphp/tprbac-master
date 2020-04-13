<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpStudy\WWW\tpshop\public/../application/admin\view\admin\index.html";i:1585310533;}*/ ?>
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
<div class="layui-tab page-content-wrap">
    <div class="layui-input-inline">
        <input style="height: 30px;border-radius: 0px;" type="text" name="keyword" id="keyword" placeholder="search"
               autocomplete="off" class="layui-input">
    </div>
    <div class="layui-input-inline">
        <button class="layui-btn layui-btn-sm" style="border-radius: 0px;">搜索</button>
    </div>
    <table class="layui-hide" id="admin" lay-filter="admin"></table>
</div>

<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="add"><i class="layui-icon layui-icon-addition"></i>添加</button>
        <button class="layui-btn layui-btn-danger layui-btn-sm" lay-event="delAll"><i
                class="layui-icon layui-icon-delete"></i>批量删除
        </button>
    </div>
</script>
<script type="text/html" id="operate">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script src="http://localhost/tpshop/public/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="http://localhost/tpshop/public/static/admin/lib/jquery/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script>
    layui.use('table', function () {
        var table = layui.table;
        table.render({
            id: "admin",
            elem: '#admin',
            url: "<?php echo url('admin/lst'); ?>",
            cols: [[
                {checkbox: true, fixed: true},
                {field: 'id', width: 80, title: 'ID', sort: true}
                , {field: 'username', title: '用户名'}
                , {field: 'name', title: '角色'}
                , {field: 'times', title: '登录次数'}
                , {field: 'last_login_entered', title: '上一次登录时间'}
                , {field: 'login_entered', title: '登录时间'}
                , {field: 'date_entered', title: '创建时间'}
                , {
                    title: '状态', templet: function (mdata) {
                        if (mdata.status == 1) {
                            return '<span class="layui-badge layui-bg-green">已启用</span>';
                        }
                        return '<span class="layui-badge">已停止</span>';
                    }
                }
                , {fixed: 'right', title: '操作', toolbar: '#operate', width: 110}
            ]],
            page: true,
            cellMinWidth: 80,
            toolbar: '#toolbar',
            defaultToolbar: ['filter', 'exports', 'print']
        });
        table.on('toolbar(admin)', function (obj) {
            let checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'add':
                    window.location.href = "<?php echo url('admin/add'); ?>";
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
                    delete_op(ids, "您确定要删除选中的管理员吗？");
                    break;
            }
        });
        table.on('tool(admin)', function (obj) {
            let data = obj.data, id = data.id;
            switch (obj.event) {
                case 'edit':
                    window.location.href = "<?php echo url('admin/edit'); ?>?id="+id;
                    break;
                case 'del':
                    delete_op(id, "您确定要删除管理员吗？");
                    break;
            }
        });

        function delete_op(id, msg) {
            layer.confirm(msg, function (index) {
                $.ajax({
                    url: "<?php echo url('admin/delete_op'); ?>?id=" + id,
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