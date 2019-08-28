<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class hakAksesUserAplikasi extends Model
{
	protected $connection = 'master_apps';
    protected $table = 'hak_akses_aplikasi';
    protected $guarded = ['id'];
    public function aplikasi(){
        return $this->belongsTo('App\Models\masterApps\aplikasi', 'id_aplikasi');
    }
    public function user(){
        return $this->belongsTO('App\Models\userAccess\userAccess','id_user');
    }
}
