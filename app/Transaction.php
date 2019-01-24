<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'price',
    ];

    public function order() {
        return $this->hasMany(Order::class);
    }
}
