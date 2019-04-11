<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class plan extends Model
{
    protected $table="plan";
    protected $fillable = ['plan', 'company_id', 'alamat'];
}
