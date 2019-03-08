<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class bagian extends Model
{
    protected $connection = 'mysql2';
    protected $table = "bagian";
    protected $fillable = ['workcenter_id', 'bagian', 'status', 'satuan', 'spek_min', 'spek_max'];

}
