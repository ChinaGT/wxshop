<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //绑定表名
    protected $table = 'category';
    //可批量赋值的属性
    //protected $fillable=['user_name','user_pwd'];
    //绑定主键
    protected $primaryKey='cate_id';
    //执行模型是否自动维护时间戳.
    public $timestamps=false;

}
