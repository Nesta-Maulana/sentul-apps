<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class requestHakAplikasi extends Model
{
    protected $table = 'request_hak_app';
    protected $guarded = ['id'];

    public function head()
    {
        return $this->belongsTo('App\Models\MasterApps\requestHakAplikasiHead', 'id_request_head');
    }
    public function menu()
    {
        return $this->belongsTo('App\Models\MasterApps\menu', 'id_menu');
    }
    
}
