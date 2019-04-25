
@extends('public')
@section('title','首页')

@section('content')
	{{--<a href="javascript:;" id="location">location</a>--}}
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('css/index.css')}}" rel="stylesheet" type="text/css" />

</head>
<body fnav="2" class="g-acc-bg">
	<div class="marginB" id="loadingPicBlock">
			<!--首页头部-->
			<div class="m-block-header" style="display: none">
				<div class="search"></div>
				<a href="/" class="m-public-icon m-1yyg-icon"></a>
			</div>
			<!--首页头部 end-->

			<!-- 关注微信 -->
			<div id="div_subscribe" class="app-icon-wrapper" style="display: none;">
				<div class="app-icon">
					<a href="javascript:;" class="close-icon"><i class="set-icon"></i></a>
					<a href="javascript:;" class="info-icon">
						<i class="set-icon"></i>
						<div class="info">
							<p>点击关注666潮人购官方微信^_^</p>
						</div>
					</a>
				</div>
			</div>

			<!-- 焦点图 -->
			<div class="hotimg-wrapper">
				<div class="hotimg-top"></div>
				<section id="sliderBox" class="hotimg">
					<ul class="slides" style="width: 600%; transition-duration: 0.4s; transform: translate3d(-828px, 0px, 0px);">
						<li style="width: 414px; float: left; display: block;" class="clone">
							<a href="http://pic1.win4000.com/wallpaper/f/5603c0c7d2132.jpg">
								<img src="http://pic1.win4000.com/wallpaper/f/5603c0c7d2132.jpg" alt="">
							</a>
						</li>
						<li class="" style="width: 414px; float: left; display: block;">
							<a href="http://pic1.win4000.com/wallpaper/e/5603c11b17529.jpg">
								<img src="http://pic1.win4000.com/wallpaper/e/5603c11b17529.jpg" alt="">
							</a>
						</li>
						<li style="width: 414px; float: left; display: block;" class="flex-active-slide">
							<a href="http://pic1.win4000.com/wallpaper/e/5603c11b17529.jpg">
								<img src="http://pic1.win4000.com/wallpaper/e/5603c11b17529.jpg" alt="">
							</a>
						</li>
						<li style="width: 414px; float: left; display: block;" class="">
							<a href="http://pic1.win4000.com/wallpaper/e/5603c11b17529.jpg"><img src="http://pic1.win4000.com/wallpaper/e/5603c11b17529.jpg" alt=""></a>
						</li>
						<li style="width: 414px; float: left; display: block;" class="">
							<a href="http://pic1.win4000.com/wallpaper/e/5603c11b17529.jpg">
								<img src="http://pic1.win4000.com/wallpaper/e/5603c11b17529.jpg" alt="">
							</a>
						</li>
						<li class="clone" style="width: 414px; float: left; display: block;">
							<a href="http://pic1.win4000.com/wallpaper/e/5603c11b17529.jpg">
								<img src="http://pic1.win4000.com/wallpaper/e/5603c11b17529.jpg" alt="">
							</a>
						</li>
					</ul>
				</section>
			</div>    <!--分类-->
		<div class="index-menu thin-bor-top thin-bor-bottom">
			<ul class="menu-list">
				@csrf
				<input type="hidden" name="_token" value="{{csrf_token()}}}">
				@foreach($Cdata as $v)
					<li>
						<a href="{{url('/allshops')}}?cate_id={{$v->cate_id}}" class=btnNew">
							<i class="xinpin"></i>
							<span class="title">{{$v->cate_name}}</span>
						</a>
					</li>
				@endforeach

			</ul>
		</div>
		<!--导航-->
		<div class="success-tip">
			<div class="left-icon"></div>
			<ul class="right-con">
				@foreach($Udata as $v)
				<li>
					<span style="color: #4E555E;">
						<a href="/images/0.jpg" style="color: #4E555E;">微信公众上线了快点去关注</a>   {{--恭喜<span class="username">{{$v->user_tel}}</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span>--}}
					</span>
				</li>
				@endforeach
			</ul>
		</div>
		<!-- 倒計時 -->

		<!-- 热门推荐 -->
		<div class="line hot">
			<div class="hot-content">
				<i></i>
				<span>商品列表</span>
				<div class="l-left"></div>
				<div class="l-right"></div>
			</div>
		</div>
		<div class="hot-wrapper">
			<ul class="clearfix">
				<!--style="border-right:1px solid #e4e4e4; "-->
				@foreach($data as $v)
				<li>
					<a href="{{url('shopcontent')}}/{{$v->goods_id}}">
						<p class="title">{{$v->goods_name}}</p>
						<p class="subtitle">{{$v->goods_desc}}</p>
						<img src="{{$v->goods_img}}">
					</a>
				</li>
					@endforeach
			</ul>
		</div>
		<!-- 猜你喜欢 -->
		<div class="line guess">
			<div class="hot-content">
				<i></i>
				<span>猜你喜欢</span>
				<div class="l-left"></div>
				<div class="l-right"></div>
			</div>
		</div>
		<!--商品列表-->
		<div class="goods-wrap marginB">
			<ul id="ulGoodsList" class="goods-list clearfix">
				@foreach($data as $v)
					<li id="23558" codeid="12751965" goodsid="23558" codeperiod="28436">
						<a href="{{url('shopcontent')}}/{{$v->goods_id}}" class="g-pic">
							<img src="{{$v->goods_img}}">
						</a>
						<p class="g-name"><a href="{{url('shopcontent')}}/{{$v->goods_id}}">(第<em>{{$v->goods_id}}</em>潮){{$v->goods_name}}</a></p>
						<ins class="gray9">价值：￥{{$v->self_price}}</ins>
						<div class="Progress-bar">
							<p class="u-progress">
            				<span class="pgbar" style="width: 96.43076923076923%;">
            					<span class="pging"></span>
            				</span>
							</p>

						</div>
						<div class="btn-wrap" name="buyBox" limitbuy="0" surplus="58" totalnum="1625" alreadybuy="1567">
							<a href="javascript:;" class="buy-btn" codeid="12751965">立即潮购</a>
							<div class="gRate" codeid="12751965" canbuy="58">
								<a codeid="12785750" goods_id="{{$v->goods_id}}" class="cart" canbuy="646"><s></s></a>
							</div>
						</div>
					</li>

				@endforeach
			</ul>
			<div class="loading clearfix"><b></b>正在加载</div>
		</div>

		<div id="div_fastnav" class="fast-nav-wrapper">
			<ul class="fast-nav">
				<li id="li_menu" isshow="0">
					<a href="javascript:;"><i class="nav-menu"></i></a>
				</li>
				<li id="li_top" style="display: none;">
					<a href="javascript:;"><i class="nav-top"></i></a>
				</li>
			</ul>
			<div class="sub-nav four" style="display: none;">
				<a href="#"><i class="single"></i>晒单</a>
				<a href="#"><i class="personal"></i>我的潮购</a>
				<a href="#"><i class="shopcar"></i>购物车</a>
				<a href="{{'quit'}}"><i class="announced"></i>退出</a><!--最新揭晓-->
			</div>
		</div>
	</div>
