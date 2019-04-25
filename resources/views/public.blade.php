
<body fnav="1" class="g-acc-bg">
    @yield('content')


    <!--底部-->
    <div class="footer clearfix" >
        <ul>
            <li class="f_home"><a href="{{url('/')}}" class="hover"><i></i>潮购</a></li>
            <li class="f_announced"><a href="{{url('/allshops')}}" ><i></i>所有商品</a></li>
            <li class="f_single"><a href="" ><i></i></a></li><!--/v41/post/index.do      最新揭晓-->
            <li class="f_car"><a id="btnCart" href="{{url('index/shopcart')}}" ><i></i>购物车</a></li>
            <li class="f_personal"><a href="{{url('userpage')}}" ><i></i>我的潮购</a></li>
        </ul>
    </div>
</body>

<script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
<script src="http://cdn.bootcss.com/flexslider/2.6.2/jquery.flexslider.min.js"></script>

<script src="{{url('layui/layui.js')}}"></script>
<script src="{{url('js/all.js')}}"></script>
<script src="{{url('js/index.js')}}"></script>
<script src="{{url('js/lazyload.min.js')}}"></script>


    @yield ('my-js')
