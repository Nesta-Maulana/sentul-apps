<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $table= "brand";
    protected $fillable = ['brand', 'plan_id'];
}
