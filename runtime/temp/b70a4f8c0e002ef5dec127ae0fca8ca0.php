<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"D:\phpStudy\WWW\tpshop\public/../application/admin\view\index\index.html";i:1585209822;s:62:"D:\phpStudy\WWW\tpshop\application\admin\view\common\left.html";i:1585223768;s:61:"D:\phpStudy\WWW\tpshop\application\admin\view\common\top.html";i:1585208864;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title>网站后台管理模版</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/tpshop/public/static/admin/layui/css/layui.css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/tpshop/public/static/admin/css/admin.css"/>
    <style>
        .main-layout-header .layui-nav .layui-nav-item a{
            color: #333 !important;
        }
    </style>
</head>
<body>
<div class="main-layout" id='main-layout'>
    <!--侧边栏-->
    <div class="main-layout-side">
    <div class="m-logo">
    </div>
    <ul class="layui-nav layui-nav-tree" lay-filter="leftNav">
        <?php foreach($auth as $k => $v){?>
        <li class="layui-nav-item <?php if($k == 0){echo "layui-nav-itemed";}?>">
            <?php if(isset($v['children']) && count($v['children'])){?>
            <a href="javascript:;"><i class="iconfont">&#xe607;</i><?php echo $v['name']; ?></a>
            <dl class="layui-nav-child">
                <?php foreach($v['children'] as $k1 => $v1){?>
                <dd>
                    <a href="javascript:;" data-url="<?php echo url($v1['url']); ?>" data-id='<?php echo $v1["id"]; ?>' data-text="<?php echo $v1['name']; ?>">
                        <span class="l-line"></span><?php echo $v1['name']; ?>
                    </a>
                </dd>
                <?php }?>
            </dl>
            <?php }else{?>
            <a href="javascript:;" data-url="<?php echo url($v['url']); ?>" data-id='<?php echo $v["id"]; ?>' data-text="<?php echo $v['name']; ?>"><i class="iconfont">&#xe60b;</i><?php echo $v['name']; ?></a>
            <?php }?>
        </li>
        <?php }?>
    </ul>
</div>
    <!--右侧内容-->
    <div class="main-layout-container">
        <!--头部-->
        <div class="main-layout-header">
    <div class="menu-btn" id="hideBtn">
        <a href="javascript:;">
            <span class="iconfont">&#xe60e;</span>
        </a>
    </div>
    <ul class="layui-nav" lay-filter="rightNav">
        <li class="layui-nav-item">
            <a href="javascript:;" data-url="email.html" data-id='4' data-text="邮件系统">
                <i class="iconfont">&#xe603;</i>
            </a>
        </li>
        <li class="layui-nav-item">
            <a href="javascript:;" data-url="admin-info.html" data-id='5' data-text="个人信息"><?php echo $roleName; ?></a>
        </li>
        <li class="layui-nav-item"><a href="<?php echo url('user/logout'); ?>">退出</a></li>
    </ul>
</div>
        <!--主体内容-->
        <div class="main-layout-body">
            <!--tab 切换-->
            <div class="layui-tab layui-tab-brief main-layout-tab" lay-filter="tab" lay-allowClose="true">
                <ul class="layui-tab-title">
                    <li class="layui-this welcome">后台主页</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show" style="background: #f5f5f5;">
                        <!--1-->
                        <iframe src="<?php echo url('index/welcome'); ?>" width="100%" height="100%" name="iframe" scrolling="auto" class="iframe" framborder="0"></iframe>
                        <!--1end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--遮罩-->
    <div class="main-mask">

    </div>
</div>
<script>
    let public = 'http://localhost/tpshop/public/static/admin';
</script>
<script src="http://localhost/tpshop/public/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="http://localhost/tpshop/public/static/admin/js/common.js?v=1.3" type="text/javascript" charset="utf-8"></script>
<script src="http://localhost/tpshop/public/static/admin/js/main.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
