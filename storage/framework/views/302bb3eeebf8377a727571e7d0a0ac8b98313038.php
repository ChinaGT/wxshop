<?php /* /home/wwwroot/default/wxshop/resources/views/wechat/menuList.blade.php */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo e(url('admin/css/font.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('admin/css/xadmin.css')); ?>">
    <script src="<?php echo e(url('js/jquery-3.2.1.min.js')); ?>"></script>
    <script src="<?php echo e(url('layui/layui.js')); ?>"></script>
    <title>添加素材</title>
</head>
<body>
<table class="layui-table">
    <colgroup>
        <col width="150">
        <col width="200">
        <col>
    </colgroup>
    <thead>
    <tr>
        <th>一级菜单</th>
        <th>二级菜单</th>
        
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>贤心</td>
        <td>2016-11-29</td>

    </tr>
    <tr>
        <td>许闲心</td>
        <td>2016-11-28</td>

    </tr>
    </tbody>
</table>

<script>
    //Demo
    layui.use('form', function(){
        var form = layui.form;

        //监听提交
        form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
            return false;
        });
    });
</script>
</body>
</html>


