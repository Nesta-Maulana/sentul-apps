<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class departemen extends Model
{
	protected $connection 	= 'mysql';
	protected $table		= "departemen";
 	protected $guarded 		= ['id'];
    public function karyawan()
    {
        return $this->hasMany('App\Models\masterApps\karyawan', 'id', 'departemen_id');
    }
}
 