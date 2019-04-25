<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //绑定表名
    protected $table = 'goods';
    //可批量赋值的属性
    //protected $fillable=['user_name','user_pwd'];
    //绑定主键
    protected $primaryKey='goods_id';
    //执行模型是否自动维护时间戳.
    public $timestamps=false;

}
