<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table='users';
    protected $fillable=[
        'username',
        'email',
        'password_hash',
        'profile_image_url	',
    ];
    use HasFactory;

}

