<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory , Translatable;

    protected $with = ['translations'];
    
    protected $translatedAttributes = ['name'];


    protected $fillable = [ 'sulg', 'is_active'];


    protected $casts = [
        'is_active' => 'boolean',
    ];
}
