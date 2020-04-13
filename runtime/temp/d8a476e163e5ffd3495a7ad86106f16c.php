<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\phpStudy\WWW\tpshop\public/../application/admin\view\database\dict.html";i:1584265448;}*/ ?>
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
                <li><a href="<?php echo url('database/index'); ?>">数据表列表</a></li>
                <li class="layui-this">编辑字典</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <form class="layui-form" style="width: 90%;" action="<?php echo url('database/dict_op'); ?>" method="post">
                        <table class="layui-table">
                          <colgroup>
                            <col width="150">
                            <col width="250">
                            <col>
                          </colgroup>
                          <thead>
                            <tr>
                              <th>字段名</th>
                              <th>字段类型</th>
                              <th>注释</th>
                            </tr> 
                          </thead>
                          <tbody>
                          <?php foreach($data as $key=>$vo): ?>
                            <tr>
                              <td><?php echo $vo['Field']; ?></td>
                              <td><?php echo $vo['Type']; ?></td>
                              <td><input type="text" name="Field[<?php echo $vo['Field']; ?>]" autocomplete="off" class="layui-input" value="<?php echo $vo['comment']; ?>"></td>
                            </tr>
                            <input class="" type="hidden" name="Type[<?php echo $vo['Field']; ?>]" value="<?php echo $vo['Type']; ?>">
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                        <input type="hidden" name="table" value="<?php echo $table; ?>">
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
<script>
    layui.use(['form', 'element'], function () {
        var form = layui.form;
        var element = layui.element;
        form.render();
        //监听信息提交
        form.on('submit(siteInfo)', function (data) {
            console.log(parent.table);
            layer.msg(JSON.stringify(data.field));
            //先得到当前iframe层的索引
            // var index = parent.layer.getFrameIndex(window.name);
            // //先得到当前iframe层的索引
            // parent.layer.close(index);
            // //刷新父级iframe
            // parent.location.reload();
            //return false;
        });
    });
    function submitForm(formObj)
    {
        layer.msg("error", {shift: 6, icon: 2});
    }
</script>
</body>

</html>