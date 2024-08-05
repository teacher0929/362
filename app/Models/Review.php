<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
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


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function statusName()
    {
        return ['Pending', 'Accepted', 'Canceled'][$this->status];
    }


    public function statusColor()
    {
        return ['warning', 'success', 'danger'][$this->status];
    }
}
