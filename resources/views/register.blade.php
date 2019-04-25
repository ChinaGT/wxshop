@extends('public')

@section('title','注册')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>@yield('title')</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url("/css/comm.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("/css/login.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("/css/vccode.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("/css/weui.css")}}" rel="stylesheet" >
    <link rel="stylesheet" href="{{url("/layui/css/layui.css")}}">
    <script src="{{url("/js/jquery-1.11.2.min.js")}}"></script>
    <script src="{{url("/layui/layui.js")}}"></script>
</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">注册</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>
    <div class="wrapper">
        <input name="hidForward" type="hidden" id="hidForward" />
        <div class="registerCon">
            <ul>
                <li class="accAndPwd">
                    @csrf
                    <input type="hidden" name="_token" value="{{csrf_token()}}}">
                    <dl>
                        <s class="phone"></s><input id="userMobile" maxlength="11" type="number" placeholder="请输入您的手机号码" value="" />
                        <span class="clear">x</span>
                    </dl>
                    <dl>
                        <div class="verification">
                            <label for="email_code"><i class="am-icon-code-fork"></i></label>
                            <input type="text" name="user_code" id="email_code"  lay-verify="required" placeholder="请输入验证码">
                            <a  class="btn" href="javascript:;"  id="sendEmailCode">
                                <font class="dyButton" >获取验证码</font>
                            </a>
                        </div>
                    </dl>
                    <dl>
                        <input class="pwd" maxlength="11" type="password" placeholder="6-16位数字、字母组成" value="" />
                        <input class="pwd" maxlength="11" type="text" placeholder="6-16位数字、字母组成" value="" style="display: none" />
                    </dl>
                    <dl>
                        <input class="conpwd" maxlength="11" type="password" placeholder="请确认密码" value="" />
                        <input class="conpwd" maxlength="11" type="text" placeholder="请确认密码" value="" style="display: none" />
                    </dl>
                    <dl class="a-set">
                        <i class="gou"></i><p>我已阅读并同意《666潮人购购物协议》</p>
                    </dl>

                </li>
                <li><a id="btnNext" href="javascript:;" class="orangeBtn loginBtn">下一步</a></li>
            </ul>
        </div>
        
    </div>
<div class="footer clearfix" style="display:none;">
    <ul>
        <li class="f_home"><a href="/v44/index.do" ><i></i>云购</a></li>
        <li class="f_announced"><a href="/v44/lottery/" ><i></i>最新揭晓</a></li>
        <li class="f_single"><a href="/v44/post/index.do" ><i></i>晒单</a></li>
        <li class="f_car"><a id="btnCart" href="/v44/mycart/index.do" ><i></i>购物车</a></li>
        <li class="f_personal"><a href="/v44/member/index.do" ><i></i>我的云购</a></li>
    </ul>
</div>
<div class="layui-layer-move"></div>

</body>
</html>
@endsection
@section('my-js')
<script src="layui/layui.js"></script> 
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
            });
        })

    $('.registerCon input').bind('keydown',function(){
        var that = $(this);
        if(that.val().trim()!=""){
            
            that.siblings('span.clear').show();
            that.siblings('span.clear').click(function(){
                console.log($(this));
                
                that.parents('dl').find('input:visible').val("");
                $(this).hide();
            })

        }else{
           that.siblings('span.clear').hide();
        }

    })
    function show(){
        if($('.registerCon input').attr('type')=='password'){
            $(this).prev().prev().val($("#passwd").val()); 
        }
    }
    function hide(){
        if($('.registerCon input').attr('type')=='text'){
            $(this).prev().prev().val($("#passwd").val()); 
        }
    }
    $('.registerCon s').bind({click:function(){
        if($(this).hasClass('eye')){
            $(this).removeClass('eye').addClass('eyeclose');
            
            $(this).prev().prev().prev().val($(this).prev().prev().val());
            $(this).prev().prev().prev().show();
            $(this).prev().prev().hide();

           
        }else{
                console.log($(this  ));
                $(this).removeClass('eyeclose').addClass('eye');
                $(this).prev().prev().val($(this).prev().prev().prev().val());
                $(this).prev().prev().show();
                $(this).prev().prev().prev().hide();

             }
         }
     })

    function registertel(){
        // 手机号失去焦点
        $('#userMobile').blur(function(){
            reg=/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[06-8])\d{8}$/;//验证手机正则(输入前7位至11位)  
            var that = $(this);
          
            if( that.val()==""|| that.val()=="请输入您的手机号")  
            {   
                layer.msg('请输入您的手机号！');
            }  
            else if(that.val().length<11)  
            {     
                layer.msg('您输入的手机号长度有误！'); 
            }  
            else if(!reg.test($("#userMobile").val()))  
            {   
                layer.msg('您输入的手机号不存在!'); 
            }  
            else if(that.val().length == 11){
                // ajax请求后台数据
            }
        })
        // 密码失去焦点
        $('.pwd').blur(function(){
            reg=/^[0-9a-zA-Z]{6,16}$/;
            var that = $(this);
            if( that.val()==""|| that.val()=="6-16位数字或字母组成")  
            {   
                layer.msg('请设置您的密码！');
            }else if(!reg.test($(".pwd").val())){   
                layer.msg('请输入6-16位数字或字母组成的密码!'); 
            }
        })

        // 重复输入密码失去焦点时
        $('.conpwd').blur(function(){
            var that = $(this);
            var pwd1 = $('.pwd').val();
            var pwd2 = that.val();
            if(pwd1!=pwd2){
                layer.msg('您俩次输入的密码不一致哦！');
            }
        })

    }
        registertel();
    // 购物协议
    $('dl.a-set i').click(function(){
    	var that= $(this);
    	if(that.hasClass('gou')){
    		that.removeClass('gou').addClass('none');
    		$('#btnNext').css('background','#ddd');

    	}else{
    		that.removeClass('none').addClass('gou');
    		$('#btnNext').css('background','#f22f2f');
    	}

    })
    // 下一步提交
    layui.use(['layer'],function () {
        var layer=layui.layer;
        $('#btnNext').click(function(){
            if($('#userMobile').val()==''){
                layer.msg('请输入您的手机号！');
            }else if($('.pwd').val()==''){
                layer.msg('请输入您的密码!');
            }else if($('.conpwd').val()==''){
                layer.msg('请您再次输入密码！');
            }else{
                _tel=$('#userMobile').val();
                _code=$('#email_code').val();
                _pwd=$('.pwd').val();
                _pwd1=$('.conpwd').val();
                //console.log(_token);
                if(_pwd==_pwd1){
                    $.ajax({
                        type:'post',
                        url:"{{'add'}}",
                        data:{user_tel:_tel,code:_code,user_pwd:_pwd,'_token':$("input[name=_token]").val()},
                        success:function (msg) {
                            //console.log(msg);
                            if(msg==0){
                                layer.msg('与发送验证码的手机不一致',{icon:2,time:1000});
                            }else if(msg==1){
                                layer.msg('注册成功',{icon:1,time:1000},function () {
                                    location.href="{{url('userpage')}}";
                                });
                            }else if(msg==2){
                                layer.msg('注册失败',{icon:2,time:1000});

                            }else{
                                layer.msg('验证码错误',{icon:2,time:1000});
                            }
                        }
                    });
                }

            }
        })
    })



</script>
<script src="js/all.js"></script>
<script>
    $("div[class='footer clearfix']").attr('style','display:none');
</script>

@endsection