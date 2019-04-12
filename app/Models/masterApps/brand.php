<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $table= "brand";
    protected $guarded = ['id'];

    public function plan(){
        return $this->belongsTo('App\Models\masterApps\plan', 'plan_id');
    }
}
