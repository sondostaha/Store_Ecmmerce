<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $with = 'translations';
    protected $guarded =  [] ;
    protected $casts  = [
        'is_active' => 'boolean'
    ];
    protected $translatedAttributes  = ['name'] ;


}
