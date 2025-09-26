<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'e_name',
        'description',
        'price',
        'count',
        'status',
        'category_id',
        'brand_id',
        'image',
        'slug',
        'viewed',
        'sold',
        'discount',
        'max_sell'

    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function guaranties(){
        return $this->belongsToMany(Guaranty::class,'guaranty_product');
    }
    public function colors(){
        return $this->belongsToMany(Color::class,'color_product');
    }
}
