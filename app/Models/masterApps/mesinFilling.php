<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class mesinFilling extends Model
{
    protected $table = "mesin_filling";
    protected $fillable = ['nama_mesin', 'kode_mesin', 'status'];
}
