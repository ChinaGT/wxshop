<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //绑定表名
    protected $table = 'user';
    //可批量赋值的属性
    protected $fillable=['user_tel','user_pwd'];
    //绑定主键
    protected $primaryKey='user_id';
    //执行模型是否自动维护时间戳.
    public $timestamps=false;

}
