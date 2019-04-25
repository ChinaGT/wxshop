<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('admin/css/font.css')}}">
    <link rel="stylesheet" href="{{url('admin/css/xadmin.css')}}">
    <script src="{{url('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{url('layui/layui.js')}}"></script>
    <title>添加素材</title>
</head>
<body>
<form class="layui-form" action="">
    @csrf
    <div class="layui-form-item">
        <label class="layui-form-label">下拉选择框</label>
        <div class="layui-input-inline">
            <select name="interest" lay-filter="aihao">
                <option>click</option>
                <option>view</option>
            </select>
        </div>
        <label class="layui-form-label">输入框</label>
        <div class="layui-input-inline">
            <input type="text" name="title"   placeholder="请输入标题" autocomplete="off" class="layui-input">
        </div>
        <button class="layui-btn">添加二级菜单</button>
        <button class="layui-btn">删除该一级菜单</button>

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">二级菜单</label>
        <label class="layui-form-label">下拉选择框</label>
        <div class="layui-input-inline">
            <select name="interest" lay-filter="aihao">
                <option>click</option>
                <option>view</option>
            </select>
        </div>
        <label class="layui-form-label">输入框</label>
        <div class="layui-input-inline">
            <input type="text" name="title"   placeholder="请输入标题" autocomplete="off" class="layui-input">
        </div>
        <button class="layui-btn">删除该二级菜单</button>

    </div>



    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
        </div>
    </div>
</form>

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


