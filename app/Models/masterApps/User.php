<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
    use Notifiable;
    
    protected $fillable =  [
        'nama', 'email'
    ];

    
}
