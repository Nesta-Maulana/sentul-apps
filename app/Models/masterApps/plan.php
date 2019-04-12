<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class plan extends Model
{
    protected $table="plan";
    protected $guarded = ['id'];

    public function company(){
        return $this->belongsTo('App\Models\utilityOnline\company', 'company_id');
    }
}
