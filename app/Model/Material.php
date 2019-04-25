<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //绑定表名
    protected $table = 'material';
    //可批量赋值的属性
    protected $fillable=['id','m_title','buy_number'];
    //绑定主键
    protected $primaryKey='cart_id';
    //执行模型是否自动维护时间戳.
    public $timestamps=false;

}
