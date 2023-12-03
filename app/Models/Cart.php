<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'product_id',
        'color_id',
        'size_id',
        'quantity',
    ];
    function rel_to_color(){
        return $this->belongsTo(Color::class,'color_id');
    }
    function rel_to_size(){
        return $this->belongsTo(Size::class,'size_id');
    }
}
