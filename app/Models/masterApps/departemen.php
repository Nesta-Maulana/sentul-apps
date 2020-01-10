<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class departemen extends Model
{
	protected $connection 	= 'master_apps';
	protected $table		= "departemen";
 	protected $guarded 		= ['id'];
    public function karyawan()
    {
        return $this->hasMany('App\Models\masterApps\karyawan', 'id', 'departemen_id');
    }

    public function pengajuan()
    {
        return $this->hasMany('App\Models\masterApps\Pengajuan', 'id','departemen_id' );
    }
}
 