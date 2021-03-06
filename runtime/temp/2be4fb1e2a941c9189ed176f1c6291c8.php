<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\phpStudy\WWW\tprbac\public/../application/admin\view\role\add.html";i:1585190666;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="http://localhost/tprbac/public/static/admin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/tprbac/public/static/admin/css/admin.css" />
</head>

<body>
<div class="layui-tab page-content-wrap">
    <ul class="layui-tab-title">
        <li>
            <a href="<?php echo url('role/index'); ?>">角色列表</a>
        </li>
        <li class="layui-this">添加角色</li>
    </ul>
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <form class="layui-form" style="width: 90%;padding-top: 20px;" action="<?php echo url('role/add'); ?>" method="post">
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: #f00;">*</span> 角色名称：</label>
                    <div class="layui-input-block">
                        <input type="text" name="post[name]" lay-verify="required" lay-reqtext="角色名称是必填项" autocomplete="off" class="layui-input" placeholder="请输入角色名称">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">备注：</label>
                    <div class="layui-input-block">
                        <textarea name="post[note]" placeholder="请输入角色备注" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">授权菜单：</label>
                    <div class="layui-input-block">
                        <div id="tree"></div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="siteInfo">立即提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="http://localhost/tprbac/public/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script>
    layui.config({
        base: 'http://localhost/tprbac/public/static/admin/layui/lay/modules/',
    }).extend({
        authtree: 'authtree',
    });
</script>
<script>
    layui.use(['form', 'element', 'authtree'], function() {
        let form = layui.form;
        let authtree = layui.authtree;
        form.render();
        authtree.render('#tree', <?php echo $tree; ?>, {
            inputname: 'post[auth][]',
            layfilter: 'lay-check-auth',
            autowidth: true,
            openall: true,
            childKey: 'children',
            theme: 'auth-skin-default',
            themePath: 'http://localhost/tprbac/public/static/admin/layui/lay/themes/' // 主题路径，默认 layui_exts/tree_themes/
        });
        //监听信息提交
        form.on('submit(siteInfo)', function(data) {
            // layer.msg(JSON.stringify(data.field), {time: 10000});
            // return false;
        });
    });
</script>
</body>

</html>