<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"D:\phpStudy\WWW\tpshop\public/../application/admin\view\admin\add.html";i:1585224042;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/tpshop/public/static/admin/layui/css/layui.css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/tpshop/public/static/admin/css/admin.css"/>
</head>

<body>
<div class="layui-tab page-content-wrap">
    <ul class="layui-tab-title">
        <li>
            <a href="<?php echo url('admin/index'); ?>">管理员列表</a>
        </li>
        <li class="layui-this">添加管理员</li>
    </ul>
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <form class="layui-form" style="width: 90%;padding-top: 20px;" action="<?php echo url('admin/add'); ?>" method="post">
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: #f00;">*</span> 角色：</label>
                    <div class="layui-input-block">
                        <select name="post[role_id]" lay-verify="required" lay-reqtext="角色是必选项">
                            <option value="">请选择角色</option>
                            <?php foreach($role as $k => $v){?>
                            <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: #f00;">*</span> 名称：</label>
                    <div class="layui-input-block">
                        <input type="text" name="post[username]" autocomplete="off" placeholder="请输入名称"
                               class="layui-input" value="" lay-verify="required|isExist" lay-reqtext="名称是必填项">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: #f00;">*</span> 密码：</label>
                    <div class="layui-input-block">
                        <input type="text" name="post[password]" lay-verify="required|pass" lay-reqtext="密码是必填项"
                               placeholder="" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: #f00;">*</span> 确认密码：</label>
                    <div class="layui-input-block">
                        <input type="text" name="post[rpassword]" lay-verify="required|confirmPass"
                               lay-reqtext="确认密码是必填项" placeholder="" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">状态：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="post[status]" value="1" title="启用" checked>
                        <input type="radio" name="post[status]" value="0" title="停用">
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
<script src="http://localhost/tpshop/public/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="http://localhost/tpshop/public/static/admin/lib/jquery/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script>
    layui.use(['form', 'element'], function () {
        let form = layui.form;
        form.render();
        form.verify({
            confirmPass: function (value) {
                let password = $('input[name="post[password]"]').val();
                if (password != value) {
                    return '两次密码输入不一致！';
                }
            }, pass: [
                /^[\S]{5,12}$/
                , '密码必须5到12位，且不能出现空格'
            ],
            isExist: function (value) {
                let data, msg;
                $.ajax({
                    url: "<?php echo url('admin/check'); ?>",
                    type: "post",
                    dataType: 'json',
                    async: false,
                    data: {name: value},
                    success: function (result) {
                        data = result.code;
                        msg = result.msg;
                    },
                });
                if (data) {
                    return msg;
                }
            }
        });
        //监听信息提交
        form.on('submit(siteInfo)', function (data) {
            // layer.msg(JSON.stringify(data.field));
            // return false;
        });
    });
</script>
</body>

</html>