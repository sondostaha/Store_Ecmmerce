<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes , Translatable;

     /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];


    
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['translations'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
         'is_active' => 'boolean',
         'manage_stoke' => 'boolean',
         'in_stock' => 'boolean'
    ];

    protected $dates = [
        'special_price_start',
        'special_price_end' ,
        'start_date' , 
        'end_date',
        'deleted_at'
    ];

    protected $translatedAttributes = ['name' ,'description' ,'short_description'];

    public function brand()
    {
        return $this->belongsTo(Brand::class ,'brand_id','id')->withDefault();
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class ,ProductCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class ,ProductTags::class);
    }

    public function getActive()
    {
        return $this->is_active == 1 ? 'مفعل' : 'غير مفعل' ;
    }

    public function options()
    {
        return $this->hasMany(Option::class ,'product_id');
    }
    
    public function images()
    {
        return $this->hasMany(ProductImage::class , 'product_id' );
    }

    
    public function hasStock($quantity)
    {
        return $this->qty >= $quantity;
    }

    public function outOfStock()
    {
        return $this->qty === 0;
    }

    public function inStock()
    {
        return $this->qty >= 1;
    }

    public function getTotal($converted = true)
    {
        return $total =  $this->special_price ?? $this -> price;

    }

}
