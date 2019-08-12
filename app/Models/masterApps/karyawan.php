<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
	protected $connection = 'master_apps';
    protected $table="karyawan";
    protected $guarded = ['id'];

    public function user(){
        return $this->hasOne('App\Models\userAccess\userAccess', 'username', 'nik');
    }
 	public function departemen()
 	{
        return $this->belongsTo('App\Models\masterApps\departemen', 'departemen_id', 'id');
    }
}
