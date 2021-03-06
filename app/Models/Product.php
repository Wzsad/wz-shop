<?php
/*
 * @Description:
 * @Version: 2.0
 * @Autor: Wz
 * @Date: 2019-04-26 09:12:46
 * @LastEditors: Wz
 * @LastEditTime: 2020-01-19 15:58:01
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'image', 'on_sale',
        'rating', 'sold_count', 'review_count', 'price',
    ];
    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型字段
    ];
    // 与商品sku关联
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }
    public function getImageUrlAttribute()
    {
        // 如果 image 字段本身就已经是完整的 url 就直接返回
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        // return \Storage::disk('public')->url($this->attributes['image']);
    }
}
