<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pengajuan extends Model
{
    use Notifiable;
        
    protected $connection = 'master_apps';
    protected $table = 'pengajuan_perubahan';
    protected $guarded = ['id'];

    public function departemen()
    {
        return $this->belongsTo('App\Models\masterApps\departemen', 'departemen_id', 'id');
    }
}
