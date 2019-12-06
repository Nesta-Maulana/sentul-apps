<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $connection = 'master_apps';
    protected $table = 'pengajuan_perubahan';
    protected $guarded = ['id'];

    
}
