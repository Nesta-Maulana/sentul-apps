<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
	protected $connection = 'production_data';
    protected $table= "brand";
    protected $guarded = ['id'];

    public function company(){
        return $this->belongsTo('App\Models\utilityOnline\company', 'company_id');
    }
}
