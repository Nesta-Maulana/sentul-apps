<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class workcenter extends Model
{
    protected $connection = 'mysql2';
    protected $table="workcenter";
    protected $fillable = ['kategori_id', 'workcenter', 'status'];

    public function kategori(){
        return $this->belongsTo('App\Models\utilityOnline\kategori', 'kategori_id');
    }
}