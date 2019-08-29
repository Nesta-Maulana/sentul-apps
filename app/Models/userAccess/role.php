<?php

namespace App\Models\userAccess;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
	protected $connection = 'master_apps';
    protected $table = 'roles';
    public function user(){
        return $this->hasMany('App\Models\userAccess\userAccess', 'rolesId');
    }
}
