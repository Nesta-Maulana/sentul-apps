<?php

namespace App\Models\userAccess;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'roles';

    public function user(){
        return $this->hasMany('App\Models\userAccess\userAccess', 'rolesId');
    }
}
