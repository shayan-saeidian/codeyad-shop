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
    public function products(){
        return $this->hasMany(Product::class);
    }

    public function parentCategory(){
        return $this->belongsTo(Category::class, 'parent_id','id')->withDefault([
            'name'=>'دسته بندی اصلی'
        ]);
    }

    public function childCategory(){
        return $this->hasMany(Category::class, 'parent_id','id');
    }
    public static function getCategories(){
        $array = [];
        $categories = self::query()->with(['childCategory'])->where('parent_id',null)->get();
        foreach ($categories as $category1){
            $array[$category1->id] = $category1->name;
            foreach ($category1->childCategory as $category2){
                $array[$category2->id] =' - '. $category2->name;
            }
        }
        return $array;
    }
    protected static function boot()
    {
        parent::boot();
        self::deleting(function($category){
            foreach ($category->childCategory()->withTrashed()->get() as $child){
                $child->deleteQuietly();
            }
        });
        self::restoring(function($category){
            foreach ($category->childCategory()->withTrashed()->get() as $child){
                $child->restore();
            }
        });
    }
}
