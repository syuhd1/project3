<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'order_id', 'report_type', 'details'];

    public function user(){
        return $this->hasOne('App\Models\User', 'id','user_id');
    }
    
    public function product(){
        return $this->hasOne('App\Models\Product', 'id','product_id');
    }

    public function order(){
        return $this->hasOne('App\Models\Order', 'id','order_id');
    }
    
}
