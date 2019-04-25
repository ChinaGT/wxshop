<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 2019/3/18
 * Time: 19:29
 */

//获取分类id
function getSonCateId($cateInfo,$pid){
    static $cate_id=[];
    foreach ($cateInfo as $k => $v) {
        if($v['pid']==$pid){
            //dd($v['cate_id']);
            $cate_id[]=$v['cate_id'];
            getSonCateId($cateInfo,$v['cate_id']);
        }
    }
    //dd($cate_id);die;
    return $cate_id;
}

