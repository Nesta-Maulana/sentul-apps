<?php

namespace App\Models\userAccess;

use Illuminate\Database\Eloquent\Model;

class userAccess extends Model
{
    protected $table    =   'users';
    protected $guarded  = ['id'];
    public function role()
    {
    	return $this->belongsTo('App\Models\userAccess\role','rolesId');
    }
}
