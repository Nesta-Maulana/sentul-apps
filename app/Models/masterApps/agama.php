<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class agama extends Model
{
	protected $connection = 'mysql';
	protected $table="agama";
 	protected $guarded = ['id'];
    public function karyawan()
    {
        return $this->hasMany('App\Models\masterApps\karyawan', 'id', 'agama_id');
    }
}
 