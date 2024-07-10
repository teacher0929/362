<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class)
            ->orderBy('id', 'desc');
    }
}
