<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
	protected $connection = 'mysql';
    protected $table="karyawan";
    protected $fillable = ['nik', 'nama', 'jk', 'marital_status', 'tempat_lahir', 'agama_id', 'golongan_darah', 'email'];

    public function user(){
        return $this->hasOne('App\Models\userAccess\userAccess', 'username', 'nik');
    }
 	public function agama()
 	{
        return $this->belongsTo('App\Models\masterApps\agama', 'agama_id', 'id');
    }
}
