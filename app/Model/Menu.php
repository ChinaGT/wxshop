<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //绑定表名
    protected $table = 'menu';
    //可批量赋值的属性
    //protected $fillable=['id'];
    //绑定主键
    protected $primaryKey='menu_id';
    //执行模型是否自动维护时间戳.
    public $timestamps=false;

}
