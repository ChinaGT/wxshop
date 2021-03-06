<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>订单详情</title>
    <meta content="app-id=984819816" name="apple-itunes-app">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
	<link rel="stylesheet" href="css/paysuccess.css">
	<title>Document</title>
</head>
<body>
	<section>
		<div class="pay-wrapper">
			<span><i></i></span>
			<p>支付成功，请耐心等待揭晓结果！</p>
			<div class="pay-btn">
				<a href="" class="watch">查看潮购码</a>
				<a href="">继续潮购</a>
			</div>
		</div>
		 
	</section>
	<div class="line hot">
    	<div class="hot-content">
    		<i></i>
    		<span>人气推荐</span>
    		<div class="l-left"></div>
    		<div class="l-right"></div>
    	</div>
    </div>
    <div class="goods-wrap marginB">
        <ul id="ulGoodsList" class="goods-list clearfix">
			@foreach($arr as $v)
				<li>
					<a href="{{url('shopcontent')}}/{{$v->goods_id}}" class="g-pic">
						<img src="{{$v->goods_img}}" width="136" height="136">
					</a>
					<p class="g-name">
						<a href="{{url('shopcontent')}}/{{$v->goods_id}}">(第<i>{{$v->goods_id}}</i>潮){{$v->goods_name}}</a>
					</p>
					<ins class="gray9">价值:￥{{$v->self_price}}</ins>
					<div class="btn-wrap">
						<div class="Progress-bar">
							<p class="u-progress">
                                    <span class="pgbar" style="width:1%;">
                                        <span class="pging"></span>
                                    </span>
							</p>
						</div>
						<div class="gRate" data-productid="23458">
							<a codeid="12785750" goods_id="{{$v->goods_id}}" class="cart" canbuy="646"><s></s></a>
						</div>
					</div>
				</li>
			@endforeach
        </ul>
    </div>
</body>
</html>
