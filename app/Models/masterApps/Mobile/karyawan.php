<?php

namespace App\Models\masterApps\Mobile;

use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    protected $table="karyawan";
    protected $fillable = ['nik', 'nama', 'jk', 'marital_status', 'tempat_lahir', 'agama_id', 'golongan_darah', 'email'];
}
