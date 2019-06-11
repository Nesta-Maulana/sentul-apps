<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class hariKerja extends Model
{
    protected $connection = 'mysql2';
    protected $table="hari_kerja";
    protected $guarded=['id'];
}
