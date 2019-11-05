<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $connection = 'master_apps';
    protected $table = 'form_excel';
    protected $guarded = ['id'];
}
