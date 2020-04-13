<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\phpStudy\WWW\tprbac\public/../application/admin\view\user\login.html";i:1585207752;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title>后台登录</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/tprbac/public/static/admin/layui/css/layui.css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/tprbac/public/static/admin/css/login.css"/>
</head>

<body>
<div class="m-login-bg">
    <div class="m-login">
        <h3>后台系统登录</h3>
        <div class="m-login-warp">
            <form class="layui-form" action="<?php echo url('user/login'); ?>" method="post">
                <div class="layui-form-item">
                    <input type="text" name="post[username]" lay-verify="required|username" placeholder="用户名" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-item">
                    <input type="text" name="post[password]" lay-verify="required|password" placeholder="密码" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <input type="text" name="post[verity]" lay-verify="required|verity" placeholder="验证码" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-inline">
                        <img class="verifyImg" onclick="this.src=this.src+'?c='+Math.random();" src="<?php echo url('user/verify'); ?>"/>
                    </div>
                </div>
                <div class="layui-form-item m-login-btn">
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="login">登录</button>
                    </div>
                    <div class="layui-inline">
                        <button type="reset" class="layui-btn layui-btn-primary">取消</button>
                    </div>
                </div>
            </form>
        </div>
        <p class="copyright">Copyright 2020 by YANG</p>
    </div>
</div>
<script src="http://localhost/tprbac/public/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script>
    layui.use(['form', 'layedit', 'laydate'], function () {
        let form = layui.form();
        let layer = layui.layer;


        //自定义验证规则
        form.verify({
            username: function (value) {
                if (value.length < 5) {
                    return '用户名至少得5个字符';
                }
            },
            password: [/(.+){5,12}$/, '密码必须5到12位'],
            verity: [/(.+){5}$/, '验证码必须是5位'],
        });


        //监听提交
        form.on('submit(login)', function (data) {
            layer.alert(JSON.stringify(data.field), {
                title: '最终的提交信息'
            });
            return false;
        });

    });
</script>
</body>

</html>