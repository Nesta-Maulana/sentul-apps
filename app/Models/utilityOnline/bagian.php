<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class bagian extends Model
{
    protected $connection = 'mysql2';
    protected $table = "bagian";
    protected $guarded = ['id'];

    public function workcenter(){
        return $this->belongsTo('App\Models\utilityOnline\workcenter', 'workcenter_id');
    }
    public function satuan(){
        return $this->belongsTo('App\Models\utilityOnline\satuan', 'satuan_id');
    }
    public function kategoriPencatatan(){
        return $this->belongsTo('App\Models\utilityOnline\kategoriPencatatan', 'kategori_pencatatan_id');
    }
    public function rasioHead(){
        return $this->hasOne('App\Models\utilityOnline\rasioHead', 'bagian_id');
    }
}
