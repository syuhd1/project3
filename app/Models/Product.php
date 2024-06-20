<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // cg edit, remove
    // public function quotations(){
    //     return $this->hasMany('App\Models\Quotation', 'product_id', 'id');
    // }
}
