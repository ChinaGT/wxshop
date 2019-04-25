<?php /* /home/wwwroot/default/wxshop/resources/views/allshops.blade.php */ ?>
﻿

<?php $__env->startSection('title','商品列表'); ?>

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link rel="stylesheet" href="<?php echo e(url('css/mui.min_1.css')); ?>">
    <link href="<?php echo e(url('css/comm.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('css/goods.css')); ?>" rel="stylesheet" type="text/css" />
</head>
    <div class="page-group">
        <div id="page-infinite-scroll-bottom" class="page">

            <!--触屏版内页头部-->
            <div class="m-block-header" id="div-header" style="display: none">
                <strong id="m-title"></strong>
                <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
                <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
            </div>

            <div class="pro-s-box thin-bor-bottom" id="divSearch">
                <div class="box">
                    <div class="border">
                        <div class="border-inner"></div>
                    </div>
                    <div class="input-box">
                        <i class="s-icon"></i>
                        <input type="text" placeholder="输入“汽车”试试" id="txtSearch" />
                        <i class="c-icon" id="btnClearInput" style="display: none"></i>
                    </div>
                </div>
                <a href="javascript:;" class="s-btn" id="btnSearch">搜索</a>
            </div>

            <!--搜索时显示的模块-->
            <div class="search-info" style="display: none;">
                <div class="hot">
                    <p class="title">热门搜索</p>
                    <ul id="ulSearchHot" class="hot-list clearfix"><li wd='iPhone'><a class="items">iPhone</a></li><li wd='三星'><a class="items">三星</a></li><li wd='小米'><a class="items">小米</a></li><li wd='黄金'><a class="items">黄金</a></li><li wd='汽车'><a class="items">汽车</a></li><li wd='电脑'><a class="items">电脑</a></li></ul>
                </div>
                <div class="history" style="display: none">
                    <p class="title">历史记录</p>
                    <div class="his-inner" id="divSearchHotHistory">
                        <ul class="his-list thin-bor-top">
                            <li wd="小米移动电源" class="thin-bor-bottom"><a class="items">小米移动电源</a></li>
                            <li wd="苹果6" class="thin-bor-bottom"><a class="items">苹果6</a></li>
                            <li wd="苹果电脑" class="thin-bor-bottom"><a class="items">苹果电脑</a></li>
                        </ul>
                        <div class="cle-cord thin-bor-bottom" id="btnClear">清空历史记录</div>
                    </div>
                </div>
            </div>

            <div class="all-list-wrapper">

                <div class="menu-list-wrapper" id="divSortList">
                    <ul id="sortListUl" class="list">
                            <?php if($cate_id==0): ?>
                            <li sortid='0' class='cate current' cate_id="0"><span class='items'>全部商品</span></li>
                            <?php else: ?>
                                <li sortid='0' class='cate ' cate_id="0"><span class='items'>全部商品</span></li>
                            <?php endif; ?>
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input type="hidden" id="cate_id" value="<?php echo e($cate_id); ?>?:'0'">
                        <?php $__currentLoopData = $Cdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($v->cate_id==$cate_id): ?>
                                <li sortid='100' reletype='1' linkaddr='' class="cate current" cate_id="<?php echo e($v->cate_id); ?>"><span class='items'><?php echo e($v->cate_name); ?></span></li>
                            <?php else: ?>
                                <li sortid='100' reletype='1' linkaddr='' class="cate" cate_id="<?php echo e($v->cate_id); ?>"><span class='items'><?php echo e($v->cate_name); ?></span></li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

                <div class="good-list-wrapper">
                    <div class="good-menu thin-bor-bottom">
                        <ul class="good-menu-list" id="ulOrderBy">
                            <li orderflag="10" type="2" class="sort current"><a href="javascript:;">默认</a></li>
                            <li orderflag="20" type="4" class="sort"><a href="javascript:;">人气</a></li>
                            <li orderflag="50" type="8" class="sort"><a href="javascript:;">最新</a></li>
                            <li orderflag="30" type="16" class="sort"><a href="javascript:;">价值</a><span class="i-wrap"><i class="up"></i><i class="down"></i></span></li>
                            <!--价值(由高到低30,由低到高31)-->
                        </ul>
                    </div>

                    <div class="good-list-inner">
                        <div  class="good-list-box  mui-content mui-scroll-wrapper"><!--id="pullrefresh"-->
                            <div class="goodList mui-scroll">
                                <ul id="ulGoodsList" class="mui-table-view mui-table-view-chevron">

                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li id="23468">
                                    <span class="gList_l fl">
                                        <a href="<?php echo e(url('shopcontent')); ?>/<?php echo e($v->goods_id); ?>"><img src="<?php echo e($v->goods_img); ?>"></a>
                                    </span>
                                            <div class="gList_r">
                                                <h3 class="gray6">(第<?php echo e($v->goods_id); ?>云)<?php echo e($v->goods_name); ?></h3>
                                                <em class="gray9">价值：￥<?php echo e($v->self_price); ?></em>
                                                <div class="gRate">
                                                    <div class="Progress-bar">
                                                        <p class="u-progress">
                                                    <span style="width: 91.91286930395593%;" class="pgbar">
                                                        <span class="pging"></span>
                                                    </span>
                                                        </p>
                                                        <ul class="Pro-bar-li">
                                                            <li class="P-bar01"><em>7342</em>已参与</li>
                                                            <li class="P-bar02"><em>7988</em>总需人次</li>
                                                            <li class="P-bar03"><em>646</em>剩余</li>
                                                        </ul>
                                                    </div>
                                                    <a codeid="12785750" goods_id="<?php echo e($v->goods_id); ?>" class="cart" canbuy="646"><s></s></a>
                                                </div>
                                            </div>
                                        </li>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
