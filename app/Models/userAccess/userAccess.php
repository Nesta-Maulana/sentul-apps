<?php

namespace App\Models\userAccess;

use Illuminate\Database\Eloquent\Model;

class userAccess extends Model
{
    protected $table    =   'users';
    protected $guarded  = ['id'];
<<<<<<< HEAD

    public function role(){
        return $this->belongsTo('App\Models\userAccess\role', 'rolesId');
    }
    public function karyawan(){
        return $this->hasOne('App\Models\masterApps\karyawan', 'nik', 'username');
=======
    public function role()
    {
    	return $this->belongsTo('App\Models\userAccess\role','rolesId');
>>>>>>> ae901b2e370ffdedfe6265a6172e23a75b06b4fc
    }
}
