<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [] ;

    protected $casts = [
        'permissions' => 'array'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // public function getPermissionsAttribute($permissions)
    // {
    //     return json_decode($permissions , true);
    // }
}
