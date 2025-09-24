<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'status',
        'image',
    ];

    public function parentCategory(){
        return $this->belongsTo(Category::class, 'parent_id','id')->withDefault([
            'name'=>'دسته بندی اصلی'
        ]);
    }

    public function childCategory(){
        return $this->hasMany(Category::class, 'parent_id','id');
    }
}
