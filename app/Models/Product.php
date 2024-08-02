<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected function casts()
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }


    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_value');
    }


    public function favorites()
    {
        return $this->belongsToMany(User::class, 'user_product');
    }


    public function hasDiscount()
    {
        return $this->discount_percent > 0
            and $this->discount_start <= now()
            and $this->discount_end >= now()
                ? true
                : false;
    }


    public function isNew()
    {
        return $this->created_at >= now()->subMonth()
                ? true
                : false;
    }


    public function price()
    {
        return $this->hasDiscount()
            ? round($this->price * (1 - $this->discount_percent / 100), 1)
            : round($this->price, 1);
    }
}
