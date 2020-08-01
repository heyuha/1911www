<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    //////// 指定表明
    protected $table="p_goods";
    // 指定主键id
    protected $primaryKey="goods_id";
    // 关闭时间chuo1
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
