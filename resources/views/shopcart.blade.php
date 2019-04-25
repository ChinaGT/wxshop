
@extends('public')
@section('title','购物车')
@section('content')
        <!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="{{url('/css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('/css/cartlist.css')}}" rel="stylesheet" type="text/css" />
</head>
<body fnav="2" class="g-acc-bg">
    <input name="hidUserID" type="hidden" id="hidUserID" value="-1" />

        <!--首页头部-->
        <div class="m-block-header">
            <a href="" class="m-public-icon m-1yyg-icon"></a>
            <a href="" class="m-index-icon">编辑</a>
        </div>
        <!--首页头部 end-->
        <div class="g-Cart-list">
            <ul id="cartBody">
                @foreach($data as $v)
                <li>
                    <s class="xuan current" goods_id="{{$v->goods_id}}"  price="{{$v->self_price}}"></s>
                    <a class="fl u-Cart-img" href="{{url('shopcontent')}}/{{$v->goods_id}}">
                        <img src="{{$v->goods_img}}" border="0" alt="">
                    </a>
                    <div class="u-Cart-r">
                        <a href="{{url('shopcontent')}}/{{$v->goods_id}}" class="gray6">(已更新至第{{$v->goods_id}}潮){{$v->goods_name}}</a>
                        <span class="gray9">
                            <em>价格({{$v->self_price}})元</em>
                        </span>
                        <div class="num-opt">
                            <em class="num-mius dis min"><i></i></em>
                            <input class="text_box" name="num" maxlength="6" type="text" value="1" codeid="12501977">
                            <em class="num-add add"><i></i></em>
                        </div>
                        <a href="javascript:;" name="delLink" cid="12501977" isover="0" class="z-del"><s></s></a>
                    </div>    
                </li>
                    @endforeach
            </ul>
            <div id="divNone" class="empty "  style="display: none"><s></s><p>您的购物车还是空的哦~</p><a href="https://m.1yyg.com" class="orangeBtn">立即潮购</a></div>
        </div>
        <div id="mycartpay" class="g-Total-bt g-car-new" style="">
            <dl>
                <dt class="gray6">
                    <s class="quanxuan current"></s>全选
                    <p class="money-total">合计<em class="orange total"><span>￥</span>17.00</em></p>
                    
                </dt>
                <dd>
                    @csrf
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <a href="javascript:;" id="del" class="orangeBtn w_account remove">删除</a>
                    <a href="javascript:;" id="sub" class="orangeBtn w_account">去结算</a>
                </dd>
            </dl>
        </div>
        <div class="hot-recom">
            <div class="title thin-bor-top gray6">
                <span><b class="z-set"></b>人气推荐</span>
                <em></em>
            </div>
            <div class="goods-wrap thin-bor-top">
                <ul class="goods-list clearfix">
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
        </div>
</body>
</html>
@endsection



@section('my-js')
    <script src="{{url('/js/jquery-1.11.2.min.js')}}"></script>
    <!---商品加减算总数---->
        <script type="text/javascript">
        $(function () {
            $(".add").click(function () {
                var t = $(this).prev();
                t.val(parseInt(t.val()) + 1);
                GetCount();
            })
            $(".min").click(function () {
                var t = $(this).next();
                if(t.val()>1){
                    t.val(parseInt(t.val()) - 1);
                    GetCount();
                }
            })
        })
    </script>

    <script>
        //去结算
        $(function () {
            $("#sub").click(function () {
                //alert(1);
                var goods_id=[];
                $(".g-Cart-list .xuan").each(function () {
                    if ($(this).hasClass("current")) {
                        for (var i = 0; i < $(this).length; i++) {
                             goods_id+=$(this).attr('goods_id')+',';
                        }
                    }
                });
                //console.log(goods_id);
                $.post(
                    "{{url('index/total')}}",
                    {goods_id:goods_id,'_token':$("input[name=_token]").val()},
                    function (res) {
                        //console.log(res);
                        location.href="{{url('index/totaldo')}}"
                    }

                )
            })
        })
    </script>
    <script>
    // 全选        
    $(".quanxuan").click(function () {
        if($(this).hasClass('current')){
            $(this).removeClass('current');

             $(".g-Cart-list .xuan").each(function () {
                if ($(this).hasClass("current")) {
                    $(this).removeClass("current"); 
                } else {
                    $(this).addClass("current");
                } 
            });
            GetCount();
        }else{
            $(this).addClass('current');

             $(".g-Cart-list .xuan").each(function () {
                $(this).addClass("current");
                // $(this).next().css({ "background-color": "#3366cc", "color": "#ffffff" });
            });
            GetCount();
        }
        
        
    });
    // 单选
    $(".g-Cart-list .xuan").click(function () {
        if($(this).hasClass('current')){
            

            $(this).removeClass('current');

        }else{
            $(this).addClass('current');
        }
        if($('.g-Cart-list .xuan.current').length==$('#cartBody li').length){
                $('.quanxuan').addClass('current');

            }else{
                $('.quanxuan').removeClass('current');
            }
        // $("#total2").html() = GetCount($(this));
        GetCount();
        //alert(conts);
    });
  // 已选中的总额
    function GetCount() {
        var conts = 0;
        var aa = 0;
        $(".g-Cart-list .xuan").each(function () {
            var self_price=$(this).attr('price');
            if ($(this).hasClass("current")) {
                for (var i = 0; i < $(this).length; i++) {
                    conts += parseInt($(this).parents('li').find('input.text_box').val())*self_price;
                    // aa += 1;
                }
            }
        });
        //console.log(conts);
         $(".total").html('<span>￥</span>'+(conts).toFixed(2));
    }
    GetCount();
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
                            //console.log(msg);
                            history.go(0);
                        }
                    })
                })

            })
        })
    </script>
@endsection


