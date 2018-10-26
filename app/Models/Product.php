<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'price',
        'stock',
        'decsription'  
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    
    public function gallery(){
        return $this->hasMany('App\Models\Gallery');
    }

    public function item(){
        return $this->hasMany('App\Models\OrderItem');
    }
}
