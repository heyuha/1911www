<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    //////// 指定表明
    protected $table="cart";
    // 指定主键id
    protected $primaryKey="cart_id";
    // 关闭时间chuo1
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
