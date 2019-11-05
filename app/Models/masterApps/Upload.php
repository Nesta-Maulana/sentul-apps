<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $connection = 'master_apps';
    protected $table = 'upload';
    protected $guarded = ['id'];
}
