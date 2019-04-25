<?php /* /home/wwwroot/default/wxshop/resources/views/buyrecord.blade.php */ ?>
<?php $__env->startSection('title','潮购记录'); ?>

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?php echo e(url('css/comm.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo e(url('css/buyrecord.css')); ?>">
   
    
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">潮购记录</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="buycart"></i></a>
</div>
<div class="recordwrapp" style="display: none">
    <div class="buyrecord-con clearfix">
        <div class="record-img fl">
            <img src="images/goods2.jpg" alt="">
        </div>
        <div class="record-con fl">
            <h3>(第<i>87390潮</i>)伊利 安慕希希腊风味酸奶 原味205gX12盒</h3>
            <p class="winner">获得者：<i>终于中了一次</i></p>
            <div class="clearfix">
                <div class="win-wrapp fl">
                    <p class="w-time">2017-06-30 11:11:11</p>
                    <p class="w-chao">第<i>23568</i>潮正在进行中...</p>
                </div>
                <div class="fr"><i class="buycart"></i></div>
            </div>
            

        </div>
    </div>
    <div class="buyrecord-con clearfix">
        <div class="record-img fl">
            <img src="/images/goods2.jpg" alt="">
        </div>
        <div class="record-con fl">
            <h3>(第<i>87390潮</i>)伊利 安慕希希腊风味酸奶 原味205gX12盒</h3>
            <p class="winner">获得者：<i>终于中了一次</i></p>
            <div class="clearfix">
                <div class="win-wrapp fl">
                    <p class="w-time">2017-06-30 11:11:11</p>
                    <p class="w-chao"><i>23568</i>潮正在进行中...</p>
                </div>
                <div class="fr"><i class="buycart"></i></div>
            </div>
            

        </div>
    </div>
</div>

<div class="nocontent">
    <div class="m_buylist m_get">
        <ul id="ul_list">
            <div class="noRecords colorbbb clearfix">
                <s class="default"></s>您还没有购买商品哦~
            </div>
            <div class="hot-recom">
                <div class="title thin-bor-top gray6">
                    <span><b class="z-set"></b>人气推荐</span>
                    <em></em>
                </div>
                <div class="goods-wrap thin-bor-top">
                    <ul class="goods-list clearfix">
                        <?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(url('shopcontent')); ?>/<?php echo e($v->goods_id); ?>" class="g-pic">
                                    <img src="<?php echo e($v->goods_img); ?>" width="136" height="136">
                                </a>
                                <p class="g-name">
                                    <a href="<?php echo e(url('shopcontent')); ?>/<?php echo e($v->goods_id); ?>">(第<i><?php echo e($v->goods_id); ?></i>潮)<?php echo e($v->goods_name); ?></a>
                                </p>
                                <ins class="gray9">价值:￥<?php echo e($v->self_price); ?></ins>
                                <div class="btn-wrap">
                                    <div class="Progress-bar">
                                        <p class="u-progress">
                                    <span class="pgbar" style="width:1%;">
                                        <span class="pging"></span>
                                    </span>
                                        </p>
                                    </div>
                                    <div class="gRate" data-productid="23458">
                                        <a codeid="12785750" goods_id="<?php echo e($v->goods_id); ?>" class="cart" canbuy="646"><s></s></a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </ul>
    </div>
</div>
</body>
</html>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('my-js'); ?>
<script src="<?php echo e(url('js/jquery-1.11.2.min.js')); ?>"></script>
<script>
    $("div[class='footer clearfix']").attr('style','display:none');
</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>