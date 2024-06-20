<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'size', 'color', 'quantity'];

    //for unsigned , foreign key from carts table, make ref use this method
    public function user(){
        //return user id to cart on mycart.php
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function product(){
        //return prod id to cart on mycart.php
        return $this->hasOne('App\Models\Product','id','product_id');
    }

    public function quotation(){
        //return prod id to cart on mycart.php
        return $this->hasOne('App\Models\Quotation','id','quote_id');
    }
}
