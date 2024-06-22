<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne('App\Models\User', 'id','user_id');
    }
    
    public function product(){
        // return $this->belongsTo('App\Models\Product', 'product_id', 'id');
        // return $this->hasOne('App\Models\Product', 'id','product_id');
        return $this->belongsTo(Product::class);
    }

}
