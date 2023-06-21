<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory , Translatable;

    protected $with = ['translations'];

    protected $guarded =  [] ;

   
    protected $translatedAttributes  = ['name'] ;

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id'); 
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