</html>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('my-js'); ?>

    <script src="<?php echo e(url('js/mui.min.js')); ?>"></script>
    <script>




         //
        layui.use(['layer'],function () {
            layer=layui.layer;

        $(function () {

            //点击分类
            $(document).on('click','.cate',function () {
                _this=$(this);
                cate_id=_this.attr('cate_id');
                //alert(cate_id);
                $.ajax({
                    type:'post',
                    url:"<?php echo e(url('allshopsDo')); ?>",
                    data:{cate_id:cate_id,'_token':$("input[name=_token]").val()},
                    success:function (msg) {
                        //console.log(msg);
                        $("#ulGoodsList").html(msg);
                    }
                });
            })

            //点击排序
            $(document).on('click','.sort',function () {
                _this=$(this);
                _this.siblings().removeClass('current');
                _this.addClass('current');
                var _type=_this.attr('type');
                var cate_id=$("li[class='cate current']").attr('cate_id');
                //console.log(cate_id);
                $.ajax({
                    type:'post',
                    url:"<?php echo e(url('allshopsDo')); ?>",
                    data:{cate_id:cate_id,type:_type,'_token':$("input[name=_token]").val()},
                    success:function (msg) {
                        //console.log(msg);
                        $("#ulGoodsList").html(msg);
                    }
                });
            });
            
            //加入购物车
            $(document).on('click','.cart',function () {
                _this=$(this);
                var goods_id=_this.attr('goods_id');
                var buy_number=1;
                //alert(buy_number);
                //console.log(goods_id);
                $.ajax({
                    type:'post',
                    url:"<?php echo e(url('index/shopcartdo')); ?>",
                    data:{goods_id:goods_id,buy_number:buy_number,'_token':$("input[name=_token]").val()},
                    success:function (msg) {
                        //console.log(msg);
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

    <script>

        jQuery(document).ready(function() {
            $("img.lazy").lazyload({
                placeholder : "images/loading2.gif",
                effect: "fadeIn",
            });


        });

    </script>
    <script>
        // 点击切换类别
        $('#sortListUl li').click(function(){
            $(this).addClass('current').siblings('li').removeClass('current');
        })
    </script>
    <script>
        mui.init({
            pullRefresh: {
                container: '#pullrefresh',
                down: {
                    contentdown : "下拉可以刷新",//可选，在下拉可刷新状态时，下拉刷新控件上显示的标题内容
                    contentover : "释放立即刷新",//可选，在释放可刷新状态时，下拉刷新控件上显示的标题内容
                    contentrefresh : "正在刷新...",
                    callback: pulldownRefresh
                },
                up: {
                    contentrefresh: '正在加载...',
                    callback: pullupRefresh
                }
            }
        });
        /**
         * 下拉刷新具体业务实现
         */
        function pulldownRefresh() {
            setTimeout(function() {
                var table = document.body.querySelector('.mui-table-view');
                var cells = document.body.querySelectorAll('.mui-table-view-cell');
                for (var i = cells.length, len = i + 3; i < len; i++) {
                    var li = document.createElement('li');
                    var str='';
                    // li.className = 'mui-table-view-cell';
                    str += '<span class="gList_l fl">';
                    str += '<img class="lazy" data-original="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" src="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" style="display: block;"/>';
                    str += '</span>';
                    str += '<div class="gList_r">';
                    str += '<h3 class="gray6">(第'+i+'云)苹果（Apple）iPhone 7 Plus 256G版 4G手机</h3>';
                    str += '<em class="gray9">价值：￥7988.00</em>';
                    str += '<div class="gRate">';
                    str += '<div class="Progress-bar">'
                    str += '<p class="u-progress">';
                    str += '<span style="width: 91.91286930395593%;" class="pgbar">';
                    str += '<span class="pging"></span>';
                    str += '</span>';
                    str += '</p>';
                    str += '<ul class="Pro-bar-li">';
                    str += '<li class="P-bar01"><em>7342</em>已参与</li>';
                    str += '<li class="P-bar02"><em>7988</em>总需人次</li>';
                    str += '<li class="P-bar03"><em>646</em>剩余</li>';
                    str += '</ul>';
                    str += '</div>';
                    str += '<a codeid="12785750" class="" canbuy="646"><s></s></a>';
                    str += '</div>';
                    str += '</div>';
                    //下拉刷新，新纪录插到最前面；
                    li.innerHTML = str;
                    table.insertBefore(li, table.firstChild);
                }
                mui('#pullrefresh').pullRefresh().endPulldownToRefresh(); //refresh completed
            }, 1500);
        }
        var count = 0;
        /**
         * 上拉加载具体业务实现
         */
        function pullupRefresh() {
            setTimeout(function() {
                mui('#pullrefresh').pullRefresh().endPullupToRefresh((++count > 2)); //参数为true代表没有更多数据了。
                var table = document.body.querySelector('.mui-table-view');
                var cells = document.body.querySelectorAll('.mui-table-view-cell');
                for (var i = cells.length, len = i + 20; i < len; i++) {
                    var li = document.createElement('li');
                    // li.className = 'mui-table-view-cell';
                    var str='';
                    str += '<span class="gList_l fl">';
                    str += '<img class="lazy" data-original="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" src="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" style="display: block;"/>';
                    str += '</span>';
                    str += '<div class="gList_r">';
                    str += '<h3 class="gray6">(第'+i+'云)苹果（Apple）iPhone 7 Plus 256G版 4G手机</h3>';
                    str += '<em class="gray9">价值：￥7988.00</em>';
                    str += '<div class="gRate">';
                    str += '<div class="Progress-bar">'
                    str += '<p class="u-progress">';
                    str += '<span style="width: 91.91286930395593%;" class="pgbar">';
                    str += '<span class="pging"></span>';
                    str += '</span>';
                    str += '</p>';
                    str += '<ul class="Pro-bar-li">';
                    str += '<li class="P-bar01"><em>7342</em>已参与</li>';
                    str += '<li class="P-bar02"><em>7988</em>总需人次</li>';
                    str += '<li class="P-bar03"><em>646</em>剩余</li>';
                    str += '</ul>';
                    str += '</div>';
                    str += '<a codeid="12785750" class="" canbuy="646"><s></s></a>';
                    str += '</div>';
                    str += '</div>';
                    li.innerHTML = str;
                    table.appendChild(li);
                }
            }, 1500);
        }
        // if (mui.os.plus) {
        //     mui.plusReady(function() {
        //         setTimeout(function() {
        //             mui('#pullrefresh').pullRefresh().pullupLoading();
        //         }, 1000);
        //
        //     });
        // }
        // else {
        //     mui.ready(function() {
        //         mui('#pullrefresh').pullRefresh().pullupLoading();
        //     });
        // }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>