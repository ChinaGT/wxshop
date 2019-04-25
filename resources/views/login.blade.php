@extends('public')

@section('title','商品列表')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>登录</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url("/css/comm.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("/css/login.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("/css/vccode.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("/css/weui.css")}}" rel="stylesheet" >
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">登录</strong>
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
                            <input id="txtAccount" type="text" placeholder="请输入您的手机号码/邮箱"><i></i>
                        </div>
                        <cite class="passport_set" style="display: none"></cite>
                    </dl>
                    <dl>
                        <input id="txtPassword" type="password" placeholder="密码" value="" maxlength="20" /><b></b>
                    </dl>
                    <dl>
                        <div class="txtAccount">
                            <input id="txtCode" type="text" placeholder="验证码" value="" maxlength="20" /><i></i>
                        </div>
                        <img id="code" src="{{url('code')}}" alt="">
                    </dl>
                </li>
            </ul>
            <a id="btnLogin" href="javascript:;" class="orangeBtn loginBtn">登录</a>
        </div>
        <div class="forget">
            <a href="https://m.1yyg.com/v44/passport/FindPassword.do">忘记密码？</a><b></b><a href="{{url('/register')}}">新用户注册</a><br/><a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx8ede1d5693643f15&redirect_uri=http%3A%2F%2Fgt.zty77.com%2Fdocodes&response_type=code&scope=snsapi_userinfo&state=admin123#wechat_redirect">微信登录</a>
        </div>
    </div>
    <div class="oter_operation gray9" style="display: none;">
        
        <p>登录666潮人购账号后，可在微信进行以下操作：</p>
        1、查看您的潮购记录、获得商品信息、余额等<br />
        2、随时掌握最新晒单、最新揭晓动态信息
    </div>
</div>
        
<div class="footer clearfix" style="display:none;">
    <ul>
        <li class="f_home"><a href="/v44/index.do" ><i></i>潮购</a></li>
        <li class="f_announced"><a href="/v44/lottery/" ><i></i>最新揭晓</a></li>
        <li class="f_single"><a href="/v44/post/index.do" ><i></i>晒单</a></li>
        <li class="f_car"><a id="btnCart" href="/v44/mycart/index.do" ><i></i>购物车</a></li>
        <li class="f_personal"><a href="/v44/member/index.do" ><i></i>我的潮购</a></li>
    </ul>
</div>
</body>
</html>
@endsection

@section('my-js')

    <script>
        $("div[class='footer clearfix']").attr('style','display:none');

        $('#code').click(function(){
            $(this).attr('src',"{{url('code')}}"+"?"+Math.random())
        })
        $(function () {
            $(document).on('click','#btnLogin',function () {
                var _tel=$("#txtAccount").val();
                var _pwd=$("#txtPassword").val();
                var _code=$("#txtCode").val();
                $.ajax({
                    type:'post',
                    url:"{{url('logindo')}}",
                    data:{user_name:_tel,user_pwd:_pwd,code:_code,'_token':$("input[name=_token]").val()},
                    success:function (msg) {
                        if(msg==1){
                            layer.msg('验证码有误',{icon:2,time:1000});
                        }else if(msg==2){
                            layer.msg('密码有误',{icon:2,time:1000});
                        }else if(msg==3){
                            layer.msg('登录成功',{icon:1,time:1000},function () {
                                location.href="{{url('userpage')}}";
                            });
                        }else if(msg==4){
                            layer.msg('账号不存在',{icon:2,time:1000});
                        }
                    }
                });
            })
        })
    </script>

@endsection