<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;
use App\Models\masterApps\formHead;

class PengamatanHead extends Model
{
    protected $connection = 'master_apps';
    protected $table = 'pengamatan_head';
    protected $guarded = ['id'];

    public function PengamatanHead(){
        return $this->belongsTo('App\Models\masterApps\formHead', 'id', 'form_head_id');
    }
}
