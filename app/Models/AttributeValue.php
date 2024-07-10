<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute_value');
    }
}