</body>
</html>

	@endsection
@section('my-js')
	<script src="http://res2.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
	<script>
        wx.config({
            debug: false,
            appId: "{{$signPackage['appId']}}",
            timestamp: "{{$signPackage['timestamp']}}",
            nonceStr: "{{$signPackage['nonceStr']}}",
            signature: "{{$signPackage['signature']}}",
            jsApiList: [
                // 所有要调用的 API 都要加到这个列表中
				"onMenuShareTimeline",
				"updateAppMessageShareData",
				"onMenuShareAppMessage",
				"onMenuShareWeibo",
				"onMenuShareQZone",
				"getLocation",
				"openLocation"
            ]
        });
        wx.ready(function () {
            // 在这里调用 API
            wx.onMenuShareTimeline({
                title: 'Riven的API测试', // 分享标题
                link: 'http://gt.zty77.com/', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: 'http://pic1.win4000.com/wallpaper/f/5603c0c7d2132.jpg', // 分享图标
                success: function () {
                    // 用户点击了分享后执行的回调函数
                },
            });
            wx.updateAppMessageShareData({
                title: 'Riven的API测试', // 分享标题
                desc: 'Riven断剑重铸', // 分享描述
                link: 'http://gt.zty77.com/', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: 'http://pic1.win4000.com/wallpaper/f/5603c0c7d2132.jpg', // 分享图标
                success: function () {
                    // 设置成功
                }
            });
            wx.onMenuShareAppMessage({
                title: 'Riven的API测试', // 分享标题
                desc: 'Riven', // 分享描述
                link: 'http://gt.zty77.com/', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: 'http://pic1.win4000.com/wallpaper/f/5603c0c7d2132.jpg', // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {
                    // 用户点击了分享后执行的回调函数
                }
            });
            wx.onMenuShareWeibo({
                title: 'Riven的API测试', // 分享标题
                desc: 'Riven666', // 分享描述
                link: 'http://gt.zty77.com/', // 分享链接
                imgUrl: 'http://pic1.win4000.com/wallpaper/f/5603c0c7d2132.jpg', // 分享图标
                success: function () {
					// 用户确认分享后执行的回调函数
                },
                cancel: function () {
					// 用户取消分享后执行的回调函数
                }
            });
            wx.onMenuShareQZone({
                title: 'Riven的API测试', // 分享标题
                desc: 'Riven666', // 分享描述
                link: 'http://gt.zty77.com/', // 分享链接
                imgUrl: 'http://pic1.win4000.com/wallpaper/e/5603c11b17529.jpg', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
					// 用户取消分享后执行的回调函数
                }
            });
            document.querySelector('#location').onclick = function () {
                wx.getLocation({
                    type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                    success: function (res) {
                        //alert(res);
                        wx.openLocation({
                            latitude: res.latitude, // 纬度，浮点数，范围为90 ~ -90
                            longitude: res.longitude, // 经度，浮点数，范围为180 ~ -180。
                            name: '火星', // 位置名
                            address: '火星七组', // 地址详情说明
                            scale: 28, // 地图缩放级别,整形值,范围从1~28。默认为最大
                            infoUrl: 'http://gt.zty77.com/' // 在查看位置界面底部显示的超链接,可点击跳转
                        });
                    },
                    cancel : function(res) {

                    }
                });
            }




        });
	</script>
	<script>

		$(function () {
				$('.hotimg').flexslider({
				directionNav: false,   //是否显示左右控制按钮
				controlNav: true,   //是否显示底部切换按钮
				pauseOnAction: false,  //手动切换后是否继续自动轮播,继续(false),停止(true),默认true
				animation: 'slide',   //淡入淡出(fade)或滑动(slide),默认fade
				slideshowSpeed: 3000,  //自动轮播间隔时间(毫秒),默认5000ms
				animationSpeed: 150,   //轮播效果切换时间,默认600ms
				direction: 'horizontal',  //设置滑动方向:左右horizontal或者上下vertical,需设置animation: "slide",默认horizontal
				randomize: false,   //是否随机幻切换
				animationLoop: true   //是否循环滚动
				});
				setTimeout($('.flexslider img').fadeIn());


            });

		jQuery(document).ready(function() {
		$("img.lazy").lazyload({
		placeholder : "images/loading2.gif",
		effect: "fadeIn",
		});

		// 返回顶部点击事件
		$('#div_fastnav #li_menu').click(
		function(){
		if($('.sub-nav').css('display')=='none'){
		$('.sub-nav').css('display','block');
		}else{
		$('.sub-nav').css('display','none');
		}

		}
		)
		$("#li_top").click(function(){
		$('html,body').animate({scrollTop:0},300);
		return false;
		});

		$(window).scroll(function(){
		if($(window).scrollTop()>200){
		$('#li_top').css('display','block');
		}else{
		$('#li_top').css('display','none');
		}

		})


		});


		</script>
	<script>
        //
        layui.use(['layer'],function () {
            layer=layui.layer;

            $(function () {
                //加入购物车
                $(document).on('click','.cart',function () {
                    _this=$(this);
                    var goods_id=_this.attr('goods_id');
                    var buy_number=1;
                    //alert(buy_number);
                    //console.log(goods_id);
                    $.ajax({
                        type:'post',
                        url:"{{url('index/shopcartdo')}}",
                        data:{goods_id:goods_id,buy_number:buy_number,'_token':$("input[name=_token]").val()},
                        success:function (msg) {
                            // if(msg==1){
                            //     layer.msg('加入购物车成功',{icon:1});
                            // }else{
                            //     layer.msg('加入购物车失败',{icon:2});
                            // }
                        }
                    })
                })

            })
        })
	</script>
@endsection


