<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>绑定</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <link href="{{url("/css/comm.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("/css/login.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("/css/vccode.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("/css/weui.css")}}" rel="stylesheet" >
    <script src="{{url("/js/jquery-1.11.2.min.js")}}"></script>
    <script src="{{url("/layui/layui.js")}}"></script>
</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">绑定</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="home-icon"></i></a>
</div>

<div class="wrapper">
    <div class="registerCon">
        <div class="binSuccess5">
            <ul>
                <li class="accAndPwd">
                    <dl>
                        @csrf
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="txtAccount">
                            <input id="userMobile" type="text" placeholder="请输入您的手机号码/邮箱"><i></i>
                        </div>
                        <cite class="passport_set" style="display: none"></cite>
                    </dl>
                    <dl>
                        <input id="txtCode" type="text" placeholder="验证码" lay-verify="required" value="" maxlength="20" style="width:65%;"/><i></i>
                        <button type="button" class="layui-btn" id="sendEmailCode">获取验证码</button>
                    </dl>
                </li>
            </ul>
            <a id="btnLogin" href="javascript:;" class="orangeBtn loginBtn">下一步</a>
        </div>
    </div>
</div>


</body>
</html>
<script>
    $(function () {
        layui.use(['layer'],function () {
            var layer=layui.layer;
            $(document).on('click','#sendEmailCode',function () {
                var _tel=$('#userMobile').val();
                //alert(_tel);
                $.post(
                    "{{url('send')}}",
                    {mobile:_tel,'_token':$("input[name=_token]").val()},
                    function (res) {
                        //console.log(res);
                        layer.msg('已发送',{icon:1});
                    }
                )

            })

            $(document).on('click','#btnLogin',function () {
                var _tel=$('#userMobile').val();
                var _code=$('#txtCode').val();
                if(_tel==''){
                    layer.msg('手机号不能为空',{icon:2});
                }else if(_code==''){
                    layer.msg('验证码不能为空',{icon:2});
                }else{
                    $.post(
                        "{{url('dowxbd')}}",
                        {mobile:_tel,code:_code,'_token':$("input[name=_token]").val()},
                        function (res) {
                            //console.log(res);
                            if(res==1){
                                layer.confirm('是否授权', {icon: 3, title:'点击授权'}, function(index){
                                    location.href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx8ede1d5693643f15&redirect_uri=http%3A%2F%2Fgt.zty77.com%2Fdocodes&response_type=code&scope=snsapi_userinfo&state=admin123#wechat_redirect";
                                    layer.close(index);
                                });
                            }else if(res==2){
                                layer.msg('与发送验证码的手机号不一致');
                            }else if(res==3){
                                layer.msg('验证码有误');
                            }
                        }
                    )
                }
                //alert(_tel);

            })

        });
    })
</script>