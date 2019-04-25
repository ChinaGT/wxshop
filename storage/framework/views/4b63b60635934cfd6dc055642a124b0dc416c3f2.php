<?php /* /home/wwwroot/default/wxshop/resources/views/wechat/upload.blade.php */ ?>
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
<select class="layui-select" id="che">
    <option class="text" value="text">文本</option>
    <option class="image" value="image">图片</option>
    <option class="voice" value="voice">语音</option>
    <option class="news" value="news">图文</option>
</select>
<form action="<?php echo e(url('uploaddo')); ?>" class="layui-form" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <div id="text" class="layui-form-item">
        <label for="L_email" class="layui-form-label">
            文本
        </label>
        <div class="layui-input-inline">
            <input type="text" name="text"  class="layui-input">
        </div>
    </div>
    <div id="file">
        <input type="file"  name="upl">
    </div>
    <div id="news">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                标题
            </label>
            <div class="layui-input-inline">
                <input class="layui-input" type="title" name="m_title">陪
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                描述
            </label>
            <div class="layui-input-inline">
                <input class="layui-input" type="text" name="m_desc">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                请选择
            </label>
            <div class="layui-input-inline">
                <input class="layui-input" type="file" name="m_upl" >
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                链接
            </label>
            <div class="layui-input-inline">
                <input class="layui-input" type="url" name="m_url">
            </div>
        </div>

    </div>

        <input class="layui-btn" type="submit" value="点击提交">

</form>

</body>
</html>
<script>
    $(function () {
        layui.use('form', function(){
            var form = layui.form;
            $("#file").hide();
            $("#news").hide();
            var _type='<?php echo e($type); ?>';
            $("option").each(function () {
                var _val=$(this).val();
                //console.log(_val);
                if(_val=_type){
                    $(this).prop('selected',true);
                }
            })

            //alert(_type);
        var _v=$("#che").val();
            if(_v=='text'){
                $("#text").siblings('div').hide();
                $("#text").show();
            }else if(_v=='image'){
                $("#file").siblings('div').hide();
                $("#file").show();
            }else if(_v=='voice'){
                $("#file").siblings('div').hide();
                $("#file").show();
            }else if(_v=='news'){
                $("#news").siblings('div').hide();
                $("#news").show();
            }
        $(document).on('change','#che',function () {
            var _this=$(this);
            var _val=_this.val();
            //alert(_val);
            if(_val=='text'){
                $("#text").siblings('div').hide();
                $("#text").show();
            }else if(_val=='image'){
                $("#file").siblings('div').hide();
                $("#file").show();
            }else if(_val=='voice'){
                $("#file").siblings('div').hide();
                $("#file").show();
            }else if(_val=='news'){
                $("#news").siblings('div').hide();
                $("#news").show();
            }
        })

        });
    })
</script>
