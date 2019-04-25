<?php /* /home/wwwroot/default/wxshop/resources/views/div.blade.php */ ?>
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