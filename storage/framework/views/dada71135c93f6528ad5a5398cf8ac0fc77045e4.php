<?php /* /home/wwwroot/default/wxshop/resources/views/userpage.blade.php */ ?>
﻿


<?php $__env->startSection('title','我的潮购'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />

    <link href="<?php echo e('/css/comm.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e('/css/member.css'); ?>" rel="stylesheet" type="text/css" />
    <!--<script src="<?php echo e('/js/jquery190_1.js'); ?>" language="javascript" type="text/javascript"></script>-->
</head>
        <?php if($data===1): ?>
        <div class="welcome" >
            <p>Hi，等你好久了！</p>
            <a href="<?php echo e('login'); ?>" class="orange">登录</a>
            <a href="<?php echo e('register'); ?>" class="orange">注册</a>
        </div>
        <?php else: ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="welcome">
            <i class="set"></i>
            <div class="login-img clearfix">
                <ul>
                    <li><img src="http://pic1.win4000.com/wallpaper/f/5603c0c7d2132.jpg" alt=""></li>
                    <li class="name">
                        <h3><?php echo e($v->user_tel); ?></h3>
                        <p>ID：<?php echo e($v->user_id); ?></p>
                    </li>
                    <li class="next fr"><s></s></li>
                </ul>
            </div>
            <div class="chao-money">
                <ul class="clearfix">
                    <li class="br">
                        <p>潮购值</p>
                        <span>822</span>
                    </li>
                    <li class="br">
                        <p>余额（元）</p>
                        <span>0.00</span>
                    </li>
                    <li>
                        <a href="" class="recharge">去充值啦</a>
                    </li>
                </ul>
            </div>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <!--获得的商品-->
    <!--导航菜单-->

    <div class="sub_nav marginB person-page-menu">
        <a href="<?php echo e(url('index/buyrecord')); ?>"><s class="m_s1"></s>潮购记录<i></i></a>
        <a href="<?php echo e(url('index/buyrecord')); ?>"><s class="m_s2"></s>获得的商品<i></i></a>
        <a href="<?php echo e(url('index/share')); ?>"><s class="m_s3"></s>我的晒单<i></i></a>
        <a href="<?php echo e(url('index/mywallet')); ?>"><s class="m_s4"></s>我的钱包<i></i></a>
        <a href="<?php echo e(url('index/address')); ?>"><s class="m_s5"></s>收货地址<i></i></a>
        <a href="/v44/help/help.do" class="mt10"><s class="m_s6"></s>帮助与反馈<i></i></a>
        <a href="/v44/help/help.do"><s class="m_s7"></s>二维码分享<i></i></a>
        <p class="colorbbb">客服热线：400-666-2110  (工作时间9:00-17:00)</p>
    </div>
</html>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('my-js'); ?>

    <script>
        function goClick(obj, href) {
            $(obj).empty();
            location.href = href;
        }
        if (navigator.userAgent.toLowerCase().match(/MicroMessenger/i) != "micromessenger") {
            $(".m-block-header").show();
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>