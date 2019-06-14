<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class requestHakAplikasiHead extends Model
{
    protected $table = 'request_hak_app_head';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('App\Models\userAccess\userAccess', 'id_user_request');
    }
    public function aplikasi()
    {
        return $this->belongsTo('App\Models\masterApps\aplikasi', 'id_aplikasi');
    }
}
