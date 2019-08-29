<?php

namespace App\Models\userAccess;

use Illuminate\Database\Eloquent\Model;

class userAccess extends Model
{
    protected $table    =   'users';
    protected $guarded  = ['id'];
    protected $connection = 'master_apps';
    
    public function role(){
        return $this->belongsTo('App\Models\userAccess\role', 'rolesId');
    }
    public function karyawan(){
        return $this->hasOne('App\Models\masterApps\karyawan', 'nik', 'username');
    }
}
