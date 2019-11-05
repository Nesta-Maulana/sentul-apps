<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;
use App\Models\masterApps\formDetail;
use App\Models\masterApps\formHead;

class PengamatanDetail extends Model
{
    protected $connection = 'master_apps';
    protected $table = 'pengamatan_detail';
    protected $guarded = ['id'];

    public function PengamatanDetail(){
        return $this->belongsTo('App\Models\masterApps\formDetail', 'id', 'form_detail_id');
    }   
}
