<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'category_id','product_name','product_key','price',
    ];

    public function category() {
        $this->hasOne(Category::class);
    }

    public function order() {
        $this->hasMany('Order');
    }
}
