<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory,Translatable;

    protected $with = ['translations'];

    protected $guarded =  [] ;

    protected $casts  = [
        'is_active' => 'boolean'
    ];

    protected $translatedAttributes  = ['name'] ;

    public function getActive()
    {
        return $this->is_active == 1 ? 'مفعل' : 'غير مفعل' ;
    }
    public function getImagePathAttribute()
    {
        return  asset('assets/images/brands/'. $this->photo) ; 
    }


    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

}
