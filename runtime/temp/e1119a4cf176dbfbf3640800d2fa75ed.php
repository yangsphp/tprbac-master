<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\phpStudy\WWW\tprbac\public/../application/admin\view\role\index.html";i:1585310890;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="http://localhost/tprbac/public/static/admin/layui/css/layui.css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/tprbac/public/static/admin/css/admin.css"/>
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
    <table class="layui-hide" id="role" lay-filter="role"></table>
</div>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="add">
            <i class="layui-icon layui-icon-addition"></i>添加角色
        </button>
        <button class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">
            <i class="layui-icon layui-icon-delete"></i>批量删除
        </button>
    </div>
</script>
<script type="text/html" id="operate">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script src="http://localhost/tprbac/public/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="http://localhost/tprbac/public/static/admin/lib/jquery/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script>
    layui.use('table', function () {
        let table = layui.table;
        table.render({
            id: "role",
            elem: '#role',
            title: '表格数据',
            url: "<?php echo url('role/lst'); ?>",
            cols: [[
                {checkbox: true, fixed: true}
                , {field: 'id', width: 80, title: 'ID', sort: true}
                , {field: 'name', title: '角色名称'}
                , {field: 'note', title: '备注'}
                , {field: 'update_entered', title: '修改时间'}
                , {field: 'date_entered', title: '创建时间'}
                , {fixed: 'right', title: '操作', toolbar: '#operate', width: 110}
            ]],
            page: true,
            cellMinWidth: 80,
            toolbar: '#toolbar',
            defaultToolbar: ['filter', 'exports', 'print']
        });
        table.on('toolbar(role)', function (obj) {
            let checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'add':
                    window.location.href = "<?php echo url('role/add'); ?>";
                    break;
                case 'del':
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
                    delete_op(ids, "您确定要删除选中的角色吗？");
                    break;
            }
        });
        table.on('tool(role)', function (obj) {
            let data = obj.data, id = data.id;
            switch (obj.event) {
                case 'edit':
                    window.location.href = "<?php echo url('role/edit'); ?>?id="+id;
                    break;
                case 'del':
                    delete_op(id, "您确定要删除角色吗？");
                    break;
            }
        });

        function delete_op(id, msg) {
            layer.confirm(msg, function (index) {
                $.ajax({
                    url: "<?php echo url('role/delete_op'); ?>?id=" + id,
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