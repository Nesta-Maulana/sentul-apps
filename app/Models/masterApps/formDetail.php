<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;
use App\Models\masterApps\formHead;

class formDetail extends Model
{
    protected $connection = 'master_apps';
    protected $table = 'form_detail';
    protected $fillable = ['head_id', 'kriteria', 'parameter', 'if_not_ok', 'keterangan'];

    public function formHead(){
        
        return $this->belongsTo('App\Models\masterApps\formHead', 'id', 'head_id');
	
    }
}
