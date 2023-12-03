<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'brand_id',
        'product_name',
        'price',
        'discount',
        'after_discounter',
        'tags',
        'short_des',
        'long_description',
        'add_info',
        'pre_image',
        'slug',
        'status'
    ];
    function rel_to_category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    function rel_to_subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }
    function rel_to_brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }
}
