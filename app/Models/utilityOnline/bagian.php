<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class bagian extends Model
{
    protected $connection = 'mysql2';
    protected $table = "bagian";
    protected $fillable = ['workcenter_id', 'bagian', 'status', 'satuan_id', 'spek_min', 'spek_max', 'kategori_pencatatan_id'];

}
