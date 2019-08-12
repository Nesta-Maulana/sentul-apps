<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class hariKerja extends Model
{
    protected $connection = 'utility_online';
    protected $table="hari_kerja";
    protected $guarded=['id'];
}
